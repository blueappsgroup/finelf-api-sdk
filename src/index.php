<?php

require_once '../vendor/autoload.php';

$auth_data = [];
/*$auth_data = [
    'username'     => 'dominika',
    'password'     => 'test123!@#',
    'clientID'     => 'assistant',
    'clientSecret' => 'swiniokaras',
    'uri'          => 'http://localhost:3000',
];*/

$apiClient = new Finelf\ApiClient($auth_data);
$client    = $apiClient->createApiClient();

$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);
$builder->ignorePhpDocErrors(true);

try {
    $container = $builder->build();

    $container->set()
} catch (Exception $e) {
    error_log($e->getMessage());
}

/*try {
    $response = $client->get('/users');

    echo($response->getBody());
} catch (\GuzzleHttp\Exception\TransferException $e) {
    error_log($e->getMessage());
}*/
