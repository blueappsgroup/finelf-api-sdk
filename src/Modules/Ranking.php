<?php

namespace Finelf\Modules;

class Ranking extends Module {
    protected $baseRoute = 'rankings';

    public function get($id) {
        return parent::get('/'.$this->baseRoute.'/' . $id . '/details');
    }
}
