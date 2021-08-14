<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:49
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\Cookie;

class CookieTest extends TestCase
{

    public function test(): void
    {
        $cookie = new Cookie('name', 'value');

        $this->assertEquals('name', $cookie->getName());
        $this->assertEquals('value', $cookie->getValue());
        $this->assertEquals('name=value', (string)$cookie);
    }
}
