<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class mailtester extends CI_Controller {

       public $mailConfig = Array(
           'protocol' => 'smtp',
           'smtp_host' => SMTP_HOST,
           'smtp_port' => SMTP_PORT, 
           'smtp_user' => SMTP_USER,
           'smtp_pass' => SMTP_PASS,
           'mailtype' => 'html',
           'charset' => 'utf-8'
       );

       public function index() {

            $this->load->library('email', $this->mailConfig);

            $message = "<strong>Test mail</strong>";
            $this->email->set_newline("\r\n");
            $this->email->to('cltadmin@royaldrive.in');
            $this->email->subject('Career');
            $this->email->message($message);
            $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
            $this->email->from('hr@royaldrive.in', 'Contact mail');
            if ($this->email->send()) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
            } else {
                 echo json_encode(array('status' => 'failed', 'msg' => 'Mail not successfully sent!'));
            }
            exit;
       }
  }