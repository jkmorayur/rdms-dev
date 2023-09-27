<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Search_model extends CI_Model {

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

       function search($values) {

            if (isset($values['fual-type']) && !empty($values['fual-type'])) {
                 if ($values['fual-type'] == 'diesel') {
                      $values['fual-type'] = 1;
                 } else if ($values['fual-type'] == 'petrol') {
                      $values['fual-type'] = 2;
                 } else if ($values['fual-type'] == 'gas') {
                      $values['fual-type'] = 3;
                 }
            }
            $brandId = '';
            if (isset($values['brand']) && !empty($values['brand'])) {
                 $values['brand'] = explode(',', $values['brand']);
                 $values['brand'] = array_map('putquote', $values['brand']);
                 $brands = implode(',', $values['brand']);
                 $brandId = $this->db->select('GROUP_CONCAT(brd_id) AS brandId')->from($this->tbl_brand)
                                 ->where('brd_title IN(' . $brands . ')')
                                 ->get()->row_array();
            }

            $this->db->select($this->tbl_products . '.*, IF(prd_show_price = 1, prd_price, 0) AS prd_price,' . TABLE_PREFIX . 'category.cat_id AS sub_category,' . TABLE_PREFIX . 'category.cat_title AS sub_category_name , ' . TABLE_PREFIX . 'brand.*, '
                    . 'cat1.cat_id AS category_id, cat1.cat_title AS category_name,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*', false)->from($this->tbl_products);
            $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join(TABLE_PREFIX . 'category', TABLE_PREFIX . 'category.cat_id = ' . $this->tbl_products . '.prd_category ', 'left');
            $this->db->join(TABLE_PREFIX . 'category cat1', 'cat1.cat_id = ' . TABLE_PREFIX . 'category.cat_parent ', 'left');

            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');

            if (isset($brandId['brandId']) && !empty($brandId['brandId'])) {
                 $this->db->where($this->tbl_products . '.prd_brand IN(' . $brandId['brandId'] . ')');
            }

            if (isset($values['keyword']) && !empty($values['keyword'])) {
                 $values['keyword'] = trim(urldecode($values['keyword']));
                 $like = " LIKE '%" . $values['keyword'] . "%'";
                 $this->db->where('(' . $this->tbl_products . ".prd_name" . $like . 
                         ' OR ' . $this->tbl_model . '.mod_title' . $like . 
                         ' OR ' . $this->tbl_variant . '.var_variant_name' . $like . 
                         ' OR ' . $this->tbl_brand . '.brd_title' . $like . ' )');
            }

            if (isset($values['budget']) && !empty($values['budget'])) {
                 $this->db->or_where($this->tbl_products . '.prd_price >=', $values['budget']);
            }

            if (isset($values['fual-type']) && !empty($values['fual-type'])) {
                 $this->db->where($this->tbl_products . '.prd_fual =', $values['fual-type']);
            }

            if (isset($values['color']) && !empty($values['color'])) {
                 $this->db->where($this->tbl_products . '.prd_color =', $values['color']);
            }

            if (isset($values['km-driven']) && !empty($values['km-driven'])) {
                 $kmFr = $values['km-driven'] + 1000;
                 $kmto = $values['km-driven'] - 1000;
                 $this->db->where($this->tbl_products . '.prd_km_run BETWEEN ' . $kmFr . ' AND ' . $kmto);
            }

            if (isset($values['budget-from']) || !empty($values['budget-to'])) {

                 if (isset($values['budget-from']) && !empty($values['budget-from'])) {
                      $this->db->or_where($this->tbl_products . '.prd_price >=', $values['budget-from']);
                 } else if (isset($values['budget-to']) && !empty($values['budget-to'])) {
                      $this->db->or_where($this->tbl_products . '.prd_price <=', $values['budget-to']);
                 } else {
                      $this->db->or_where($this->tbl_products . '.prd_price >=', $values['budget-from'] . ' <= ' . $values['budget-to']);
                 }
            }
            if (isset($values['model-from']) || isset($values['model-to'])) {

                 if (isset($values['model-from']) && !empty($values['model-from'])) {
                      $this->db->or_where($this->tbl_products . '.prd_year >=', $values['model-from']);
                 } else if (isset($values['model-to']) && !empty($values['model-to'])) {
                      $this->db->or_where($this->tbl_products . '.prd_year <=', $values['model-to']);
                 } else {
                      $this->db->or_where($this->tbl_products . '.prd_year >=', $values['model-from'] . ' <= ' . $values['model-to']);
                 }
            }
            /* Sort */
            $this->db->order_by($this->tbl_products . '.prd_soled', 'asc');
            $this->db->order_by($this->tbl_products . '.prd_booked', 'asc');
            if (isset($values['sort']) && !empty($values['sort'])) {
                 if ($values['sort'] == 'new') //new
                      $this->db->order_by($this->tbl_products . '.prd_date', 'desc');

                 if ($values['sort'] == 'high-price') //high-price
                      $this->db->order_by($this->tbl_products . '.prd_price', 'desc');

                 if ($values['sort'] == 'low-price') //low-price
                      $this->db->order_by($this->tbl_products . '.prd_price', 'asc');
            }
            
            /**/
            $this->db->where($this->tbl_products . '.prd_rd_mini', 0);
            $this->db->where($this->tbl_products . '.prd_added_by_user', 0);
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $productsArray = $this->db->get()->result_array();
            
            $products = array();
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
                      $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $features = $this->db->select("GROUP_CONCAT(pft_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();

                      $value['product_specification'] = $prodSpecifications;
                      $value['product_features'] = isset($features['features']) ? $features['features'] : '';
                      $value['default_image'] = $this->db->get_where($this->tbl_products_image, array('pdi_prod_id' => $value['prd_id'], 'pdi_is_default' => 1))->row_array();
                      $value['product_images'] = $prodImages;
                      $products['product_details'][] = $value;
                 }
            }
            return $products;
       }

       function addConnectWithSeller($data) {
            if (!empty($data)) {
                 $data['cws_added_date'] = date('Y-m-d H:i:s');
                 $this->db->insert($this->tbt_connect_with_seller, $data);
            } else {
                 return false;
            }
       }

  }

?>
