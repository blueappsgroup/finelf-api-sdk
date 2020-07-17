<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\RankingDTO;

class RankingModule extends BaseModule {
    const RELATIONS = [
        'parameters',
        'offers',
    ];
    protected $baseRoute = 'rankings';

    public function getById(int $id, string $relations = '') : RankingDTO {
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

        return new RankingDTO($data);
    }
}
