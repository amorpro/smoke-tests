## Smoke tests SDK

Library for implementing smoke tests in a project.

#### Example

```php
<?

use SmokeTests\Http\Header;
use SmokeTests\Http\Response;
use SmokeTests\Plugins\Display\Detailed;

include_once './vendor/autoload.php';

$tests = (new \SmokeTests\Config\Json())
    ->setNext(new \SmokeTests\Config\Php())
    ->load('./configs/tests.json', 'http://landing');

foreach ($tests as $test) {
    $handler = SmokeTests\Handler::createFromConfig($test);
    $handler->addPlugin(new \SmokeTests\Plugins\Display\Detailed());
    $response = $handler->handle();
}

```

#### Result

[SmokeTests\Plugins\Log\Console\Detailed](src/Plugins/Display/Detailed.php) plugin<br/>
Will provide the detailed info about the tests and process

```
GET /api/jdialog/pornworld.js : OK
GET / : OK
GET / : OK
GET / : OK
ERROR Test [GET http://landing/api/user-data] is disabled
GET /api/user-data?username={username}&jdialog=jdialog3=t3a975ya71oubbcb6lag6y9wcmuhlfe9ia51uoegqmzinfcdfg : OK
```

[SmokeTests\Plugins\Log\Console\Simple](src/Plugins/Display/Simple.php) plugin<br/>
Will provide the minimum info about the tests, dot "." means OK, "E" means failed 
```
..E....
```

[SmokeTests\Plugins\Log\Console\Failed](src/Plugins/Display/Failed.php) plugin<br/>
Will provide the detailed info only by tests who failed
```
GET / : ERROR Test [GET http://landing/] is disabled
```

### Configs

Support the next type of config formats:

* [Php](smoke-tests/JsonExample.json)
* [Json](smoke-tests/ModuleName/PhpExample.php)

Minimum config loading code

```php
$tests = (new \SmokeTests\Config\Php())
    ->load('./configs/tests.php', 'http://landing');

```

### Minimum test example

```php
return [
    [
        'uri'      => 'GET /',
    ],
    [
        'uri'      => 'GET http://landing/',
    ],
    [
        // Will be overwrited with http:// google.com from the uri bellow
        'host' => 'http://landing', 
        'uri'      => 'GET http://google/',
    ],
]
```

In the first 2 tests will be called http://landing/ url and in the third test http://google.com. 
All tests will be called with GET method and in the minimum configuration only http_code = 200 will be tested.
Host that set in the uri have more high priority than in the 'host' option and will be used 
and will be used instead of it 


### Full test example

```php
return [
    [
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
        ],        
    ]
]
```

### Store and Store Cookies example 

Store and Store Cookies utilities helps you to do more complex tests with pre-loading of some data from the one test
and to use them after that in the any next tests

```php
return [

    // Request to get 'jdialog' cookie
    [
        'uri'      => 'GET https://account.analvids.com/api/jdialog/pornworld.js',
        'response' => [
            'store_cookies' => 'jdialog3'
        ]
    ],
    
    // Request to get 'website_user_id' and 'username' variables from the json response 
    [
        'uri'    => 'GET /api/user-data',
        'response' => [
            'store'  => 'website_user_id',
            'store'  => 'username',
        ],
    ],
    
    // Use 'jdialog', 'website_user_id' and 'username' to validate some data
    [
        'uri'      => 'GET /api/get-scenes?website_user_id={website_user_id}',
        'data' => [
            'website_user_id' => '{website_user_id}'
        ]       
        'response' => [
            'contains' => '{username}',
            'cookies' => [
                'jdialog3' => '{jdialog3}'
            ]           
        ]
    ],
];
```