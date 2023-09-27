<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class User extends App_Controller {

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

            /* Load title, css, js etc... */
            $this->page_title = "Login or register | " . STATIC_TITLE;
            $this->page_meta_keywords = '';
            $this->page_meta_description = '';
            /* Load title, css, js etc... */
            $this->load->model('user_model');
            $this->load->model('vehicle/vehicle_model', 'vehicle_model');
       }

       public function login() {
            $this->page_title = "Login | " . STATIC_TITLE;
            $this->render_page(strtolower(__CLASS__) . '/login');
       }

       public function doLogin() {
            $callBack = isset($_POST['txtCallBack']) ? $_POST['txtCallBack'] : 'home';
            
            if ($this->user_model->checkLogin($this->input->post())) {
                 $this->user_model->newUserLog();
                 $logedUserDetails = $this->session->userdata('gtech_logged_user');
                 $logedUserName = isset($logedUserDetails['first_name']) ? $logedUserDetails['first_name'] : '';
                 $this->session->set_flashdata('app_success', 'Welcome ' . $logedUserName . ' you are successfully logged in');
                 redirect(strtolower($callBack));
            } else {
                 $this->session->set_flashdata('app_error', 'The email/password combination you entered is incorrect.!');
                 redirect(strtolower($callBack));
            }
            $referrer = $this->session->userdata('referrer');
            if (!empty($referrer)) {
                 redirect($referrer);
            }
            redirect(strtolower($callBack)); 
       }

       public function logout() {
            $this->session->unset_userdata('gtech_logged_user');
            $this->session->unset_userdata('referrer');
            $this->session->set_flashdata('app_success', 'Logout successfully!');
            $this->session->set_userdata('redirect_after_login', 'home');
            $this->load->library('cart');
            $this->cart->destroy();
            redirect(strtolower('home'));
       }

       function successLogin() {
            $this->session->set_flashdata('app_success', 'Login successfully!');
            $secion = $this->session->userdata('redirect_after_login');
            $this->session->set_userdata('redirect_after_login', 'home');
            if ($secion == 'checkout') {
                 redirect(strtolower('cart/checkout'));
            } elseif ($secion == 'myaccount') {
                 redirect(strtolower('user/myaccount'));
            } else {
                 redirect(strtolower('home'));
            }
       }

       public function register() {
            $this->page_title = "Register | " . STATIC_TITLE;
            $this->render_page(strtolower(__CLASS__) . '/register');
       }

       public function doRegister() {
            if (!$this->user_model->getUserByEmail($this->input->post('email'))) {
                 if ($this->user_model->newUser($this->input->post())) {
                      $this->session->set_flashdata('app_success', 'Your Registration successfully completed.');

//                      $mesage = $this->load->view('user/register_template', $this->input->post(), true);
//                      $this->load->library('email');
//                      $config['charset'] = 'iso-8859-1';
//                      $config['wordwrap'] = TRUE;
//                      $config['mailtype'] = 'html';
//                      $this->email->initialize($config);
//                      $this->email->from(MAILID_REGISTRATION, MAIL_FROM_NAME);
//                      $this->email->to($_POST['email']);
//                      $this->email->reply_to('noreply@generaltech.com');
//                      $this->email->subject('User Registration');
//                      $this->email->message($mesage);
//
//                      //Mail api
//                      $mailAPI = array(
//                          "from" => MAILID_REGISTRATION,
//                          "from_name" => MAIL_FROM_NAME,
//                          "to" => $_POST['email'],
//                          "to_name" => '',
//                          "replyto" => 'noreply@gentech@eim.ae',
//                          "replyto_name" => 'noreply@gentech@eim.ae',
//                          "subject" => 'User Registration',
//                          "message" => str_replace('&nbsp;', '', $mesage),
//                          'section' => 'default'
//                      );
//                      if ($this->email->send() || post_to_url("http://www.gcctrader.com/ohrahmanform/API/mail.php", $mailAPI)) {
//                           echo json_encode(array('status' => 'success', 'msg' => 'Registration successfully completed!'));
//                      } else {
//                           echo json_encode(array('status' => 'failed', 'msg' => 'Registration failed!'));
//                      }
                 } else {
                      $this->session->set_flashdata('app_error', 'Registration failed!');
                 }
            } else {
                 $this->session->set_flashdata('app_error', 'Email already exists!');
            }
            redirect(strtolower('home'));
       }

       public function userAlreadyRegistered() {
            if ($this->user_model->getUserByEmail($this->input->post('email'))) {
                 echo 'false';
            } else {
                 echo 'true';
            }
       }

       function forgot_password() {
            $this->page_title = "Forgot Password | General Tech Services LLC -" . STATIC_TITLE;
            $this->render_page(strtolower(__CLASS__) . '/forgot_password');
       }

       function doForgotPassword() {
            $email = $this->input->post('email');
            if ($email) {
                 $user = $this->user_model->getUserByEmail($email);
                 if (!empty($user)) {

                      $templateArray = array(
                          'password' => get_original_password($user['password']),
                          'email' => $email,
                          'first_name' => $user['first_name'],
                          'last_name' => $user['last_name']
                      );
                      $mesage = $this->load->view('user/forgot_password_template', $templateArray, true);

                      $this->load->library('email', $this->mailConfig);
                      $this->email->set_newline("\r\n");
                      $this->email->to($email);
                      $this->email->subject('Forgot password');
                      $this->email->message($mesage);
                      $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                      $this->email->from('admin@royaldrive.in', 'Contact mail');
                      if ($this->email->send()) {
                           echo json_encode(array('status' => 'success', 'msg' => 'Your password has been sent to email'));
                      } else {
                           echo json_encode(array('status' => 'failed', 'msg' => 'Failed to send details.'));
                      }
                 } else {
                      echo json_encode(array('status' => 'failed', 'msg' => 'No user associated with this email.'));
                 }
            }
       }

       public function myaccount($section = '', $addid = '') {

            $this->page_title = "My Account | " . STATIC_TITLE;

            $this->assets_css = array('reset.css', 'header_footer.css', 'style.css',
                'meanmenu.css', 'bootstrap.min.css', 'main.css', 'responsive.css', 'myaccount.css', 'component.css', 'metro.css');

            $this->assets_js = array('jquery.validate.min.js', 'easyResponsiveTabs.js');
            if (check_login()) {
                 $data['logedUser'] = get_logged_user();
                 $data['section'] = $section;
                 $data['addid'] = $addid;
                 $data['addToEdit'] = ($addid) ? $this->user_model->getAddress($addid) : null;
                 $data['myUploads'] = $this->vehicle_model->getMyVehicles();
                 $this->render_page(strtolower(__CLASS__) . '/myaccount', $data);
            } else {
                 $this->session->set_flashdata('app_success', 'Please login first!');
                 $this->session->set_userdata('redirect_after_login', 'myaccount');
                 redirect(strtolower('user/login'));
            }
       }

       public function checkValidPassword() {
            if (check_login()) {
                 $old_password = $this->input->post('old_password');
                 $logedUser = $this->session->userdata('gtech_logged_user');
                 $userDetails = $this->user_model->getUser($logedUser['id']);
                 $userpass = $userDetails['password'];
                 if ($userpass == get_hashed_password($old_password)) {
                      echo 'true';
                 } else {
                      echo 'false';
                 }
            } else {
                 echo 'false';
            }
       }

       public function updateAccountInfo() {
            if (check_login()) {
                 $updateArray = array();
                 $newPassword = get_hashed_password($this->input->post('password'));
                 $oldPasswordUserEntered = get_hashed_password($this->input->post('old_password'));

                 $logedUser = $this->session->userdata('gtech_logged_user');
                 $userDetails = $this->user_model->getUser($logedUser['id']);
                 $oldPassword = $userDetails['password'];

                 if (empty($newPassword)) {
                      $updateArray = array(
                          'first_name' => $this->input->post('first_name'),
                          'last_name' => $this->input->post('last_name'),
                          'email' => $this->input->post('email')
                      );
                 } else {
                      if ($oldPasswordUserEntered == $oldPassword) {
                           $updateArray = array(
                               'first_name' => $this->input->post('first_name'),
                               'last_name' => $this->input->post('last_name'),
                               'email' => $this->input->post('email'),
                               'password' => $newPassword
                           );
                      }
                 }
                 if (!empty($updateArray)) {
                      if ($this->user_model->editUser($updateArray, $logedUser['id'])) {

                           echo json_encode(array('status' => 'success', 'msg' => 'The account information has been saved successfully'));
                      } else {
                           echo json_encode(array('status' => 'failed', 'msg' => "Can't update user information"));
                      }
                 }
            } else {
                 echo json_encode(array('status' => 'failed', 'msg' => 'Your not logged in'));
            }
       }

       function newAddress() {
            $logedUser = $this->session->userdata('gtech_logged_user');
            if ($this->user_model->addNewAddress($this->input->post(), $logedUser['id'])) {
                 $this->session->set_flashdata('app_success', 'New address added!');
                 redirect(strtolower('user/myaccount/3'));
            }
       }

       function updateAddress() {
            if ($this->user_model->updateAddress($this->input->post())) {
                 $this->session->set_flashdata('app_success', 'Address updated!');
                 redirect(strtolower('user/myaccount/3'));
            } else {
                 $this->session->set_flashdata('app_success', "Can't update address!");
                 redirect(strtolower('user/myaccount/3'));
            }
       }

       function deleteAddress() {
            $id = $this->input->post('id');
            if ($id) {
                 if ($this->user_model->deleteAddress($id)) {
                      echo json_encode(array('status' => 'success', 'msg' => 'Deleted successfully'));
                 } else {
                      echo json_encode(array('status' => 'failed', 'msg' => "Can't delete this address"));
                 }
            }
       }

       function order_details($id) {
            $this->page_title = "Order Details | General Tech Services LLC -" . STATIC_TITLE;
            if ($id) {
                 $orderInfo = $this->user_model->getOrder(get_logged_user('id'), $id);
                 $this->render_page(strtolower(__CLASS__) . '/order_details', $orderInfo);
            }
       }

       function update_my_vehicle($id) {
            $this->load->model('sell_your_vehicle/sell_your_vehicle_model', 'sell_your_vehicle_model');
            $this->load->model('home/home_model', 'home_model');
            $this->load->model('vehicle/vehicle_model', 'vehicle_model');

            $data['brands'] = $this->home_model->getBrands();
            $data['features'] = $this->sell_your_vehicle_model->getFeatures();
            $data['myvehicle'] = $this->vehicle_model->getVehicle($id);
            $brandId = isset($data['myvehicle']['prd_brand']) ? $data['myvehicle']['prd_brand'] : '';
            $variantId = isset($data['myvehicle']['prd_model']) ? $data['myvehicle']['prd_model'] : '';

            $data['model'] = $this->sell_your_vehicle_model->getModelByBrand($brandId);
            $data['variant'] = $this->sell_your_vehicle_model->getVariantByModel($variantId);
            $this->render_page(strtolower(__CLASS__) . '/update_my_vehicle', $data);
       }

  }
  