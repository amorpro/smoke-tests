<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 23:36
 */

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// Load composer autoload
$autoloadPaths = [
    __DIR__ . '/../../../autoload.php',
    __DIR__ . '/../../autoload.php',
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/vendor/autoload.php',
];

foreach ($autoloadPaths as $file) {
    if (file_exists($file)) {
        define('SMOKE_TESTS_CALLED_PROJECT_AUTOLOAD_PATH', $file);
        break;
    }
}

if (!defined('SMOKE_TESTS_CALLED_PROJECT_AUTOLOAD_PATH')) {
    die('Enable to find the autoload path');
}

require_once SMOKE_TESTS_CALLED_PROJECT_AUTOLOAD_PATH;



// Defile global paths constants
define('SMOKE_TESTS_CALLED_PROJECT_PATH', realpath(dirname(SMOKE_TESTS_CALLED_PROJECT_AUTOLOAD_PATH) . '/../'));
define('SMOKE_TESTS_CALLED_PROJECT_TESTS_DIR', SMOKE_TESTS_CALLED_PROJECT_PATH . '/smoke-tests');
define('SMOKE_TESTS_CALLED_PROJECT_CONFIG_FILE', SMOKE_TESTS_CALLED_PROJECT_TESTS_DIR . '/config.php');

define('SMOKE_TESTS_TEMPLATES_DIR', dirname(__DIR__) . '/templates');



// Prepare smoke tests directory
$testsDir = SMOKE_TESTS_CALLED_PROJECT_TESTS_DIR;
if($isEmptyProject = !is_dir($testsDir)) {
    if (!mkdir($testsDir, 0777, true) && !is_dir($testsDir)) {
        cli\err(sprintf('Directory "%s" was not created', $testsDir));
        die();
    }

    cli\line(sprintf( 'Smoke tests directory was created: %s', $testsDir));
}



// Prepare config file
$configFile = SMOKE_TESTS_CALLED_PROJECT_CONFIG_FILE;
$configs = [];
if(!file_exists($configFile)){
    $configFileTemplate = SMOKE_TESTS_TEMPLATES_DIR . '/config.php';

    if(!copy($configFileTemplate, $configFile)){
        cli\err(sprintf('Smoke tests config file "%s" was not created', $configFile));
        die();
    }

    cli\line(sprintf('Smoke tests config file was created: %s', $configFile));
}


// Init called project with example test file
if($isEmptyProject) {
    $testFileTemplate = SMOKE_TESTS_TEMPLATES_DIR . '/test.php';
    $testsFile        = $testsDir . '/index.php';

    if(!copy($testFileTemplate, $testsFile)){
        cli\err(sprintf('File with tests "%s" was not created', $testsFile));
        die();
    }

    cli\line(sprintf('Example test file was created: %s', $testsFile));
}


// Load configs
$configs = require $configFile;
if(!is_array($configs) || !count($configs)){
    cli\line( sprintf('%s format error, see %s.', $configFile, $configFileTemplate));
}

// Load input arguments
$testsFilter = $_SERVER['argv'][1];


(new \SmokeTests\Runner())->run($testsDir, $configs['host'], $testsFilter, $configs['plugins']);

