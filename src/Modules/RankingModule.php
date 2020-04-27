<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\RankingDTO;

class RankingModule extends BaseModule {
    protected $baseRoute = 'rankings';

    public function getById(int $id) : RankingDTO {
        $data = new \stdClass();

        if($id) {
            $data = parent::get($id);
        }

        return new RankingDTO($data);
    }
}
