<?php

namespace SmokeTests\Plugins;

use SmokeTests\Handler;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use Throwable;

/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:01
 */

abstract class Base
{

    protected $config = [];
    protected $handler;

    /**
     * @param $config
     */
    public function __construct($config = null, Handler $handler = null)
    {
        $this->config = $config;
        $this->handler = $handler;

    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     * @return $this
     */
    public function setConfig($config): Base
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param Handler $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }



    /**
     * @param array $config
     * @return bool
     */
    abstract public static function needToInitialize(array $config):bool;

    /**
     * @param array $config
     * @return mixed
     */
    abstract public static function extractConfig(array $config);

    /**
     * @param Request  $request
     * @param Response $response
     * @param Base[]    $plugins
     */
    abstract public function beforeHandle(Request $request, Response $response, array $plugins):void;

    /**
     * @param Request  $request
     * @param Response $response
     * @param Base[]    $plugins
     */
    abstract public function afterHandle(Request $request, Response $response, array $plugins ):void;

    /**
     * @param Request   $request
     * @param Response  $response
     * @param Base[]     $plugins
     * @param Throwable $e
     */
    abstract public function onError(Request $request, Response $response, array $plugins, Throwable $e):void;

}
