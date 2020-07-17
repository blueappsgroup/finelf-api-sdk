<?php

namespace Finelf_Api_Sdk\DTO;

use function json_decode;

class ProductCategoryDTO extends ParameterDTO {
    public $id;
    public $name;
    public $offers;
    public $products;

    protected function offers($offers) {
        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->type][$offer->id] = new OfferDTO($offer);
            }

            ksort($this->offers);
        }
    }

    protected function products($products) {
        if (!empty($products)) {
            foreach ($products as $product) {
                $this->products[$product->id] = new ProductDTO($product);
            }

            ksort($this->products);
        }
    }
}
