<?php

namespace Finelf\Modules;

class Ranking extends BaseModule {
    protected $apiController = 'rankings';

    public function get(int $id) {
        return parent::get('/'.$this->apiController.'/' . $id . '/details');
    }
}
