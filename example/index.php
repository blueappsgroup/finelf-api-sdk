<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Finelf\Api;

$api = Api::getInstance('USERNAME', 'PASSWORD', 'CLIENT_ID', 'CLIENT_SECRET', 'API_URL');
$ranking = $api->ranking->get(2);
//$lender = $api->lender->get(2);

offer->get('')
