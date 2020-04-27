<?php

namespace Finelf_Api_Sdk\DTO;

class RankingDTO extends BaseDTO {
    public $name;
    public $modifiedOn;
    public $hotOfferStart;
    public $hotOfferEnd;
    public $hotOfferId;
    public $parameters;
    public $offers;

    protected function rankingParameters($rankingParameters) {
        if (!empty($rankingParameters)) {
            foreach ($rankingParameters as $rankingParameter) {
                $this->parameters[$rankingParameter->parameter->slug] = $rankingParameter->priority;
            }
        }
    }

    protected function rankingOffers($rankingOffers) {
        if (!empty($rankingOffers)) {
            foreach ($rankingOffers as $rankingOffer) {
                $this->offers[$rankingOffer->priority] = new OfferDTO($rankingOffer->offer, $this->parameters);
            }

            ksort($this->offers);
        }
    }
}
