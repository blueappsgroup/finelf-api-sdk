<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Finelf\Api;

$api = new Api('USERNAME', 'PASSWORD', 'CLIENT_ID', 'CLIENT_SECRET', 'API_URL');
$ranking = $api->ranking->get(1);
$lender = $api->lender->get(1);
