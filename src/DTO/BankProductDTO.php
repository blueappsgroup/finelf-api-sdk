<?php

namespace Finelf\DTO;

class BankProductDTO extends BaseDTO {
    public $id;
    public $name;
    public $bank;
    public $offers;

    protected function bank($bank) {
        if (!empty($bank)) {
            $this->bank = new BankDTO($bank);
        }
    }

    protected function offers($offers) {
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->type][$offer->id] = new BankOfferDTO($offer);
            }

            ksort($this->offers);
        }
    }
}
