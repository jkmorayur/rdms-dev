<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class webvw_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();

            $this->tbl_users = TABLE_PREFIX . 'users';
            $this->tbl_model = TABLE_PREFIX . 'model';
            $this->tbl_brands = TABLE_PREFIX . "brand";
            $this->tbl_variant = TABLE_PREFIX . 'variant';
            $this->rbl_referel = TABLE_PREFIX . 'referel';
            $this->tbl_products = TABLE_PREFIX . "products";
            $this->tbl_products_image = TABLE_PREFIX . "prod_images";
            $this->tbl_products_specification = TABLE_PREFIX . "prod_specifications";
       }

       function getBrands($id = '') {
            $this->db->select('*');
            $this->db->from($this->tbl_brands);
            $this->db->order_by('brd_title');
            $this->db->where('brd_section', 0);
            if (!empty($id)) {
                 $this->db->where('brd_id', $id);
                 $categories = $this->db->get()->row_array();
            } else {
                 $categories = $this->db->get()->result_array();
            } return $categories;
       }

       function getBrandsLog($id = '') {
            $this->db->select('brd_logo,brd_title');
            $this->db->from($this->tbl_brands);
            $this->db->order_by('brd_title');
            $this->db->where('brd_logo <> ""');
            $categories = $this->db->get()->result_array();
            return $categories;
       }
       
       function getLuxuryBrandsLog($id = '') {
            $this->db->select('brd_logo,brd_title');
            $this->db->from($this->tbl_brands);
            $this->db->order_by('brd_title');
            $this->db->where('brd_logo <> ""');
            $this->db->where('brd_section', 0);
            $categories1 = $categories2 = $this->db->get()->result_array();
            return array_merge($categories1, $categories2);
       }
       
       function getVehicle($id = '', $limit = 4) {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            if ($id) {
                 $this->db->where($this->tbl_products . '.prd_id', $id);
            } $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->limit($limit);
            $productsArray = $this->db->get()->result_array();
            $products['product_details'] = array();
            $products['product_specification'] = array();
            $products['product_images'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      if ($id) {
                           $products['product_details'] = $value;
                      } else {
                           $products['product_details'][] = $value;
                      }
                 }
            } return $products;
       }


       function rdMiniVehiclestest() {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
//            $this->db->order_by($this->tbl_products . '.prd_price', 'desc');
            $this->db->order_by($this->tbl_products . '.prd_order', 'asc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->where($this->tbl_products . '.prd_popular', 0);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 1);
            $productsArray = $this->db->get()->result_array();
            echo $this->db->last_query();exit;
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } 
            
            return $products;
       }

        function rdMiniVehicles($start = 0, $limit = 2, $count= '') {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
//            $this->db->order_by($this->tbl_products . '.prd_price', 'desc');
            $this->db->order_by($this->tbl_products . '.prd_order', 'asc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->where($this->tbl_products . '.prd_popular', 0);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 1);
             $this->db->limit($limit, $start);
            $productsArray = $this->db->get()->result_array();
              $products['limit'] = $limit;
            $products['start'] = $start;
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } return $products;
       }

       function vehiclesNearByYou() {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->order_by($this->tbl_products . '.prd_id', 'RANDOM');
            $productsArray = $this->db->get()->result_array();
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } return $products;
       }

       function referFriend($data) {
            if (!empty($data)) {
                 if (isset($data['ref_user_id']) && !empty($data['ref_user_id'])) {
                      $update['first_name'] = $data['ref_first_name'];
                      $update['last_name'] = $data['ref_last_name'];
                      $this->db->where('id', $data['ref_user_id']);
                      $this->db->update($this->tbl_users, $update);
                 }
                 $this->db->insert($this->rbl_referel, $data);
                 return true;
            } else {
                 return false;
            }
       }

       function getAllVehicle($id = '') {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            if ($id) {
                 $this->db->where($this->tbl_products . '.prd_id', $id);
            } $this->db->where($this->tbl_products . '.prd_status', 1);
            //$this->db->limit($limit);
            $productsArray = $this->db->get()->result_array();
            $products['product_details'] = array();
            $products['product_specification'] = array();
            $products['product_images'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->select("CONCAT('http://royaldrive.in/assets/uploads/product/', pdi_image) AS pdi_image", false)
                                      ->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->select("CONCAT('http://royaldrive.in/assets/uploads/product/', pdi_image) AS pdi_image", false)
                                      ->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      if ($id) {
                           $products['product_details'] = $value;
                      } else {
                           $products['product_details'][] = $value;
                      }
                 }
            } return $products;
       }
          function vehiclesCount($category) {
            if ($category == 'new') {

                 $query = $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')->where('prd_latest', 1)->where('prd_rd_mini', 1)->where('prd_status', 1)->where($this->tbl_model . '.mod_is_ev', 0)->get($this->tbl_products);
                 return $query->num_rows();
            }
            if ($category == 'popular') {
                 $query = $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')->where('prd_popular', 1)->where('prd_rd_mini', 1)->where('prd_status', 1)->where($this->tbl_model . '.mod_is_ev', 0)->get($this->tbl_products);
                 return $query->num_rows();
            }
            if ($category == 'rdMini') {
                 //$query = $this->db->where('prd_popular', 0)->where('prd_rd_mini', 1)->where('prd_status',1)->get($this->tbl_products);
                 $query = $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')->where('prd_rd_mini', 1)->where('prd_status', 1)->where($this->tbl_model . '.mod_is_ev', 0)->get($this->tbl_products);
                 return $query->num_rows();
                // $count = $this->db->get()->num_rows();
                // return $count;
            }
             if ($category == 'ev') {
                 $query = $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')->where('prd_rd_mini', 1)->where($this->tbl_model . '.mod_is_ev', 1)->where('prd_status', 1)->get($this->tbl_products);
                 return $query->num_rows();
            }
       }
       function ev($start = 0, $limit = 2, $countnew = '') {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            $this->db->order_by($this->tbl_products . '.prd_booking_status ', 'asc');
            $this->db->order_by($this->tbl_products . '.prd_price  ', 'desc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            //$this->db->where($this->tbl_products . '.prd_latest', 1);
            $this->db->where($this->tbl_model . '.mod_is_ev', 1);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 1);
            $this->db->limit($limit, $start);
            $productsNoBkdSld = $this->db->get()->result_array();
            $productsArray = $productsNoBkdSld;
            $products['limit'] = $limit;
            $products['start'] = $start;
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;

                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } return $products;
       }
       
       function newArrivals($start = 0, $limit = 2, $countnew = '') {
            $this->db->select($this->tbl_products . '.*, IF(prd_show_price = 1, prd_price, "0") AS prd_price,' . $this->tbl_brands . '.*,' . 
            $this->tbl_model . '.*,' . $this->tbl_variant . '.*', false)->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            $this->db->order_by($this->tbl_products . '.prd_booking_status', 'asc');
            $this->db->order_by($this->tbl_products . '.prd_price', 'desc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->where($this->tbl_products . '.prd_latest', 1);
            $this->db->where($this->tbl_model . '.mod_is_ev', 0);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 1);
            $this->db->limit($limit, $start);
            $productsNoBkdSld = $this->db->get()->result_array();
            $productsArray = $productsNoBkdSld;
            $products['limit'] = $limit;
            $products['start'] = $start;
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;

                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } 
            debug($products);
            return $products;
       }
        function popularVehicles($start = 0, $limit = 2) {
            $this->db->select($this->tbl_products . '.*, ' . $this->tbl_brands . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
            $this->db->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            $this->db->order_by($this->tbl_products . '.prd_booking_status ', 'asc');
            $this->db->order_by($this->tbl_products . '.prd_price  ', 'desc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->where($this->tbl_products . '.prd_popular', 1);
             $this->db->where($this->tbl_model . '.mod_is_ev', 0);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 1);
            $this->db->limit($limit, $start);
            $productsNoBkdSld = $this->db->get()->result_array();
            $products['asizeNew'] = sizeof($productsNoBkdSld);
            $productsArray = $productsNoBkdSld;
            $products['product_details'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where($this->tbl_products_specification, array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $value['product_specification'] = $prodSpecifications;
                      $value['product_images'] = $prodImages;
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $products['product_details'][] = $value;
                 }
            } return $products;
       }

  }
  