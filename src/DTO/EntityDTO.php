<?php

namespace Finelf_Api_Sdk\DTO;

class EntityDTO extends BaseDTO {
    public $id;
    public $name;
    public $logo;
    public $branches;
    public $data;
    public $offers;

    protected function offers(array $offers) {
        if ( ! empty($offers)) {
            foreach ($offers as $offer) {
                $this->offers[$offer->productId][$offer->id] = new OfferDTO($offer);
            }
        }
    }

    protected function branches(array $branches) {
        if ( ! empty($branches)) {
            foreach ($branches as $branch) {
                $this->branches[$branch->id] = new BranchDTO($branch);
            }
        }
    }

    protected function entitiesData(array $entitiesData) {
        if ( ! empty($entitiesData)) {
            foreach ($entitiesData as $_entitiesData) {
                $this->data[$_entitiesData->data->slug] = new DataDTO($_entitiesData);
            }
        }
    }
}
