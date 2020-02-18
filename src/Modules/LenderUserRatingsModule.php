<?php

namespace Finelf\Modules;

class LenderUserRatingsModule extends BaseModule {
    protected $baseRoute = 'lenders-user-ratings';

    public function getAverage($lenderId, $websiteId) {
        $data = parent::get('/' . $this->baseRoute . '/' . $lenderId . '/website/' . $websiteId);

        return $data->avg;
    }
}
