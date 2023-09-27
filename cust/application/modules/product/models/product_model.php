<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class product_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_products = TABLE_PREFIX . 'products';
            $this->tbl_category = TABLE_PREFIX . 'category';
            $this->tbl_features = TABLE_PREFIX . 'features';
            $this->tbt_prod_features = TABLE_PREFIX . 'prod_features';
            $this->tbt_prod_images = TABLE_PREFIX . 'prod_images';
            $this->tbt_temp_image = TABLE_PREFIX . 'temp_image';
            $this->tbl_model = TABLE_PREFIX . 'model';
            $this->tbl_variant = TABLE_PREFIX . 'variant';
       }

       function getAllFeatures() {
            return $this->db->order_by('ftr_feature')->get($this->tbl_features)->result_array();
       }

       public function getVehicle($id) {

            if (!empty($id)) {

                 $this->db->select($this->tbl_products . '.*, ' . TABLE_PREFIX . 'brand.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
                 $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');

                 $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
                 $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');

                 $this->db->where($this->tbl_products . '.prd_id', $id);
                 $productsArray = $this->db->get()->result_array();
                 $products['product_details'] = array();
                 $products['product_specification'] = array();
                 $products['product_images'] = array();

                 if (!empty($productsArray)) {
                      foreach ($productsArray as $key => $value) {
                           $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();

                           $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                           $features = $this->db->select("GROUP_CONCAT(pft_feature_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();

                           $value['product_features'] = isset($features['features']) ? $features['features'] : '';

                           $value['product_specification'] = $prodSpecifications;

                           $value['product_images'] = $prodImages;
                           $products = $value;
                      }
                 }
                 return $products;
            } else {
                 return null;
            }
       }
       
       public function getRelatedVehicles($id) {
            if (!empty($id)) {
                 
                 $vehDetails = $this->db->get_where($this->tbl_products, array('prd_id' => $id))->row_array();
                 $priceFrom = isset($vehDetails['prd_price']) ? $vehDetails['prd_price'] - 500000 : 0;
                 $priceTo = isset($vehDetails['prd_price']) ? $vehDetails['prd_price'] + 1500000 : 0;
                 
                 $this->db->select($this->tbl_products . '.*, ' . TABLE_PREFIX . 'brand.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
                 $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');

                 $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
                 $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');

                 $this->db->where($this->tbl_products . '.prd_price >= ', $priceFrom);
                 $this->db->where($this->tbl_products . '.prd_price <= ', $priceTo);
                 $this->db->where($this->tbl_products .  '.prd_id != ' , $id);
                 $this->db->where($this->tbl_products .  '.prd_booked', 0);
                 $this->db->where($this->tbl_products .  '.prd_soled', 0);
                 $productsArray = $this->db->get()->result_array();
                 $products = array();
                 if (!empty($productsArray)) {
                      foreach ($productsArray as $key => $value) {
                           $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();

                           $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                           $features = $this->db->select("GROUP_CONCAT(pft_feature_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();

                           $value['product_features'] = isset($features['features']) ? $features['features'] : '';

                           $value['product_specification'] = $prodSpecifications;

                           $value['product_images'] = $prodImages;
                           $products[] = $value;
                      }
                 }
                 return $products;
            } else {
                 return null;
            }
       }

       public function getMyVehicles() {
            $userId = get_logged_user('id');
            if (!empty($userId)) {

                 $this->db->select($this->tbl_products . '.*, ' . TABLE_PREFIX . 'brand.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')->from($this->tbl_products);
                 $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');

                 $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
                 $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');

                 $this->db->where($this->tbl_products . '.prd_user_id', $userId);
                 $productsArray = $this->db->get()->result_array();
                 $products = array();

                 if (!empty($productsArray)) {
                      foreach ($productsArray as $key => $value) {
                           $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();

                           $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                           $features = $this->db->select("GROUP_CONCAT(pft_feature_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();

                           $value['product_features'] = isset($features['features']) ? $features['features'] : '';

                           $value['product_specification'] = $prodSpecifications;

                           $value['product_images'] = $prodImages;
                           $products[] = $value;
                      }
                 }
                 return $products;
            } else {
                 return null;
            }
       }

       public function removePrductImage($id) {
            if ($id) {
                 $this->db->where('pdi_id', $id);
                 $image = $this->db->get($this->tbt_prod_images)->row_array();
                 if (isset($image['pdi_image']) && !empty($image['pdi_image'])) {
                      if (file_exists('./assets/uploads/product/' . $image['pdi_image'])) {
                           @unlink('./assets/uploads/product/' . $image['pdi_image']);
                           @unlink('./assets/uploads/product/thumb_' . $image['pdi_image']);
                      }
                      $this->db->where('pdi_id', $id);
                      $this->db->delete($this->tbt_prod_images);
                      return true;
                 }
            }
            return false;
       }

       public function removePrductTempImage($id) {
            if ($id) {
                 $this->db->where('tmp_id', $id);
                 $image = $this->db->get($this->tbt_temp_image)->row_array();
                 if (isset($image['img']) && !empty($image['img'])) {
                      if (file_exists('./assets/uploads/product/' . $image['img'])) {
                           @unlink('./assets/uploads/product/' . $image['img']);
                           @unlink('./assets/uploads/product/thumb_' . $image['img']);
                      }
                      $this->db->where('tmp_id', $id);
                      $this->db->delete($this->tbt_temp_image);
                      return true;
                 }
            }
            return false;
       }

       public function deleteProduct($id) {
            if (!empty($id)) {
                 $this->db->delete($this->tbl_products, array('prd_id' => $id));
                 $this->db->delete(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $id));

                 $this->db->where('pdi_prod_id', $id);
                 $images = $this->db->get(TABLE_PREFIX . 'prod_images')->result_array();
                 $this->db->delete(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $id));
                 if (!empty($images)) {
                      foreach ($images as $key => $value) {
                           if (file_exists('./assets/uploads/product/' . $value['pdi_image'])) {
                                @unlink('./assets/uploads/product/' . $value['pdi_image']);
                                @unlink('./assets/uploads/product/thumb_' . $value['pdi_image']);
                           }
                      }
                 }

                 return true;
            } else {
                 return false;
            }
       }
       
       function setDefaultImage($id) {
            $userId = get_logged_user('id');
            $this->db->where('tmp_user_id', $userId);
            $this->db->update($this->tbt_temp_image, array('img_default' => 0));

            $this->db->where('tmp_id', $id);
            $this->db->update($this->tbt_temp_image, array('img_default' => 1));
       }

       function setDefaultImageUpdate($id, $prodId) {
            $this->db->where('pdi_prod_id', $prodId);
            $this->db->update($this->tbt_prod_images, array('pdi_is_default' => 0));

            $this->db->where('pdi_id', $id);
            $this->db->update($this->tbt_prod_images, array('pdi_is_default' => 1));
       }
  }