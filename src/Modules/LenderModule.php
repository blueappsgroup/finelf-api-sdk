<?php

namespace Finelf\Modules;

use Finelf\DTO\LenderDTO;

class LenderModule extends BaseModule {
    protected $baseRoute = 'lenders';

    public function getById(int $id) : LenderDTO {
        $data = new \stdClass();

        if($id) {
            $data = parent::get($id);
        }

        return new LenderDTO($data);
    }

}
