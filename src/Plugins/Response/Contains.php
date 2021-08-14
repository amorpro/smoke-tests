<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:06
 */

namespace SmokeTests\Plugins\Response;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class Contains extends Base
{

    public static function needToInitialize($config):bool
    {
        return isset($config['response']['contains']);
    }


    public static function extractConfig(array $config)
    {
        return $config['response']['contains'];
    }

    private function getContainsToCheck(): array
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
        $checkData = $this->getContainsToCheck();
        foreach ($checkData as $data) {
            Assert::contains($response->getBody(), $data, 'Response body does not contains ' . $data);
        }
    }


    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        // TODO: Implement onError() method.
    }
}
