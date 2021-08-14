<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:38
 */

namespace SmokeTests\Http;

class Cookie
{
    private $name, $value;

    /**
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->name  = trim($name);
        $this->value = trim($value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s=%s', $this->name, $this->value);
    }


    /**
     * @param Cookie $cookie
     * @return bool
     */
    public function isEqualTo(Cookie $cookie): bool
    {
        return strtolower((string)$this->getName()) === strtolower((string)$cookie->getName())
            && strtolower((string)$this->getValue())=== strtolower((string)$cookie->getValue());
    }

}