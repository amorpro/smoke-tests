<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 13.08.2021
 * Time: 13:35
 */

namespace SmokeTests\Http\Helper;

class RegExpHelper
{
    public static function extractMethodHostUri($string): array
    {
        preg_match('/(.*)\s(https?:\/\/[^\/]*)?(.*)/', $string, $matches);

        [$fullMatch, $method, $host, $requestUri] = $matches;

        return [$method, $host, $requestUri];
    }
}