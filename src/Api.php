<?php

namespace Finelf_Api_Sdk;

use function class_exists;
use function ucfirst;

class Api
{
    private static $instance;
    private $client;

    public static function getInstance(string $username, string $password, string $clientID, string $clientSecret, string $apiURL): Api
    {
        $can_connect = ! empty($username) && ! empty($password) && ! empty($clientID) && ! empty($clientSecret) && ! empty($apiURL);

        if ($can_connect && self::$instance === null) {
            self::$instance = new Api($username, $password, $clientID, $clientSecret, $apiURL);
        }

        return self::$instance;
    }

    public function __construct(string $username, string $password, string $clientID, string $clientSecret, string $apiURL)
    {
        $apiClient    = new ApiClient(
            [
                'username'     => $username,
                'password'     => $password,
                'clientID'     => $clientID,
                'clientSecret' => $clientSecret,
                'uri'          => $apiURL,
            ]
        );
        $this->client = $apiClient->createApiClient();
    }

    public function __get($name)
    {
        $class = 'Finelf_Api_Sdk\Modules\\'.ucfirst($name).'Module';

        if (class_exists($class)) {
            if ( ! isset($this->$name)) {
                $this->$name = new $class($this->client);
            }

            return $this->$name;
        }
    }
}
