<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class advanced extends CI_Model
{

     public $rate = 0;
     public $principle = 0;
     public $time = 0;
     public $x = 0;
     public $monthly = 0;
     public $k;
     public $arr = array();
     public $date = "";
     public $upto = 0;
     public $i = 0;
     public $totalint = 0;
     public $payment_date;
     public $tp = 0;
     public $details = array();

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->tbl_brands = TABLE_PREFIX . "brand";
          $this->tbl_products = TABLE_PREFIX . "products";
          $this->tbl_products_image = TABLE_PREFIX . "prod_images";
          $this->tbl_products_specification = TABLE_PREFIX . "prod_specifications";
          $this->tbl_model = TABLE_PREFIX . "model";
          $this->tbl_variant = TABLE_PREFIX . "variant";
          $this->tbl_prod_features = TABLE_PREFIX . "prod_features";
          $this->tbl_features = TABLE_PREFIX . "features";
          $this->tbl_users = TABLE_PREFIX . "users";

          $this->tbl_slots = "app_roya_booking";
          $this->tb_booking = "app_roya_booked_list";
          $this->tbl_feedback = "app_feedback";
          define('rana_users', 'rana_users');
          $this->tbl_callcenterbridging = TABLE_PREFIX_PORTAL . 'callcenterbridging';
          $this->tbl_callcenterbridging_outgoing = TABLE_PREFIX_PORTAL . 'callcenterbridging_outgoing';
          $this->tbl_users_cpnl = "cpnl_users";
          $this->tbl_careers = TABLE_PREFIX_PORTAL . 'careers';
            $this->tbl_careers_applications = TABLE_PREFIX_PORTAL . 'careers_applications';
            $this->tbl_district_statewise = TABLE_PREFIX_PORTAL . 'district_statewise';
            $this->tbl_vehicle_colors = TABLE_PREFIX_PORTAL . 'vehicle_colors';
            $this->tbl_web_booking = TABLE_PREFIX_PORTAL . 'web_booking';
     }

     function getVariant($brand, $model)
     {

          $this->db->select('var_id,var_variant_name', FALSE);
          $this->db->from($this->tbl_variant);
          $this->db->where('var_brand_id', $brand);
          $this->db->where('var_model_id', $model);
          $vechicles = $this->db->get()->result_array();
          return $vechicles;
     }

     function search($brand, $color, $ful, $plow, $phigh, $year, $kmdriven, $category, $is_ev, $keyword)
     {
          //debug($this->tbl_products);
          $this->db->select('prd_id,mod_title,brd_title,prd_year,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color, prd_rd_mini,prd_popular,prd_latest,prd_soled,prd_booked,IF(prd_show_price = 1, prd_price, 0) AS price,
                               prd_km_run AS kms,prd_fual AS fuel,brd_category,mod_is_ev,CONCAT("' . PRODUCT_BASE_URL . '", ' . ', pdi_image) AS image', FALSE);
          $this->db->from($this->tbl_products);
          $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
          $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
          $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
          $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
          //  $where = "prd_added_by_user='0' AND prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";

          $this->db->where($where);

          $this->db->order_by('prd_order');

          $vechicles = array();
          //  debug($brand);
          if ($brand != null) {

               //$this->db->group_start();
               if (is_array($brand)) {
                    $br_query = '( ';
                    //$this->db->group_start();
                    // $this->db->where('brd_title',"%$item%");
                    $i = 0;

                    foreach ($brand as $key => $item) {


                         if ($i == 0) {
                              //$this->db->like('brd_title',$item);
                              //$this->db->where('brd_title',"%$item%");
                              $br_query .= "`brd_title`  LIKE '%$item%'";
                         } else {
                              //$this->db->or_like('brd_title',$item);
                              //$this->db->or_where('brd_title',"%$item%");
                              $br_query .= "OR `brd_title`  LIKE '%$item%'";
                         }


                         $i++;
                    }
                    $br_query .= ' )';
                    $this->db->where($br_query);
               } else {

                    $this->db->like('brd_title', $brand);
               }


               //$this->db->group_end();
          }
          if ($color != null) {

               if (is_array($color)) {
                    $cl_query = '( ';
                    $i = 0;

                    foreach ($color as $item) {
                         if ($i == 0) {
                              $cl_query .= "`prd_color`  LIKE '%$item%'";
                         } else {
                              $cl_query .= "OR `prd_color`  LIKE '%$item%'";
                         }
                         $i++;
                    }

                    $cl_query .= ' )';
                    $this->db->where($cl_query);
               } else {
                    $this->db->like('prd_color', $color);
               }
          }

          if ($ful != null) {
               $this->db->like('prd_fual', $ful);
          }

          if ($plow != null || $phigh != null) {



               if ($plow != null && $phigh != null) {

                    $this->db->where('prd_price <= ', $phigh);
                    $this->db->where('prd_price >= ', $plow);
               } else if ($phigh != null) {
                    $this->db->where('prd_price <= ', $phigh);
               } else {

                    $this->db->where('prd_price >= ', $plow);
               }
          }


          if ($year != null) {
               $this->db->where('prd_year >= ', $year);
          }


          if ($kmdriven != null) {
               //  debug($kmdriven);
               $this->db->where('prd_km_run <=', $kmdriven);
          }
          //jsk//
          if ($category != null) {
               $this->db->where('brd_category', $category);
          }
          if ($is_ev != null) {
               $this->db->where('mod_is_ev', 1);
          }

          //jsk//

          if ($keyword != null) {

               $check = "prd_desc LIKE '%$keyword%'";
               $this->db->where($check);
          }
          ///var_dump($this->db);
          $vechicles = $this->db->get()->result_array();

          //var_dump($this->db->last_query());


          return $vechicles;
     }

     public function newUser($name, $email, $password, $phonenumber)
     {
          // unset($datas['persistent_remember_me']);
          // unset($datas['password_confirmation']);
          //            $datas['username'] = $datas['first_name'];
          if ($password != null && $email != null && $phonenumber != null) {
               $password = get_hashed_password($password);



               $dataS = array(
                    'first_name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone' => $phonenumber
               );

               $this->db->where('phone', $phonenumber);
               $result['valid-user'] = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
               if (empty($result['valid-user'])) {
                    $this->db->where('email', $email);
                    $result['valid-user'] = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
                    if (empty($result['valid-user'])) {
                         $this->db->set($dataS);
                         if ($this->db->insert($this->tbl_users, array_filter($datas))) {
                              // $userId = $this->db->insert_id();
                              $this->db->where('phone', $phonenumber);
                              $result['valid-user'] = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
                              return $result['valid-user']['id'];
                         } else {
                              return "failure";
                         }
                    } else {
                         return "Email id already exist";
                    }
               } else {
                    return "Phone number already exist";
               }
          }


          return false;
     }

     function validate($type, $phonenumber, $password, $email)
     {
          if ($phonenumber != null && $password != null) {
               $this->db->where('phone', $phonenumber);
               if ($type == "normal" and $password != "!@#") {
                    $paswd = get_hashed_password($password);
                    $this->db->where('password', $paswd);
               }
               $result['valid-user'] = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
               if (!empty($result['valid-user'])) {
                    unset($result['valid-user']['password']);
                    unset($result['valid-user']['ip_address']);
                    unset($result['valid-user']['password']);
                    unset($result['valid-user']['salt']);
                    unset($result['valid-user']['activation_code']);
                    unset($result['valid-user']['forgotten_password_code']);
                    unset($result['valid-user']['forgotten_password_time']);
                    unset($result['valid-user']['remember_code']);
                    unset($result['valid-user']['created_on']);
                    unset($result['valid-user']['last_login']);
                    unset($result['valid-user']['active']);
                    //      unset($result['valid-user']['first_name']);
                    unset($result['valid-user']['last_name']);
                    unset($result['valid-user']['company']);
                    unset($result['valid-user']['is_subscribed_newsletter']);
                    unset($result['valid-user']['job_title']);
                    unset($result['valid-user']['address']);
                    unset($result['valid-user']['address1']);
                    unset($result['valid-user']['city']);
                    unset($result['valid-user']['state']);
                    unset($result['valid-user']['postcode']);
                    unset($result['valid-user']['country']);
                    unset($result['valid-user']['can_search']);
                    return $result;
               } else {
                    return false;
               }
          } else if ($email != null && $password != null) {
               $this->db->where('email', $email);
               if ($type == "normal" and $password != "!@#") {
                    $paswd = get_hashed_password($password);
                    $this->db->where('password', $paswd);
               }
               $result['valid-user'] = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
               if (!empty($result['valid-user'])) {
                    unset($result['valid-user']['password']);
                    unset($result['valid-user']['ip_address']);
                    unset($result['valid-user']['password']);
                    unset($result['valid-user']['salt']);
                    unset($result['valid-user']['activation_code']);
                    unset($result['valid-user']['forgotten_password_code']);
                    unset($result['valid-user']['forgotten_password_time']);
                    unset($result['valid-user']['remember_code']);
                    unset($result['valid-user']['created_on']);
                    unset($result['valid-user']['last_login']);
                    unset($result['valid-user']['active']);
                    //    unset($result['valid-user']['first_name']);
                    unset($result['valid-user']['last_name']);
                    unset($result['valid-user']['company']);
                    unset($result['valid-user']['is_subscribed_newsletter']);
                    unset($result['valid-user']['job_title']);
                    unset($result['valid-user']['address']);
                    unset($result['valid-user']['address1']);
                    unset($result['valid-user']['city']);
                    unset($result['valid-user']['state']);
                    unset($result['valid-user']['postcode']);
                    unset($result['valid-user']['country']);
                    unset($result['valid-user']['can_search']);


                    return $result;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     function forgot($phonenumber)
     {
          if ($phonenumber != null) {
               $this->db->where('phone', $phonenumber);
               $result = $this->db->select('phone,email,id')->from($this->tbl_users)->get()->row_array();
               if (!empty($result)) {
                    $result['send-otp'] = 'true';

                    return $result;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     function updatepassword($phonenumber, $password, $userid)
     {
          if ($phonenumber != null && $password != null && $userid != null) {

               $password = get_hashed_password($password);
               $array = array('phone' => $phonenumber, 'id' => $userid);

               $this->db->where($array);
               //$this->db->where('id', $userid);


               $result = $this->db->select('*')->from($this->tbl_users)->get()->row_array();
               if (!empty($result)) {
                    $result = array('password' => $password);
                    $this->db->where($array);
                    $status = $this->db->update($this->tbl_users, $result);
                    return true;
               }
               return false;
          } else {
               return false;
          }
     }

     function postcardetails(
          $user_id,
          $km,
          $year,
          $color,
          $owner,
          $price,
          $fuel,
          $brand,
          $model,
          $variant,
          $mileage,
          $engine,
          $insurance,
          $description,
          $features,
          $number
     ) {

          generate_log(array(
               'log_title' => 'Post car details begin',
               'log_desc' => serialize($result = array(
                    'prd_user_id' => $user_id,
                    'prd_km_run' => $km,
                    'prd_variant' => $variant,
                    'prd_year' => $year,
                    'prd_color' => $color,
                    'prd_owner' => $owner,
                    'prd_price' => $price,
                    'prd_model' => $model,
                    'prd_fual' => $fuel,
                    'prd_brand' => $brand,
                    'prd_mileage' => $mileage,
                    'prd_engine_cc' => $engine,
                    'prd_insurance_validity' => $insurance,
                    'prd_desc' => $description,
                    'prd_added_by_user' => '1',
                    'prd_status' => 0,
                    'prd_number' => $number
               )),
               'log_controller' => 'postcardetails-app-begin',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0,
               'log_added_on_in' => date('Y-m-d H:i:s')
          ));

          /*Brand*/
          if (!is_numeric($brand) && !empty($brand)) {
               $brand = $this->db->like('brd_title', trim($brand), 'both')->get($this->tbl_brands)->row_array();
               $brand = isset($brand['brd_id']) ? $brand['brd_id'] : 0;
          }

          /*Model*/
          if (!is_numeric($model) && !empty($model)) {
               if ($brand > 0) {
                    $this->db->where('mod_brand', $brand);
               }
               $brand = @$this->db->like('mod_title', trim($model), 'both')->get($this->tbl_model)->row()->mod_id;
          }

          /*Variant*/
          if (!is_numeric($variant) && !empty($variant)) {
               if ($brand > 0) {
                    $this->db->where('var_brand_id', $brand);
               }
               if ($model > 0) {
                    $this->db->where('var_model_id', $model);
               }
               $brand = @$this->db->like('var_variant_name', trim($variant), 'both')->get($this->tbl_variant)->row()->var_id;
          }

          /*Fuel*/
          if (!is_numeric($fuel) && !empty($fuel)) {
               if (strtolower($fuel) == 'petrol') {
                    $fuel = 1;
               } else if (strtolower($fuel) == 'diesel') {
                    $fuel = 2;
               } else if (strtolower($fuel) == 'gas') {
                    $fuel = 3;
               } else if (strtolower($fuel) == 'hybrid') {
                    $fuel = 4;
               } else if (strtolower($fuel) == 'electric') {
                    $fuel = 5;
               } else if (strtolower($fuel) == 'cng') {
                    $fuel = 6;
               }
          }
          /*Color*/
          if (!is_numeric($color) && !empty($color)) {
               $colors = array(1 => 'white', 2 => 'black', 3 => 'blue', 4 => 'red', 5 => 'yellow', 6 => 'orange', 7 => 'brown', 8 => 'golden', 9 => 'silver', 10 => 'gray', 11 => 'purple', 12 => 'beige', 0 => 'other');
               $color = array_search(strtolower($color), $colors);
          }
          generate_log(array(
               'log_title' => 'Post car details from app jk',
               'log_desc' => serialize($result = array(
                    'prd_user_id' => $user_id,
                    'prd_km_run' => $km,
                    'prd_variant' => $variant,
                    'prd_year' => $year,
                    'prd_color' => $color,
                    'prd_owner' => $owner,
                    'prd_price' => $price,
                    'prd_model' => $model,
                    'prd_fual' => $fuel,
                    'prd_brand' => $brand,
                    'prd_mileage' => $mileage,
                    'prd_engine_cc' => $engine,
                    'prd_insurance_validity' => $insurance,
                    'prd_desc' => $description,
                    'prd_added_by_user' => '1',
                    'prd_status' => 0,
                    'prd_number' => $number
               )),
               'log_controller' => 'postcardetails-app-be-ins',
               'log_action' => 'C',
               'log_ref_id' => 0,
               'log_added_by' => 0,
               'log_added_on_in' => date('Y-m-d H:i:s')
          ));
          if (
               $user_id != null && $km != null && $year != null && $owner != null && $price != null &&
               $fuel != null && $brand != null && $model != null
          ) {
               //$array = array('prd_user_id' => $user_id);
               $result = array(
                    'prd_user_id' => $user_id,
                    'prd_km_run' => $km,
                    'prd_variant' => $variant,
                    'prd_year' => $year,
                    'prd_color' => $color,
                    'prd_owner' => $owner,
                    'prd_price' => $price,
                    'prd_model' => $model,
                    'prd_fual' => $fuel,
                    'prd_brand' => $brand,
                    'prd_mileage' => $mileage,
                    'prd_engine_cc' => $engine,
                    'prd_insurance_validity' => $insurance,
                    'prd_desc' => $description,
                    'prd_added_by_user' => '1',

                    'prd_status' => 0,
                    'prd_number' => $number
               );
               //  $this->db->where($array);

               $status = $this->db->insert($this->tbl_products, array_filter($result));
               $pro_id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Post car details from app jkk',
                    'log_desc' => 'after insert',
                    'log_controller' => 'postcardetails-app-af-ins',
                    'log_action' => 'C',
                    'log_ref_id' => 0,
                    'log_added_by' => 0,
                    'log_added_on_in' => date('Y-m-d H:i:s')
               ));

               if (!empty($features)) {
                    foreach ($features as $item) {
                         $feat = array('pft_prod_id' => $pro_id, 'pft_feature_id' => $item);
                         $this->db->insert($this->tbl_prod_features, $feat);
                    }
               }
               return $pro_id;
          } else {
               return null;
          }
     }

     function postimagedetails($id, $image, $isDefult = 0)
     {
          if ($id != null && $image != null) {

               $result = array('pdi_prod_id' => $id, 'pdi_image' => $image, 'pdi_is_default' => $isDefult);
               //  $this->db->where($array);
               $status = $this->db->insert($this->tbl_products_image, $result);
               $error = $this->db->_error_message();
               echo $error;
               return $status;
          }
     }

     function postmainimagedetails($id, $image)
     {
          if ($id != null && $image != null) {

               $result = array('pdi_prod_id' => $id, 'pdi_image' => $image, 'pdi_is_default' => '1');
               //  $this->db->where($array);
               $status = $this->db->insert($this->tbl_products_image, $result);
               $error = $this->db->_error_message();
               echo $error;
               return $status;
          }
     }

     function approve($id)
     {
          generate_log(array(
               'log_title' => 'Post car approval from app',
               'log_desc' => 'Post car approval from app',
               'log_controller' => 'approve-app',
               'log_action' => 'C',
               'log_ref_id' => $id,
               'log_added_by' => 0
          ));
          return true;
          if ($id != null) {
               $array = array('prd_id' => $id);

               $this->db->where($array);
               //$this->db->where('id', $userid);


               $result = $this->db->select('*')->from($this->tbl_products)->get()->row_array();
               if (!empty($result)) {
                    $result = array('prd_status' => '1');
                    $this->db->where($array);
                    $status = $this->db->update($this->tbl_products, $result);
                    return true;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     function slots($date)
     {
          $this->db->select('app_roya_id,app_roya_date,app_roya_max_slot,app_roya_slot1,app_roya_slot2,app_roya_slot3,app_roya_slot4,app_roya_slot5');
          $this->db->from($this->tbl_slots);
          $where = "app_roya_date LIKE '$date'";
          $this->db->where($where);
          if ($slots = $this->db->get()->row_array()) {
               return $slots;
          } else {
               return FALSE;
          }
     }

     function booking($name, $number, $slotid, $date)
     {
          $data = array(
               'booked_list_name' => $name,
               'booked_list_phone' => $number,
               'booked_list_slot_id' => $slotid,
               'booked_list_date' => $date,
               'booked_list_time' => date('Y-m-d H:i:s'),
          );

          $slot_id_name = 'app_roya_slot' . $slotid;

          $select_qry = 'app_roya_id, app_roya_max_slot,' . $slot_id_name;
          $this->db->select("$select_qry");
          $this->db->from($this->tbl_slots);
          $where = "app_roya_date LIKE '$date'";
          $this->db->where($where);
          $slots = $this->db->get()->row_array();
          $updated = false;
          if ($slots && is_array($slots)) {
               if ($slots['app_roya_max_slot'] > $slots['app_roya_slot' . $slotid]) {
                    $booking = $this->db->insert($this->tb_booking, $data);
                    if ($booking) {
                         $roya_slot_id = $slots['app_roya_id'];
                         $new_slot = $slots['app_roya_slot' . $slotid] + 1;
                         $new_data[$slot_id_name] = $new_slot;

                         $this->db->where('app_roya_id', $roya_slot_id);
                         $updated = $this->db->update($this->tbl_slots, $new_data);
                    }
               }
          }

          return $updated;
     }

     function feedback($name, $number, $date, $feedback)
     {
          //$this->input->post('dname'),
          $data = array(
               'app_feedback_name' => $name,
               'app_feedback_phone' => $number,
               'app_feedback' => $feedback,
               'app_feedback_date' => $date,
               'app_feedback_time' => date('Y-m-d H:i:s'),
          );
          $status = $this->db->insert($this->tbl_feedback, $data);
          return $status;
     }

     function loginWithPhone($number, $cntrCode)
     {
          //zxHCyGcR9Iv
          $sign = get_settings_by_key('app_sms_signature');
          $number = substr($number, -10);
          $otp = generate_otp(6);
          generate_log(array(
               'log_title' => 'app otp',
               'log_desc' => $cntrCode . '-' . $number,
               'log_controller' => 'app-otp',
               'log_action' => 'C',
               'log_ref_id' => $cntrCode,
               'log_added_by' => 0
          ));
          //if (strtoupper($cntrCode) == '+91') {
          //$msg = '<#> ' . $otp . ' is your code to access Royaldrive ' . $sign;
          $msg = "<#>" . $otp . " , is your OTP to access Royal Drive - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
          send_sms($msg, $number, 'send app otp', 1607100000000133427, 4);
          //}
          $exists = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone', 'usr_location', 'usr_allt_number'))->like('phone', $number, 'both')->get(rana_users)->row_array();

          if (!empty($exists)) {
               if (strtoupper($cntrCode) == '+91') {
                    $this->db->where('id', $exists['id'])->update(rana_users, array('rusr_otp' => $otp, 'usr_phone_code' => $cntrCode));
                    $exists['otp'] = $otp;
               }
               return $exists;
          } else {
               $this->db->insert(rana_users, array('usr_phone_code' => $cntrCode, 'phone' => $number, 'rusr_otp' => $otp, 'active' => 0));
               $userId = $this->db->insert_id();
               return array('id' => $userId, 'otp' => $otp);
          }
     }
     function loginWithPhoneNew($number, $cntrCode)
     {//jsk
          //zxHCyGcR9Iv
          $sign = get_settings_by_key('app_sms_signature');
          $number = substr($number, -10);
          $otp = generate_otp(6);
          generate_log(array(
               'log_title' => 'app otp',
               'log_desc' => $cntrCode . '-' . $number,
               'log_controller' => 'app-otp',
               'log_action' => 'C',
               'log_ref_id' => $cntrCode,
               'log_added_by' => 0
          ));
          //if (strtoupper($cntrCode) == '+91') {
          //$msg = '<#> ' . $otp . ' is your code to access Royaldrive ' . $sign;
          $msg = "<#>" . $otp . " , is your OTP to access Royal Drive - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
          send_sms($msg, $number, 'send app new otp', 1607100000000133427, 4);
          //}
          $exists = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone', 'usr_location', 'usr_allt_number'))->like('phone', $number, 'both')->get(rana_users)->row_array();

          if (!empty($exists)) {
               if (strtoupper($cntrCode) == '+91') {
                    $this->db->where('id', $exists['id'])->update(rana_users, array('rusr_otp' => $otp, 'usr_phone_code' => $cntrCode));
                    $exists['otp'] = $otp;
               }
               return $exists;
          } else {
               $this->db->insert(rana_users, array('usr_phone_code' => $cntrCode, 'phone' => $number, 'rusr_otp' => $otp, 'active' => 0));
               $userId = $this->db->insert_id();
               return array('id' => $userId, 'otp' => $otp);
          }
     }

     function verifyPhoneNumber($uid, $otp)
     {

          $userDetails = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone', 'usr_location', 'usr_allt_number'))
               ->where(array('id' => $uid, 'rusr_otp' => $otp))->get('rana_users')->row_array();
          if (!empty($userDetails)) {
               $this->db->where('id', $uid)->update('rana_users', array('rusr_otp' => null, 'rusr_phone_verified' => 1, 'active' => 1));
               return $userDetails;
          } else {
               return false;
          }
     }
     function verifyPhoneNumberNew($phone, $otp)
     {

          $userDetails = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone', 'usr_location', 'usr_allt_number'))
               ->where(array('phone' => $phone, 'rusr_otp' => $otp))->get(rana_users)->row_array();
          if (!empty($userDetails)) {
               $this->db->where('phone', $phone)->update(rana_users, array('rusr_otp' => null, 'rusr_phone_verified' => 1, 'active' => 1));
               return $userDetails;
          } else {
               return false;
          }
     }

     function resendLoginOTP($uid)
     {

          $otp = generate_otp(6);
          $sign = get_settings_by_key('app_sms_signature');
          $userDetails = $this->db->select(array('id', 'username', 'email', 'first_name', 'last_name', 'phone', 'usr_location', 'usr_allt_number'))
               ->where(array('id' => $uid))->get(rana_users)->row_array();

          if (!empty($userDetails)) {
               $this->db->where('id', $uid)->update(rana_users, array('rusr_otp' => $otp, 'rusr_phone_verified' => 0, 'active' => 0));
               //zxHCyGcR9Iv
               //$msg = '<#> ' . $otp . ', is your code to access Royaldrive ' . $sign;
               $msg = "<#>" . $otp . " , is your OTP to access Royal Drive - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
               send_sms($msg, $userDetails['phone'], 'send app resent otp', 4, 1607100000000133427);
               return array('uid' => $uid, 'otp' => $otp);
          }
     }
   function updateuser($data)
     {
          $id = isset($data['id']) ? $data['id'] : 0;
          unset($data['id']);
          $this->db->where('id', $id)->update(rana_users, $data);
          return true;
     }

     /**
      * Event 1: Incoming call landed on server
      * @param int $datas
      * @return boolean
      */
     function clrbridgingincomcallland($datas)
     {
          if (!empty($datas)) {
               $datas['ccb_call_type'] = 1;
               $datas['ccb_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging, array_filter($datas));
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridgingincomcallland',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     /**
      * Event 2: Call answered by an agent
      * @param int $datas
      * @return boolean
      */
     function clrbridgingcallanswdagent($datas)
     {
          if (!empty($datas)) {
               //Authorized person
               if (isset($datas['ccb_AgentNumber']) && !empty($datas['ccb_AgentNumber'])) {
                    $staff = $this->getTLByPhone($datas['ccb_AgentNumber']);
                    $datas['ccb_authorized_person'] = isset($staff['usr_username']) ? $staff['usr_username'] : '';
                    $datas['ccb_authorized_person_id'] = isset($staff['usr_id']) ? $staff['usr_id'] : 0;
               }
               //Authorized person
               $datas['ccb_call_type'] = 2;
               $datas['ccb_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging, array_filter($datas));
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridgingcallanswdagent',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     /**
      * Event 3: When a call is disconnected
      * @param int $datas
      * @return boolean
      */
     function clrbridgingcalldisconnected($datas)
     {
          if (!empty($datas)) {
               //Authorized person
               if (isset($datas['ccb_AgentNumber']) && !empty($datas['ccb_AgentNumber'])) {
                    $staff = $this->getTLByPhone($datas['ccb_AgentNumber']);
                    $datas['ccb_authorized_person'] = isset($staff['usr_username']) ? $staff['usr_username'] : '';
                    $datas['ccb_authorized_person_id'] = isset($staff['usr_id']) ? $staff['usr_id'] : 0;
               }
               //Authorized person
               $datas['ccb_call_type'] = 3;
               $datas['ccb_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging, array_filter($datas));
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridgingcalldisconnected',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     /**
      * Event 3: When a call is disconnected
      * @param int $datas
      * @return boolean
      */
     function clrbridgingcallcallend($datas)
     {
          if (!empty($datas)) {
               //Authorized person
               if (isset($datas['ccb_AgentNumber']) && !empty($datas['ccb_AgentNumber'])) {
                    $staff = $this->getTLByPhone($datas['ccb_AgentNumber']);
                    $datas['ccb_authorized_person'] = isset($staff['usr_username']) ? $staff['usr_username'] : '';
                    $datas['ccb_authorized_person_id'] = isset($staff['usr_id']) ? $staff['usr_id'] : 0;
               }
               //Authorized person
               $datas['ccb_call_type'] = 4;
               $datas['ccb_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging, array_filter($datas));
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridgingcallcallend',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     /**
      * Event 4: when an outgoing call initiated
      * @param type $datas
      */
     function clrbridginginicallout($datas)
     {
          if (!empty($datas)) {
               $datas['ccbo_call_type'] = 5;
               $datas['ccbo_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging_outgoing, $datas);
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridginginicallout',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     /**
      * Event 5: CDR push at the end of the call
      * @param int $datas
      * @return boolean
      */
     function clrbridgingendoutcall($datas)
     {
          if (!empty($datas)) {

               if (isset($datas['ccbo_extension']) && !empty($datas['ccbo_extension'])) {
                    $staff = $this->getTLByPhone($datas['ccbo_extension']);
                    $datas['ccbo_destination_user'] = isset($staff['usr_username']) ? $staff['usr_username'] : '';
                    $datas['ccbo_destination_user_id'] = isset($staff['usr_id']) ? $staff['usr_id'] : 0;
               }

               $datas['ccbo_call_type'] = 6;
               $datas['ccbo_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
               $this->db->insert($this->tbl_callcenterbridging_outgoing, $datas);
               $id = $this->db->insert_id();
               generate_log(array(
                    'log_title' => 'Cal bridging API',
                    'log_desc' => serialize($datas),
                    'log_controller' => 'clrbridgingendoutcall',
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_added_by' => 0
               ));
          }
          return false;
     }

     function getTLByPhone($phone)
     {
          $cusMobile = trim(substr($phone, -10));
          return $this->db->select('usr_id, usr_phone, usr_first_name, usr_username, usr_active')->where('usr_active', 1)
               ->like('usr_phone', $cusMobile, 'both')->or_like('usr_voxbay_uid', $cusMobile, 'both')
               ->get($this->tbl_users_cpnl)->row_array();
     }

     function getAllCars($id = '')
     {

          $selectFields = array(
               'prd_id', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
               $this->tbl_vehicle_colors . '.vc_color AS prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked', 'IF(prd_show_price = 1, prd_price, 0) AS price',
               'prd_km_run AS kms', 'prd_fual AS fuel', "CONCAT('" . PRODUCT_BASE_URL . "380X238_'," . 'pdi_image) AS image',
          );

          if (!empty($id)) {
               $this->db->select($selectFields, FALSE);
               $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
               $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
               $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
               $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
               $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
               $this->db->where("prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_added_by_user='0'");
               $this->db->order_by('prd_price', 'DESC');
               $this->db->where('prd_id', $id);
               $vechicles['cars'] = $this->db->get($this->tbl_products)->row_array();
               $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
               $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
               return $vechicles;
          }

          /* not book or sold */
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
          $ntBkdSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
               ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
               ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')->where($where)->order_by('prd_price', 'DESC')->get($this->tbl_products)->result_array();

          /* Booked but not sold */
          $selectFields = array(
               'prd_id', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
               $this->tbl_vehicle_colors . '.vc_color AS prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', '0 AS prd_booked', 'IF(prd_show_price = 1, prd_price, 0) AS price',
               'prd_km_run AS kms', 'prd_fual AS fuel', "CONCAT('" . PRODUCT_BASE_URL . "380X238_'," . 'pdi_image) AS image',
          );
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '1' AND prd_soled = '0'";
          $bkdNotSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
               ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
               ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')->where($where)->order_by('prd_price', 'DESC')->get($this->tbl_products)->result_array();

          /* Only sold */
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_soled = '1'";
          $sld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
               ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
               ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')->where($where)->order_by('prd_price', 'DESC')->get($this->tbl_products)->result_array();

          $vechicles['cars'] = array_merge($ntBkdSld, $bkdNotSld, $sld);
          $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
          $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";

          return $vechicles;
     }

     /* function getAllCars($id) {
         $this->db->select('prd_rd_mini,prd_id,brd_title,mod_title,var_variant_name,prd_year,prd_owner AS ownership,prd_color,prd_rd_mini,prd_popular,prd_latest,prd_soled,prd_booked,prd_price AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS image', FALSE);
         $this->db->from($this->tbl_products);
         $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
         $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
         $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
         $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
         $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";

         $this->db->where($where);

         $this->db->order_by('prd_order');
         if (!empty($id)) {
         $this->db->where('prd_id', $id);
         $vechicles['cars'] = $this->db->get()->row_array();
         } else {
         $vechicles['cars'] = $this->db->get()->result_array();
         }
         $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
         $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";

         return $vechicles;
         } */

     function emicalculator($data)
     {
          $this->rate = $data['emi_int_per'] / 100 / 12;
          $this->principle = $data['emi_loan_amt'];
          $this->time = $data['emi_tenure'] * 12; // in month
          $this->x = pow(1 + $this->rate, $this->time);
          $this->monthly = ($this->principle * $this->x * $this->rate) / ($this->x - 1);
          $this->monthly = round($this->monthly);
          $this->k = $this->time;

          $data['start_date'] = isset($data['start_date']) ? $data['start_date'] : '';
          $this->getNextMonth($data['start_date']);

          $this->upto = $this->time;
          $this->payment_date = date("Y m,d");

          $this->getEmi($data['emi_loan_amt']);

          return array(
               'monthly' => $this->monthly,
               'ttlPay' => $this->tp,
               'totalint' => $this->totalint,
               'details' => $this->details
          );
     }

     function getNextMonth($date)
     {
          if ($this->k == 0) {
               return 0;
          }
          $date = new DateTime($date);
          $interval = new DateInterval('P1M');
          $date->add($interval);
          $nextMonth = $date->format('Y-m-d') . "\n";
          $this->arr[] = $nextMonth;
          $this->k--;
          return $this->getNextMonth($nextMonth);
     }

     function getEmi($t)
     {
          $this->i++;
          if ($this->upto <= 0) {
               return 0;
          }
          $r = $t * $this->rate;
          $p = round($this->monthly - $r);
          $e = round($t - $p);
          if ($this->upto == 2) {
               $this->session->set_userdata('redirect_after_login', $e);
          }
          if ($this->upto == 1) {
               $p = $this->session->userdata('redirect_after_login');
               $e = round($t - $p);
               $this->monthly = round($p + $r);
          }
          $this->totalint = $this->totalint + $r;
          $this->tp = $this->tp + $this->monthly;
          $this->upto--;

          $this->details[] = array(
               'slno' => $this->i,
               'paymentDate' => date("M j, Y", strtotime($this->arr[$this->i - 1])),
               'interest' => number_format(round($r)),
               'beginningBalance' => number_format($t),
               'principle' => number_format($p),
               'totalPayment' => number_format($this->monthly),
               'endingBalance' => number_format(round($e))
          );
          return $this->getEmi($e);
     }
     function featured($id)
     { //jsk


          $this->db->select('prd_id,mod_title,brd_title,prd_year,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color' . ',prd_rd_mini,prd_popular,prd_latest,prd_soled,prd_booked,IF(prd_show_price = 1, prd_price, 0) AS price,
                         prd_km_run AS kms,prd_fual AS fuel,brd_category,mod_is_ev,CONCAT("' . PRODUCT_BASE_URL . '", ' . ', pdi_image) AS image', FALSE);
          $this->db->from($this->tbl_products);
          $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
          $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
          $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
          $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
          //  $where = "prd_added_by_user='0' AND prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";
          $this->db->where($where);
          $this->db->order_by('prd_order');
          $vechicles = array();
          $this->db->where('prd_featured', 1);
          if ($id) {
               $this->db->where('prd_id', $id);
               $vechicles = $this->db->get()->row_array();
               return $vechicles;
          }
          $vechicles = $this->db->get()->result_array();
          //var_dump($this->db->last_query());
          return $vechicles;
     }
     //
     function getCareerPosts($id = '') {//jsk
         // debug(765);
          if (!empty($id)) {
               return $this->db->get_where($this->tbl_careers, array('car_id' => $id))->row_array();
          }
          return $this->db->where('car_status', 1)->order_by('car_order', 'ASC')->get($this->tbl_careers)->result_array();
     }

     function newCareer($data) {//jsk
          if (!empty($data)) {
               $this->db->insert($this->tbl_careers_applications, $data);
               return true;
          } else {
               return false;
          }
     }
     function getDistricts() {//jsk
         // debug(333);
          return $this->db->where('std_state > 0')->order_by('std_district_name', 'ASC')
                  ->get($this->tbl_district_statewise)->result_array();
     }
     function newBooking($data) {//jsk
          if (!empty($data)) {
               $this->db->insert($this->tbl_web_booking, $data);
               return true;
          } else {
               return false;
          }
     }

     //@
}
