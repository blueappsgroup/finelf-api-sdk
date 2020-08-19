<?php

namespace Finelf_Api_Sdk\DTO;

class ProductDTO extends BaseDTO {
    public $id;
    public $name;
    public $productCategory;
    public $offers;

    protected function productCategory(object $productCategory) {
        if ( ! empty($productCategory)) {
            $this->productCategory = new ProductCategoryDTO($productCategory);
        }
    }

    protected function offers(array $offers) {
        if ( ! empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->id] = new OfferDTO($offer);
            }
        }
    }
}
