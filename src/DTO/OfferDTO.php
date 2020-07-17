<?php

namespace Finelf_Api_Sdk\DTO;

use stdClass;

class OfferDTO extends BaseDTO {
    protected $rankingsParametersPriority = [];
    public $id;
    public $name;
    public $product;
    public $affiliateLink;
    public $prettyLink;
    public $isActive;
    public $entity;
    public $parameters;
    public $debtorsBases;

    public function __construct(stdClass $jsonObject, $rankingsParametersPriority = []) {
        $this->rankingsParametersPriority = $rankingsParametersPriority;

        parent::__construct($jsonObject);
    }

    protected function offersParameters($offersParameters) {
        if (!empty($offersParameters)) {
            if (!empty($this->rankingsParametersPriority)) {
                return $this->offersParametersForRanking($offersParameters);
            }

            foreach ($offersParameters as $offersParameter) {
                $this->parameters[$offersParameter->parameter->slug] = new ParameterDTO($offersParameter);
            }
        }
    }

    protected function offersParametersForRanking($offerParameters) {
        foreach ($offerParameters as $offerParameter) {
            if (isset($this->rankingsParametersPriority[$offerParameter->parameter->slug])) {
                $this->parameters[$offerParameter->parameter->slug] = new ParameterDTO($offerParameter);
            }
        }
    }

    protected function offersDebtorsBases($offersDebtorsBases) {
        if (!empty($offersDebtorsBases)) {
            foreach ($offersDebtorsBases as $offersDebtorsBase) {
                $this->debtorsBases[$offersDebtorsBase->debtorsBaseId] = new DebtorsBaseDTO($offersDebtorsBase);
            }
        }
    }

    protected function entity($entity) {
        if (!empty($entity) && is_object($entity)) {
            $this->entity = new EntityDTO($entity);
        }
    }

    protected function product($product) {
        if (!empty($product) && is_object($product)) {
            $this->product = new ProductDTO($product);
        }
    }
}
