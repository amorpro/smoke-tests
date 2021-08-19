<?php

namespace YourProject\SmokeTests\Plugins;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;

/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 19.08.2021
 * Time: 10:14
 */
class Example extends Base
{
    public static function needToInitialize(array $config): bool
    {
        return isset($config['example']);
    }

    public static function extractConfig(array $config)
    {
        return $config['example'];
    }

    public function beforeHandle(Request $request, Response $response, array $plugins ): void
    {
        cli\line('BEFORE handle the test');
    }

    public function afterHandle(Request $request, Response $response, array $plugins): void
    {
        cli\line('AFTER handle the test');
    }

    public function onError(Request $request, Response $response, array $plugins, Throwable $e ): void
    {
        cli\err('ERROR was thrown during the test');
    }
}