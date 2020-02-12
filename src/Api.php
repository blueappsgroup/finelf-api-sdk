<?php

namespace Finelf;

use function class_exists;
use function ucfirst;

class Api {
    private $client;

    public static function getInstance(string $username, string $password, string $clientID, string $clientSecret, string $apiURL) {
        self::$client = new Api($username, $password, $clientID, $clientSecret, $apiURL);
    }

    private function __construct(string $username, string $password, string $clientID, string $clientSecret, string $apiURL) {
        $apiClient = new ApiClient([
            'username'     => $username,
            'password'     => $password,
            'clientID'     => $clientID,
            'clientSecret' => $clientSecret,
            'uri'          => $apiURL,
        ]);
        $this->client = $apiClient->createApiClient();
    }


    public function __get($name) {
        $class = 'Finelf\Modules\\'.ucfirst($name);

        if (class_exists($class)) {
            $this->$name = new $class($this->client);
            return $this->$name;
        }
    }
}
