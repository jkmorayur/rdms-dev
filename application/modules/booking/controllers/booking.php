<?php

defined('BASEPATH') or exit('No direct script access allowed');

class booking extends App_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->page_title = 'Booking';
          $this->load->model('booking_model', 'booking');
          $this->load->model('enquiry/enquiry_model', 'enquiry');
          $this->load->model('evaluation/evaluation_model', 'evaluation');
          $this->load->model('emp_details/emp_details_model', 'emp_details');
     }

     public function index()
     {
          $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }
     function index_ajax()
     {
          $response =  $this->booking->getAllBookingsPaginate($this->input->post(), $this->input->get());
          echo json_encode($response);
     }

     function index_demo()
     {

          $data['bookingVehicles'] = $this->booking->getAllBookings($_GET);
          $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $this->render_page(strtolower(__CLASS__) . '/index_demo', $data);
     }

     function reserveVehicleView($enqId)
     {
          $enqId = encryptor($enqId, 'D');
          $data['stockVehicles'] = $this->booking->getStockVehicles();
          $data['enqId'] = $enqId;
          $html = $this->load->view(strtolower(__CLASS__) . '/ajx_reservationform_1', $data, true);
          die(json_encode(array('status' => 'success', 'msg' => 'Enquiry assigned to executive!', 'html' => $html)));
     }

     function bindVehicleDetails($vehId, $enqId)
     {
          $vehId = encryptor($vehId, 'D');
          $enqId = encryptor($enqId, 'D');
          $data['enquiry'] = $this->enquiry->enquires($enqId);
          $data['vehicles'] = $this->evaluation->getEvaluationPrint($vehId);
          $data['addressProof'] = $this->booking->getActiveAddressProof(1);
          $data['banks'] = $this->evaluation->getAllBanks();
          $html = $this->load->view(strtolower(__CLASS__) . '/ajx_reservationform_2', $data, true);
          die(json_encode(array('status' => 'success', 'msg' => 'Enquiry assigned to executive!', 'html' => $html)));
     }

     function reserveVehicle()
     {
          // if($this->uid==358){
          //                  foreach($_POST['bm'] as $k=>$vals ){
          // echo $val='bm['.$k.']:'.$vals.' <br>';

          //           }
          //           exit;
          // }

          $reserveMasterId = $this->booking->reserveVehicle($_POST);
          $this->load->library('upload');
          $docNos = isset($_POST['ap']['vbd_doc_type']) ? count($_POST['ap']['vbd_doc_type']) : 0;
          $newFileName = '';
          if ($docNos > 0) {
               for ($i = 0; $i < $docNos; $i++) {
                    if (isset($_FILES['vbd_doc_file']['name'][$i]) && !empty($_FILES['vbd_doc_file']['name'][$i])) {
                         $newFileName = rand() . time();
                         $config['upload_path'] = '../rdms/assets/uploads/documents/booking/';
                         $config['allowed_types'] = '*';
                         // $config['file_name'] = $newFileName;
                         $config['encrypt_name'] = TRUE;
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
                    $this->booking->uploadDocuments(
                         array(
                              'vbd_doc_file' => $uploadData['file_name'],
                              'vbd_master_id' => $reserveMasterId,
                              'vbd_doc_type' => isset($_POST['ap']['vbd_doc_type'][$i]) ? $_POST['ap']['vbd_doc_type'][$i] : 0,
                              'vbd_doc_number' => isset($_POST['ap']['vbd_doc_number'][$i]) ? $_POST['ap']['vbd_doc_number'][$i] : 0
                         )
                    );
               }
          }
          $this->session->set_flashdata('app_success', 'New booking successfully added!');
          //redirect(__CLASS__);
          redirect(__CLASS__ . '/print_obf/' . $reserveMasterId);
          //die(json_encode(array('status' => 'success', 'msg' => 'New booking')));
     }

     function bookedvehicles()
     {
          $this->page_title = 'Booked vehicles';
          $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $stsId = isset($_GET['s']) ? encryptor($_GET['s'], 'D') : 0;
          $data['bookedVehicle'] = $this->booking->getBookedVehicle(0, $stsId);
          $data['executive'] = isset($_GET['executive']) ? $_GET['executive'] : '';
          $this->render_page(strtolower(__CLASS__) . '/bookedvehicle', $data);
     }

     function deliverdvehicle($stsId)
     {
          $this->page_title = 'Deliverd vehicles';
          $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $data['bookedVehicle'] = $this->booking->getDeliverdVehicle(0, $stsId, $_GET);
          $data['districts'] = $this->booking->getDistricts();
          $data['executive'] = isset($_GET['executive']) ? $_GET['executive'] : '';
          $data['distSelected'] = isset($_GET['dist']) ? $_GET['dist'] : '';
          $this->render_page(strtolower(__CLASS__) . '/deliverdvehicle', $data);
     }

     /**
      * Export booking enquires
      */
     function exportBookedVehicles()
     {
          $stsId = isset($_GET['s']) ? encryptor($_GET['s'], 'D') : 0;
          $userName = $this->session->userdata('usr_username');
          $data = date('Y-m-d H:i:s');
          generate_log(array(
               'log_title' =>  $userName . ' downloaded excel report for deliverd vehicle on - ' . $data,
               'log_desc' => serialize($_GET),
               'log_controller' => 'exp-excel-book-deliverd',
               'log_action' => 'R',
               'log_ref_id' => 29,
               'log_added_by' => $this->uid
          ));
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $data = $this->booking->getAllBookings($_GET);

          $this->load->library("excel");
          $objPHPExcel = new PHPExcel();
          $objPHPExcel->getActiveSheet()->setTitle('Enquires report');
          $heading = array(
               'Booking ID', 'Registration', 'Customer Name', 'Booked by', 'Phone number (Official)',
               'Phone number (Personal)', 'Permanent address', 'RC Transfer address',
               'Booked on', 'Expect delivery on', 'Delivery on', 'Insurance status',
               'RC Transfer status', 'RFI Status', 'Vehicle', 'Chassis', 'Enq No',
               'Customer Source', 'Sales staff', 'Booking status', 'Division',
               'Enquiry Date', 'Enq Added on', 'Showroom'
          );
          $rowNumberH = 1;
          $colH = 'A';
          foreach ($heading as $h) {
               $objPHPExcel->getActiveSheet()->setCellValue($colH . $rowNumberH, $h);
               $colH++;
          }

          $mod = unserialize(MODE_OF_CONTACT);
          $statuses = unserialize(ENQUIRY_UP_STATUS);

          $row = 2;
          if (!empty($data)) {
               foreach ($data as $key => $value) {
                    $rctrnsPIN = !empty($value['vbk_rc_trns_pin']) ? ', PIN :' . $value['vbk_rc_trns_pin'] : '';
                    $perPIN = !empty($value['vbk_pin']) ? ', PIN :' . $value['vbk_pin'] : '';
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $value['vbk_ref_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['val_veh_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['enq_cus_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['bkdby_first_name'] . ' ' . $value['btdby_last_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['vbk_off_ph_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['vbk_per_ph_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['vbk_per_address'] . $perPIN); //enq_location
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['vbk_rd_trans_address'] . $rctrnsPIN);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, date('j M Y h:i A', strtotime($value['vbk_added_on'])));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, !empty($value['vbk_expect_delivery']) ? date('j M Y h:i A', strtotime($value['vbk_expect_delivery'])) : '');
                    $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, !empty($value['vbk_delivery_date']) ? date('j M Y h:i A', strtotime($value['vbk_delivery_date'])) : '');
                    $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['rfi_in_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $value['rfi_rc_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['rfi_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['brd_title'] . ', ' . $value['mod_title'] . ', ' . $value['var_variant_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['val_chasis_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $value['enq_number']);
                    $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, isset($mod[$value['enq_mode_enq']]) ? $mod[$value['enq_mode_enq']] : '');
                    $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, $value['salesstaff_first_name'] . ' ' . $value['salesstaff_first_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, $value['sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('U' . $row, $value['div_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('V' . $row, date('d-m-Y', strtotime($value['enq_entry_date'])));
                    $objPHPExcel->getActiveSheet()->setCellValue('W' . $row, date('d-m-Y', strtotime($value['enq_added_on'])));
                    $objPHPExcel->getActiveSheet()->setCellValue('X' . $row, $value['shr_location']);
                    $row++;
               }
          }

          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
          header('Content-Type: application/vnd.ms-excel');
          header('Content-Disposition: attachment;filename="rdportal-enquires-report.xls"');
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          exit();
     }

     /**
      * Export deliverd vehicle
      */
     function exportExcelBookings()
     {
          $stsId = isset($_GET['s']) ? encryptor($_GET['s'], 'D') : 0;
          $userName = $this->session->userdata('usr_username');
          $data = date('Y-m-d H:i:s');
          generate_log(array(
               'log_title' =>  $userName . ' downloaded excel report for deliverd vehicle on - ' . $data,
               'log_desc' => serialize($_GET),
               'log_controller' => 'exp-excel-book-deliverd',
               'log_action' => 'R',
               'log_ref_id' => 29,
               'log_added_by' => $this->uid
          ));
          $page = !isset($_GET['page']) ? 0 : $_GET['page'];
          $data = $this->booking->getDeliverdVehicle(0, $stsId, $_GET);

          $this->load->library("excel");
          $objPHPExcel = new PHPExcel();
          $objPHPExcel->getActiveSheet()->setTitle('Enquires report');
          $heading = array(
               'Booking ID', 'Registration', 'Customer Name', 'Booked by', 'Phone number (Official)',
               'Phone number (Personal)', 'Permanent address', 'RC Transfer address',
               'Booked on', 'Expect delivery on', 'Delivery on', 'Insurance status',
               'RC Transfer status', 'RFI Status', 'Vehicle', 'Chassis', 'Showroom',
               'Booking status', 'Enquiry Date', 'Enq Added on'
          );
          $rowNumberH = 1;
          $colH = 'A';
          foreach ($heading as $h) {
               $objPHPExcel->getActiveSheet()->setCellValue($colH . $rowNumberH, $h);
               $colH++;
          }

          $modeOfContact = unserialize(MODE_OF_CONTACT);
          $statuses = unserialize(ENQUIRY_UP_STATUS);

          $row = 2;
          if (!empty($data)) {
               foreach ($data as $key => $value) {
                    $rctrnsPIN = !empty($value['vbk_rc_trns_pin']) ? ', PIN :' . $value['vbk_rc_trns_pin'] : '';
                    $perPIN = !empty($value['vbk_pin']) ? ', PIN :' . $value['vbk_pin'] : '';

                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $value['vbk_ref_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['val_veh_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['enq_cus_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['bkdby_first_name'] . ' ' . $value['btdby_last_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['vbk_off_ph_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['vbk_per_ph_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['vbk_per_address']); //enq_location
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['vbk_rd_trans_address']);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, date('j M Y h:i A', strtotime($value['vbk_added_on'])));
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, !empty($value['vbk_expect_delivery']) ? date('j M Y h:i A', strtotime($value['vbk_expect_delivery'])) : '');
                    $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, !empty($value['vbk_delivery_date']) ? date('j M Y h:i A', strtotime($value['vbk_delivery_date'])) : '');
                    $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['rfi_in_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $value['rfi_rc_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['rfi_sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['brd_title'] . ', ' . $value['mod_title'] . ', ' . $value['var_variant_name']);
                    $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['val_chasis_no']);
                    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $value['shr_location']);
                    $objPHPExcel->getActiveSheet()->setCellValue('R' . $row, $value['sts_title']);
                    $objPHPExcel->getActiveSheet()->setCellValue('S' . $row, date('d-m-Y', strtotime($value['enq_entry_date'])));
                    $objPHPExcel->getActiveSheet()->setCellValue('T' . $row, date('d-m-Y', strtotime($value['enq_added_on'])));
                    $row++;
               }
          }

          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
          header('Content-Type: application/vnd.ms-excel');
          header('Content-Disposition: attachment;filename="rdportal-enquires-report.xls"');
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          exit();
     }

     function bookingDetails($id)
     {
          $bookId = encryptor($id, 'D');
          $data['addressProof'] = $this->booking->getActiveAddressProof(1);
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $this->booking->pendingDocs($bookId);
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/bookingdetails', $data);
     }

     function bookingDetails_rfi($id)
     {
          $bookId = encryptor($id, 'D');
          $data['banks'] = $this->evaluation->getAllBanks();
          $data['addressProof'] = $this->booking->getActiveAddressProof(2);
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $data['rcTransferStatuses'] = $this->common_model->getStatuses('rfi-rc-trans');
          $data['rcTransferInsurnce'] = $this->common_model->getStatuses('rfi-ins-trans');
          $data['fileTransferStatuses'] = $this->common_model->getStatuses('rfi-file-sts');
          $data['rfiStatus'] = $this->common_model->getStatuses('rfi-sts');
          $data['bookingFollowup'] = $this->booking->getBookingFollowup();
          $data['RTO'] = $this->booking->getRTO();
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/bookingDetails_rfi', $data);
     }

     function bookingDetails_dc($id)
     {
          $bookId = encryptor($id, 'D');
          $data['banks'] = $this->evaluation->getAllBanks();
          $data['addressProof'] = $this->booking->getActiveAddressProof();
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $data['rcTransferStatuses'] = $this->common_model->getStatuses('rfi-rc-trans');
          $data['rcTransferInsurnce'] = $this->common_model->getStatuses('rfi-ins-trans');
          $data['bookingFollowup'] = $this->booking->getBookingFollowup();
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/bookingdetails_dc', $data);
     }

     function decisionmaking()
     {
          $this->load->library('upload');
          $masterId = isset($_POST['confim']['vbc_book_master']) ? $_POST['confim']['vbc_book_master'] : 0;
          if ($masterId > 0) {
               $docNos = isset($_FILES['papers']['name']) ? count($_FILES['papers']['name']) : 0;
               $newFileName = '';
               if ($docNos > 0 && (isset($_FILES['papers']['name'][0]) && !empty($_FILES['papers']['name'][0]))) {
                    for ($i = 0; $i < $docNos; $i++) {
                         if (isset($_FILES['papers']['name'][$i]) && !empty($_FILES['papers']['name'][$i])) {
                              $ext = explode(".", $_FILES['papers']['name'][$i]);
                              $ext = '.' . end($ext);
                              $newFileName = rand() . time() . $ext;
                              $config['upload_path'] = '../rdms/assets/uploads/documents/booking/';
                              $config['allowed_types'] = '*';
                              $config['file_name'] = $newFileName;
                              $this->upload->initialize($config);
                              $_FILES['prd_image_tmp']['name'] = $_FILES['papers']['name'][$i];
                              $_FILES['prd_image_tmp']['type'] = $_FILES['papers']['type'][$i];
                              $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['papers']['tmp_name'][$i];
                              $_FILES['prd_image_tmp']['error'] = $_FILES['papers']['error'][$i];
                              $_FILES['prd_image_tmp']['size'] = $_FILES['papers']['size'][$i];

                              if ($this->upload->do_upload('prd_image_tmp')) {
                                   $uploadData = $this->upload->data();
                              } else {
                                   $uploadData = $this->upload->display_errors();
                              }
                         }
                         $this->booking->uploadDocuments(
                              array(
                                   'vbd_doc_file' => $newFileName,
                                   'vbd_master_id' => $masterId,
                                   'vbd_doc_type' => isset($_POST['docs']['type'][$i]) ? $_POST['docs']['type'][$i] : 0,
                                   'vbd_doc_number' => isset($_POST['docs']['number'][$i]) ? $_POST['docs']['number'][$i] : 0
                              )
                         );
                    }
               }
          }
          $this->booking->decisionmaking($this->input->post());
          redirect(__CLASS__ . '/bookedvehicles');
     }

     function getRejectedBooking()
     {
          $data['rejectedBooking'] = $this->booking->getRejectBooking();
          $this->render_page(strtolower(__CLASS__) . '/rejectedBooking', $data);
     }

     function rejectedBookingDetails($id)
     {
          $bookId = encryptor($id, 'D');
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $enqId = $data['bookingDetails']['vbk_enq_id'];
          $vehId = $data['bookingDetails']['vbk_evaluation_veh_id'];
          $data['enquiry'] = $this->enquiry->enquires($enqId);
          $data['vehicles'] = $this->evaluation->getEvaluationPrint($vehId);
          $data['addressProof'] = $this->booking->getActiveAddressProof();
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/rejectedBookingDetails', $data);
     }

     function removeDocuments($fileId)
     {
          $fileId = encryptor($fileId, 'D');
          $this->booking->removeDocuments($fileId);
          die(json_encode(array('status' => 'success', 'msg' => 'Row deleted!')));
     }

     function resubmitReserveVehicle()
     {
          $this->load->library('upload');
          $docNos = isset($_POST['ap_new']['vbd_doc_type']) ? count($_POST['ap_new']['vbd_doc_type']) : 0;
          $masterId = isset($_POST['bm']['vbk_id']) ? $_POST['bm']['vbk_id'] : 0;
          $newFileName = '';
          if ($docNos > 0) {
               for ($i = 0; $i < $docNos; $i++) {
                    if (isset($_FILES['vbd_doc_file']['name'][$i]) && !empty($_FILES['vbd_doc_file']['name'][$i])) {
                         $ext = explode(".", $_FILES['vbd_doc_file']['name'][$i]);
                         $ext = '.' . end($ext);
                         $newFileName = rand() . time() . $ext;
                         $config['upload_path'] = '../rdms/assets/uploads/documents/booking/';
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
                              debug($uploadData);
                         }
                    }
                    $this->booking->uploadDocuments(
                         array(
                              'vbd_doc_file' => $newFileName,
                              'vbd_master_id' => $masterId,
                              'vbd_doc_type' => isset($_POST['ap_new']['vbd_doc_type'][$i]) ? $_POST['ap_new']['vbd_doc_type'][$i] : 0,
                              'vbd_doc_number' => isset($_POST['ap_new']['vbd_doc_number'][$i]) ? $_POST['ap_new']['vbd_doc_number'][$i] : 0
                         )
                    );
               }
          }
          $this->booking->resubmitReserveVehicle($this->input->post());
          redirect(__CLASS__ . '/bookedvehicles');
     }

     function permenentdeletebooking($bkid)
     {
          $bkid = encryptor($bkid, 'D');
          $this->booking->permenentdeletebooking($bkid);
          die(json_encode(array('status' => 'success', 'msg' => 'Row deleted!')));
     }

     function submitBookingFollowup()
     {
          $this->booking->bookingFollowup($this->input->post());
     }

     function bookingCancelled()
     {
          $stsId = isset($_GET['s']) ? encryptor($_GET['s'], 'D') : 0;
          $data['bookingCancelled'] = $this->booking->cancelledBookings();
          $this->render_page(strtolower(__CLASS__) . '/cancelledvehicle', $data);
     }

     function editBooking($bookId = 0)
     {
          error_reporting(E_ALL);
          if (!empty($_POST)) {
               $masterId = $_POST['bm']['vbk_id'];
               $docNos = isset($_FILES['papers']['name']) ? count($_FILES['papers']['name']) : 0;
               $newFileName = '';
               if ($docNos > 0 && (isset($_FILES['papers']['name'][0]) && !empty($_FILES['papers']['name'][0]))) {
                    $this->load->library('upload');
                    for ($i = 0; $i < $docNos; $i++) {
                         if (isset($_FILES['papers']['name'][$i]) && !empty($_FILES['papers']['name'][$i])) {
                              $ext = explode(".", $_FILES['papers']['name'][$i]);
                              $ext = '.' . end($ext);
                              $newFileName = rand() . time() . $ext;
                              $config['upload_path'] = '../rdms/assets/uploads/documents/booking/';
                              $config['allowed_types'] = '*';
                              $config['file_name'] = $newFileName;
                              $this->upload->initialize($config);
                              $_FILES['prd_image_tmp']['name'] = $_FILES['papers']['name'][$i];
                              $_FILES['prd_image_tmp']['type'] = $_FILES['papers']['type'][$i];
                              $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['papers']['tmp_name'][$i];
                              $_FILES['prd_image_tmp']['error'] = $_FILES['papers']['error'][$i];
                              $_FILES['prd_image_tmp']['size'] = $_FILES['papers']['size'][$i];

                              if ($this->upload->do_upload('prd_image_tmp')) {
                                   $uploadData = $this->upload->data();
                              } else {
                                   $uploadData = $this->upload->display_errors();
                                   debug($uploadData);
                              }
                         }
                         $this->booking->uploadDocuments(
                              array(
                                   'vbd_doc_file' => $newFileName,
                                   'vbd_master_id' => $masterId,
                                   'vbd_doc_type' => isset($_POST['docs']['type'][$i]) ? $_POST['docs']['type'][$i] : 0,
                                   'vbd_doc_number' => isset($_POST['docs']['number'][$i]) ? $_POST['docs']['number'][$i] : 0
                              )
                         );
                    }
               }

               $this->booking->editBooking($_POST);
               redirect(__CLASS__ . '/editbooking/' . encryptor($_POST['bm']['vbk_id']));
          }
          $bookId = encryptor($bookId, 'D');
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $data['addressProof'] = $this->booking->getActiveAddressProof(1);
          $data['vehicles'] = $this->evaluation->getEvaluationPrint($data['bookingDetails']['vbk_evaluation_veh_id']);
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/editBookingDetails', $data);
     }
     function print_obf($id)
     {
          $bookId = encryptor($id, 'D');
          $data['addressProof'] = $this->booking->getActiveAddressProof(1);
          $data['bookingDetails'] = $this->booking->getBookedVehicle($bookId);
          $data['panCard'] = $this->booking->getPanCard($bookId);
          $this->booking->pendingDocs($bookId);
          $data['history'] = $this->load->view(strtolower(__CLASS__) . '/bookinghistory', $data['bookingDetails'], true);
          $this->render_page(strtolower(__CLASS__) . '/print_bookingdetails', $data);
     }

     function allreservation()
     {
          $data['bookingVehicles'] = $this->booking->getAllReservation($_GET);
          $data['salesExecutives'] = $this->emp_details->salesExecutives();
          $this->render_page(strtolower(__CLASS__) . '/allreservation', $data);
     }
     function todaysRetails()
     {
          if (check_permission('booking', 'showall')) {
          } else if (check_permission('booking', 'mybking')) {
               $this->db->where('vbk_added_by', $this->uid);
          } else if (check_permission('booking', 'mystaffbking')) {
               $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
                    ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
               $this->db->where_in($this->tbl_enquiry . '.enq_se_id', $mystaffs);
          } else if (check_permission('booking', 'myshowroombking')) {
               $this->db->where($this->tbl_vehicle_booking_master . '.vbk_showroom', $this->shrm);
          } else if (check_permission('booking', 'mydivisionbking')) {
               $this->db->where($this->tbl_divisions . '.div_id', $this->div);
          } else {
               return false;
          }

          $selectArray = array(
               $this->tbl_vehicle_booking_master . '.vbk_id',
               $this->tbl_enquiry . '.enq_id',
               $this->tbl_enquiry . '.enq_cus_name',
               $this->tbl_enquiry . '.enq_cus_mobile',
               'bkdby.usr_first_name AS bkdby_first_name', 'bkdby.usr_last_name AS bkdby_last_name',
               'salesstaff.usr_first_name AS salesstaff_first_name', 'salesstaff.usr_last_name AS salesstaff_last_name',
               $this->tbl_valuation . '.val_veh_no',
               $this->tbl_model . '.mod_title',
               $this->tbl_brand . '.brd_title',
               $this->tbl_variant . '.var_variant_name',
               $this->tbl_divisions . '.div_name',
               $this->tbl_showroom . '.shr_location'
          );

          $today = date('Y-m-d'); // Get current date
          $currentTime = date('Y-m-d H:i:s'); // Get current datetime
          $bookedVehicle = $this->db->select($selectArray, false)
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_vehicle_booking_master . '.vbk_enq_id', 'left')
               ->join($this->tbl_users . ' bkdby', 'bkdby.usr_id = ' . $this->tbl_vehicle_booking_master . '.vbk_added_by', 'left')
               ->join($this->tbl_users . ' salesstaff', 'salesstaff.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'left')
               ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_vehicle_booking_master . '.vbk_evaluation_veh_id', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_statuses, $this->tbl_statuses . '.sts_value = ' . $this->tbl_vehicle_booking_master . '.vbk_status', 'LEFT')
               // ->join($this->tbl_statuses . ' rfi_rc_sts', 'rfi_rc_sts.sts_value = ' . $this->tbl_vehicle_booking_master . '.vbk_rfi_rc_trans_sts', 'LEFT') //  AND vbk_rfi_rc_trans_sts > 0
               //->join($this->tbl_statuses . ' rfi_in_sts', 'rfi_in_sts.sts_value = ' . $this->tbl_vehicle_booking_master . '.vbk_ins_trans_sts', 'LEFT') //  AND vbk_ins_trans_sts > 0
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_vehicle_booking_master . '.vbk_showroom', 'left')
               ->join($this->tbl_divisions, $this->tbl_divisions . '.div_id = ' . $this->tbl_showroom . '.shr_division', 'left')
               ->where($this->tbl_vehicle_booking_master . '.vbk_added_on >=', $today . ' 00:00:00')
               ->where($this->tbl_vehicle_booking_master . '.vbk_added_on <=', $currentTime)
               ->where_in($this->tbl_statuses . '.sts_value', array(vehicle_booked, confm_book, rfi_loan_approved, dc_ready_to_del, book_delvry))
               ->order_by("vbk_added_on", "desc")
               ->get($this->tbl_vehicle_booking_master)->result_array();
          return $bookedVehicle;
     }
}
