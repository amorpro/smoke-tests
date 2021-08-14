<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 21:52
 */

namespace SmokeTests\Config;

use Webmozart\Assert\Assert;

abstract class Base
{

    /**
     * @var Base
     */
    protected $next;

    public function setNext(Base $next): Base
    {
        $this->next = $next;

        return $this;
    }

    public function getFileExtension($filePath)
    {
        Assert::fileExists($filePath);

        return pathinfo($filePath, PATHINFO_EXTENSION);
    }

    public function load($filePath, $baseHost = null)
    {
        Assert::notEmpty($filePath, 'Tests config file path can not be empty.');
        Assert::fileExists((string)$filePath, 'Tests config file does not exists');

        if ($this->canProcess($filePath)) {
            $tests = $this->_loadDo($filePath);
            return $this->attachBaseHost($tests, $baseHost);
        } elseif ($this->next instanceof Base) {
            $tests = $this->next->load($filePath, $baseHost);
            return $this->attachBaseHost($tests, $baseHost);
        } else {
            throw new \InvalidArgumentException("Unsupported tests config file {$filePath}");
        }
    }

    abstract protected function canProcess($filePath): bool;

    abstract protected function _loadDo($filePath);

    /**
     * @param       $baseHost
     * @param array $tests
     * @return array|array[]
     */
    private function attachBaseHost(array $tests, $baseHost = null): array
    {
        return array_map(function ($test) use ($baseHost) {
            return $baseHost ? array_merge($test, ['host' => $baseHost]) : $test;
        }, $tests);
    }

}