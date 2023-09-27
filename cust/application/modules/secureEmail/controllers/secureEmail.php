<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class secureEmail extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'FAQ |' . STATIC_TITLE;
       }

       function index() {
            redirect('https://sg2plcpnl0150.prod.sin2.secureserver.net:2096/cpsess6530533295/webmail/gl_paper_lantern/index.html?mailclient=roundcube');
       }
  } 