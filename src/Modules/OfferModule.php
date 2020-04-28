<?php

namespace Finelf_Api_Sdk\Modules;


use Finelf_Api_Sdk\DTO\OfferDTO;

class OfferModule extends BaseModule {
    protected $baseRoute = 'offers';

    public function getById(int $id): OfferDTO {
        $data = new \stdClass();

        if ($id) {
            $data = parent::get($id);
        }

        return new OfferDTO($data);
    }

}
