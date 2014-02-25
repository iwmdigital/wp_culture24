<?php
global $c24objects, $c24pager, $c24error, $c24debug;

$c24objects = array();
$c24pager = '';
$c24error = $c24debug = false;
$c24regions = c24_regions();

if (isset($_POST['c24'])) {

  if (!wp_verify_nonce($_POST['c24'], 'c24-test')) {
    die('Security check');
  }

  define('C24EVENTS_DEBUG', (isset($_REQUEST['debug']) ? 1 : 0));

  $c24objects = array();
  $c24error = $c24debug = false;
  $options = array(
      'query_type' => CULTURE24_API_VENUES,
      'offset' => $_POST['offset'],
      'limit' => $_POST['limit'],
      'tag' => $_POST['tag'],
      'keywords' => $_POST['keywords'],
      'keyfield' => $_POST['keyfield'],
      'region' => $_POST['region'],
      'sort' => 'name',
  );
  $obj = new Culture24API($options);

  if ($obj->requestSet()) {

    $c24objects = $obj->get_objects();
  } else {

    $c24error = $obj->get_message();
  }

  $c24debug = c24_view_event_debug($obj, isset($_REQUEST['debug-raw']));
}
?>

<style>
  .c24-events-detail,
  .c24-events-list {
    background: #eee;
    border: 1px solid #666;
    padding: 15px;        
  }  
</style>

<div class="wrap">
  <div id="icon-options-general" class="icon32"><br /></div>
  <div id="c24-admin">
    <h2>Culture24 VENUES</h2>
    <ul style="list-style-type: circle;">
      <li>Displayed in name sort order, as returned by the Culture24 API.</li>
      <li>If the elements list is empty, all data elements are specified in the query, including linked elements.</li>
      <li>If the elements list is not empty, uniqueID will be appended if it is not already specified.</li>
      <li>Tag and Keyword queries are case-insensitive.</li>
      <li>Search multiple Tags and Keywords by separating the phrases with commas,
        e.g. Tags: World War I,school+trips.</li>
      <li>As of v1.1 of the Culture24 API, query elements (Keywords Fields)
        are restricted to those shown in the drop down box. The address fields and
        descriptions are not searchable.</li>
      <li>Debug summary displays event validation details for fields:
        ID, name, description, tags and all address-prefixed fields.</li>
    </ul>

    <?php
    include('theme/content-venue-form.php');

    if ($c24debug) {

      include('theme/content-event-debug.php');
    }
    ?>
  </div> <!-- id="c24_admin" -->
</div>  <!-- class="wrap" -->