<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:08
 */

namespace SmokeTests;


use SmokeTests\Http\Client\Curl;
use SmokeTests\Http\Request;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Base;
use SmokeTests\Plugins\Enabled;
use SmokeTests\Plugins\Exception\SkipTest;
use SmokeTests\Plugins\Response\Contains;
use SmokeTests\Plugins\Response\Headers;
use SmokeTests\Plugins\Response\Status;
use SmokeTests\Plugins\Response\Store;
use SmokeTests\Plugins\Response\StoreCookies;
use Throwable;

class Handler
{

    /**
     * Predefined values for test
     */
    private const TEST_DEFAULT_VALUES = [
        'enabled'  => true,

        'response' => [
            'status' => 200
        ]
    ];

    /**
     * Plugins who will be automatically detected and attached to the handler
     */
    private const DETECTABLE_PLUGIN_CLASSES = [
        Enabled::class,
        Status::class,
        Contains::class,
        Headers::class,
    ];

    /**
     * @var Base
     */
    private $plugins = [];

    /**
     * @var Request
     */
    private $test;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Http\Client\Base
     */
    private $client;


    /**
     * @param array    $testConfig
     * @param null     $host
     * @param Response $response
     * @return Handler
     */
    public static function createFromConfig(array $testConfig, $httpClientClass = null, array $detectablePlugins = []):
    Handler
    {
        // set Default values to the test
        $testConfig = array_merge(self::TEST_DEFAULT_VALUES, $testConfig);

        $handler = new self(Request::createFromArray($testConfig), $httpClientClass);

        // Detect and initialize plugins from the test
        $detectablePlugins = array_merge(self::DETECTABLE_PLUGIN_CLASSES, $detectablePlugins);
        foreach($detectablePlugins as $pluginClass){
            /** @var Base $pluginClass */
            if($pluginClass::needToInitialize($testConfig)){
                $pluginConfig = $pluginClass::extractConfig($testConfig);
                $handler->addPlugin(new $pluginClass($pluginConfig));
            }
        }

        $handler->addPlugin(new Store(Store::extractConfig($testConfig)));
        $handler->addPlugin(new StoreCookies(StoreCookies::extractConfig($testConfig)));

        return $handler;
    }


    /**
     * @param Request  $test
     * @param Response $response
     * @param null     $httpClientClass
     */
    public function __construct(Request $test, $httpClientClass = null)
    {
        if(!$httpClientClass){
            $httpClientClass = Curl::class;
        }

        $this->test     = $test;
        $this->response = new Response();
        $this->client = new $httpClientClass($test, $this->response);
    }

    /**
     * @param Base $plugin
     * @return $this
     */
    public function addPlugin(Base $plugin): Handler
    {
        $this->plugins[] = $plugin->setHandler($this);
        return $this;
    }

    public function handle()
    {
        try {
            $this->beforeHandle();
            $this->client->handle();

            $this->afterHandle();
        } catch (Throwable $e) {
            $this->onError($e);
        }
    }

    private function beforeHandle(): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->beforeHandle($this->test, $this->response, $this->plugins);
        }
    }

    private function afterHandle(): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->afterHandle($this->test, $this->response, $this->plugins);
        }
    }
    private function onError(Throwable $e): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->onError($this->test, $this->response, $this->plugins, $e);
        }
    }

}
