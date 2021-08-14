<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 21:52
 */

namespace SmokeTests\Config;

class Json extends Base
{
    public function canProcess($filePath): bool
    {
        return $this->getFileExtension($filePath) === 'json';
    }

    public function _loadDo($filePath)
    {
        return json_decode(file_get_contents($filePath), true);
    }
}