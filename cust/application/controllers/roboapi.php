<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class roboapi extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->load->model('home/home_model', 'home');
            $this->load->model('api_logic/basic', 'basic');
       }
       
       function get_banners() {
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $f = $this->basic->getBanner_1();
            debug($f);
       }


       public function get_brands() {
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $data = $this->home->getBrands();

            if (!empty($data)) {
                 foreach ($data as $key => $value) {
                      $data[$key]['brd_logo'] = 'http://royaldrive.in/assets/uploads/brand/' . $value['brd_logo'];
                 }
            }

            echo json_encode($data);
       }

       public function get_vehicles() {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $data = $this->home->getAllVehicle();
            echo json_encode($data);
       }

  }
  