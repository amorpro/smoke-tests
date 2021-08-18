<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 18.08.2021
 * Time: 20:53
 */

namespace SmokeTests;

use SmokeTests\Plugins\Base;

class Runner
{
    /**
     * @var Base[]
     */
    private $plugins = [];

    public function run($testsDir, $baseHost, $testsFilter = null, array $plugins = [])
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
                $this->run($testsPath, $baseHost, $testsFilter, $plugins):
                $this->runTestFile($testsPath, $baseHost, $plugins);
        }
    }

    public function runTestFile($testsFilePath, $baseHost, array $plugins = [])
    {
        $tests = (new \SmokeTests\Config\Json())
            ->setNext(new \SmokeTests\Config\Php())
            ->load($testsFilePath, $baseHost);

        foreach ($tests as $test) {
            $handler = Handler::createFromConfig($test);
            foreach ($plugins as $plugin) {
                $handler->addPlugin(new $plugin);
            }

            $handler->handle();
        }
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

}