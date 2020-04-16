<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\BankOfferDTO;

class BankOfferModule extends BaseModule {
    protected $baseRoute = 'bank/offers';

    public function getById(int $id): BankOfferDTO {
        $data = new \stdClass();

        if ($id) {
            $data = parent::get($id);
        }

        return new BankOfferDTO($data);
    }
}
