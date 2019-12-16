<?php

namespace Finelf\Modules;

use GuzzleHttp\Client;

abstract class BaseModule {
    protected $apiClient;
    protected $apiController;

    public function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function get(string $uri) {
        try {
            $response = $this->apiClient->get($uri);

            return $response->getBody();
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            error_log($e->getMessage());
        }
    }
}
