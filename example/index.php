<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Finelf\Api;

$api = Api::getInstance('skarbonka', 'redPiggy', 'skarbonka', 'redpiggy', 'https://api.finelf.com');
$ranking = $api->ranking->get(2);
//$lender = $api->lender->get(2);
print_r('<pre>');
print_r($ranking);
