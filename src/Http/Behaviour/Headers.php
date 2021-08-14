<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 10:01
 */

namespace SmokeTests\Http\Behaviour;

use SmokeTests\Http\Header;

trait Headers
{

    private $headers     = [];

    /**
     * @return Header[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = [];
        foreach ($headers as $key => $value) {
            $this->addHeader($key, $value);
        }
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Headers
     */
    public function addHeader(string $key, string $value): self
    {
        $this->headers[$key] = new Header($key, $value);
        return $this;
    }
}