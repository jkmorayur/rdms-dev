<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class trash_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
       }
       
       function getCallList() {
            $return = $this->db->select("ccb_id, CONCAT('https://pbx.voxbaysolutions.com/callrecordings/', ccb_recording_URL) AS ccb_recording_URL", false)
                            ->order_by('ccb_id', 'DESC')->limit(100, 0)
                            ->get_where('cpnl_callcenterbridging', array('ccb_callStatus_id' => 18, 'ccb_is_download_voice' => 0, 'ccb_is_downloaded' => 0))->result_array();

            $this->db->where('ccb_is_downloaded', 0)->update('cpnl_callcenterbridging', array('ccb_is_downloaded' => 1));                
            return $return;
       }

       function updateCallList($ccb_id) {
            $this->db->where('ccb_id', $ccb_id)->update('cpnl_callcenterbridging', array('ccb_is_download_voice' => 1));
       }
  }