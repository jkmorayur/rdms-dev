<?php

defined('BASEPATH') or exit('No direct script access allowed');

class webvw extends App_Controller {

     public $mailConfig = array(
          'protocol' => 'smtp',
          'smtp_host' => SMTP_HOST,
          'smtp_port' => SMTP_PORT,
          'smtp_user' => SMTP_USER,
          'smtp_pass' => SMTP_PASS,
          'mailtype' => 'html',
          'charset' => 'utf-8'
     );

     public function __construct() {
//           $comment    =    'Note: We convert a string into an array with explode function. I do not use explode function then the output will be a string as shown in below example.';
// $comment = (strlen($comment) > 50)?substr($comment,0,25).'... <a href="https://www.pakainfo.com/php-laravel-limit-string-length/">Read More</a>' : $comment;
// echo $comment;
// exit;
         parent::__construct();
         $this->load->model('webvw_model', 'home_model');
     }

     function index() {
        
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }
     function print_track_card() {//enquiry/printTrackCard/47190
        //https://royaldrive.in/webvw/print_track_card
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }
     
     function val_report() {///printevaluation//evl report tab
         $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }

     

}
