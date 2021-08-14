<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 16:58
 */

namespace SmokeTests;

use PHPUnit\Framework\TestCase;
use SmokeTests\Http\ContentType;
use Webmozart\Assert\InvalidArgumentException;

class ContentTypeTest extends TestCase
{

    public function testValidation(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ContentType('sdjfdkshf');
    }

    public function testGetType(): void
    {
        $contentType = new ContentType('text/plain');

        $this->assertEquals('text/plain', $contentType->getType());
        $this->assertTrue($contentType->isText());

    }

    public function testIsJson(): void
    {
        $contentType = new ContentType('application/json');

        $this->assertEquals('application/json', $contentType->getType());
        $this->assertTrue($contentType->isJson());

    }
}
