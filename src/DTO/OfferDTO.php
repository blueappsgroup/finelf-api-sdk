<?php

namespace Finelf\DTO;

class OfferDTO extends BaseDTO {
    public $name;
    public $type;
    public $affiliateLink;
    public $prettyLink;
    public $promotionDate;
    public $isHotOffer;
    public $lender;
    public $parameters;
    public $debtorsBases;

    public function offerParameters($offerParameters) {
        if (!empty($offerParameters)) {
            foreach ($offerParameters as $offerParameter) {
                $this->parameters[$offerParameter->parameterId] = new ParameterDTO($offerParameter);
            }
        }
    }

    public function offerDebtorsBases($offerDebtorsBases) {
        if (!empty($offerDebtorsBases)) {
            foreach ($offerDebtorsBases as $offerDebtorsBase) {
                $this->debtorsBases[$offerDebtorsBase->debtorsBaseId] = new DebtorsBaseDTO($offerDebtorsBase);
            }
        }
    }

    public function lender($lender) {
        if (!empty($lender)) {
            $this->lender = new LenderDTO($lender);
        }
    }
}
