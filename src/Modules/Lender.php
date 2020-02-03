<?php

namespace Finelf\Modules;

class Lender extends Module {
    protected $baseRoute = 'lenders';

    public function get($id) {
        return parent::get('/'.$this->baseRoute.'/' . $id);
    }
}
