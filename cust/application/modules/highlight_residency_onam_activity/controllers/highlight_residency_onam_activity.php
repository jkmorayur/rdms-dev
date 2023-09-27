<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class highlight_residency_onam_activity extends App_Controller {

     public function __construct() {

          parent::__construct();
          $this->page_title = 'Highlight residency onam activity';
          $this->load->model('comeonkerala_model');
          $this->template->set_layout('comeonkerala');
     }

     function index($authId = 0) {
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
                   'log_controller' => 'highlight-residency-onam-activity',
                   'log_action' => 'R',
                   'log_ref_id' => 49091,
                   'log_added_by' => 0
               ));
               
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
               $this->session->set_flashdata('app_success', 'New enguiry successfully created!');
               if(isset($_GET['ajax'])) {
                    echo "New enguiry successfully created!";
                    exit;
               } else {
                    redirect(strtolower(__CLASS__) . '/index/');
               }
          }
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