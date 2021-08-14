<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:05
 */

namespace SmokeTests\Http;


use SmokeTests\Http\Behaviour\Headers;
use SmokeTests\Http\Behaviour\Cookies;
use SmokeTests\Http\Helper\RegExpHelper;
use Webmozart\Assert\Assert;

class Request
{

    use Headers, Cookies;

    public const USER_AGENT = 'smoke-tester/1.0';

    private $host;
    private $uri;
    private $method;
    private $requestData = [];



    public static function createFromArray(array $smokeTest): Request
    {
        $test = new self();

        Assert::notEmpty($smokeTest['uri'], 'Uri can\'t be empty');

        [$method, $host, $requestUri] = RegExpHelper::extractMethodHostUri($smokeTest['uri']);
        if($host){
            $smokeTest['host'] = $host;
        }
        $smokeTest['uri'] = $requestUri;


        Assert::notEmpty($smokeTest['host'], 'Host can\'t be empty');

        $test->setHost($smokeTest['host']);
        $test->setMethod($method);
        $test->setUri($smokeTest['uri']);

        $test
            ->setRequestData($smokeTest['data'] ?? [])
            ->setCookies($smokeTest['cookies'] ?? [])
            ->setHeaders($smokeTest['headers'] ?? []);

        if (!isset($test->headers[Header::USER_AGENT])) {
            $test->addHeader(Header::USER_AGENT, self::USER_AGENT);
        }

        return $test;
    }

    public function setMethodAndUrl($methodAndUrl): void
    {

    }

    /**
     * @param $methodAndUri
     * @return $this
     */
    public function setMethodAndUri($methodAndUri): Request
    {
        Assert::contains($methodAndUri, ' ', 'Incorrect format for methodAndUri');

        [$method, $uri] = explode(' ', $methodAndUri);
        $this->setMethod($method);
        $this->setUri($uri);

        return $this;
    }


    /**
     * @return array
     */
    public function getHeadersForRequest(): array
    {
        if ($this->cookies) {
            $this->addHeader(Header::COOKIE, $this->getCookiesForHeaderValue());
        }

        return array_values(array_map('strval', $this->getHeaders()));
    }

    /**
     * @return string
     */
    protected function getCookiesForHeaderValue(): string
    {
        return implode(';', array_values(array_map('strval', $this->cookies)));
    }

    public function getFullUrl(): string
    {
        Assert::notEmpty($this->host, 'Host can\'t be empty in the request');

        return trim($this->host, '/') . '/' . ltrim($this->uri, '/');
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     * @return $this
     */
    public function setUri($uri): self
    {
        Assert::notStartsWith($this->getUri(), 'http', 'Uri should not starts with http/s');
        Assert::notStartsWith($this->getUri(), 'www', 'Uri should not starts with www');

        $this->uri = $uri;
        return $this;
    }

    public function getRequestData(): array
    {
        return $this->requestData;
    }

    public function setRequestData(array $data): self
    {
        $this->requestData = $data;

        return $this;
    }

    public function getRequestDataForRequest(): string
    {
        return http_build_query($this->requestData);
    }

    /**
     * @return Method
     */
    public function getMethod(): Method
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method): Request
    {
        $this->method = new Method($method);
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }



}
