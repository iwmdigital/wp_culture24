<?php

/**
 * @package Culture24
 *
 */

/**
 * Class that handles Culture24 venue record
 */
class Culture24Venue extends Culture24Class {

  /**
   *
   * @return string
   */
  public function get_venue_id() {
    return $this->get_unique_id();
  }

  /**
   *
   * @return array
   */
  public function get_url($webonly = TRUE) {
    $value = $this->get_property('url');
    $result = array();
    foreach ($value as $k => $v) {
//      have seen occasional bit of corrupt data for this value
//      if (is_object($v->qualifier)) {
//        $result[] = print_r($v->qualifier,1);
//      }
//      else {
      if ($webonly && $v->qualifier = 'Web Site') {
        $result[] = str_replace('http://', '', $v->url);
      }
      else {
        $result[] = $v->qualifier . ': ' . $v->description . ': ' . $v->url;
      }
//      }
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_other_names() {
    return $this->get_property('otherNames');
  }

  /**
   *
   * @return string
   */
  public function get_type() {
    return $this->get_property('type');
  }

  public function get_tags() {
    return $this->get_property('contentTag');
  }

  /**
   *
   * @return string
   */
  public function get_legal_status() {
    return $this->get_property('legalStatus');
  }

  /**
   *
   * @return string
   */
  public function get_email() {
    $value = $this->get_property('email');
    $result = '';
    foreach ($value as $k => $v) {
      $result .= $v->description . ': ' . $v->address;
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_telephone() {
    $value = $this->get_property('telephone');
    $result = '';
    foreach ($value as $k => $v) {
      $result .= $v->description . ': ' . $v->number;
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_fax() {
    $value = $this->get_property('fax');
    $result = '';
    foreach ($value as $k => $v) {
      $result .= $v->description . ': ' . $v->number;
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_latitude() {
    return $this->get_property('latitude');
  }

  /**
   *
   * @return string
   */
  public function get_longitude() {
    return $this->get_property('longitude');
  }

  /**
   *
   * @return string
   */
  public function get_opening_hours() {
    return $this->get_property('openingHours');
  }

  /**
   *
   * @return string
   */
  public function get_discounts() {
    return $this->get_property('discounts');
  }

  /**
   *
   * @return string
   */
  public function get_travel_directions() {
    return $this->get_property('travelDirections');
  }

  /**
   *
   * @return string
   */
  public function get_facilities_information() {
    return $this->get_property('facilitiesInformation');
  }

  /**
   *
   * @return string
   */
  public function get_facility() {
    return $this->get_property('facility');
  }

  /**
   *
   * @return string
   */
  public function get_service() {
    return $this->get_property('service');
  }

  /**
   *
   * @return string
   */
  public function get_key_attraction() {
    return $this->get_property('keyArtistOrExhibit');
  }

  /**
   *
   * @return string
   */
  public function collections() {
    return $this->get_property('collections');
  }

  /**
   *
   * @return string
   */
  public function get_collections_description() {
    return $this->get_property('collectionsDescription');
  }

  /**
   *
   * @return string
   */
  public function get_collections_image() {
    return $this->get_property('collectionsDescriptionGraphic');
  }

  /**
   *
   * @return string
   */
  public function get_institution() {
    return $this->get_property('constituentInstitution');
  }

  /**
   *
   * @return string
   */
  public function get_lea() {
    return $this->get_property('lea');
  }

  /**
   *
   * @return string
   */
  public function get_regional_agency() {
    return $this->get_property('regionalAgency');
  }

}