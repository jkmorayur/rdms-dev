<?php

  $CI = get_instance();

  /**
   * Function for crop image with jcrop
   * @param array $upload_data
   * @param array $postDatas
   * @return boolean
   */
  function crop($upload_data, $postDatas) {
       $CI = & get_instance();

       $x1 = $postDatas['x1'];
       $x1 = isset($x1['0']) ? $x1['0'] : '';

       $x2 = $postDatas['x2'];
       $x2 = isset($x2['0']) ? $x2['0'] : '';

       $y1 = $postDatas['y1'];
       $y1 = isset($y1['0']) ? $y1['0'] : '';

       $y2 = $postDatas['y2'];
       $y2 = isset($y2['0']) ? $y2['0'] : '';

       $w = $postDatas['w'];
       $w = isset($w['0']) ? $w['0'] : '';

       $h = $postDatas['h'];
       $h = isset($h['0']) ? $h['0'] : '';

       $CI->load->library('image_lib');

       $image_config['image_library'] = 'gd2';
       $image_config['source_image'] = $upload_data["file_path"] . $upload_data["file_name"];
       $image_config['new_image'] = $upload_data["file_path"] . $upload_data["file_name"];
       $image_config['quality'] = "100%";
       $image_config['maintain_ratio'] = FALSE;
       $image_config['x_axis'] = $x1;
       $image_config['y_axis'] = $y1;
       $image_config['width'] = $w;
       $image_config['height'] = $h;

       $CI->image_lib->initialize($image_config);
       $CI->image_lib->crop();
       $CI->image_lib->clear();

       /* Second size */
       $configSize2['image_library'] = 'gd2';
       $configSize2['source_image'] = $upload_data["file_path"] . $upload_data["file_name"];
       $configSize2['create_thumb'] = TRUE;
       $configSize2['maintain_ratio'] = TRUE;
       $width = get_settings_by_key('thumbnail_width');
       $height = get_settings_by_key('thumbnail_height');
       $configSize2['width'] = !empty($width) ? $width : DEFAULT_THUMB_W;
       $configSize2['height'] = !empty($height) ? $height : DEFAULT_THUMB_H;
       $configSize2['new_image'] = 'thumb_' . $upload_data["file_name"];

       $CI->image_lib->initialize($configSize2);
       $CI->image_lib->resize();
       $CI->image_lib->clear();

       return true;
  }

  function watermark($source, $image = true) {
       global $CI;
       if ($image) {
            $config['source_image'] = $source;
            $config['new_image'] = $source;
            $config['wm_type'] = 'overlay';
            $config['wm_opacity'] = 1;
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'right';
            $config['wm_overlay_path'] = 'rdportal/assets/images/watermark.png';
       } else {
            $config['source_image'] = '/path/to/image/mypic.jpg';
            $config['wm_text'] = '<watermark text here>';
            $config['wm_type'] = 'text';
            //$config['wm_font_path'] = './system/fonts/texb.ttf';
            $config['wm_font_size'] = '16';
            $config['wm_font_color'] = 'ffffff';
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'center';
            $config['wm_padding'] = '20';
       }
       $CI->image_lib->initialize($config);
       $CI->image_lib->watermark();
       echo $CI->image_lib->display_errors();
  }

  function resize_image($upload_data) {

       global $CI;
       $CI->load->library('image_lib');
       /* Second size */
       $configSize2['image_library'] = 'gd2';
       $configSize2['source_image'] = $upload_data["file_path"] . $upload_data["file_name"];
       $configSize2['create_thumb'] = TRUE;
       $configSize2['maintain_ratio'] = TRUE;
       $width = get_settings_by_key('thumbnail_width');
       $height = get_settings_by_key('thumbnail_height');
       $configSize2['width'] = !empty($width) ? $width : DEFAULT_THUMB_W;
       $configSize2['height'] = !empty($height) ? $height : DEFAULT_THUMB_H;
       $configSize2['new_image'] = 'thumb_' . $upload_data["file_name"];
       watermark($upload_data["file_path"] . $upload_data["file_name"]);
       $CI->image_lib->initialize($configSize2);
       $CI->image_lib->resize();
       $CI->image_lib->clear();
  }

  function get_options($array, $parent = 0, $indent = "") {
       $return = array();
       foreach ($array as $key => $val) {
            if ($val["parent_category_id"] == $parent) {
                 $return["x" . $val["category_id"]] = $indent . $val["category_name"];
                 $return = array_merge($return, get_options($array, $val["category_id"], $indent . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"));
            }
       }
       return $return;
  }

  function getCategories() {
       global $CI;
       $CI->load->model('home_model');
       return $CI->home_model->getCategories();
  }

  function getParentCategories() {
       global $CI;
       $CI->load->model('home_model');
       return $CI->home_model->getParentCategories();
  }

  function debug($array = array(), $exit = 1) {
       echo '<pre>';
       print_r($array);
       if ($exit == 1)
            exit;
  }

  function getCaptcha() {
       $number1 = rand(1, 9999);
       $number2 = rand(1, 9999);
       return $number1 + $number2;
  }

  function getPaginationDesign() {
       $config['full_tag_open'] = '<ul class="pagination">';
       $config['full_tag_close'] = '</ul>';
       $config['prev_link'] = 'Previous';
       $config['prev_tag_open'] = '<li>';
       $config['prev_tag_close'] = '</li>';
       $config['next_link'] = 'Next';
       $config['next_tag_open'] = '<li>';
       $config['next_tag_close'] = '</li>';
       $config['cur_tag_open'] = '<li class="active"><a href="">';
       $config['cur_tag_close'] = '</a></li>';
       $config['num_tag_open'] = '<li>';
       $config['num_tag_close'] = '</li>';

       $config['first_tag_open'] = '<li>';
       $config['first_tag_close'] = '</li>';
       $config['last_tag_open'] = '<li>';
       $config['last_tag_close'] = '</li>';

       $config['first_link'] = '&laquo;';
       $config['last_link'] = '&raquo;';
       return $config;
  }

  function get_state_province($id = '') {
       global $CI;
       $CI->db->order_by('stat_long_name');
       return $CI->db->select('*')->get('gtech_state_province')->result_array();
  }

  function get_country_list($id = '') {
       global $CI;
       $CI->db->order_by('ctr_country');
       return $CI->db->select('*')->get('gtech_country')->result_array();
  }

  function get_hashed_password($pass) {
       if ($pass) {
            return base64_encode(base64_encode(base64_encode($pass)));
       }
  }

  function check_login() {

       global $CI;
       $userdata = $CI->session->userdata('gtech_logged_user');

       if (isset($userdata) &&
               !empty($userdata)) {
            return true;
       } else {
            return false;
       }
  }

  function get_logged_user($key = '') {
       if (check_login()) {
            global $CI;
            $CI->load->model('user/user_model');
            $userdata = $CI->session->userdata('gtech_logged_user');
            $id = $userdata['id'];
            if (empty($key)) {
                 return $CI->user_model->getUser($id);
            } else {
                 $userdata = $CI->user_model->getUser($id);
                 return isset($userdata[$key]) ? $userdata[$key] : '';
            }
       } else {
            return null;
       }
  }

  /* Settings */

  function get_settings_by_key($key) {
       if ($key) {
            global $CI;
            $CI->load->model('common_model');
            $settings = $CI->common_model->getSettings($key);
            return isset($settings['set_value']) ? $settings['set_value'] : '';
       } else {
            return false;
       }
  }

  if (!function_exists('translate')) {

       function translate($text, $d = '') {
            $s = 'en';
            if ($d == '') {
                 $d = 'en';
            }
            if ($d != 'en') {
                 $lang_pair = urlencode($s . '|' . $d);
                 $q = rawurlencode($text);
                 // Google's API translator URL
                 $url = "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=" . $q . "&langpair=" . $lang_pair;
                 // Make sure to set CURLOPT_REFERER because Google doesn't like if you leave the referrer out
                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                 curl_setopt($ch, CURLOPT_REFERER, "http://www.yoursite.com/translate.php");
                 $body = curl_exec($ch);
                 curl_close($ch);
                 $json = json_decode($body, true);
                 $tranlate = $json['responseData']['translatedText'];
                 echo $tranlate;
            } else {
                 echo $text;
            }
       }

  }

  if (!function_exists('get_url_string')) {

       function get_url_string($text) {
            $text = trim(strtolower($text));
            $text = str_replace(' ', '-', $text);
            $text = str_replace('/', '-', $text);
            $text = str_replace('---', '-', $text);
            $text = str_replace('--', '-', $text);
            return $text;
       }

  }

  if (!function_exists('get_filter_type')) {

       function get_filter_type($id = '') {
            global $CI;
            $CI->load->model('products/products_model');
            return $CI->products_model->getCategories();
       }

  }

  if (!function_exists('get_footer_categories')) {

       function get_footer_categories() {
            global $CI;
            $CI->load->model('products/products_model');
            return $CI->products_model->getFooterCategories();
       }

  }

  if (!function_exists('get_original_password')) {

       function get_original_password($hash) {
            if ($hash) {
                 return base64_decode(base64_decode(base64_decode($hash)));
            }
       }

  }
  /* Settings */

  function putquote($val) {
       return '"' . $val . '"';
  }

  function abbr_number($size) {
       $size = preg_replace('/[^0-9]/', '', $size);
       $sizes = array("", " K +", " M +");
       if ($size == 0) {
            return('n/a');
       } else {
            return (round($size / pow(1000, ($i = floor(log($size, 1000)))), 0) . '.0' . $sizes[$i]);
       }
  }

  function format_size($size) {
       $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
       if ($size == 0) {
            return('n/a');
       } else {
            return (round($size / pow(1024, ($i = floor(log($size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i]);
       }
  }

  /* Get snippet text */

  function get_snippet($str, $wordCount = 10) {
       $count = str_word_count($str);
       $word = implode(
               '', array_slice(
                       preg_split(
                               '/([\s,\.;\?\!]+)/', $str, $wordCount * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                       ), 0, $wordCount * 2 - 1
               )
       );
       return ($count > $wordCount) ? $word . '...' : $word;
  }

  /**
   * Generate random number
   * @return int
   */
//function check_permission($controller, $method) {//
//     global $CI;
//     return $CI->check_permission($controller, $method);
//}
  
  function getUserAcess($user_id) {/*jsk*/ 
         global $CI;
       $userAccess = $CI->common_model->getUser($user_id);
        $userAccess = isset($userAccess['cua_access']) ? $userAccess['cua_access'] : '';
        return $userAccess;
       
  }
  function check_permission($user_id,$userAccess,$controller = '', $method = '') {
       /* reffered 
      C:\wamp64\www\royalportal\rdportal\application\core\App_Controller.php
       check function check_permission and check line 128 */
  $access = $userAccess;
   if ($user_id == ADMIN_ID) {
            return true;
       }

       $controller = $controller ?: $this->router->fetch_class();
       $method = $method ?: $this->router->fetch_method();

       if (is_serialized($access)) {
            $access = unserialize($access);
       }
      // debug($access);
       $controller = strtolower(trim($controller));
       $method = strtolower(trim($method));
       global $CI;
//     $CI->load->model('home_model');
//     return $CI->home_model->getParentCategories();
       $modules_exclude = $CI->config->item('modules_exclude');

       if (isset($modules_exclude[$controller]) && !empty($modules_exclude[$controller]) &&
               is_array($modules_exclude[$controller]) && key_exists($method, $modules_exclude[$controller])) {
            return true;
       }

       if (!empty($access) && is_array($access)) {

            if (isset($access[$controller]) && !empty($access[$controller]) &&
                    is_array($access[$controller]) && in_array($method, $access[$controller])
            ) {
                 return true;
            } else {
                 return false;
            }
       } else {
            return false;
       }
  }

  function gen_random() {
       return time() + rand(0, 999999);
  }

  /**
   * 
   * @param string $action
   * @param string $string
   * @return If passing E get a encripted string, If passing D get a decripted string, 
   */
  function encryptor($string, $action = 'E') {
       //do the encyption given text/string/number
       if ($action == 'E') {
            $output = encode($string);
       } else if ($action == 'D') {
            $output = decode($string);
       }
       return $output;
  }

  define('skey', "SuPerEncKey20018");

  function safe_b64encode($string) {

       $data = base64_encode($string);
       $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
       return $data;
  }

  function safe_b64decode($string) {
       $data = str_replace(array('-', '_'), array('+', '/'), $string);
       $mod4 = strlen($data) % 4;
       if ($mod4) {
            $data .= substr('====', $mod4);
       }
       return base64_decode($data);
  }

  function encode($value) {

       if (!$value) {
            return false;
       }
       $text = $value;
       $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, skey, $text, MCRYPT_MODE_ECB, $iv);
       return trim(safe_b64encode($crypttext));
  }

  function decode($value) {

       if (!$value) {
            return false;
       }
       $crypttext = safe_b64decode($value);
       $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, skey, $crypttext, MCRYPT_MODE_ECB, $iv);
       return trim($decrypttext);
  }

  function generate_log($logData, $table = "general_log") {
       global $CI;
       $CI->common_model->generateLog($logData, $table);
  }

  function strip_specific_tag($string, $tag) {
       if (!empty($string) && !empty($tag)) {
            $tag = explode(',', $tag);
            $completeTags = array();
            foreach ((array) $tag as $key => $value) {
                 $completeTags[] = '<' . $value . '>';
                 $completeTags[] = '</' . $value . '>';
            }
            return str_replace($completeTags, "", $string);
       }
       return null;
  }

  /**
   * Clean the text and also remove -
   * @return int
   */
  function clean_text($name, $ucfirst = 1) {
       $name = strip_tags($name); // Strip tags.
       $name = trim(preg_replace("/\s+/", ' ', $name)); // Remove multiple space in between words.
       $name = str_replace('-', ' ', $name); // Replaces all hyphens with spaces.
       if ($ucfirst) {
            return ucfirst(preg_replace('/[^A-Za-z0-9\-]/', ' ', $name));
       }
       return preg_replace('/[^A-Za-z0-9\-]/', ' ', $name);
  }

  function send_otp_sms($msg, $mob, $route = 4) {

       /*
         type = 1 for Normal SMS
         type = 2 for Unicode SMS

         route = 1 for Promotional SMS
         route = 2 for Transactional SMS
         route = 4 for OTP
        */
       $CI = & get_instance();
       $senderid = get_settings_by_key('sms_sender_id');
       $username = get_settings_by_key('sms_username');
       $password = get_settings_by_key('sms_password');

       $msg = urlencode($msg);

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "https://sms.xpresssms.in/api/api.php?");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, "ver=1&mode=1&action=push_sms&type=1&route=" . $route . "&login_name=" . $username . "&api_password=" . $password . "&message=" . $msg . "&number=" . $mob . "&sender=" . $senderid);
       $buffer = curl_exec($ch);
       curl_close($ch);

       generate_log(array(
           'log_title' => 'sent sms',
           'log_desc' => 'https://sms.xpresssms.in/api/api.php?' . "ver=1&mode=1&action=push_sms&type=1&route=" . $route . "&login_name=" . $username . "&api_password=" . $password . "&message=" . $msg . "&number=" . $mob . "&sender=" . $senderid,
           'log_controller' => 'sms-send',
           'log_action' => 'C',
           'log_ref_id' => 0,
           'log_added_by' => 0
       ));

       return $buffer;
  }

  function generate_otp($n = 4) {

       // Take a generator string which consist of 
       // all numeric digits 
       $generator = "1357902468";

       // Iterate for n-times and pick a single character 
       // from generator and append it to $result 
       // Login for generating a random character from generator 
       //     ---generate a random number 
       //     ---take modulus of same with length of generator (say i) 
       //     ---append the character at place (i) from generator to result 

       $result = "";

       for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
       }

       // Return result 
       return $result;
  }

  function inr_currency_format($inr, $symbol = true) {
       if ($symbol) {
            return '₹ ' . preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $inr);
       }
       return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $inr);
  }

  function can_access_module($module) {
       global $CI;
       if (empty($CI->usr_grp)) {
            return false;
       } else if ($CI->usr_grp == 'SA' || $CI->uid == ADMIN_ID) {
            return true;
       } else if (!empty($module)) {
            if (is_serialized($CI->userAccess)) {
                 $access = unserialize($CI->userAccess);
                 if (key_exists($module, $access)) {
                      return true;
                 } else {
                      return false;
                 }
            } else {
                 return false;
            }
       } else {
            return false;
       }
  }

  function cms($secslug) {
       global $CI;
       $cms = $CI->common_model->getContent($secslug);
       echo $cms['cnt'];
       if (can_access_module('seo', 'setpagecms')) {
            echo '<a style="float:left;" target="blank" href="' . site_url("rdportal/seo/setPagecms/" . $cms['id']) . '"><i class="fa fa-pencil"></i></a>';
       }
  }

  function is_serialized($data) {
       return (is_string($data) && preg_match("#^((N;)|((a|O|s):[0-9]+:.*[;}])|((b|i|d):[0-9.E-]+;))$#um", $data));
  }

  function generate_vehicle_virtual_id($input) {
       if (!empty($input)) {
            $input = md5($input);
            $input = preg_replace("/[^0-9,.]/", "", $input);
            return substr($input, 0, 6);
       } else {
            return false;
       }
  }

  function is_indian_number($mobile_number) {
       $mobile_number = trim($mobile_number);
       $zno = substr($mobile_number, 0, 3);
       $zzno = substr($mobile_number, 0, 4);
       if ($zno == '091') {
            $mobile_number = substr_replace($mobile_number, '91', 0, 3);
       } else if ($zzno == '0091') {
            $mobile_number = substr_replace($mobile_number, '91', 0, 4);
       }

       if (preg_match("#^(\+){0,1}(91){0,1}(-|\s){0,1}[0-9]{10}$#", $mobile_number)) {
            return $mobile_number;
       } else {
            return false;
       }
  }

  function send_sms($msg, $mob, $logtitle, $tmpId = '', $route = 2) {
       $senderid = get_settings_by_key('sms_sender_id');
       $username = get_settings_by_key('sms_username');
       $password = get_settings_by_key('sms_password');

       $msg = urlencode($msg);
       $ch = curl_init();

       curl_setopt($ch, CURLOPT_URL, "https://sms.xpresssms.in/api/api.php?");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, "ver=1&mode=1&action=push_sms&type=1&route=" . $route . "&login_name=" . $username . "&api_password=" . $password . "&message=" .
               $msg . "&number=" . $mob . "&sender=" . $senderid . "&template_id=" . $tmpId);
       $buffer = curl_exec($ch);

       $output['resp'] = $buffer;
       $output['msg'] = $msg;
       $output['tmpId'] = $tmpId;
       curl_close($ch);
       generate_log(array(
           'log_title' => $logtitle,
           'log_desc' => serialize($output),
           'log_controller' => 'SMS',
           'log_action' => 'C',
           'log_ref_id' => 0,
           'log_added_by' => 100
       ));
       return $output['resp'];
  }

  function get_logged_user_for_api($key = '', $id) {
       global $CI;
       //  $id = $CI->session->userdata['usr_user_id'];
       if (empty($key)) {
            return $CI->common_model->getUser($id);
       } else {
            $userdata = $CI->common_model->getUser($id);
            return isset($userdata[$key]) ? $userdata[$key] : '';
       }
  }
function get_km_ranges($id='') {
     global $CI;
     return $CI->common_model->getKMRanges($id);
}

function get_price_ranges($id='') {
     global $CI;
     return $CI->common_model->getPriceRanges($id);
}

function getVehicleColors($id='') {
     global $CI;
     return $CI->common_model->getVehicleColors($id);
}
function is_roo_user($usr_grp) {
        if ($usr_grp == 'MD' || $usr_grp == 'VP' || $usr_grp == 'AD' || $usr_grp == 'CEO') {
          return true;
     } else {
          return false;
     }
}
//jsk
  function amount_in_words($number) {
       $decimal = round($number - ($no = floor($number)), 2) * 100;
       $hundred = null;
       $digits_length = strlen($no);
       $i = 0;
       $str = array();
       $words = array(0 => '', 1 => 'One', 2 => 'Two',
           3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
           7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
           10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
           13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
           16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
           19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
           40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
           70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
       $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
       while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                 $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                 $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                 $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else
                 $str[] = null;
       }
       $Rupees = implode('', array_reverse($str));
       $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
       return ($Rupees ? $Rupees : '') . $paise;
  }//JK
?>