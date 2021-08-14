<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 0:00
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\Cookie;
use SmokeTests\Http\Header;
use SmokeTests\Http\Helper\RegExpHelper;
use SmokeTests\Http\Method;
use SmokeTests\Http\Request;
use Webmozart\Assert\InvalidArgumentException;

class RequestTest extends TestCase
{
    /**
     * @var Request
     */
    private $request;

    public function testAddHeader(): void
    {
        $this->request->addHeader(Header::ACCEPT_CHARSET, 'text/plain');

        $headers = $this->request->getHeaders();
        $header  = reset($headers);

        $this->assertInstanceOf(Header::class, $header);
        $this->assertEquals(Header::ACCEPT_CHARSET, $header->getName());
        $this->assertEquals('text/plain', $header->getValue());
    }

    public function testSetHeaders(): void
    {
        $this->request->addHeader(Header::ACCEPT, 'text/plain');

        $this->request->setHeaders([Header::ACCEPT_CHARSET => 'text/plain']);

        $headers = $this->request->getHeaders();
        $this->assertCount(1, $headers);

        $header = reset($headers);
        $this->assertInstanceOf(Header::class, $header);
    }

    public function testAddCookie(): void
    {
        $this->request->addCookie('foo', 'bar');

        $cookies = $this->request->getCookies();
        $cookie  = reset($cookies);

        $this->assertInstanceOf(Cookie::class, $cookie);
        $this->assertEquals('foo', $cookie->getName());
        $this->assertEquals('bar', $cookie->getValue());

    }

    public function testSetCookies(): void
    {
        $this->request->addCookie('foo', 'bar');

        $this->request->setCookies(['foo2' =>'bar']);

        $cookies = $this->request->getCookies();
        $this->assertCount(1, $cookies);

        $cookie  = reset($cookies);
        $this->assertInstanceOf(Cookie::class, $cookie);

    }


    public function testSetUriValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->request->setUri('http://aaa.com');

        $this->expectException(InvalidArgumentException::class);
        $this->request->setUri('www.com');

    }

    public function testSetHost(): void
    {
        $this->request->setHost('http://aaa.com');

        $this->assertEquals('http://aaa.com', $this->request->getHost());

    }


    public function testSetUri(): void
    {
        $this->request->setHost('http://landing');
        $this->request->setUri('/aaa');

        $this->assertEquals('/aaa', $this->request->getUri());
        $this->assertEquals('http://landing/aaa', $this->request->getFullUrl());
    }

    public function testSetMethod(): void
    {
        $this->request->setMethod(Method::GET);

        $this->assertEquals(Method::GET, $this->request->getMethod());
    }


    public function testSetMethodAndUriValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->request->setMethodAndUri('/aaa');
    }

    public function testSetMethodAndUri(): void
    {
        $this->request->setMethodAndUri('GET /aaa');

        $this->assertEquals('/aaa', $this->request->getUri());
        $this->assertEquals(Method::GET, $this->request->getMethod());

        $this->request->setMethodAndUri('POST /aaa');

        $this->assertEquals('/aaa', $this->request->getUri());
        $this->assertEquals(Method::POST, $this->request->getMethod());
    }


    public function testSetRequestData(): void
    {
        $this->request->setRequestData(['aaa' => 'bbb']);

        $this->assertEquals(['aaa' => 'bbb'], $this->request->getRequestData());
    }


    public function testGetRequestDataForRequest(): void
    {
        $this->request->setRequestData(['aaa' => 'bbb']);

        $this->assertEquals('aaa=bbb', $this->request->getRequestDataForRequest());

        $this->request->setRequestData(['aaa' => 'bbb', 'a' => 1]);
        $this->assertEquals('aaa=bbb&a=1', $this->request->getRequestDataForRequest());
    }

    public function testGetHeadersForRequest(): void
    {
        $this->request->addCookie('a', 1);
        $this->assertEquals(['Cookie: a=1'], $this->request->getHeadersForRequest());
        $this->request->addCookie('b', 2);
        $this->assertEquals(['Cookie: a=1;b=2'], $this->request->getHeadersForRequest());

        $this->request->addHeader(Header::ACCEPT_CHARSET, 'bar');
        $this->assertEquals(
            ['Cookie: a=1;b=2', Header::ACCEPT_CHARSET . ': bar'],
            $this->request->getHeadersForRequest()
        );
    }

    public function testCreateFromArrayValidation(): void
    {
        $test = [
            'uri' => ''
        ];

        $this->expectException(InvalidArgumentException::class);
        Request::createFromArray($test);

        $test = [];

        $this->expectException(InvalidArgumentException::class);
        Request::createFromArray($test);
    }

    /**
     * @dataProvider getCreateFromArrayDataProvider
     */
    public function testCreateFromArray($test): void
    {
        $request = Request::createFromArray($test);

        [$method, $host, $uri] = RegExpHelper::extractMethodHostUri($test['uri']);

        if($host){
            $test['host'] = $host;
        }
        $test['uri'] = $uri;

        // Host
        $this->assertEquals($test['host'], $request->getHost());

        // Uri and Method
        $this->assertEquals($test['uri'], $request->getUri());
        $this->assertEquals($method, (string)$request->getMethod());

        // Headers
        $headers = $request->getHeaders();
        $testHeaders = array_merge([Header::USER_AGENT => Request::USER_AGENT], $test['headers']??[]);
        foreach($headers as $header){
            $this->assertTrue(isset($testHeaders[$header->getName()]));
            $this->assertContains($header->getValue(), $testHeaders, true);

        }

        // Cookie
        if(isset($test['cookies'])){
            $cookies = $request->getCookies();
            foreach($cookies as $cookie){
                $this->assertTrue(isset($test['cookies'][$cookie->getName()]));
                $this->assertContains($cookie->getValue(), $test['cookies'], true);

            }
        }
    }

    /**
     * @return array
     */
    public function getCreateFromArrayDataProvider(): array
    {
        return [
            [
                [
                    'host' => 'http://landing',
                    'uri' => 'GET /aaa',
                ]
            ],
            [
                [
                    'uri' => 'GET http://landing/aaa',
                ]
            ],
            [
                [
                    'host' => 'http://landing',
                    'uri' => 'GET /aaa',
                    'headers' => [
                        Header::USER_AGENT => 'aaa'
                    ]
                ]
            ],

            [
                [
                    'host' => 'http://landing',
                    'uri' => 'GET /aaa',
                    'headers' => [
                        Header::ACCEPT_CHARSET => 'text/plain',
                    ],
                    'cookies' => [
                        'aaa' => 'text/plain'
                    ],
                ]
            ],

        ];
    }



    protected function setUp(): void
    {
        $this->request = new Request();
    }
}
