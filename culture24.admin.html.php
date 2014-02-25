<?php
global $c24objects, $c24pager, $c24error;
$c24objects = array();
$c24error = false;
if (isset($_POST['c24'])) {
  if (!wp_verify_nonce($_POST['c24'], 'c24-test')) {
    die('Security check');
  }
  $obj = new Culture24API();
  if ($obj->requestID($_POST['uniqueID'])) {
    $c24objects = $obj->get_objects();
  }
  else {
    $c24error = $obj->get_message();
  }
}
?>
<style>
  .c24-events-detail,
  address {
    background: #fff;
    border: 1px solid #666;
    padding: 5px;
  }
</style>
<div class="wrap">
  <h2>Culture24 HTML Test Page</h2>
  <div id="c24-admin">
    <form id='c24-form' class="form-wrap" action="<?php print $_SERVER['REQUEST_URI']; ?>" method="POST">
      <label for="uniqueID" style="display:inline;">Event ID</label>
      <input id="uniqueID" name="uniqueID" type="text" size="16" value="<?php echo (isset($_POST['uniqueID']) ? $_POST['uniqueID'] : ''); ?>" />
      <?php
      if (function_exists('wp_nonce_field')) {
        wp_nonce_field('c24-test', 'c24');
      }
      ?>
      <input class="button-primary" type="submit" name="c24_btn_test" id="c24_btn_test" value="Test" />
    </form>
    <div>
      <?php
      include('theme/content-event-html.php');
      ?>
    </div>
  </div>  <!--id="c24_admin"-->
</div>   <!--class="wrap" -->