<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class appdownload extends CI_Controller {

       public function __construct() {
            parent::__construct();
            
       }
       public function down() {
            echo 'He';exit;
       }
       function index($id) {
            
            $id = encryptor($id);
            $ip = $this->input->ip_address();
            $user = $this->db->select('usr_id, usr_showroom')->like('usr_dwn_code', $id, 'both')->get('cpnl_users')->row();
            
            if(empty($user)) {
                 return false;
            }
            $userId = $user->usr_id;

            $alreadyDownload = array();//$this->db->get_where('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip))->row_array();

            $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
            $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

            if ($iPod || $iPhone) {
                 //echo 'iphone'; 
                 if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
                 }
                 header("Location: " . get_settings_by_key('app_ios_link_app_store'));
            } else if ($iPad) {
                 //echo 'ipad';
                 if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
                 }
                 header("Location: " . get_settings_by_key('app_ios_link_app_store'));
            } else if ($Android) {
                 
                 if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 2));
                 }
                 header("Location: " . get_settings_by_key('app_android_link'));
            } else if ($webOS) {
                 //echo 'web';
                 if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                 }
                 header("Location: " . get_settings_by_key('app_android_link'));
            } else {
                 if($user->usr_showroom == 1) {
                      if (empty($alreadyDownload)) {
                         $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                      }
                      header("Location: https://www.rdsmart.in");
                 } else {
                      if (empty($alreadyDownload)) {
                         $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                      }
                      header("Location: https://www.royaldrive.in");
                 }
            }
       }
       function qr() {
          $ip = $this->input->ip_address();

          $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
          $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
          $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
          $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
          $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

          if ($iPod || $iPhone) {
               $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => 0, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
               header("Location: " . get_settings_by_key('app_ios_link_app_store'));
          } else if ($iPad) {
               $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => 0, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
               header("Location: " . get_settings_by_key('app_ios_link_app_store'));
          } else if ($Android) {
               $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => 0, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 2));
               header("Location: " . get_settings_by_key('app_android_link'));
          } else {
               $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => 0, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
               header("Location: https://www.royaldrive.in");
          }
       }

       function duid($id) {
          //SELECT * FROM `cpnl_users` WHERE `usr_username` != '' AND `usr_active` = 1 AND `usr_appdownloadlink` IS NULL
          echo 'https://royaldrive.in/appdownload/index/' . encryptor($id) . '<br>';
          echo encryptor(encryptor($id), 'D');
     }

     function driveinto() {
          $this->load->view('home/driveinto');
     }
  } 