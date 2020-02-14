<?php

namespace Finelf\DTO;

class OfferDTO extends BaseDTO {
    protected $rankingParameters = [];
    public $name;
    public $type;
    public $affiliateLink;
    public $prettyLink;
    public $promotionDate;
    public $isHotOffer;
    public $lender;
    public $parameters;
    public $debtorsBases;

    public function __construct(\stdClass $jsonObject, $rankingParameters = []) {
        $this->rankingParameters = $rankingParameters;
        parent::__construct($jsonObject);
    }

    protected function offerParameters($offerParameters) {
        if (!empty($offerParameters)) {
            if (!empty($this->rankingParameters)) {
                return $this->offerParametersForRanking($offerParameters);
            }

            foreach ($offerParameters as $offerParameter) {
                $this->parameters[$offerParameter->parameterId] = new ParameterDTO($offerParameter);
            }
        }
    }

    protected function offerParametersForRanking($offerParameters) {
        foreach ($offerParameters as $offerParameter) {
            $this->parameters[$offerParameter->parameterId] = new ParameterDTO($offerParameter);
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
