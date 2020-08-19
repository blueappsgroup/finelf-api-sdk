<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\EntityDTO;
use Finelf_Api_Sdk\DTO\OfferDTO;

class EntityModule extends BaseModule
{
    protected $baseRoute = 'entities';

    public function getById(int $id, string $relations = ''): EntityDTO {
        if (empty($id)) {
            return new EntityDTO([]);
        }

        if ( ! empty($relations)) {
            $id .= '?relations='.$relations;
        }

        return new EntityDTO(parent::get($id));
    }

    public function getOffersByEntityId(int $id): array {
        if (empty($id)) {
            return [];
        }

        $offers = parent::get($id.'/offers');
        $data = [];

        if ($offers) {
            foreach ($offers as $offer) {
                $data[] = new OfferDTO($offer);
            }
        }

        return $data;
    }

}
