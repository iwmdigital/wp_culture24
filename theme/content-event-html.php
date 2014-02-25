<?php
global $c24objects, $c24error;

require_once('functions-c24.php');

if ($c24error) {
  ?>
  <div id="c24-error" style="border:1px solid #333">
    <?php echo $c24error; ?>
  </div>
  <?php
}
?>
<div class="c24-events">
  <?php
  if (count($c24objects)) {
    $event = $c24objects[0];
    print '<p>c24_view_address() </p><p>' . c24_view_address($event) . '</p>';
    print '<p>c24_view_audience() </p><p class="c24-events-detail">' . c24_view_audience($event) . '</p>';
    print '<p>c24_view_event_type() </p><p class="c24-events-detail">' . c24_view_event_type($event) . '</p>';
    print '<p>c24_view_event_url() </p><p class="c24-events-detail">' . c24_view_event_url($event) . '</p>';
    print '<p>c24_view_partner_url() </p><p class="c24-events-detail">' . c24_view_partner_url($event) . '</p>';
    print '<p>c24_view_event_image() </p><p class="c24-events-detail">' . c24_view_event_image($event) . '</p>';
    print '<p>c24_view_dates() </p><p class="c24-events-detail">' . c24_view_dates($event) . '</p>';
    print '<p>c24_view_free() </p><p class="c24-events-detail">' . c24_view_free($event) . '</p>';
    print '<p>c24_view_charges() </p><p class="c24-events-detail">' . c24_view_charges($event) . '</p>';
    print '<p>c24_view_registration() </p><p class="c24-events-detail">' . c24_view_registration($event) . '</p>';
    print '<p>c24_view_concessions() </p><p class="c24-events-detail">' . c24_view_concessions($event) . '</p>';
    print '<p>c24_view_where() </p><p class="c24-events-detail">' . c24_view_where($event, TRUE) . '</p>';
    print '<p>c24_view_links() </p><p class="c24-events-detail">' . c24_view_links($event) . '</p>';
    print '<p>c24_view_summary() </p><p class="c24-events-detail">' . c24_view_summary($event) . '</p>';
    print '<p class="c24-events-detail">' . c24_pager(100) . '</p>';
  }
  ?>
</div>