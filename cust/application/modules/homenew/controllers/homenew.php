<?php

defined('BASEPATH') or exit('No direct script access allowed');

class homenew extends App_Controller {

     public $mailConfig = array(
          'protocol' => 'smtp',
          'smtp_host' => SMTP_HOST,
          'smtp_port' => SMTP_PORT,
          'smtp_user' => SMTP_USER,
          'smtp_pass' => SMTP_PASS,
          'mailtype' => 'html',
          'charset' => 'utf-8'
     );

     public function __construct() {
//           $comment    =    'Note: We convert a string into an array with explode function. I do not use explode function then the output will be a string as shown in below example.';
// $comment = (strlen($comment) > 50)?substr($comment,0,25).'... <a href="https://www.pakainfo.com/php-laravel-limit-string-length/">Read More</a>' : $comment;
// echo $comment;
// exit;
         parent::__construct();
         $this->load->model('homenew_model', 'home_model');
     }

     function index() {
          $api_key = 'AIzaSyBlqdYM-tA26nOwlaHN3uId4kvs7GBdwl8';
          $playlist_id = 'PLUUfWyT58jqQuYbZmGiIXMWUPH9fINv0O';
          $api_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=' . $playlist_id . '&key=' . $api_key;
          $items = json_decode(file_get_contents($api_url), true);
          $items1 = $items['items'];

          if (isset($items['nextPageToken'])) {
               $nextPage = $items['nextPageToken'];
               $api_url = 'https://www.googleapis.com/youtube/v3/playlistItems?pageToken=' . $nextPage . '&part=snippet&maxResults=50&playlistId=' . $playlist_id . '&key=' . $api_key;
               $items = json_decode(file_get_contents($api_url), true);
               $items2 = $items['items'];
               $data['youtubeList'] = array_merge($items1, $items2);
          } else {
               $data['youtubeList'] = $items1;
          }

          $lastNum = count($data['youtubeList']) - 1;
          $data['lastvideo'] = isset($data['youtubeList'][$lastNum]['snippet']['resourceId']['videoId']) ? $data['youtubeList'][$lastNum]['snippet']['resourceId']['videoId'] : '';

          $data['vehiclesNearByYou'] = $this->home_model->vehiclesNearByYou();
          $data['brandsLogo'] = $this->home_model->getLuxuryBrandsLog();
          $data['brands'] = $this->home_model->getBrands();
          $data['newCount'] = $this->home_model->vehiclesCount('new');
          $data['popularCount'] = $this->home_model->vehiclesCount('popular');
          $data['evCount'] = $this->home_model->vehiclesCount('ev');
          $this->render_page(strtolower(__CLASS__) . '/index', $data);
     }

     function new_arrivals() {
          $data['newArrivals'] = $this->home_model->newArrivals();
        //  debug(123213);
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
               /* if (!empty($_POST['ref_email'])) {
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
               /* if (!empty($_POST['ref_frnd_email'])) {
                 $message = $this->load->view('mail_tmp_refer_friend', $_POST, true);
                 $this->load->library('email', $this->mailConfig);
                 $this->email->set_newline("\r\n");
                 $this->email->to($_POST['ref_frnd_email']);
                 $this->email->subject('Your friend refered to Royaldrive');
                 $this->email->message($message);
                 $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                 $this->email->from('admin@royaldrive.in', 'Refer a friend');
                 $this->email->send();
                 } */
               $this->session->set_flashdata('app_success', 'Thank you for refer a friend, we will touch you soon!');
          }
          redirect('home');
     }

     function loadmore() {//laodmore and infinity scroll
          if (!empty($this->input->get("page"))) {
               if ($this->input->get("device") == 'pc') {
                   // debug($_GET['cateory']);
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

     function create_site_map_xml() {
          $static_values = [
              "https://www.royaldrive.in/",
              "https://www.royaldrive.in/used-audi-cars",
              "https://www.royaldrive.in/used-bmw-cars",
              "https://www.royaldrive.in/used-mercedes-benz-cars",
              "https://www.royaldrive.in/used-lamborghini-cars",
              "https://www.royaldrive.in/used-porsche-cars",
              "https://www.royaldrive.in/used-volvo-cars",
              "https://www.royaldrive.in/used-jaguar-cars",
              "https://www.royaldrive.in/used-land-rover-cars",
              "https://www.royaldrive.in/used-lexus-cars",
              "https://www.royaldrive.in/used-mini-cooper-cars",
              "https://www.royaldrive.in/used-bentley-cars",
              "https://www.royaldrive.in/pre-owned-luxury-cars",
              "https://www.royaldrive.in/used-harley-davidson-bikes",
              "https://www.royaldrive.in/used-triumph-bikes",
              "https://www.royaldrive.in/aboutus",
              "https://www.royaldrive.in/contactus",
              "https://www.royaldrive.in/career",
              "https://www.royaldrive.in/sell-your-vehicle",
              "https://www.royaldrive.in/pre-owned-luxury-bikes",
              "https://www.royaldrive.in/testimonials",
              "https://www.royaldrive.in/blog",
              "https://www.royaldrive.in/assets/150-check-points.pdf",
          ];
          $sitemap_text = '<?xml version="1.0" encoding="UTF-8"?>
  <urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
              http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

          foreach ($static_values as $value) {
               $mod_date = date('c');
               $priority = '0.80';
               if ($value == 'https://www.royaldrive.in/')
                    $priority = '1.00';
               $sitemap_text .= "<url>
        <loc>$value</loc>
        <lastmod>$mod_date</lastmod>
        <priority>$priority</priority>
      </url>
";
          }
          $Vehicles = $this->home_model->VehiclesSiteMap();
          foreach ((array) $Vehicles as $key => $value) {
               $mod_date = date('c');
               $priority = '0.80';
               $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
               $url = site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']);

               $sitemap_text .= "<url>
        <loc>$url</loc>
        <lastmod>$mod_date</lastmod>
        <priority>$priority</priority>
      </url>";
          }
          $sitemap_text .= '</urlset>';
          $sitemap = fopen('sitemap.xml', 'w');
          fwrite($sitemap, $sitemap_text);
     }

}
