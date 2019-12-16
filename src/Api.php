<?php

namespace Finelf;

use function class_exists;
use function ucfirst;

class Api {
    private $client;

    public function __construct(string $username, string $password, string $clientID, string $clientSecret, string $apiURL) {
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
