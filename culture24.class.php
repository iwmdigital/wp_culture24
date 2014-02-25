<?php

/**
 * @package Culture24
 *
 */

/**
 * Class that handles generic Culture24 record
 */
class Culture24Class {

  /**
   * @var string
   */
  protected $_message = '';

  /**
   * @var boolean
   */
  protected $_error = FALSE;

  /**
   * @var stdClass
   */
  protected $_record;

  /**
   * Purely for data quality control
   * @var boolean
   */
  protected $_validate = FALSE;

  /**
   * Purely for data quality control
   * @var array
   */
  protected $_validation_errors = array();

  /**
   * Constructor
   */
  function __construct($record) {
    $this->_record = $record;
  }

  public static function get_default_data_elements() {
    return '';
  }

  /**
   *
   * @param array $data
   * @param string $glue
   * @return string
   */
  protected function to_string($data, $glue = '|') {
    $result = '';
    try {
      $array = (array) $data;
      $result = implode('|', $array);
    } catch (Exception $e) {
      $this->_error = true;
      $this->_message = $e . getMessage();
    }
    return $result;
  }

  /**
   * Purely for data quality control
   * @return array
   */
  public function get_validation_errors() {
    return $this->_validation_errors;
  }

  /**
   *
   * @return stdClass
   */
  public function get_record() {
    return $this->_record;
  }

  /**
   *
   * @param string $name
   * @param boolean $validate
   * @return mixed
   */
  public function get_property($name, $validate = FALSE) {
    $result = '';
    if (isset($this->_record->{$name})) {
      $result = $this->_record->{$name};
      if (is_string($result)) {
        $result = trim($result);
      }
    }
    if ($validate && empty($result)) {
      $this->_validation_errors[] = 'missing: ' . $name;
    }
    return $result;
  }

  /**
   *
   * @return string
   */
  public function get_unique_id() {
    return $this->_record->uniqueID;
  }

  /**
   *
   * @return string
   */
  public function get_name() {
    return $this->get_property('name', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_description() {
    return $this->get_property('description', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_type() {
    return implode(' / ', $this->get_property('type', $this->_validate));
  }

  /**
   *
   * @return string
   */
  public function get_tags() {
    return implode(', ', $this->get_property('contentTag', $this->_validate));
  }

  /**
   *
   * @return string
   */
  public function get_address_street() {
    return $this->get_property('addressStreet', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_address_town() {
    return $this->get_property('addressTown', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_address_county() {
    return $this->get_property('addressCounty', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_address_country() {
    return $this->get_property('addressCountry', $this->_validate);
  }

  /**
   *
   * @return string
   */
  public function get_address_postcode() {
    return $this->get_property('addressPostcode', $this->_validate);
  }

  /**
   * Format a complete address string
   *
   * @return string
   */
  public function get_address_string($delimiter = ', ') {
    $sep = "";
    $op = "";
    if ($this->get_property('place')) {
      $op.= $sep . $this->get_property('place');
      $sep = $delimiter;
    }
    if ($this->get_property('addressStreet')) {
      $op.= $sep . $this->get_property('addressStreet');
      $sep = $delimiter;
    }
    if ($this->get_property('addressTown')) {
      $op.= $sep . $this->get_property('addressTown');
      $sep = $delimiter;
    }
    if ($this->get_property('addressCounty')) {
      $op.= $sep . $this->get_property('addressCounty');
      $sep = $delimiter;
    }
    if ($this->get_property('addressCountry')) {
      $op.= $sep . $this->get_property('addressCountry');
      $sep = $delimiter;
    }
    if ($this->get_property('addressPostcode')) {
      $op.= $sep . $this->get_property('addressPostcode');
      $sep = $delimiter;
    }
    return $op;
  }

  /**
   * Format a short location string town/county/country only
   *
   * @return string
   */
  public function get_location_string($delimiter = ', ') {
    $sep = "";
    $op = "";
    if ($this->get_property('addressTown')) {
      $op.= $sep . $this->get_property('addressTown');
      $sep = $delimiter;
    }
    if ($this->get_property('addressCounty')) {
      $op.= $sep . $this->get_property('addressCounty');
      $sep = $delimiter;
    }
    if ($this->get_property('addressCountry')) {
      $op.= $sep . $this->get_property('addressCountry');
      $sep = $delimiter;
    }
    return $op;
  }

  /**
   *
   * @return string
   */
  public function get_link() {
    return $this->get_property('link');
  }

  /**
   *
   * @return string
   */
  public function get_url() {
    return $this->get_property('url');
  }

  /**
   *
   * @return string
   */
  public function get_image_url() {
    return $this->get_property('graphicUrl');
  }

  /**
   *
   * @return string
   */
  public function get_image_url_large() {
    return str_replace("_thumb","_large", $this->get_property('graphicUrl'));
  }

  /**
   *
   * @return string
   */
  public function get_charges() {
    return $this->get_property('charges');
  }

  /**
   *
   * @return string
   */
  public function get_message() {
    return $this->_message;
  }

  /**
   *
   * @return string
   */
  public function get_error() {
    return $this->_error;
  }

}
