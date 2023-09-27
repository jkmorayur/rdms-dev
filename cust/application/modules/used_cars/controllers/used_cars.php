<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class used_cars extends App_Controller {

     protected $rowperpage = 6;

     //protected $urisegment = 1;

     public function __construct() {
          parent::__construct();
          $this->load->model('used_cars_model', 'used_cars');
          $this->load->model('vehicle/vehicle_model', 'vehicle_model');
     }

     function index($segment = '', $xhr = '', $rowno = 0) {
          $exp = explode('-', $xhr);
          $prdId = end($exp);
          $this->load->library('pagination');
          $uriSegment = explode('-', $segment);
          $uriSegmentCount = count($uriSegment);
          if ($segment == 'pre-owned-luxury-cars') { //Car brand page
               $seoTitleDesc = $this->seo_analytics_model->getPageTitleAndMetaDescription('pre-owned-luxury-cars');
               $this->page_title = isset($seoTitleDesc['seop_page_title']) ? $seoTitleDesc['seop_page_title'] : '';
               $this->page_meta_description = isset($seoTitleDesc['seop_meta_desc']) ? $seoTitleDesc['seop_meta_desc'] : '';
               $this->render_page(strtolower(__CLASS__) . '/pre-owned-luxury-cars');
          } else if ($segment == 'pre-owned-luxury-bikes') { //Bike brand page
               $seoTitleDesc = $this->seo_analytics_model->getPageTitleAndMetaDescription('pre-owned-luxury-bikes');
               $this->page_title = isset($seoTitleDesc['seop_page_title']) ? $seoTitleDesc['seop_page_title'] : '';
               $this->page_meta_description = isset($seoTitleDesc['seop_meta_desc']) ? $seoTitleDesc['seop_meta_desc'] : '';
               $this->render_page(strtolower(__CLASS__) . '/pre-owned-luxury-bikes');
          } else if ((!empty($prdId) && is_numeric($prdId))) {
               if (!empty($prdId) && is_numeric($prdId)) {
                    $data['productDetails'] = $this->vehicle_model->getVehicle($prdId);
                    $data['relatedVehicle'] = $this->vehicle_model->getRelatedVehicles($prdId);
                    $fullstop = explode('.', strip_tags($data['productDetails']['prd_desc']));
                    if (count($fullstop) == 1) {
                         $fullstop = explode(',', strip_tags($data['productDetails']['prd_desc']));
                    }
                    $desc = isset($fullstop[0]) ? trim($fullstop[0]) : '';
                    $desc = isset($fullstop[1]) ? $desc . ', ' . trim($fullstop[1]) : $desc;
                    $desc = isset($fullstop[2]) ? $desc . ', ' . trim($fullstop[2]) : $desc;
                    $title = $data['productDetails']['brd_title'] . ' ' . $data['productDetails']['mod_title'] . ' ' . $data['productDetails']['var_variant_name'];
                    $this->page_title = !empty($data['productDetails']['prd_page_title']) ? $data['productDetails']['prd_page_title'] : $title;
                    $this->page_meta_description = !empty($data['productDetails']['prd_meta_desc']) ?
                            $data['productDetails']['prd_meta_desc'] : $title . ', ' . $desc;
                    $data['features'] = $this->vehicle_model->getAllFeatures();
                    if(isset($data['productDetails']['prd_status']) && ($data['productDetails']['prd_status'] == 0)) {
                         redirect('pnf');
                    } else {
                         $this->render_page(strtolower(__CLASS__) . '/product_details', $data);
                    }
               } else {
                    $this->render_page(strtolower(__CLASS__) . '/pnf');
               }
          } else { //Product by brand   
               $seoTitleDesc = $this->seo_analytics_model->getPageTitleAndMetaDescription($segment);
               $this->page_title = isset($seoTitleDesc['seop_page_title']) ? $seoTitleDesc['seop_page_title'] : '';
               $this->page_meta_description = isset($seoTitleDesc['seop_meta_desc']) ? $seoTitleDesc['seop_meta_desc'] : '';
               if (isset($uriSegment['1'])) {
                    $data['brand'] = $uriSegment;
                    $data['urisegment'] = $segment;
                    if ($rowno != 0) {
                         $rowno = ($rowno - 1) * $this->rowperpage;
                    }
                    $records = $this->used_cars->search($data, $rowno, $this->rowperpage);
                    $allcount = $records['count'];
                    $users_record = $records['records'];
                    $config = getPaginationDesign();
                    $config['base_url'] = base_url() . $data['urisegment'] . '/' . $xhr;
                    $config['use_page_numbers'] = TRUE;
                    $config['total_rows'] = $allcount;
                    $config['per_page'] = $this->rowperpage;
                    $config["uri_segment"] = 3;
                    $this->pagination->initialize($config);
                    $data['pagination'] = $this->pagination->create_links();
                    $data['result'] = $users_record;
                    $data['row'] = $rowno;
                    if ($xhr == 'xhr') {
                         $data['result'] = $this->load->view(strtolower(__CLASS__) . '/ajax_pagination', $data, true);
                         echo json_encode($data);
                    } else {
                         $this->render_page(strtolower(__CLASS__) . '/used_cars_products', $data);
                    }
               } else {
                    redirect('fnf');
               }
          }
     }
     
     /*function index($segment = '', $xhr = '', $rowno = 0) {
          $seg = $segment;
          $this->load->library('pagination');
          $uriSegment = explode('-', $segment);
          $uriSegmentCount = count($uriSegment);
          if ($seg == 'pre-owned-luxury-cars') { //Brand page
               $seoTitleDesc = $this->seo_analytics_model->getPageTitleAndMetaDescription('brands');
               $this->page_title = isset($seoTitleDesc['seop_page_title']) ? $seoTitleDesc['seop_page_title'] : '';
               $this->page_meta_description = isset($seoTitleDesc['seop_meta_desc']) ? $seoTitleDesc['seop_meta_desc'] : '';

               $this->render_page(strtolower(__CLASS__) . '/used_cars_main_category');
          } else { //Product by brand
               $seoTitleDesc = $this->seo_analytics_model->getPageTitleAndMetaDescription($segment);
               $this->page_title = isset($seoTitleDesc['seop_page_title']) ? $seoTitleDesc['seop_page_title'] : '';
               $this->page_meta_description = isset($seoTitleDesc['seop_meta_desc']) ? $seoTitleDesc['seop_meta_desc'] : '';
               if (isset($uriSegment['1'])) {
                    $data['brand'] = $uriSegment;
                    $data['urisegment'] = $segment;

                    // Row position
                    if ($rowno != 0) {
                         $rowno = ($rowno - 1) * $this->rowperpage;
                    }

                    $records = $this->used_cars->search($data, $rowno, $this->rowperpage);

                    // All records count
                    $allcount = $records['count'];

                    // Get records
                    $users_record = $records['records'];

                    // Pagination Configuration
                    $config = getPaginationDesign();
                    $config['base_url'] = base_url() . $data['urisegment'] . '/' . $xhr;
                    $config['use_page_numbers'] = TRUE;
                    $config['total_rows'] = $allcount;
                    $config['per_page'] = $this->rowperpage;
                    $config["uri_segment"] = 3;

                    // Initialize
                    $this->pagination->initialize($config);

                    // Initialize $data Array
                    $data['pagination'] = $this->pagination->create_links();
                    $data['result'] = $users_record;
                    $data['row'] = $rowno;
                    if ($xhr == 'xhr') {
                         $data['result'] = $this->load->view(strtolower(__CLASS__) . '/ajax_pagination', $data, true);
                         echo json_encode($data);
                    } else {
                         $this->render_page(strtolower(__CLASS__) . '/used_cars_products', $data);
                    }
               } else {
                    redirect('fnf');
               }
          }
     }*/



     public function loadrecord($rowno = 0) {

          // Row position
          if ($rowno != 0) {
               $rowno = ($rowno - 1) * $this->rowperpage;
          }

          $records = $this->used_cars->loadRecord($rowno, $this->rowperpage);

          // All records count
          $allcount = $records['count'];

          // Get records
          $users_record = $records['records'];

          // Pagination Configuration
          $config['base_url'] = base_url() . 'index.php/User/loadRecord';
          $config['use_page_numbers'] = TRUE;
          $config['total_rows'] = $allcount;
          $config['per_page'] = $this->rowperpage;

          // Initialize
          $this->pagination->initialize($config);

          // Initialize $data Array
          $data['pagination'] = $this->pagination->create_links();
          $data['result'] = $users_record;
          $data['row'] = $rowno;

          echo json_encode($data);
     }

}
