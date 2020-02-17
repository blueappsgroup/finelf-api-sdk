<?php

namespace Finelf\Modules;

class OfferModule extends BaseModule {
    protected $baseRoute = 'offers';

    public function get($id) {
        $data = parent::get('/' . $this->baseRoute . '/' . $id);

        return $data;
    }
}
