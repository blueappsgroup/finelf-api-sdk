<?php

namespace Finelf\DTO;

class RankingDTO extends BaseDTO {
    public $name;
    public $modifiedOn;
    public $parameters;
    public $offers;

    protected function rankingParameters($rankingParameters) {
        if (!empty($rankingParameters)) {
            foreach ($rankingParameters as $rankingParameter) {
                $this->parameters[$rankingParameter->parameterId] = $rankingParameter->priority;
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
