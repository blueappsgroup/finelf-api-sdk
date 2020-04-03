<?php

namespace Finelf\DTO;

class BankDTO extends BaseDTO {
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
    public $products;
    public $rate;

    protected function products($products) {
        if (!empty($products)) {
            foreach ($products as $product) {
                $this->products[$product->id] = new BankProductDTO($product);
            }

            ksort($this->products);
        }
    }

    protected function bankRatings($bankRatings) {
        if (!empty($bankRatings)) {
            $bankRatings = reset($bankRatings);
            $this->rate = $bankRatings->rate;
        }
    }
}
