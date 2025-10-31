<?php
// include bitshop config
require_once(dirname(__FILE__).'/../sci/config.php');

// market data API URL
$weight_api_url = 'https://api.bitcoincharts.com/v1/weighted_prices.json';
$latest_api_url = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=';

// name of the local ticker file
$wghtd_json_file = 'weighted_prices.json';

// name of the local ticker file
$price_json_file = 'latest_prices.json';

// ticker app version
$app_version = '0.1.6';
?>
