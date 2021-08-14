<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:52
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\Header;
use Webmozart\Assert\InvalidArgumentException;

class HeaderTest extends TestCase
{

    public function testNameValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Header('fff', 'assa');
    }

    public function testValueValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Header(Header::ACCEPT_CHARSET, '');
    }

    public function testNew(): void
    {
        $header = new Header(Header::CONTENT_TYPE, 'text/plain');

        $this->assertEquals('text/plain', $header->getValue());
        $this->assertEquals(Header::CONTENT_TYPE, $header->getName());
        $this->assertEquals(sprintf('%s: %s', $header->getName(), $header->getValue()), (string)$header);
    }
}
