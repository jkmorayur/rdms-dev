<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class User_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'users';
            $this->tbl_user_access= TABLE_PREFIX . 'cpnl_user_access';
       }
       function getUserPermission($id)
     {
          if (!empty($id)) {
               return $this->db->select('cua_access')->where('cua_user_id', $id)->get($this->tbl_user_access)->row_array();
          } else {
               return false;
          }
     }
  } 