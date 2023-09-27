<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class email extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'FAQ |' . STATIC_TITLE;
       }

     //   function index() {
     //        redirect('https://sg2plcpnl0150.prod.sin2.secureserver.net:2096/cpsess6530533295/webmail/gl_paper_lantern/index.html?mailclient=roundcube');
     //   }

       function send() {
          error_reporting(E_ALL);
          error_reporting(1);
          $this->load->library('email');
          $this->email->from('info@royaldrive.in', 'Your Name');
          //$this->email->to('it@royaldrive.in');
          $this->email->to('jkmorayur@gmail.com');
          $this->email->subject('Email Test');
          $this->email->message('Testing the email class.');
          $this->email->send();
       }
  } 