<?php
defined('BASEPATH') or exit('No direct script access allowed');
class special_promotion extends App_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->body_class[] = 'skin-blue';
          $this->page_title = 'Used luxury Car dealer in Kerala,Kochi | Used Harley Davidson Dealer in Kerala, Kochi';
          $this->page_meta_description = 'Riding or driving a BMW is like a dream come true for car fanatics out there. Royal Drive is the most acclaimed Used BMW Car dealer in Kochi, Kerala and we sell dreams in the forms of flagship cars.Ambling around in a premium bike is the best feeling ever. We, Royal Drive are a Used Harley Davidson Dealer in Kerala, Kochi and we let you get a taste of that hot ride.';
          $this->load->model('special_promotion_model', 'special_promotion');
     }

     function index($tag = '')
     {
          if (!empty($_POST)) {
               $vehicel = $this->special_promotion->getBMV($_POST['eve_brand'], $_POST['eve_model'], $_POST['eve_varient']);
               $_POST['eve_vehicle_string'] = $vehicel;
               $mailtitle = isset($_POST['mailtitle']) ? $_POST['mailtitle'] : 'Event/Promotional enquiry';
               if (isset($_POST['mailtitle'])) {
                    unset($_POST['mailtitle']);
               }
               $this->special_promotion->create($_POST);

               $mailSender = '';
               if ($_POST['eve_vehicle'] > 0) {
                    $vdetails = $this->special_promotion->getProductDetails($_POST['eve_vehicle']);
                    $brand = isset($vdetails['brd_title']) ? $vdetails['brd_title'] : '';
                    $model = isset($vdetails['mod_title']) ? $vdetails['mod_title'] : '';
                    $varient = isset($vdetails['var_variant_name']) ? $vdetails['var_variant_name'] : '';

                    $vehicel = $brand . ', ' . $model . ', ' . $varient;
                    $mailSender = ' | ' . $vehicel;
               }

               $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));

               $kmStr = '';
               if (isset($_POST['eve_km']) && $_POST['eve_km'] == 1) {
                    $kmStr = 'Below 50,000';
               } else if (isset($_POST['eve_km']) && $_POST['eve_km'] == 2) {
                    $kmStr = '50,000 - 100,000';
               }

               $year = (isset($_POST['eve_year']) && $_POST['eve_year'] > 0) ?  "<tr><td>Year</td><td>" . $_POST['eve_year'] . "</td></tr>" : '';
               $km = (!empty($kmStr)) ?  "<tr><td>KM</td><td>" . $kmStr . "</td></tr>" : '';

               $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>" . $mailtitle . "</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Name</td>"
                    . "<td>" . $_POST['eve_name'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Mobile</td>"
                    . "<td>" . $_POST['eve_mobile'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>WhatsApp</td>"
                    . "<td>" . $_POST['eve_whatsapp'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Location</td>"
                    . "<td>" . $_POST['eve_location'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Email</td>"
                    . "<td>" . $_POST['eve_email'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Interested vehicle</td>"
                    . "<td>" . $vehicel . "</td>"
                    . "</tr>" . $year . $km . "</table>";

               $this->email->set_newline("\r\n");
               $this->email->to('resmiwhc@gmail.com, jkmorayur@gmail.com');
               $this->email->subject('Event enquiry');
               $this->email->message($message);
               $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
               $this->email->from('info@royaldrive.in', $_POST['eve_name'] . $mailSender);
               $this->email->send();
               redirect('special-promotion/success');
          }
          $this->template->set_layout('promo');
          $view = !empty($tag) ? $tag : 'index';
          $brand = $this->special_promotion->getBrands();
          $this->render_page(strtolower(__CLASS__) . '/' . $view, array('tag' => $tag, 'brand' => $brand));
     }

     function success()
     {
          $this->template->set_layout('promo');
          $this->render_page(strtolower(__CLASS__) . '/success');
     }

     public function bindModel($brdId = '', $dataType = 'json')
     {
          $id = isset($_POST['id']) ? $_POST['id'] : $brdId;
          $vehicle = $this->special_promotion->getModelByBrand($id);
          if ($dataType == 'json') {
               echo json_encode($vehicle);
          } else {
               return $vehicle;
          }
     }

     function bindVarient($modelId = '', $dataType = 'json')
     {
          $id = isset($_POST['id']) ? $_POST['id'] : $modelId;
          $vehicle = $this->special_promotion->getVariantByModel($id);
          if ($dataType == 'json') {
               echo json_encode($vehicle);
          } else {
               return $vehicle;
          }
     }

     function investment()
     {
          if (!empty($_POST)) {
               $this->special_promotion->create($_POST);

               $invAmt = (isset($_POST['eve_inv_amount']) && $_POST['eve_inv_amount'] == 2) ? '50 Lac - 1 Cr' : '1 Cr & Above';
               $message = "<table>"
                    . "<tr>"
                    . "<th colspan='3'>Getting Started in Investing</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Name</td>"
                    . "<td>" . $_POST['eve_name'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Mobile</td>"
                    . "<td>" . $_POST['eve_mobile'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Alternative Mobile</td>"
                    . "<td>" . $_POST['eve_alt_mobile'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Location/City</td>"
                    . "<td>" . $_POST['eve_location'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Email</td>"
                    . "<td>" . $_POST['eve_email'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Profession</td>"
                    . "<td>" . $_POST['eve_profession'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Work/Industry</td>"
                    . "<td>" . $_POST['eve_work_ind'] . "</td>"
                    . "</tr>"
                    . "<tr>"
                    . "<td>Amount planning to invest</td>"
                    . "<td>" . $invAmt . "</td>"
                    . "</tr></table>";
               $this->load->library('email');
               $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 587,
                    'smtp_user' => 'talktoroyaldrive@gmail.com',
                    'smtp_pass' => 'tlkrd#@1',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
               );
               $this->load->library('email', $config);
               $this->email->from('talktoroyaldrive@gmail.com');
               $this->email->to('resmiwhc@gmail.com,jkmorayur@gmail.com');
               $this->email->subject('Getting Started in Investing');
               $this->email->message($message);
               $this->email->send();
               redirect('special-promotion/success');
          }
          $this->template->set_layout('promo');
          $this->render_page(strtolower(__CLASS__) . '/investment');
     }

     function mail()
     {
          // $config['mailtype'] = 'html';
          // $config['smtp_crypto'] = 'STARTTLS'; 
          // $config['protocol'] = 'sendmail'; 
          // $config['smtp_host'] = 'smtp-mail.outlook.com';
          // $config['smtp_user'] = 'it@royaldrive.in'; 
          // $config['smtp_pass'] = 'RD#@19090'; 
          // $config['smtp_port'] = '587'; 
          // $config['starttls'] = true; 
          // $config['charset']='utf-8'; // Default should be utf-8 (this should be a text field) 
          // $config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n" 
          // $config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n" 
          // $config['wordwrap'] = TRUE;
          // $config['send_multipart'] = FALSE;

          // $this->load->library('email', $config);
          // $message = "test";

          // $this->email->set_newline("\r\n");
          // $this->email->to('jkmorayur@gmail.com');
          // $this->email->subject('Event enquiry');
          // $this->email->message($message);
          // $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
          // $this->email->from('info@royaldrive.in', 'Getting Started in Investing');
          // $this->email->send();




          echo $this->email->print_debugger();
     }
}
