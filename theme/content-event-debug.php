<?php
global $c24objects, $c24error, $c24debug;

if ($c24error) {
  ?>
  <div id="c24-error" style="border:1px solid #333">
    <?php echo $c24error; ?>
  </div>
  <?php
}
if (C24EVENTS_DEBUG) {
  ?>
  <div id="c24-debug" style="border:1px solid #333">
    <h3>DEBUG INFO</h3>
    <?php echo $c24debug; ?>
  </div>
  <?php
}
?>
<div class="c24-events">
  <?php
  foreach ($c24objects as $event) {
    $properties = (array) $event->get_record();
    ?>
    <div class="c24-events-detail">
      <p><a href="/events?id=<?php echo $properties['uniqueID']; ?>" target="_blank">Internal Link</a></p>
      <?php
      foreach ($properties as $name => $prop) {
        ?>
        <p><em><?php echo $name; ?>: </em><?php print_r($prop); ?></p>
        <?php
      }
      ?>
    </div>
    <?php
  }
  ?>
</div>