<?php

namespace Finelf_Api_Sdk\DTO;

class ProductCategoryDTO extends ParameterDTO {
    public $id;
    public $name;
    public $products;

    protected function products(array $products) {
        if (!empty($products)) {
            foreach ($products as $product) {
                $this->products[$product->id] = new ProductDTO($product);
            }
        }
    }
}
