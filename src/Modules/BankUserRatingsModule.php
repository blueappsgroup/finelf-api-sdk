<?php

namespace Finelf\Modules;

class BankUserRatingsModule extends BaseModule {
    protected $baseRoute = 'banks-user-ratings';

    public function getAverage(int $bankId, int $websiteId) : float {
        $data = parent::get($bankId . '/website/' . $websiteId);

        return $data->avg;
    }
}
