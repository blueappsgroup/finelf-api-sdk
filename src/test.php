<?php
$auth_data = [
    'username' => 'Dominika',
    'password' => 'test123!@#',
    'uri' => 'http://localhost:3000/'
];

$test = new Ranking\apiClient($auth_data);
echo $test;
