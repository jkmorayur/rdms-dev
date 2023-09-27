<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Home extends App_Controller {

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
            $this->page_title = 'We want to add to your power. Become a luxury car owner with Royal Drive!';
            $this->page_meta_description = 'We are Royal Drive, the first choice pre � owned luxury and exotic brand automobile dealer in South India. Our illustrious list of luxury car brands includes the likes of Porsche, Mercedes � Benz, BMW/MINI, Audi, Jaguar & Land Rover, Volvo, Volkswagen etc. Apart from luxury cars, our brand also deals with pre-owned exotic luxury motorbikes, by bringing to your disposal some of the biggest names in the industry, namely Harley Davidson, Triumph, Ducati and BMW.';
            $this->load->model('home_model');
       }

       function indextext() {
            $data['rdMini'] = $this->home_model->rdMiniVehiclestest();
            debug($data['rdMini']);
            $data['vehiclesNearByYou'] = $this->home_model->vehiclesNearByYou();
            $data['brandsLogo'] = $this->home_model->getLuxuryBrandsLog();
            $data['brands'] = $this->home_model->getBrands();
            $this->render_page(strtolower(__CLASS__) . '/index', $data);
       }


       function index() {
               $data['rdMini'] = $this->home_model->rdMiniVehicles(0, 6, 100);
             $data['newCount'] = $this->home_model->vehiclesCount('new');
            $data['popularCount'] = $this->home_model->vehiclesCount('popular');
           /* $data['rdMiniCount'] = $this->home_model->vehiclesCount('rdMini');*/
            $data['evCount'] = $this->home_model->vehiclesCount('ev');
            $data['rdMini'] = $this->home_model->rdMiniVehicles();
            $data['vehiclesNearByYou'] = $this->home_model->vehiclesNearByYou();
            $data['brandsLogo'] = $this->home_model->getLuxuryBrandsLog();
            $data['brands'] = $this->home_model->getBrands();
            $this->render_page(strtolower(__CLASS__) . '/index', $data);
       }
  function loadmore() {
       /*laodmore and infinity scroll*/
            if (!empty($this->input->get("page"))) {
                 if ($this->input->get("device") == 'pc') {
                                         $data['count'] = $this->home_model->vehiclesCount('new');
                      $perPage = 6;
                      if ($this->input->get("page") != 'first') {
                           $start = $this->input->get("page") * $perPage;
                           $data['page'] = $this->input->get("page");
                           $data['start'] = $start;
                           $data['perPage'] = $perPage;
                           $bkdOffset = $this->input->get("bkdOffset");
                           $soldOffset = $this->input->get("soldOffset");
                             if ($_GET['cateory'] == 'ev') {
                                $data['newArrivals'] = $this->home_model->ev($start, $perPage);
                                $result = $this->load->view('ajax_new', $data);
                           }
                           elseif ($_GET['cateory'] == 'new') {
                                $data['newArrivals'] = $this->home_model->newArrivals($start, $perPage);
                                $result = $this->load->view('ajax_new', $data);
                           } elseif ($_GET['cateory'] == 'popular') {

                                $data2['popularVehicles'] = $this->home_model->popularVehicles($start, $perPage);

                                $result = $this->load->view('ajax_popular', $data2);
                           } elseif ($_GET['cateory'] == 'rdMini') {

                                $data['rdMini'] = $this->home_model->rdMiniVehicles($start, $perPage);
                                $result = $this->load->view('ajax_rd_mini', $data);
                           }
                      } else {
                            if ($_GET['cateory'] == 'ev') {
                                $data['start'] = 0;
                                $data['perPage'] = 6;
                                $data['newArrivals'] = $this->home_model->ev(0, 6, $data['count'], 0, 0);

                                $result = $this->load->view('ajax_new', $data);
                           }
                           elseif ($_GET['cateory'] == 'new') {
                                $data['start'] = 0;
                                $data['perPage'] = 6;
                                $data['newArrivals'] = $this->home_model->newArrivals(0, 6, $data['count'], 0, 0);

                                $result = $this->load->view('ajax_new', $data);
                           } elseif ($_GET['cateory'] == 'popular') {
                                $data['start'] = 0;
                                $data['perPage'] = 6;
                                $data2['popularVehicles'] = $this->home_model->popularVehicles(0, 6, $data['count']);

                                $result = $this->load->view('ajax_popular', $data2);
                           } elseif ($_GET['cateory'] == 'rdMini') {
                                $data['start'] = 0;
                                $data['perPage'] = 6;
                                $data['rdMini'] = $this->home_model->rdMiniVehicles(0, 6, $data['count']);
                                $result = $this->load->view('ajax_rd_mini', $data);
                           }
                      }

                      return json_encode($result);
                 } elseif ($this->input->get("device") == 'mobile') {
                      $data['count'] = $this->home_model->vehiclesCount('new');
                      $perPage = 6;
                      $start = $this->input->get("page") * $perPage;
                        if ($_GET['cateory'] == 'ev') {
                           $data['newArrivals'] = $this->home_model->ev($start, $perPage);

                           $result = $this->load->view('ajax_new_mob', $data);
                      } 
                      elseif ($_GET['cateory'] == 'new') {
                           $data['newArrivals'] = $this->home_model->newArrivals($start, $perPage);

                           $result = $this->load->view('ajax_new_mob', $data);
                      } elseif ($_GET['cateory'] == 'popular') {

                           $data['popularVehicles'] = $this->home_model->popularVehicles($start, $perPage);
                           $result = $this->load->view('ajax_popular_mob', $data);
                      } elseif ($_GET['cateory'] == 'rdMini') {
                           $perPage = 6;
                           $data['rdMini'] = $this->home_model->rdMiniVehicles($start, $perPage);
                           $result = $this->load->view('ajax_rd_mini_mob', $data);
                      }

                      return json_encode($result);
                 }
            }
       }
       function new_arrivals() {
            $data['newArrivals'] = $this->home_model->newArrivals();
            $this->render_page(strtolower(__CLASS__) . '/new_arrivals', $data);
       }

       function vehicles_near_by_you() {
            $data['vehiclesNearByYou'] = $this->home_model->vehiclesNearByYou();
            $this->render_page(strtolower(__CLASS__) . '/vehicles_near_by_you', $data);
       }

       function referFriend() {

            $this->load->view('mail_tmp_refer', '', true);
            $_POST['ref_referel_number'] = 'RD' . time();
            if ($this->home_model->referFriend($_POST)) {
                 /* Mail from */
                 if (!empty($_POST['ref_email'])) {
                      $message = $this->load->view('mail_tmp_refer', $_POST, true);
                      $this->load->library('email', $this->mailConfig);
                      $this->email->set_newline("\r\n");
                      $this->email->to($_POST['ref_email']);
                      $this->email->subject('Refer your friend');
                      $this->email->message($message);
                      $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                      $this->email->from('admin@royaldrive.in', 'Refer a friend');
                      $this->email->send();
                      $this->email->clear();
                 }
                 /* Mail to */
                 if (!empty($_POST['ref_frnd_email'])) {
                      $message = $this->load->view('mail_tmp_refer_friend', $_POST, true);
                      $this->load->library('email', $this->mailConfig);
                      $this->email->set_newline("\r\n");
                      $this->email->to($_POST['ref_frnd_email']);
                      $this->email->subject('Your friend refered to Royaldrive');
                      $this->email->message($message);
                      $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                      $this->email->from('admin@royaldrive.in', 'Refer a friend');
                      $this->email->send();
                 }
                 $this->session->set_flashdata('app_success', 'Thank you for refer a friend, we will touch you soon!');
            }
            redirect('home');
       }
  }  