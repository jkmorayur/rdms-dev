<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class terms extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre – owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes – Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
       }

       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }
  } 