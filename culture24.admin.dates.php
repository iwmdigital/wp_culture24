<?php
/**
 *
 * @param array $date_array
 */
function c24_test_dates() {
  $result = array();

  $dates = array(
      0 => array('startDate' => '29/07/2013', 'startTime' => '11:00', 'endDate' => '29/07/2013', 'endTime' => '15:00')
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Single date with times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      0 => array('startDate' => '29/07/2013', 'startTime' => '10:00', 'endDate' => '29/07/2013', 'endTime' => '11:00'),
      1 => array('startDate' => '29/07/2013', 'startTime' => '12:00', 'endDate' => '29/07/2013', 'endTime' => '13:00'),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Single date with multiple times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      0 => array('startDate' => '29/07/2013', 'startTime' => '', 'endDate' => '29/07/2013', 'endTime' => ''),
  );
  $dates = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Single date without times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      0 => array('startDate' => '26/07/2013', 'startTime' => '11:00', 'endDate' => '29/07/2013', 'endTime' => '15:00'),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Single date range with times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      0 => array('startDate' => '26/07/2013', 'startTime' => '', 'endDate' => '29/07/2013', 'endTime' => ''),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Single date range without times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      1 => array('startDate' => '20/07/2013', 'startTime' => '15:00', 'endDate' => '20/07/2013', 'endTime' => '15:30'),
      2 => array('startDate' => '27/07/2013', 'startTime' => '15:00', 'endDate' => '27/07/2013', 'endTime' => '15:30'),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Multiple single dates with times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      1 => array('startDate' => '05/07/2013', 'startTime' => '', 'endDate' => '05/07/2013', 'endTime' => ''),
      2 => array('startDate' => '12/07/2013', 'startTime' => '', 'endDate' => '12/07/2013', 'endTime' => ''),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Multiple single dates without times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      1 => array('startDate' => '05/07/2013', 'startTime' => '15:00', 'endDate' => '12/07/2013', 'endTime' => '15:30'),
      2 => array('startDate' => '18/07/2013', 'startTime' => '15:00', 'endDate' => '25/07/2013', 'endTime' => '15:30'),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Multiple date ranges with times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  $dates = array(
      1 => array('startDate' => '05/07/2013', 'startTime' => '', 'endDate' => '12/07/2013', 'endTime' => ''),
      2 => array('startDate' => '18/07/2013', 'startTime' => '', 'endDate' => '25/07/2013', 'endTime' => ''),
  );
  $arg = c24_make_test_date_array($dates);
  $result[] = array(
      'name' => 'Multiple date ranges without times',
      'dates' => $dates,
      'result' => c24_format_dates($arg),
  );

  return $result;
}

function c24_make_test_date_array($dates) {
  $result = array();
  foreach ($dates as $v) {
    $result[] = (object) $v;
  }
  return $result;
}

$c24dates = array();
if (isset($_POST['c24'])) {
  if (!wp_verify_nonce($_POST['c24'], 'c24-test')) {
    die('Security check');
  }
  $c24dates = c24_test_dates();
}
?>
<div class="wrap">
  <h2>Culture24 Dates Test Page</h2>
  <div id="c24-admin">
    <form id='c24-form' class="form-wrap" action="<?php print $_SERVER['REQUEST_URI']; ?>" method="POST">
      <?php
      if (function_exists('wp_nonce_field')) {
        wp_nonce_field('c24-test', 'c24');
      }
      ?>
      <input class="button-primary" type="submit" name="c24_btn_test" id="c24_btn_test" value="Test" />
    </form>
    <div>
      <?php
      foreach ($c24dates as $test) {
        ?>
        <div>
          <p><strong><?php print_r($test['name']); ?></strong></p>
          <p><?php print_r($test['dates']); ?></p>
          <p><?php print_r($test['result']); ?></p>
          ============================================
        </div>
        <?php
      }
      ?>
    </div>
  </div>  <!--id="c24_admin"-->
</div>   <!--class="wrap" -->