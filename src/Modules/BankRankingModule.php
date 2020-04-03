<?php

namespace Finelf\Modules;

use Finelf\DTO\BankRankingDTO;

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
