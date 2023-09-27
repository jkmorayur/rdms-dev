<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class api_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            define('rana_users', 'rana_users');
            define('app_roya_enquiry', 'app_roya_enquiry');
       }

       function roboEnq($datas) {
            if (!empty($datas)) {
                 $this->db->insert(app_roya_enquiry, $datas);
                 $insId = $this->db->insert_id();
                 generate_log(array(
                     'log_title' => 'Add a records',
                     'log_desc' => 'New enquiry added by robot',
                     'log_controller' => 'robo-new-enq',
                     'log_action' => 'C',
                     'log_ref_id' => $insId,
                     'log_added_by' => 1010101010
                 ));
            }
            return false;
       }

       function insert($datas) {
            if (!empty($datas)) {
                 $this->db->insert(app_roya_enquiry, $datas);
            }
       }

       function readRoboEnq($id) {
            if($id) {
                 return $this->db->get_where(app_roya_enquiry, array('user_id' => $id))->row_array();
            } 
            return $this->db->get(app_roya_enquiry)->result_array();
       }
       
       function loginWithPhone($number) {
            $number = substr($number, -10);
            $exists = $this->db->select(array(
                        'id', 'username', 'email', 'first_name', 'last_name', 'phone'
                    ))->like('phone', $number, 'left')->get(rana_users)->row_array();
            if (!empty($exists)) {
                 return $exists;
            } else {
                 $otp = generate_otp();

                 $this->db->insert(rana_users, array('phone' => $number, 'rusr_otp' => $otp, 'active' => 0));
                 $userId = $this->db->insert_id();

                 $msg = "<#> " . $otp . " , is your OTP to access www.royaldrive.in - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
                 send_otp_sms($msg, $number, 4, 1607100000000043076);
                 return array('uid' => $userId, 'otp' => $otp);
            }
       }

       function verifyPhoneNumber($uid, $otp) {

            $userDetails = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone'))
                            ->where(array('id' => $uid, 'rusr_otp' => $otp))->get(rana_users)->row_array();
            if (!empty($userDetails)) {
                 $this->db->where('id', $uid)->update(rana_users, array('rusr_otp' => null, 'rusr_phone_verified' => 1, 'active' => 1));
                 return $userDetails;
            }
       }

       function resendLoginOTP($uid) {

            $otp = generate_otp();

            $userDetails = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone'))
                            ->where(array('id' => $uid))->get(rana_users)->row_array();

            if (!empty($userDetails)) {
                 $this->db->where('id', $uid)->update(rana_users, array('rusr_otp' => $otp, 'rusr_phone_verified' => 0, 'active' => 0));
                 $msg = "<#> " . $otp . " , is your OTP to access www.royaldrive.in - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
                 send_otp_sms($msg, $userDetails['phone'], 4, 1607100000000043076);
                 return array('uid' => $uid, 'otp' => $otp);
            }
       }
  }
  