<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Vehicle extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre � owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes � Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
            $this->load->model('vehicle_model');
            $this->load->library("pagination");
       }

       function index($vehicle) {
            $exp = explode('-', $vehicle);
            if (isset($exp['0']) && !empty($exp['0'])) {
                 $data['productDetails'] = $this->vehicle_model->getVehicle($exp['0']);
                 //debug($data['productDetails']);
                 //$data['relatedVehicle'] = $this->vehicle_model->getRelatedVehicles($exp['0']);
                 if(isset($data['productDetails']['prd_rd_mini']) && ($data['productDetails']['prd_rd_mini'] == 1)) {
                      redirect('https://www.rdsmart.in/' . $this->uri->segment(1) . '/' . $this->uri->segment(2));
                 }
                 $name = $data['productDetails']['brd_title'] . ' ' . $data['productDetails']['mod_title'] . ' ' . $data['productDetails']['var_variant_name'];
                 redirect(site_url($data['productDetails']['brd_slug'] . '/' . get_url_string($name) . '-' . $data['productDetails']['prd_id']));
                 exit;

                 $fullstop = explode('.', strip_tags($data['productDetails']['prd_desc']));
                 if (count($fullstop) == 1) {
                    $fullstop = explode(',', strip_tags($data['productDetails']['prd_desc']));
                 }
                 $desc = isset($fullstop[0]) ? trim($fullstop[0]) : '';
                 $desc = isset($fullstop[1]) ? $desc . ', ' . trim($fullstop[1]) : $desc;
                 $desc = isset($fullstop[2]) ? $desc . ', ' . trim($fullstop[2]) : $desc;
                 $desc = isset($fullstop[3]) ? $desc . ', ' . trim($fullstop[3]) : $desc;

                 $title = $data['productDetails']['brd_title'] . ' ' . $data['productDetails']['mod_title'] . ' ' . $data['productDetails']['var_variant_name'];
                 $this->page_title = !empty($data['productDetails']['prd_page_title']) ? $data['productDetails']['prd_page_title'] : $title;
                 $this->page_meta_description = !empty($data['productDetails']['prd_meta_desc']) ? $data['productDetails']['prd_meta_desc'] : $title . ', ' . 
                         $desc . ' Know more about your dream car click here or visit our showrooms at Kozhikode, Malappuram & Kochi.';
                 
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