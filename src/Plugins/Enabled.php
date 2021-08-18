<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 22:28
 */

namespace SmokeTests\Plugins;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Exception\SkipTest;
use Throwable;
use Webmozart\Assert\Assert;

class Enabled extends Base
{

    public static function needToInitialize(array $config): bool
    {
        return isset($config['enabled']);
    }

    public static function extractConfig(array $config)
    {
        return $config['enabled'];
    }

    public function beforeHandle(Request $request, Response $response, array $plugins): void
    {
        Assert::true(
            $this->isEnabled(),
            sprintf(
                'Test [%s %s] is disabled',
                $request->getMethod(),
                $request->getFullUrl()
            )
        );
    }

    public function isEnabled(): bool
    {
        return (bool)$this->config;
    }

    public function afterHandle(Request $request, Response $response, array $plugins): void
    {
    }

    public function onError(Request $request, Response $response, array $plugins, Throwable $e): void
    {
        // TODO: Implement onError() method.
    }

}