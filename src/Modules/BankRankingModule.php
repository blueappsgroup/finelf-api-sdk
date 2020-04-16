<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\BankRankingDTO;

class BankRankingModule extends BaseModule {
    protected $baseRoute = 'bank/rankings';

    public function getById(int $id) : BankRankingDTO {
        $data = new \stdClass();

        if($id) {
            $data = parent::get($id);
        }

        return new BankRankingDTO($data);
    }
}
