<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class search extends App_Controller {

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

            /* Load title, css, js etc... */
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre – owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes – Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
            $this->page_meta_keywords = '';
//            $this->page_meta_description = '';
            /* Load title, css, js etc... */
            $this->load->model('search_model');
            $this->load->model('home/home_model');
       }

       function index($keyword = '') {
            $_GET['keyword'] = $keyword;
            $data['brands'] = $this->home_model->getBrands();
            $data['searchResult'] = $this->search_model->search($_GET);
            $data['searchParams'] = $_GET;

            $this->render_page(strtolower(__CLASS__) . '/index', $data);
       }

       function connectWithSeller() {
            
            $this->search_model->addConnectWithSeller($this->input->post());
            $data = $_POST;
            
            $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>Connect With Seller</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>First Name</td>"
                    . "<td>" . $data['cws_first_name'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Last Name</td>"
                    . "<td>" . $data['cws_last_name'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Email</td>"
                    . "<td>" . $data['cws_email'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Phone</td>"
                    . "<td>" . $data['cws_phone'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Comments</td>"
                    . "<td>" . $data['cws_comments'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Vehicle</td>"
                    . "<td>" . $data['cws_url'] . "</td>"
                    . "</tr>"
                    . "</table>";
            //$this->load->library('email', $this->mailConfig);
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->to(EMAIL_CONTACT);
            $this->email->subject('Connect With Seller');
            $this->email->message($message);
            $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
            $this->email->from('admin@royaldrive.in', 'Connect With Seller');
            if ($this->email->send()) {
                 die(json_encode(array('status' => 'success', 'msg' => '<p style="color:green;">Mail successfully sent!</p>')));
            } else {
                 die(json_encode(array('status' => 'failed', 'msg' => '<p style="color:red;">Mail not successfully sent!</p>')));
            }
       }

  }

  