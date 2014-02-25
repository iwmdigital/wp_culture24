<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en" type="text/javascript"></script>
<script src="<?php echo plugins_url(); ?>/culture24/theme/gmap3.js" type="text/javascript"></script>
<style>
  .gmap3-7 {
    width: 850px;
    height: 850px;
  }
  .gmap3-6 {
    width: 500px;
    height: 500px;
  }
  .gmap3-5 {
    width: 300px;
    height: 300px;
  }
</style>

<?php
global $c24objects, $c24error, $c24debug, $c24mapsize;
if (!isset($c24mapsize) || is_null($c24mapsize)) {
  $c24mapsize = '7';
}
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
  $markers = array();
  foreach ($c24objects as $event) {
    $address = $event->get_address_string();
    $data = '<p><strong>'
        . '<a href="/events/?id=' . $event->get_event_id() . '" target="_blank">' . $event->get_name() . '</a>'
        . '</strong></p>'
        . '<p>' . $event->get_type() . '</p>'
        . '<p>' . c24_view_dates($event) . '</p>'
        . '<p>' . c24_view_audience($event) . '</p>'
        . '<p>' . $address . '</p>'
        . '<p>' . c24_view_summary($event) . '</p>'
    ;
    if (array_key_exists($event->get_address_postcode(), $markers)) {
      // 'cluster' events for same address
      $markers[$event->get_address_postcode()]['data'] .= $data;
    }
    else {
      $markers[$event->get_address_postcode()] = array(
        'address' => $address,
        'data' => $data,
      );
    }
  }
  sort($markers);
  ?>
  <div id="c24map" class="gmap3-<?php echo $c24mapsize; ?>"></div>
</div>
<?php
if (C24EVENTS_DEBUG) {
  ?>
  <div id="c24-debug" style="border:1px solid #333">
    <h3>DEBUG INFO</h3>
    <?php echo $c24debug; ?>
  </div>
  <?php
}
?>
<script type="text/javascript">
  jQuery(document).ready(function() {
      // Halifax ... at zoom 7 in 850 x 850
      // includes Calais, Dunkirk, London, Edinburgh, Glasgow, Belfast and all between
      var center = [53.725967,-1.853943];
      jQuery('#c24map').gmap3({
        map:{
          options:{
            center:center,
            scaleControl: true,
            zoom: <?php echo $c24mapsize; ?>
          }
        },
        marker:{
          values:<?php echo json_encode($markers); ?>,
          options:{
            draggable: false
          },
          events:{
            click: function(marker, event, context){
              var map = jQuery(this).gmap3("get"),
              infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
              if (infowindow){
                infowindow.open(map, marker);
                infowindow.setContent(context.data);
              } else {
                jQuery(this).gmap3({
                  infowindow:{
                    anchor:marker,
                    options:{content: context.data}
                  }
                });
              }
            }
          }
        }
      });
  });

</script>
