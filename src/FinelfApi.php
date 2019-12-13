<?php

namespace Finelf;

use function class_exists;
use function ucfirst;

class FinelfApi {
    private $apiURI = 'http://localhost:3000';
    private $apiClient;

    public function __construct($username, $password, $clientID = 'assistant', $clientSecret = 'swiniokaras') {
        $apiClient = new ApiClient([
            'username'     => $username,
            'password'     => $password,
            'clientID'     => $clientID,
            'clientSecret' => $clientSecret,
            'uri'          => $this->apiURI,
        ]);
        $this->apiClient = $apiClient->createApiClient();
    }


    public function __get($name) {
        $class = 'Finelf\Modules\\'.ucfirst($name);

        if (class_exists($class)) {
            $this->$name = new $class($this->apiClient);
            return $this->$name;
        }
    }
}