<?php

namespace Finelf_Api_Sdk\DTO;

use stdClass;

class OfferDTO extends BaseDTO {
    public $id;
    public $name;
    public $product;
    public $productId;
    public $affiliateLink;
    public $prettyLink;
    public $displayName;
    public $isActive;
    public $entity;
    public $parameters;
    public $debtorsBases;

    public function __construct(stdClass $jsonObject) {
        parent::__construct($jsonObject);
    }

    protected function offersParameters(array $offersParameters) {
        if ( ! empty($offersParameters)) {
            foreach ($offersParameters as $offersParameter) {
                $this->parameters[$offersParameter->parameter->slug] = new ParameterDTO($offersParameter);
            }
        }
    }

    protected function offersDebtorsBases(array $offersDebtorsBases) {
        if ( ! empty($offersDebtorsBases)) {
            foreach ($offersDebtorsBases as $offersDebtorsBase) {
                $this->debtorsBases[$offersDebtorsBase->debtorsBaseId] = new DebtorsBaseDTO($offersDebtorsBase);
            }
        }
    }

    protected function entity($entity) {
        if ( ! empty($entity)) {
            $this->entity = new EntityDTO($entity);
        }
    }

    protected function product($product) {
        if ( ! empty($product)) {
            $this->product = new ProductDTO($product);
        }
    }
}
