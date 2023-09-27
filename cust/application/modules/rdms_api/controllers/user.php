<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class user extends REST_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->model('user_model');
          $this->load->model('ion_auth_model', 'ion_auth');
     }

     public function login_post()
     {

          $this->page_title = 'Royaldrive | RDportal Login';

          $this->current_section = 'login';

          // validate form input
          $this->form_validation->set_rules('identity', 'Email', 'required');
          $this->form_validation->set_rules('password', 'Password', 'required');

          if ($this->form_validation->run() == true) {
               // check to see if the user is logging in
               // check for "remember me"
               $remember = (bool) $this->input->post('remember');

               if ($user = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    generate_log(array(
                         'log_title' => 'login',
                         'log_desc' => serialize($_POST),
                         'log_controller' => 'staff-login',
                         'log_action' => 'R',
                         'log_ref_id' => 101,
                         'log_added_by' => 0
                    ));
                    $usr_acc = $this->ion_auth->getUserPermission($user->usr_id);
                    $usr_acc = $usr_acc['cua_access'];
                    $usr_acc = unserialize($usr_acc);
                    $resp = array('user_id' => $user->usr_id, 'group_id' => $user->group_id, 'grp_slug' => $user->grp_slug, 'usr_showroom' => $user->usr_showroom, 'email' => $user->usr_email, 'user_name' => $user->usr_username, 'first_name' => $user->usr_first_name, 'last_name' => $user->usr_last_name, 'phone' => $user->usr_phone, 'key_token' => $user->usr_api_key, 'user_access' => $usr_acc);
                    echo json_encode(array('message' => 'Successfully loggedin', 'error' => false, 'data' => $resp));
               } else {
                    echo json_encode(array('message' => 'invalid data', 'error' => true, 'data' => ''));
               }
          } else {
               // the user is not logging in so display the login page
               // set the flash data error message if there is one
               $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
               $data['identity'] = array(
                    'name' => 'identity',
                    'id' => 'identity',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('identity'),
                    'class' => 'form-control',
                    'placeholder' => 'Username'
               );
               $data['password'] = array(
                    'name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                    'class' => 'form-control',
                    'placeholder' => 'Password'
               );
               echo json_encode(array('message' => strip_tags($data['message']), 'error' => true, 'data' => ''));
          }
     }
}
