<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
  //require '../../../vendor/autoload.php';

  class sell_your_vehicle extends App_Controller {

       public $mailConfig = Array(
           'protocol' => 'smtp',
           'smtp_host' => SMTP_HOST,
           'smtp_port' => SMTP_PORT,
           'smtp_user' => SMTP_USER,
           'smtp_pass' => SMTP_PASS,
           'mailtype' => 'html',
           'charset' => 'utf-8'
       );

       public function __construct() {

            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre � owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes � Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
            $this->load->model('home/home_model');
            $this->load->model('sell_your_vehicle_model');
       }

       function index() {
//            if (!check_login()) {
//                 $this->session->set_userdata('referrer', 'sell_your_vehicle');
//                 redirect('user/login');
//            }
            $data['brands'] = $this->home_model->getBrands();
            $data['features'] = $this->sell_your_vehicle_model->getFeatures();
            $this->sell_your_vehicle_model->removeTempImagesIfAny();
            $this->render_page(strtolower(__CLASS__) . '/index', $data);
       }

       function postCarDetails() {
            generate_log(array(
                'log_title' => 'Sell your cal',
                'log_desc' => serialize($_POST),
                'log_controller' => 'web-sell-your-car',
                'log_action' => 'C',
                'log_ref_id' => 0,
                'log_added_by' => 9090
            ));
            $this->load->model('vehicle/vehicle_model', 'vehicle_model');
            $prodId = $this->sell_your_vehicle_model->addProduct($this->input->post());
            $data = $this->vehicle_model->getVehicle($prodId);
            $userEmail = isset($_POST['basicinfo']['prd_email']) ? $_POST['basicinfo']['prd_email'] : '';

            $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));
            $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>New Vehicle Added</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>User name</td>"
                    . "<td>" . $data['prd_usr_name'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>User phone</td>"
                    . "<td>" . $data['prd_usr_ph_num'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>User mail</td>"
                    . "<td>" . $data['prd_email'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Vehicle Number</td>"
                    . "<td>" . $data['prd_number'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Brand</td>"
                    . "<td>" . $data['brd_title'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Model</td>"
                    . "<td>" . $data['mod_title'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Variant</td>"
                    . "<td>" . $data['var_variant_name'] . "</td>"
                    . "</tr>"
                    . "</table>";

            $this->email->set_newline("\r\n");
            $this->email->to('info@royaldrive.in');
            $this->email->subject('New Vehicle Added');
            $this->email->message($message);
            $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
            $this->email->from('admin@royaldrive.in', 'New Vehicle Added');
            $this->email->send();
            $this->email->clear();

            /* Mail to user */
            $message = "Thank you for register your vehicle with us, we will confirm soon.";
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->to($userEmail);
            $this->email->subject('Sell your car');
            $this->email->message($message);
            $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
            $this->email->from('noreply@royaldrive.in', 'Sell your car');
            $this->email->send();
            $this->session->set_flashdata('app_success', 'Product successfully added!');
            redirect('sell-your-vehicle');
       }

       function uploadFiles() {
            $this->load->library('upload');
            $this->load->library('image_lib');
            $newFileName = rand(9999999, 0) . $_FILES['files']['name'];
            $config['upload_path'] = './assets/uploads/product/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);
            $data = array();
            $imgId = '';
            if ($this->upload->do_upload('files')) {
                 $data = $this->upload->data();
                 resize_image($data);
                 $imgId = $this->sell_your_vehicle_model->addTempImage($data['file_name']);
            }
            echo json_encode(array('imgId' => $imgId, 'src' => '../assets/uploads/product/thumb_' . $data['file_name']));
       }

       function updateCarDetails() {

            $this->sell_your_vehicle_model->updateProduct($this->input->post());
            $this->session->set_flashdata('app_success', 'Car details successfully updated!');
            redirect('user/myaccount/my-vehicle');
       }

       function bindModel() {
           $id = $_POST['id'];
          // $id = $_GET['id'];
            $vehicle = $this->sell_your_vehicle_model->getModelByBrand($id);
            echo json_encode($vehicle);
       }
       function getModelByBrand() {
           $id = $_GET['id'];
           $vehicle = $this->sell_your_vehicle_model->getModelByBrand($id);
           echo json_encode($vehicle);
      }
       

       function bindVariant() {
            $id = $_POST['id'];
            $vehicle = $this->sell_your_vehicle_model->getVariantByModel($id);
            echo json_encode($vehicle);
       }
       function getVariantByModel() {
          $id = $_GET['id'];
          $vehicle = $this->sell_your_vehicle_model->getVariantByModel($id);
          echo json_encode($vehicle);
     }

  }
  