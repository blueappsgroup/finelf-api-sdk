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
    public $rate;

    protected function offers($offers) {
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->type][$offer->id] = new OfferDTO($offer);
            }

            ksort($this->offers);
        }
    }

    protected function lenderRatings($lenderRatings) {
        if (!empty($lenderRatings)) {
            $lenderRating = reset($lenderRatings);
            $this->rate = $lenderRating->rate;
        }
    }
}
