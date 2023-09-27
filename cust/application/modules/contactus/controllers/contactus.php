<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Contactus extends App_Controller {

       public $mailConfig = Array(
           'protocol' => 'smtp',
           'smtp_host' => SMTP_HOST,
           'smtp_port' => SMTP_PORT,
           'smtp_user' => SMTP_USER,
           'smtp_pass' => SMTP_PASS,
           'mailtype' => 'html',
           'charset' => 'utf-8'
       );

       public function __construct() {
            parent::__construct();
       }

       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }

       function captcha() {
            $code = rand(1000, 9999);
            $this->session->set_userdata('captcha', $code);
            $im = imagecreatetruecolor(50, 24);
            $bg = imagecolorallocate($im, 3, 157, 226); //background color blue
            $fg = imagecolorallocate($im, 255, 255, 255); //text color white
            imagefill($im, 0, 0, $bg);
            imagestring($im, 5, 5, 5, $code, $fg);
            header("Cache-Control: no-cache, must-revalidate");
            header('Content-type: image/png');
            imagepng($im);
            imagedestroy($im);
       }

       function sendContact() {
            $data = $this->input->post();
            $sessionCaptcha = $this->session->userdata('captcha');
            $formCaptcha = $data['captcha'];

            if (!empty($data)) {
                 if ((!empty($sessionCaptcha) && !empty($formCaptcha)) &&
                         ($sessionCaptcha == $formCaptcha)) {
                      $message = "<table>"
                              . "<tr>"
                              . "<th colspan='3'>Contact</th>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>First name</td>"
                              . "<td>" . $data['fname'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Last name</td>"
                              . "<td>" . $data['lname'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Phone</td>"
                              . "<td>" . $data['mobile'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Email</td>"
                              . "<td>" . $data['email'] . "</td>"
                              . "</tr>"
                              . "<td>Message</td>"
                              . "<td>" . $data['message'] . "</td>"
                              . "</tr>"
                              . "</table>";
                      $this->load->library('email', $this->mailConfig);
                      $this->email->set_newline("\r\n");
                      $this->email->to(EMAIL_CONTACT);
                      $this->email->subject('Contact');
                      $this->email->message($message);
                      $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                      $this->email->from('admin@royaldrive.in', 'Contact mail');
                      if ($this->email->send()) {
                           echo json_encode(array('status' => 'success', 'msg' => '<p style="color:green;">Mail successfully sent!</p>'));
                      } else {
                           echo json_encode(array('status' => 'failed', 'msg' => '<p style="color:red;">Mail not successfully sent!</p>'));
                      }
                 } else {
                      echo json_encode(array('status' => 'failed', 'msg' => '<p style="color:red;">Captcha faild!</p>'));
                 }
            } else {
                 echo json_encode(array('status' => 'failed', 'msg' => '<p style="color:red;">Please fill form first!</p>'));
            }
       }

       function sendQuickContact() {
            $data = $this->input->post();

            if (!empty($data)) {

                 $message = "<table>"
                         . "<tr>"
                         . "<th colspan='3'>Contact</th>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Name</td>"
                         . "<td>" . $data['name'] . "</td>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Phone</td>"
                         . "<td>" . $data['mobile'] . "</td>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Email</td>"
                         . "<td>" . $data['email'] . "</td>"
                         . "</tr>"
                         . "<td>Message</td>"
                         . "<td>" . $data['message'] . "</td>"
                         . "</tr>"
                         . "</table>";
                 $this->load->library('email', $this->mailConfig);
                 $this->email->set_newline("\r\n");
                 $this->email->to(EMAIL_CONTACT);
                 $this->email->subject('Contact');
                 $this->email->message($message);
                 $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                 $this->email->from('admin@royaldrive.in', 'Contact mail');

                 if ($this->email->send()) {
                      echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
                 } else {
                      echo json_encode(array('status' => 'failed', 'msg' => 'Mail not successfully sent!'));
                 }
            } else {
                 echo json_encode(array('status' => 'failed', 'msg' => 'Please fill form!'));
            }
       }

  }
  