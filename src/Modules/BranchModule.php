<?php

namespace Finelf_Api_Sdk\Modules;

use Finelf_Api_Sdk\DTO\BranchDTO;

class BranchModule extends BaseModule {
    protected $baseRoute = 'branches';

    public function getById(int $id) : BranchDTO {
        if (empty($id)) {
            return new BranchDTO(new \stdClass());
        }

        return new BranchDTO(parent::get($id));
    }

}
