<?php

namespace Finelf\Modules;

use Finelf\DTO\BankDTO;

class BankModule extends BaseModule {
    protected $baseRoute = 'bank/banks';

    public function getById(int $id): BankDTO {
        $data = new \stdClass();

        if ($id) {
            $data = parent::get($id);
        }

        return new BankDTO($data);
    }

}
