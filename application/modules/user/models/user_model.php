<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class User_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'users';
       }
  } 