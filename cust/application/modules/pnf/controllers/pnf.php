<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class pnf extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'Royal Drive | 404!';
       }
       
       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }
  } 