<?php

namespace Finelf\Modules;

use Finelf\DTO\LenderDTO;

class LenderModule extends BaseModule {
    protected $baseRoute = 'lenders';

    public function get($id) {
        $data = parent::get('/' . $this->baseRoute . '/' . $id);

        return new LenderDTO($data);
    }
}
