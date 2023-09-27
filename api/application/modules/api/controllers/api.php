<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Api extends App_Controller {

       public $mailConfig = Array(
           'protocol' => 'smtp',
           'smtp_host' => SMTP_HOST,
           'smtp_port' => SMTP_PORT,
           'smtp_user' => SMTP_USER,
           'smtp_pass' => SMTP_PASS,
           'mailtype' => 'html',
           'charset' => 'utf-8'
       );

       public function __construct() {
            parent::__construct();
            $this->load->model('api_logic/basic');
            $this->load->model('sell_your_vehicle/sell_your_vehicle_model');
            $this->load->model('search/search_model');
            $this->load->model('user/user_model');
            $this->load->model('api_model', 'api');
       }

       function bmv() {
          echo json_encode($this->basic->getbmv($id));
       }

       function test() {
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Headers: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

            debug($_POST, 0);
            debug($_GET,0);
            debug($_SERVER);
       }

       function index() {
            echo "Not Authorizsed";
            exit;
       }

       function new_arrivals() {

            $data = $this->home_model->newArrivals();
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function vehicles_near_by() {
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $data = $this->home_model->vehiclesNearByYou();
            echo json_encode($data);
       }

       function search($keyword = '') {
         // debug($keyword);
         // exit;
            $_GET['keyword'] = $keyword;
            $data['brands'] = $this->home_model->getBrands();
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $data['searchResult'] = $this->search_model->search($_GET);
            $data['searchParams'] = $_GET;
            echo json_encode($data);
       }

       function getBrands($id = '') {
          //debug($id);
            $data['brands'] = $this->basic->getBrands($id);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getCars($id = '') {
            $data = $this->basic->getCars();
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function get_cars($id = '') {
          $limit = 18;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $data = $this->basic->getCarsWithPage($limit, $page);
          $all = $this->basic->getTotalcars();
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($all);
          echo json_encode($data);
     }
     function get_cars_new($id = '') {
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $limit = !isset($_GET['offset']) ? 0 : $_GET['offset'];
          $data = $this->basic->getCarsWithPageNew($limit, $page);
          //$all = $this->basic->getTotalcarsNew();
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($all);
          echo json_encode($data);
     }
     

       function getNew($id = '') {
            $data['cars'] = $this->basic->getNew();
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getHighprice($id = '') {
            $data['cars'] = $this->basic->getHighprice();
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getLowprice($id = '') {
            $data['cars'] = $this->basic->getLowprice();
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getCar($num) {
            $data = $this->basic->getCar($num);
            // echo serialize($data);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getCartmp($num) {
            $data = $this->basic->getCartmp($num);
            // echo serialize($data);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getFeatures($num) {
            $data = $this->basic->getFeatures($num);
            // echo serialize($data);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getAllfeature() {
            $data = $this->basic->getAllfeature();
            // echo serialize($data);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getModel() {
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $id = $_POST['id'];
            $vehicle = $this->sell_your_vehicle_model->getModelByBrand($id);
            echo json_encode($vehicle);
       }

       function getVariant() {
            header("Set-Cookie: ci_session= no session_commit()");
            header('Access-Control-Allow-Origin: *');
            $id = $_POST['id'];
            $vehicle = $this->sell_your_vehicle_model->getVariantByModel($id);
            echo json_encode($vehicle);
       }

       function login() {

            if ($this->user_model->checkLogin($_POST)) {
                 $this->user_model->newUserLog();
                 $data['logedUserDetails'] = $this->session->userdata('gtech_logged_user');
                 $data['logedUserName'] = isset($logedUserDetails['first_name']) ? $logedUserDetails['first_name'] : '';
            } else {
                 $data['message'] = "The email/password combination you entered is incorrect.!";
            }
            $referrer = $this->session->userdata('referrer');
            if (!empty($referrer)) {
                 redirect($referrer);
            }
            echo json_encode($data);
       }

       function getmodal($num) {
            //$data['model'] = $this->basic->getModel($num);
            $data = $this->basic->getModel($num);
            // echo serialize($data);
            // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
       }

       function getBanner($id = '') {
            $data['banner'] = $this->basic->getBanner();
            echo json_encode($data);
       }

       function getShowrooms($id = '') {
            $data['showroom'] = $this->basic->getShowrooms();
            echo json_encode($data);
       }

       function getQuestions($id = '') {
            $data['faq'] = $this->basic->getQuestions();
            echo json_encode($data);
       }

       function insertTest() {
            $f = array(
                "user_name" => "jk",
                "user_location" => "morayur",
                "user_image_url" => "",
                "user_contact" => "9745661946",
                "user_profession" => "web developer",
                "vehicle_hl" => "3 year",
                "vehicle_fresh" => "yes fresh",
                "vehicle_model" => "audi A4",
                "vehicle_order" => "2 nd owner",
                "vehicle_iv" => "1 year",
                "vehicle_color" => "white",
                "vehicle_psd" => "2019-04-30",
                "vehicle_reg" => "Kerala registration",
                "vehicle_invest" => 2000000,
                "vehicle_ip" => 20000,
                "vehicle_any_other" => 1,
                "vehicle_pay_mode" => "through bank",
                "vehicle_own" => "self",
                "family_members" => "two members",
                "family_profession" => "business",
                "family_interested" => "yes interested",
                "who_else_drive" => "all members",
                "buying_new_vehicle" => "may be",
                "vehicle_same_seg" => "benz",
                "vehicle_planning_to_buy" => "c class",
                "vehicle_selling_reason" => "nothing",
                "vehicle_expecting_price" => 200000,
                "reg_in_your_name" => "yes",
                "immediate_decision" => "nill",
                "vehicle_satisfied" => "yes",
                "why_not_satisfied" => "nill",
                "vehicle_claim" => "nill",
                "vehicle_repair_done" => "nill",
                "which_vehicle" => "nill",
                "vehicle_brand" => "nill",
                "veh_color" => "nill",
                "veh_product" => "nill",
                "maintaining_old_vehicle" => "nill",
                "payer" => "self",
                "lead_to_decision" => "nill",
                "vehicle_purchase_reason" => "nothing"
            );
            $this->api->roboEnq($f);
       }

       function enquiry() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            $input = json_decode(file_get_contents('php://input'));
            if (!empty($input)) {
                 generate_log(array(
                     'log_title' => 'check empty post',
                     'log_desc' => serialize($input),
                     'log_controller' => 'robo-new-enq-check-empty-post',
                     'log_action' => 'C',
                     'log_ref_id' => 0,
                     'log_added_by' => 1010101010
                 ));
            } else {
                 generate_log(array(
                     'log_title' => 'post is empty',
                     'log_desc' => 'post is empty',
                     'log_controller' => 'robo-new-enq-check-empty-post',
                     'log_action' => 'C',
                     'log_ref_id' => 0,
                     'log_added_by' => 1010101010
                 ));
            }
            if (encryptor($input->access_token, 'D') == '1010101010') {
                 unset($input->access_token);
                 $this->api->roboEnq($input);

                 echo json_encode(array(
                     'status' => 'success',
                     'msg' => 'Row successfully inserted'
                 ));
            } else {
                 echo json_encode(array(
                     'status' => 'fail',
                     'msg' => 'Access token mismatch'
                 ));
            }
       }

       function readEnquiry($id = 0) {
            $values = $this->api->readRoboEnq($id);
            echo json_encode(array(
                'status' => 'success',
                'data' => $values
            ));
       }

       function loginwithphone() {
            generate_log(array(
                'log_title' => 'check empty post',
                'log_desc' => serialize($_GET),
                'log_controller' => 'loginwithphone',
                'log_action' => 'C',
                'log_ref_id' => 0,
                'log_added_by' => 1010101010
            ));
            if (isset($_GET['p_number']) && !empty($_GET['p_number'])) {
                 $user = $this->api->loginWithPhone($_GET['p_number']);
                 echo json_encode(array(
                     'status' => 'success',
                     'msg' => 'Please verify your mobile number',
                     'data' => $user
                 ));
            } else {
                 echo json_encode(array(
                     'status' => 'fail',
                     'msg' => 'Please enter phone number'
                 ));
            }
       }

       function verifyPhoneNumber() {
            if ((isset($_GET['uid']) && !empty($_GET['uid'])) && (isset($_GET['otp']) && !empty($_GET['otp']))) {
                 $user = $this->api->verifyPhoneNumber($_GET['uid'], $_GET['otp']);
                 echo json_encode(array(
                     'status' => 'success',
                     'msg' => 'Your mobile number verified',
                     'data' => $user
                 ));
            } else {
                 echo json_encode(array(
                     'status' => 'fail',
                     'msg' => 'OTP or user id is empty'
                 ));
            }
       }

       function resendLoginOTP() {
            if (isset($_GET['uid']) && !empty($_GET['uid'])) {

                 $user = $this->api->resendLoginOTP($_GET['uid']);
                 echo json_encode(array(
                     'status' => 'success',
                     'msg' => 'Resend OTP to your mobile number',
                     'data' => $user
                 ));
            } else {
                 echo json_encode(array(
                     'status' => 'fail',
                     'msg' => 'otp empty'
                 ));
            }
       }
       function testApi($id = 0) {
          echo TRUE;
          exit;
          // echo json_encode(array(
          //     'status' => 'success',
          //     'data' => true
          // ));
     }

  }
  