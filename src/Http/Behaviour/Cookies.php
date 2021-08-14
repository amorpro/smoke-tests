<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 10:02
 */

namespace SmokeTests\Http\Behaviour;

use SmokeTests\Http\Cookie;

trait Cookies
{
    private $cookies     = [];



    /**
     * @return Cookie[]
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * @param array $cookies
     * @return $this
     */
    public function setCookies(array $cookies): self
    {
        $this->cookies = [];
        foreach ($cookies as $key => $value) {
            $this->addCookie($key, $value);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addCookie(string $key, string $value):self
    {
        $this->cookies[$key] = new Cookie($key, $value);
        return $this;
    }


}