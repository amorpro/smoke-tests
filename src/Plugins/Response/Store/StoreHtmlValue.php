<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 1:12
 */

namespace SmokeTests\Plugins\Response\Store;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\AbstractNode;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class StoreHtmlValue extends \SmokeTests\Plugins\Response\Store\Base
{

    /**
     * @param array $config
     * @return bool
     */
    public static function needToInitialize(array $config): bool
    {
        return isset($config['response']['store_html_value']);
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function extractConfig(array $config)
    {
        $configs = $config['response']['store_html_value'];
        return $configs;
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

        Assert::isArray($vars, 'store_html_value command should be key => value array where key is a variable name and value is a html selector');

        $dom = new Dom();
        $dom->loadStr($response->getBody());
        foreach($vars as $varName => $htmlSelector) {
            /** @var AbstractNode $htmlElement */
            $htmlElement = $dom->find($htmlSelector)[0];

            if(!$htmlElement) {
                Assert::false(false, sprintf('StoreHtmlValue selector "%s" for variable "%s" not found', $htmlSelector,
                                             $varName));
            }

            self::$store[sprintf(self::VARIABLES_MASK, $varName) ] = $htmlElement->getAttribute('value');
        }
    }
}