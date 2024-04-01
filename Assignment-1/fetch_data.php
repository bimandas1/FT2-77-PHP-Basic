<?php

require __DIR__ . '/FetchAPI.php';
require __DIR__ . '/creds.php';

$apiResponse = new FetchAPI($api_url);
$apiResponse->setData();
