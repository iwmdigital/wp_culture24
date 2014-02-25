<?php

/**
 * Compile a WP pagination string that can be printed in a template
 *
 * Example usage:
 * global $c24pager
 * $c24pager = c24_pager($c24obj->get_found(), $_POST['limit']);
 *
 * @param type $total_items
 * @param type $per_page
 * @return string
 */
function c24_pager($total_items, $per_page = 10) {
  $max = ceil($total_items / $per_page);
  $pages = '';
  if (!$current = get_query_var('paged')) {
    $current = 1;
  }
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;
  $a['mid_size'] = 6;
  $total = 1; // 1 show the text "Page N of N", 0 - do not display
  $result = '';
  if ($total == 1 && $max > 1) {
    $pages .= ' Page' . $current . ' of ' . $max . '  ' . "\n";
  }
  $result .= $pages . paginate_links($a);
  return $result;
}

/**
 * Shared views on Culture24 data
 */
function c24_view_address($event) {
  return '<address>'
      . $event->get_place() . ",\n "
      . $event->get_address_street() . ",\n "
      . $event->get_address_town() . ",\n"
      . $event->get_address_county() . ",\n"
      . $event->get_address_country() . ",\n"
      . $event->get_address_postcode()
      . '</address>';
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_audience($event) {
  $result = trim(nl2br($event->get_audience()), ',');
  if (empty($result)) {
    $result = 'Everyone';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_event_type($event) {
  return nl2br($event->get_type());
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_event_url($event) {
  return nl2br(trim($event->get_url()));
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_partner_url($event) {
  return '/partner?id=' . $event->get_venue_id();
}

/**
 *
 * @param object $venue
 * @return string
 */
function c24_view_venue_url($venue) {
  $result = '';
  $urls = (array) $venue->get_url('webonly');
  foreach ($urls as $url) {
    $result .= '<a href="http://' . $url . '" target="_blank">' . $url . '</a><br />';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @param integer $i
 * @return string
 */
function c24_view_starts($event, $i) {
  return '<time datetime="' . $event->get_date_start($i) . ' ' . $event->get_time_start($i) . '">'
      . $event->get_date_start($i) . ' ' . $event->get_time_start($i)
      . '</time>';
}

/**
 *
 * @param object $event
 * @param integer $i
 * @return string
 */
function c24_view_ends($event, $i) {
  return '<time datetime="' . $event->get_date_end($i) . ' ' . $event->get_time_end($i) . '">'
      . $event->get_date_end($i) . ' ' . $event->get_time_end($i)
      . '</time>';
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_event_image($event) {
  $result = '';
  $image = $event->get_image_url_large();
  if (!empty($image)) {
    $result = '<br /><img src="' . $image . '"/>';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_dates($event) {
  $result = '';
  $dates = c24_format_dates($event->get_date_array(), 'd F Y');
  for ($i = 0; $i < count($dates); $i++) {
    $result .= $dates[$i] . ($i < count($dates) - 1 ? '<br />' : '');
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_free($event) {
  $result = '';
  if ($event->get_free() == 'Y') {
    $result = 'Free';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_charges($event) {
  return nl2br($event->get_charges());
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_registration($event) {
  $result = 'N/A';
  if ($event->get_registration() == 'Y') {
    $result = 'Registration required';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_concessions($event) {
  $result = 'N/A';
  if ($event->get_concessions() == 'Y') {
    $result = 'Concessions available';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_where($event, $showpic = false) {
  $result = $event->get_address_string();
  if ($showpic) {
    $image = $event->get_image_url();
    if (!empty($image)) {
      $result .= '<br /><img src="' . $image . '"/>';
    }
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_links($event) {
  $result = '';
  $c24 = $event->get_link();
  if (!empty($c24)) {
    $result .= '<span>&nbsp;<a href="' . $c24 . '" target="_blank">Culture24 page</a></span>';
  }
  $event = $event->get_url();
  if (!empty($event)) {
    $result .= '<span>&nbsp;<a href="' . $event . '" target="_blank">Event source page</a></span>';
  }
  return $result;
}

/**
 *
 * @param object $event
 * @return string
 */
function c24_view_summary($event) {
  $result = $event->get_description_short();
  if (empty($result)) {
    $result = wp_trim_words($event->get_description(), 48);
  }
  return $result;
}
