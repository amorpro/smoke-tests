<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 23:36
 */

use SmokeTests\Http\Header;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Display\Detailed;

$testsFilePath = $argv[1];

include_once '../vendor/autoload.php';

$tests = (new \SmokeTests\Config\Json())
    ->setNext(new \SmokeTests\Config\Php())
    ->load($testsFilePath, 'http://landing');

foreach ($tests as $test) {
    $handler = SmokeTests\Handler::createFromConfig($test);
    $handler->addPlugin(new \SmokeTests\Plugins\Display\Detailed());
    $response = $handler->handle();
}