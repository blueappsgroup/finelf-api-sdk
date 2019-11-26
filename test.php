<?php

require_once 'vendor/autoload.php';

$auth_data = [
	'username' => 'Dominika',
	'password' => 'test123!@#',
	'uri'      => 'http://localhost:3000',
];

$apiClient = new Ranking\ApiClient( $auth_data );
$client = $apiClient->createApiClient();

try {
    $response = $client->get('/users');
    var_dump($response->);exit;
    echo($response->getBody());
} catch (TransferException $e) {
    echo $e->getMessage();
}
