<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 1:12
 */

namespace SmokeTests\Plugins\Response;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class StoreCookies extends Base
{

    public const VARIABLES_MASK = '{%s}';

    public static $store = [];

    /**
     * @param array $config
     * @return bool
     */
    public static function needToInitialize(array $config): bool
    {
        return isset($config['response']['store_cookies']);
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function extractConfig(array $config)
    {
        return $config['response']['store_cookies'];
    }


    public function beforeHandle(Request $request, Response $response, array $plugins):void
    {
        if (!self::$store) {
            return;
        }

        // Process REQUEST
        $request->setUri($this->replaceVariables($request->getUri()));

        // ... process request arguments
        $requestData = [];
        foreach ($request->getRequestData() as $k => $v) {
            $requestData[$k] = $this->replaceVariables($v);
        }
        $request->setRequestData($requestData);

        // ... process headers
        $headers = [];
        foreach ($request->getHeaders() as $header) {
            $headers[$header->getName()] = $this->replaceVariables($header->getValue());
        }
        $request->setHeaders($headers);

        // ... process cookies
        $cookies = [];
        foreach ($request->getCookies() as $cookie) {
            $cookies[$cookie->getName()] = $this->replaceVariables($cookie->getValue());
        }
        $request->setCookies($cookies);


        // Process Plugins
        $selfClass = self::class;
        foreach ($plugins as $plugin) {
            if ($plugin instanceof $selfClass) {
                continue;
            }

            if(is_array($plugin->getConfig())) {
                $configs = [];
                foreach ($plugin->getConfig() as $k => $config) {
                    $configs[$k] = is_string($config)? $this->replaceVariables($config): $config;
                }
                $plugin->setConfig($configs);
            }

            if(is_string($plugin->getConfig())){
                $plugin->setConfig($this->replaceVariables($plugin->getConfig()));
            }
        }
    }

    private function replaceVariables($value): string
    {
        return strtr($value, self::$store);
    }

    public function afterHandle(Request $request, Response $response, array $plugins):void
    {
        if (!$response->isOk()) {
            return;
        }

        $vars = $this->getVariablesToExtract();
        if (!$vars) {
            return;
        }

        if (!is_array($vars)) {
            $vars = [$vars];
        }


        $cookies = $response->getCookies();
        Assert::notEmpty($cookies, 'store_cookie no cookies in response');
        if (!$cookies) {
            return;
        }

        foreach ($vars as $var) {
            $var = trim($var);
            if (isset($cookies[$var])) {
                self::$store[sprintf(self::VARIABLES_MASK, $var) ] = $cookies[$var];
            }
        }
    }

    /**
     * @return string|null|array
     */
    protected function getVariablesToExtract()
    {
        return $this->config;
    }

    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        // TODO: Implement onError() method.
    }
}