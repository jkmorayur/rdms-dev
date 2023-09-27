<?php

defined('BASEPATH') or exit('No direct script access allowed');

class insurance extends App_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->model('insurance_model', 'insurance');
          $this->load->model('evaluation/evaluation_model', 'evaluation');
     }

     public function index()
     {
          $data['stockVehicle'] = $this->insurance->getData();
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }

     public function update($id = '')
     {
          if (!empty($_POST)) {
               if ($this->model->update($_POST)) {
                    $this->session->set_flashdata('app_success', 'Color successfully added!');
               } else {
                    $this->session->set_flashdata('app_error', "Can't add Color!");
               }
               redirect(strtolower(__CLASS__));
          } elseif ($id) {
               // debug($id);
               $id = encryptor($id, 'D');
               //$data['vc_id'] = $id;
               //$data['item'] = $this->model->selectData($id);
               $data['bottleNeck'] = $this->model->edit($id);
               // debug($data);
               $this->render_page(strtolower(__CLASS__) . '/edit', $data);
          }
     }

     public function delete($id)
     {
          if ($this->model->delete($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Color successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete Color"));
          }
     }

     public function add()
     {
          if (!empty($_POST)) {
               if ($this->model->insert($_POST)) {
                    $this->session->set_flashdata('app_success', 'Color successfully added!');
               } else {
                    $this->session->set_flashdata('app_error', "Can't add Color!");
               }
               redirect(strtolower(__CLASS__));
          } else {
               $this->render_page(strtolower(__CLASS__) . '/add');
          }
     }
     public function requests()
     { //unsolved
          $data['bottleNecks'] = $this->model->getUnsolvedReqData();
          $this->render_page(strtolower(__CLASS__) . '/requests', $data);
     }
     public function solved_requests()
     { //unsolved
          $data['bottleNecks'] = $this->model->getSolvedReqData();
          $this->render_page(strtolower(__CLASS__) . '/requests_solved', $data);
     }

     function updateins($id = 0)
     {
          if (!empty($_POST)) {
               //debug($_POST, 0);
               //debug($_FILES);
               //Upload documents
               $this->load->library('upload');
               if (isset($_FILES['documents']['name'][0]) && !empty($_FILES['documents']['name'][0]) && is_array($_FILES['documents']['name'])) {
                    foreach ($_FILES['documents']['name'] as $key => $value) {
                         $newFileName = rand() . $_FILES['documents']['name'][$key];
                         $config['upload_path'] = '../rdms/assets/uploads/evaluation/';
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
                                   $docs['vdoc_val_id'] = $_POST['val_id'];
                                   $docs['vdoc_doc'] = $uploadData['file_name'];
                                   $docs['vdoc_doc_title'] = isset($_POST['document_title']) ? $_POST['document_title'] : '';
                                   $docs['vdoc_doc_type'] = isset($_POST['document_type']) ? $_POST['document_type'] : '';
                                   $this->evaluation->newEvaluationDocument($docs);
                              }
                         } else {
                              $f = $this->upload->display_errors();
                              debug($f);
                         }
                    }
               }
               unset($_POST['document_type']);
               unset($_POST['document_title']);

               $this->insurance->updateins($_POST);
               $this->session->set_flashdata('app_success', 'Insurance renewal successfully completed!');
               redirect(strtolower(__CLASS__));
          } else {
               $id = encryptor($id, 'D');
               $data['stockVehicle'] = $this->insurance->getData($id);
               $this->render_page(strtolower(__CLASS__) . '/updateins', $data);
          }
     }

     function stockVehicle()
     {
          // $data['stockVehicle'] = $this->insurance->stockVehicle();
          // $this->render_page(strtolower(__CLASS__) . '/index', $data);
          $this->render_page(strtolower(__CLASS__) . '/index2', $data);
     }

     function updateinss($id = 0)
     {
          if (!empty($_POST)) {

               //Upload documents
               if (
                    isset($_FILES['documents']['name'][0]) && !empty($_FILES['documents']['name'][0]) &&
                    is_array($_FILES['documents']['name'])
               ) {
                    foreach ($_FILES['documents']['name'] as $key => $value) {
                         $newFileName = rand() . $_FILES['documents']['name'][$key];
                         $config['upload_path'] = '../rdms/assets/uploads/evaluation/';
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
                                   $docs['vdoc_val_id'] = $_POST['val_id'];
                                   $docs['vdoc_doc'] = $uploadData['file_name'];
                                   $docs['vdoc_doc_title'] = isset($_POST['document_title']) ? $_POST['document_title'] : '';
                                   $docs['vdoc_doc_type'] = isset($_POST['document_type']) ? $_POST['document_type'] : '';
                                   $this->evaluation->newEvaluationDocument($docs);
                              }
                         } else {
                              $f = $this->upload->display_errors();
                              debug($f);
                         }
                    }
               }
               unset($_POST['document_type']);
               unset($_POST['document_title']);
               $this->insurance->updateins($_POST);
          }
          $id = encryptor($id, 'D');
          $data['stockVehicle'] = $this->insurance->getData($id);
          $this->render_page(strtolower(__CLASS__) . '/updateinss', $data);
     }

     function insurancepending()
     {
          $data['stockVehicle'] = $this->insurance->insurancePending();
          $this->render_page(strtolower(__CLASS__) . '/insurancepending', $data);
     }
     public function stock_list() {
          $this->render_page(strtolower(__CLASS__) . '/index2', $data);
     }
     function stock_ajax() {
             $response = $this->insurance->stockVehiclePaginate($this->input->post());
echo json_encode($response);
             exit;
        }
}
