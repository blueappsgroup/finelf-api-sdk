<?php

namespace Finelf\DTO;

use stdClass;

class BankOfferDTO extends BaseDTO {
    protected $rankingParametersPriority = [];
    public $id;
    public $name;
    public $type;
    public $affiliateLink;
    public $prettyLink;
    public $isActive;
    public $product;
    public $parameters;
    public $rate;

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

    protected function product($product) {
        if (!empty($product)) {
            $this->product = new BankProductDTO($product);
        }
    }

    protected function offerRatings($offerRatings) {
        if (!empty($offerRatings)) {
            $offerRatings = reset($offerRatings);
            $this->rate = $offerRatings->rate;
        }
    }
}
