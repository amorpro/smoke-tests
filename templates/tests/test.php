<?php

return [
    [
        'uri'      => 'GET /',
        'response' => [
            'contains' => ['<body'],
        ],
    ],


/*    [
        // (Optional) can be filled automatically via config loader (see Config topic above)
        'host' => 'http://landing',

        // (Required) Format for the url: (GET|POST|PUT|DELETE) [HOST, optional, override host config from above]/(uri)
        'uri'      => 'GET http/site.com/new_scenes',

        // (Optional) During the test the headers from bellow will be attached to the http request as POST or GET data
        'data' => [
            'username' => 'amorpro3'
        ],

        // (Optional) During the test the headers from bellow will be attached to the http request
        'headers' => [
            'Content-Type' => 'application/json'
        ],

        // (Optional) During the tests the cookies from bellow will be attached to the http request
        'cookies' => [
            'is_authorize' => 111
        ],

        // (Optional, default=true) If the enabled=false then test will be not called
        'enabled' => true,

        // (Optional) Contains the actions that need to be done with the http response
        'response' => [

            // VALIDATION options

            // (Optional) SmokeTests\Plugins\Response\Status
            // Will check that the result contains 404 http_code
            'status' => 404,

            // (Optional) SmokeTests\Plugins\Response\Contains
            // Will check that the result contains provided string or strings
            'contains' => 'recommended',
            'contains' => [
                'recommended',
                'scenes',
            ],

            // (Optional) SmokeTests\Plugins\Response\Cookies
            // Will check that the result contains cookies from below
            'cookies' => [
                'jdialog' => 't3a975ya71oubbcb6lag6y9wcmuhlfe9ia51uoegqmzinfcdfg',
            ],

            // (Optional) SmokeTests\Plugins\Response\Headers
            // Will check that the result contains headers from below
            'headers' => [
                'Content-Type' => 'text/plain',
            ],


            // UTILITY options

            // (Optional) SmokeTests\Plugins\Response\Store
            // Provide an ability to save keys username or username+email from the json response
            // globally to be able to use them in the next tests via {username} ot {email}
            // Stored vars can be used in next options: url, data, cookies, headers.
            // Full example can be found bellow in the "Store and Store Cookies example" topic
            'store' => 'username',
            'store' => [
                'username',
                'email',
            ],

            // (Optional) SmokeTests\Plugins\Response\StoreCookies
            // The same as Store utility from above but the variables will be taken
            // from the cookies that were returned in response.
            'store_cookies' => 'jdialog3',
            'store_cookies' => [
                'jdialog3',
                'is_authorized',
            ],

            // (Optional) SmokeTests\Plugins\Response\StoreHtmlText
            // The same as Store utility from above but the variables will be taken
            // from the text of the html element that were returned in response.
            'store_html_text' => [
                'join_label' => '.__join-us'
            ]

            // (Optional) SmokeTests\Plugins\Response\StoreHtmlValue
            // The same as Store utility from above but the variables will be taken
            // from the value of the html element that were returned in response.
            'store_html_value' => [
                'csrf' => 'input[name=csrf]'
            ],
        ],
    ]*/

];