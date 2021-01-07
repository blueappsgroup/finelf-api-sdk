<?php

namespace Finelf_Api_Sdk\DTO;

class RankingDTO extends BaseDTO {
    public $name;
    public $modifiedOn;
    public $hotOfferStart;
    public $hotOfferEnd;
    public $hotOfferId;
    public $enableFilters;
    public $enableDetails;
    public $enableCalculations;
    public $parameters;
    public $filters;
    public $offers;

    protected function rankingsParameters(array $rankingsParameters) {
        if ( ! empty($rankingsParameters)) {
            foreach ($rankingsParameters as $rankingsParameter) {
                $this->parameters[$rankingsParameter->parameter->slug] = $rankingsParameter->priority;
            }
        }
    }

    protected function rankingsFilters(array $rankingsFilters) {
        if ( ! empty($rankingsFilters)) {
            foreach ($rankingsFilters as $rankingsFilter) {
                $this->filters[$rankingsFilter->parameterId] = new FilterDTO($rankingsFilter->parameter, $rankingsFilter->rangeType);
            }
        }
    }

    protected function rankingsOffers(array $rankingsOffers) {
        if ( ! empty($rankingsOffers)) {
            foreach ($rankingsOffers as $rankingsOffer) {
                $this->offers[$rankingsOffer->priority] = new OfferDTO($rankingsOffer->offer);
            }

            ksort($this->offers);
        }
    }
}
