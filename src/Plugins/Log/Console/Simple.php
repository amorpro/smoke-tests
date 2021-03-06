<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 9:19
 */

namespace SmokeTests\Plugins\Log\Console;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;

class Simple extends Base
{


    public static function needToInitialize(array $config): bool
    {
        return false;
    }

    public function beforeHandle(Request $request, Response $response, array $plugins):void
    {

    }

    public function afterHandle(Request $request, Response $response, array $plugins):void
    {
        echo '.';
    }

    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        echo 'E';
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function extractConfig(array $config)
    {
        return null;
    }
}