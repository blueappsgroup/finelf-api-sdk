<?php

namespace Finelf_Api_Sdk\DTO;

class DebtorsBaseDTO extends BaseDTO {
    public $name;
    public $logo;

    protected function debtorsBase($debtorsBase) {
        $this->name = $debtorsBase->name;
        $this->logo = $debtorsBase->logo;
    }
}
