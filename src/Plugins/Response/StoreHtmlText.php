<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 1:12
 */

namespace SmokeTests\Plugins\Response;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\AbstractNode;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class StoreHtmlText extends Base
{

    public const VARIABLES_MASK = '{%s}';

    public static $store = [];

    /**
     * @param array $config
     * @return bool
     */
    public static function needToInitialize(array $config): bool
    {
        return isset($config['response']['store_html_text']);
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function extractConfig(array $config)
    {
        $configs = $config['response']['store_html_text'];
        return $configs;
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

        Assert::isArray($vars, 'store_html_text command should be key => value array where key is a variable name and value is a html selector');

        $dom = new Dom();
        $dom->loadStr($response->getBody());
        foreach($vars as $varName => $htmlSelector) {
            /** @var AbstractNode $htmlElement */
            $htmlElement = $dom->find($htmlSelector)[0];

            if(!$htmlElement) {
                Assert::false(false, sprintf('StoreHtmlText selector "%s" for variable "%s" not found', $htmlSelector, $varName));
            }

            self::$store[sprintf(self::VARIABLES_MASK, $varName) ] = $htmlElement->text;
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