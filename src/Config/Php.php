<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 21:52
 */

namespace SmokeTests\Config;

use Webmozart\Assert\Assert;

class Php extends Base
{
    public function canProcess($filePath):bool
    {
        return $this->getFileExtension($filePath) === 'php';
    }

    public function _loadDo($filePath)
    {
        return require $filePath;
    }
}