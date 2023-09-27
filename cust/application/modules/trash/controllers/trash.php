<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
 
  class trash extends App_Controller {

       public function __construct() {
            parent::__construct();
       }

       function smstestr() {
            if(!empty($_POST)) {
               $route = 2;
               $msg = $_POST['msg'];
               $mob = $_POST['mob'];
               $tmpId = $_POST['tmpId'];
               $senderid = get_settings_by_key('sms_sender_id');
               $username = get_settings_by_key('sms_username');
               $password = get_settings_by_key('sms_password');
               
               $msg = urlencode($msg);
               $ch = curl_init();
               
               curl_setopt($ch, CURLOPT_URL, "https://sms.xpresssms.in/api/api.php?");
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, "ver=1&mode=1&action=push_sms&type=1&route=" . $route . "&login_name=" . $username . "&api_password=" . $password . "&message=" . 
                         $msg . "&number=" . $mob . "&sender=" . $senderid . "&template_id=" . $tmpId);
               $buffer = curl_exec($ch);

               $output['resp'] = $buffer;
               $output['msg'] = $msg;
               $output['tmpId'] = $tmpId;
               curl_close($ch);
            }
            $this->render_page(strtolower(__CLASS__) . '/smstestr');
       }

       function index() {
            $this->load->model('trash_model');
            $recordsList = $this->trash_model->getCallList();
            $records = implode(array_column($recordsList, 'ccb_recording_URL'), "\n");

            $file = "./assets/records.txt";
            $txt = fopen($file, "w") or die("Unable to open file!");
            fwrite($txt, $records);
            fclose($txt);

            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            header("Content-Type: text/plain");
            readfile($file);
       }
  }