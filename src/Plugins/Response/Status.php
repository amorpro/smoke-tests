<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 8:56
 */

namespace SmokeTests\Plugins\Response;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class Status extends Base
{

    public static function needToInitialize(array $config): bool
    {
        return isset($config['response']['status']);
    }


    public static function extractConfig(array $config)
    {
        return $config['response']['status'];
    }


    public function getExpectedStatus():int
    {
        return (int)$this->config;
    }

    public function beforeHandle(Request $request, Response $response, array $plugins):void
    {
        // TODO: Implement beforeHandle() method.
    }

    public function afterHandle(Request $request, Response $response, array $plugins):void
    {
        $response->setStatus(Response::STATUS_ERROR);

        Assert::true(
            $this->getExpectedStatus() === $response->getHttpCode(),
            sprintf('http_code: expected %s, got %s', $this->getExpectedStatus(), $response->getHttpCode())
        );

        $response->setStatus(Response::STATUS_OK);
    }

    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        // TODO: Implement onError() method.
    }
}