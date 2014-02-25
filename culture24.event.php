<?php

/**
 * @package Culture24
 *
 */

/**
 * Class that handles Culture24 event record
 */
class Culture24Event extends Culture24Class {

  protected static $_default_data_elements_array = array(
    'uniqueID',
    'type',
    'name',
    'venueID',
    'venue.name',
    'venue.url',
    'venue.addressStreet',
    'venue.addressTown',
    'venue.addressCounty',
    'venue.addressPostcode',
    'venue.addressCountry',
    'venue.latitude',
    'venue.longitude',
    'instance',
    'audience',
    'status',
    'contentTag',
    'link',
    'graphicUrl',
    'description',
    'shortDescription',
    'url',
    'charges',
    'freeOfCharge',
    'concessionsAvailable',
    'registrationRequired',
    'place',
    'nationalCurriculumTag',
    'addressStreet',
    'addressTown',
    'addressCounty',
    'addressCountry',
    'addressPostcode',
    'publicationDate',
  );

  /**
   *
   * @return array
   */
  public static function get_default_data_elements() {
    return implode(',', self::$_default_data_elements_array);
  }

  /**
   *
   * @return string
   */
  public function get_event_id() {
    return $this->get_unique_id();
  }

  /**
   *
   * @return string
   */
  public function get_venue_id() {
    return $this->_record->venueID;
  }

  /**
   *
   * @return string
   */
  public function get_venue_name() {
    return $this->_record->venue->name;
  }

  /**
   *
   * @return string
   */
  public function get_venue_url() {
    return $this->_record->venue->url;
  }

  /**
   *
   * @return string
   */
  public function get_description_short() {
    return $this->_record->shortDescription;
  }

  /**
   *
   * @return array
   */
  public function get_audience() {
    return implode(', ', (array) $this->_record->audience);
  }

  /**
   *
   * @return arrays
   */
  public function get_language() {
    return implode(', ', (array) $this->_record->language);
  }

  /**
   *
   * @return string
   */
  public function get_status() {
    return $this->get_property('status', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_free() {
    return $this->get_property('freeOfCharge');
  }

  /**
   *
   * @return string
   */
  public function get_url() {
    $result = trim($this->get_property('url'),'\t\n\r\0\x0B/');
    if(strlen($result) > 0){
	    if ((stripos($result, "http://") === false) && (stripos($result, "https://") === false)){
	    	$result = "http://" . $result;
	    }
   }
  	return $result;
  }

  /**
   *
   * @return string
   */
  public function get_curriculum_tags() {
    $value = $this->get_property('nationalCurriculumTag');
    $result = '';
    foreach ($value as $k => $v) {
      $result .= print_r($v, 1);
    }
    return $result;
  }

  /**
   *
   * @return integer
   */
  public function get_date_count() {
    $result = count($this->_record->instance);
    if ($this->validate && !$result) {
      $this->_validation_errors[] = 'missing: dates';
    }
    return $result;
  }

  /**
   *
   * @return array
   */
  public function get_date_array() {
    $result = $this->get_property('instance');
    if ($this->validate && !$result) {
      $this->_validation_errors[] = 'missing: dates';
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_date_start($i) {
    return $this->_record->instance[$i]->startDate;
  }

  /**
   *
   * @return string
   */
  public function get_date_end($i) {
    return $this->_record->instance[$i]->endDate;
  }

  /**
   *
   * @return string
   */
  public function get_time_start($i) {
    return $this->_record->instance[$i]->startTime;
  }

  /**
   *
   * @return string
   */
  public function get_time_end($i) {
    return $this->_record->instance[$i]->endTime;
  }

  /**
   *
   * @return string
   */
  public function get_place() {
    return $this->get_property('place');
  }

  /**
   *
   * @return string
   */
  public function get_registration() {
    return $this->get_property('registrationRequired');
  }

  /**
   *
   * @return string
   */
  public function get_concessions() {
    return $this->get_property('concessionsAvailable');
  }

}