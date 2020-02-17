<?php

namespace Finelf\Modules;

use Finelf\DTO\RankingDTO;

class RankingModule extends BaseModule {
    protected $baseRoute = 'rankings';

    public function get($id) {
        $data = parent::get('/' . $this->baseRoute . '/' . $id);

        return new RankingDTO($data);
    }
}
