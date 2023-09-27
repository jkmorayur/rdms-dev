<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class reports_model extends CI_Model {

       public function __construct() {

            parent::__construct();
            $this->load->database();
            $this_month = date('m');
            $shoroom = 2;
            $this->tbl_showroom ='cpnl_showroom';
            $this->tbl_divisions = 'cpnl_divisions';
            $this->tbl_departments='cpnl_departments';
           
       }
       
        public function price_list($div = '', $shrm = '') {//yes
          $this->db->query('SET SQL_BIG_SELECTS=1'); 
            if ($div) {
                 if ($div == 2 && $shrm == '') {

                      $res = $this->db->query("CALL sp_price_list_luxury()")->result_array();
                 } elseif ($shrm) {

                      $res = $this->db->query("CALL sp_price_list_by_shrm($shrm)")->result_array();
                 } elseif ($div == 1) {
                      $res = $this->db->query("CALL sp_price_list_smart()")->result_array();
                 }
            } else {
                 $res = $this->db->query("CALL sp_price_list_all()")->result_array();
            }
            error_reporting(0);
            $this->db->reconnect();
            return $res;
       }

public function getActiveData() {//yes
     $this->db->query('SET SQL_BIG_SELECTS=1'); 
            return $this->db->where('div_status', 1)->get('cpnl_divisions')->result_array();
       }
           function bindShowroomByDivision($div) {//yes
            $return['associatedShowroom'] = $this->db->select($this->tbl_showroom . '.shr_id AS col_id, ' . $this->tbl_showroom . '.shr_location AS col_title')
                            ->where(array('shr_division' => $div))->get($this->tbl_showroom)->result_array();

            $return['notAssociatedShowroom'] = $this->db->select($this->tbl_showroom . '.shr_id AS col_id, ' . $this->tbl_showroom . '.shr_location AS col_title')
                            ->where(array('shr_division != ' => $div))->get($this->tbl_showroom)->result_array();

            $return['notAssociatedDivision'] = $this->db->select($this->tbl_divisions . '.div_id AS col_id, ' . $this->tbl_divisions . '.div_name AS col_title')
                            ->where(array('div_id != ' => $div, 'div_status' => 1))->get($this->tbl_divisions)->result_array();

            $selectArray = array(
                $this->tbl_departments . '.dep_id',
                $this->tbl_departments . '.dep_name',
                $this->tbl_departments . '.dep_is_sale_rel',
                'parentDep.dep_name AS dep_parent_name'
            );

            $return['departments'] = $this->db->select($selectArray, false)->join($this->tbl_departments . ' parentDep', 'parentDep.dep_id = ' . $this->tbl_departments . '.dep_parent', 'LEFT')
                            ->where(array($this->tbl_departments . '.dep_status' => 1, $this->tbl_departments . '.dep_division' => $div))
                            ->get($this->tbl_departments)->result_array();

            return $return;
       }

     
}
  