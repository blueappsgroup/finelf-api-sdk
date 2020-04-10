<?php

namespace Finelf\DTO;

use function json_decode;

class BankOfferTypeDTO extends ParameterDTO {
    public $id;
    public $name;
    public $offers;
    public $product;

    protected function offers($offers) {
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->type][$offer->id] = new BankOfferDTO($offer);
            }

            ksort($this->offers);
        }
    }

    protected function product($product) {
        if (!empty($product)) {
            $this->product = new BankProductDTO($product);
        }
    }
}
