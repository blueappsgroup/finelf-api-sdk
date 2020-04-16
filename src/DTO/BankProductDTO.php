<?php

namespace Finelf_Api_Sdk\DTO;

class BankProductDTO extends BaseDTO {
    public $id;
    public $name;
    public $bank;
    public $productsTypes;

    protected function productsTypes($productsTypes) {
        if (!empty($productsTypes)) {
            foreach ($productsTypes as $productsType) {
                $this->$productsTypes[$productsType->id] = new BankProductTypeDTO($productsType);
            }

            ksort($this->productsType);
        }
    }
}
