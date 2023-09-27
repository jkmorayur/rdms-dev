<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Accessories_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbt_accessories = TABLE_PREFIX . 'accessories';
       }

       public function getAccessories($id = '') {
           return $this->db->get($this->tbt_accessories)->result_array();
       }
  } 