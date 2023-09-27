<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class special_promotion_model extends CI_Model {

     public function __construct() {
          parent::__construct();
          $this->load->database();
          $this->tbl_brand = TABLE_PREFIX . 'brand';
          $this->tbl_model = TABLE_PREFIX . 'model';
          $this->tbl_variant = TABLE_PREFIX . 'variant';
          $this->tbl_products = TABLE_PREFIX . 'products';
          $this->tbl_event_enquires = TABLE_PREFIX_PORTAL . 'event_enquires';
     }

     function create($data) {
          $data['eve_added_on'] = date('Y-m-d H:i:s');
          $this->db->insert($this->tbl_event_enquires, $data);
          return true;
     }

     function getProductDetails($prdId) {
          return $this->db->select($this->tbl_products . '.prd_id, ' . $this->tbl_brand . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')
                  ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left')
                  ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')
                  ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left')
                  ->where($this->tbl_products . '.prd_id', $prdId)->get($this->tbl_products)->row_array();
     }

     public function getBrands($id = '') {
          $this->db->select("branda.*, brandb.brd_title AS parent")
                  ->from($this->tbl_brand . ' branda')
                  ->join($this->tbl_brand . ' brandb', 'branda.brd_parent = brandb.brd_id', 'left');

          if (!empty($id)) {
               $this->db->where('branda.brd_id', $id);
          }
          $this->db->order_by('branda.brd_title', 'asc');
          $brands = $this->db->get()->result_array();
          return $brands;
     }

     function getModel($id = '') {
          if (!empty($id)) {
               $this->db->where($this->tbl_model . '.mod_id', $id);
               return $this->db->select($this->tbl_model . '.*,' . $this->tbl_brand . '.*')->from($this->tbl_model, false)
                               ->join($this->tbl_brand, $this->tbl_model . '.mod_brand = ' . $this->tbl_brand . '.brd_id', 'left')
                               ->get()->row_array();
          } else {
               return $this->db->select($this->tbl_model . '.*,' . $this->tbl_brand . '.*')->from($this->tbl_model, false)
                               ->join($this->tbl_brand, $this->tbl_model . '.mod_brand = ' . $this->tbl_brand . '.brd_id', 'left')
                               ->get()->result_array();
          }
     }

     function getModelByBrand($id) {
          return $this->db->select($this->tbl_model . '.*, mod_id AS col_id, mod_title AS col_title')
               ->where_in('mod_brand', $id)->get($this->tbl_model)->result_array();
     }

    function getVariantByModel($id)
     {
          return $this->db->select($this->tbl_variant . '.*, var_id AS col_id, var_variant_name AS col_title')
               ->where_in('var_model_id', $id)->get($this->tbl_variant)->result_array();
     }

     function getBMV($b, $m, $v) {
          $bn = ''; $mn = ''; $vn = '';
          if($b) {
               $bn = $this->db->get_where($this->tbl_brand, array('brd_id' => $b))->row()->brd_title;
          }
          if($m) {
               $mn = $this->db->get_where($this->tbl_model, array('mod_id' => $m))->row()->mod_title;
          }
          if($m) {
               $vn = $this->db->get_where($this->tbl_variant, array('var_id' => $v))->row()->var_variant_name;
          }
          return $bn . ', ' . $mn . ', ' . $vn;
     }
}