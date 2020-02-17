<?php

namespace Finelf\Modules;

class OfferModule extends BaseModule {
    protected $baseRoute = 'offers';

    public function get($id) {
        return parent::get('/' . $this->baseRoute . '/' . $id);
    }
}
