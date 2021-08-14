<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 22:02
 */

return [
    [
        'uri'      => 'GET https://account.analvids.com/api/jdialog/pornworld.js',
        'response' => [
            'store_cookies' => 'jdialog3'
        ]
    ],
    [
        'uri'      => 'GET /',
    ],
    [
        'uri'      => 'GET /',
        'enabled' => false,
    ],
    [
        'uri'      => 'GET /',

        'response' => [
            'contains' => 'RECOMMENDED FOR YOU',
        ]
    ],
    [
        'uri'      => 'GET /',
        'response' => [
            'contains' => 'RECOMMENDED FOR YOU',
            'headers' => [
                \SmokeTests\Http\Header::CONTENT_TYPE => 'text/html;charset=UTF-8'
            ]
        ]
    ],
    [

        'uri'    => 'GET /api/user-data',
        'response' => [
            'store'  => 'username',
            'status' => 200,
        ],
    ],
    [
        'uri'      => 'GET /api/user-data?username={username}&jdialog={jdialog3}',
        'response' => [
            'contains' => 'is_authorized',
        ]
    ],
];