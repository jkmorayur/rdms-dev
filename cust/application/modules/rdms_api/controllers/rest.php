<?php

use function Psy\debug;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class rest extends REST_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->model('rest_model');
          //$this->load->helper('common_helper');//helpers


          //$this->load->model('enquiry_model', 'enquiry');
     }

     public function divisions_get()
     {
          $data['division'] = $this->rest_model->getActiveData();
          echo json_encode($data['division']);
          //  debug($data['division']);
     }

     function bindShowroomByDivision_post()
     {
          if (isset($_POST['id']) && !empty($_POST['id'])) {
               $showroom = $this->rest_model->bindShowroomByDivision($_POST['id']);
               echo json_encode($showroom);
          }
     }

     function getStaffsByShowroom_post($id = 0, $user_id = 0, $json = true)
     {
          $_POST['id'] = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : $id;
          // fetch staffs by showroom
          if (isset($_POST['id']) && !empty($_POST['id'])) {
               $staffs = $this->rest_model->bindStaffsByShowroom($_POST['id'], $_POST['user_id']);
               if ($json) {
                    echo json_encode($staffs);
               } else {
                    return $staffs;
               }
          }
     }

     function BKregList_get()
     {
          $this->uid = $_GET['user_id'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['datas'] = $this->rest_model->readVehicleReg('', $_GET);
          debug($data['datas']);
     }

     function regList_get()
     {
          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          $config = getPaginationDesign();
          $data = $_GET;
          //@pagination//
          $data['enq_date_from'] = $this->input->get('enq_date_from');
          $data['enq_date_to'] = $this->input->get('enq_date_to');
          $data['mode'] = $this->input->get('mode');
          $data['showroom'] = $this->input->get('showroom');
          $data['executive'] = $this->input->get('executive');
          //   $data['allShowrooms'] = $this->showroom->get();
          // $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $this->page_title = 'List vehicle registration';
          $reg_data = $this->rest_model->readVehicleReg('', $limit, $page, $_GET); //reg mdl
          $data['data'] = $reg_data['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $reg_data['data'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;
          /* Table info */
          /*  $data['pageIndex'] = $page + 1;// Showing 4
              $data['limit'] = $page + $limit; //to 6 of */
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($reg_data['count']); //14 entries
          /* Table info */
          //create pagination //
          /* $this->pagination->initialize($config);
              $data["links"] = $this->pagination->create_links(); */
          //@ create pagination //
          $data['user_access'] = $reg_data['user_access'];

          echo json_encode($data);
          /* $data['analysis'] = $this->registration->todayAnalysis();
              //  $data['departments'] = $this->departments->getData();
              //$this->render_page(strtolower(__CLASS__) . '/reg_vehicle_list', $data); */
     }
     function regList_post()
     {
          // $jsonArray = json_decode(file_get_contents('php://input'),true); 
          //debug($jsonArray);
          // debug($_GET);
          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          $config = getPaginationDesign();
          $data = $_GET;
          //@pagination//
          $data['enq_date_from'] = $this->input->post('enq_date_from');
          $data['enq_date_to'] = $this->input->post('enq_date_to');
          $data['mode'] = $this->input->post('mode');
          $data['showroom'] = $this->input->post('showroom');
          $data['executive'] = $this->input->post('executive');
          //   $data['allShowrooms'] = $this->showroom->get();
          // $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $this->page_title = 'List vehicle registration';
          $reg_data = $this->rest_model->readVehicleReg('', $limit, $page, $_POST); //reg mdl
          $data['data'] = $reg_data['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $reg_data['data'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;
          /* Table info */
          /*  $data['pageIndex'] = $page + 1;// Showing 4
              $data['limit'] = $page + $limit; //to 6 of */
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($reg_data['count']); //14 entries
          /* Table info */
          //create pagination //
          /* $this->pagination->initialize($config);
              $data["links"] = $this->pagination->create_links(); */
          //@ create pagination //
          $data['user_access'] = $reg_data['user_access'];

          echo json_encode($data);
          /* $data['analysis'] = $this->registration->todayAnalysis();
              //  $data['departments'] = $this->departments->getData();
              //$this->render_page(strtolower(__CLASS__) . '/reg_vehicle_list', $data); */
     }

     public function brands_get()
     {
          $brands = $this->rest_model->getBrands();
          echo json_encode($brands);
     }

     public function bindModel_get($brdId = '', $dataType = 'json')
     {

          $id = isset($_GET['id']) ? $_GET['id'] : $brdId;
          $vehicle = $this->rest_model->getModelByBrand($id);
          if ($dataType == 'json') {
               echo json_encode($vehicle);
          } else {
               return $vehicle;
          }
     }

     function bindVarient_get($modelId = '', $dataType = 'json')
     {
          $id = isset($_GET['id']) ? $_GET['id'] : $modelId;
          $vehicle = $this->rest_model->getVariantByModel($id);
          if ($dataType == 'json') {
               echo json_encode($vehicle);
          } else {
               return $vehicle;
          }
     }

     function matchingInquiry_get()
     {
          // Check if dropped
          //TODO: will delete in future
          $this->usr_grp = $this->input->get('grp_slug');
          //  debug($this->usr_grp);
          $isDroppedCase = $this->rest_model->getEnquiryByMobile($this->input->get('phoneNo'));
          //debug( $isDroppedCase['enq_id']);
          //$matchingRegister['reghistory'] = $this->registration->matchingRegister($this->input->post('phoneNo'));
          // $reghistory = $this->load->view(strtolower(__CLASS__) . '/view_register_history', $matchingRegister, true);
          $reghistory['history'] = $this->rest_model->matchingRegister($this->input->get('phoneNo'));
          //  debug($reghistory['history']);check history
          if (empty($isDroppedCase)) {
               die(json_encode(array('status' => false, 'msg' => 'Enquiry not found', 'usr_id' => '', 'se' => '', 'isdrop' => 0, 'regHistory' => $reghistory)));
          } else if ($isDroppedCase['enq_current_status'] == 3) {
               $se = isset($isDroppedCase['usr_first_name']) ? $isDroppedCase['usr_first_name'] : '';
               $trackCard = $isDroppedCase['enq_id'];
               $msg = 'Enquiry dropped Sales Officer ' . $se;
               die(json_encode(array('status' => false, 'msg' => $msg, 'usr_id' => '', 'se' => '', 'enq_id' => $trackCard, 'isdrop' => 1, 'regHistory' => $reghistory)));
          } else {
               $duplicate = $this->rest_model->matchingInquiry($this->input->get('phoneNo'));
               //debug($duplicate);
               if (!empty($duplicate)) {
                    $se = isset($duplicate['usr_first_name']) ? $duplicate['usr_first_name'] : '';
                    $userId = isset($duplicate['usr_id']) ? $duplicate['usr_id'] : '';
                    $trackCard = $isDroppedCase['enq_id'];
                    $msg = 'Inquiry already associated with sales executive';
                    if ($this->usr_grp == 'AD' || $this->usr_grp == 'TC') {
                         $msg = 'Inquiry already associated with sales executive ' . $se;
                    }
                    echo json_encode(array('status' => true, 'msg' => $msg, 'usr_id' => $userId, 'se' => $se, 'enq_id' => $trackCard, 'isdrop' => 0, 'regHistory' => $reghistory));
               } else {
                    echo json_encode(array(
                         'status' => false, 'msg' => 'No inquiry already associated with this contact number',
                         'usr_id' => '', 'se' => '', 'isdrop' => 0, 'regHistory' => $reghistory
                    ));
               }
          }
     }

     function printTrackCardj_get()
     {
          $enqid = $_GET['enq_id'];

          //  debug($_GET['shw_id']);
          $data['trackCard'] = $this->rest_model->getTrackCardDetails($enqid);

          $showroomId = $_GET['usr_showroom'];
          $data['showRoom'] = $this->rest_model->getShowroom($showroomId);
          //  debug($data);
          //return json_encode($data);
          echo json_encode($data);
     }

     public function addReg_post($voxBayId = 0, $teleType = 1)
     {
          // echo 11122;
          //print_r($_POST);
          // debug($_POST);
          //echo json_encode($_POST);
          ///$_POST = json_decode(file_get_contents('php://input'), true);
          //print_r($_POST);
          // exit;
          //echo 121;
          // exit;
          $msgType = 'app_success';
          $msg = 'Register successfully added!';
          $msg_duplicate_entry = NULL;
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          unset($_POST['user_id']);
          unset($_POST['usr_showroom']);
          //debug($this->uid);
          /* Check if dropped
              TODO: will delete in future
              $isDroppedCase = $this->registration->getEnquiryByMobile($this->input->post('vreg_cust_phone'));
              $status = ($isDroppedCase['enq_current_status']) ? $isDroppedCase['enq_current_status'] : 0;
              if($status == 3) {
              $this->session->set_flashdata('app_error', "This enquiry already dropped!");
              redirect(strtolower(__CLASS__));
              }
              Check if dropped */
          if (!empty($_POST)) {
               $s_data=serialize($_POST);
               $this->rest_model->appTest($s_data,'addRegistration');
               // debug($_POST);
               if ($teleType == 2) {
                    generate_log(array(
                         'log_title' => 'Contact punching (Registration) teleout',
                         'log_desc' => serialize($_POST),
                         'log_controller' => 'punch-registration-teleout',
                         'log_action' => 'C',
                         'log_ref_id' => 1011,
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));
               } else {
                    generate_log(array(
                         'log_title' => 'Contact punching (Registration)',
                         'log_desc' => serialize($_POST),
                         'log_controller' => 'punch-registration',
                         'log_action' => 'C',
                         'log_ref_id' => 1001,
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));
               }
               //Auto assign case
               /* if (!isset($_POST['vreg_assigned_to'])) {
                   $referToDivision = isset($_POST['vreg_refer_division']) ? $_POST['vreg_refer_division'] : 0;
                   $referToShowroom = isset($_POST['vreg_refer_showroom']) ? $_POST['vreg_refer_showroom'] : 0;
                   if ($referToDivision > 0 && $referToShowroom > 0) {
                   $_POST['vreg_assigned_to'] = $this->registration->getAutoAssignExecutive($referToShowroom, $referToDivision);
                   } else {
                   $_POST['vreg_assigned_to'] = $this->registration->getAutoAssignExecutive($this->shrm);
                   }
                   } */
               /* if ($this->usr_grp != 'TC') {
                   $assignTo = (isset($_POST['vreg_assigned_to']) && !empty($_POST['vreg_assigned_to'])) ? $_POST['vreg_assigned_to'] : $this->uid;
                   $_POST['vreg_assigned_to'] = $assignTo;
                   } */
               //Auto assign case
               /* $alreadyEntered = $this->registration->alreadyEnteredToday($this->input->post('vreg_cust_phone'));
                   if (!empty($alreadyEntered)) {
                   $assignBy = isset($alreadyEntered['assignBy']) ? $alreadyEntered['assignBy'] : '';
                   $assignTo = isset($alreadyEntered['assignTo']) ? $alreadyEntered['assignTo'] : '';
                   $comments = isset($alreadyEntered['vreg_last_action']) ? 'Comments : ' . $alreadyEntered['vreg_last_action'] : '';
                   $this->session->set_flashdata('app_success_pop', $this->input->post('vreg_cust_phone') .
                   ' This is already entered today, assigned by : ' . $assignBy . ' , assigned to : ' . $assignTo . ' <br>' . $comments);
                   redirect(strtolower(__CLASS__));
                   } */
               //                 if ($this->usr_grp == 'SE') {
               $_POST['vreg_cust_phone'] = isset($_POST['vreg_cust_phone']) ? str_replace(' ', '', trim($_POST['vreg_cust_phone'])) : '';
               $duplicate = $this->rest_model->matchingInquiry($this->input->post('vreg_cust_phone'));
               if (!empty($duplicate)) {
                    $se = isset($duplicate['usr_first_name']) ? $duplicate['usr_first_name'] : '';
                    $userId = isset($duplicate['usr_id']) ? $duplicate['usr_id'] : '';
                    //$_POST['vreg_assigned_to'] = $userId;
                    $msg_duplicate_entry = 'Inquiry already associated with sales executive ' . $se;
                    $msgType = 'app_success_pop';
               }
               //                 }

               /*rfrl*/
               if ($_POST['referal_type'] == 4) { //Rd staff
                    // unset($_POST['referal_name1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name1'];
                    unset($_POST['referal_name1']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone1'];
                    unset($_POST['referal_phone1']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    unset($_POST['referal_enq_cus_id']);
               } elseif ($_POST['referal_type'] == 5) { //RD Customer
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone2'];
                    unset($_POST['referal_phone2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name2'];
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    $_POST['vreg_referal_enq_id'] = $_POST['referal_enq_cus_id'];
                    unset($_POST['referal_enq_cus_id']);
               } else {
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone3'];
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name3'];
                    unset($_POST['referal_name3']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    unset($_POST['referal_enq_cus_id']);
               }
               /* @rfrl*/
               if ($this->rest_model->createRegistration($_POST)) {
                    $status = 'success';
                    $msg = 'Row successfully inserted';
                    // echo $msg;
                    //$this->session->set_flashdata($msgType, $msg);
               } else {
                    $status = 'error';
                    $msg = 'Error';
                    // echo'error';
                    //$this->session->set_flashdata('app_error', "Can't add Vehicle!");
               }
               echo json_encode(array(
                    'status' => 'success',
                    'is_duplicate_entry' => $msg_duplicate_entry,
                    'msg' => $msg
               ));
               //redirect(strtolower(__CLASS__));
          }
     }

     public function menu_get()
     {


          $condition = '1';

          if (can_access_module('enquiry') || can_access_module('customer_grade')) {
               $country[0] = array(
                    "id" => "1",
                    "name" => "Enquiry",
                    "code" => "AE",
                    "url" => "",
                    "languages" => "ar,en",
                    "children" => [check_permission('enquiry', 'index') ? [
                         "id" => "1",
                         "name" => "Enquiries",
                         "code" => "AJ",
                         "languages" => "ar,en",
                         "url" => "index",
                    ] : NULL, [
                         "id" => "2",
                         "name" => "New Enquiry",
                         "code" => "DBX",
                         "url" => "http://dubai.rent"
                    ], [
                         "id" => "3",
                         "name" => "Freezed Enquiry",
                         "code" => "AJ",
                         "url" => "http://abudhabi.rent"
                    ]],
               );
          }

          $country[1] = array(
               "id" => "2",
               "name" => "Followup",
               "code" => "IN",
               "url" => "IN",
               "children" => [[
                    "id" => "3",
                    "name" => "All Followup",
                    "code" => "KL",
                    "url" => "http://kerala.rent"
               ], [
                    "id" => "4",
                    "name" => "Missed",
                    "code" => "DBX",
                    "url" => "http://dubai.rent"
               ],],
          );
          $config['countries'] = $country;
          // $config['countries']=$country;
          echo '<pre>';
          print_r($config);
     }

     public function modeOfContact_get()
     {
          echo json_encode($this->rest_model->getModeOfContact());
     }

     public function leadType_get()
     {
          $res['call_types'] = unserialize(CALL_TYPE);
          echo json_encode($res);
     }
     public function kmRanges_get()
     {
          $kms = get_km_ranges();
          echo json_encode($kms);
     }

     public function colors_get()
     {
          $id = @$_GET['vc_id'];
          $vehicleColors['veh_colors'] = getVehicleColors($id);
          echo json_encode($vehicleColors);
     }

     public function price_ranges_get()
     {
          $price_ranges['price_ranges'] = get_price_ranges();
          echo json_encode($price_ranges);
     }

     public function years_get()
     {
          $earliest_year = YEAR_RANGE_START;
          $latest_year = date('Y');
          $data['years'] = range($latest_year, $earliest_year);
          // $yearsArray = [array_combine($data, $data)]; //Create an assoc array with equal keys and values from a regular array
          echo json_encode($data);
     }

     public function districts_get($state = 1)
     {
          if ($state) {
               $state = [1, 0];
               $data['districts'] = $this->rest_model->getDistricts($state);
               echo json_encode($data);
          }
     }

     public function customerStatus_get()
     {
          echo json_encode(unserialize(ENQUIRY_UP_STATUS));
     }

     ///////////$new////////////
     function myregister_get()
     {
         
          // $id=$this->input->get('reg_id');
          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');

          $this->page_title = "My register";
          $this->load->library("pagination");

          $limit = 6;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          // debug($page);
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);

          $link = $linkParts[0];
          // debug($link);
          $config = getPaginationDesign();

          $data = $_GET;
          //            if (check_permission('enquiry', 'myregistercallanalysis')) {
          //                 $data['tc'] = $this->enquiry->registerTodaysanalysis();
          //            }
          // debug($data);
          //debug($this->uid);
          // $this->userAccess = $this->common_model->getUser($this->uid);
          $userAccess = getUserAcess($this->uid);
          if (check_permission($this->uid, $userAccess, 'enquiry', 'myregistercallanalysis')) {
               $data['tc'] = $this->rest_model->registerTodaysanalysis();
               //  debug(213213);
          }
         
unset($_GET['user_id'],$_GET['grp_slug'],$_GET['page']);

          $enquires = $this->rest_model->getVehicleRegData(0, $limit, $page, $_GET, $userAccess);
          // debug($enquires);
          $data['datas'] = $enquires['data'];
          // debug($enquires['data']);

          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $enquires['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;

          /* Table info */
          /*  $data['pageIndex'] = $page + 1;// Showing 4
              $data['limit'] = $page + $limit; //to 6 of */
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($enquires['count']); //14 entries
          /* Table info */
          //create pagination //
          /* $this->pagination->initialize($config);
              $data["links"] = $this->pagination->create_links(); */
          //@ create pagination //
          // echo json_encode($data["links"]);
          // exit;
          // debug(7774);
          // $data['departments'] = $this->rest_model->getData();
          //$data['brand'] = $this->rest_model->getBrands();
          // $data['staff'] = $this->rest_model->teleCallersSalesStaffs();
          // $data['salesStaff'] = $this->rest_model->staffCanAssignEnquires();
          // $data['teleCallers'] = $this->rest_model->teleCallers();
          //$data['division'] = $this->rest_model->getActiveData();
          // $data['showroom'] = $this->rest_model->bindShowroomByDivision($this->input->get('vreg_division'));
          // debug( $data);
          //$this->render_page(strtolower(__CLASS__) . '/myregister', $data);
          echo json_encode($data);
     }

     function regiter_to_inquiry_get()
     {
          $id = $this->input->get('reg_id');
          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');
          $data['questions'] = $this->rest_model->getInquiryQuestions();
          $data['brands'] = $this->rest_model->getBrands();
          $data['evaluation'] = $this->rest_model->getOwnParkAndSaleCars();
          $data['salesExe'] = $this->rest_model->salesExecutives();
          $data['datas'] = $this->rest_model->getVehicleReg($id); //readVehicleReg enq mdl
          $data['Profession'] = $this->rest_model->getProfession();
          $data['Profession_cat'] = $this->rest_model->getProfessionCategory();
          $data['puposes'] = $this->rest_model->getpurposeOfPurchase();
          $data['customerGrades'] = $this->rest_model->getCustomerGrade();
          $data['ENQUIRY_TYPES'] = unserialize(ENQUIRY_TYPES);
          $data['MODE_OF_CONTACT_FOLLOW_UP'] = unserialize(MODE_OF_CONTACT_FOLLOW_UP);
          $data['model'] = $this->rest_model->getModelByBrand(isset($data['datas']['vreg_brand']) ? $data['datas']['vreg_brand'] : 0);
          $data['variant'] = $this->rest_model->getVariantByModel(isset($data['datas']['vreg_model']) ? $data['datas']['vreg_model'] : 0);
          /* $data['states'] = $this->followup->getStates($states);
              $data['countries'] = $this->followup->getCountries();
              $data['districts'] = $this->registration->getDistricts(); */
          $states = [18, 0];
          $data['districts'] = $this->rest_model->get_districts($states); //getDistricts
          $data['banks'] = $this->rest_model->getAllBanks();
          $data['user_access']['questions']['is_visible'] = 1;
          $data['user_access']['contact_mode']['is_editable'] = 0;
          echo json_encode($data);
     }
     public function punchEnquiry_post()
     {
          //echo '<pre>';
         // print_r($_POST['vehicle']['buy']['veh_fuel'][0]); exit;
          //$jsk=!empty($_POST['vehicle']['buy']['veh_fuel'][0]) ? $_POST['vehicle']['buy']['veh_fuel'][0] : 0;
         
          // debug($_POST['vehicle']['sale'],1);
          // $_POST = json_decode(file_get_contents('php://input'), true);
          // echo  $_POST;
          //echo json_encode($_POST);
          // exit;
          if (!empty($_POST)) {

              $s_data=serialize($_POST);
              $this->rest_model->appTest($s_data,'New enquirey-09-08');
               //debug($_POST,1);
               
               $this->uid = $this->input->post('user_id');
               $this->shrm = $_POST['usr_showroom'];
               $this->usr_phone = $_POST['usr_phone'];
               $this->usr_username = $_POST['usr_name'];
       generate_log(array(
                    'log_title' => 'Punch inquiry from register Mob Api',
                    'log_desc' => serialize($_POST),
                    'log_controller' => 'punch-enq-from-reg',
                    'log_action' => 'C',
                    'log_ref_id' => 1212,
                    'log_added_by' => $this->uid
               ));
               $valId = isset($_POST['valId']) ? $_POST['valId'] : 0; //Check if vehicle is selected from existing or not
               $regAssignTo = isset($_POST['vreg_assigned_to']) ? $_POST['vreg_assigned_to'] : $this->uid;
               $message = '';
               if (isset($_POST['enquiry']['enq_entry_date']) && empty($_POST['enquiry']['enq_entry_date'])) {
                    $message = ' Please select inquiry date';
               }
               if (isset($_POST['enquiry']['enq_cus_name']) && empty($_POST['enquiry']['enq_cus_name'])) {
                    $message .= ' Please enter customer name';
               }
               if (isset($_POST['enquiry']['enq_cus_mobile']) && empty($_POST['enquiry']['enq_cus_mobile'])) {
                    $message .= ' Please enter valid mobile number';
               }
               if (isset($_POST['enquiry']['enq_cus_city']) && empty($_POST['enquiry']['enq_cus_city'])) {
                    $message .= ' Please enter place';
               }
               if (isset($_POST['enquiry']['enq_mode_enq']) && empty($_POST['enquiry']['enq_mode_enq'])) {
                    $message .= ' Please select mode of inquiry';
               }
               if (isset($_POST['enquiry']['enq_cus_when_buy']) && empty($_POST['enquiry']['enq_cus_when_buy'])) {
                    $message .= ' Please choose when would customer like to buy';
               }
               //debug(121231,1);
               // debug($_POST['enquiry']['enq_mode_enq']);
               //debug($message);
               //                 $duplicate = $this->enquiry->registerExists($_POST['enquiry']['enq_cus_mobile']);
               //                 if(!empty($duplicate)) {
               //                      $message .= ' Inquiry already associated with register';
               //                 }
               if (empty($message)) {

                    $myname =  $this->usr_username;
                    $mynumber =  $this->usr_phone;
                    $mycustmr = trim($_POST['enquiry']['enq_cus_name']);
                    $message = "Hi Mr.$mycustmr
      Greetings from Royal Drive South India's Largest Pre-Owned Luxury Car Showroom Thank you for the visit, We are grateful for serving you. 
      My self $myname, Please feel free to contact me @ $mynumber. Regards, $myname info@royaldrive.in www.royaldrive.in App Link: http://onelink.to/p4z8q2";
                    if ($enquiryId = $this->rest_model->newEnquiry($_POST, $valId)) {
                         // debug($enquiryId);
                         //$valId == cpnl_valuation table master id
                         $this->rest_model->addEnquiryHistory(
                              array(
                                   'enh_status' => 1,
                                   'enh_enq_id' => $enquiryId,
                                   'enh_added_by' => $this->uid,
                                   'enh_added_on' => date('Y-m-d h:i:s'),
                                   'enh_remarks' => 'Contact punched to enquiry',
                                   'enh_current_sales_executive' => $regAssignTo,
                              )
                         );

                         if ($mobile_number = is_indian_number($_POST['enquiry']['enq_cus_mobile'])) {
                              ///send_sms($message, $mobile_number, 'sms-enquiry');
                         } else if ($mobile_number = is_indian_number($_POST['enquiry']['enq_cus_whatsapp'])) {
                              /// send_sms($message, $mobile_number, 'sms-enquiry');
                         }
                         // $this->session->set_flashdata('app_success', 'New enguiry successfully added!');
                         echo json_encode(array('status' => 'success', 'msg' => 'New enguiry successfully added!'));
                    } else {
                        // $this->session->set_flashdata('app_error', 'Error while create new enguiry!');
                         echo json_encode(array('status' => 'fail', 'msg' => 'Error while create new enguiry!'));
                    }
               } else {
                    echo json_encode(array('status' => 'fail', 'msg' => $message));
               }
          }
          //   else {
          //        $data['brands'] = $this->enquiry->getBrands();
          //        $data['questions'] = $this->enquiry->getInquiryQuestions();
          //        $data['evaluation'] = $this->evaluation->getOwnParkAndSaleCars();
          //        $data['salesExe'] = $this->emp_details->salesExecutives();
          //        //$this->render_page(strtolower(__CLASS__) . '/add', $data);
          //   }
     }
     public function punchEnquiry_old_post()
     { //echo 1117;
          // debug($_POST);
          // echo json_encode($_POST);

          if (!empty($_POST)) {
               //debug($_POST['enquiry']['enq_ref_type']);
               $this->uid = $this->input->post('user_id');
               $this->shrm = $_POST['usr_showroom'];
               //  $this->uid =$_POST['user_id'];
               // echo $_POST['user_id'];
               //  echo $this->uid;
               // exit;
               generate_log(array(
                    'log_title' => 'Punch inquiry from register',
                    'log_desc' => serialize($_POST),
                    'log_controller' => 'punch-enq-from-reg',
                    'log_action' => 'C',
                    'log_ref_id' => 1212,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));
               // exit;
               $valId = isset($_POST['valId']) ? $_POST['valId'] : 0; //Check if vehicle is selected from existing or not

               $regAssignTo = isset($_POST['vreg_assigned_to']) ? $_POST['vreg_assigned_to'] : $this->uid;

               $message = '';
               if (isset($_POST['enquiry']['enq_entry_date']) && empty($_POST['enquiry']['enq_entry_date'])) {
                    $message = ' Please select inquiry date';
               }
               if (isset($_POST['enquiry']['enq_cus_name']) && empty($_POST['enquiry']['enq_cus_name'])) {
                    $message .= ' Please enter customer name';
               }
               if (isset($_POST['enquiry']['enq_cus_mobile']) && empty($_POST['enquiry']['enq_cus_mobile'])) {
                    $message .= ' Please enter valid mobile number';
               }
               if (isset($_POST['enquiry']['enq_cus_city']) && empty($_POST['enquiry']['enq_cus_city'])) {
                    $message .= ' Please enter place';
               }
               if (isset($_POST['enquiry']['enq_mode_enq']) && empty($_POST['enquiry']['enq_mode_enq'])) {
                    $message .= ' Please select mode of inquiry';
               }
               if (isset($_POST['enquiry']['enq_cus_when_buy']) && empty($_POST['enquiry']['enq_cus_when_buy'])) {
                    $message .= ' Please choose when would customer like to buy';
               }
               //                 $duplicate = $this->enquiry->registerExists($_POST['enquiry']['enq_cus_mobile']);
               //                 if(!empty($duplicate)) {
               //                      $message .= ' Inquiry already associated with register';
               //                 }
               if (empty($message)) {
                    $myname = get_logged_user('usr_username');
                    $mynumber = get_logged_user('usr_phone');
                    $mycustmr = trim($_POST['enquiry']['enq_cus_name']);
                    $message = "Hi Mr.$mycustmr
Greetings from Royal Drive South India's Largest Pre-Owned Luxury Car Showroom Thank you for the visit, We are grateful for serving you. 
My self $myname, Please feel free to contact me @ $mynumber. Regards, $myname info@royaldrive.in www.royaldrive.in App Link: http://onelink.to/p4z8q2";
                    if ($enquiryId = $this->rest_model->newEnquiry($_POST, $valId)) { //$valId == cpnl_valuation table master id
                         $this->rest_model->addEnquiryHistory(
                              array(
                                   'enh_status' => 1,
                                   'enh_enq_id' => $enquiryId,
                                   'enh_added_by' => $this->uid,
                                   'enh_added_on' => date('Y-m-d h:i:s'),
                                   'enh_remarks' => 'Contact punched to enquiry',
                                   'enh_current_sales_executive' => $regAssignTo,
                              )
                         );

                         if ($mobile_number = is_indian_number($_POST['enquiry']['enq_cus_mobile'])) {
                              send_sms($message, $mobile_number, 'sms-enquiry');
                         } else if ($mobile_number = is_indian_number($_POST['enquiry']['enq_cus_whatsapp'])) {
                              send_sms($message, $mobile_number, 'sms-enquiry');
                         }

                         echo json_encode(array('status' => 'success', 'msg' => 'New enguiry successfully added!'));
                    } else {

                         echo json_encode(array('status' => 'fail', 'msg' => 'Error while create new enguiry!'));
                    }
               } else {
                    echo json_encode(array('status' => 'fail', 'msg' => $message));
               }
          }

          //            else {
          //                 $data['brands'] = $this->enquiry->getBrands();
          //                 $data['questions'] = $this->enquiry->getInquiryQuestions();
          //                 $data['evaluation'] = $this->evaluation->getOwnParkAndSaleCars();
          //                 $data['salesExe'] = $this->emp_details->salesExecutives();
          //                 $this->render_page(strtolower(__CLASS__) . '/add', $data);
          //            }
     }


     function punchtest()
     {
          $_POST = json_decode(file_get_contents('php://input'), true);
          // print_r($_POST['vehicle']['sale']);
          // exit;
          foreach ($_POST['enquiry'] as $k => $v) {
               //$e='enquiry['.$k.']:'.$v.'</br>';
               //echo $e;


          }
          foreach ($_POST['saquestions'] as $k => $v) {
               //print_r($k);
               //$e='enquiry['.$k.']:'.$v.'</br>';
               $e = 'saquestions[' . $k . ']:' . $v . '</br>';

               // echo $e;


          }
          foreach ($_POST['byquestions'] as $k => $v) {
               //print_r($k);
               //$e='enquiry['.$k.']:'.$v.'</br>';
               $e = 'byquestions[' . $k . ']:' . $v . '</br>';

               // echo $e;


          }
          foreach ($_POST['exquestions'] as $k => $v) {
               //print_r($k);
               //$e='enquiry['.$k.']:'.$v.'</br>';
               $e = 'exquestions[' . $k . ']:' . $v . '</br>';

               //  echo $e;


          }
          foreach ($_POST['vehicle']['sale'] as $k => $v) {
               // print_r($v);
               // print_r($k);

               //vehicle[sale][veh_brand][]
               $e = 'vehicle[sale][' . $k . '][]:' . $v[0] . '</br>';

               // echo $e;


          }
          foreach ($_POST['vehicle']['pitched'] as $k => $v) {
               // print_r($v);
               // print_r($k);

               //vehicle[sale][veh_brand][]
               $e = 'vehicle[pitched][' . $k . '][]:' . $v[0] . '</br>';

               //echo $e;


          }
          foreach ($_POST['vehicle']['buy'] as $k => $v) {
               // print_r($v);
               // print_r($k);

               //vehicle[sale][veh_brand][]
               $e = 'vehicle[buy][' . $k . '][]:' . $v[0] . '</br>';

               // echo $e;


          }

          foreach ($_POST['vehicle']['existing'] as $k => $v) {
               // print_r($v);
               // print_r($k);

               //vehicle[sale][veh_brand][]
               $e = 'vehicle[existing][' . $k . '][]:' . $v[0] . '</br>';

               // echo $e;


          }
          foreach ($_POST['followup'] as $k => $v) {
               // print_r($v);
               // print_r($k);

               //vehicle[sale][veh_brand][]
               $e = 'followup[' . $k . ']:' . $v . '</br>';
               //followup[foll_status]:

               echo $e;
          }
     }

     function matchingInquiryByPhone_get()
     {
          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');
          $data['enq_data'] = $this->rest_model->get_enquiryByMobile($this->input->post('phoneNo'));
          // debug($data['enq_data']);
          $data['showroom'] = $this->rest_model->getShowroom();
          $data['brand'] = $this->rest_model->getBrands();
          $data['banks'] = $this->rest_model->getAllBanks();
          $data['insurers'] = $this->rest_model->getInsurers();
          $data['division'] = $this->rest_model->getActiveData();
          $data['managers'] = $this->rest_model->getAllManagers();
          $data['salesExe'] = $this->rest_model->salesExecutivesOnly();
          $data['evaluators'] = $this->rest_model->getAllEvaluators();
          $data['enq'] = '';
          $data['typed_phone'] = $this->input->post('phoneNo');

          if (!empty($data['enq_data']) and @$data['enq_current_status'] != 3) {
               //debug($data);
               //debug('und');
               $data['enq'] = 1;

               $f_url = 'update';
               // $form='<form class="x_content frmNewValuation" id="frm_tag" data-url="'.$f_url.'">';
               // $enq_data = $this->load->view(strtolower(__CLASS__) . '/view_enq_data', $data, true);
               // debug(7777);
               echo json_encode(array('status' => 'success', 'msg' => '', 'enq_data' => $data, 'update' => 1));
          } else {

               // debug('illa');
               //debug($data);
               $f_url = 'add';
               // $form='<form class="x_content frmNewValuation" id="frm_tag" data-url="'.$f_url.'">';
               //$enq_data = $this->load->view(strtolower(__CLASS__) . '/view_enq_data', $data, true);
               echo json_encode(array('status' => 'success', 'msg' => '', 'enq_data' => $data, 'update' => 0));
          }
     }

     function createEvaluation_get()
     {

          $this->uid = $this->input->get('user_id');
          $this->usr_grp = $this->input->get('grp_slug');
          $data['showroom'] = $this->rest_model->getShowroom();
          $data['brand'] = $this->rest_model->getBrands();
          $data['banks'] = $this->rest_model->getAllBanks();
          $data['insurers'] = $this->rest_model->getInsurers();
          $data['division'] = $this->rest_model->getActiveData();
          $data['managers'] = $this->rest_model->getAllManagers();
          $data['salesExe'] = $this->rest_model->salesExecutivesOnly();
          $data['evaluators'] = $this->rest_model->getAllEvaluators();
          $data['vehicleFeatures'] = $this->rest_model->getAllVehicleFeatures();
          $data['vehicleAddOnFeatures'] = $this->rest_model->getVehicleAddOnFeatures();
          $data['fullBodyCheckupMaster'] = $this->rest_model->getFullBodyCheckupMaster();
          //


          $data['APMASM'] = $this->rest_model->getAllAPMASM();

          $data['salesExe'] = $this->rest_model->getEnquiryHandingMembers();



          // $data['showroom'] = $this->rest_model->getShowRoomByDivision($data['vehicles']['val_division']);
          //$data['purchaseAdmin'] = $this->rest_model->getStaffByGroup('usr_is_purchase_admin');

          $data['purchaseAdmin'] = $this->rest_model->getStaffByGroup();

          $data['mis'] = $this->rest_model->getMISEvaluation();

          $data['delco'] = $this->rest_model->getDelco();

          $data['teleclrs'] = $this->rest_model->getTelecaller();

          $data['telslsco'] = $this->rest_model->getTelesalesCoordinator();
          // debug($data);
          $data['telprsco'] = $this->rest_model->getTelePurchaseCoordinator();
          //$data['admin'] = $this->rest_model->getStaffByGroup('usr_is_sales_admin');
          $data['admin'] = $this->rest_model->getStaffByGroup();
          $data['vehicles']['val_division'] = 2;
          $data['vehicles']['val_showroom'] = 1;
          $data['vehicles']['val_sales_officer'] = 358;
          $data['vehicles']['val_evaluator'] = 854;
          $data['vehicles']['val_manager'] = 32;
          $data['vehicles']['val_mis'] = 641;
          $data['vehicles']['val_admin'] = 869;
          $data['vehicles']['val_apm_asm'] = 14;
          $data['vehicles']['val_tsc'] = 14;
          $data['vehicles']['val_tele_caller'] = 969;

          echo json_encode(array('data' => $data));

          //@
          // echo json_encode(array('status' => 'success', 'msg' => '', 'enq_data' => $data, 'update' => 0));
     }

     function SaveEvaluation_post()
     {

          if (!empty($_POST)) {
             //  print_r($_POST['valuation']['val_cust_name']); exit;
               $s_data=serialize($_POST);
              $this->rest_model->appTest($s_data,'SaveEvaluation');
              // $s_data=$_POST['valuation']['val_cust_name'];
               //$this->rest_model->appTest($s_data,'SaveEvaluation');
              

               $this->uid = $this->input->post('user_id');
               $this->usr_grp = $this->input->get('grp_slug');
               $this->load->library('upload');
               if ($_POST['valuation']['val_cust_source'] == 34) { //SaveEvaluation
                    if ($_POST['valuation']['val_refferal_type'] == 4) { //Rd staff
                         // unset($_POST['referal_name1']);
                         unset($_POST['referal_name3']);
                         unset($_POST['referal_phone3']);
                         unset($_POST['referal_phone2']);
                         unset($_POST['referal_name2']);
                         $_POST['valuation']['val_refferer_name'] = $_POST['referal_name1'];
                         unset($_POST['referal_name1']);
                         $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone1']; //val_referal_phone
                         unset($_POST['referal_phone1']);
                         //$_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                         //unset($_POST['valuation']['val_refferal_type']);
                         // unset($_POST['referal_enq_cus_id']);
                    } elseif ($_POST['valuation']['val_refferal_type'] == 5) { //RD Customer
                         unset($_POST['referal_name1']);
                         unset($_POST['referal_phone1']);
                         unset($_POST['referal_name3']);
                         unset($_POST['referal_phone3']);
                         $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone2'];
                         unset($_POST['referal_phone2']);
                         $_POST['valuation']['val_refferer_name'] = $_POST['referal_name2'];
                         unset($_POST['referal_name2']);
                         // $_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                         // unset($_POST['valuation']['val_refferal_type']);
                         //   $_POST['vreg_referal_enq_id'] = $_POST['referal_enq_cus_id'];
                         // unset($_POST['referal_enq_cus_id']);
                    } else {
                         unset($_POST['referal_name1']);
                         unset($_POST['referal_phone1']);
                         unset($_POST['referal_phone2']);
                         unset($_POST['referal_name2']);
                         $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone3'];
                         unset($_POST['referal_phone3']);
                         $_POST['valuation']['val_refferer_name'] = $_POST['referal_name3'];
                         unset($_POST['referal_name3']);
                         //$_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                         //unset($_POST['valuation']['val_refferal_type']);
                         // unset($_POST['referal_enq_cus_id']);
                    }
               }
               // debug($_POST['valuation']);
               //if (!$this->evaluation->checkVehicleExists($_POST)) {
               if ($evId = $this->rest_model->newEvaluation($_POST['valuation'])) {
                    if (isset($_POST['complaint_title']) && !empty($_POST['complaint_title'])) {
                         foreach ($_POST['complaint_title'] as $key => $value) {
                              $complaint['comp_pic'] = '';
                              if (isset($_FILES['complaint_file']['name'][$key]) && !empty($_FILES['complaint_file']['name'][$key])) {
                                   $newFileName = rand() . $_FILES['complaint_file']['name'][$key];
                                   // $config['upload_path'] = 'rdportal/assets/uploads/ju/';
                                   $config['upload_path'] = 'assets/uploads/evaluation';
                                   $config['allowed_types'] = '*';
                                   $config['file_name'] = $newFileName;
                                   $this->upload->initialize($config);
                                   $_FILES['prd_image_tmp']['name'] = $_FILES['complaint_file']['name'][$key];
                                   $_FILES['prd_image_tmp']['type'] = $_FILES['complaint_file']['type'][$key];
                                   $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['complaint_file']['tmp_name'][$key];
                                   $_FILES['prd_image_tmp']['error'] = $_FILES['complaint_file']['error'][$key];
                                   $_FILES['prd_image_tmp']['size'] = $_FILES['complaint_file']['size'][$key];
                                   if ($this->upload->do_upload('prd_image_tmp')) {

                                        $uploadData = $this->upload->data();
                                        $complaint['comp_pic'] = $uploadData['file_name'];
                                   } else {
                                        $uploadError = $this->upload->display_errors();
                                        debug($uploadError);
                                   }
                              }
                              if (!empty($complaint['comp_pic']) || !empty($value)) {
                                   $complaint['comp_val_id'] = $evId;
                                   $complaint['comp_complaint'] = $value;
                                   $this->rest_model->newEvaluationComplaints($complaint);
                              }
                         }
                         // echo 'Row successfully added!';
                         // $this->session->set_flashdata('app_success', 'Row successfully added!');
                    }
                    //features
                    if (isset($_POST['features']) && !empty($_POST['features'])) {
                         foreach ($_POST['features'] as $key => $value) {
                              $this->rest_model->newFeatures(array('vfet_valuation' => $evId, 'vfet_feature' => $value));
                         }
                    }
                    //Full body check up
                    if (isset($_POST['fulbdchk']) && !empty($_POST['fulbdchk'])) {
                         foreach ($_POST['fulbdchk'] as $key => $value) {
                              $this->rest_model->fullBodyCheckup(
                                   array(
                                        'vfbc_valuation_master' => $evId,
                                        'vfbc_chkup_master' => $key, 'vfbc_chkup_details' => $value
                                   )
                              );
                         }
                    }
                    //Upgradation details
                    if (isset($_POST['upgradedetails']) && !empty($_POST['upgradedetails'])) {
                         $this->rest_model->upgradeDetails($_POST['upgradedetails'], $evId);
                    }
                    //Upload documents
                    if (
                         isset($_FILES['documents']['name'][0]) && !empty($_FILES['documents']['name'][0]) &&
                         is_array($_FILES['documents']['name'])
                    ) {
                         foreach ($_FILES['documents']['name'] as $key => $value) {
                              $newFileName = rand() . $_FILES['documents']['name'][$key];
                              // $config['upload_path'] = 'rdportal/assets/uploads/evaluation/';
                              //$config['upload_path'] = 'rdportal/assets/uploads/ju';
                              $config['upload_path'] = 'assets/uploads/evaluation/';
                              $config['allowed_types'] = '*';
                              $config['file_name'] = $newFileName;
                              $this->upload->initialize($config);

                              $_FILES['tmp_doc']['name'] = $_FILES['documents']['name'][$key];
                              $_FILES['tmp_doc']['type'] = $_FILES['documents']['type'][$key];
                              $_FILES['tmp_doc']['tmp_name'] = $_FILES['documents']['tmp_name'][$key];
                              $_FILES['tmp_doc']['error'] = $_FILES['documents']['error'][$key];
                              $_FILES['tmp_doc']['size'] = $_FILES['documents']['size'][$key];

                              if ($this->upload->do_upload('tmp_doc')) {
                                   $uploadData = $this->upload->data();
                                   $complaint['comp_pic'] = $uploadData['file_name'];

                                   if (isset($uploadData['file_name']) && !empty($uploadData['file_name'])) {
                                        $docs['vdoc_val_id'] = $evId;
                                        $docs['vdoc_doc'] = $uploadData['file_name'];
                                        $docs['vdoc_doc_title'] = isset($_POST['document_title'][$key]) ? $_POST['document_title'][$key] : '';
                                        $docs['vdoc_doc_type'] = isset($_POST['document_type'][$key]) ? $_POST['document_type'][$key] : '';
                                        $this->rest_model->newEvaluationDocument($docs);
                                   }
                              } else {
                                   $f = $this->upload->display_errors();
                                   //debug($f);
                                   echo json_encode(array('status' => 'Error', 'msg' => $f, 'id' => @$evId));
                                  // debug($f);
                                   //exit;
                              }
                         }
                    }
                    //Upload images
                    if (isset($_POST['eveimg']) && !empty($_POST['eveimg'])) {
                         foreach ($_POST['eveimg'] as $key => $value) {
                              if (!empty($value)) {
                                   $frame = explode('_', $value);
                                   $frame = isset($frame['0']) ? $frame['0'] : 0;
                                   $this->rest_model->uploadEvaluationVehicleImages(array('vvi_val_id' => $evId, 'vvi_frame_id' => $frame, 'vvi_image' => $value));
                              }
                         }
                    }
                    echo json_encode(array('status' => 'success', 'msg' => 'Successfully Evaluated', 'id' => @$evId));
               } else {
                    echo json_encode(array('status' => 'Error', 'msg' => 'Error!', 'id' => @$evId));
               }
               //} else {
               //    echo json_encode(array('status' => 'fail', 'msg' => 'Vehicle already evaluated'));
               //}
          }

     }

     function changeRegisterStatus_post()
     { //Regiter->Popup reg to enq
          //debug($_POST);
          if (isset($_POST['regMaster']) && !empty($_POST['regMaster'])) {
               $this->uid = $this->input->post('user_id');
               // debug($this->uid );
               generate_log(array(
                    'log_title' => 'Change Register Status',
                    'log_desc' => serialize($_POST),
                    'log_controller' => 'change-register-status-drop-req',
                    'log_action' => 'C',
                    'log_ref_id' => $_POST['regMaster'],
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));
               $this->rest_model->reqToDropRegister($this->input->post());
               echo json_encode(array('status' => 'success', 'msg' => 'Register request dropped'));
          }
     }

     function setRegisterFollowup_post()
     { //jsk786
          // debug($_POST);
          if (isset($_POST['regfoll']) && !empty($_POST['regfoll'])) {
               $this->uid = $this->input->post('user_id');
               $this->rest_model->setRegisterFollowup($_POST);
               echo json_encode(array('status' => 'success', 'msg' => 'Register followup successfully updated'));
          }
     }

     function regFollowups_get()
     {
          //5457
          $reg_id = $this->input->get('vreg_id');
          if ($reg_id) {
               $regFollowups = $this->rest_model->regFollowups($reg_id);
               if (!empty($regFollowups)) {
                    echo json_encode(array('status' => 1, 'regFollowups' => $regFollowups));
               } else {
                    echo json_encode(array('status' => 0, 'message' => 'No data found'));
               }
          }
     }

     function FollowUpCallTypes_get()
     {
          //debug(777);
          $types = unserialize(FOLLOWUP_CALL_TYPES_API);
          echo json_encode(array('status' => 'success', 'call_types' => $types));
          // debug($types);
     }
     function reg_droped_get()
     {
          //debug(777);
          $types = unserialize(reg_droped_API);
          echo json_encode(array('status' => 'success', 'reg_droped' => $types));
          // debug($types);
     }


     function customerGrade_get()
     {
          $id = '';
          $id = $this->input->get('sgrd_id');
          $data['customerGrades'] = $this->rest_model->getCustomerGrade($id);
          echo json_encode(array('status' => 'success', 'data' => $data));
     }

     public function km_field_text_or_select_get()
     {
          echo json_encode(unserialize(KM_field_select_or_text));
     }

     public function referal_types_get()
     {
          $referalTypes = unserialize(REFERAL_TYPES);
          foreach ($referalTypes as $key => $value) {
               $referal_types['id'] = $key;
               $referal_types['name'] = $value;
               $res['referal_types'][] = $referal_types;
          }
          // echo json_encode($res);
          echo json_encode($res);
     }

     function getAllRdStaffs_get()
     {
          $this->uid = $_GET['user_id'];
          $staffs = $this->rest_model->bindAllRdStaffs();
          echo json_encode($staffs);
     }

     function customerByPhone_get()
     {
          // Check if dropped
          //TODO: will delete in future
          //$isDroppedCase = $this->registration->getEnquiryByMobile($this->input->post('phoneNo'));
          // $matchingRegister['reghistory'] = $this->registration->matchingRegister($this->input->post('phoneNo'));
          $matchingRegister['enq'] = $this->rest_model->getEnquiryByMobile($this->input->get('phoneNo'));
          //debug($matchingRegister['enq']);
          if (!empty($matchingRegister['enq'])) {
               // echo json_encode([array(
               //      'status' => 'success',
               //      'customer_name' => $matchingRegister['enq']['enq_cus_name'], 'this_customer_enq_id' => $matchingRegister['enq']['enq_id']
               // )]);
               echo json_encode(array(
                    'status' => 'success',
                    'customer_name' => $matchingRegister['enq']['enq_cus_name'], 'this_customer_enq_id' => $matchingRegister['enq']['enq_id']
               ));
          } else {
               echo json_encode(array('status' => 'failed', 'msg' => 'No records found'));
          }
     }

     function teleCallersSalesStaffs_get()
     {
          $data['staff'] = $this->rest_model->teleCallersSalesStaffs();
          echo json_encode($data);
     }

     function regPendingCount_get()
     {
          $uid = $_GET['col_id'];
          $data['count'] = $this->rest_model->regPendingCount($uid);
          echo json_encode($data);
     }

     /* $ return data for registration edit form */

     public function registration_edit_form_get()
     {
          $id = @$_GET['reg_id'];
          $this->uid = @$_GET['user_id'];
          $this->usr_grp = $this->input->get('grp_slug');
          // debug($id);
          if ($id && $this->uid) {

               $data['title'] = 'Edit quick vehicle registration';
               $data['data'] = $this->rest_model->readVehicleReg($id);
               // debug(  $data['data'] );
               $data['data']['division_name'] = $this->rest_model->getDivisionName($data['data']['vreg_division']);
               $data['data']['showroom_name'] = $this->rest_model->getShowRoomName($data['data']['vreg_showroom']);
               // $data['data']['showroom_name']=$this->rest_model->getShowRoomName($data['data']['vreg_showroom']);
               // $data['showroom'] = $this->rest_model->getShowRoomByDivision($data['data']['vreg_division']);
               //$data['showroom'];
               $data['data']['department_name'] = $this->rest_model->getDepartmentName($data['data']['vreg_department']);
               $data['user_access']['mode_of_contact']['is_editable'] = 1;
               echo json_encode($data);
               exit;
          }
          echo json_encode([array('status' => 'failed', 'msg' => 'Required params are missing')]);
     }

     /* @ return data for registration edit form */

     public function updateRegistrationj1_post()
     {
          //debug($_POST);
        //  echo json_encode(array('status' => 'success', 'msg' => 'testing...'));
        //  exit;
          $this->uid = @$_POST['user_id'];
          $vregId = @$_POST['vreg_id'];
          if (!empty($_POST) && $vregId && $this->uid) {
               $s_data=serialize($_POST);
               $this->rest_model->appTest($s_data,'updateRegistration07');




               $this->user_name = @$_POST['user_name'];
               $this->shrm = $_POST['usr_showroom'];
               unset($_POST['user_id']);
               unset($_POST['usr_showroom']);
               unset($_POST['user_name']);
               generate_log(array(
                    'log_title' => 'Contact punching (Registration) updation',
                    'log_desc' => serialize($_POST),
                    'log_controller' => 'punch-registration-edit',
                    'log_action' => 'U',
                    'log_ref_id' => $vregId,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));

               if($_POST['vreg_contact_mode']==34){//new

              
               $_POST['referal_type'] = $_POST['referal_type'] ? $_POST['referal_type'] : 0;
               //debug($_POST['referal_type']);                                          
               if ($_POST['referal_type'] == 4) { //Rd staff
                    // unset($_POST['referal_name1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name1'];
                    unset($_POST['referal_name1']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone1'];
                    unset($_POST['referal_phone1']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    $_POST['vreg_referal_enq_id']=0;
                    unset($_POST['referal_enq_cus_id']);
               } elseif ($_POST['referal_type'] == 5) { //RD Customer
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone2'];
                    unset($_POST['referal_phone2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name2'];
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    $_POST['vreg_referal_enq_id'] = $_POST['referal_enq_cus_id'];
                    unset($_POST['referal_enq_cus_id']);
               } else {
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone3'];
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name3'];
                    unset($_POST['referal_name3']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    $_POST['vreg_referal_enq_id']=0;
                    unset($_POST['referal_enq_cus_id']);
               }
          }else{
              // unset($_POST['vreg_contact_mode']);
               unset($_POST['referal_name1']);
               unset($_POST['referal_phone1']);
               unset($_POST['referal_phone2']);
               unset($_POST['referal_name2']);

               unset($_POST['referal_phone3']);
               unset($_POST['referal_name3']);
               unset($_POST['referal_type']);
               unset($_POST['referal_enq_cus_id']);
               $_POST['vreg_referal_type']=0;
               $_POST['vreg_referal_name']=NULL;
               $_POST['vreg_referal_phone']=NULL;
               $_POST['vreg_referal_enq_id']=0;




          }
               if ($this->rest_model->updateRegistration($_POST)) {
                    echo json_encode(array('status' => 'success', 'msg' => 'Register successfully updated'));
                    exit;
               } else {
                    echo json_encode(array('status' => 'error', 'msg' => "Can't update row!"));
                    exit;
               }
          } else {
               echo json_encode([array('status' => 'failed', 'msg' => 'Required params are missing')]);
          }
          exit;
     }
     public function updateRegistration_post()
     {
          //debug($_POST);

          $this->uid = @$_POST['user_id'];
          $vregId = @$_POST['vreg_id'];
          if (!empty($_POST) && $vregId && $this->uid) {
               $this->user_name = @$_POST['user_name'];
               $this->shrm = $_POST['usr_showroom'];
               unset($_POST['user_id']);
               unset($_POST['usr_showroom']);
               unset($_POST['user_name']);
               generate_log(array(
                    'log_title' => 'Contact punching (Registration) updation',
                    'log_desc' => serialize($_POST),
                    'log_controller' => 'punch-registration-edit',
                    'log_action' => 'U',
                    'log_ref_id' => $vregId,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));
               $_POST['referal_type'] = $_POST['referal_type'] ? $_POST['referal_type'] : 0;
               //debug($_POST['referal_type']);                                          
               if ($_POST['referal_type'] == 4) { //Rd staff
                    // unset($_POST['referal_name1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name1'];
                    unset($_POST['referal_name1']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone1'];
                    unset($_POST['referal_phone1']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    unset($_POST['referal_enq_cus_id']);
               } elseif ($_POST['referal_type'] == 5) { //RD Customer
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone2'];
                    unset($_POST['referal_phone2']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name2'];
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    $_POST['vreg_referal_enq_id'] = $_POST['referal_enq_cus_id'];
                    unset($_POST['referal_enq_cus_id']);
               } else {
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['vreg_referal_phone'] = $_POST['referal_phone3'];
                    unset($_POST['referal_phone3']);
                    $_POST['vreg_referal_name'] = $_POST['referal_name3'];
                    unset($_POST['referal_name3']);
                    $_POST['vreg_referal_type'] = $_POST['referal_type'];
                    unset($_POST['referal_type']);
                    unset($_POST['referal_enq_cus_id']);
               }
               if ($this->rest_model->updateRegistration($_POST)) {
                    echo json_encode(array('status' => 'success', 'msg' => 'Register successfully updated'));
                    exit;
               } else {
                    echo json_encode(array('status' => 'error', 'msg' => "Can't update row!"));
                    exit;
               }
          } else {
               echo json_encode([array('status' => 'failed', 'msg' => 'Required params are missing')]);
          }
          exit;
     }

     public function events_get($id = '')
     {
          // return 1212;

          $data['events'] = $this->rest_model->readEvent($id);
          echo json_encode($data);
     }

     function getfueltypes_get()
     {
          $id = @$_GET['id'];
          if ($id) {
               $fuel['fuel_tile'] = unserialize(FUALS)[$id];
          } else {
               $fuel['fueltypes'] = unserialize(FUAL);
          }
          echo json_encode($fuel);
     }
     function vehicle_types_get()
     {
          $id = @$_GET['id'];

          if ($id) {
               $vehicle_types['vehicle_types'] = unserialize(ENQ_VEHICLE_TYPES)[$id];
          } else {
               $vehicle_types['vehicle_types'] = unserialize(ENQ_VEHICLE_TYPES);
          }
          // debug($vehicle_types['vehicle_types']);
          echo json_encode($vehicle_types);
     }
     //enq list
     public function enquiry_list_get()
     {
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          //debug(1212);
          $filterStatus = isset($_GET['status']) ? $_GET['status'] : 0;
          $this->load->library("pagination");
          $limit = 10;
          //  debug($limit);
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          //$config = getPaginationDesign();

          $data = $_GET;
          $enquires = $this->rest_model->enquires('', array(), $limit, $page, $_GET);
          //  echo sizeof($enquires['data']);
          // print_r(count($enquires['data']));
          //exit;
          // debug($enquires);
          $data['enquires'] = $enquires['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $enquires['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;

          /* Table info */
          /////// $data['pageIndex'] = $page + 1;
          // $data['limit'] = $page + $limit;
          // $data['totalRow'] = number_format($enquires['count']);
          /* Table info */

          //$this->pagination->initialize($config);
          // $data["links"] = $this->pagination->create_links();
          // $data['pagination']['pageIndex'] = $page + 1;
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($enquires['count']);
          $data['staffs'] = $this->rest_model->staffCanAssignEnquires();

          //$this->render_page(strtolower(__CLASS__) . '/list', $data);
          echo json_encode($data);
     }
     //@enq lis
     public function purchase_period_get()
     {
          $data['PURCHASE_PERIOD'] = unserialize(PURCHASE_PERIOD);
          echo json_encode($data);
     }
     //enq edit
     function enquiry_edit_get()
     { //view_change
          $enq_id = $this->input->get('enq_id');
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];


          if (!empty($enq_id)) {
               // debug($_GET);
               //$id = encryptor($enq_id, 'D');
               $id = $enq_id;

               // $data['vreg_department'] = encryptor($vreg_department, 'D');
               // $data['reg_id'] = encryptor($reg_id, 'D');
               // $data['vreg_department'] =$vreg_department;
               //$data['reg_id'] = $reg_id;

               $data['customerGrades'] = $this->rest_model->customerGrade();
               $data['questions'] = $this->rest_model->getInquiryQuestions();
               $data['brands'] = $this->rest_model->getBrands();
               //debug($data);
               //debug(464);
               $data['enquiry'] = $this->rest_model->enquires($enq_id);
               //debug($data['enquiry']['questions']);
               //debug(7412365);
               //debug($data['enquiry']['vehicle_pitched']);

               $data['followStatus'] = unserialize(FOLLOW_UP_STATUS);
               $data['modOfContact'] = unserialize(MODE_OF_CONTACT_FOLLOW_UP);

               $data['salesExe'] = $this->rest_model->salesExecutives();
               $data['evaluation'] = $this->rest_model->getOwnParkAndSaleCars();
               //debug($data['evaluation']);
               // $data['districts'] = $this->registration->getDistricts($data['enquiry']['enq_cus_state']);
               $data['Profession'] = $this->rest_model->getProfession();
               $data['Profession_cat'] = $this->rest_model->getProfessionCategory();
               $data['puposes'] = $this->rest_model->getpurposeOfPurchase();
               $data['states'] = $this->rest_model->getStates();
               $states = [1, 0];
               $data['districts'] = $this->rest_model->getDistricts($states);
               //$data['countries'] = $this->rest_model->getCountries();
               $data['banks'] = $this->rest_model->getAllBanks(); //debug($data);
               //debug($data['evaluation']);
               $data['datas'] = $this->rest_model->readVehicleRegEnq($enq_id); //readVehicleReg enq mdl
               //debug($data['datas']);
               $data['model'] = $this->rest_model->getModelByBrand(isset($data['datas']['vreg_brand']) ? $data['datas']['vreg_brand'] : 0);
               $data['variant'] = $this->rest_model->getVariantByModel(isset($data['datas']['vreg_model']) ? $data['datas']['vreg_model'] : 0);
               $data['user_access']['mode_of_enquery']['is_editable'] = 1;
               $data['user_access']['questions']['is_visible'] = 1;
               $data['ENQUIRY_TYPES'] = unserialize(ENQUIRY_TYPES);
               echo json_encode($data);
               // debug($data);
               // $this->render_page(strtolower(__CLASS__) . '/view_change', $data);
          } else {
               //404 redirect here
          }
     }

     public function states_get()
     {
          $id = @$_GET['state_id'];
          $data['states'] = $this->rest_model->getStates($id);
          echo json_encode($data);
     }
     //@enq edit
     //Update enq
     public function ac_insurance_transmission_get()
     {

          $data['AC'] = unserialize(AC);
          $data['INSURANCE_TYPES'] = unserialize(INSURANCE_TYPES);
          $data['TRANSMISSION'] = unserialize(Transmission);
          $data['Comprossr'] = unserialize(Comprossr);
          echo json_encode($data);
     }
     function enquiry_update_post()
     {
         // echo json_encode(array('status' => "success", 'msg' => 'Enguiry successfully updated!'));
          //exit;

          // debug($_POST,1);
$this->uid=$_POST['user_id'];
          if ($this->rest_model->updateEnqAndChangeVeh($_POST)) {
              // $this->session->set_flashdata('app_success', 'Enguiry successfully updated!');
               echo json_encode(array('status' => "success", 'msg' => 'Enguiry successfully updated!'));
          } else {
               //$this->session->set_flashdata('app_error', 'Error while update enguiry!');
               echo json_encode(array('status' => 'fail', 'msg' => 'Error while update enquiry!'));
          }
          //
     }

     function update_enq_and_change_veh()
     { //jchange latest update enq
          // debug($_POST,1);

          //     vreg_inquiry
          //vreg_status
          //vreg_is_punched reg master table update
          ////http://localhost/royalportal/rdportal/index.php/enquiry/myregister
          // debug($_POST);
          //$is_stock_veh = isset($_POST['is_stock_veh']) ? $_POST['is_stock_veh'] : 0; //Check vehicle  selected from Select box
          if ($this->enquiry->updateEnqAndChangeVeh($_POST)) {
               $this->session->set_flashdata('app_success', 'Enguiry successfully updated!');
               echo json_encode(array('status' => "success", 'msg' => 'Enguiry successfully updated!'));
          } else {
               $this->session->set_flashdata('app_error', 'Error while update enguiry!');
               echo json_encode(array('status' => 'fail', 'msg' => 'Error while update enguiry!'));
          }
     }


     //@update enq

     //all_followup
     public function all_followup_get()
     {

          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          // debug();
          $this->page_title = 'All followup';
          //$this->load->library("pagination");
          $limit = 10;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          //$config = getPaginationDesign();

          $data = $_GET;
          $followups = $this->rest_model->getFollowupEnquires('', $limit, $page);

          $data['enquires'] = $followups['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $followups['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;

          /* Table info */
          //  $data['pagination']['pageIndex'] = $page + 1;
          $data['pagination']['limit'] = $page + $limit;
          $data['pagination']['totalRow'] = number_format($followups['count']);
          $data['filter']['search'] = false;
          /* Table info */
          echo json_encode($data);
          ///$this->pagination->initialize($config);
          /// $data["links"] = $this->pagination->create_links();
          ///  $this->render_page(strtolower(__CLASS__) . '/list', $data);
     }
     //@all_followup
     //missef foll

     public function missed_followup_get()
     {
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $this->myEnqStatuses = array(1, assign_to_other_staff, inquiry_reopened);

          $this->page_title = 'Missed followup';
          ini_set('memory_limit', '-1');

          $search = isset($_GET['search']) ? $_GET['search'] : '';
          $this->load->library("pagination");
          // $limit = get_settings_by_key('pagination_limit');
          $limit = 10;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          // $config = getPaginationDesign();

          $data = $_GET;
          $missedFoll = $this->rest_model->missed($search, $limit, $page);
          $data['missedFoll'] = $missedFoll['data'];
          $data['missedCount'] = array();
          $data['missedCountYTD'] = array();
          $userAccess = getUserAcess($this->uid);

          if (check_permission($this->uid, $userAccess, 'followup', 'missedfolloupcount')) {
               $data['missedCount'] = $this->rest_model->missedCount();
               $data['missedCountYTD'] = $this->rest_model->missedCountYTD();
          }

          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["base_url"] = $link;
          $config["total_rows"] = $missedFoll['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;

          /* Table info */
          $data['pageIndex'] = $page + 1;
          $data['limit'] = $page + $limit;
          $data['totalRow'] = number_format($missedFoll['count']);
          /* Table info */

          // $this->pagination->initialize($config);
          $data["links"] = $this->pagination->create_links();
          echo json_encode($data);
          //$this->render_page(strtolower(__CLASS__) . '/missed', $data);
     }
     //end missed foll
     //foll details//
     function viewFollowup_get()
     {
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];

          //  $data['brands'] = array();
          // if (check_permission($controller, 'submitprocrmntreq')) {
          //    $data['brands'] = $this->enquiry->getBrands();
          // }
          $enqId =  $_GET['enq_id'];
          $data['enq_id'] = $enqId;
          if (!empty($enqId)) {




               $data['vehicles'] = $this->rest_model->getFollowupByEnquiry($enqId); //foll dtls 
               // debug($data['vehicles']);
               //$data['companyVehicles'] = $this->followup->getCompanyVehicles();//hmvst
               //X  $data['stockVehicles'] = $this->rest_model->getStockVehicles();//Change enquiry status if  <option value="6">Request for close</option> sts change
               //$data['enqHistory'] = $this->followup->getEnquiryHistory($enqId);//if (is_roo_user()
               //$data['preferences'] = $this->followup->getPreferences($enqId);//preferences
               // $data['staffs'] = $this->followup->getStaffs();//hmvst
               $data['request']['assignto'] = isset($_GET['assignto']) ? $_GET['assignto'] : 0;
               // if (is_roo_user()) {
               //      $this->render_page(strtolower(__CLASS__) . '/followup_admin', $data);
               // } else {
               //      $this->render_page(strtolower(__CLASS__) . '/followup', $data);
               // }
               echo json_encode($data);
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => '404'));
               //404
          }
     }
     function followup_status_get()
     { //change status in followup
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          if ($this->uid == 100) {
               $data['statuses'] = $this->common_model->getStatuses('vehicle'); //sts change
          } elseif ($this->usr_grp == 'MG') {
               $data['statuses'] = unserialize(Foll_status_for_MG);
          } else {
               $data['statuses'] = unserialize(Foll_status);
          }
          echo json_encode($data);
     }
     function stockVehicles_get()
     { //change status in followup dtls
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          //$data['evaluation'] = $this->evaluation->getOwnParkAndSaleCars(); dbt
          $data['stockVehicles'] = $this->rest_model->getStockVehicles(); //Change enquiry status if  <option value="6">Request for close</option> sts change
          echo json_encode($data);
     }
     function companyVehicles_get()
     { //home visit in followup dtls
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['companyVehicles'] = $this->rest_model->getCompanyVehicles(); //hmvst
          echo json_encode($data);
     }
     function fleetVehicles_get()
     { //change status in followup dtls
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['fleet'] = unserialize(Fleet_veh);
          echo json_encode($data);
     }
     function travelWith_get()
     { //change status in followup dtls
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          //$data['evaluation'] = $this->evaluation->getOwnParkAndSaleCars(); dbt
          $data['staffs'] = $this->rest_model->getStaffs();
          echo json_encode($data);
     }
     function preference_types_get()
     { //selectt box 
          $data['preference_types']  = unserialize(PREFERENCE_KEYS);
          echo json_encode($data);
     }
     function rto_get()
     { //
          $id = @$_GET['rto_id'];
          $data['rto'] = $this->rest_model->getRto($id);
          echo json_encode($data);
     }
     function submit_preference_post()
     {
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          //  debug($_POST,1);
          if ($this->rest_model->addPreference($_POST)) {

               echo json_encode(array('status' => 'success', 'msg' => 'Success fully added!'));
          }
     }
     function preferences_get()
     { //preference table vw in followup dtls
          $enqId =  $_GET['enq_id'];
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['preferences'] = $this->rest_model->getPreferences($enqId); //preferences
          echo json_encode($data);
     }

     function submitProcrmntReq_post()
     {
          $this->uid = $_POST['enq_se_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          //debug($_POST);
          if ($this->rest_model->addProcReq($_POST)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Submitted procurement request!'));
          }
     }
     function travelModes_get()
     { //
          $this->uid = $this->input->get('user_id');
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['travel_modes'] = $this->rest_model->getTravelModes();
          echo json_encode($data);
     }

     //home visit//
     function storeHomeVisit_post()
     {

          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          // unset($_POST['user_id']);
          // unset($_POST['usr_showroom']);
          unset($_POST['user_id'], $_POST['usr_showroom'], $_POST['grp_slug']);
          //  debug($_POST);
          //header("Access-Control-Allow-Methods: POST, OPTIONS");
          //header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
          if ($this->rest_model->addHomeVisit($_POST)) {
               generate_log(array(
                    'log_title' => 'Home visit Req pre insert',
                    'log_desc' => 'Home visit Req from follow up form pre insert',
                    'log_controller' => 'submit-hom-vist-pre-insert',
                    'log_action' => 'C',
                    'log_ref_id' => 0,
                    'log_added_by' => $this->uid
               ));

               echo json_encode(array('status' => 'success', 'msg' => 'successfully Submitted!'));
          }
     }
     function changeStatus_post()
     {
          //debug($_POST);
          //$this->uid = $_POST['enq_se_id']; 
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->grp_id = $_POST['grp_id'];
          $this->usr_username = $_POST['usr_username'];
          unset($_POST['grp_slug'], $_POST['usr_showroom'], $_POST['user_id'], $_POST['usr_username'], $_POST['grp_id']);
          $cb = isset($_POST['cb']) ? $_POST['cb'] : '';
          unset($_POST['cb']);
          if (isset($_POST['quickfollowup'])) {
               $msg = isset($_POST['enh_remarks']) ? $_POST['enh_remarks'] : '';
               $this->rest_model->removeRow($_POST['quickfollowup'], $msg);
               unset($_POST['quickfollowup']);
          }
          if ($this->rest_model->changeStatus($_POST)) {
               // $this->session->set_flashdata('app_success', 'Status changed successfully!');
               $resp_msg = 'Status changed successfully!';
               $resp_status = true;
               $msg = isset($_POST['enh_remarks']) ? $_POST['enh_remarks'] : '';
               $enqId = isset($_POST['enh_enq_id']) ? $_POST['enh_enq_id'] : '';

               $status = $this->common_model->getStatusById($_POST['enh_status']);
               $stsmsg = isset($status['sts_des']) ? $status['sts_des'] : '';

               if ($enqId > 0) {
                    $this->rest_model->updateComments(array(
                         'foll_is_cmnt' => 1, 'foll_remarks' => $msg . ' ' . $stsmsg,
                         'foll_cus_id' => $enqId, 'foll_parent' => 0
                    ));
               }
          } else {
               $resp_msg = 'Error occured!';
               $resp_status = false;
               //$this->session->set_flashdata('app_error', 'Error occured!');
          }
          $enqId = isset($_POST['enh_enq_id']) ? $_POST['enh_enq_id'] : 0;
          echo json_encode(array('status' => $resp_status, 'msg' => $resp_msg));
          // $cb = !empty($cb) ? site_url(str_replace('-', '/', $cb)) : strtolower(__CLASS__) . '/viewFollowup/' . encryptor($enqId);
          // redirect($cb);
     }
     //popup get//
     function getSingleFollowup_get()
     {
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $custId = $_GET['enq_id'];
          $date = $_GET['date'];
          //  $custId = encryptor($custId, 'D');
          $data['followup'] = $this->rest_model->getFollowup($custId, $date);
          // print_r($data['followup']);
          //exit;
          $data['enqId'] = $custId;
          $data['date'] = $date;
          $data['enquiry'] = $this->rest_model->enquires($custId);
          $data['follimit'] = isset($data['enquiry']['enq_next_foll_date']) ?
               date('Y/m/d', strtotime($data['enquiry']['enq_next_foll_date'])) : date('Y/m/d');
          $data['latest'] = $this->rest_model->getLastRegisterRelatedToEnquiry($custId);
          //$data['salesExe'] = $this->emp_details->salesExecutives();
          //   $data['salesExe'] = $this->registration->salesPurchaseExecutivesMyShowroom();
          $data['salesExe'] = $this->rest_model->salesPurchaseExecutivesAllShowroom();
          $data['division'] = $this->rest_model->getActiveData();
          $data['assignto'] = isset($_GET['assignto']) ? $_GET['assignto'] : 0;
          $data['p'] = isset($_GET['p']) ? $_GET['p'] : 0;
          $data['quickfollowup'] = isset($_GET['quickfollowup']) ? $_GET['quickfollowup'] : '';
          $data['cb'] = isset($_GET['cb']) ? $_GET['cb'] : '';
          $data['show_test_drive_inp'] = 1; //show check box
          // $html = $this->load->view(strtolower(__CLASS__) . '/view', $data, true);
          echo json_encode(array('data' => $data));
     }
     //End popup//

     function editFollowUp_post()
     {
          // debug($_POST);
          // if (isset($_POST['salesOfficers']) && !empty($_POST['salesOfficers'])) {
          //      debu($_POST['txtSalesOfficer']);
          //      $reassignDatas['old_se_id'] = isset($_POST['txtSalesOfficer']) ? $_POST['txtSalesOfficer'] : '';
          //      // $reassignDatas['new_se_id'] = isset($_POST['salesOfficers']) ? $_POST['salesOfficers'] : '';
          //      // $reassignDatas['enq_id'] = $enqId;
          //      // $reassignDatas['remark'] = isset($_POST['remark']) ? $_POST['remark'] : '';
          //      // $this->rest_model->reassignenquiry($reassignDatas);
          //      //$this->followup->assignTo($_POST['salesOfficers'], $enqId); Commentd on 20-05-2021 : 11:41 AM due to shoukath enq assigned to aswathi cold call
          // }

          //debug($_POST);
          // $callback = (isset($_POST['cb'])) ? 'und' : 'illa';
          if (isset($_POST['cb']) && $_POST['cb'] == '') {
               unset($_POST['cb']);
          }

          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->grp_id = $_POST['grp_id'];
          $this->usr_username = $_POST['usr_username'];
          /**/
          $enqId = isset($_POST['foll_cus_id']) ? $_POST['foll_cus_id'] : 0;
          if (isset($_POST['quickfollowup'])) {
               $msg = isset($_POST['followup']['foll_remarks']) ? $_POST['followup']['foll_remarks'] : '';
               $this->rest_model->removeRow($_POST['quickfollowup'], $msg);
          }

          $_POST['followup']['foll_budget_from'] = !empty($_POST['followup']['foll_budget_from']) ? $_POST['followup']['foll_budget_from'] : 0;
          $_POST['followup']['foll_budget_to'] = !empty($_POST['followup']['foll_budget_to']) ? $_POST['followup']['foll_budget_to'] : 0;

          $_POST['followup']['foll_model_y_from'] = !empty($_POST['followup']['foll_model_y_from']) ? $_POST['followup']['foll_model_y_from'] : 0;
          $_POST['followup']['foll_model_y_to'] = !empty($_POST['followup']['foll_model_y_to']) ? $_POST['followup']['foll_model_y_to'] : 0;

          $_POST['followup']['foll_km_from'] = !empty($_POST['followup']['foll_km_from']) ? $_POST['followup']['foll_km_from'] : 0;
          $_POST['followup']['foll_km_to'] = !empty($_POST['followup']['foll_km_to']) ? $_POST['followup']['foll_km_to'] : 0;
          /**/
          $callback = (isset($_POST['cb'])) ? site_url(str_replace('-' . '/' . $_POST['cb'])) : '';
          $message = '';
          if (!isset($_POST['followup']['foll_status']) || empty($_POST['followup']['foll_status'])) {
               $message = 'Please select any status';
          }
          if (!isset($_POST['followup']['foll_contact']) || empty($_POST['followup']['foll_contact'])) {
               $message .= ' Please select any mode of contact';
          }
          if (!isset($_POST['followup']['foll_action_plan']) || empty($_POST['followup']['foll_action_plan'])) {
               $message .= ' Please enter action plan';
          }
          if (!isset($_POST['followup']['foll_next_foll_date']) || empty($_POST['followup']['foll_next_foll_date'])) {
               $message .= ' Please enter next folloup date';
          }
          if (!isset($_POST['followup']['foll_remarks']) || empty($_POST['followup']['foll_remarks'])) {
               $message .= ' Please enter remark';
          }
          if (empty($message)) {
               $enqId = isset($_POST['foll_cus_id']) ? $_POST['foll_cus_id'] : 0;
               $userAccess = getUserAcess($this->uid);

               //Auto assign to SE from TC
               if (check_permission($this->uid, $userAccess, 'followup', 'assignenquiresfromfollowup') || check_permission($this->uid, $userAccess, 'followup', 'asgnenqtoslsstffthemself')) {
                    /* if (isset($_POST['vreg_showroom']) && !empty($_POST['vreg_showroom'])) {
                             $assignTo = $this->registration->getAutoAssignExecutive($_POST['vreg_showroom']);
                             $this->followup->assignTo($assignTo, $enqId);
                             } else if ($_POST['followup']['foll_status'] == 4 || $_POST['followup']['foll_status'] == 1) { //Hot+ OR Hot
                             $assignTo = $this->registration->getAutoAssignExecutive($this->shrm);
                             $this->followup->assignTo($assignTo, $enqId);
                             } */
                    if (isset($_POST['salesOfficers']) && !empty($_POST['salesOfficers'])) {
                         $reassignDatas['old_se_id'] = isset($_POST['txtSalesOfficer']) ? $_POST['txtSalesOfficer'] : '';
                         $reassignDatas['new_se_id'] = isset($_POST['salesOfficers']) ? $_POST['salesOfficers'] : '';
                         $reassignDatas['enq_id'] = $enqId;
                         $reassignDatas['remark'] = isset($_POST['remark']) ? $_POST['remark'] : '';
                         $reassignDatas['usr_username'] = $_POST['usr_username'];
                         $this->rest_model->reassignenquiry($reassignDatas);
                         //$this->followup->assignTo($_POST['salesOfficers'], $enqId); Commentd on 20-05-2021 : 11:41 AM due to shoukath enq assigned to aswathi cold call
                    }
               }
               //Auto assign to SE from TC

               if ($this->rest_model->editFollowUp($_POST)) {
                    // $this->session->set_flashdata('app_success', 'Customer feedback successfully added!');
                    echo json_encode(array('status' => 'success', 'msg' => 'Customer feedback successfully added!', 'cb' => $callback));
               } else {
                    // $this->session->set_flashdata('app_error', 'Error occured!');
                    echo json_encode(array('status' => 'fail', 'msg' => 'Error occured!', 'cb' => $callback));
               }
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => $message, 'cb' => $callback));
          }
     }
     function mod_of_contacts_followup_get()
     { //
          // $this->uid = $this->input->get('user_id');
          // $this->shrm = $_GET['usr_showroom'];
          // $this->usr_grp = $_GET['grp_slug'];
          //$data['modOfContact'] = unserialize(MODE_OF_CONTACT_FOLLOW_UP);
          $data['modOfContact'] = unserialize(MODE_OF_CONTACT_FOLLOW_UP_API);
          echo json_encode(array('data' => $data));
     }
     function staffCanAssignEnquires_get()
     {
          //$data['staffs'] = $this->enquiry->staffCanAssignEnquires();
          $data['staffs'] = $this->rest_model->staffCanAssignEnquires();
          echo json_encode(array('data' => $data));
     }

     function reassignenquiry_post()
     {
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->grp_id = $_POST['grp_id'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->rest_model->reassignenquiry($_POST);
          echo json_encode(array('status' => 'true', 'msg' => 'successfully updated!'));
     }

     //@foll dtls
     //jj//
     function quickUpdateFollowup_post()
     { //debug($_POST);
          if (isset($_POST['cb']) && $_POST['cb'] == '') {
               unset($_POST['cb']);
          }

          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->grp_id = $_POST['grp_id'];
          $this->usr_username = $_POST['usr_username'];
          // debug($_POST);
          if ($this->rest_model->quickUpdateFollowup($_POST)) {
               die(json_encode(array('status' => 'success', 'msg' => 'Followup updated successfully!')));
          } else {
               die(json_encode(array('status' => 'fail', 'msg' => 'Error occured on followup updated!')));
          }
     }
     //en jj//
     //jj//
     function changeTestDriveHomeVisit_post()
     {  //reserve
          $this->uid = $_POST['user_id'];

          $this->usr_grp = $_POST['grp_slug'];
          $this->grp_id = $_POST['grp_id'];

          $type = $_POST['type'];
          $enqId = $_POST['enq_id'];
          // debug($_POST);exit;
          $msg = 'Inquiry home visit updated!';
          if ($type == 'enq_cus_test_drive') {
               $msg = 'Inquiry test trive updated!';
          }
          if ($this->rest_model->changeTestDriveHomeVisit($enqId, $type, $_POST)) {
               die(json_encode(array('status' => 'success', 'msg' => $msg)));
          } else {
               die(json_encode(array('status' => 'fail', 'msg' => 'Error occured on update field!')));
          }
     }
     //@endjj//
     //reserve//
     function reserveVehicleView_get()
     { //reserve first popup
          $enqId = $_GET['enq_id'];
          $search = array();
          $search['search'] = @$_GET['search'];
          //$search['search'] =  isset($_GET['search']) ? $_GET['search'] : '';
          $limit = 10;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];

          //$link = $linkParts[0];
          //$config = getPaginationDesign();
          $stockVehs = $this->rest_model->getStockVehiclesReserve($limit, $page, $search);
          $data['stockVehicles'] = $stockVehs['data'];
          //    $data['pagination']['page']= $page;
          // $data['pagination']['linkParts']=  $linkParts;
          // $data['pagination']['link']= $link;
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($stockVehs['count']);
          //  debug($data['stockVehicles']);
          $data['enqId'] = $enqId;
          // $html = $this->load->view(strtolower(__CLASS__) . '/ajx_reservationform_1', $data, true);
          die(json_encode(array('data' => $data)));
     }
     function bindVehicleDetails_get()
     {
          $this->uid = $_GET['user_id'];

          $this->usr_grp = $_GET['grp_slug'];
          $this->grp_id = $_GET['grp_id'];
          $this->shrm = $_GET['usr_showroom'];
          $vehId = $_GET['vehId'];
          $enqId = $_GET['enq_id'];
          $data['enquiry'] = $this->rest_model->enquires($enqId);
          // debug($data['enquiry']);
          $data['vehicles'] = $this->rest_model->getEvaluationPrint($vehId);
          //  debug($data['vehicles'] );
          $data['addressProof'] = $this->rest_model->getActiveAddressProof(1);
          //debug($data['addressProof'] );
          $data['banks'] = $this->rest_model->getAllBanks();
          die(json_encode(array('data' => $data)));
          // $html = $this->load->view(strtolower(__CLASS__) . '/ajx_reservationform_2', $data, true);
          // die(json_encode(array('status' => 'success', 'msg' => 'Enquiry assigned to executive!', 'html' => $html)));
     }
     //End reserve //
     function eval_pending_list_get()
     { //List evaluation pending vehicles //pending()
          $status = !isset($_GET['status']) ? 0 : $_GET['status']; //pending list =0
          $limit = 10;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          ini_set('memory_limit', '-1');
          // $resp= $this->rest_model->getEvaluation('', 0, $limit, $page,);
          //$response = $this->rest_model->evaluation_ajax($limit, $page, $status, '');//prv
          $response = $this->rest_model->evaluation_ajax($limit, $page, $status, $_GET);
          $data['vehicles'] = $response['data'];
          //debug($data['vehicles']);
          $data['pagination']['limit'] = $limit;
          //$data['pagination']['jtot'] = number_format(count($response['data']));
          $data['pagination']['totalRow'] =  number_format($response['count']);
          $data['filters']['enable_all_types'] = 1;
          $data['filters']['enable_filters'] = 1;
          $data['status'] = $status;

          echo json_encode(array('data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/list_pending_vehicles', $data);
     }

     function evaluation_ajax_post()
     {
          //debug($_GET);
          $status = !isset($_GET['status']) ? 0 : $_GET['status']; //pending list =0
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $linkParts = explode('&page=', current_url() . '?' . $_SERVER['QUERY_STRING']);
          $link = $linkParts[0];
          ini_set('memory_limit', '-1');
          // $resp= $this->rest_model->getEvaluation('', 0, $limit, $page,);
          $response = $this->rest_model->evaluation_ajax($limit, $page, $status, $this->input->post());
          $data['vehicles'] = $response['data'];
          //debug($data['vehicles']);
          $data['pagination']['limit'] = $limit;
          //$data['pagination']['totalRow'] = number_format($reg_data['count']);
          $data['pagination']['totalRow'] =  number_format($response['count']);
          $data['filters']['enable_all_types'] = 1;
          $data['filters']['enable_filters'] = 1;
          $data['status'] = $status;


          echo json_encode(array('data' => $data));
          //echo json_encode($response);
     }
     //
     function getAllEvaluators_get()
     {
          $data['evaluators'] = $this->rest_model->getAllEvaluators();
          echo json_encode(array('data' => $data));
     }
     function getEnquiryHandingMembers_get()
     {
          $data['salesExe'] = $this->rest_model->getEnquiryHandingMembers();
          echo json_encode(array('data' => $data));
     }
     function cmb_types_get()
     {
          $data['types'] = unserialize(EVL_TYPES);
          echo json_encode(array('data' => $data));
     }
     function purchase_types_get()
     {
          $data['purchase_types'] = unserialize(purchase_types);
          echo json_encode(array('data' => $data));
     }
     function evl_status_get()
     {
          $data['status'] = unserialize(EVL_STATUS);
          echo json_encode(array('data' => $data));
     }


     //
     //evaluation upd//
     //edit evl 
     function edit_evaluation_get()
     { //view
          //  $this->load->model('registration/registration_model', 'registration');
          $id = $_GET['val_id'];
          // if (!is_numeric($id)) {
          //      $id = encryptor($id, 'D');
          // }
          //debug($id);
          $data['division'] = $this->rest_model->getActiveData();

          $data['vehicles'] = $this->rest_model->getEvaluation($id);
          // $data['vehicles']['val_division']=1;
          //$data['vehicles']['val_sales_officer']=11;

          $data['brand'] = $this->rest_model->getBrands();
          // debug($data['vehicles']['val_brand']);
          // debug($data);
          $data['model'] = $this->rest_model->getModelByBrand($data['vehicles']['val_brand']);
          $data['variant'] = $this->rest_model->getVariantByModel($data['vehicles']['val_model']);
          $data['banks'] = $this->rest_model->getAllBanks();
          $data['insurers'] = $this->rest_model->getInsurers();
          $data['managers'] = $this->rest_model->getAllManagers();
          $data['APMASM'] = $this->rest_model->getAllAPMASM();
          $data['evaluators'] = $this->rest_model->getAllEvaluators();
          $data['salesExe'] = $this->rest_model->getEnquiryHandingMembers();
          $data['vehicleFeatures'] = $this->rest_model->getAllVehicleFeatures();
          $data['vehicleAddOnFeatures'] = $this->rest_model->getVehicleAddOnFeatures();
          $data['fullBodyCheckupMaster'] = $this->rest_model->getFullBodyCheckupMaster();
          $data['showroom'] = $this->rest_model->getShowRoomByDivision($data['vehicles']['val_division']);
          //$data['purchaseAdmin'] = $this->rest_model->getStaffByGroup('usr_is_purchase_admin');

          $data['purchaseAdmin'] = $this->rest_model->getStaffByGroup();

          $data['mis'] = $this->rest_model->getMISEvaluation();

          $data['delco'] = $this->rest_model->getDelco();

          $data['teleclrs'] = $this->rest_model->getTelecaller();

          $data['telslsco'] = $this->rest_model->getTelesalesCoordinator();
          // debug($data);
          $data['telprsco'] = $this->rest_model->getTelePurchaseCoordinator();
          //$data['admin'] = $this->rest_model->getStaffByGroup('usr_is_sales_admin');
          $data['admin'] = $this->rest_model->getStaffByGroup();
          echo json_encode(array('data' => $data));
          // $this->render_page(strtolower(__CLASS__) . '/view', $data);
     }
     //End edit evl
     function updateEvaluation_POST()
     {
          // debug($_POST);

          $this->rest_model->storeRestResponse($_POST);

          //exit;
          //debug($this->db->database);
          $this->uid = $_POST['user_id'];
          $this->usr_grp = $_POST['grp_slug'];
          // debug($_FILES['documents']);
          // if ((isset($_FILES['documents']['name']) && !empty($_FILES['documents']['name']) &&
          // is_array($_FILES['documents']['name'])) && (isset($_FILES['documents']['name'][0]) && !empty($_FILES['documents']['name'][0]))) {
          //   debug($_FILES['documents']);
          // }else{
          //   debug('no');
          // }
          #echo json_encode(array('status' => "success", 'msg' => 'Successfully updated!'));
          # exit;

          //debug($_POST,1); exit;
          //           foreach($_POST['valuation'] as $k=>$vals ){
          // echo $val='valuation['.$k.']:'.$vals.' <br>';

          //           }
          // foreach($_POST['features'] as $k=>$vals ){
          //      echo $val='features['.$k.']:'.$vals.' <br>';

          //                }
          //                foreach($_POST['fulbdchk'] as $k=>$vals ){
          //                     echo $val='fulbdchk['.$k.']:'.$vals.' <br>';

          //                               }

          // foreach($_POST['upgradedetails']['upgrd_key'] as $k=>$vals ){
          //      echo $val='upgradedetails[upgrd_key][]:'.$vals.' <br>';

          //                }
          //                foreach($_POST['upgradedetails']['upgrd_value'] as $k=>$vals ){
          //                     echo $val='upgradedetails[upgrd_value][]:'.$vals.' <br>';

          //                               }
          // foreach ($_POST['eveimg'] as $k => $vals) {
          //      echo $val = 'eveimg[' . $k . ']:' . $vals . ' <br>';
          // }

          // exit;

          //debug($_POST['upgradedetails'],1);

          if ($_POST['valuation']['val_cust_source'] == 34) {
               if ($_POST['valuation']['val_refferal_type'] == 4) { //Rd staff
                    // unset($_POST['referal_name1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['valuation']['val_refferer_name'] = $_POST['referal_name1'];
                    unset($_POST['referal_name1']);
                    $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone1']; //val_referal_phone
                    unset($_POST['referal_phone1']);
                    //$_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                    //unset($_POST['valuation']['val_refferal_type']);
                    // unset($_POST['referal_enq_cus_id']);
               } elseif ($_POST['valuation']['val_refferal_type'] == 5) { //RD Customer
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_name3']);
                    unset($_POST['referal_phone3']);
                    $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone2'];
                    unset($_POST['referal_phone2']);
                    $_POST['valuation']['val_refferer_name'] = $_POST['referal_name2'];
                    unset($_POST['referal_name2']);
                    // $_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                    // unset($_POST['valuation']['val_refferal_type']);
                    //   $_POST['vreg_referal_enq_id'] = $_POST['referal_enq_cus_id'];
                    // unset($_POST['referal_enq_cus_id']);
               } else {
                    unset($_POST['referal_name1']);
                    unset($_POST['referal_phone1']);
                    unset($_POST['referal_phone2']);
                    unset($_POST['referal_name2']);
                    $_POST['valuation']['val_refferal_phone'] = $_POST['referal_phone3'];
                    unset($_POST['referal_phone3']);
                    $_POST['valuation']['val_refferer_name'] = $_POST['referal_name3'];
                    unset($_POST['referal_name3']);
                    //$_POST['valuation']['val_refferal_type'] = $_POST['valuation']['val_refferal_type'];
                    //unset($_POST['valuation']['val_refferal_type']);
                    // unset($_POST['referal_enq_cus_id']);
               }
          }
          // debug($_POST['val_refferal_phone'],1);
          // debug($_POST['valuation']['val_refferal_type'],1);
          $this->load->library('upload');
          $id = 0;
          if (isset($_POST['val_id'])) {
               $id = $_POST['val_id'];
          }
          generate_log(array(
               'log_title' => 'Evaluation pre update',
               'log_desc' => serialize($_POST),
               'log_controller' => 'evaluation-pre-update',
               'log_action' => 'U',
               'log_ref_id' => $id,
               'log_added_by' => $this->uid
          ));
          $uploadError = '';
          if ($id > 0) {
               if (isset($_POST['upgradedetails']) && !empty($_POST['upgradedetails'])) {
                    $_POST['valuation']['val_refurb_status'] = 66;
                    //debug($_POST['val_refurb_status'],1);
               }
               // debug($_POST['valuation'],1);
               //if (!$this->evaluation->checkVehicleExists($_POST)) {
               if ($this->rest_model->updateEvaluation($id, $_POST['valuation'])) {
                    //debug(11231); exit;
                    //    echo 'updateEvaluation <br>';
                    if (isset($_POST['complaint_title']) && !empty($_POST['complaint_title'])) {
                         foreach ($_POST['complaint_title'] as $key => $value) {
                              $complaint['comp_pic'] = '';
                              if (isset($_FILES['complaint_file']['name'][$key]) && !empty($_FILES['complaint_file']['name'][$key])) {
                                   $this->load->library('upload');
                                   $newFileName = rand() . $_FILES['complaint_file']['name'][$key];
                                   //  $config['upload_path'] = '../assets/uploads/evaluation/';
                                   // $config['upload_path'] = './assets/uploads/evaluation/';
                                   $config['upload_path'] = 'assets/uploads/evaluation/vehicle/';
                                   $config['allowed_types'] = 'jpg|jpeg|png';
                                   $config['file_name'] = $newFileName;
                                   $this->upload->initialize($config);

                                   $_FILES['prd_image_tmp']['name'] = $_FILES['complaint_file']['name'][$key];
                                   $_FILES['prd_image_tmp']['type'] = $_FILES['complaint_file']['type'][$key];
                                   $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['complaint_file']['tmp_name'][$key];
                                   $_FILES['prd_image_tmp']['error'] = $_FILES['complaint_file']['error'][$key];
                                   $_FILES['prd_image_tmp']['size'] = $_FILES['complaint_file']['size'][$key];

                                   if ($this->upload->do_upload('prd_image_tmp')) {
                                        $uploadData = $this->upload->data();
                                        $complaint['comp_pic'] = $uploadData['file_name'];
                                   } else {
                                        $uploadError = $this->upload->display_errors();
                                   }
                              }
                              if (!empty($complaint['comp_pic']) || !empty($value)) {
                                   $complaint['comp_val_id'] = $id;
                                   $complaint['comp_complaint'] = $value;
                                   $this->rest_model->newEvaluationComplaints($complaint);
                              }
                              // echo 'complaint_title <br>';
                         }
                         $app_success = "Row successfully updated!";

                         //  $this->session->set_flashdata('app_success', 'Row successfully updated!');
                    }

                    //Upload documents
                    if ((isset($_FILES['documents']['name']) && !empty($_FILES['documents']['name']) &&
                         is_array($_FILES['documents']['name'])) && (isset($_FILES['documents']['name'][0]) && !empty($_FILES['documents']['name'][0]))) {
                         // debug($_FILES['documents']);
                         //exit;

                         foreach ($_FILES['documents']['name'] as $key => $value) {

                              $newFileName = rand() . $_FILES['documents']['name'][$key];
                              //  $config['upload_path'] = '../assets/uploads/evaluation/';
                              // $config['upload_path'] = '../assets/uploads/evaluation/';
                              $config['upload_path'] = 'assets/uploads/evaluation/';
                              $config['allowed_types'] = 'jpg|jpeg|png|pdf|dox|docx';
                              $config['file_name'] = $newFileName;
                              $this->upload->initialize($config);

                              $_FILES['tmp_doc']['name'] = $_FILES['documents']['name'][$key];
                              $_FILES['tmp_doc']['type'] = $_FILES['documents']['type'][$key];
                              $_FILES['tmp_doc']['tmp_name'] = $_FILES['documents']['tmp_name'][$key];
                              $_FILES['tmp_doc']['error'] = $_FILES['documents']['error'][$key];
                              $_FILES['tmp_doc']['size'] = $_FILES['documents']['size'][$key];

                              if ($this->upload->do_upload('tmp_doc')) {
                                   $uploadData = $this->upload->data();
                                   $complaint['comp_pic'] = $uploadData['file_name'];

                                   if (isset($uploadData['file_name']) && !empty($uploadData['file_name'])) {
                                        $docs['vdoc_val_id'] = $id;
                                        $docs['vdoc_doc'] = $uploadData['file_name'];
                                        $docs['vdoc_doc_title'] = isset($_POST['document_title'][$key]) ? $_POST['document_title'][$key] : '';
                                        $docs['vdoc_doc_type'] = isset($_POST['document_type'][$key]) ? $_POST['document_type'][$key] : '';
                                        $this->rest_model->newEvaluationDocument($docs);
                                   }

                                   //echo 'do_upload <br>';
                              } else {
                                   $f = $this->upload->display_errors();
                                   debug($f);
                              }
                         }
                    }
                    // debug(777);
                    //features
                    if (isset($_POST['features']) && !empty($_POST['features'])) {
                         $this->rest_model->removeFeaturesByMaster($id);
                         // debug(271);
                         foreach ($_POST['features'] as $key => $value) {
                              $this->rest_model->newFeatures(array('vfet_valuation' => $id, 'vfet_feature' => $value));
                         }
                         // echo 'newFeatures <br>';
                    }

                    //Full body check up
                    if (isset($_POST['fulbdchk']) && !empty($_POST['fulbdchk'])) {
                         $this->rest_model->removeBodyCheckupByMaster($id);
                         foreach ($_POST['fulbdchk'] as $key => $value) {
                              $this->rest_model->fullBodyCheckup(
                                   array(
                                        'vfbc_valuation_master' => $id,
                                        'vfbc_chkup_master' => $key, 'vfbc_chkup_details' => $value
                                   )
                              );
                         }
                         //  echo 'Body chkp <br>';
                    }
                    //Upgradation details
                    if (isset($_POST['upgradedetails']) && !empty($_POST['upgradedetails'])) {
                         $this->rest_model->removeUpgradeDetailsByMaster($id);
                         $this->rest_model->upgradeDetails($_POST['upgradedetails'], $id);
                         //  echo 'upgrd dtls-- <br>';
                    }

                    //Upload images
                    if (isset($_POST['eveimg']) && !empty($_POST['eveimg'])) {
                         foreach ($_POST['eveimg'] as $key => $value) {
                              if (!empty($value)) {
                                   $frame = explode('_', $value);
                                   $frame = isset($frame['0']) ? $frame['0'] : 0;
                                   $this->rest_model->uploadEvaluationVehicleImages(array('vvi_val_id' => $id, 'vvi_frame_id' => $frame, 'vvi_image' => $value));
                                   //  echo 'uploadEvaluationVehicleImages <br>';
                              }
                         }
                    }
                    //Upload documents
                    die(json_encode(array('status' => true, 'msg' => 'Successfully Updated')));
               } else {
                    die(json_encode(array('status' => false, 'msg' => 'Error occured')));
                    // $this->session->set_flashdata('app_success', 'Error occured');
               }
               //} else {
               //     die(json_encode(array('status' => 'fail', 'msg' => 'Vehicle already exists')));
               //}
               if (!empty($uploadError)) {
                    die(json_encode(array('status' => false, 'msg' => 'Upload Error')));
                    // $this->session->set_flashdata('app_success', $uploadError);
               }
          }
          die(json_encode(array('status' => 'success', 'msg' => 'jsk')));
          // redirect(__CLASS__);
     }


     function fullBodyCheckupDetailByMaster_get()
     {
          $masterId = $_GET['vfbcm_id'];
          $data['CheckupDetails'] = $this->rest_model->getFullBodyCheckupDetailByMaster($masterId);
          echo json_encode(array('data' => $data));
     }
     function val_doc_types_get()
     {
          $data['VAL_DOCUMENT_TYPE'] = unserialize(VAL_DOCUMENT_TYPE);
          echo json_encode(array('data' => $data));
     }
     function updateDocumentType_post()
     {
          $valDocId = $_POST['vdoc_id'];
          $valType = isset($_POST['value']) ? $_POST['value'] : 0;
          if ($this->rest_model->updateDocumentType($valDocId, $valType)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Evaluation document type successfully updated'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't change the evaluation document type"));
          }
     }
     function deleteDocument_post()
     {
          $id = $_POST['vdoc_id'];
          if ($this->rest_model->deleteDocument($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Document successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete document"));
          }
     }

     //@evaluation upd//
     function uploadFile_POST()
     {
          //$config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
          //echo $config['upload_path'];
          $frame = isset($_GET['frame']) ? $_GET['frame'] : '';
          // debug($_GET);
          // debug($_FILES);
          $this->load->library('upload');
          if (!empty($_FILES) && (isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))) {
               $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
               $fileName = $frame . '_' . rand() . '.' . $ext;
               $config['file_name'] = $fileName;
               
              //vest $config['upload_path'] = 'assets/uploads/evaluation/vehicle/';
           $config['upload_path'] = BASEPATH . '../../rdms/assets/uploads/evaluation/vehicle/';
            
               $config['allowed_types'] = 'jpg|jpeg|png|pdf|dox|docx';
               $this->upload->initialize($config);
               if ($this->upload->do_upload('file')) {
                    //$uploadData = $this->upload->data();
                    echo json_encode(array(
                         'frame' => 'frame_' . $frame, 'status' => 'success',
                         'file_name' => $fileName, 'msg' => 'Successfully image upload'
                    ));
               } else {
                    echo json_encode(array(
                         'frame' => 'frame_' . $frame, 'status' => 'fail',
                         'file_name' => '', 'msg' => 'Upload error occured'
                    ));
                    //debug($this->upload->display_errors());
               }
          }
     }
     //dlt veh img val//
     function deleteValuationVehicleImage_get()
     {
          $id = $_GET['vvi_id'];
          if ($this->rest_model->deleteValuationVehicleImage($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Evaluation vehicle image successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete the image"));
          }
     }
     //end dlt//
     function newvehiclefature_POST()
     {
          //debug($this->input->post());
          $this->uid = $this->input->post('user_id');
          unset($_POST['user_id']);
          unset($_POST['grp_slug']);
          $return = $this->rest_model->newvehiclefature($this->input->post());
          echo json_encode($return);
     }
     //submit reserve//
     function reserveVehicle_POST()
     {
          //+  debug($_POST);
          $this->uid = $this->input->post('user_id');
          $this->shrm = $_POST['usr_showroom'];
          $reserveMasterId = $this->rest_model->reserveVehicle($_POST);
          $this->load->library('upload');
          $docNos = isset($_POST['ap']['vbd_doc_type']) ? count($_POST['ap']['vbd_doc_type']) : 0;
          $newFileName = '';
          if ($docNos > 0) {
               for ($i = 0; $i < $docNos; $i++) {
                    if (isset($_FILES['vbd_doc_file']['name'][$i]) && !empty($_FILES['vbd_doc_file']['name'][$i])) {
                         $newFileName = rand() . time();
                         $config['upload_path'] = 'assets/uploads/documents/booking/';
                         $config['allowed_types'] = '*';
                         $config['file_name'] = $newFileName;
                         $this->upload->initialize($config);
                         $_FILES['prd_image_tmp']['name'] = $_FILES['vbd_doc_file']['name'][$i];
                         $_FILES['prd_image_tmp']['type'] = $_FILES['vbd_doc_file']['type'][$i];
                         $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['vbd_doc_file']['tmp_name'][$i];
                         $_FILES['prd_image_tmp']['error'] = $_FILES['vbd_doc_file']['error'][$i];
                         $_FILES['prd_image_tmp']['size'] = $_FILES['vbd_doc_file']['size'][$i];

                         if ($this->upload->do_upload('prd_image_tmp')) {
                              $uploadData = $this->upload->data();
                         } else {
                              $uploadData = $this->upload->display_errors();
                              //debug($uploadData);
                         }
                    }
                    $this->rest_model->uploadDocuments(
                         array(
                              'vbd_doc_file' => $newFileName,
                              'vbd_master_id' => $reserveMasterId,
                              'vbd_doc_type' => isset($_POST['ap']['vbd_doc_type'][$i]) ? $_POST['ap']['vbd_doc_type'][$i] : 0,
                              'vbd_doc_number' => isset($_POST['ap']['vbd_doc_number'][$i]) ? $_POST['ap']['vbd_doc_number'][$i] : 0
                         )
                    );
               }
          }
          die(json_encode(array('status' => true, 'vbd_master_id' => $reserveMasterId, 'msg' => 'New booking successfully added!')));
     }

     //end submt reserve
     //PAYMENT_MOD
     function getPaymentMod_get()
     {
          $data['PAYMENT_MOD'] = unserialize(PAYMENT_MOD);
          echo json_encode(array('data' => $data));
     }
     //@PAYMENT_MOD
     function doneBy_get()
     {
          $data['done_by'] = unserialize(DONE_BY);
          echo json_encode(array('data' => $data));
     }
     function get_settings_by_key_get()
     {

          $key = $_GET['key'];
          if ($key) {

               $settings = $this->common_model->getSettings($key);
               //  debug($settings);
               $data = isset($settings['set_value']) ? $settings['set_value'] : '';
               echo json_encode(array('data' => $data));
          } else {
               return false;
          }
     }

     function getRestResponse_get()
     {
          $data = $this->rest_model->getRestResponse();
          $data['js'] =  json_decode($data['rstr_value']);

          debug($data);
          echo json_encode(array('data' => $data));
     }
     //rfrb//
     function getRefurbDetails_get()
     {

          $valid = $_GET['val_id'];
          //$data['vehicles'] = $this->rest_model->getEvaluationPrint($valid);
          $data['refurbDetails'] = $this->rest_model->getRefurbDetails($valid);
          $prchsChkData = $this->rest_model->getPrchsChkMstr($valid);
          // debug($prchsChkData);
          $data['stk_added_date'] =  $prchsChkData['pcl_created_at'] ? date('d-m-Y', strtotime($prchsChkData['pcl_created_at'])) : '';
          echo json_encode(array('data' => $data));
     }
     function getEvaluationPrint_get()
     {

          $valid = $_GET['val_id'];
          $data['vehicles'] = $this->rest_model->getEvaluationPrint($valid);

          $prchsChkData = $this->rest_model->getPrchsChkMstr($valid);

          $data['stk_added_date'] =  $prchsChkData['pcl_created_at'] ? date('d-m-Y', strtotime($prchsChkData['pcl_created_at'])) : '';
          echo json_encode(array('data' => $data));
     }
     function refurbisheReturn_post()
     {
          if (!empty($_POST)) {
               $this->uid = $_POST['user_id'];
               $this->rest_model->refurbisheReturn($_POST);
               echo json_encode(array('status' => 'true', 'msg' => 'Row updated Successfully'));
          } else {
               echo json_encode(array('status' => 'false', 'msg' => 'Error occured'));
          }
     }
     function getRefurbStatus_get()
     {
          $data['refurb_status'] = $this->rest_model->getRefurbStatus();
          echo json_encode($data);
     }
     function update_refurb_status_post()
     { //popup
          //debug($_POST);
          if ($this->rest_model->updateRefstatus($_POST)) {
               $message = 'successfully Added!';
               echo json_encode($message);
               //return json_encode(array('status' => 'success'));    
          }
     }



     ///End rfrb//

     function printTrackCard_get()
     {
          $enqid = $_GET['enq_id'];
          // if (!is_numeric($enqid)) {
          //      $enqid = encryptor($enqid, 'D');
          // }
          // $data['trackCard'] = $this->rest_model->getTrackCardDetailsNew($enqid);
          $data['trackCard'] = $this->rest_model->getTrackCardDetails_test($enqid);
          $showroomId = get_logged_user('usr_showroom');
          $data['showRoom'] = $this->rest_model->getShowroomNew($showroomId);
          echo json_encode($data);
          // $this->render_page(strtolower(__CLASS__) . '/tracking_card', $data);
     }


     //web vw//
     function printevaluation_get()
     {
          $valid = $_GET['val_id'];
          //debug($valid);
          $data['vehicles'] = $this->rest_model->getEvaluationPrint($valid);
          $data['refurbDetails'] = $this->rest_model->getRefurbDetails($valid);
          $prchsChkData = $this->rest_model->getPrchsChkMstr($valid);
          $data['stk_added_date'] = isset($prchsChkData['pcl_created_at']) ? $prchsChkData['pcl_created_at'] : '';
          //debug($prchsChkData);
          if (isset($prchsChkData['pcl_check_list_id'])) {
               $chk_data['result'] = $this->rest_model->getPurchase_check_list($prchsChkData['pcl_check_list_id']);
               //debug($chk_data['result']);
               $chk_data['purchase_type'] = $data['vehicles']['val_type'];
               $data['prchs_chk_list_vw'] = $this->load->view('purchase_check_list_print_tab', $chk_data, true);
          } else {
               $data_pcl['resultChk'] = $this->rest_model->getCheck_listItemsByCategory(1);
               $data_pcl['evaluation_details'] = $this->rest_model->getEvaluationDetails($valid);
               $data_pcl['resultChk'] = $this->rest_model->getCheck_listItemsByCategory(1);
               $data_pcl['val_id'] = $valid;
               $data_pcl['controller'] = 'evaluation';
               $data['prchs_chk_list_vw'] = $this->load->view('purchase_check_list_form_tab', $data_pcl, true); //create
          }
          echo json_encode($data['prchs_chk_list_vw']);
          // $data['refurbDetails'] = $this->evaluation->getRefurbDetails($valid);

          // $this->render_page(strtolower(__CLASS__) . '/printevaluation', $data);
     }
     function track_card_get()
     {
          $chk_data = '';
          // $data['style']=$this->load->view('style', $chk_data, true);
          $data['track_card'] = $this->load->view('track_card', $chk_data, true);
          echo json_encode($data);
     }
     //End web vw//
     //j//

     function tracklist_get()
     {
          $limit = 6;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $filter = @$_GET['search'];
          $response = $this->rest_model->getAllVehiclesForTracking($limit, $page, $filter);
          $data['trackingVehicles'] = $response['data'];
          //$data['trackingVehicles'] =
          // debug($data);
          $data['pagination']['limit'] = $limit;
          //$data['pagination']['totalRow'] = number_format($reg_data['count']);
          $data['pagination']['totalRow'] =  number_format($response['count']);

          //$data['user_access']['filters']['enable'] = 1;
          //echo json_encode(array('trackingVehicles' => $data['trackingVehicles'] ));
          echo json_encode(array('status' => true, 'data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/tracklist', $data);
     }
     function trackingLog_get()
     {
          $vehId = $_GET['val_id'];
          $data['vehicleTrackLog'] = $this->rest_model->getTrackingByVehicleId($vehId);
          $data['evaliationDetails'] = $this->rest_model->getEvaluation($vehId);
          echo json_encode(array('status' => true, 'data' => $data));
          // $this->render_page(strtolower(__CLASS__) . '/trackingLog', $data);
     }
     function out_pass_get()
     {
          $data['other_place']['id'] = -1;
          $data['other_place']['label'] = 'Other place';
          $data['showrooms'] = $this->rest_model->getShowroomNew();
          $data['vehicles'] = $this->rest_model->getEvaluationTracking();
          $data['other_staffs']['id'] = -1;
          $data['other_staffs']['label'] = 'Other drivers';

          $data['staffs'] = $this->rest_model->getAllEmployees();
          //debug($data['staffs']);

          echo json_encode(array('status' => true, 'data' => $data));
          // $this->render_page(strtolower(__CLASS__) . '/out_pass', $data);

     }
     function submit_out_pass_post()
     {
          if (!empty($_POST)) {
               //debug($_POST);
               $this->uid = $_POST['user_id'];
               unset($_POST['user_id']);
               unset($_POST['grp_slug']);
               unset($_POST['usr_showroom']);
               if ($id = $this->rest_model->insertOutPass($_POST)) {
                    echo json_encode(array('status' => true, 'msg' => 'Tracking successfully completed!', 'id' => $id));
               } else {
                    echo json_encode(array('status' => false, 'msg' => 'Error occured!'));
               }
               // redirect(strtolower(__CLASS__) . '/generateOutPass/' . encryptor($id));
          }
     }
     public function check_in_list_get()
     {
          $this->uid = $_GET['user_id'];
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $filter = @$_GET['search'];
          $response = $this->rest_model->getTracking('', $limit, $page, $filter);
          // debug( $response);
          $data['trackingVehicles'] = $response['data'];
          $data['pagination']['limit'] = $limit;
          //$data['pagination']['totalRow'] = number_format($reg_data['count']);
          $data['pagination']['totalRow'] =  number_format($response['count']);
          echo json_encode(array('status' => true, 'data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/list', $data);
     }
     function generateOutPass_get()
     {
          $this->uid = $_GET['user_id'];
          $id = $_GET['id'];
          $this->shrm = $_GET['usr_showroom'];
          if (!empty($id)) {
               //header('Content-Type: application/pdf');
               // $showroomId = get_logged_user('usr_showroom');
               $showroomId = $this->shrm;
               $showroom = $this->rest_model->getShowroomNew($showroomId);
               // debug($showroom);
               //$id = encryptor($id, 'D');
               $data['trackingVehicles'] = $this->rest_model->getTracking($id);
               $data['showRoom'] = $showroom;
               $data['filename'] = "out-pass-" . time() . ".pdf";
               //$html = $this->load->view('temp_out_pass', $data, true);
               // $this->load->library('m_pdf');
               //$this->m_pdf->pdf->WriteHTML($html);


               $data['vehicleNumber'] = isset($data['trackingVehicles']['val_veh_no']) ? $data['trackingVehicles']['val_veh_no'] : '';
               $data['logo'] = 'https://vestletech.com/demo/rdp/assets/images/logo.jpg';
               $data['cut-icon'] = 'https://vestletech.com/demo/rdp/assets/images/cut-here.png';
               // debug($data);
               //echo json_encode($data);
               echo json_encode(array('status' => true, 'data' => $data));
               //$this->m_pdf->pdf->SetTitle('Gate pass for vehicle ' . $vehicleNumber);
               // $this->m_pdf->pdf->Output("./assets/uploads/outpass/" . $filename, "I");
          }
     }
     function editGatePass_get()
     { //out pass
          $this->uid = $_GET['user_id'];
          $id = $_GET['id'];
          $this->shrm = $_GET['usr_showroom'];

          if (!empty($id)) {
               // $id = encryptor($id, 'D');
               $data['trackingVehicles'] = $this->rest_model->getTracking($id);
               $data['vehicles'] = $this->rest_model->getEvaluationTracking();
               $data['other_staffs']['id'] = -1;
               $data['other_staffs']['label'] = 'Other drivers';
               $data['staffs'] = $this->rest_model->getAllEmployees();

               $data['other_place']['id'] = -1;
               $data['other_place']['label'] = 'Other place';
               $data['showrooms'] = $this->rest_model->getShowroomNew();
               echo json_encode(array('status' => true, 'data' => $data));
               // $this->render_page(strtolower(__CLASS__) . '/view', $data);
          }
     }
     function updateGatePass_post($id = '')
     { //out pass

          if (!empty($_POST)) {
               $this->uid = $_POST['user_id'];
               unset($_POST['user_id']);
               unset($_POST['grp_slug']);
               unset($_POST['usr_showroom']);
               if ($this->rest_model->updateGatePass($_POST)) {
                    echo json_encode(array('status' => true, 'msg' => 'Tracking successfully completed!'));
               } else {
                    echo json_encode(array('status' => false, 'msg' => 'Error occured!'));
               }
          }
     }
     function check_in_view_get()
     {
          $this->uid = $_GET['user_id'];
          $id = $_GET['id'];
          $this->shrm = $_GET['usr_showroom'];
          if (!empty($id)) {
               //  $id = encryptor($id, 'D');

               $data['other_place']['id'] = -1;
               $data['other_place']['label'] = 'Other place';
               $data['showrooms'] = $this->rest_model->getShowroomNew();
               $data['trackingVehicles'] = $this->rest_model->getTracking($id);
               $data['vehicles'] = $this->rest_model->getEvaluationTracking();
               $data['other_staffs']['id'] = -1;
               $data['other_staffs']['label'] = 'Other drivers';
               $data['staffs'] = $this->rest_model->getAllEmployees();
               echo json_encode(array('status' => true, 'data' => $data));
               //$this->render_page(strtolower(__CLASS__) . '/check_in', $data);
          }
     }
     function check_in_update_post()
     {
          if (!empty($_POST)) {
               $this->uid = $_POST['user_id'];
               unset($_POST['user_id']);
               unset($_POST['grp_slug']);
               unset($_POST['usr_showroom']);
               //if ($this->rest_model->checkinVehicle($_POST['checkin'])) {
               if ($this->rest_model->checkinVehicle($_POST)) {
                    echo json_encode(array('status' => true, 'msg' => 'Check in successfully completed!'));
               } else {
                    echo json_encode(array('status' => false, 'msg' => 'Error occured!'));
               }
          }
     }
     //end j

     ///
     function vehDetailsByValId_get()
     {
          $val_id = $_GET['val_id'];
          $data = $this->rest_model->vehDetailsByValId($val_id);
          echo json_encode(array('status' => true, 'data' => $data));
     }
     ///@
     //booking enqs//
     function booking_enquiries_get()
     {
        
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          //  debug($_GET);
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          unset($_GET['user_id']);
          unset($_GET['usr_showroom']);
          unset($_GET['grp_slug']);

          $res = $this->rest_model->getAllBookings($limit, $page, $_GET);
          //debug( $res);
          $data['bookingVehicles'] = $res['data'];
          // debug($data['bookingVehicles']);
          $data['salesExecutives'] = $this->rest_model->salesExecutives();
          $data['pagination']['limit'] = $limit;

          $data['pagination']['totalRow'] = number_format($res['count']);
          echo json_encode(array('status' => true, 'data' => $data));
     }
     function booking_enquiries_post()
     {
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          //  debug($_POST);
          $limit = 3;
          $page = !isset($_POST['page']) ? 0 : $_POST['page'];
          unset($_POST['user_id']);
          unset($_POST['usr_showroom']);
          unset($_POST['grp_slug']);

          $res = $this->rest_model->getAllBookings($limit, $page, $_POST);
          $data['bookingVehicles'] = $res['data'];
          // debug($data['bookingVehicles']);
          $data['salesExecutives'] = $this->rest_model->salesExecutives();
          $data['pagination']['limit'] = $limit;

          $data['pagination']['totalRow'] = number_format($res['count']);
          echo json_encode(array('status' => true, 'data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/index', $data);//booking cntrl index fn
     }
     function deliverdvehicle_get()
     {
          $stsId = 40;
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $this->page_title = 'Deliverd vehicles';
          $limit = 20;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          unset($_GET['user_id']);
          unset($_GET['usr_showroom']);
          unset($_GET['grp_slug']);

          $data['salesExecutives'] = $this->rest_model->salesExecutives();
          $res = $this->rest_model->getDeliverdVehicle(0, $stsId, $limit, $page, $_GET);
          // debug($data['bookedVehicle']);
          // $data['districts'] = $this->booking->getDistricts();
          $states = [1, 0];
          $data['districts'] = $this->rest_model->getDistricts($states);
          $data['DeliveredVehicles'] = $res['data'];
          // debug($data['bookingVehicles']);

          $data['pagination']['limit'] = $limit;

          $data['pagination']['totalRow'] = number_format($res['count']);
          echo json_encode(array('status' => true, 'data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/deliverdvehicle', $data);
     }
     function deliverdvehicle_post()
     {
          $stsId = 40;
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->page_title = 'Deliverd vehicles';
          $limit = 20;
          $page = !isset($_POST['page']) ? 0 : $_POST['page'];
          unset($_POST['user_id']);
          unset($_POST['usr_showroom']);
          unset($_POST['grp_slug']);

          $data['salesExecutives'] = $this->rest_model->salesExecutives();
          $res = $this->rest_model->getDeliverdVehicle(0, $stsId, $limit, $page, $_POST);
          // debug($data['bookedVehicle']);
          // $data['districts'] = $this->booking->getDistricts();
          $states = [1, 0];
          $data['districts'] = $this->rest_model->getDistricts($states);
          $data['DeliveredVehicles'] = $res['data'];
          // debug($data['bookingVehicles']);

          $data['pagination']['limit'] = $limit;

          $data['pagination']['totalRow'] = number_format($res['count']);
          echo json_encode(array('status' => true, 'data' => $data));
          //$this->render_page(strtolower(__CLASS__) . '/deliverdvehicle', $data);
     }
     function changeStatusRequest_get()
     { //loss of purchase or sale
          $status = $_GET['status'];
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $limit = 3;
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $data = $_GET;
          if ($status == 2) {
               $data['title'] = 'Request for drop';
               $this->page_title = 'Enquiry - Request for drop';
          } else if ($status == 4) {
               $data['title'] = 'Request loss of sale or purchase';
               $this->page_title = 'Enquiry - Request loss of sale or purchase';
          } else if ($status == 6) {
               $data['title'] = 'Request for close';
               $this->page_title = 'Enquiry - Request for close';
          } else if ($status == 8) {
               $data['title'] = 'Request for delete';
               $this->page_title = 'Enquiry - Request for delete';
          }
          $data['showroom'] = isset($_GET['showroom']) ? $_GET['showroom'] : '';
          $data['executive'] = isset($_GET['executive']) ? $_GET['executive'] : '';
          $data['enq_date_from'] = (isset($_GET['enq_date_from']) && !empty($_GET['enq_date_from'])) ? $_GET['enq_date_from'] : '';
          $data['enq_date_to'] = (isset($_GET['enq_date_to']) && !empty($_GET['enq_date_to'])) ? $_GET['enq_date_to'] : '';
          $data['enqStatus'] = isset($_GET['enqStatus']) && !empty($_GET['enqStatus']) ? $_GET['enqStatus'] : '';
          $data['mode'] = isset($_GET['mode']) && !empty($_GET['mode']) ? $_GET['mode'] : '';

          $enquires = $this->rest_model->getRequestedEnquires('', $status, $_GET, $limit, $page);
          /*pagination*/
          $data['enq_ids'] = $enquires['enq_ids'];
          $data['enquires'] = $enquires['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';

          $config["total_rows"] = $enquires['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;

          $data['allShowrooms'] = $this->rest_model->getShowroom();
          $data['status'] = $status;
          $data['teleCallers'] = $this->rest_model->teleCallersSalesStaffs();
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($enquires['count']);
          echo json_encode(array('status' => true, 'data' => $data));
     }
     function changeStatusRequest_post()
     { //loss of purchase or sale
          $status = $_POST['status'];
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $limit = 3;
          $page = !isset($_POST['page']) ? 0 : $_POST['page'];
          $data = $_POST;
          if ($status == 2) {
               $data['title'] = 'Request for drop';
               $this->page_title = 'Enquiry - Request for drop';
          } else if ($status == 4) {
               $data['title'] = 'Request loss of sale or purchase';
               $this->page_title = 'Enquiry - Request loss of sale or purchase';
          } else if ($status == 6) {
               $data['title'] = 'Request for close';
               $this->page_title = 'Enquiry - Request for close';
          } else if ($status == 8) {
               $data['title'] = 'Request for delete';
               $this->page_title = 'Enquiry - Request for delete';
          }

          $data['showroom'] = isset($_POST['showroom']) ? $_POST['showroom'] : '';
          $data['executive'] = isset($_POST['executive']) ? $_POST['executive'] : '';
          $data['enq_date_from'] = (isset($_POST['enq_date_from']) && !empty($_POST['enq_date_from'])) ? $_POST['enq_date_from'] : '';
          $data['enq_date_to'] = (isset($_POST['enq_date_to']) && !empty($_POST['enq_date_to'])) ? $_POST['enq_date_to'] : '';
          $data['enqStatus'] = isset($_POST['status']) && !empty($_POST['status']) ? $_POST['status'] : '';
          $data['mode'] = isset($_POST['mode']) && !empty($_POST['mode']) ? $_POST['mode'] : '';
          $enquires = $this->rest_model->getRequestedEnquires('', $status, $_POST, $limit, $page);
          /*pagination*/
          $data['enq_ids'] = $enquires['enq_ids'];
          $data['enquires'] = $enquires['data'];
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'page';
          $config["total_rows"] = $enquires['count'];
          $config["per_page"] = $limit;
          $config["uri_segment"] = 3;
          $data['salesExecutives'] = $this->rest_model->salesExecutives();
          $data['allShowrooms'] = $this->rest_model->getShowroom();
          $data['status'] = $status;
          $data['teleCallers'] = $this->rest_model->teleCallersSalesStaffs();
          $data['pagination']['limit'] = $limit;
          $data['pagination']['totalRow'] = number_format($enquires['count']);
          echo json_encode(array('status' => true, 'data' => $data));
          // $this->render_page(strtolower(__CLASS__) . '/specialRequestsList', $data);
     }
     //@booking enqs//
     //
     public function purchase_check_list_get()
     {
          $eval_id = $_GET['val_id'];
          $category_id = 1;
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          if ($category_id == 1 && $eval_id) {
               //debug($_GET);
               //$category_id==1 Allows only Purchase Agreement Docket category 
               $data['result'] = $this->rest_model->getCheck_listItemsByCategory($category_id);

               $data['evaluation_details'] = $this->rest_model->getEvaluationDetails($eval_id);

               $purchase_type = $data['evaluation_details']['val_type'];
               $purchaseTypes = unserialize(EVALUATION_TYPES);
               $data['purchase_type']['id'] = $purchase_type;
               $data['purchase_type']['title'] = isset($purchaseTypes[$purchase_type]) ? $purchaseTypes[$purchase_type] : '';

               $data['team_leader'] = NULL;
               $data['team_lead_id'] = NULL;
               $data['purchase_staff'] = NULL;
               $data['doc_no'] = NULL;

               $data['val_id'] = $eval_id;
               if (!empty($data['evaluation_details'])) {
                    echo json_encode(array('status' => true, 'data' => $data));
                    //$this->render_page(strtolower(__CLASS__) . '/purchase_check_list_form', $data);
               } else {
                    die('Error: No data found');
               }
          } else {
               die('Error');
          }
     }
     //@
     /////
     public function view_purchase_check_list_get()
     {
          $valid = $_GET['val_id'];

          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $data['vehicles'] = $this->rest_model->getEvaluationPrint($valid);
          // debug($data['vehicles']);
          $prchsChkData = $this->rest_model->getPrchsChkMstrID($valid);
          //debug($prchsChkData);
          $data['stk_added_date'] = isset($prchsChkData['pcl_created_at']) ? $prchsChkData['pcl_created_at'] : '';

          if (isset($prchsChkData['pcl_check_list_id'])) {

               $chk_data['result'] = $this->rest_model->getPurchase_check_list($prchsChkData['pcl_check_list_id']);
               $chk_data['evaluation_details'] = $this->rest_model->getEvaluationDetails($valid);
               $purchase_type = $data['vehicles']['val_type'];
               $purchaseTypes = unserialize(EVALUATION_TYPES);
               $chk_data['purchase_type']['id'] = $purchase_type;
               $chk_data['purchase_type']['title'] = isset($purchaseTypes[$purchase_type]) ? $purchaseTypes[$purchase_type] : '';
               $data['team_leader'] = NULL;
               $data['purchase_staff'] = NULL;
               $data['doc_no'] = NULL;
               $chk_data['stk_added_date'] = $data['stk_added_date'];
               echo json_encode(array('status' => true, 'data' => $chk_data));
               //$data['prchs_chk_list_vw'] = $this->load->view('purchase_check_list_print_tab', $chk_data, true);
          } else {
               $data_pcl['result'] = $this->rest_model->getCheck_listItemsByCategory(1);
               $data_pcl['evaluation_details'] = $this->rest_model->getEvaluationDetails($valid);
               //$data_pcl['result'] = $this->rest_model->getCheck_listItemsByCategory(1);
               $data_pcl['val_id'] = $valid;
               $data['team_leader'] = NULL;
               $data['team_lead_id'] = NULL;
               $data['purchase_staff'] = NULL;
               $data['doc_no'] = NULL;
               // $data_pcl['controller'] = 'evaluation';
               echo json_encode(array('status' => true, 'data' => $data_pcl));
               // $data['prchs_chk_list_vw'] = $this->load->view('purchase_check_list_form_tab', $data_pcl, true); //create
          }
     }
     ////@
     ///
     public function edit_purchase_check_list_get()
     {
          $eval_id = $_GET['val_id'];
          $category_id = 1;
          $check_list_mstrId = $_GET['check_list_mstrId'];

          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          if ($category_id == 1 && $eval_id && $check_list_mstrId) {
               $prchsChkData = $this->rest_model->getPrchsChkMstrID($eval_id);
               //debug($prchsChkData);

               //$category_id==1 Allows only Purchase Agreement Docket category 
               $data['result'] = $this->rest_model->getCheck_listItemsByCategory($category_id);
               $data['evaluation_details'] = $this->rest_model->getEvaluationDetails($eval_id);
               $data['val_id'] = $eval_id;
               $data['chkLstMstrId'] = $check_list_mstrId;
               if (!empty($data['evaluation_details'])) {
                    $data['team_leader'] = NULL;
                    $data['team_lead_id'] = NULL;
                    $data['purchase_staff'] = NULL;
                    $data['doc_no'] = NULL;
                    $data['stk_added_date'] = isset($prchsChkData['pcl_created_at']) ? $prchsChkData['pcl_created_at'] : '';
                    echo json_encode(array('status' => true, 'data' => $data));
                    //$this->render_page(strtolower(__CLASS__) . '/edit_purchase_check_list_form', $data);
               } else {
                    die('Error: No data found');
               }
          } else {
               die('Error');
          }
     }
     public function getChkDtls_get()
     {
          $chitem_id = $_GET['chitem_id'];
          $chkLstMstrId = $_GET['check_list_mstrId'];

          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          if ($chitem_id && $chkLstMstrId) {
               $data['result'] = $this->rest_model->getChkDtls($chitem_id, $chkLstMstrId);

               if (!empty($data['result'])) {
                    echo json_encode(array('status' => true, 'data' => $data));
                    //$this->render_page(strtolower(__CLASS__) . '/edit_purchase_check_list_form', $data);
               } else {
                    die('Error: No data found');
               }
          } else {
               die('Error');
          }
     }
     public function add_purchase_check_list_post()
     {
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          generate_log(array(
               'log_title' => 'Add purchase check list details pre insert',
               'log_desc' => serialize($_POST),
               'log_controller' => 'add-purchase-check-details-pre-insert',
               'log_action' => 'C',
               'log_ref_id' => 202020,
               'log_added_by' => $this->uid
          ));
          if (isset($_POST['item']) && !empty($_POST['item'])) {
               $id = $this->rest_model->insertPurchaseCheckListMaster(
                    array(
                         'pcl_val_id' => $_POST['val_id'],
                         'pcl_var_id' => $_POST['var_id'],
                         'pcl_brd_id' => $_POST['brd_id'],
                         'pcl_mod_id' => $_POST['mod_id'],
                         'pcl_vehicle_reg_no' => $_POST['vehicle_reg_no'],
                         'pcl_chasis_number' => $_POST['chasis_number'],
                         'pcl_team_lead_id' => $_POST['team_lead_id'],
                         'pcl_description' => $_POST['description'],
                         'pcl_created_at' => date('Y-m-d H:i:s'),
                         'pcl_added_by' => $this->uid
                    )
               );
               if ($id) {
                    foreach ($_POST['item'] as $key => $value) {
                         isset($value['yn']) ? $yn = 1 : $yn = 0; // check box is cheked or not
                         $this->rest_model->insertPurchaseCheckDetails(
                              array(
                                   'pcld_check_list_master_id' => $id,
                                   'pcld_check_list_item_id' => $key,
                                   'pcld_check_list_item_value' => $yn,
                                   'pcld_remarks' => $value['desc']
                              )
                         );
                    }
                    die(json_encode(array("status" => "success", "message" => "Data submited successfully", "check_listMasterId" => $id)));
               } else {
                    die(json_encode(array("status" => "error", "message" => "Sorry Something went wrong")));
               }
          }
     }
     public function getAllStaffInSales_get()
     {
          $this->uid = $_GET['user_id'];
          //  $this->usr_grp = $_GET['grp_slug'];
          $data['salesExe'] = $this->rest_model->getAllStaffInSales();
          echo json_encode($data);
     }
     function sendBackRegister_post()
     {
          $this->uid = $_POST['user_id'];
          unset($_POST['user_id']);
          generate_log(array(
               'log_title' => 'Send back register',
               'log_desc' => serialize($_POST),
               'log_controller' => 'reg-send-back',
               'log_action' => 'C',
               'log_ref_id' => 101010,
               'log_added_by' => $this->uid
          ));
          $this->rest_model->sendBackRegister($this->input->post());
          die(json_encode(array("status" => "success", "message" => "Register reassigned to telecaller, please inform them!")));
          //$this->session->set_flashdata('app_success', 'Register reassigned to telecaller, please inform them!');
          //redirect(strtolower(__CLASS__) . '/myregister');
     }

     public function getConnectedCallByRegister_get()
     {
          $this->uid = $_GET['user_id'];
          if ($_GET['vreg_id'] && $_GET['user_id']) {
               // $this->rest_model->getConnectedCallByRegister($_GET['vreg_id']);
               $data['ccb_recording_URL'] = 'http://45.249.170.209:8080/content/incomingrecordings/914844515930-9745661946-in2702222-27012023-190242.wav';
               echo json_encode(array('status' => true, 'data' => $data));
          } else {
               echo json_encode(array('status' => false, 'data' => ''));
          }
     }

     public function web_view_valuation_report_get()
     {
          $data['url'] = '';
          echo json_encode(array('status' => true, 'data' => $data));
     }
     public function web_view_track_list_get()
     {
          $data['url'] = '';
          echo json_encode(array('status' => true, 'data' => $data));
     }
     function web_view_print_track_card_get()
     { //printTrackCard

          $data['url'] = 'https://royaldrive.in/webvw/print_track_card?' . $_GET['user_id'] . '&' . $_GET['usr_showroom'] . '&' . $_GET['grp_slug'];
          $data['param'] = 'enq_id';
          echo json_encode(array('status' => true, 'data' => $data));
     }
     function web_view_valuation_repot_get()
     { //printevaluation/valuation report tab
          //debug(777);
          $data['url'] = 'https://royaldrive.in/webvw/val_report?' . $_GET['user_id'] . '&' . $_GET['usr_showroom'] . '&' . $_GET['grp_slug'];
          $data['param'] = 'val_id';

          echo json_encode(array('status' => true, 'data' => $data));
     }
     function reghistory_get()
     {
          $vreg_id = $_GET['vreg_id'];
          $data['regHistory'] = $this->rest_model->reghistory($vreg_id);
          echo json_encode(array('status' => true, 'data' => $data));
     }
     function print_obf_get()
     {
          $this->uid = $_GET['user_id'];
          $bookId = $_GET['vbd_master_id'];
          $data['addressProof'] = $this->rest_model->getActiveAddressProof(1);
          $data['bookingDetails'] = $this->rest_model->getBookedVehicle($bookId);
          $data['panCard'] = $this->rest_model->getPanCard($bookId);
          // $this->booking->rest_model($bookId);
          die(json_encode(array("status" => true, "data" =>  $data)));
          //$data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);

          // $this->render_page(strtolower(__CLASS__) . '/print_bookingdetails', $data);
     }
     function vehicleDetails_get()
     {
          $this->uid = $_GET['user_id'];
          $enqId = $_GET['enq_id'];
          $data['vehicleDetails'] = $this->rest_model->getVehicleDetails($enqId);
          echo json_encode(array('status' => true, 'data' => $data));
     }

     function vehicleInformation_get()
     {
          $this->uid = $_GET['user_id'];
          $enqId = $_GET['enq_id'];
          $data['vehicleDetails'] = $this->rest_model->getVehicleInformation($enqId);
          echo json_encode(array('status' => true, 'data' => $data));
     }

     function viewVehicleStatus_get() {
          $this->uid = $_GET['user_id'];
          $this->shrm = $_GET['usr_showroom'];
          $this->usr_grp = $_GET['grp_slug'];
          $enq=$_GET['enq_id'];
          $status = (isset($_GET['status']) && !empty($_GET['status'])) ? $_GET['status'] : '';
          if (!empty($enq)) {
              // debug($enq);
               $data['enquiryDetails'] = $this->rest_model->getRequestedEnquires($enq, '');
               //debug($data['enquiryDetails']);
               $data['valuationVehicles'] = $this->rest_model->getOwnParkAndSaleCars();
               $data['statusButtons'] = array();
               if ($status == 8) {
                    $data['statusButtons'] = array(
                        array('id' => 1, 'title' => 'Cancel Request', 'buttonClass' => 'danger'),
                        array('id' => 99, 'title' => 'Delete', 'buttonClass' => 'success')
                    );
               } else if ($status == 2) {
                    $data['statusButtons'] = array(
                        array('id' => 1, 'title' => 'Cancel Request', 'buttonClass' => 'danger'),
                        array('id' => 3, 'title' => 'Drop', 'buttonClass' => 'success')
                    );
               } else if ($status == 6) {
                    $data['statusButtons'] = array(
                        array('id' => 1, 'title' => 'Cancel Request', 'buttonClass' => 'danger'),
                        array('id' => 7, 'title' => 'Close', 'buttonClass' => 'success')
                    );
               } else if ($status == 4) {
                    $data['statusButtons'] = array(
                        array('id' => 5, 'title' => 'Lost confirmed', 'buttonClass' => 'danger'),
                        array('id' => 1, 'title' => 'Cancel Request', 'buttonClass' => 'success')
                    );
               } else if (isset($data['enquiryDetails']['enq_current_status']) && $data['enquiryDetails']['enq_current_status'] == 3) { // Dropped case
                    $data['statusButtons'] = array(
                        array('id' => 1, 'title' => 'Reopening enquires', 'buttonClass' => 'danger')
                    );
               }
               echo json_encode(array('status' => true, 'data' => $data));
             //  $this->render_page(strtolower(__CLASS__) . '/vehicleStatus', $data);
          }
     }
     //
     function viewVehicleStatusSubmit_POST() {
     if (!empty($_POST)) {
          $this->uid = $_POST['user_id'];
          $this->shrm = $_POST['usr_showroom'];
          $this->usr_grp = $_POST['grp_slug'];
          $this->usr_username = $_POST['usr_username'];
          unset($_POST['grp_slug'],$_POST['usr_showroom'],$_POST['user_id'],$_POST['usr_username']);
             
          if ($this->rest_model->changeStatus($_POST)) {
        echo json_encode(array("status" => true, "message" => "Status changed successfully!","enh_enq_id"=>$_POST['enh_enq_id']));
          } else {
               die(json_encode(array("status" => false, "message" => "Error occured!")));
          }
         // redirect(strtolower(__CLASS__) . '/viewVehicleStatus/' . encryptor($_POST['enh_enq_id']));
     } 

     
}
function enq_types_get()
{
     //debug(777);
     $types = unserialize(ENQUIRY_TYPES_API);
     echo json_encode(array('status' => true, 'data' => $types));
     // debug($types);
}


function getStaffNameById_get()
{
    // debug(777);
     $this->uid = $_GET['user_id'];
     $staff_id = $_GET['staff_id'];
     $data['staff'] = $this->rest_model->getStaffNameById($staff_id);
     echo json_encode(array('status' => true, 'data' => $data));
}
function insuranceDetails_get() {//any_top_up_loan
     $veh_id = $_GET['veh_id'];
     if ($veh_id) {
          $data['data'] = $this->rest_model->insuranceDetails($veh_id);
          echo json_encode(array('status' => true, 'data' => $data));
         
     }
    
}  

     //@
}