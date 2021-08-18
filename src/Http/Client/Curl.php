<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 18:20
 */

namespace SmokeTests\Http\Client;

use RuntimeException;
use SmokeTests\Http\Header;
use SmokeTests\Http\Method;
use SmokeTests\Http\Request;

class Curl extends Base
{

    public function handle():void
    {
        $curl = $this->_initCurl($this->request);
        switch ($this->request->getMethod()) {
            case Method::GET:
                $this->_appendMethodGet($curl, $this->request);
                break;
            case Method::POST:
                $this->_appendMethodPost($curl, $this->request);
                break;
            case Method::DELETE:
            case Method::PUT:
                $this->_appendOtherMethod($curl, $this->request);
                break;
        }


        [$body, $duration, $httpCode, $contentType, $headers, $cookies] = $this->_request($curl);
        $this->response
            ->setBody($body)
            ->setDuration($duration)
            ->setHttpCode($httpCode)
            ->setContentType($contentType)
            ->setHeaders($headers)
            ->setCookies($cookies);

        $this->_checkCurlError($curl);
    }


    /**
     * @param Request $request
     * @return false|resource
     */
    private function _initCurl(Request $request)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $request->getFullUrl());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_NOBODY, 0); // TRUE to exclude the body from the output.
        return $curl;
    }

    protected function _appendMethodGet($curl, Request $test): void
    {
        $url = $test->getFullUrl();
        if ($test->getRequestDataForRequest()) {
            $url .= (strpos($url, '?') ? '&' : '?');
            $url .= $test->getRequestDataForRequest();
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $test->getHeadersForRequest());
        curl_setopt($curl, CURLOPT_URL, $url);
    }

    protected function _appendMethodPost($curl, Request $test): void
    {
        curl_setopt($curl, CURLOPT_POST, true);

        $params = $test->getRequestDataForRequest();
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $test->addHeader(Header::CONTENT_LENGTH, strlen($params));
        $cookies = $test->getHeadersForRequest();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $cookies);
    }

    protected function _appendOtherMethod($curl, Request $test): void
    {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $test->getMethod());

        $params = $test->getRequestDataForRequest();
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $test->addHeader('Content-Length', strlen($params));
        $headers = $test->getHeadersForRequest();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    private function _request($curl): array
    {
        $body   = curl_exec($curl);
        $info     = curl_getinfo($curl);

        $headerSize = $info['header_size'];
        $headerString = substr($body, 0, $headerSize);
        $body = substr($body, $headerSize);

        // Headers
        $headers = explode(PHP_EOL, $headerString);
        $result = [];
        foreach($headers as $header){
            [$headerName, $headerValue] = explode(':', $header, 2);
            $headerName = strtolower(trim($headerName));
            $headerValue = strtolower(trim($headerValue));

            if (!$headerName || !$headerValue){ // ignore invalid headers
                continue;
            }

            if(isset($headers[$headerName])){
                if(!is_array($headers[$headerName])){
                    $result[$headerName] = [$headers[$headerName]];
                }
                $result[$headerName][] = $headerValue;
            }else{
                $result[$headerName] = $headerValue;
            }
        }
        $headers = $result;

        // Cookies
        $cookieHeader = $headers[strtolower(Header::SET_COOKIE)];
        if(!is_array($cookieHeader)){
            $cookieHeader = [$cookieHeader];
        }
        foreach($cookieHeader as $cookieString){
            $cookies = explode(';', $cookieString);

            $result = [];
            foreach($cookies as $cookie){
                [$cookieName, $cookieValue] = explode('=', $cookie);
                if(!$cookieName || !$cookieValue){
                    continue;
                }
                $result[$cookieName] = $cookieValue;
            }
        }
        $cookies = $result;


        return [$body, ($info['total_time'] * 1000), $info['http_code'], $info['content_type'], $headers, $cookies];
    }

    protected function _checkCurlError($curl): void
    {
        $errNo   = curl_errno($curl);
        $message = curl_error($curl);
        curl_close($curl);
        if ($errNo) {
            throw new RuntimeException('Error on request: ' . $message);
        }
    }

}