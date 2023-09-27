<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/ProcessJwt.php';

class rest extends REST_Controller
{

     public function __construct()
     {
          // Add CORS headers
          parent::__construct();
          $this->load->model('api_logic/advanced');
          $this->load->model('blog/blog_model', 'blog');

          $this->objOfJwt = new ProcessJwt();
          //header('Content-Type: application/json');
     }

     /* function users_get()
         {
         //$users = $this->some_model->getSomething( $this->get('limit') );
         $users =array(
         array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
         array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
         array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com'),
         );

         if($users)
         {
         $this->response($users, 200); // 200 being the HTTP response code
         }

         else
         {
         $this->response(array('error' => 'Couldn\'t find any users!'), 404);
         }
         } */

     public function getValues_post()
     {
          echo 'Here';
          debug($_POST, 0);
          debug($_GET, 0);
          $params = json_decode(file_get_contents('php://input'), TRUE);
          debug($params);
     }

     public function getVariations_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->getVariant($params['brand'], $params['model']);
          if ($search) {
               $this->response($search, 200); // 200 being the HTTP response code
          } else {
               $this->response(array('error' => 'Couldn\'t find any any matching variant!'), 404);
          }
     }

     public function search_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params);
          $search = $this->advanced->search($params['brand'], $params['color'], $params['fuel'], $params['pricelow'], $params['pricehigh'], $params['year'], $params['km_driven'], $params['category'], $params['is_ev'], $params['keyword'], $params['orderby']);

          if ($search) {
               $this->response($search, 200); // 200 being the HTTP response code
          } else {
               //$this->response(array('error' => 'Couldn\'t find any any matching cars!'), 404);old
               $this->response(array('error' => 'Couldn\'t find any any matching vehicle!'), 404);
          }
     }

     public function featured_get()
     {
          $id = $_GET['id'];
          //  $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params);
          $search = $this->advanced->featured($id);

          if ($search) {
               $this->response($search, 200); // 200 being the HTTP response code
          } else {
               //$this->response(array('error' => 'Couldn\'t find any any matching cars!'), 404);old
               $this->response(array('error' => 'Couldn\'t find any any matching vehicle!'), 404);
          }
     }
     //blog
     function blogs_get()
     {
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $id = $_GET['id'];
          $data['anasiz'] = $this->blog->getBlogAnalisiz();
          //debug($data);
          if (isset($_GET['id'])) {
               //debug(741);
               $data['blog'] = $this->blog->getBlog(encryptor($id, 'D'));
               // $this->render_page(strtolower(__CLASS__) . '/detail', $data);
               $this->response($data, 200);
          } else {
               // debug(333);
               $blogs = $this->blog->getBlog();
               $this->load->library("pagination");
               $config = getPaginationDesign();
               $config["base_url"] = site_url() . '/' . strtolower(__CLASS__);
               $config["total_rows"] = count($blogs);
               $config["per_page"] = 2;
               $config["uri_segment"] = 2;
               $this->pagination->initialize($config);
               $data["links"] = $this->pagination->create_links();
               $data['blogs'] = $this->blog->getBlog('', $config["per_page"], $page);
               $data['pagination']['limit'] = $config["per_page"];
               $data['pagination']['totalRow'] = number_format($config["total_rows"]);
               $this->response($data, 200);
               // $this->render_page(strtolower(__CLASS__) . '/index', $data);
          }
     }
     //@blog
     //
     function plans_get()
     {
          $plans['total'] = 4;
          $plans['items'] = array(
               array(
                    "_id" => "1",
                    "created" => "2022-07-18T15:10:53.295Z",
                    "title" => "Royal Drive",
                    "short_description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "image" => "https://royal-drive-uploads.s3.ap-south-1.amazonaws.com/1658157051424-plan_car_one.png",
                    "createdAt" => "2022-07-18T15:10:53.295Z",
                    "updatedAt" => "2022-07-18T15:46:39.061Z",
                    "__v" => 0
               ),
               array(
                    "_id" => "2",
                    "created" => "2022-07-18T15:50:00.127Z",
                    "title" => "Royal Drive Smart",
                    "short_description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "image" => "https://royal-drive-uploads.s3.ap-south-1.amazonaws.com/1658159556067-plan_car_two.png",
                    "createdAt" => "2022-07-18T15:50:00.136Z",
                    "updatedAt" => "2022-07-18T15:52:37.069Z",
                    "__v" => 0
               ),
               array(
                    "_id" => "3",
                    "created" => "2022-07-18T15:50:10.308Z",
                    "title" => "Royal Drive EV",
                    "short_description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "image" => "https://royal-drive-uploads.s3.ap-south-1.amazonaws.com/1658159580200-plan_car_three.png",
                    "createdAt" => "2022-07-18T15:50:10.309Z",
                    "updatedAt" => "2022-07-18T15:53:02.154Z",
                    "__v" => 0
               ),
               array(
                    "_id" => "4",
                    "created" => "2022-07-18T15:50:19.902Z",
                    "title" => "Royal Drive Care",
                    "short_description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "description" => "We are Royal Drive, South India's first choice pre owned luxury automobile dealer for many of the moto enthusiasts in Kerala. Our illustrious list of pre owned luxury car brands includes Porsche,",
                    "image" => "https://royal-drive-uploads.s3.ap-south-1.amazonaws.com/1658159564266-place_care.png",
                    "createdAt" => "2022-07-18T15:50:19.902Z",
                    "updatedAt" => "2022-07-18T15:52:45.479Z",
                    "__v" => 0
               )
          );
          $this->response($plans, 200); // 200 being the HTTP response code

     }

     //@

     public function newuser_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->newUser($params['name'], $params['email'], $params['password'], $params['phonenumber']);


          if ($search == "failure" or $search == "Email id already exist" or $search == "Email id already exist") {
               $this->response(array('error' => $search), 400);
          } else {
               $this->response(array('new_user' => $search), 200); // 200 being the HTTP response code
          }
     }

     public function validate_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->validate("normal", $params['phonenumber'], $params['password'], $params['email']);


          if (!$search) {
               $this->response(array('invalid-user' => array('error' => 'not a registered user!', 'fix' => 'please register!')), 404);
          } else {
               $this->response($search, 200); // 200 being the HTTP response code
          }
     }

     public function sociallogin_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->validate("social", $params['phonenumber'], "!@#", $params['email']);


          if (!$search) {
               $this->response(array('invalid-user' => array('error' => 'not a registered user!', 'fix' => 'please register!')), 404);
          } else {
               $this->response($search, 200); // 200 being the HTTP response code
          }
     }

     public function forgot_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->forgot($params['phonenumber']);


          if (!$search) {
               $this->response(array('send-otp' => 'false', 'error' => 'not a registered phonenumber!', 'fix' => 'please register!'), 404);
          } else {
               $this->response($search, 200);
          }
     }

     public function updatepassword_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->advanced->updatepassword($params['phonenumber'], $params['password'], $params['userid']);



          if ($search) {
               $this->response(array('status' => 'sucess', 'details' => 'new password is set'), 200);
          } else {
               $this->response(array('status' => 'failed', 'error' => 'password was not updated,try again'), 500);
          }
     }

     function uploaddetails_post()
     {
          $number = gen_random();
          if ($params = json_decode(file_get_contents('php://input'), TRUE)) {
               generate_log(array(
                    'log_title' => 'Sell your cars',
                    'log_desc' => serialize($params),
                    'log_controller' => 'uploaddetails_post',
                    'log_action' => 'C',
                    'log_ref_id' => 0,
                    'log_added_by' => 0
               ));
               $search = $this->advanced->postcardetails($params['user_id'], $params['km'], $params['year'], $params['color'], $params['owner'], $params['price'], $params['fuel'], $params['brand'], $params['model'], $params['variant'], $params['mileage'], $params['engine'], $params['insurance'], $params['description'], $params['features'], $number);
               if ($search != null) {
                    $this->response(array('image_upload_id' => $search, 'status' => 'sucess', 'details' => 'new product added without images'), 200);
               } else {
                    $this->response(array('status' => 'failed', 'error' => 'details incomplete'), 500);
               }
          } else {
               $this->response(array('status' => 'failed', 'error' => 'details misssing'), 500);
          }
     }

     function uploadimages_post()
     {

          $num = $this->input->post('image_upload_id');
          $this->load->library('upload');
          $files = $_FILES;
          $cpt = count($_FILES['images']['name']);
          $db1 = '';
          for ($i = 0; $i < $cpt; $i++) {
               $newFileName = rand(99999999, 0) . $files['images']['name'][$i];
               $_FILES['userfile']['name'] = $newFileName;
               $_FILES['userfile']['type'] = $files['images']['type'][$i];
               $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'][$i];
               $_FILES['userfile']['error'] = $files['images']['error'][$i];
               $_FILES['userfile']['size'] = $files['images']['size'][$i];
               $this->upload->initialize($this->set_upload_options());
               if ($this->upload->do_upload()) {
                    $isDefult = ($i == 0) ? 1 : 0;
                    $db1 = $this->advanced->postimagedetails($num, $_FILES['userfile']['name'], $isDefult);
                    $_FILES['userfile']['name'] = 'thumb_' . $newFileName;
                    $_FILES['userfile']['type'] = $files['images']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['images']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['images']['error'][$i];
                    $_FILES['userfile']['size'] = $files['images']['size'][$i];
                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $up1 = TRUE;
               }
          }
          /* if (!empty($_FILES['mainimage']['name'])) {
              $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
              $config['allowed_types'] = 'jpg|jpeg|png|gif';
              $newFileName = rand(99999999, 0) . $_FILES['mainimage']['name'];
              $config['file_name'] = $newFileName;
              //Load upload library and initialize configuration
              $this->load->library('upload', $config);
              $this->upload->initialize($config);
              if ($this->upload->do_upload('mainimage') && $up1) {
              $db2 = $this->advanced->postmainimagedetails($num, $config['file_name']);
              $config['file_name'] = 'thumb_' . $newFileName;
              //Load upload library and initialize configuration
              $this->load->library('upload', $config);
              $this->upload->initialize($config);
              $this->upload->do_upload('mainimage');
              }
              } */

          if ($db1) {
               $this->advanced->approve($num);
               $this->response(array('status' => 'succes', 'details' => 'image upload success'), 200);
          } else {
               $this->response(array('status' => 'failed', 'error' => 'upload failed'), 500);
          }
     }

     private function set_upload_options()
     {
          //upload an image options
          $config = array();
          $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size'] = '0';
          $config['overwrite'] = FALSE;

          return $config;
     }

     function uploadimagesandroid_post()
     {

          $num = $this->input->post('image_upload_id');

          $this->load->library('upload');

          $files = $_FILES;


          if (!empty($_FILES['mainimage']['name'])) {
               $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $newFileName = rand(99999999, 0) . $_FILES['mainimage']['name'];
               $config['file_name'] = $newFileName;
               //Load upload library and initialize configuration
               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if ($this->upload->do_upload('mainimage')) {
                    $db2 = $this->advanced->postmainimagedetails($num, $config['file_name']);
                    $config['file_name'] = 'thumb_' . $newFileName;
                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('mainimage');
               }
          }





          if (!empty($_FILES['image1']['name'])) {
               $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $newFileName = rand(99999999, 0) . $_FILES['image1']['name'];
               $config['file_name'] = $newFileName;
               //Load upload library and initialize configuration
               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if ($this->upload->do_upload('image1')) {
                    $db3 = $this->advanced->postsubimagedetails($num, $config['file_name']);
                    $config['file_name'] = 'thumb_' . $newFileName;
                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('image1');
               }
          }



          if (!empty($_FILES['image2']['name'])) {
               $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $newFileName = rand(99999999, 0) . $_FILES['image2']['name'];
               $config['file_name'] = $newFileName;
               //Load upload library and initialize configuration
               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if ($this->upload->do_upload('image2')) {
                    $db4 = $this->advanced->postsubimagedetails($num, $config['file_name']);
                    $config['file_name'] = 'thumb_' . $newFileName;
                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('image2');
               }
          }

          if (!empty($_FILES['image3']['name'])) {
               $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
               $config['allowed_types'] = 'jpg|jpeg|png|gif';
               $newFileName = rand(99999999, 0) . $_FILES['image3']['name'];
               $config['file_name'] = $newFileName;
               //Load upload library and initialize configuration
               $this->load->library('upload', $config);
               $this->upload->initialize($config);

               if ($this->upload->do_upload('image3')) {
                    $db5 = $this->advanced->postsubimagedetails($num, $config['file_name']);
                    $config['file_name'] = 'thumb_' . $newFileName;
                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('image3');
               }
          }



          if ($db2) {

               $this->advanced->approve($num);


               $this->response(array('status' => 'succes', 'details' => 'image upload success'), 200);
          } else {

               $this->response(array('status' => 'failed', 'error' => "failed"), 500);
          }
     }

     public function slots_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $slots = $this->advanced->slots($params['date']);

          if ($slots) {
               $this->response($slots, 200); // 200 being the HTTP response code
          } else {
               $this->response(array('error' => 'No slots are available'), 404);
          }
     }

     public function booking_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $booking = $this->advanced->booking($params['name'], $params['number'], $params['slotid'], $params['date']);

          if ($booking) {
               $this->response(array('status' => 'succes', 'details' => 'Booking is  successfull'), 200); // 200 being the HTTP response code
          } else {
               $this->response(array('error' => 'Couldn\'t able to book the slot!'), 404);
          }
     }

     public function feedback_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $feedback = $this->advanced->feedback($params['name'], $params['number'], $params['date'], $params['feedback']);

          if ($feedback) {
               $this->response(array('status' => 'succes', 'details' => 'feedback successfully added'), 200); // 200 being the HTTP response code
          } else {
               $this->response(array('error' => 'Couldn\'t able to add feedback'), 404);
          }
     }

     public function loginwithphone_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          if (
               isset($params['p_number']) && !empty($params['p_number']) &&
               isset($params['cntr_code']) && !empty($params['cntr_code'])
          ) {
               $user = $this->advanced->loginWithPhone($params['p_number'], $params['cntr_code']);
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

     public function sendotp_put()
     { //jsk
          $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params['device_meta']['device_name']);
          if (
               isset($params['phone_number']) && !empty($params['phone_number']) &&
               isset($params['country_prefix']) && !empty($params['country_prefix'])
          ) {
               $user = $this->advanced->loginWithPhoneNew($params['phone_number'], $params['country_prefix']);
               $last_for_dgt = '******' . substr($params['phone_number'], -4);
               echo json_encode(array(
                    'status' => TRUE,
                    'msg' => 'Please verify your mobile number',
                    'phone_number' => $last_for_dgt
                    //'data' => $user
               ));
          } else {
               echo json_encode(array(
                    'status' => FALSE,
                    'msg' => 'Please enter phone number'
               ));
          }
     }

     function verifyphonenumber_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          if ((isset($params['uid']) && !empty($params['uid'])) && (isset($params['otp']) && !empty($params['otp']))) {
               $user = $this->advanced->verifyPhoneNumber($params['uid'], $params['otp']);
               if (!empty($user)) {
                    echo json_encode(array(
                         'status' => 'success',
                         'msg' => 'Your mobile number verified',
                         'data' => $user
                    ));
               } else {
                    echo json_encode(array(
                         'status' => false,
                         'msg' => 'Invalid otp entered',
                         'data' => ''
                    ));
               }
          } else {
               echo json_encode(array(
                    'status' => false,
                    'msg' => 'OTP or user id is empty'
               ));
          }
     }
     function verifyphonenumberNew_put()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          if ((isset($params['phone_number']) && !empty($params['phone_number'])) && (isset($params['otp']) && !empty($params['otp']))) {
               $user = $this->advanced->verifyPhoneNumberNew($params['phone_number'], $params['otp']);
               if (!empty($user)) {
                    $tkn = $this->generateJwtToken($user);
                    echo json_encode(array(
                         'status' => 'success',
                         'msg' => 'Your mobile number verified',
                         'Token' => $tkn
                         //'data' => $user
                    ));
               } else {
                    echo json_encode(array(
                         'status' => 'fail',
                         'msg' => 'Invalid otp entered',
                         'Token' => ''
                         //'data' => ''
                    ));
               }
          } else {
               echo json_encode(array(
                    'status' => 'fail',
                    'msg' => 'OTP or user id is empty'
               ));
          }
     }

     function appversions_get()
     {
          $ios = get_settings_by_key('app_ios_version');
          $and = get_settings_by_key('app_android_version');

          $iosLink = get_settings_by_key('app_ios_link');
          $andLink = get_settings_by_key('app_android_link');
          echo json_encode(array(
               'ios' => array('version' => $ios, 'status' => 1, 'link' => $iosLink),
               'android' => array('version' => $and, 'status' => 1, 'link' => $andLink)
          ));
     }

     function resendloginotp_post()
     {
          generate_log(array(
               'log_title' => 'jk-app-otp-resent',
               'log_desc' => 'jk-app-otp',
               'log_controller' => 'jk-app-otp-resent',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 111
          ));

          $params = json_decode(file_get_contents('php://input'), TRUE);
          if (isset($params['uid']) && !empty($params['uid'])) {

               $user = $this->advanced->resendLoginOTP($params['uid']);
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

     function updateuser_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          if (!empty($params)) {
               $this->advanced->updateuser($params);
               echo json_encode(array(
                    'status' => 'success',
                    'msg' => 'User updation completed'
               ));
          } else {
               echo json_encode(array(
                    'status' => 'fail',
                    'msg' => 'Faild to update user'
               ));
          }
     }

     function httpstest_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          print_r($params);
          echo json_encode($params);
     }

     function clrbridgingincomcallland_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridgingincomcallland_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          if (!isset($params['callerNumber'])) {
               echo json_encode("Not found callerNumber");
               exit;
          } else if (empty($params['callerNumber'])) {
               echo json_encode("callerNumber is empty");
               exit;
          }
          $datas['ccb_calledNumber'] = isset($params['calledNumber']) ? $params['calledNumber'] : '';
          $datas['ccb_callerNumber'] = isset($params['callerNumber']) ? trim(str_replace(' ', '', $params['callerNumber'])) : '';
          $datas['ccb_CallUUID'] = isset($params['CallUUID']) ? $params['CallUUID'] : '';
          //Category
          if (isset($params['calledNumber']) && ($params['calledNumber'] == '914844515945') || ($params['calledNumber'] == '4844515945')) {
               $datas['ccb_category'] = 2;
          } else if (isset($params['calledNumber']) && ($params['calledNumber'] == '914844515944') || ($params['calledNumber'] == '4844515944')) {
               $datas['ccb_category'] = 1;
          } else if (($params['calledNumber'] == '914844515943') || ($params['calledNumber'] == '4844515943')) {
               $datas['ccb_category'] = 7; // 24-2-2023
          } else if (($params['calledNumber'] == '914844515942') || ($params['calledNumber'] == '4844515942')) {
               $datas['ccb_category'] = 5;
          } else if (($params['calledNumber'] == '914844515900') || ($params['calledNumber'] == '4844515900')) {
               $datas['ccb_category'] = 6;
          } else if (($params['calledNumber'] == '914844515950') || ($params['calledNumber'] == '4844515950')) {
               $datas['ccb_category'] = 3; //Magazine
          }
          $this->advanced->clrbridgingincomcallland($datas);
          echo json_encode("success");
     }

     function clrbridgingcallanswdagent_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridgingcallanswdagent_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          if (!isset($params['callerNumber'])) {
               echo json_encode("Not found callerNumber");
               exit;
          } else if (empty($params['callerNumber'])) {
               echo json_encode("callerNumber is empty");
               exit;
          }
          $datas['ccb_AgentNumber'] = isset($params['AgentNumber']) ? $params['AgentNumber'] : '';
          $datas['ccb_callerNumber'] = isset($params['callerNumber']) ? trim(str_replace(' ', '', $params['callerNumber'])) : '';
          $datas['ccb_CallUUID'] = isset($params['CallUUID']) ? $params['CallUUID'] : '';
          if (isset($params['calledNumber'])) {
               if (($params['calledNumber'] == '914844515945') || ($params['calledNumber'] == '4844515945')) {
                    $datas['ccb_category'] = 2;
               } else if (($params['calledNumber'] == '914844515944') || ($params['calledNumber'] == '4844515944')) {
                    $datas['ccb_category'] = 1;
               } else if (($params['calledNumber'] == '914844515943') || ($params['calledNumber'] == '4844515943')) {
                    $datas['ccb_category'] = 7; // 24-2-2023
               } else if (($params['calledNumber'] == '914844515942') || ($params['calledNumber'] == '4844515942')) {
                    $datas['ccb_category'] = 5;
               } else if (($params['calledNumber'] == '914844515900') || ($params['calledNumber'] == '4844515900')) {
                    $datas['ccb_category'] = 6;
               } else if (($params['calledNumber'] == '914844515950') || ($params['calledNumber'] == '4844515950')) {
                    $datas['ccb_category'] = 3; //Magazine
               }
          }
          $this->advanced->clrbridgingcallanswdagent($datas);
          echo json_encode("success");
     }

     function clrbridgingcalldisconnected_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridgingcalldisconnected_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          $datas['ccb_AgentNumber'] = isset($params['AgentNumber']) ? $params['AgentNumber'] : '';
          $datas['ccb_CallUUID'] = isset($params['CallUUID']) ? $params['CallUUID'] : '';

          //$this->advanced->clrbridgingcalldisconnected($datas);
          echo json_encode("success");
     }

     function clrbridgingcallcallend_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;

          //Validation
          /*if(!isset($params['calledNumber'])) {
               echo json_encode("Not found calledNumber");exit;
            } else if(empty($params['calledNumber'])){
               echo json_encode("calledNumber is empty");exit;
            }

            if(!isset($params['callerNumber'])) {
               echo json_encode("Not found callerNumber");exit;
            } else if(empty($params['callerNumber'])){
               echo json_encode("callerNumber is empty");exit;
            }

            if(!isset($params['totalCallDuration'])) {
               echo json_encode("Not found totalCallDuration");exit;
            }

            if(!isset($params['callDate'])) {
               echo json_encode("Not found callDate");exit;
            } else if(empty($params['callDate'])){
               echo json_encode("callDate is empty");exit;
            }

            if(!isset($params['callStatus'])) {
               echo json_encode("Not found callStatus");exit;
            } else if(empty($params['callStatus'])){
               echo json_encode("callStatus is empty");exit;
            }

            if(!isset($params['recording_URL'])) {
               echo json_encode("Not found recording_URL");exit;
            } else if(empty($params['recording_URL'])){
               echo json_encode("recording_URL is empty");exit;
            }

            if(!isset($params['AgentNumber'])) {
               echo json_encode("Not found AgentNumber");exit;
            } 

            if(!isset($params['CallUUID'])) {
               echo json_encode("Not found CallUUID");exit;
            } else if(empty($params['CallUUID'])){
               echo json_encode("CallUUID is empty");exit;
            }

            if(!isset($params['callStartTime'])) {
               echo json_encode("Not found callStartTime");exit;
            } else if(empty($params['callStartTime'])){
               echo json_encode("callStartTime is empty");exit;
            }

            if(!isset($params['callEndTime'])) {
               echo json_encode("Not found callEndTime");exit;
            } else if(empty($params['callEndTime'])){
               echo json_encode("callEndTime is empty");exit;
            }

            if(!isset($params['conversationDuration'])) {
               echo json_encode("Not found conversationDuration");exit;
            } 

            if(!isset($params['dtmf'])) {
               echo json_encode("Not found dtmf");exit;
            } 

            if(!isset($params['transferredNumber'])) {
               echo json_encode("Not found transferredNumber");exit;
            } */
          //Validation

          $status = isset($params['callStatus']) ? strtolower(trim($params['callStatus'])) : null;
          $datas['ccb_callStatus_id'] = 0;
          if ($status == 'busy') {
               $datas['ccb_callStatus_id'] = VB_BUSY;
          } else if ($status == 'cancel') {
               $datas['ccb_callStatus_id'] = VB_CANCEL;
          } else if ($status == 'chanunavail') {
               $datas['ccb_callStatus_id'] = VB_CHANUNAVAIL;
          } else if ($status == 'congestion') {
               $datas['ccb_callStatus_id'] = VB_CONGESTION;
          } else if ($status == 'connected' || $status == 'answered') {
               $datas['ccb_callStatus_id'] = VB_CONNECTED;
          } else if ($status == 'noanswer') {
               $datas['ccb_callStatus_id'] = VB_NOANSWER;
          } else if ($status == 'not connected') {
               $datas['ccb_callStatus_id'] = VB_NOT_CONNECTED;
          }
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridgingcallcallend_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          $datas['ccb_calledNumber'] = isset($params['calledNumber']) ? $params['calledNumber'] : null;
          $datas['ccb_callerNumber'] = isset($params['callerNumber']) ? trim(str_replace(' ', '', $params['callerNumber'])) : null;
          $datas['ccb_totalCallDuration'] = isset($params['totalCallDuration']) ? $params['totalCallDuration'] : null;
          $datas['ccb_callDate'] = isset($params['callDate']) ? $params['callDate'] : null;
          $datas['ccb_callStatus'] = isset($params['callStatus']) ? $params['callStatus'] : null;
          $datas['ccb_recording_URL'] = isset($params['recording_URL']) ? $params['recording_URL'] : null;
          $datas['ccb_AgentNumber'] = isset($params['AgentNumber']) ? $params['AgentNumber'] : null;
          $datas['ccb_CallUUID'] = isset($params['CallUUID']) ? $params['CallUUID'] : null;
          $datas['ccb_callStartTime'] = isset($params['callStartTime']) ? $params['callStartTime'] : null;
          $datas['ccb_callEndTime'] = isset($params['callEndTime']) ? $params['callEndTime'] : null;
          $datas['ccb_conversationDuration'] = isset($params['conversationDuration']) ? $params['conversationDuration'] : null;
          $datas['ccb_dtmf'] = isset($params['dtmf']) ? $params['dtmf'] : null;
          $datas['ccb_transferredNumber'] = isset($params['transferredNumber']) ? $params['transferredNumber'] : 0;
          if (isset($params['calledNumber'])) {
               if (($params['calledNumber'] == '914844515945') || ($params['calledNumber'] == '4844515945')) {
                    $datas['ccb_category'] = 2;
               } else if (($params['calledNumber'] == '914844515944') || ($params['calledNumber'] == '4844515944')) {
                    $datas['ccb_category'] = 1;
               } else if (($params['calledNumber'] == '914844515943') || ($params['calledNumber'] == '4844515943')) {
                    $datas['ccb_category'] = 7; // 24-2-2023
               } else if (($params['calledNumber'] == '914844515942') || ($params['calledNumber'] == '4844515942')) {
                    $datas['ccb_category'] = 5;
               } else if (($params['calledNumber'] == '914844515900') || ($params['calledNumber'] == '4844515900')) {
                    $datas['ccb_category'] = 6;
               } else if (($params['calledNumber'] == '914844515950') || ($params['calledNumber'] == '4844515950')) {
                    $datas['ccb_category'] = 3; //Magazine
               }
          }
          $this->advanced->clrbridgingcallcallend($datas);
          echo json_encode("success");
     }

     function clrbridginginicallout_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridginginicallout_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          $datas['ccbo_extension'] = isset($params['extension']) ? $params['extension'] : null;
          $datas['ccbo_destination'] = isset($params['destination']) ? $params['destination'] : null;
          $datas['ccbo_callerid'] = isset($params['callerid']) ? $params['callerid'] : null;
          $datas['ccbo_callUUlD'] = isset($params['callUUlD']) ? $params['callUUlD'] : null;
          if (isset($params['calledNumber'])) {
               if (($params['calledNumber'] == '914844515945') || ($params['calledNumber'] == '4844515945')) {
                    $datas['ccb_category'] = 2;
               } else if (($params['calledNumber'] == '914844515944') || ($params['calledNumber'] == '4844515944')) {
                    $datas['ccb_category'] = 1;
               } else if (($params['calledNumber'] == '914844515943') || ($params['calledNumber'] == '4844515943')) {
                    $datas['ccb_category'] = 7; // 24-2-2023
               } else if (($params['calledNumber'] == '914844515942') || ($params['calledNumber'] == '4844515942')) {
                    $datas['ccb_category'] = 5;
               } else if (($params['calledNumber'] == '914844515900') || ($params['calledNumber'] == '4844515900')) {
                    $datas['ccb_category'] = 6;
               } else if (($params['calledNumber'] == '914844515950') || ($params['calledNumber'] == '4844515950')) {
                    $datas['ccb_category'] = 3;
               }
          }

          /*Status*/
          $status = isset($params['callStatus']) ? strtolower(trim($params['callStatus'])) : null;
          if ($status == 'busy') {
               $datas['ccbo_status_id'] = VB_BUSY;
          } else if ($status == 'cancel') {
               $datas['ccbo_status_id'] = VB_CANCEL;
          } else if ($status == 'chanunavail') {
               $datas['ccbo_status_id'] = VB_CHANUNAVAIL;
          } else if ($status == 'congestion') {
               $datas['ccbo_status_id'] = VB_CONGESTION;
          } else if ($status == 'connected' || $status == 'answered') {
               $datas['ccbo_status_id'] = VB_CONNECTED;
          } else if ($status == 'noanswer') {
               $datas['ccbo_status_id'] = VB_NOANSWER;
          } else if ($status == 'not connected') {
               $datas['ccbo_status_id'] = VB_NOT_CONNECTED;
          }
          /*Status*/

          $this->advanced->clrbridginginicallout($datas);
          echo json_encode("success");
     }

     function clrbridgingendoutcall_post()
     {
          $pstParams = json_decode(file_get_contents('php://input'), TRUE);
          $params = !empty($pstParams) ? $pstParams : $_POST;
          generate_log(array(
               'log_title' => 'Cal bridging',
               'log_desc' => serialize($params),
               'log_controller' => 'clrbridgingendoutcall_post',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0
          ));
          $paramsPst['ccbo_extension'] = isset($params['extension']) ? $params['extension'] : null;
          $paramsPst['ccbo_destination'] = isset($params['destination']) ? $params['destination'] : null;
          $paramsPst['ccbo_callerid'] = isset($params['callerid']) ? $params['callerid'] : null;
          $paramsPst['ccbo_duration'] = isset($params['duration']) ? $params['duration'] : null;
          $paramsPst['ccbo_status'] = isset($params['status']) ? $params['status'] : null;
          $paramsPst['ccbo_date'] = isset($params['date']) ? $params['date'] : null;
          $paramsPst['ccbo_recording_URL'] = isset($params['recording_URL']) ? $params['recording_URL'] : null;
          if (isset($params['calledNumber'])) {
               if (($params['calledNumber'] == '914844515945') || ($params['calledNumber'] == '4844515945')) {
                    $paramsPst['ccb_category'] = 2;
               } else if (($params['calledNumber'] == '914844515944') || ($params['calledNumber'] == '4844515944')) {
                    $paramsPst['ccb_category'] = 1;
               } else if (($params['calledNumber'] == '914844515943') || ($params['calledNumber'] == '4844515943')) {
                    $paramsPst['ccb_category'] = 7; // 24-2-2023
               } else if (($params['calledNumber'] == '914844515942') || ($params['calledNumber'] == '4844515942')) {
                    $paramsPst['ccb_category'] = 5;
               } else if (($params['calledNumber'] == '914844515900') || ($params['calledNumber'] == '4844515900')) {
                    $paramsPst['ccb_category'] = 6;
               } else if (($params['calledNumber'] == '914844515950') || ($params['calledNumber'] == '4844515950')) {
                    $paramsPst['ccb_category'] = 3;
               }
          }
          /*Status*/
          $status = isset($params['status']) ? strtolower(trim($params['status'])) : null;
          if ($status == 'busy') {
               $datas['ccbo_status_id'] = VB_BUSY;
          } else if ($status == 'cancel') {
               $datas['ccbo_status_id'] = VB_CANCEL;
          } else if ($status == 'chanunavail') {
               $datas['ccbo_status_id'] = VB_CHANUNAVAIL;
          } else if ($status == 'congestion') {
               $datas['ccbo_status_id'] = VB_CONGESTION;
          } else if ($status == 'connected' || $status == 'answered') {
               $datas['ccbo_status_id'] = VB_CONNECTED;
          } else if ($status == 'noanswer') {
               $datas['ccbo_status_id'] = VB_NOANSWER;
          } else if ($status == 'not connected') {
               $datas['ccbo_status_id'] = VB_NOT_CONNECTED;
          }
          /*Status*/
          $this->advanced->clrbridgingendoutcall($paramsPst);
          echo json_encode("success");
     }

     function getAllCars_get($id = '')
     {
          $data = $this->advanced->getAllCars($id);
          echo json_encode($data);
     }

     function getfueltypes_get()
     {
          $fuel['fueltypes'] = unserialize(FUAL);
          echo json_encode($fuel);
     }

     function emisettings_get()
     {
          $defTenure = get_settings_by_key('emi_def_tenure');
          $defPerLoanAmt = get_settings_by_key('emi_def_loan_amt_perce');
          $defPer = get_settings_by_key('emi_def_perce');
          echo json_encode(array('defTenure' => $defTenure, 'defPerLoanAmt' => $defPerLoanAmt, 'defPer' => $defPer));
     }

     function emicalculator_post()
     {
          $params = json_decode(file_get_contents('php://input'), TRUE);
          $data = $this->advanced->emicalculator($params);
          echo json_encode($data);
     }
     //jwt for testing//
     public function generateToken_get()
     { //for testing
          // debug(786);
          $tokenData['userId'] = '121';
          $tokenData['role'] = 'user';
          $tokenData['exp'] = time() + (60);
          $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
          $jwtToken = $this->objOfJwt->GenerateToken($tokenData);
          echo json_encode(array('Token' => $jwtToken));
     }
     public function getTokenData_get()
     { //for testing
          $received_Token = $this->input->request_headers('Authorization');
          try {
               $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
               echo json_encode($jwtData);
          } catch (Exception $e) {
               http_response_code('401');
               echo json_encode(array("status" => false, "message" => $e->getMessage()));
               exit;
          }
     }
     //End jwt//
     //jwt For production//
     public function generateJwtToken($tokenData)
     {     //for production
          // debug(786);
          //$tokenData['userId'] = '121';
          // $tokenData['role'] = 'user';
          $tokenData['exp'] = time() + (60);
          $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
          $jwtToken = $this->objOfJwt->GenerateToken($tokenData);
          return $jwtToken;
          //echo json_encode(array('Token' => $jwtToken));
     }
     public function getJwtTokenData()
     { //for production
          $received_Token = $this->input->request_headers('Authorization');
          //debug($received_Token);
          try {
               // $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
               $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
               echo json_encode($jwtData);
          } catch (Exception $e) {
               http_response_code('401');
               echo json_encode(array("status" => false, "message" => $e->getMessage()));
               exit;
          }
     }
     //End jwt//
     //career//
     function career_get()
     { //jsk
          // debug(777);
          $data['careers'] = $this->advanced->getCareerPosts();
          // debug($data);
          $data['districts'] = $this->advanced->getDistricts();
          // debug($data['districts']);
          echo json_encode(array('data' => $data));
          //  $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }
     function sendCareer_post()
     {


          $data = $this->input->post();
          //  print_r($data);
          //exit;
          if (!empty($data)) {
               $appliedFor = isset($data['cap_post']) ? $data['cap_post'] : '';
               $postDetails = $this->advanced->getCareerPosts($appliedFor);
               $carTitle = isset($postDetails['car_title']) ? $postDetails['car_title'] : '';

               $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));
               $newFileName = rand(9999999, 0) . $_FILES['attachment']['name'];
               //  $config['upload_path'] = BASEPATH . '../../assets/uploads/product/';
               //og $config['upload_path'] = './rdportal/assets/uploads/cv/';
               $config['upload_path'] = BASEPATH . '../../assets/uploads/cv/';
               $config['allowed_types'] = 'pdf|doc|docx';
               $config['file_name'] = $newFileName;
               $this->load->library('upload', $config);

               if (!$this->upload->do_upload('attachment')) {
                    $error = $this->upload->display_errors();
               } else {
                    $resUpload = $this->upload->data();
               }
               $data['cap_resume'] = isset($resUpload['file_name']) ? $resUpload['file_name'] : '';
               $this->advanced->newCareer($data);

               if (isset($resUpload['full_path'])) {
                    $this->email->attach($resUpload['full_path']);
               }

               $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>CV</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Post applied for</td>"
                    . "<td>" . $carTitle . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>First name</td>"
                    . "<td>" . $data['cap_fname'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Last name</td>"
                    . "<td>" . $data['cap_lname'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Phone</td>"
                    . "<td>" . $data['cap_mobile'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Email</td>"
                    . "<td>" . $data['cap_email'] . "</td>"
                    . "</tr>"
                    . "<td>Experience</td>"
                    . "<td>" . $data['cap_experience'] . "</td>"
                    . "</tr>"
                    . "</table>";

               $this->email->set_newline("\r\n");
               $this->email->to(EMAIL_CAREER);
               $this->email->subject('Career');
               $this->email->message($message);
               $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
               $this->email->from('admin@royaldrive.in', 'Career mail');
               if ($this->email->send()) {
                    echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
               } else {
                    echo json_encode(array('status' => 'success', 'msg' => 'Mail successfully sent!'));
               }

               //Ack
               $this->email->clear(true);
               $candidateMail = isset($data['cap_email']) ? $data['cap_email'] : '';
               $fName = isset($data['cap_fname']) ? $data['cap_fname'] : '';
               $lName = isset($data['cap_lname']) ? $data['cap_lname'] : '';
               $fullName = $fName . ' ' . $lName;


               if (!empty($appliedFor) && !empty($candidateMail) && !empty($postDetails)) {

                    $carLocation = isset($postDetails['car_location']) ? str_replace('&', ' or ', $postDetails['car_location']) : '';
                    $message = "Dear $fullName, <br>Thank you for applying for the position of - $carTitle, location $carLocation  Royal Drive Pre Owned Cars LLP  with  Royal Drive group of companies
                 We confirm that we have received your application and have forwarded it for review against the requirements for the role in which you have expressed interest.
                 Thank you for your interest in working with us. <br>
                 In case of any query, feel free to us at 91 81299 09090
                 <br><br><br><br><br><br><br><br><br><br><br>
                 Best Regards,<br>Royal Drive Recruitment Team";

                    $this->email->set_newline("\r\n");
                    $this->email->to($candidateMail);
                    $this->email->subject('Royal Drive - Your applied for the post of ' . $carTitle);
                    $this->email->message($message);
                    $this->email->reply_to('noreply@royaldrive.in', 'Royal Drive');
                    $this->email->from('hr@royaldrive.in', 'Contact mail');
                    $this->email->send();
               }
               //Ack

          } else {
               echo json_encode(array('status' => 'failed', 'msg' => 'Please fill form first!'));
          }
     }
     //@career//
     function book_veh_post()
     {

          $data = $this->input->post();

          if (!empty($data)) {

               if (!empty($_FILES) && (isset($_FILES['wb_pan_img']['name']) && !empty($_FILES['wb_pan_img']['name']))) {
                    $panFileName = 'pan-' . rand(9999999, 0) . $_FILES['wb_pan_img']['name'];
                    $data['wb_pan_img'] = $panFileName;
                    $data['wb_created_at'] = date('Y-m-d h:i:s');
                    // $config1['upload_path'] = './rdportal/assets/uploads/web_booking/';
                    //$config1['upload_path'] = BASEPATH . '../../assets/uploads/cv/';
                    $config1['upload_path'] = BASEPATH . '../../assets/uploads/product/';
                    $config1['allowed_types'] = 'jpg|jpeg|png|webp|pdf|dox|docx';
                    $config1['file_name'] = $panFileName;

                    $this->set_file_upload($config1, 'wb_pan_img');
               } else {
                    echo json_encode(array('status' => false, 'msg' => 'Please upload Pan card'));
                    exit;
               }
               if (!empty($_FILES) && (isset($_FILES['wb_adhaar_img']['name']) && !empty($_FILES['wb_adhaar_img']['name']))) {
                    $adhaarFileName = 'adhaar-' . rand(9999999, 0) . $_FILES['wb_adhaar_img']['name'];
                    $data['wb_adhaar_img'] = $adhaarFileName;
                    //$config2['upload_path'] = './rdportal/assets/uploads/web_booking/';
                    //$config2['upload_path'] = BASEPATH . '../../assets/uploads/cv/';
                    $config2['upload_path'] = BASEPATH . '../../assets/uploads/product/';
                    $config2['allowed_types'] = 'jpg|jpeg|png|webp|pdf|dox|docx';
                    $config2['file_name'] = $adhaarFileName;

                    $this->set_file_upload($config2, 'wb_adhaar_img');
               } else {
                    echo json_encode(array('status' => false, 'msg' => 'Please upload Adhaar card'));
                    exit;
               }
               $fdata = $this->upload->data();
               // debug($fdata);
               $this->advanced->newBooking($data);
               echo json_encode(array('status' => true, 'msg' => 'New Booking successfully added!'));
          } else {
               echo json_encode(array('status' => false, 'msg' => 'Please fill form first!'));
          }
     }
     function set_file_upload($conf, $file_name)
     {

          $this->load->library('upload');
          $this->upload->initialize($conf);
          if (!$this->upload->do_upload($file_name)) {
               $error = $this->upload->display_errors();
               echo json_encode(array('status' => false, 'msg' =>  $error));
               exit;
          }
          return true;
     }
     public function sell_your_vehicle_post()
     { //jsk
          $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params['device_meta']['device_name']);
          // debug($params['vehicle_info']['purchase_year']);
          //debug( $params['customer']['phone']);
          if (
               isset($params['customer']['phone']) && !empty($params['customer']['phone'])
          ) {
               $user = $this->advanced->sellYourVeh($params);

               echo json_encode(array(
                    'status' => TRUE,
                    'msg' => 'Product added successfully.',

               ));
          } else {
               echo json_encode(array(
                    'status' => FALSE,
                    'msg' => 'Please enter phone number'
               ));
          }
     }
     //
     public function contact_post()
     {
          header('Access-Control-Allow-Origin: *');
          header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
          header('Access-Control-Allow-Headers: Content-Type, Authorization');

          //jsk
          $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params);
          if (
               !isset($params['fname']) && empty($params['fname'])
          ) {

               echo json_encode(array(
                    'status' => FALSE,
                    'msg' => 'Please Enter First Name'
               ));
               ///////////

          } else if (($params['email']) && empty($params['email'])) {
               echo json_encode(array(
                    'status' => FALSE,
                    'msg' => 'Please Enter Email'
               ));
          } else {


               if (!empty($params)) {

                    $message = "<table>"
                         . "<tr>"
                         . "<th colspan='3'>Contact</th>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>First name</td>"
                         . "<td>" . $data['fname'] . "</td>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Last name</td>"
                         . "<td>" . $data['lname'] . "</td>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Phone</td>"
                         . "<td>" . $data['mobile'] . "</td>"
                         . "</tr>"
                         . "<tr>"
                         . "<td>Email</td>"
                         . "<td>" . $data['email'] . "</td>"
                         . "</tr>"
                         . "<td>Message</td>"
                         . "<td>" . $data['message'] . "</td>"
                         . "</tr>"
                         . "</table>";
                    $this->load->library('email', $this->mailConfig);
                    $this->email->set_newline("\r\n");
                    $this->email->to(EMAIL_CONTACT);
                    $this->email->subject('Contact');
                    $this->email->message($message);
                    $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                    $this->email->from('admin@royaldrive.in', 'Contact mail');
                    if ($this->email->send()) {
                         echo json_encode(array('status' => TRUE, 'msg' => 'Mail successfully sent!'));
                    } else {
                         echo json_encode(array('status' => FALSE, 'msg' => 'Mail not successfully sent'));
                    }
               } else {
                    echo json_encode(array('status' => FALSE, 'msg' => 'Please fill form first!'));
               }
          }
     }

     public function subscribe_post()
     { //jsk
          header('Access-Control-Allow-Origin: *');
          header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
          header('Access-Control-Allow-Headers: Content-Type, Authorization');

          $params = json_decode(file_get_contents('php://input'), TRUE);
          //debug($params);
          $res = $this->advanced->saveSubscription($params);
          if ($res) {
               echo json_encode(array(
                    'status' => TRUE,
                    'msg' => 'successfully Subscribed'
               ));
          } else {
               echo json_encode(array(
                    'status' => FALSE,
                    'msg' => 'Subscription not successfull'
               ));
          }
     }
}
