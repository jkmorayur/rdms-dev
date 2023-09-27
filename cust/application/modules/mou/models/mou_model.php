<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class mou_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_users = TABLE_PREFIX_PORTAL . 'users';
            $this->tbl_mou_rf = TABLE_PREFIX_PORTAL . 'mou_rf';
            $this->tbl_showroom = TABLE_PREFIX_PORTAL . 'showroom';
            $this->tbl_mou_master = TABLE_PREFIX_PORTAL . 'mou_master';
            $this->tbl_designation = TABLE_PREFIX_PORTAL . 'designation';
            $this->tbl_model = TABLE_PREFIX . 'model';
            $this->tbl_brand = TABLE_PREFIX . 'brand';
            $this->tbl_variant = TABLE_PREFIX . 'variant';
            $this->tbl_divisions = TABLE_PREFIX_PORTAL . 'divisions';
            $this->tbl_district_statewise = TABLE_PREFIX_PORTAL . 'district_statewise';
            $this->tbl_mou_identification = TABLE_PREFIX_PORTAL . 'mou_identification';
            $this->tbl_mou_service_package = TABLE_PREFIX_PORTAL . 'mou_service_package';
       }

       function getMou($id) {

            $return['master'] = $this->db->select($this->tbl_mou_master . '.*,' . $this->tbl_district_statewise . '.*,' .
                                    $this->tbl_brand . '.brd_title,' . $this->tbl_model . '.mod_title,' . $this->tbl_variant . '.var_variant_name,' .
                                    $this->tbl_users . '.usr_username,' . $this->tbl_designation . '.desig_title')
                            ->join($this->tbl_district_statewise, $this->tbl_district_statewise . '.std_id = ' . $this->tbl_mou_master . '.moum_dist', 'LEFT')
                            ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_mou_master . '.moum_brand', 'LEFT')
                            ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_mou_master . '.moum_model', 'LEFT')
                            ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_mou_master . '.moum_varient', 'LEFT')
                            ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_mou_master . '.moum_pur_staff', 'LEFT')
                            ->join($this->tbl_designation, $this->tbl_designation . '.desig_id = ' . $this->tbl_users . '.usr_designation_new', 'LEFT')
                            ->get_where($this->tbl_mou_master, array('moum_token' => $id))->row_array();
            $id = isset($return['master']['moum_id']) ? $return['master']['moum_id'] : 0;
            if(!empty($id)) {
               $return['rf'] = $this->db->get_where($this->tbl_mou_rf, array('mour_master' => $id))->result_array();
               $return['service'] = $this->db->get_where($this->tbl_mou_service_package, array('mous_master' => $id))->result_array();
               $return['identification'] = $this->db->get_where($this->tbl_mou_identification, array('moui_master' => $id))->result_array();
               return $return;
            } else {
               return 0;
            }
       }
       
       function approval($id) {
            $data['moum_approved_on'] = date('Y-m-d H:i:s');
            $this->db->where('moum_id', $id)->update($this->tbl_mou_master, $data);
            return true;
       }
  }