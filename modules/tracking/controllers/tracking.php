<?php

defined('BASEPATH') or exit('No direct script access allowed');

class tracking extends App_Controller
{

     public function __construct()
     {

          parent::__construct();
          $this->page_title = 'Vehcle Tracking';
          $this->load->model('evaluation/evaluation_model', 'evaluation');
          $this->load->model('emp_details/emp_details_model', 'employees');
          $this->load->model('showroom/showroom_model', 'showroom');
          $this->load->model('tracking_model', 'tracking');
     }

     public function index()
     {

          $this->render_page(strtolower(__CLASS__) . '/list', $data);
     }
     public function list_ajax()
     {
$response = $this->tracking->getTrackingPaginate($this->input->post());
     echo json_encode($response);
     }
     

     function out_pass()
     {
          if (!empty($_POST)) {
               if ($id = $this->tracking->insert($_POST)) {
                    $this->session->set_flashdata('app_success', 'Tracking successfully completed!');
               } else {
                    $this->session->set_flashdata('app_error', 'Error occured!');
               }
               redirect(strtolower(__CLASS__) . '/generateOutPass/' . encryptor($id));
          } else {
               $data['showrooms'] = $this->showroom->get();
               $data['vehicles'] = $this->tracking->getEvaluation();
               $data['stafs'] = $this->employees->getAllEmployees();
               $this->render_page(strtolower(__CLASS__) . '/out_pass', $data);
          }
     }

     function check_in($id = '')
     {
          if (!empty($_POST)) {
               if ($this->tracking->checkinVehicle($_POST['checkin'])) {
                    $this->session->set_flashdata('app_success', 'Check in successfully completed!');
               } else {
                    $this->session->set_flashdata('app_error', 'Error occured!');
               }
               redirect(strtolower(__CLASS__));
          } else if (!empty($id)) {
               $id = encryptor($id, 'D');
               $data['showrooms'] = $this->showroom->get();
               $data['trackingVehicles'] = $this->tracking->getTracking($id);
               $data['vehicles'] = $this->tracking->getVehicles();
               $data['stafs'] = $this->employees->getAllEmployees();
               $this->render_page(strtolower(__CLASS__) . '/check_in', $data);
          }
     }

     function generateOutPass($id)
     {
          if (!empty($id)) {
               //header('Content-Type: application/pdf');
               $showroomId = get_logged_user('usr_showroom');
               $showroom = $this->showroom->get($showroomId);
               $id = encryptor($id, 'D');
               $data['trackingVehicles'] = $this->tracking->getTracking($id);
               $data['showRoom'] = $showroom;
               $filename = "out-pass-" . time() . ".pdf";
               $html = $this->load->view('temp_out_pass', $data, true);
               $this->load->library('m_pdf');
               $this->m_pdf->pdf->WriteHTML($html);

               $vehicleNumber = isset($data['trackingVehicles']['val_veh_no']) ? $data['trackingVehicles']['val_veh_no'] : '';
               $this->m_pdf->pdf->SetTitle('Gate pass for vehicle ' . $vehicleNumber);
               $this->m_pdf->pdf->Output("./assets/uploads/outpass/" . $filename, "I");
          }
     }

     function update($id = '')
     {

          if (!empty($id)) {
               $id = encryptor($id, 'D');
               $data['trackingVehicles'] = $this->tracking->getTracking($id);
               $data['vehicles'] = $this->evaluation->getEvaluation();
               $data['stafs'] = $this->employees->getAllEmployees();
               $data['showrooms'] = $this->showroom->get();
               $this->render_page(strtolower(__CLASS__) . '/view', $data);
          } else if (!empty($_POST)) {
               if ($this->uid == 358) {
                    debug($_POST);
               }
               if ($this->tracking->update($_POST)) {
                    $this->session->set_flashdata('app_success', 'Tracking successfully updated!');
               } else {
                    $this->session->set_flashdata('app_error', 'Error occured!');
               }
               redirect(strtolower(__CLASS__));
          }
     }

     function trackingLog($vehId)
     {
          //            $vehId = encryptor($vehId, 'D');
          //            $data['vehicleTrackLog'] = $this->tracking->getTrackingByVehicleId($vehId);
          //            if (empty($data['vehicleTrackLog'])) {
          //                 $data['evaliationDetails'] = $this->evaluation->getEvaluation($vehId);
          //                 $this->render_page(strtolower(__CLASS__) . '/vehicleCurrentLocation', $data);
          //            } else {
          //                 $this->render_page(strtolower(__CLASS__) . '/trackingLog', $data);
          //            }
          $vehId = encryptor($vehId, 'D');
          $data['vehicleTrackLog'] = $this->tracking->getTrackingByVehicleId($vehId);
          $data['evaliationDetails'] = $this->evaluation->getEvaluation($vehId);
          //             if($this->uid==100){
          //                echo json_encode(array('status' => true,'data' => $data));
          //                exit;
          // //debug($data);
          //             }
          $this->render_page(strtolower(__CLASS__) . '/trackingLog', $data);
     }

     function tracklist()
     { //jsk
          $this->render_page(strtolower(__CLASS__) . '/tracklist');
     }
     function tracking_ajax()
     { //jsk
          $response = $this->tracking->getAllVehiclesForTrackingAjax($this->input->post());
          echo json_encode($response);
     }
}
