<?php
require_once(dirname(__FILE__).'/config.php');

// get json data from local copy
if ($price_type === 'last') {
  $ticker_dir = dirname(__FILE__).'/'.$price_json_file;
  if (file_exists($ticker_dir)) {
    $market_data = json_decode(file_get_contents($ticker_dir), true);
	$market_data = $market_data['BITCOIN'];
  } else {
    die("Could not locate $ticker_dir!");
  }
} else {
  $ticker_dir = dirname(__FILE__).'/'.$wghtd_json_file;
  if (file_exists($ticker_dir)) {
    $market_data = json_decode(file_get_contents($ticker_dir), true);
  } else {
    die("Could not locate $ticker_dir!");
  }
}
?>