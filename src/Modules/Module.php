<?php

namespace Finelf\Modules;

use GuzzleHttp\Client;

abstract class Module {
    protected $apiClient;
    protected $baseRoute;

    public function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
        if(!isset($this->baseRoute))
            throw new \LogicException(get_class($this) . ' must have a $baseRoute');
    }

    public function get(string $uri) {
        try {
            $response = $this->apiClient->get($uri);

            return $response->getBody();
        } catch (\Error $e) {
            error_log($e->getMessage());
        }
    }
}
