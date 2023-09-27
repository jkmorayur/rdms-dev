<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class appdwn extends App_Controller {

       public function __construct() {

            parent::__construct();
       }
       
       function dwn($id = 0) {
            
            $id = encryptor($id);
            $ip = $this->input->ip_address();
            $user = $this->db->select('usr_id, usr_showroom')->where('usr_id', $id, 'both')->get('cpnl_users')->row();
            if(empty($user)) {
                 //return false;
            }
            $userId = $user->usr_id;

            //$alreadyDownload = $this->db->get_where('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip))->row_array();

            $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
            $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

            if ($iPod || $iPhone) {
                 //if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
                 //}
                 header("Location: " . get_settings_by_key('app_ios_link_app_store'));
            } else if ($iPad) {
                 //if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 1));
                 //}
                 header("Location: " . get_settings_by_key('app_ios_link_app_store'));
            } else if ($Android) {
                 //if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 2));
                 //}
                 header("Location: " . get_settings_by_key('app_android_link'));
            } else if ($webOS) {
                 //if (empty($alreadyDownload)) {
                    $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                 //}
                 header("Location: " . get_settings_by_key('app_android_link'));
            } else {
                 if($user->usr_showroom == 1) {
                      //if (empty($alreadyDownload)) {
                         $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                      //}
                      header("Location: https://www.rdsmart.in");
                 } else {
                      //if (empty($alreadyDownload)) {
                         $this->db->insert('cpnl_app_download_ref', array('adr_user_id' => $userId, 'adr_agent_ip' => $ip, 'adr_date' => date('Y-m-d H:i:s'), 'adr_agent' => 3));
                      //}
                      header("Location: https://www.royaldrive.in");
                 }
            }
       }
  } 