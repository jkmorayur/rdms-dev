<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class smtp_test extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'Test SMTP';
       }

       function index() {


            $this->load->library('email');
            $config['protocol'] = "smtp";
            $config['smtp_host'] = get_settings_by_key('smtp_host');
            $config['smtp_port'] = get_settings_by_key('smtp_post');
            $config['smtp_user'] = get_settings_by_key('smtp_user');
            $config['smtp_pass'] = get_settings_by_key('smtp_pass');
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";

            $this->email->initialize($config);

            $this->email->from('blablabla@gmail.com', 'Blabla');
            $list = array('jayakrishnan@webcompanyindia.com');
            $this->email->to($list);
            $this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
            $this->email->subject('This is an email test');
            $this->email->message('It is working. Great!');
            $this->email->send();
            
            $this->render_page(__CLASS__ . '/index');
       }

  }
  