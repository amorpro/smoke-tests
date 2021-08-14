<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:33
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\Response;
use Webmozart\Assert\InvalidArgumentException;

class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    private $response;

    protected function setUp(): void
    {
        $this->response = new Response();
    }

    public function testGetResponse(): void
    {
        $this->response->setBody('some html');

        $this->assertEquals('some html', $this->response->getBody());
    }

    public function testGetDuration(): void
    {
        $this->response->setDuration(12);

        $this->assertEquals(12, $this->response->getDuration());

    }

    public function testSetInvalidDuration(): void
    {
        $this->response->setDuration('sdjkfdkjf');

        $this->assertEquals(0, $this->response->getDuration());

    }

    public function testSetStatusValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->response->setStatus(11);
    }

    public function testSetStatusOk(): void
    {
        $this->response->setStatus(Response::STATUS_OK);

        $this->assertEquals(Response::STATUS_OK, $this->response->getStatus());
        $this->assertEquals(true, $this->response->isOk());
        $this->assertEquals(false, $this->response->isError());
        $this->assertEquals('OK', $this->response->humanizeStatus());
    }

    public function testGetStatus(): void
    {
        $this->response->setStatus(Response::STATUS_ERROR);

        $this->assertEquals(Response::STATUS_ERROR, $this->response->getStatus());
        $this->assertEquals(false, $this->response->isOk());
        $this->assertEquals(true, $this->response->isError());
        $this->assertEquals('Error', $this->response->humanizeStatus());
    }

    public function testSetHttpCodeValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->response->setHttpCode(11100101);
    }

    public function testSetHttpCode(): void
    {
        $this->response->setHttpCode(404);

        $this->assertEquals(404, $this->response->getHttpCode());
        $this->assertEquals('Not Found', $this->response->humanizeHttpCode());

    }


    public function testSetContentTypeValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->response->setContentType('111');
    }

    public function testSetContentType(): void
    {
        $this->response->setContentType('application/json');

        $this->assertEquals('application/json', (string)$this->response->getContentType());

    }

    public function testJsonResponse(): void
    {
        $response = new Response();
        $response->setBody('<br/>');

        $this->assertFalse((bool)$response->getJson());

        $response->setBody(json_encode(['a' => 1]));
        $this->assertTrue((bool)$response->getJson());
        $this->assertEquals(['a' => 1], $response->getJson());
    }
}
