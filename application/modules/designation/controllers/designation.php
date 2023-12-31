<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class designation extends App_Controller {

     public function __construct() {

          parent::__construct();
          $this->page_title = 'Designation';
          $this->load->library('form_validation');
          $this->load->model('designation_model', 'designation');
     }

     public function index() {
          $accessories['data'] = $this->designation->getData();
          $this->render_page(strtolower(__CLASS__) . '/list', $accessories);
     }

     public function add() {
          if (!empty($_POST)) {
               if ($this->designation->addData($_POST)) {
                    $this->session->set_flashdata('app_success', 'Division successfully added!');
               } else {
                    $this->session->set_flashdata('app_error', "Can't add division!");
               }
               redirect(strtolower(__CLASS__));
          } else {
               $data['designation'] = $this->designation->getData();
               $data['travelModes'] = $this->designation->getTravelModes();
               $this->render_page(strtolower(__CLASS__) . '/add', $data);
          }
     }

     public function view($id) {
          $accessories['data'] = $this->designation->getData($id);
          $accessories['travelModes'] = $this->designation->getTravelModes();
          $this->render_page(strtolower(__CLASS__) . '/view', $accessories);
     }

     public function update() {
          if ($this->designation->updateData($_POST)) {
               $this->session->set_flashdata('app_success', 'Update successfully!');
          } else {
               $this->session->set_flashdata('app_error', "Can't update!");
          }
          redirect(strtolower(__CLASS__));
     }

     public function delete($id) {
          if ($this->designation->deleteData($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Delete successfully'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete"));
          }
     }

}
