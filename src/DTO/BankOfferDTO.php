<?php

namespace Finelf_Api_Sdk\DTO;

use stdClass;

class BankOfferDTO extends BaseDTO {
    protected $rankingParametersPriority = [];
    public $id;
    public $name;
    public $type;
    public $affiliateLink;
    public $prettyLink;
    public $isActive;
    public $bank;
    public $productType;
    public $parameters;
    public $rate;
    public $rankingName;

    public function __construct(stdClass $jsonObject, $rankingParametersPriority = []) {
        $this->rankingParametersPriority = $rankingParametersPriority;

        parent::__construct($jsonObject);
    }

    protected function offerParameters($offerParameters) {
        if (!empty($offerParameters)) {
            if (!empty($this->rankingParametersPriority)) {
                return $this->offerParametersForRanking($offerParameters);
            }

            foreach ($offerParameters as $offerParameter) {
                $this->parameters[$offerParameter->parameter->slug] = new BankParameterDTO($offerParameter);
            }
        }
    }

    protected function offerParametersForRanking($offerParameters) {
        foreach ($offerParameters as $offerParameter) {
            if (isset($this->rankingParametersPriority[$offerParameter->parameterId])) {
                $this->parameters[$this->rankingParametersPriority[$offerParameter->parameterId]] = new BankParameterDTO($offerParameter);
            }
        }

        ksort($this->parameters);
    }

    protected function bank($bank) {
        if (!empty($bank)) {
            $this->bank = new BankDTO($bank);
        }
    }

    protected function offerRatings($offerRatings) {
        if (!empty($offerRatings)) {
            $offerRatings = reset($offerRatings);
            $this->rate = $offerRatings->rate;
        }
    }

    public function productType($productType) {
        if (!empty($productType)) {
            $this->productType = new BankProductTypeDTO($productType);
        }
    }
}
