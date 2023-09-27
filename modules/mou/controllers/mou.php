<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class mou extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->page_title = 'MOU Generation';
            $this->load->model('mou_model', 'mou');
            $this->load->library('form_validation');
            $this->load->model('enquiry/enquiry_model', 'enquiry');
            $this->load->model('divisions/divisions_model', 'divisions');
            $this->load->model('registration/registration_model', 'registration');
       }

       public function index() {
            $datas['moulist'] = $this->mou->getAllRecords();
            $this->render_page(strtolower(__CLASS__) . '/list', $datas);
       }

       /*public function export($id) {
            $data['datas'] = $this->mou->getMou($id);
            $data['view'] = $this->load->view(strtolower(__CLASS__) . '/print', $data, true);
            //$this->render_page(strtolower(__CLASS__) . '/mouprint', $data);
            $this->load->library('M_pdf');
            $pdfFilePath = "product_spec.pdf";
            $this->m_pdf->pdf->WriteHTML($data['view']);
            $this->m_pdf->pdf->Output($pdfFilePath, 'D');
       }*/

       public function view($id) {
            $data['id'] = $id;
            $id = encryptor($id, 'D');
            $this->template->set_layout('mou');
            $data['datas'] = $this->mou->getMou($id);
            $data['view'] = $this->load->view(strtolower(__CLASS__) . '/print', $data, true);
            $this->render_page(strtolower(__CLASS__) . '/mou', $data);
       }

       function approval($id) {
            $id = encryptor($id, 'D');
            if ($f = $this->mou->approval($id)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Product status successfully changed'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't change product status"));
            }
       }

       public function add() {
            if (!empty($_POST)) {
                 $data = array();
                 if ($this->mou->addNewMOU($_POST)) {
                      $this->session->set_flashdata('app_success', 'accessories successfully added!');
                 } else {
                      $this->session->set_flashdata('app_error', "Can't add accessories!");
                 }
                 redirect(strtolower(__CLASS__));
            } else {
                 $states = [18, 0];
                 $data['identComponent'] = unserialize(MOU_VEH_IDENT_COMPONENTS);
                 $data['districts'] = $this->registration->getDistricts($states);
                 $data['purchaseStaff'] = $this->mou->getPurchaseStaff();
                 $data['brand'] = $this->enquiry->getBrands();
                 $data['division'] = $this->divisions->getActiveData();
                 $this->render_page(strtolower(__CLASS__) . '/add', $data);
            }
       }
  }