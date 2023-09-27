<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class careerback_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_careers = TABLE_PREFIX_PORTAL . 'careers';
            $this->tbl_careers_applications = TABLE_PREFIX_PORTAL . 'careers_applications';
       }
       
       function getCareerPosts($id = '') {
            if (!empty($id)) {
                 return $this->db->get_where($this->tbl_careers, array('car_id' => $id))->row_array();
            }
            return $this->db->where('car_status', 1)->order_by('car_order', 'ASC')->get($this->tbl_careers)->result_array();
       }
       
       function newCareer($data) {
            if (!empty($data)) {
                 $this->db->insert($this->tbl_careers_applications, $data);
                 return true;
            } else {
                 return false;
            }
       }
  }