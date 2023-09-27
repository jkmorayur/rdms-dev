<?php

use function Psy\debug;

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
require './vendor/autoload.php';
class Career extends App_Controller
{

     public $mailConfig = array(
          'protocol' => 'smtp',
          'smtp_host' => SMTP_HOST,
          'smtp_port' => SMTP_PORT,
          'smtp_user' => SMTP_USER,
          'smtp_pass' => SMTP_PASS,
          'mailtype' => 'html',
          'charset' => 'utf-8'
     );

     public function __construct()
     {

          parent::__construct();
          $this->load->model('career_model', 'career');
     }

     function index()
     {
          $data['careers'] = $this->career->getCareerPosts();
          $data['districts'] = $this->career->getDistricts();
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }

     function sendmail()
     {
          $this->mail = new PHPMailer;
          //            $this->mail->isSMTP();
          $this->mail->Host = 'mail.royaldrive.in';
          $this->mail->SMTPAuth = false;
          $this->mail->Username = 'info@royaldrive.in';
          $this->mail->Password = 'IdvswFYzqNyC';
          $this->mail->SMTPSecure = 'SSL';
          $this->mail->Port = 465;
          $this->mail->setFrom('info@royaldrive.in', 'Info');
          $this->mail->addReplyTo('info@royaldrive.in', 'Info');
          $this->mail->addAddress('jkmorayur@gmail.com');
          //remove this from server
          //            $this->mail->SMTPOptions = array(
          //                'ssl' => array(
          //                    'verify_peer' => false,
          //                    'verify_peer_name' => false,
          //                    'allow_self_signed' => true,
          //                ),
          //            );
          $this->mail->isHTML(true);
          $this->mail->Body = 'Hi';
          $this->mail->send();
          echo $this->mail->print_debugger();
     }

     function sendCareer()
     {

          $data = $this->input->post();
          if (!empty($data)) {
               $appliedFor = isset($data['cap_post']) ? $data['cap_post'] : '';
               $postDetails = $this->career->getCareerPosts($appliedFor);
               $carTitle = isset($postDetails['car_title']) ? $postDetails['car_title'] : '';

               $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));
               $newFileName = rand(9999999, 0) . $_FILES['attachment']['name'];
               $config['upload_path'] = './rdportal/assets/uploads/cv/';
               $config['allowed_types'] = 'pdf|doc|docx';
               $config['file_name'] = $newFileName;
               $this->load->library('upload', $config);

               if (!$this->upload->do_upload('attachment')) {
                    $error = $this->upload->display_errors();
               } else {
                    $resUpload = $this->upload->data();
               }
               $data['cap_resume'] = isset($resUpload['file_name']) ? $resUpload['file_name'] : '';
               $this->career->newCareer($data);

               if (isset($resUpload['full_path'])) {
                    $this->email->attach($resUpload['full_path']);
               }

               $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>CV</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Post applied for</td>"
                    . "<td>" . $carTitle . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>First name</td>"
                    . "<td>" . $data['cap_fname'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Last name</td>"
                    . "<td>" . $data['cap_lname'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Phone</td>"
                    . "<td>" . $data['cap_mobile'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Email</td>"
                    . "<td>" . $data['cap_email'] . "</td>"
                    . "</tr>"
                    . "<td>Experience</td>"
                    . "<td>" . $data['cap_experience'] . "</td>"
                    . "</tr>"
                    . "</table>";

               $this->email->set_newline("\r\n");
               $this->email->to(EMAIL_CAREER);
               $this->email->subject('Career');
               $this->email->message($message);
               $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
               $this->email->from('admin@royaldrive.in', 'Career mail');
               if ($this->email->send()) {
                    echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
               } else {
                    echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
               }

               //Ack
               $this->email->clear(true);
               $candidateMail = isset($data['cap_email']) ? $data['cap_email'] : '';
               $fName = isset($data['cap_fname']) ? $data['cap_fname'] : '';
               $lName = isset($data['cap_lname']) ? $data['cap_lname'] : '';
               $fullName = $fName . ' ' . $lName;


               if (!empty($appliedFor) && !empty($candidateMail) && !empty($postDetails)) {

                    $carLocation = isset($postDetails['car_location']) ? str_replace('&', ' or ', $postDetails['car_location']) : '';
                    $message = "Dear $fullName, <br>Thank you for applying for the position of - $carTitle, location $carLocation  Royal Drive Pre Owned Cars LLP  with  Royal Drive group of companies
                         We confirm that we have received your application and have forwarded it for review against the requirements for the role in which you have expressed interest.
                         Thank you for your interest in working with us. <br>
                         In case of any query, feel free to us at 91 81299 09090
                         <br><br><br><br><br><br><br><br><br><br><br>
                         Best Regards,<br>Royal Drive Recruitment Team";

                    $this->email->set_newline("\r\n");
                    $this->email->to($candidateMail);
                    $this->email->subject('Royal Drive - Your applied for the post of ' . $carTitle);
                    $this->email->message($message);
                    $this->email->reply_to('noreply@royaldrive.in', 'Royal Drive');
                    $this->email->from('hr@royaldrive.in', 'Contact mail');
                    $this->email->send();
               }
               //Ack

          } else {
               echo json_encode(array('status' => 'failed', 'msg' => 'Please fill form first!'));
          }
     }
}
