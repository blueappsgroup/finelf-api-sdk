<?php

namespace Finelf_Api_Sdk\DTO;

class ProductDTO extends BaseDTO {
    public $id;
    public $name;
    public $productCategory;

    protected function productCategory($productCategory) {
        if ( ! empty($productCategory)) {
            $this->productCategory = new ProductCategoryDTO($productCategory);
        }
    }
}
