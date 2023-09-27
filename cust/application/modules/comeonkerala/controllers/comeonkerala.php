<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class comeonkerala extends App_Controller {

     public function __construct() {

          parent::__construct();
          $this->page_title = 'Come on Kerala | sharjah events 2022';
          $this->load->model('comeonkerala_model');
          $this->template->set_layout('comeonkerala');
     }

     function index($authId = 0) {
          header("Location: https://www.royaldrive.in");
          exit;
          // if($_POST) {
          // debug($_POST, 0);
          // debug($_FILES);
          // }
          if(!empty($authId)) {
               $datas['author'] = $this->comeonkerala_model->getUserDetails($authId);
          }
          if (!empty($_POST)) {
               //debug($_POST);
               generate_log(array(
                   'log_title' => 'Create new enquiry',
                   'log_desc' => serialize($_POST),
                   'log_controller' => 'comeonkerala-create-enq',
                   'log_action' => 'R',
                   'log_ref_id' => 49090,
                   'log_added_by' => 0
               ));
               if (!$this->comeonkerala_model->checkIfExists($_POST)) {
                    if (isset($_FILES['audio_data']['name']) && !empty($_FILES['audio_data']['name'])) {
                         $_POST['eve_audio'] = $newFileName = rand(9999999999, 0) . '-' . $_POST['eve_mobile_non_india'] . '.wav';
                         $config['upload_path'] = './assets/uploads/comeonkerala/';
                         $config['allowed_types'] = '*';
                         $config['file_name'] = $newFileName;
                         $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('audio_data')) {
                              $resUpload = $this->upload->display_errors();
                         } else {
                              $resUpload = $this->upload->data();
                         }
                    }
                    $this->comeonkerala_model->create($_POST);
                    $this->session->set_flashdata('app_success', 'New enguiry successfully added!');
                    if(isset($_GET['ajax'])) {
                         echo "New enguiry successfully added!";
                         exit;
                    } else {
                         $id = isset($_POST['eve_auther_id']) ? $_POST['eve_auther_id'] : 0;
                         redirect('comeonkerala/index/' . $id);
                    }
               } else {
                    $this->session->set_flashdata('app_success', 'You already registered!');
               }
          }
          if(empty($authId)) {
               redirect('comeonkerala/lucky-draw');
          }
          $datas['auth'] = $authId;
          $this->render_page(strtolower(__CLASS__) . '/index', $datas);
     }

     function success() {
          $this->render_page(strtolower(__CLASS__) . '/success');
     }

     function lucky_draw() {
          if (!empty($_POST)) {
               generate_log(array(
                   'log_title' => 'Create new enquiry',
                   'log_desc' => serialize($_POST),
                   'log_controller' => 'lucky-draw-create-enq-before-ins',
                   'log_action' => 'R',
                   'log_ref_id' => 9876,
                   'log_added_by' => 0
               ));
               $refId = $this->comeonkerala_model->luckyDraw($_POST);
               $_POST['refId'] = $refId;
               generate_log(array(
                   'log_title' => 'Create new enquiry',
                   'log_desc' => serialize($_POST),
                   'log_controller' => 'lucky-draw-create-enq',
                   'log_action' => 'R',
                   'log_ref_id' => $refId,
                   'log_added_by' => 0
               ));
               redirect(__CLASS__ . '/coupon/' . encrypt($refId));
          } else {
               $this->template->set_layout('comeonkerala');
               $this->render_page(strtolower(__CLASS__) . '/lucky_draw');
          }
     }

     function coupon($id) {
          $id = encrypt($id, 'D');
          $details = $this->comeonkerala_model->getTicket($id);
          $this->render_page(strtolower(__CLASS__) . '/coupon', $details);
     }
     
     function downloadTicket($id) {
          $id = encrypt($id, 'D');
          $details = $this->comeonkerala_model->getTicket($id);
          $this->render_page(strtolower(__CLASS__) . '/coupon', $details);
     }
}