<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 18.08.2021
 * Time: 20:53
 */

namespace SmokeTests;

use SmokeTests\Http\Client\Curl;
use SmokeTests\Plugins\Base;

use Webmozart\Assert\Assert;

use function cli\line;

class Runner
{
    /**
     * @var Base[]
     */
    private $plugins = [];

    public function run($testsDir, $configs, $testsFilter = null)
    {
        foreach (scandir($testsDir) as $testFileName) {
            if(in_array($testFileName,['.','..', 'config.php'])){
                continue;
            }

            $testsPath = $testsDir . DIRECTORY_SEPARATOR . $testFileName;

            if($testsFilter && stripos($testsPath, $testsFilter) === false){
                continue;
            }

            is_dir($testsPath) ?
                $this->run($testsPath, $configs, $testsFilter):
                $this->runTestFile($testsPath, $configs);
        }
    }

    public function runTestFile($testsFilePath, array $config)
    {
        Assert::notEmpty($config, 'Config data can not be empty');

        $baseHost = $config['host'];
        Assert::startsWith($baseHost, 'http');

        $plugins = $config['plugins'] ?? [];
        $detectablePlugins = $config['detectable_plugins'] ?? [];


        $this->printTestFile($testsFilePath);

        $tests = (new \SmokeTests\Config\Json())
            ->setNext(new \SmokeTests\Config\Php())
            ->load($testsFilePath, $baseHost);

        foreach ($tests as $test) {
            $handler = Handler::createFromConfig($test, Curl::class, $detectablePlugins);
            foreach ($plugins as $plugin) {
                $handler->addPlugin(new $plugin);
            }

            $handler->handle();
        }

        line();
    }

    /**
     * @param Base $plugin
     * @return $this
     */
    public function addPlugin(Base $plugin):Base
    {
        $this->plugins[] = $plugin;
        return $this;
    }

    private function printTestFile($testsFilePath)
    {
        $testName = str_replace(realpath(SMOKE_TESTS_CALLED_PROJECT_TESTS_DIR) . DIRECTORY_SEPARATOR, '',
                                realpath($testsFilePath));
        $testNameDecoratorLine = str_repeat('-', 60-strlen($testName));
        line(sprintf('%s %s', $testName, $testNameDecoratorLine));
    }

}