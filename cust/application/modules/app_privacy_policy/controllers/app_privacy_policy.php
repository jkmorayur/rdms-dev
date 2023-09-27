<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class app_privacy_policy extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'App Privacy policy |' . STATIC_TITLE;
            $this->template->set_layout('privacy');
       }

       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }
  } 