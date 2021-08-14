<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:06
 */

namespace SmokeTests\Plugins\Response;

use SmokeTests\Http\Cookie;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use Throwable;
use Webmozart\Assert\Assert;

class Cookies extends Base
{

    public static function needToInitialize($config):bool
    {
        return isset($config['response']['cookies']);
    }


    public static function extractConfig(array $config)
    {
        return $config['response']['cookies'];
    }

    private function getCookiesToCheck(): array
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
        $cookies = $response->getCookies();
        $cookiesToCheck = $this->getCookiesToCheck();
        foreach ($cookiesToCheck as $cookieName => $cookieValue) {
            $cookieToCheck = new Cookie($cookieName, $cookieValue);

            $issetCookie = false;
            foreach($cookies as $header){
                if($header->isEqualTo($cookieToCheck)){
                    $issetCookie = true;
                    break;
                }
            }
            Assert::true($issetCookie, "Cookie $cookieToCheck dose not exists");
        }
    }


    public function onError(Request $request, Response $response, array $plugins, Throwable $e):void
    {
        // TODO: Implement onError() method.
    }
}
