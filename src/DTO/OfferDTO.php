<?php

namespace Finelf\DTO;

use stdClass;

class OfferDTO extends BaseDTO {
    protected $rankingParametersPriority = [];
    public $name;
    public $type;
    public $affiliateLink;
    public $prettyLink;
    public $promotionDate;
    public $isHotOffer;
    public $lender;
    public $parameters;
    public $debtorsBases;

    public function __construct(stdClass $jsonObject, $rankingParametersPriority = []) {
        $this->rankingParametersPriority = $rankingParametersPriority;

        parent::__construct($jsonObject);
    }

    protected function offerParameters($offerParameters) {
        if (!empty($offerParameters)) {
            if (count($this->rankingParametersPriority) > 0) {
                return $this->offerParametersForRanking($offerParameters);
            }

            foreach ($offerParameters as $offerParameter) {
                $this->parameters[$offerParameter->parameter->slug] = new ParameterDTO($offerParameter);
            }
        }
    }

    protected function offerParametersForRanking($offerParameters) {
        foreach ($offerParameters as $offerParameter) {
            if (!empty($this->rankingParametersPriority[$offerParameter->parameterId])) {
                $this->parameters[$this->rankingParametersPriority[$offerParameter->parameterId]] = new ParameterDTO($offerParameter);
            }
        }

        ksort($this->parameters);
    }

    protected function offerDebtorsBases($offerDebtorsBases) {
        if (!empty($offerDebtorsBases)) {
            foreach ($offerDebtorsBases as $offerDebtorsBase) {
                $this->debtorsBases[$offerDebtorsBase->debtorsBaseId] = new DebtorsBaseDTO($offerDebtorsBase);
            }
        }
    }

    protected function lender($lender) {
        if (!empty($lender)) {
            $this->lender = new LenderDTO($lender);
        }
    }
}
