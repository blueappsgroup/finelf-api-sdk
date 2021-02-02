<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\RankingDTO;

class RankingModule extends BaseModule {
    protected $baseRoute = 'rankings';

    public function getById(int $id, string $relations = '') : RankingDTO {
        if (empty($id)) {
            return new RankingDTO(new \stdClass());
        }

        if ( ! empty($relations)) {
            $id .= '?relations='.$relations;
        }

        return new RankingDTO(parent::get($id));
    }
}
