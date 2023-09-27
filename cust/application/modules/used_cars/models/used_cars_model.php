<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class used_cars_model extends CI_Model {

     public function __construct() {
          parent::__construct();
          $this->load->database();
          $this->tbl_products = TABLE_PREFIX . 'products';
          $this->tbl_category = TABLE_PREFIX . 'category';
          $this->tbl_brndcate = TABLE_PREFIX . 'prod_other_brands_with_same_specification';
          $this->tbl_brand = TABLE_PREFIX . 'brand';
          $this->tbt_prod_features = TABLE_PREFIX . "prod_features";
          $this->tbt_connect_with_seller = TABLE_PREFIX . "connect_with_seller";
          $this->tbl_model = TABLE_PREFIX . 'model';
          $this->tbl_variant = TABLE_PREFIX . 'variant';
          $this->tbl_products_image = TABLE_PREFIX . 'prod_images';
     }

     function search($values, $rowno, $rowperpage) {
          
          $brandId = '';
          if (isset($values['brand']) && !empty($values['brand'])) {
               /*$this->db->select('GROUP_CONCAT(brd_id) AS brandId')->from($this->tbl_brand);
               foreach ($values['brand'] as $key => $value) {
                    if ($value != 'used' && $value != 'cars') {
                         $this->db->or_like('brd_title', $value, 'both');
                    }
               }
               $brandId = $this->db->get()->row()->brandId;*/

               $brandId = $this->db->select('GROUP_CONCAT(brd_id) AS brandId')->like('brd_slug', $values['urisegment'], 'both')->get($this->tbl_brand)->row()->brandId;
          }

          

          $return['count'] = $this->db->where(array($this->tbl_products . '.prd_status' => 1, $this->tbl_products . '.prd_added_by_user' => 0))
                          ->where($this->tbl_products . '.prd_rd_mini', 0)->where_in($this->tbl_products . '.prd_brand', $brandId)->count_all_results($this->tbl_products);

          $this->db->limit($rowperpage, $rowno);
          $return['records'] = $this->db->select($this->tbl_products . '.*, IF(prd_show_price = 1, prd_price, 0) AS prd_price, ' . TABLE_PREFIX . 'category.cat_id AS sub_category,' . TABLE_PREFIX . 'category.cat_title AS sub_category_name , ' . TABLE_PREFIX . 'brand.*, '
                          . 'cat1.cat_id AS category_id, cat1.cat_title AS category_name,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*', false)
                  ->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->tbl_products . '.prd_brand', 'left')
                  ->join(TABLE_PREFIX . 'category', TABLE_PREFIX . 'category.cat_id = ' . $this->tbl_products . '.prd_category ', 'left')
                  ->join(TABLE_PREFIX . 'category cat1', 'cat1.cat_id = ' . TABLE_PREFIX . 'category.cat_parent ', 'left')
                  ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')
                  ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left')
                  ->where(array($this->tbl_products . '.prd_status' => 1, $this->tbl_products . '.prd_added_by_user' => 0))
                  ->where_in($this->tbl_products . '.prd_brand', $brandId)->where($this->tbl_products . '.prd_status', 1)
                  ->where($this->tbl_products . '.prd_rd_mini', 0)->order_by($this->tbl_products . '.prd_booking_status ', 'asc')
                  ->order_by($this->tbl_products . '.prd_price  ', 'desc')->get($this->tbl_products)->result_array();
          
          if (!empty($return['records'])) {
                 foreach ($return['records'] as $key => $value) {
                      $return['records'][$key]['product_images'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $return['records'][$key]['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                 }
          } 
          return $return;
     }

     function addConnectWithSeller($data) {
          if (!empty($data)) {
               $this->db->insert($this->tbt_connect_with_seller, $data);
          } else {
               return false;
          }
     }
}
?>