<?php

namespace Finelf_Api_Sdk\Modules;

use function array_intersect;
use function explode;
use Finelf_Api_Sdk\DTO\OfferDTO;
use function implode;
use function in_array;

class OfferModule extends BaseModule {
    const RELATIONS = [
        'entity',
        'product',
        'parameters',
        'debtorsBases',
    ];
    protected $baseRoute = 'offers';

    public function getById(int $id, string $relations = ''): OfferDTO {
        $data = new \stdClass();

        if ($id) {
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

        return new OfferDTO($data);
    }

}
