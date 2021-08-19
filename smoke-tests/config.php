<?php

return [

    // Default host for all tests
    'host' => 'https://google.com',

    // Plugins who will be loaded for all tests
    'plugins' => [
        \SmokeTests\Plugins\Log\Console\Detailed::class,
    ],

    // Plugins who will be loaded only if it will be detected in the test itself (like: enabled, store, and etc)
    'detectable_plugins' => [

    ]
];