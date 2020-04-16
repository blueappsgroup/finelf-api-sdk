<?php

namespace Finelf_Api_Sdk\Modules;

class LenderUserRatingsModule extends BaseModule {
    protected $baseRoute = 'lenders-user-ratings';

    public function getAverage(int $lenderId, int $websiteId) : float {
        $data = parent::get($lenderId . '/website/' . $websiteId);

        return $data->avg;
    }
}
