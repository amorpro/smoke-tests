<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:06
 */

namespace SmokeTests\Plugins\Response;

use SmokeTests\Http\Header;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class Headers extends Base
{

    public static function needToInitialize($config):bool
    {
        return isset($config['response']['headers']);
    }


    public static function extractConfig(array $config)
    {
        return $config['response']['headers'];
    }

    private function getHeadersToCheck(): array
    {
        if(!$this->config){
            return [];
        }

        if(!is_array($this->config)){
            $this->config = [$this->config];
        }

        return $this->config;
    }

    public function beforeHandle(Request $request, Response $response, array $plugins):void
    {
        // TODO: Implement beforeHandle() method.
    }

    public function afterHandle(Request $request, Response $response, array $plugins):void
    {
        $headers = $response->getHeaders();
        $headersToCheck = $this->getHeadersToCheck();
        foreach ($headersToCheck as $headerName => $headerValue) {
            $headerToCheck = new Header($headerName, $headerValue);

            $issetHeader = false;
            foreach($headers as $header){
                if($header->isEqualTo($headerToCheck)){
                    $issetHeader = true;
                    break;
                }
            }
            Assert::true($issetHeader, "Header $headerToCheck does not exist");
        }
    }


    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        // TODO: Implement onError() method.
    }
}
