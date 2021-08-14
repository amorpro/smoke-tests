<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:43
 */

namespace SmokeTests\Http;

use Webmozart\Assert\Assert;

class Method
{
    public const GET    = 'GET';
    public const POST   = 'POST';
    public const PUT    = 'PUT';
    public const DELETE = 'DELETE';

    public const METHODS = [
        self::GET,
        self::POST,
        self::PUT,
        self::DELETE,
    ];

    private $method;

    /**
     * @param string $method
     */
    public function __construct(string $method = self::GET)
    {
        Assert::inArray($method, self::METHODS);

        $this->method = $method;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMethod();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

}