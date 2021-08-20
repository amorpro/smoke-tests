<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 1:12
 */

namespace SmokeTests\Plugins\Response\Store;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use Webmozart\Assert\Assert;

class Store extends \SmokeTests\Plugins\Response\Store\Base
{

    /**
     * @param array $config
     * @return bool
     */
    public static function needToInitialize(array $config): bool
    {
        return isset($config['response']['store']);
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function extractConfig(array $config)
    {
        return $config['response']['store'];
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

        $json = $response->getJson();
        if (!$json) {
            return;
        }

        foreach ($vars as $var) {
            Assert::true(isset($json[$var]), sprintf('Store variable not found: %s', $var));

            self::$store[sprintf(self::VARIABLES_MASK, $var) ] = $json[$var];
        }
    }
}