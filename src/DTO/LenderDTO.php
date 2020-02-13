<?php

namespace Finelf\DTO;

class LenderDTO extends BaseDTO {
    public $id;
    public $name;
    public $company;
    public $phoneNumber;
    public $postCode;
    public $city;
    public $street;
    public $nip;
    public $regon;
    public $capital;
    public $krs;
    public $email;
    public $www;
    public $logo;
    public $offers;

    public function offers($offers) {
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->id] = new OfferDTO($offer);
            }
        }
    }
}
