<?php

require_once 'vendor/autoload.php';

use Finelf\Api;

$api = new Api('USERNAME', 'PASSWORD', 'CLIENT_ID', 'CLIENT_SECRET', 'API_URL');
echo $api->ranking->get(1);
