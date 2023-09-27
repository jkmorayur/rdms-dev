<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class reports extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->page_title = 'Reports';
            $this->load->model('reports_model', 'reports');
            ini_set('memory_limit', '-1');
       }

       function price_list() {
            $this->template->set_layout('price');
            $this->page_title = 'Royaldrive | RDportal Login';

            $data['div'] = $this->input->get('vreg_division');
            $data['shwrm'] = $this->input->get('vreg_showroom');
            $data['details'] = $this->reports->price_list($data['div'], $data['shwrm']);
            $data['division'] = $this->reports->getActiveData();
            $data['showroom'] = $this->reports->bindShowroomByDivision($this->input->get('vreg_division'));
            $this->render_page(strtolower(__CLASS__) . '/wv_price_list', $data);
       }

       public function price_list_export_excel() {
//debug($priceLists);
            generate_log(array(
                'log_title' => $this->session->userdata('usr_username') . ' downloaded excel report price list',
                'log_desc' => $this->session->userdata('usr_username') . ' downloaded excel report price list on - ' . date('Y-m-d H:i:s'),
                'log_controller' => 'exp-excel-my-register',
                'log_action' => 'R',
                'log_ref_id' => 1002,
                'log_added_by' => $this->uid
            ));


            $this->page_title = 'Price list';
            $this->load->library("excel");
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle('Price list');
            $heading = array('Sl', 'Brand', 'Vehicle', 'Mode', 'Color', 'Fuel', 'Mnr Year', 'Month & Year of', 'Reg no', 'Km', 'No.Owners', 'INS', 'IDV', 'Price', 'Booking Date', 'Booked Staff Name', 'Status');

            //Loop Heading
            $rowNumberH = 1;
            $colH = 'A';
            foreach ($heading as $h) {
                 $objPHPExcel->getActiveSheet()->setCellValue($colH . $rowNumberH, $h);
                 $colH++;
            }

            //Loop Result
            $row = 2;
            $no = 1;
            $modeOfContact = unserialize(MODE_OF_CONTACT);
            $callTypes = unserialize(CALL_TYPE);
            $data['div'] = $this->input->get('vreg_division');
            $data['shwrm'] = $this->input->get('vreg_showroom');
            $priceLists = $this->reports->price_list($data['div'], $data['shwrm']);
            if (!empty($priceLists)) {
                 foreach ($priceLists as $key => $value) {

                      if ($value['vbk_status'] == 28 or $value['vbk_status'] == 13) {
                           $shwrm = unserialize(Showrooms)[$value['vbk_showroom']];

                           $text = 'Booked-' . $shwrm;
                      } else {
                           $shwrm = unserialize(Showrooms)[$value['val_showroom']];

                           $text = 'STOCK-' . $shwrm;
                      }
                      $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $key + 1);
                      $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $value['brd_title']);
                      $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $value['mod_title']);
                      $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $value['val_type'] == 1 ? 'O' : $value['val_type'] == 5 ? 'O' : 'P' );
                      $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $value['val_color']);
                      $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $value['val_fuel']);
                      $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $value['val_minif_year']);
                      $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $value['val_manf_date']);
                      $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $value['val_veh_no']);
                      $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $value['val_km']);
                      $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $value['val_no_of_owner']);
                      $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $value['val_insurance_validity']);
                      $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $value['val_insurance_idv']);
                      $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $value['prd_price']);
                      $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $value['vbk_added_on']);
                      $objPHPExcel->getActiveSheet()->setCellValue('P' . $row, $value['booked_staff']);
                      $objPHPExcel->getActiveSheet()->setCellValue('Q' . $row, $text);


                      $row++;
                      $no++;
                 }
            }

            //Save as an Excel BIFF (xls) file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="priceList.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
       }
          function bindShowroomByDivision() {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                 $showroom = $this->reports->bindShowroomByDivision($_POST['id']);
                 echo json_encode($showroom);
            }
       }

  }
  