<?php

namespace Finelf_Api_Sdk\Modules;

use Error;
use GuzzleHttp\Client;
use LogicException;
use function json_decode;

abstract class BaseModule {
    protected $apiClient;
    protected $baseRoute;

    public function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;

        if (!isset($this->baseRoute)) {
            throw new LogicException(get_class($this) . ' must have a $baseRoute');
        }
    }

    public function get(string $uri = '') {
        try {
            $response = $this->apiClient->get('/api/' . $this->baseRoute . '/' . $uri);

            return json_decode($response->getBody());
        } catch (Error $e) {
            error_log($e->getMessage());
        }
    }

    public function post(string $uri = '') {
        try {
            $response = $this->apiClient->post('/api/' . $this->baseRoute . '/' . $uri);

            return json_decode($response->getBody());
        } catch (Error $e) {
            error_log($e->getMessage());
        }
    }
}
