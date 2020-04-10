<?php

namespace Finelf\DTO;

class BankProductDTO extends BaseDTO {
    public $id;
    public $name;
    public $bank;
    public $offersTypes;

    protected function offersTypes($offersTypes) {
        if (!empty($offersTypes)) {
            foreach ($offersTypes as $offersType) {
                $this->offersTypes[$offersType->id] = new BankOfferTypeDTO($offersType);
            }

            ksort($this->offersTypes);
        }
    }
}
