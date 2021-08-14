<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 18:25
 */

namespace SmokeTests\Http\Client;

use SmokeTests\Http\Request;
use SmokeTests\Http\Response;

abstract class Base
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }



    abstract public function handle():void;

}