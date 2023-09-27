<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class settings_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'settings';
            $this->tbl_callcenterbridging = TABLE_PREFIX . 'callcenterbridging';
       }

       function newSettings($values) {
            if (!empty($values)) {
                 foreach ($values as $key => $value) {
                      $this->dropSettingsByKey($key);
                      $insert['set_key'] = trim($key);
                      $insert['set_value'] = trim($value);
                      $this->db->insert($this->table, $insert);
                 }
                 return true;
            } else {
                 return false;
            }
       }

       function getSettings($key = '') {

            $this->db->select('*')->from($this->table);
            if (!empty($key)) {
                 return $this->db->where('set_key', $key)->get()->row_array();
            } else {
                 return $this->db->get()->result_array();
            }
       }

       function dropSettingsByKey($key) {
            if (!empty($key)) {
                 $this->db->where('set_key', $key);
                 $this->db->delete($this->table);
                 return true;
            } else {
                 return false;
            }
       }

       function getCallList() {
            $return = $this->db->select("ccb_id, CONCAT('https://pbx.voxbaysolutions.com/callrecordings/', ccb_recording_URL) AS ccb_recording_URL", false)
                            ->order_by('ccb_id', 'DESC')->limit(100, 0)
                            ->get_where($this->tbl_callcenterbridging, array('ccb_callStatus_id' => 18, 'ccb_is_download_voice' => 0, 'ccb_is_downloaded' => 0))->result_array();

            $this->db->where('ccb_is_downloaded', 0)->update($this->tbl_callcenterbridging, array('ccb_is_downloaded' => 1));                
            return $return;
       }

       function getDownloadCallListPendning() {
            return $this->db->where(array('ccb_is_downloaded' => 0, 'ccb_callStatus_id' => 18))->count_all_results($this->tbl_callcenterbridging);
       }
  } 