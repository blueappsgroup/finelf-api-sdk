<?php

namespace Finelf_Api_Sdk\DTO;

class BankDTO extends BaseDTO
{
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

    protected function offers($offers)
    {
        if ( ! empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->id] = new BankOfferDTO($offer);
            }

            ksort($this->offers);
        }
    }

    protected function bankRatings($bankRatings)
    {
        if ( ! empty($bankRatings)) {
            $bankRatings = reset($bankRatings);
            $this->rate  = $bankRatings->rate;
        }
    }
}
