<?php

namespace Finelf\Modules;

class Ranking extends BaseModule {
    public function get(int $id) {
        try {
            $response = $this->apiClient->get('/rankings/' . $id . '/details');

            echo($response->getBody());
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            error_log($e->getMessage());
        }
    }
}
