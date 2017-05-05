<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Phpro\SoapClient\ClientBuilder;
use Phpro\SoapClient\ClientFactory;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;
use Soap\YourClient;
use SoapTypes\HelloWorld;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Tests\Logger;

error_reporting(E_ALL);
ini_set('display_errors', 1);
$app = new Silex\Application();
$app['debug'] = true;

$app->get('/filter/{search}', function ($search) use ($app) {
    $names = [
        'apple',
        'anny',
        'angus',
        'biff',
        'bogus',
        'billy',
        'candy',
        'cindy',
        'danny',
        'doris',
        'envy',
        'ernie'
    ];
    $filtered = array_filter($names, function ($item) use ($search) {
        return substr($item, 0, strlen($search)) === $search;
    });

    return new \Symfony\Component\HttpFoundation\Response(json_encode($filtered), 200, ['Content-Type' => 'application/json']);
});

$app->get('/soap', function () {

    $classMaps = [
        new ClassMap('helloWorld', \SoapTypes\HelloWorld::class),
        new ClassMap('applicationCredentials', \SoapTypes\ApplicationCredentials::class),
        new ClassMap('helloWorldResponse', \SoapTypes\HelloWorldResponse::class),
    ];


    $wsdl = 'http://silex.dev/hello-world.xml';
    $clientFactory = new ClientFactory(YourClient::class);
    $soapOptions = [
        'cache_wsdl' => WSDL_CACHE_NONE
    ];

    $clientBuilder = new ClientBuilder($clientFactory, $wsdl, $soapOptions);
    $clientBuilder->withLogger(new Logger());
    $clientBuilder->withEventDispatcher(new EventDispatcher());
    foreach ($classMaps as $classMap) {
        $clientBuilder->addClassMap($classMap);
    }

    $client = $clientBuilder->build();

    $response = $client->helloWorld(new HelloWorld('Heathcliff'));


    return new \Symfony\Component\HttpFoundation\Response(
        json_encode(
            ['soap_response' => $response->getReturn()]
        ),
        200,
        ['Content-Type' => 'application/json']
    );
});

$app->run();