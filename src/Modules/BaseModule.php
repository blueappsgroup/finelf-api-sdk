<?php

namespace Finelf\Modules;

use GuzzleHttp\Client;

class BaseModule {
    protected $apiClient;

    public function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
    }
}