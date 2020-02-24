<?php

namespace Finelf\Modules;

use function is_object;

class PingModule extends BaseModule {
    protected $baseRoute = 'ping';

    public function checkConnection() {
        $data = parent::get('');

        if(is_object($data)) {
            if(!empty($data->greeting) && $data->greeting === 'Welcome to Finelf API') {
                return true;
            }
        }

        return false;
    }

}
