<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\EntityDTO;
use Finelf_Api_Sdk\DTO\OfferDTO;

class EntityModule extends BaseModule {
    const RELATIONS = [
        'branches',
        'data',
        'offers',
    ];
    protected $baseRoute = 'entities';

    public function getById(int $id, string $relations = '') : EntityDTO {
        $data = new \stdClass();

        if($id) {
            if (!empty($relations)) {
                $relationsArray = explode(',', $relations);
                $relations = '';

                if (!empty($relationsArray)) {
                    $relationsArray = array_intersect($relationsArray, self::RELATIONS);

                    if (!empty($relationsArray)) {
                        $relations = '?relations='.implode(',', $relationsArray);
                    }
                }
            }

            $data = parent::get($id.$relations);
        }

        return new EntityDTO($data);
    }

    public function getOffersByEntityId(int $id): array {
        $data = [];

        if($id) {
            $offers = parent::get($id.'/offers');

            if($offers) {
                foreach ($offers as $offer) {
                    $data[] = new OfferDTO($offer);
                }
            }
        }

        return $data;
    }

}
