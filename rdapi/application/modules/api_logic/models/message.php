<?php
  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class message extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_brands = TABLE_PREFIX . "brand";
            $this->tbl_products = TABLE_PREFIX . "products";
            $this->tbl_products_image = TABLE_PREFIX . "prod_images";
            $this->tbl_products_specification = TABLE_PREFIX . "prod_specifications";
            $this->tbl_model = TABLE_PREFIX . "model";
            $this->tbl_variant = TABLE_PREFIX . "variant";
            $this->tbl_prod_features = TABLE_PREFIX . "prod_features";
            $this->tbl_features = TABLE_PREFIX . "features";
            $this->tbl_users = TABLE_PREFIX . "users";
            $this->tbl_messages = TABLE_PREFIX . "messages";
       }

       function updatetoken($userid, $fcmtoken) {
            if ($userid != null && $fcmtoken != null) {

                 $array = array('id' => $userid);

                 $this->db->where($array);
                 //$this->db->where('id', $userid);


                 $result = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
                 if (!empty($result)) {
                      $result = array('fcm_id' => $fcmtoken);
                      $this->db->where($array);
                      $status = $this->db->update($this->tbl_users, $result);
                      return true;
                 }
                 return false;
            } else {
                 return false;
            }
       }

       function deletetoken($userid) {
            if ($userid != null) {

                 $array = array('id' => $userid);

                 $this->db->where($array);
                 //$this->db->where('id', $userid);


                 $result = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
                 if (!empty($result)) {
                      $result = array('fcm_id' => "00");
                      $this->db->where($array);
                      $status = $this->db->update($this->tbl_users, $result);
                      return true;
                 }
                 return false;
            } else {
                 return false;
            }
       }

       public function newmessage($userid, $message, $sender) {
            // unset($datas['persistent_remember_me']);
            // unset($datas['password_confirmation']);
//            $datas['username'] = $datas['first_name'];
            if ($userid != null && $message != null && $sender != null) {

                 $dataS = array(
                     'idi' => $userid,
                     'messages' => $message,
                     'sendby' => $sender
                 );

                 $this->db->set($dataS);

                 if ($this->db->insert($this->tbl_messages, $datas)) {
                 // $userId = $this->db->insert_id();
                      return true;
                 } else {
                      return FALSE;
                 }
            }


            return false;
       }

       function getchatrooms() {

            $this->db->select('id AS chatroom,email,phone,messages_id');
            $this->db->order_by("messages_id", "DESC");

            $this->db->from($this->tbl_users);
            $this->db->join($this->tbl_messages, 'idi = id', 'right');
            $this->db->group_by('idi');

            $vechicles = $this->db->get()->result_array();
            if (!empty($vechicles)) {
                 return $vechicles;
            } else {

                 return false;
            }
       }

       function chats($num) {
            $this->db->select('messages,sendby,messages_id');
            $this->db->order_by("messages_id", "asc");

            $this->db->from($this->tbl_messages);
            $this->db->where('idi', $num);
            $vechicles = $this->db->get()->result_array();
            if (!empty($vechicles)) {
                 return $vechicles;
            } else {

                 return $num;
            }
       }

       function tokensearch($userid) {

            if ($userid != null) {

                 $array = array('id' => $userid);

                 $this->db->where($array);
                 //$this->db->where('id', $userid);


                 $result = $this->db->select('fcm_id')->from($this->tbl_users)->get()->row()->fcm_id;
                 if (!empty($result)) {

                      return $result;
                 }
                 return "no";
            } else {
                 return "no";
            }
       }

       function emailsearch($userid) {

            if ($userid != null) {

                 $array = array('id' => $userid);

                 $this->db->where($array);
                 //$this->db->where('id', $userid);


                 $result = $this->db->select('email')->from($this->tbl_users)->get()->row()->email;
                 if (!empty($result)) {

                      return $result;
                 }
                 return "no";
            } else {
                 return "no";
            }
       }

       function deleteroom($chatroom_id) {

            $sql = "DELETE FROM rana_messages WHERE idi=$chatroom_id";
            $outp = $this->db->query($sql);
            if ($outp)
                 return $outp;
       }

  }
  