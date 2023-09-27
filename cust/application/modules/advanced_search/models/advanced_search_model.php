<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Advanced_search_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'products';
            $this->tbt_prod_features = TABLE_PREFIX . 'prod_features';
       }

       public function getAccessories($id = '') {
            $this->db->select($this->table . '.*, ' . TABLE_PREFIX . 'category.cat_id AS sub_category,' . TABLE_PREFIX . 'category.cat_title AS sub_category_name , ' . TABLE_PREFIX . 'brand.*, '
                    . 'cat1.cat_id AS category_id, cat1.cat_title AS category_name')->from($this->table);
            $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->table . '.prd_brand', 'left');
            $this->db->join(TABLE_PREFIX . 'category', TABLE_PREFIX . 'category.cat_id = ' . $this->table . '.prd_category ', 'left');
            $this->db->join(TABLE_PREFIX . 'category cat1', 'cat1.cat_id = ' . TABLE_PREFIX . 'category.cat_parent ', 'left');
            if ($id) {
                 $this->db->where($this->table . '.prd_id', $id);
            }

            $productsArray = $this->db->get()->result_array();
            $products['product_details'] = array();
            $products['product_specification'] = array();
            $products['product_images'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      
                      if ($value['prd_fual'] == 1) {
                           $value['prd_fual_type'] = 'Diesel';
                      } else if ($value['prd_fual'] == 2) {
                           $value['prd_fual_type'] = 'Petrol';
                      } else if ($value['prd_fual'] == 3) {
                           $value['prd_fual_type'] = 'Gas';
                      }
                      
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();

                      $features = $this->db->select("GROUP_CONCAT(pft_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();

                      $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();

                      $value['product_specification'] = $prodSpecifications;
                      $value['product_features'] = isset($features['features']) ? $features['features'] : '';
                      $value['product_images'] = $prodImages;

                      if ($id) {
                           $products['product_details'] = $value;
                      } else {
                           $products['product_details'][] = $value;
                      }
                 }
            }
            return $products;
       }
  } 