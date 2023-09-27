<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class product extends App_Controller {

     public function __construct() {

          parent::__construct();
          $this->body_class[] = 'skin-blue';
          $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
          $this->page_meta_description = 'We are Royal Drive, the first choice pre � owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes � Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
          $this->load->model('product_model', 'vehicle_model');
          $this->load->library("pagination");
     }

     function index($vehicle) {
          $exp = explode('-', $vehicle);
          if (isset($exp['0']) && !empty($exp['0'])) {
               $data['productDetails'] = $this->vehicle_model->getVehicle($exp['0']);
               $data['relatedVehicle'] = $this->vehicle_model->getRelatedVehicles($exp['0']);

               $title = isset($data['productDetails']['prd_name']) ?
                       $data['productDetails']['brd_title'] . ' ' . $data['productDetails']['mod_title'] . ' ' . $data['productDetails']['var_variant_name']
                       . ' - ' . STATIC_TITLE : STATIC_TITLE;

               $this->page_title = $title;

               $data['features'] = $this->vehicle_model->getAllFeatures();
               $this->render_page(strtolower(__CLASS__) . '/product_details', $data);
          } else {
               $this->render_page(strtolower(__CLASS__) . '/pnf');
          }
     }

     public function removeImage($id) {
          if ($this->vehicle_model->removePrductImage($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Product image successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product image"));
          }
     }

     public function removeTempImage($id) {
          if ($this->vehicle_model->removePrductTempImage($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Product image successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product image"));
          }
     }

     function removeVehicle($id) {
          if ($this->vehicle_model->deleteProduct($id)) {
               echo json_encode(array('status' => 'success', 'msg' => 'Product successfully deleted'));
          } else {
               echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product"));
          }
     }

     function setDefault($id) {
          $this->vehicle_model->setDefaultImage($id);
     }

     function setDefaultUpdate($id, $prodId) {
          $this->vehicle_model->setDefaultImageUpdate($id, $prodId);
     }

     function emiCalculator() {
          $data['emiInputs'] = $this->input->post();
          echo $this->load->view(strtolower(__CLASS__) . '/calculate-emi', $data);
     }

}
