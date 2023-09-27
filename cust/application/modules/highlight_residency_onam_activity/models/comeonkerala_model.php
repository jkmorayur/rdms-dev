<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class comeonkerala_model extends CI_Model {

     public function __construct() {
          parent::__construct();
          $this->load->database();
          $this->tbl_users = TABLE_PREFIX_PORTAL . 'users';
          $this->tbl_brand = TABLE_PREFIX . 'brand';
          $this->tbl_model = TABLE_PREFIX . 'model';
          $this->tbl_variant = TABLE_PREFIX . 'variant';
          $this->tbl_products = TABLE_PREFIX . 'products';
          $this->tbl_event_enquires = TABLE_PREFIX_PORTAL . 'event_enquires';
          $this->tbl_event_enquires_referals = TABLE_PREFIX_PORTAL . 'event_enquires_referals';
          $this->tbl_event_enquires_lucky_draw = TABLE_PREFIX_PORTAL . 'event_enquires_lucky_draw';
          $this->tbl_event_enquires_lucky_draw_referals = TABLE_PREFIX_PORTAL . 'event_enquires_lucky_draw_referals';
     }

     function checkIfExists($datas) {
          //debug($datas);
          $NRIMobile = substr(str_replace(' ', '', trim($datas['eve_mobile_non_india'])),  -10);
          $INMobile = substr(str_replace(' ', '', trim($datas['eve_mobile'])),  -10);

          if(!empty($NRIMobile) && !empty($INMobile)) {
               $return = $this->db->like('eve_mobile_non_india', $NRIMobile, 'both')
                          ->or_like('eve_mobile', $INMobile, 'both')->get($this->tbl_event_enquires)->result_array();
          } else if(!empty($NRIMobile)) {
               $return = $this->db->like('eve_mobile_non_india', $NRIMobile, 'both')->get($this->tbl_event_enquires)->result_array();
          } else if(!empty($INMobile)) {
               $return = $this->db->like('eve_mobile', $INMobile, 'both')->get($this->tbl_event_enquires)->result_array();
          }
          return $return;
     }

     function create($data) {
          $refer = isset($data['refer']) ? $data['refer'] : '';
          unset($data['refer']);
          $data['eve_added_on'] = date('Y-m-d H:i:s');
          $data['eve_mobile_non_india'] = $data['eve_mobile_non_india_code'] . $data['eve_mobile_non_india'];
          $data['eve_mobile'] = $data['eve_mobile_india_code'] . $data['eve_mobile'];
          $data['eve_event'] = 19;
          unset($data['radUseMe']);
          unset($data['eve_mobile_non_india_code']);
          unset($data['eve_mobile_india_code']);
          $data['eve_auther_id'] = encrypt(trim($data['eve_auther_id']), 'D');
          $this->db->insert($this->tbl_event_enquires, array_filter($data));
          $enqId = $this->db->insert_id();
          $refCount = isset($refer['eve_ref_name']) ? count($refer['eve_ref_name']) : 0;
          if (isset($refer) && !empty($refer) && ($refCount > 0)) {
               foreach ($refer['eve_ref_name'] as $key => $value) {
                    $name = isset($refer['eve_ref_name'][$key]) ? $refer['eve_ref_name'][$key] : '';
                    if (!empty($name)) {
                         $ref['eer_enq_id'] = $enqId;
                         $ref['eer_name'] = isset($refer['eve_ref_name'][$key]) ? $refer['eve_ref_name'][$key] : '';
                         $ref['eer_mobile'] = isset($refer['eve_mobile_non_india'][$key]) ? $refer['eve_mobile_ref_non_india_code'][$key] . $refer['eve_mobile_non_india'][$key] : '';
                         $ref['eer_mobile_in'] = isset($refer['eve_mobile_india'][$key]) ? $refer['eve_mobile_ref_india_code'][$key] . $refer['eve_mobile_india'][$key] : '';
                         $ref['eer_job'] = isset($refer['eve_ref_job'][$key]) ? $refer['eve_ref_job'][$key] : '';
                         $ref['eer_location'] = isset($refer['eve_ref_location'][$key]) ? $refer['eve_ref_location'][$key] : '';
                         $this->db->insert($this->tbl_event_enquires_referals, array_filter($ref));
                    }
               }
          }
          return true;
     }

     function getProductDetails($prdId) {
          return $this->db->select($this->tbl_products . '.prd_id, ' . $this->tbl_brand . '.*,' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*')
                          ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left')
                          ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left')
                          ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left')
                          ->where($this->tbl_products . '.prd_id', $prdId)->get($this->tbl_products)->row_array();
     }

     function luckyDraw($data) {
          $refer = isset($data['refer']) ? $data['refer'] : '';

          $uniqPhone = !empty($data['eeld_phone_nri']) ? $data['eeld_phone_nri'] : $data['eeld_phone_in'];
          $uniqPhone = (int) filter_var(substr($uniqPhone, -10), FILTER_SANITIZE_NUMBER_INT);
          $uniqPhone = rand(0, 999) * $uniqPhone;
          $data['eeld_ref_no'] = $uniqPhone;
          
          $data['eeld_added_on'] = date('Y-m-d H:i:s');
          $data['eeld_phone_in'] = $data['eeld_phone_in_code'] . $data['eeld_phone_in'];
          $data['eeld_phone_nri'] = $data['eeld_phone_nri_code'] . $data['eeld_phone_nri'];

          unset($data['refer']);
          unset($data['eeld_phone_in_code']);
          unset($data['eeld_phone_nri_code']);

          $this->db->insert($this->tbl_event_enquires_lucky_draw, array_filter($data));
          $enqId = $this->db->insert_id();

          $refCount = isset($refer['eve_ref_name']) ? count($refer['eve_ref_name']) : 0;
          if (isset($refer) && !empty($refer) && ($refCount > 0)) {
               foreach ($refer['eve_ref_name'] as $key => $value) {
                    $ref['eeldr_enq_id'] = $enqId;
                    $name = isset($refer['eve_ref_name'][$key]) ? $refer['eve_ref_name'][$key] : '';
                    if (!empty($name)) {
                         $ref['eeldr_name'] = isset($refer['eve_ref_name'][$key]) ? $refer['eve_ref_name'][$key] : '';
                         $ref['eeldr_mobile'] = isset($refer['eve_mobile_non_india'][$key]) ? $refer['eve_mobile_ref_non_india_code'][$key] . $refer['eve_mobile_non_india'][$key] : '';
                         $ref['eeldr_mobile_in'] = isset($refer['eve_mobile_india'][$key]) ? $refer['eve_mobile_ref_india_code'][$key] . $refer['eve_mobile_india'][$key] : '';
                         $ref['eeldr_job'] = isset($refer['eve_ref_job'][$key]) ? $refer['eve_ref_job'][$key] : '';
                         $ref['eeldr_location'] = isset($refer['eve_ref_location'][$key]) ? $refer['eve_ref_location'][$key] : '';
                         $this->db->insert($this->tbl_event_enquires_lucky_draw_referals, array_filter($ref));
                    }
               }
          }
          return $enqId;
     }
     
     function getTicket($id) {
          return $this->db->get_where($this->tbl_event_enquires_lucky_draw, array('eeld_id' => $id))->row_array();
     }

     function getUserDetails($uId) {
          $uId = encrypt($uId, 'D');
          return $this->db->get_where($this->tbl_users, array('usr_id' => $uId))->row_array();
     }
}