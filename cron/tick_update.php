<?php
// call required includes
require_once(dirname(__FILE__).'/../sci/config.php');
require_once(dirname(__FILE__).'/../ticker/config.php');
require_once(dirname(__FILE__).'/../lib/common.lib.php');

// check what api to use
if ($price_type === 'last') {
  require_once(dirname(__FILE__).'/../ticker/market_stats.php');
  $currencies = '';
  $targ_index = 'BITCOIN';
  $target_file = $price_json_file;
  foreach ($market_data as $key => $value) {
    if (strlen($key) == 3) $currencies .= strtolower($key).',';
  }
  $currencies = rtrim($currencies, ',');
  echo "<p>Requesting data from $latest_api_url$currencies ...</p>\n";
  $json_result = strtoupper(bitsci::curl_simple_post($latest_api_url.$currencies));
} else {
  $targ_index = $curr_code;
  $target_file = $wghtd_json_file;
  echo "<p>Requesting data from $weight_api_url ...</p>\n";
  $json_result = bitsci::curl_simple_post($weight_api_url);
}

if (!empty($json_result)) {

  // decode json string
  $json_array = json_decode($json_result, true);
  
  // check json array
  if (!empty($json_array) && isset($json_array[$targ_index])) {

    // open local file for writing
    $fp = fopen(dirname(__FILE__)."/../ticker/$target_file", "w");
  
    // write to our opened file.
    if (fwrite($fp, $json_result) === FALSE) { 
      echo "<p>FAILURE! Could not write data to local file!</p>\n";
    } else {
      echo "<p>SUCCESS! $target_file has been updated!</p>\n";
    }
  
    // release file handle
    fclose($fp);
  
  } else {
    die("<p>FAILURE! API returned invalid data!</p>");
  }
} else {
  die("<p>FAILURE! API is not responding!</p>");
}
?>