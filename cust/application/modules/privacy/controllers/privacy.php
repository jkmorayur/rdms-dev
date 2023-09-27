<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class privacy extends App_Controller {

       public function __construct() {

            parent::__construct();
       }

       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }
  } 