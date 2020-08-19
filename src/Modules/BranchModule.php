<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\BranchDTO;

class BranchModule extends BaseModule {
    protected $baseRoute = 'branches';

    public function getById(int $id) : BranchDTO {
        $data = new \stdClass();

        if($id) {
            $data = parent::get($id);
        }

        return new BranchDTO($data);
    }

}
