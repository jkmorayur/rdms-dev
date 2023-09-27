<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class testimonials extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            //$this->page_title = 'Top Pre owned car Dealers in kerala | Largest Pre owned Car Showroom in South india';
            //$this->page_meta_description = 'Buying a great car is the best dream ever and thankfully, you can now buy that fancy car without any hesitation. Royal Drive is among the Top Pre owned car dealers in Kerala and we bring you a host of top grade options in automotive.Looking for best second hand premium cars in South India? Your search is over. We, Royal Drive, the lagest pre owned car showroom in South India provide the same, all under one roof.';
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre – owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes – Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
       }

       function index() {
            $this->render_page(strtolower(__CLASS__) . '/index');
       }

  }
  