<?php admin_valid(); ?>

<h1>Admin Control Panel</h1>

<p>Here you can review your orders, manage your products, etc.<br />
Use the navigation menu to the  left to get started.</p>

<hr />

<h4>Sales Summary:</h4>
<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th>Confirmed orders for last 30 days:</th>
    <th>Unconfirmed orders for last 30 days:</th>
    <th width="30%">Income for last 30 days:</th>
    <th width="30%">Income for current month:</th>
  </tr>
  <tr>
    <td><?php echo order_num(30); ?></td>
    <td><?php echo order_num(30, false); ?></td>
    <?php
    $ti_arr = total_income(30);
    $ai_arr = monthly_income();
    ?>
    <td><?php
	if ($ti_arr !== 0) {
	  $sln = '';
	  foreach ($ti_arr as $key => $val) {
	    if ($key == $curr_code) {
	      $sln .= bitsci::btc_num_format($val,2).'&nbsp;'.$key.' + ';
	    } else {
	      $sln .= $val.'&nbsp;'.$key.' + ';
	    }
	  }
	  echo substr($sln, 0, strlen($sln)-3);
	} else {
	  echo "0.0 $curr_code";
	}
	?></td>
	<td><?php
	if ($ai_arr !== 0) {
	  $sln = '';
	  foreach ($ai_arr as $key => $val) {
	    if ($key == $curr_code) {
	      $sln .= bitsci::btc_num_format($val,2).'&nbsp;'.$key.' + ';
	    } else {
	      $sln .= $val.'&nbsp;'.$key.' + ';
	    }
	  }
	  echo substr($sln, 0, strlen($sln)-3);
	} else {
	  echo "0.0 $curr_code";
	}
	?></td>
  </tr>
</table>

<h4>Product summary:</h4>
<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th>Number of active products:</th>
    <th>Number of inactive products:</th>
    <th width="30%">Best selling product:</th>
    <th width="30%">Highest ranked product:</th>
  </tr>
  <tr>
    <td><?php echo count_active_files(); ?></td>
	<td><?php echo count_inactive_files(); ?></td>
    <td>
	  <?php
	  $best_item = best_file();
	  if (!empty($best_item) && $best_item != 'N/A') {
		echo "<a href='admin.php?page=items&amp;action=edit&amp;fid=".
		$best_item['FileID']."'>".$best_item['FileName']."</a>";
	  } else {
	    echo 'none';
	  }
	  ?>
	</td>
	<td>
	  <?php 
	  $top_item = top_file();
	  if (!empty($top_item) && $top_item != 'N/A') {
		echo "<a href='admin.php?page=items&amp;action=edit&amp;fid=".
		$top_item['FileID']."'>".$top_item['FileName']."</a>";
	  } else {
	    echo 'none';
	  }
	  ?>
	</td>
  </tr>
</table>