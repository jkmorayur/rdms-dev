<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Sell_your_vehicle_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_model = TABLE_PREFIX . 'model';
            $this->tbl_variant = TABLE_PREFIX . 'variant';
            $this->tbl_features = TABLE_PREFIX . 'features';
            $this->tbl_products = TABLE_PREFIX . 'products';
            $this->tbl_temp_image = TABLE_PREFIX . 'temp_image';
            $this->tbl_prod_images = TABLE_PREFIX . 'prod_images';
            $this->tbl_prod_features = TABLE_PREFIX . 'prod_features';
       }

       function getFeatures($id = '') {
            if ($id) {
                 $this->db->where('ftr_id', $id);
                 return $this->db->get($this->tbl_features)->row_array();
            } else {
                 return $this->db->get($this->tbl_features)->result_array();
            }
       }

       function addProduct($datas) {
            $datas['basicinfo']['prd_order'] = $this->db->select_max('prd_order')->get($this->tbl_products)->row()->prd_order + 1;
            $datas['basicinfo']['prd_status'] = 0;
            $datas['basicinfo']['prd_added_by_user'] = 1;
            $datas['basicinfo']['prd_user_id'] = get_logged_user('id');
            $datas['basicinfo']['prd_number'] = gen_random();

            $this->db->insert($this->tbl_products, $datas['basicinfo']);
            $prdId = $this->db->insert_id();

            if (isset($datas['imgs']) && !empty($datas['imgs'])) {
                 foreach ($datas['imgs'] as $tkey => $timgId) {
                      $images = $this->db->get_where($this->tbl_temp_image, array('tmp_id' => $timgId))->row_array();
                      if (!empty($images)) {
                           $imgs = array(
                               'pdi_prod_id' => $prdId,
                               'pdi_image' => $images['img'],
                               'pdi_is_default' => $images['img_default']
                           );
                           $this->db->insert($this->tbl_prod_images, $imgs);
                           $this->db->delete($this->tbl_temp_image, array('tmp_id' => $timgId));
                      }
                 }
            }

            if (isset($datas['features']) && !empty($datas['features'])) {
                 foreach ($datas['features'] as $key => $value) {
                      $features = array(
                          'pft_prod_id' => $prdId,
                          'pft_feature_id' => $key,
                      );
                      $this->db->insert($this->tbl_prod_features, $features);
                 }
            }
            return $prdId;
       }

       function updateProduct($datas) {
            $datas['basicinfo']['prd_added_by_user'] = 1;
            $datas['basicinfo']['prd_user_id'] = get_logged_user('id');
            $prdId = $datas['prd_id'];
            $this->db->where('prd_id', $prdId);
            $this->db->update($this->tbl_products, $datas['basicinfo']);
            $images = $this->getTempImage();
            if (!empty($images)) {
                 foreach ($images as $key => $value) {
                      if ($value['img_default'] == 1) {
                           $this->db->where('pdi_prod_id', $prdId);
                           $this->db->update($this->tbl_prod_images, array('pdi_is_default' => 0));
                      }
                 }
                 foreach ($images as $key => $value) {
                      $imgs = array(
                          'pdi_prod_id' => $prdId,
                          'pdi_image' => $value['img'],
                          'pdi_is_default' => $value['img_default']
                      );
                      $this->db->insert($this->tbl_prod_images, $imgs);
                      $this->db->delete($this->tbl_temp_image, array('tmp_id' => $value['tmp_id']));
                 }
            }
            if (isset($datas['features']) && !empty($datas['features'])) {
                 $this->db->delete($this->tbl_prod_features, array('pft_prod_id' => $datas['prd_id']));
                 foreach ($datas['features'] as $key => $value) {
                      $features = array(
                          'pft_prod_id' => $prdId,
                          'pft_feature_id' => $key,
                      );
                      $this->db->insert($this->tbl_prod_features, $features);
                 }
            }
       }

       function addTempImage($image) {
            $temp = array(
                'img' => $image,
                'tmp_user_id' => get_logged_user('id')
            );
            $this->db->insert($this->tbl_temp_image, $temp);
            return $this->db->insert_id();
       }

       function getTempImage() {
            $userId = get_logged_user('id');
            return $this->db->get_where($this->tbl_temp_image, array('tmp_user_id' => $userId))->result_array();
       }

       function removeTempImagesIfAny() {
            $userId = get_logged_user('id');
            $this->db->where('tmp_user_id', $userId);
            $this->db->delete($this->tbl_temp_image);
            return true;
       }

       function getModelByBrand($id) {

            return $this->db->where('mod_brand', $id)->get($this->tbl_model)->result_array();
       }

       function getVariantByModel($id) {
            return $this->db->where('var_model_id', $id)->get($this->tbl_variant)->result_array();
       }

  }
  