<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:58
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\Method;
use Webmozart\Assert\InvalidArgumentException;

class MethodTest extends TestCase
{

    public function testGetMethodValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Method('sss');
    }

    public function testNew(): void
    {
        $method = new Method(Method::GET);

        $this->assertEquals('GET', $method->getMethod());
        $this->assertEquals('GET', (string)$method);
    }
}
