<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Common_model extends CI_Model {

       public function __construct() {
            $this->load->database();
            parent::__construct();

            $this->tbl_users = TABLE_PREFIX_PORTAL . 'users';
            $this->tbl_seo_cms = TABLE_PREFIX_PORTAL . 'seo_cms';
            $this->tbl_user_access = TABLE_PREFIX_PORTAL . 'user_access';
            $this->tbl_users_groups = TABLE_PREFIX_PORTAL . 'users_groups';
            $this->tbl_products = TABLE_PREFIX . 'products';
            $this->tbl_model = TABLE_PREFIX . 'model';
            $this->tbl_brand = TABLE_PREFIX . 'brand';
            $this->tbl_variant = TABLE_PREFIX . 'variant';
       }

       function VehiclesSiteMap() {
            $this->db->select($this->tbl_products . '.prd_id, ' . $this->tbl_brand . '.brd_title,' . $this->tbl_brand . '.brd_slug,' . $this->tbl_model . '.mod_title,' . $this->tbl_variant . '.var_variant_name')->from($this->tbl_products);
            $this->db->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_products . '.prd_brand', 'left');
            $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_products . '.prd_model', 'left');
            $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_products . '.prd_variant', 'left');
            $this->db->order_by($this->tbl_products . '.prd_booking_status ', 'asc');
            $this->db->order_by($this->tbl_products . '.prd_price  ', 'desc');
            $this->db->where($this->tbl_products . '.prd_status', 1);
            $this->db->where($this->tbl_products . '.prd_rd_mini', 0);
            $res = $this->db->get()->result_array();
            return $res;
       }

       function getSettings($key = '') {

            $this->db->select('*')->from(TABLE_PREFIX_PORTAL . 'settings');
            if (!empty($key)) {
                 return $this->db->where('set_key', $key)->get()->row_array();
            } else {
                 return $this->db->get()->result_array();
            }
       }
       
       public function generateLog($data, $table) {
            $this->load->library('user_agent');
            if (!empty($data)) {
                 $data['log_user_agent'] = $this->agent->agent;
                 $data['log_added_on_in'] = date('Y-m-d H:i:s');
                 $this->db->insert(TABLE_PREFIX_PORTAL . $table, $data);
                 return true;
            } else {
                 return false;
            }
       }

       public function downloadapp($id) {
            
            $ip = $this->input->ip_address();
            $user = $this->db->like('usr_dwn_code', $id, 'both')->get('cpnl_users')->row();
            
            if(empty($user)) {
                 return false;
            }
            $userId = $user->usr_id;
            
            $alreadyDownload = $this->db->get_where('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip))->row_array();
            
            if (empty($alreadyDownload)) {
                 $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s')));
            }
            
            $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
            $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
            
            if ($iPod || $iPhone) {
                 //echo 'iphone';exit;
                 header("Location: https://apps.apple.com/in/app/royal-drive/id1223421080");
            } else if ($iPad) {
                 //echo 'ipad';exit;
                 header("Location: https://apps.apple.com/in/app/royal-drive/id1223421080");
            } else if ($Android) {
                 //echo 'andriod';exit;
                 header("Location: https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code");
            } else if ($webOS) {
                 //echo 'web';exit;
                 header("Location: https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code");
            } else {
                 if($user->usr_showroom == 1) {
                      //echo 'sm';exit;
                      header("Location: https://www.rdsmart.in");
                 } else {
                      //echo 'lx';exit;
                      header("Location: https://www.royaldrive.in");
                 }
            }
       }

     public function getUser($id = null, $excludeAdminUser = false) {

          $this->db->select($this->tbl_users . '.*');
          if ($excludeAdminUser) {
               $this->db->where("usr_id !=", 1);
          }

          if ($id) {
               $this->db->where('usr_id', $id);
               $user = $this->db->get($this->tbl_users)->row_array();
          } else {
               $user = $this->db->get($this->tbl_users)->result_array();
          }
          $permission = $this->db->select(array($this->tbl_users_groups . '.*', $this->tbl_user_access . '.*'))
                          ->join($this->tbl_user_access, $this->tbl_user_access . '.cua_user_id = ' . $this->tbl_users_groups . '.user_id', 'left')
                          ->where($this->tbl_users_groups . '.user_id', $id)->get($this->tbl_users_groups)->row_array();
          return array_merge($user, $permission);
     }

     function getContent($secSlug) {
          $seo = $this->db->get_where($this->tbl_seo_cms, array('seocms_section_slug' => $secSlug, 'seocms_status' => 1))->row_array();
          $return['cnt'] = isset($seo['seocms_content']) ? $seo['seocms_content'] : '';
          $return['id'] = isset($seo['seocms_id']) ? $seo['seocms_id'] : '';
          return $return;
     }
}