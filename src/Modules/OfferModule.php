<?php

namespace Finelf\Modules;

use Finelf\DTO\OfferDTO;

class OfferModule extends BaseModule {
    protected $baseRoute = 'offers';

    public function getById(int $id): OfferDTO {
        $data = new \stdClass();

        if ($id) {
            $data = parent::get($id);
        }

        return new OfferDTO($data);
    }

    public function getTopRatedByUs(int $websiteId, int $type, int $count = 10) : array {
        $data = parent::get('top-rated-by-us/' . $count . '/' . $type . '/' . $websiteId);

        return $data->offers;
    }

    public function getTopRatedByUsers(int $websiteId, int $type, int $count = 10) : array {
        $data = parent::get('top-rated-by-users/' . $count . '/' . $type . '/' . $websiteId);

        return $data->offers;
    }
}
