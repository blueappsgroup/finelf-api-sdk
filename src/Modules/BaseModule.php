<?php

namespace Finelf\Modules;

use GuzzleHttp\Client;
use function json_decode;

abstract class BaseModule {
    protected $apiClient;
    protected $baseRoute;

    public function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;

        if (!isset($this->baseRoute)) {
            throw new \LogicException(get_class($this) . ' must have a $baseRoute');
        }
    }

    public function get(string $uri) {
        try {
            $response = $this->apiClient->get($uri);

            return json_decode($response->getBody());
        } catch (\Error $e) {
            error_log($e->getMessage());
        }
    }
}