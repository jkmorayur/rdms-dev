<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class Rest_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          //$this->load->helper('common_helper');
          //   $this->load->database();
          $this->load->database();
          // $this->table = TABLE_PREFIX . 'users';
          $this->tbl_divisions = TABLE_PREFIX_PORTAL . 'divisions';
          $this->tbl_showroom = TABLE_PREFIX_PORTAL . 'showroom';
          $this->tbl_departments = TABLE_PREFIX_PORTAL . 'departments';
          $this->tbl_users = TABLE_PREFIX_PORTAL . 'users';
          $this->tbl_users_groups = TABLE_PREFIX_PORTAL . 'users_groups';
          $this->tbl_groups = TABLE_PREFIX_PORTAL . 'groups';
          $this->tbl_model = TABLE_PREFIX . 'model';
          $this->tbl_brand = TABLE_PREFIX . 'brand';
          $this->tbl_variant = TABLE_PREFIX . 'variant';
          $this->tbl_events = TABLE_PREFIX_PORTAL . 'events';
          $this->tbl_enquiry = TABLE_PREFIX_PORTAL . 'enquiry';
          $this->tbl_register_master = TABLE_PREFIX_PORTAL . 'register_master';
          $this->tbl_occupation = TABLE_PREFIX_PORTAL . 'occupation';
          $this->tbl_city = TABLE_PREFIX_PORTAL . 'city';
          $this->tbl_vehicle = TABLE_PREFIX_PORTAL . 'vehicle';
          $this->tbl_followup = TABLE_PREFIX_PORTAL . 'followup';
          $this->view_enquiry_vehicle_master = TABLE_PREFIX_PORTAL . 'view_enquiry_vehicle_master';
          $this->tbl_statuses = TABLE_PREFIX_PORTAL . 'statuses';
          $this->tbl_enquiry_questions = TABLE_PREFIX_PORTAL . 'enquiry_questions';
          $this->tbl_district = TABLE_PREFIX_PORTAL . 'district_statewise';
          $this->tbl_district_statewise = TABLE_PREFIX_PORTAL . 'district_statewise';
          $this->tbl_state = TABLE_PREFIX_PORTAL . 'state';
          $this->tbl_country = TABLE_PREFIX_PORTAL . 'country';
          $this->tbl_customer_grade = TABLE_PREFIX_PORTAL . 'customer_grade';
          $this->tbl_questions = TABLE_PREFIX_PORTAL . 'questions';
          $this->tbl_enquiry_questions = TABLE_PREFIX_PORTAL . 'enquiry_questions';
          $this->tbl_enquiry_history = TABLE_PREFIX_PORTAL . 'enquiry_history';
          $this->tbl_district_statewise = TABLE_PREFIX_PORTAL . 'district_statewise';
          $this->tbl_register_history = TABLE_PREFIX_PORTAL . 'register_history';
          $this->tbl_valuation = TABLE_PREFIX_PORTAL . 'valuation';
          $this->tbl_callcenterbridging = TABLE_PREFIX_PORTAL . 'callcenterbridging';
          $this->tbl_occupation_category = TABLE_PREFIX_PORTAL . 'occupation_categories';
          $this->tbl_purpose_of_purchase = TABLE_PREFIX_PORTAL . 'purpose_of_purchase';
          $this->tbl_supplier_grade = TABLE_PREFIX_PORTAL . 'customer_grade';
          $this->tbl_banks = TABLE_PREFIX_PORTAL . 'banks';
          $this->tbl_departments = TABLE_PREFIX_PORTAL . 'departments';
          $this->tbl_divisions = TABLE_PREFIX_PORTAL . 'divisions';
          $this->tbl_insurers = TABLE_PREFIX_PORTAL . 'insurers';
          $this->tbl_vehicle_features = TABLE_PREFIX_PORTAL . 'vehicle_features';
          $this->tbl_valuation_ful_bd_chkup_master = TABLE_PREFIX_PORTAL . 'valuation_ful_bd_chkup_master';
          $this->tbl_products = TABLE_PREFIX . 'products';
          $this->tbl_valuation_complaint = TABLE_PREFIX_PORTAL . 'valuation_complaint';
          $this->tbl_valuation_documents = TABLE_PREFIX_PORTAL . 'valuation_documents';
          $this->tbl_valuation_features = TABLE_PREFIX_PORTAL . 'valuation_features';
          $this->tbl_valuation_complaint = TABLE_PREFIX_PORTAL . 'valuation_complaint';
          $this->tbl_valuation_documents = TABLE_PREFIX_PORTAL . 'valuation_documents';
          $this->tbl_valuation_veh_images = TABLE_PREFIX_PORTAL . 'valuation_veh_images';
          $this->tbl_valuation_ful_bd_chkup = TABLE_PREFIX_PORTAL . 'valuation_ful_bd_chkup';
          $this->tbl_valuation_upgrade_details = TABLE_PREFIX_PORTAL . 'valuation_upgrade_details';
          $this->tbl_valuation_ful_bd_chkup_master = TABLE_PREFIX_PORTAL . 'valuation_ful_bd_chkup_master';
          $this->tbl_valuation_ful_bd_chkup_details = TABLE_PREFIX_PORTAL . 'valuation_ful_bd_chkup_details';
          $this->tbl_register_followup = TABLE_PREFIX_PORTAL . 'register_followup';
          $this->tbl_contact_mode = TABLE_PREFIX_PORTAL . 'contact_mode';
     }

     public function getActiveData()
     {
          return $this->db->where('div_status', 1)->get($this->tbl_divisions)->result_array();
     }

     function bindShowroomByDivision($div)
     {
          $return['associatedShowroom'] = $this->db->select($this->tbl_showroom . '.shr_id AS col_id, ' . $this->tbl_showroom . '.shr_location AS col_title')
               ->where(array('shr_division' => $div))->get($this->tbl_showroom)->result_array();

          $return['notAssociatedShowroom'] = $this->db->select($this->tbl_showroom . '.shr_id AS col_id, ' . $this->tbl_showroom . '.shr_location AS col_title')
               ->where(array('shr_division != ' => $div))->get($this->tbl_showroom)->result_array();

          $return['notAssociatedDivision'] = $this->db->select($this->tbl_divisions . '.div_id AS col_id, ' . $this->tbl_divisions . '.div_name AS col_title')
               ->where(array('div_id != ' => $div, 'div_status' => 1))->get($this->tbl_divisions)->result_array();

          $selectArray = array(
               $this->tbl_departments . '.dep_id',
               $this->tbl_departments . '.dep_name',
               $this->tbl_departments . '.dep_is_sale_rel',
               //'parentDep.dep_name AS dep_parent_name'
          );
          $return['departments'] = $this->db->select($selectArray, false)->join($this->tbl_departments . ' parentDep', 'parentDep.dep_id = ' . $this->tbl_departments . '.dep_parent', 'LEFT')->select("IF(parentDep.dep_name IS NULL,'', parentDep.dep_name) as dep_parent_name", FALSE)
               ->where(array($this->tbl_departments . '.dep_status' => 1, $this->tbl_departments . '.dep_division' => $div))
               ->get($this->tbl_departments)->result_array();

          return $return;
     }

     function bindStaffsByShowroom($id, $user_id)
     {
          $this->uid = $user_id;
          //fetch staffs by showroom
          // if (check_permission('registration', 'canselfassignregister')) {
          // $this->db->where('usr_id != ', $this->uid);
          // }
          $salesStaff = $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location,' . $this->tbl_users . '.usr_active')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->where('(' . $this->tbl_groups . ".grp_slug = 'SE' OR " . $this->tbl_groups . ".grp_slug = 'DE' OR " . $this->tbl_groups . ".grp_slug = 'TL')")
               ->where(array($this->tbl_users . '.usr_active' => 1, $this->tbl_users . '.usr_can_auto_assign' => 1, $this->tbl_users . '.usr_showroom' => $id))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();

          //if (check_permission('rest', 'canselfassignregister')) {
          $myself = $this->db->select($this->tbl_users . ".usr_id AS col_id, 'Self' AS col_title, " .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location,' . $this->tbl_users . '.usr_active', false)
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->where(array($this->tbl_users . '.usr_id' => $this->uid))->get($this->tbl_users)->result_array();
          array_splice($salesStaff, 0, 0, $myself); //Insert new item in array on any position;
          //}
          return $salesStaff;
     }

     public function getBrands($id = '')
     {
          $this->db->select("branda.*, brandb.brd_title AS parent")
               ->from($this->tbl_brand . ' branda')
               ->join($this->tbl_brand . ' brandb', 'branda.brd_parent = brandb.brd_id', 'left');

          if (!empty($id)) {
               $this->db->where('branda.brd_id', $id);
          }
          $this->db->order_by('branda.brd_title', 'asc');
          $brands = $this->db->get()->result_array();
          return $brands;
     }

     function getModelByBrand($id)
     {
          return $this->db->select($this->tbl_model . '.*, mod_id AS col_id, mod_title AS col_title')
               ->where_in('mod_brand', $id)->get($this->tbl_model)->result_array();
     }

     function getVariantByModel($id)
     {
          return $this->db->select($this->tbl_variant . '.*, var_id AS col_id, var_variant_name AS col_title')
               ->where_in('var_model_id', $id)->get($this->tbl_variant)->result_array();
     }

     function getEnquiryByMobile($phoneNo)
     {
          if (!empty($phoneNo)) {
               $cusMobile = substr(trim($phoneNo), -10);
               return $this->db->select($this->tbl_enquiry . '.*,' . $this->tbl_users . '.*')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT')
                    ->like('enq_cus_mobile', $cusMobile, 'before')->get($this->tbl_enquiry)->row_array();
          }
          return false;
     }
     function matchingRegister($phoneNo)
     {
          if (!empty($phoneNo)) {
               $cusMobile = substr($phoneNo, -10);

               $this->db->select($this->tbl_register_master . '.vreg_last_action,' . $this->tbl_register_master . '.vreg_cust_name,' . $this->tbl_register_master . '.vreg_cust_name,' .
                    $this->tbl_register_master . '.vreg_added_on,' . $this->tbl_register_master . '.vreg_customer_remark,' .
                    'asto.usr_id AS assto_usr_id, asto.usr_first_name AS assto_usr_name,' .
                    'adby.usr_id AS adby_usr_id, adby.usr_first_name AS adby_usr_name')
                    ->join($this->tbl_users . ' asto', 'asto.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
                    ->join($this->tbl_users . ' adby', 'adby.usr_id = ' . $this->tbl_register_master . '.vreg_first_owner', 'LEFT')
                    ->order_by($this->tbl_register_master . '.vreg_added_on', 'DESC');
               return $this->db->like('vreg_cust_phone', $cusMobile, 'before')->get($this->tbl_register_master)->result_array();
          }
          return false;
     }

     function matchingInquiry($phoneNo)
     {
          if (!empty($phoneNo)) {
               $cusMobile = substr($phoneNo, -10);

               $this->db->select($this->tbl_enquiry . '.enq_id,' . $this->tbl_users . '.*')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT');
               //->where_in('enq_current_status', $this->myEnqStatuses)
               return $this->db->like('enq_cus_mobile', $cusMobile, 'before')->get($this->tbl_enquiry)->row_array();
          }
          return false;
     }

     function getTrackCardDetails($enqId)
     {

          $enq = $this->db->select($this->tbl_enquiry . '.*,' . $this->tbl_occupation . '.*,' . $this->tbl_city . '.*,'
               . $this->tbl_district . '.*,' . $this->tbl_state . '.*,' . $this->tbl_country . '.*,'
               . $this->tbl_showroom . '.*,' . $this->tbl_users . '.*,'
               . $this->tbl_statuses . '.sts_title,' . $this->tbl_statuses . '.sts_des,' . $this->tbl_customer_grade . '.*')
               ->join($this->tbl_occupation, $this->tbl_occupation . '.occ_id = ' . $this->tbl_enquiry . '.enq_cus_occu', 'left')
               ->join($this->tbl_city, $this->tbl_city . '.cit_id = ' . $this->tbl_enquiry . '.enq_cus_city', 'left')
               ->join($this->tbl_district, $this->tbl_district . '.std_id = ' . $this->tbl_enquiry . '.enq_cus_dist', 'left')
               ->join($this->tbl_state, $this->tbl_state . '.stt_id = ' . $this->tbl_enquiry . '.enq_cus_state', 'left')
               ->join($this->tbl_country, $this->tbl_country . '.cnt_id = ' . $this->tbl_enquiry . '.enq_cus_country', 'left')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_enquiry . '.enq_showroom_id', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'left')
               ->join($this->tbl_statuses, $this->tbl_enquiry . '.enq_current_status = ' . $this->tbl_statuses . '.sts_value', 'left')
               ->join($this->tbl_customer_grade, $this->tbl_customer_grade . '.sgrd_id = ' . $this->tbl_enquiry . '.enq_customer_grade', 'left')
               ->order_by($this->tbl_enquiry . '.enq_id', 'DESC')->where($this->tbl_enquiry . '.enq_id', $enqId)->get($this->tbl_enquiry)->row_array();

          if (!empty($enq)) {
               $enq['followup'] = $this->db->select($this->tbl_followup . '.*, ' .
                    $this->tbl_vehicle . '.veh_brand, ' . $this->tbl_vehicle . '.veh_model, ' . $this->tbl_vehicle . '.veh_varient,' .
                    $this->tbl_brand . '.brd_title,' . $this->tbl_model . '.mod_title,' . $this->tbl_variant . '.var_variant_name,' .
                    $this->tbl_users . '.usr_username AS folloup_added_by, ' . $this->tbl_users . '.usr_id AS folloup_added_by_id,' .
                    $this->tbl_users . '.usr_avatar, ' . $this->tbl_showroom . '.shr_location')
                    ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_id = ' . $this->tbl_followup . '.foll_cus_vehicle_id', 'LEFT')
                    ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_vehicle . '.veh_brand', 'LEFT')
                    ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_vehicle . '.veh_model', 'LEFT')
                    ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_vehicle . '.veh_varient', 'LEFT')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_followup . '.foll_added_by', 'LEFT')
                    ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'LEFT')
                    ->order_by($this->tbl_followup . '.foll_id', 'DESC')
                    ->get_where($this->tbl_followup, array($this->tbl_followup . '.foll_cus_id' => $enqId, 'foll_parent' => 0))->result_array();

               $enq['vehicle_sall'] = $this->db->select($this->view_enquiry_vehicle_master . '.*,' . $this->tbl_statuses . '.*')
                    ->join($this->tbl_statuses, $this->tbl_statuses . '.sts_value = ' . $this->view_enquiry_vehicle_master . '.vst_current_status', 'LEFt')
                    ->where($this->view_enquiry_vehicle_master . '.veh_enq_id = ' . $enqId .
                         ' AND ' . $this->view_enquiry_vehicle_master . '.veh_status = 1 AND (' .
                         $this->view_enquiry_vehicle_master . '.vst_current_status != 99 OR ' . $this->view_enquiry_vehicle_master . '.vst_current_status IS NULL)')
                    ->get($this->view_enquiry_vehicle_master)->result_array();

               $enq['vehicle_buy'] = $this->db->select($this->view_enquiry_vehicle_master . '.*,' . $this->tbl_statuses . '.*')
                    ->join($this->tbl_statuses, $this->tbl_statuses . '.sts_value = ' . $this->view_enquiry_vehicle_master . '.vst_current_status', 'LEFt')
                    ->where($this->view_enquiry_vehicle_master . '.veh_enq_id = ' . $enqId .
                         ' AND ' . $this->view_enquiry_vehicle_master . '.veh_status = 2 AND (' .
                         $this->view_enquiry_vehicle_master . '.vst_current_status != 99 OR ' . $this->view_enquiry_vehicle_master . '.vst_current_status IS NULL)')
                    ->get($this->view_enquiry_vehicle_master)->result_array();

               $enq['questions'] = $this->db->select($this->tbl_enquiry_questions . '.*,' . $this->tbl_questions . '.*')
                    ->join($this->tbl_questions, $this->tbl_questions . '.qus_id = ' . $this->tbl_enquiry_questions . '.enqq_question_id', 'LEFT')
                    ->where($this->tbl_enquiry_questions . '.enqq_enq_id', $enqId)->get($this->tbl_enquiry_questions)->result_array();
          }
          return $enq;
     }

     function getShowroom($id = 0, $divId = 0)
     {
          if (!empty($divId)) {
               return $this->db->get_where($this->tbl_showroom, array('shr_division' => $divId))->result_array();
          }
          if (!empty($id)) {
               return $this->db->get_where($this->tbl_showroom, array('shr_id' => $id))->row_array();
          }
          return $this->db->where('shr_status', 1)->get($this->tbl_showroom)->result_array();
     }

     public function createRegistration($regMaster)
     {
         // debug($regMaster);
         // exit;
          //debug($this->uid);
          date_default_timezone_set("Asia/Calcutta");
          $regMaster['vreg_first_owner'] = $this->uid;
          $regMaster['vreg_is_effective'] = (isset($regMaster['vreg_is_effective']) && !empty($regMaster['vreg_is_effective'])) ?
               $regMaster['vreg_is_effective'] : 0;
          $regMaster['vreg_first_added_on'] = date('Y-m-d H:i:s');
          $allCalls = array();
          if (isset($regMaster['vreg_voxbay_ref']) && !empty($regMaster['vreg_voxbay_ref'])) {

               $callerNumber = $this->db->select('ccb_callerNumber')->get_where($this->tbl_callcenterbridging, array('ccb_id' => $regMaster['vreg_voxbay_ref']))->row_array();
               $callerNumber = isset($callerNumber['ccb_callerNumber']) ? $callerNumber['ccb_callerNumber'] : 0;
               if (!empty($callerNumber)) {
                    $callerNumber = substr($callerNumber, -10);
                    $allCalls = $this->db->select('ccb_id')->like('ccb_callerNumber', $callerNumber, 'both')
                         ->where('ccb_punched_by', 0)->get($this->tbl_callcenterbridging)->result_array();
                    $allCalls = array_column($allCalls, 'ccb_id');
               }
               $punchOn = date('Y-m-d H:i:s'); //h -> H 03-12-2020 06:00 AM
               if (!empty($allCalls)) {
                    $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array(
                         'ccb_punched_by' => $this->uid,
                         'ccb_punched_on' => $punchOn, 'ccb_can_show' => 0
                    ));
               }
          }

          if (!isset($regMaster['vreg_assigned_to'])) {
               //Get department details
               $dept = $this->db->get_where($this->tbl_departments, array('dep_id' => $regMaster['vreg_department']))->row_array();

               $regMaster['vreg_assigned_to'] = 0;
               $regMaster['vreg_cust_name'] = isset($regMaster['vreg_cust_name']) ? trim($regMaster['vreg_cust_name']) : '';
               $regMaster['vreg_showroom'] = $this->shrm;
               $regMaster['vreg_added_by'] = $this->uid;
               $regMaster['vreg_added_on'] = date('Y-m-d H:i:s');
               $regMaster['vreg_entry_date'] = date('Y-m-d', strtotime($regMaster['vreg_entry_date']));

               if ($this->db->insert($this->tbl_register_master, array_filter($regMaster))) {
                    $id = $this->db->insert_id();
                    if ($regMaster['prd_id'] && $id) {
                         $this->db->where('prd_id', $regMaster['prd_id'])->update($this->tbl_products, array(
                              'prd_reg_id' => $id
                         ));
                    }
                    $this->addRegisterHistory(
                         array(
                              'regh_register_master' => $id,
                              'regh_assigned_by' => $this->uid,
                              'regh_assigned_to' => $regMaster['vreg_assigned_to'],
                              'regh_remarks' => $regMaster['vreg_customer_remark'],
                              'log_web_or_mob' => '2',
                              'regh_system_cmd' => 'Register punched none sales department'
                         )
                    );
                    generate_log(array(
                         'log_title' => 'Enquiry registration',
                         'log_desc' => 'New registration punched related to HR, CRM etc...',
                         'log_controller' => strtolower(__CLASS__),
                         'log_action' => 'C',
                         'log_ref_id' => $id,
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));

                    if (!empty($dept)) {
                         /* $this->load->library('email', Array(
                             'protocol' => 'smtp',
                             'smtp_host' => SMTP_HOST,
                             'smtp_port' => SMTP_PORT,
                             'smtp_user' => SMTP_USER,
                             'smtp_pass' => SMTP_PASS,
                             'mailtype' => 'html',
                             'charset' => 'utf-8'
                             )); */
                         $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));

                         $message = "<table>"
                              . "<tr>"
                              . "<td>Date</td>"
                              . "<td>" . $regMaster['vreg_entry_date'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Name</td>"
                              . "<td>" . $regMaster['vreg_cust_name'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Phone</td>"
                              . "<td>" . $regMaster['vreg_cust_phone'] . "</td>"
                              . "</tr>"
                              . "<tr>"
                              . "<td>Place</td>"
                              . "<td>" . $regMaster['vreg_cust_place'] . "</td>"
                              . "</tr>"
                              . "<td>Message</td>"
                              . "<td>" . $regMaster['vreg_customer_remark'] . "</td>"
                              . "</tr>"
                              . "</table>";

                         $this->email->set_newline("\r\n");
                         $this->email->to($dept['dep_mail']);
                         $this->email->subject('CRM - Mail from admin portal');
                         $this->email->message($message);
                         $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                         $this->email->from('admin@royaldrive.in', 'CRM - Mail from admin portal');
                         $this->email->send();
                    }
                    //Register id to call bridge
                    if (!empty($allCalls)) {
                         $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array('ccb_register_ref' => $id));
                    }
                    return true;
               } else {
                    return false;
               }
          } else {

               $inqHistory = array();
               $inquiry = array();

               $previousEnq = $this->getEnquiryByMobile($regMaster['vreg_cust_phone']);
               $newSE = $this->common_model->getUser($regMaster['vreg_assigned_to']);

               $newSEName = isset($newSE['usr_username']) ? $newSE['usr_username'] : '';
               $oldSEName = isset($previousEnq['usr_username']) ? $previousEnq['usr_username'] : '';

               if (!empty($previousEnq)) {
                    if ($previousEnq['enq_current_status'] != 1) { // Not active mod
                         $currentStsDetails = $this->db->get_where($this->tbl_statuses, array('sts_value' => $previousEnq['enq_current_status']))->row_array();
                         $regMaster['vreg_is_verified'] = 0;
                         $regMaster['vreg_verified_by'] = 0;
                         $inqHistory['enh_status'] = inquiry_reopened;
                         $inquiry['enq_current_status'] = inquiry_reopened;
                         $inqHistory['enh_remarks'] = 'Current inquiry status is ' . $currentStsDetails['sts_des'] . ', so this inquiry is assigned from ' . $oldSEName . ' to ' . $newSEName;
                    } else if ($previousEnq['enq_se_id'] == $regMaster['vreg_assigned_to']) { // If previous inq SE id same to new SE id
                         $regMaster['vreg_is_verified'] = 1;
                         $regMaster['vreg_verified_by'] = $this->uid;
                         $inqHistory['enh_status'] = 1;
                         $inquiry['enq_current_status'] = 1;
                         $inqHistory['enh_remarks'] = 'Registerd as new entry but already exists in inquiry and is assigned to ' . $newSEName;
                    } else { // If previous inq is open and assign to new SE
                         $regMaster['vreg_is_verified'] = 0;
                         $regMaster['vreg_verified_by'] = 0;
                         $inqHistory['enh_status'] = inquiry_reopened;
                         $inquiry['enq_current_status'] = inquiry_reopened;
                         $inqHistory['enh_remarks'] = 'Registerd as new entry but already exists in inquiry in other executive and is assigned from ' . $oldSEName . ' to ' . $newSEName;
                    }

                    // Create inquiry history
                    $inqHistory['enh_added_by'] = $this->uid;
                    $inqHistory['enh_added_on'] = date('Y-m-d H:i:s'); //H:i:s added on 03-12-2020 06:00 AM
                    $inqHistory['enh_enq_id'] = $previousEnq['enq_id'];
                    $inqHistory['enh_current_sales_executive'] = $regMaster['vreg_assigned_to'];
                    $this->db->insert($this->tbl_enquiry_history, $inqHistory);
                    $historyId = $this->db->insert_id();

                    $inquiry['enq_is_already_exists'] = 1;
                    $inquiry['enq_current_status_history'] = $historyId;
                    $this->db->where('enq_id', $previousEnq['enq_id'])->update($this->tbl_enquiry, $inquiry);
               } else {
                    $regMaster['vreg_is_verified'] = 1;
                    $regMaster['vreg_verified_by'] = $this->uid;
               }
               $oldEnqSEId = (isset($previousEnq['enq_se_id']) && !empty($previousEnq['enq_se_id'])) ? $previousEnq['enq_se_id'] : 0;
               $assignedTo = (isset($regMaster['vreg_assigned_to']) && !empty($regMaster['vreg_assigned_to'])) ? $regMaster['vreg_assigned_to'] : $this->uid;
               $regMaster['vreg_inquiry'] = (isset($previousEnq['enq_id']) && !empty($previousEnq['enq_id'])) ? $previousEnq['enq_id'] : 0;
               $regMaster['vreg_status'] = (isset($previousEnq['enq_id']) && !empty($previousEnq['enq_id'])) ? 1 : 0;
               $regMaster['vreg_showroom'] = $this->shrm;
               $regMaster['vreg_added_by'] = $this->uid;
               $regMaster['vreg_added_on'] = date('Y-m-d H:i:s'); //h-> H added on 03-12-2020 06:00 AM
               $regMaster['vreg_entry_date'] = date('Y-m-d', strtotime($regMaster['vreg_entry_date']));
               $regMaster['vreg_cust_name'] = isset($regMaster['vreg_cust_name']) ? trim($regMaster['vreg_cust_name']) : '';
               //$regMaster['vreg_assigned_to'] = (empty($oldEnqSEId)) ? $assignedTo : $oldEnqSEId;

               if ($this->db->insert($this->tbl_register_master, array_filter($regMaster))) {
                    $id = $this->db->insert_id();
                    $this->addRegisterHistory(
                         array(
                              'regh_register_master' => $id,
                              'regh_assigned_by' => $this->uid,
                              'regh_assigned_to' => $regMaster['vreg_assigned_to'],
                              'regh_remarks' => $regMaster['vreg_customer_remark'],
                              'regh_system_cmd' => 'Register punched sales department'
                         )
                    );
                    generate_log(array(
                         'log_title' => 'New vehicle registration',
                         'log_desc' => 'New vehicle registration',
                         'log_controller' => strtolower(__CLASS__),
                         'log_action' => 'C',
                         'log_ref_id' => $id,
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));
                    //Register id to call bridge
                    if (!empty($allCalls)) {
                         $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array('ccb_register_ref' => $id));
                    }
                    //SMS To SE
                    /* $assignedTo = $this->common_model->getUser($regMaster['vreg_assigned_to']);
                        if (!empty($assignedTo) && isset($assignedTo['usr_phone'])) {

                        $brandName = isset($regMaster['vreg_brand']) ? $regMaster['vreg_brand'] : 0;
                        $modelName = isset($regMaster['vreg_model']) ? $regMaster['vreg_model'] : 0;
                        $varient = isset($regMaster['vreg_varient']) ? $regMaster['vreg_varient'] : 0;

                        $vehicle = $this->getBrandModelVarientName($brandName, $modelName, $varient);

                        $brandName = isset($vehicle['brandName']['brd_title']) ? $vehicle['brandName']['brd_title'] : '';
                        $modelName = isset($vehicle['modelName']['mod_title']) ? $vehicle['modelName']['mod_title'] : '';
                        $varient = isset($vehicle['varientName']['var_variant_name']) ? $vehicle['varientName']['var_variant_name'] : '';

                        $assignedBy = $this->common_model->getUser($this->uid);
                        $mob = $regMaster['vreg_cust_phone'];
                        $name = $regMaster['vreg_cust_name'];
                        $assignedBy = isset($assignedBy['usr_username']) ? $assignedBy['usr_username'] : '';
                        $msg = $assignedBy . ' assigned inquiry of ' . $name . ', ' . $mob . ', ' . $brandName . ', ' . $modelName . ',' . $varient;
                        send_sms($msg, $assignedTo['usr_phone'], 'sms-register');
                        } */
                    return true;
               } else {
                    return false;
               }
          }
     }

     public function create_new($regMaster) {
          date_default_timezone_set("Asia/Calcutta");
          $bikeArray = array(37,40,41,48,50,54,55,56,57);
          $regMaster['vreg_brand'] = isset($regMaster['vreg_brand']) ? $regMaster['vreg_brand'] : 0;

          if(in_array($regMaster['vreg_brand'], $bikeArray)) {
             $regMaster['vreg_veh_base'] = 2;
          } else if($regMaster['vreg_brand'] == 0) {
             $regMaster['vreg_veh_base'] = 0;
          } else {
             $regMaster['vreg_veh_base'] = 1;
          }

          $regMaster['vreg_first_owner'] = $this->uid;
          $regMaster['vreg_is_effective'] = (isset($regMaster['vreg_is_effective']) && !empty($regMaster['vreg_is_effective'])) ?
                  $regMaster['vreg_is_effective'] : 0;
          $regMaster['vreg_first_added_on'] = date('Y-m-d H:i:s');
          $allCalls = array();
          $evId = 0;
          if (isset($regMaster['vreg_voxbay_ref']) && !empty($regMaster['vreg_voxbay_ref'])) {

               $callerNumber = $this->db->select('ccb_callerNumber')->get_where($this->tbl_callcenterbridging, array('ccb_id' => $regMaster['vreg_voxbay_ref']))->row_array();
               $callerNumber = isset($callerNumber['ccb_callerNumber']) ? $callerNumber['ccb_callerNumber'] : 0;
               if (!empty($callerNumber)) {
                    $callerNumber = substr($callerNumber, -10);
                    $allCalls = $this->db->select('ccb_id')->like('ccb_callerNumber', $callerNumber, 'both')
                                    ->where('ccb_punched_by', 0)->get($this->tbl_callcenterbridging)->result_array();
                    $allCalls = array_column($allCalls, 'ccb_id');
               }
               $punchOn = date('Y-m-d H:i:s'); //h -> H 03-12-2020 06:00 AM
               if (!empty($allCalls)) {
                    $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array('ccb_punched_by' => $this->uid,
                        'ccb_punched_on' => $punchOn, 'ccb_can_show' => 0));
               }
          } else if (isset($regMaster['eve_register_id']) && !empty($regMaster['eve_register_id'])) {
             $evId = $regMaster['eve_register_id'];
             unset($regMaster['eve_register_id']);
          }

          if (!isset($regMaster['vreg_assigned_to'])) {
               //Get department details
               $dept = $this->db->get_where($this->tbl_departments, array('dep_id' => $regMaster['vreg_department']))->row_array();

               $regMaster['vreg_assigned_to'] = 0;
               $regMaster['vreg_cust_name'] = isset($regMaster['vreg_cust_name']) ? trim($regMaster['vreg_cust_name']) : '';
               $regMaster['vreg_showroom'] = (isset($regMaster['vreg_showroom']) && !empty($regMaster['vreg_showroom'])) ? trim($regMaster['vreg_showroom']) : $this->shrm;
               $regMaster['vreg_added_by'] = $this->uid;
               $regMaster['vreg_added_on'] = date('Y-m-d H:i:s');
               $regMaster['vreg_entry_date'] = date('Y-m-d', strtotime($regMaster['vreg_entry_date']));
               $regMaster['vreg_is_verified'] = 1;
               $regMaster['vreg_verified_by'] = $this->uid;
               $regMaster['vreg_source_branch'] = $this->shrm;
               $cntMod = isset($regMaster['vreg_contact_mode']) ? trim($regMaster['vreg_contact_mode']) : 0;
               //
               if ($this->db->insert($this->tbl_register_master, array_filter($regMaster))) {
                    $id = $this->db->insert_id();
                    $this->addRegisterHistory(
                            array(
                                'regh_register_master' => $id,
                                'regh_assigned_by' => $this->uid,
                                'regh_assigned_to' => $regMaster['vreg_assigned_to'],
                                'regh_remarks' => $regMaster['vreg_customer_remark'],
                                'regh_system_cmd' => 'Register punched none sales department',
                                'regh_contact_mode' => $cntMod
                            )
                    );
                    generate_log(array(
                        'log_title' => 'Enquiry registration',
                        'log_desc' => 'New registration punched related to HR, CRM etc...',
                        'log_controller' => strtolower(__CLASS__),
                        'log_action' => 'C',
                        'log_ref_id' => $id,
                        'log_added_by' => get_logged_user('usr_id')
                    ));

                    if (!empty($dept)) {
                         /* $this->load->library('email', Array(
                           'protocol' => 'smtp',
                           'smtp_host' => SMTP_HOST,
                           'smtp_port' => SMTP_PORT,
                           'smtp_user' => SMTP_USER,
                           'smtp_pass' => SMTP_PASS,
                           'mailtype' => 'html',
                           'charset' => 'utf-8'
                           )); */
                         $this->load->library('email', array('mailtype' => 'html', 'charset' => 'utf-8'));

                         $message = "<table>"
                                 . "<tr>"
                                 . "<td>Date</td>"
                                 . "<td>" . $regMaster['vreg_entry_date'] . "</td>"
                                 . "</tr>"
                                 . "<tr>"
                                 . "<td>Name</td>"
                                 . "<td>" . $regMaster['vreg_cust_name'] . "</td>"
                                 . "</tr>"
                                 . "<tr>"
                                 . "<td>Phone</td>"
                                 . "<td>" . $regMaster['vreg_cust_phone'] . "</td>"
                                 . "</tr>"
                                 . "<tr>"
                                 . "<td>Place</td>"
                                 . "<td>" . $regMaster['vreg_cust_place'] . "</td>"
                                 . "</tr>"
                                 . "<td>Message</td>"
                                 . "<td>" . $regMaster['vreg_customer_remark'] . "</td>"
                                 . "</tr>"
                                 . "</table>";

                         $this->email->set_newline("\r\n");
                         //$this->email->to($dept['dep_mail']);
                         $this->email->subject('CRM - Mail from admin portal');
                         $this->email->message($message);
                         $this->email->reply_to('noreply@royaldrive.in', 'Royaldrive');
                         $this->email->from('admin@royaldrive.in', 'CRM - Mail from admin portal');
                         $this->email->send();
                    }
                    //Register id to call bridge
                    if (!empty($allCalls)) {
                         $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array('ccb_register_ref' => $id));
                    }
                    if (isset($evId) && !empty($evId)) {
                       $this->db->where_in('eve_id', $evId)->update($this->tbl_event_enquires, array('eve_register_id' => $id, 'eve_punched_by' => $this->uid));
                    }
                    return true;
               } else {
                    return false;
               }
          } else {

               $inqHistory = array();
               $inquiry = array();

               $previousEnq = $this->getEnquiryByMobile($regMaster['vreg_cust_phone']);
               $newSE = $this->common_model->getUser($regMaster['vreg_assigned_to']);

               $newSEName = isset($newSE['usr_username']) ? $newSE['usr_username'] : '';
               $oldSEName = isset($previousEnq['usr_username']) ? $previousEnq['usr_username'] : '';

               if (!empty($previousEnq)) {
                    if ($previousEnq['enq_current_status'] != 1) { // Not active mod
                         $currentStsDetails = $this->db->get_where($this->tbl_statuses, array('sts_value' => $previousEnq['enq_current_status']))->row_array();
                         $regMaster['vreg_is_verified'] = 0;
                         $regMaster['vreg_verified_by'] = 0;
                         $inqHistory['enh_status'] = inquiry_reopened;
                         $inquiry['enq_current_status'] = inquiry_reopened;
                         $inqHistory['enh_remarks'] = 'Current inquiry status is ' . $currentStsDetails['sts_des'] . ', so this inquiry is assigned from ' . $oldSEName . ' to ' . $newSEName;
                    } else if ($previousEnq['enq_se_id'] == $regMaster['vreg_assigned_to']) { // If previous inq SE id same to new SE id
                         $regMaster['vreg_is_verified'] = 1;
                         $regMaster['vreg_verified_by'] = $this->uid;
                         $inqHistory['enh_status'] = 1;
                         $inquiry['enq_current_status'] = 1;
                         $inqHistory['enh_remarks'] = 'Registerd as new entry but already exists in inquiry and is assigned to ' . $newSEName;
                    } else { // If previous inq is open and assign to new SE
                         $regMaster['vreg_is_verified'] = 0;
                         $regMaster['vreg_verified_by'] = 0;
                         $inqHistory['enh_status'] = inquiry_reopened;
                         $inquiry['enq_current_status'] = inquiry_reopened;
                         $inqHistory['enh_remarks'] = 'Registerd as new entry but already exists in inquiry in other executive and is assigned from ' . $oldSEName . ' to ' . $newSEName;
                    }

                    // Create inquiry history
                    $inqHistory['enh_added_by'] = $this->uid;
                    $inqHistory['enh_added_on'] = date('Y-m-d H:i:s'); //H:i:s added on 03-12-2020 06:00 AM
                    $inqHistory['enh_enq_id'] = $previousEnq['enq_id'];
                    $inqHistory['enh_current_sales_executive'] = $regMaster['vreg_assigned_to'];
                    $this->db->insert($this->tbl_enquiry_history, $inqHistory);
                    $historyId = $this->db->insert_id();

                    $inquiry['enq_is_already_exists'] = 1;
                    $inquiry['enq_current_status_history'] = $historyId;
                    $this->db->where('enq_id', $previousEnq['enq_id'])->update($this->tbl_enquiry, $inquiry);
               } else {
                    $regMaster['vreg_is_verified'] = 1;
                    $regMaster['vreg_verified_by'] = $this->uid;
               }
               $oldEnqSEId = (isset($previousEnq['enq_se_id']) && !empty($previousEnq['enq_se_id'])) ? $previousEnq['enq_se_id'] : 0;
               $assignedTo = (isset($regMaster['vreg_assigned_to']) && !empty($regMaster['vreg_assigned_to'])) ? $regMaster['vreg_assigned_to'] : $this->uid;
               $regMaster['vreg_inquiry'] = (isset($previousEnq['enq_id']) && !empty($previousEnq['enq_id'])) ? $previousEnq['enq_id'] : 0;
               $regMaster['vreg_status'] = (isset($previousEnq['enq_id']) && !empty($previousEnq['enq_id'])) ? 1 : 0;
               $regMaster['vreg_showroom'] = (isset($regMaster['vreg_showroom']) && !empty($regMaster['vreg_showroom'])) ? trim($regMaster['vreg_showroom']) : $this->shrm;;
               $regMaster['vreg_added_by'] = $this->uid;
               $regMaster['vreg_added_on'] = date('Y-m-d H:i:s'); //h-> H added on 03-12-2020 06:00 AM
               $regMaster['vreg_entry_date'] = date('Y-m-d', strtotime($regMaster['vreg_entry_date']));
               $regMaster['vreg_cust_name'] = isset($regMaster['vreg_cust_name']) ? trim($regMaster['vreg_cust_name']) : '';
               //$regMaster['vreg_assigned_to'] = (empty($oldEnqSEId)) ? $assignedTo : $oldEnqSEId;
               $regMaster['vreg_source_branch'] = $this->shrm;
               if ($this->db->insert($this->tbl_register_master, array_filter($regMaster))) {
                    $id = $this->db->insert_id();
                    $this->addRegisterHistory(
                            array(
                                'regh_register_master' => $id,
                                'regh_assigned_by' => $this->uid,
                                'regh_assigned_to' => $regMaster['vreg_assigned_to'],
                                'regh_remarks' => $regMaster['vreg_customer_remark'],
                                'regh_system_cmd' => 'Register punched sales department',
                                'regh_contact_mode' => isset($regMaster['vreg_contact_mode']) ? $regMaster['vreg_contact_mode'] : 0
                            )
                    );
                    generate_log(array(
                        'log_title' => 'New vehicle registration',
                        'log_desc' => serialize($regMaster),
                        'log_controller' => 'new-quick-register',
                        'log_action' => 'C',
                        'log_ref_id' => $id,
                        'log_added_by' => get_logged_user('usr_id')
                    ));
                    //Register id to call bridge
                    if (!empty($allCalls)) {
                         $this->db->where_in('ccb_id', $allCalls)->update($this->tbl_callcenterbridging, array('ccb_register_ref' => $id));
                    }
                    if (isset($evId) && !empty($evId)) {
                       $this->db->where_in('eve_id', $evId)->update($this->tbl_event_enquires, array('eve_register_id' => $id, 'eve_punched_by' => $this->uid));
                    }
                    //SMS To SE
                    /* $assignedTo = $this->common_model->getUser($regMaster['vreg_assigned_to']);
                      if (!empty($assignedTo) && isset($assignedTo['usr_phone'])) {

                      $brandName = isset($regMaster['vreg_brand']) ? $regMaster['vreg_brand'] : 0;
                      $modelName = isset($regMaster['vreg_model']) ? $regMaster['vreg_model'] : 0;
                      $varient = isset($regMaster['vreg_varient']) ? $regMaster['vreg_varient'] : 0;

                      $vehicle = $this->getBrandModelVarientName($brandName, $modelName, $varient);

                      $brandName = isset($vehicle['brandName']['brd_title']) ? $vehicle['brandName']['brd_title'] : '';
                      $modelName = isset($vehicle['modelName']['mod_title']) ? $vehicle['modelName']['mod_title'] : '';
                      $varient = isset($vehicle['varientName']['var_variant_name']) ? $vehicle['varientName']['var_variant_name'] : '';

                      $assignedBy = $this->common_model->getUser($this->uid);
                      $mob = $regMaster['vreg_cust_phone'];
                      $name = $regMaster['vreg_cust_name'];
                      $assignedBy = isset($assignedBy['usr_username']) ? $assignedBy['usr_username'] : '';
                      $msg = $assignedBy . ' assigned inquiry of ' . $name . ', ' . $mob . ', ' . $brandName . ', ' . $modelName . ',' . $varient;
                      send_sms($msg, $assignedTo['usr_phone'], 'sms-register');
                      } */
                    return true;
               } else {
                    return false;
               }
          }
     }

     //public function getVehicleRegData($id = '', $limit = 0, $page = 0, $filter = array()) {
     public function readVehicleReg($id = '', $limit = 0, $page = 0, $filter = array())
     {
          $userAccess = getUserAcess($this->uid);

          // debug($this->usr_grp);
          //debug(is_roo_user($this->usr_grp)); 
          //return ADMIN_ID;
          //// $this->userAccess = $this->common_model->getUser($this->uid);
          //// $this->userAccess = isset($this->userAccess['cua_access']) ? $this->userAccess['cua_access'] : '';
          //  debug($this->userAccess);
          $search = isset($filter['search']) ? $filter['search'] : '';
          $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)
               ->get($this->tbl_users)->row()->usr_id);

          // debug($this->myRegStatuses);
          ///////////$ count/////////////////////////////////// 
          // $this->db->select($selectArray, false)
          //$this->db->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
          //->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
          // ->join($this->tbl_users . ' ownedby', 'ownedby.usr_id = ' . $this->tbl_register_master . '.vreg_first_owner', 'LEFT');

          if (!empty($id)) {
               return $this->db->get_where($this->tbl_register_master, array($this->tbl_register_master . '.vreg_id' => $id))->row_array();
          }
          if ($this->uid != ADMIN_ID) {
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {
                    $this->db->where(array('vreg_first_owner' => $this->uid));
               }
          }

          if (check_permission($this->uid, $userAccess, 'enquiry', 'reassigntosalesstaff')) { //TSC athira
               $this->db->where('(vreg_added_by = ' . $this->uid . ' OR vreg_first_owner = ' . $this->uid . ')');
          } else {
               //if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where(array('vreg_first_owner' => $this->uid));
          }

          if (empty($search)) {
               $enq_date_from = (isset($filter['enq_date_from']) && !empty($filter['enq_date_from'])) ?
                    date('Y-m-d', strtotime($filter['enq_date_from'])) : '';

               $enq_date_to = (isset($filter['enq_date_to']) && !empty($filter['enq_date_to'])) ?
                    date('Y-m-d', strtotime($filter['enq_date_to'])) : '';

               if (!empty($enq_date_from)) {
                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) >=', $enq_date_from);
               }
               if (!empty($enq_date_to)) {
                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) <=', $enq_date_to);
               }
               if (isset($filter['mode']) && !empty($filter['mode'])) {
                    $this->db->where_in($this->tbl_register_master . '.vreg_contact_mode', $filter['mode']);
               }
               if (empty($enq_date_from) && empty($enq_date_to)) {

                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) = ' . "DATE('" . date('Y-m-d') . "')");
               }
               if (isset($filter['showroom']) && !empty($filter['showroom'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_showroom', $filter['showroom']);
               }

               if (isset($filter['vreg_department']) && !empty($filter['vreg_department'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_department', $filter['vreg_department']);
               }
               if (isset($filter['vreg_call_type']) && !empty($filter['vreg_call_type'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_call_type', $filter['vreg_call_type']);
               }

               $effective = isset($filter['vreg_is_effective']) ? $filter['vreg_is_effective'] : '';
               if ($effective == '0' || $effective == '1') {
                    $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
               }
               $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          } else {
               $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                    $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                    $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
               $this->db->where($whereSearch);
          }

          if (isset($filter['executive']) && !empty($filter['executive'])) {
               //Register created by myself and assigned to SE
               //                 $this->db->where_in('('.$this->tbl_register_master . '.vreg_first_owner', $filter['executive']);
               $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $filter['executive']) . ') OR ' .
                    $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $filter['executive']) . '))');
          } else {
               if (!is_roo_user($this->usr_grp) && check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
          }

          $return['count'] = $this->db->count_all_results($this->tbl_register_master);
          ///////////@count///////////////////////////////////

          $selectArray = array(
               $this->tbl_register_master . '.*',
               'assign.usr_first_name AS assign_usr_first_name',
               'assign.usr_last_name AS assign_usr_last_name',
               'addedby.usr_first_name AS addedby_usr_first_name',
               'addedby.usr_last_name AS addedby_usr_last_name',
               'ownedby.usr_first_name AS ownedby_usr_first_name',
               'ownedby.usr_last_name AS ownedby_usr_last_name',
               $this->tbl_events . '.evnt_title',
               $this->tbl_brand . '.brd_id', $this->tbl_brand . '.brd_title',
               $this->tbl_model . '.mod_id', $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_id', $this->tbl_variant . '.var_variant_name',
               $this->tbl_departments . '.*'
          );
          $this->db->select($selectArray, false)
               ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
               ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
               ->join($this->tbl_users . ' ownedby', 'ownedby.usr_id = ' . $this->tbl_register_master . '.vreg_first_owner', 'LEFT')
               ->join($this->tbl_events, $this->tbl_events . '.evnt_id = ' . $this->tbl_register_master . '.vreg_event', 'LEFT')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_register_master . '.vreg_brand', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_register_master . '.vreg_model', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_register_master . '.vreg_varient', 'left')
               ->join($this->tbl_departments, $this->tbl_departments . '.dep_id = ' . $this->tbl_register_master . '.vreg_department', 'left');

          if (!empty($id)) {
               return $this->db->get_where($this->tbl_register_master, array($this->tbl_register_master . '.vreg_id' => $id))->row_array();
          }
          if ($this->uid != ADMIN_ID) {
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {
                    $this->db->where(array('vreg_first_owner' => $this->uid));
               }
          }
          if (check_permission($this->uid, $userAccess, 'enquiry', 'reassigntosalesstaff')) { //TSC athira
               $this->db->where('(vreg_added_by = ' . $this->uid . ' OR vreg_first_owner = ' . $this->uid . ')');
          } else {
               //if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where(array('vreg_first_owner' => $this->uid));
          }

          if (empty($search)) {
               $enq_date_from = (isset($filter['enq_date_from']) && !empty($filter['enq_date_from'])) ?
                    date('Y-m-d', strtotime($filter['enq_date_from'])) : '';

               $enq_date_to = (isset($filter['enq_date_to']) && !empty($filter['enq_date_to'])) ?
                    date('Y-m-d', strtotime($filter['enq_date_to'])) : '';

               if (!empty($enq_date_from)) {
                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) >=', $enq_date_from);
               }
               if (!empty($enq_date_to)) {
                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) <=', $enq_date_to);
               }
               if (isset($filter['mode']) && !empty($filter['mode'])) {
                    $this->db->where_in($this->tbl_register_master . '.vreg_contact_mode', $filter['mode']);
               }
               if (empty($enq_date_from) && empty($enq_date_to)) {

                    $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) = ' . "DATE('" . date('Y-m-d') . "')");
               }
               if (isset($filter['showroom']) && !empty($filter['showroom'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_showroom', $filter['showroom']);
               }

               if (isset($filter['vreg_department']) && !empty($filter['vreg_department'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_department', $filter['vreg_department']);
               }
               if (isset($filter['vreg_call_type']) && !empty($filter['vreg_call_type'])) {
                    $this->db->where($this->tbl_register_master . '.vreg_call_type', $filter['vreg_call_type']);
               }

               $effective = isset($filter['vreg_is_effective']) ? $filter['vreg_is_effective'] : '';
               if ($effective == '0' || $effective == '1') {
                    $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
               }
               $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          } else {
               $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                    $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                    $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
               $this->db->where($whereSearch);
          }
          if (isset($filter['executive']) && !empty($filter['executive'])) {
               //Register created by myself and assigned to SE
               //                 $this->db->where_in('('.$this->tbl_register_master . '.vreg_first_owner', $filter['executive']);
               $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $filter['executive']) . ') OR ' .
                    $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $filter['executive']) . '))');
          } else {
               if (!is_roo_user($this->usr_grp) && check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
          }
          if ($limit) {
               $this->db->limit($limit, $page);
          }
          //if ($this->uid == 804) {
          //$this->db->get($this->tbl_register_master)->result_array();
          //$this->db->where_in($this->tbl_register_master . '.vreg_assigned_to', 0);//TODO delete
          //$return = $this->db->get($this->tbl_register_master)->result_array();
          //return $return;
          //echo $this->db->last_query();exit;
          //debug($return);
          //}
          // return $this->db->get($this->tbl_register_master)->result_array();

          $return['data'] = $this->db->get($this->tbl_register_master)->result_array();
          //debug($return);
          // echo (check_permission($this->uid,'registration', 'update')) ? 1 : 0;
          //  exit;
          $return['user_access']['update'] = (check_permission($this->uid, $userAccess, 'registration', 'update')) ? 1 : 0;
          $return['user_access']['delete'] = (check_permission($this->uid, $userAccess, 'registration', 'candelete')) ? 1 : 0;

          return $return;
     }

     public function readVehicleRegBK($id = '', $filter = array())
     {

          //  debug($this->uid);
          // $this->userAccess = $this->common_model->getUser($this->uid);
          $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)
               ->get($this->tbl_users)->row()->usr_id);

          $selectArray = array(
               $this->tbl_register_master . '.*',
               'assign.usr_first_name AS assign_usr_first_name',
               'assign.usr_last_name AS assign_usr_last_name',
               'addedby.usr_first_name AS addedby_usr_first_name',
               'addedby.usr_last_name AS addedby_usr_last_name',
               $this->tbl_events . '.evnt_title',
               $this->tbl_brand . '.brd_id', $this->tbl_brand . '.brd_title',
               $this->tbl_model . '.mod_id', $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_id', $this->tbl_variant . '.var_variant_name',
               $this->tbl_departments . '.*'
          );
          $this->db->select($selectArray, false)
               ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
               ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
               ->join($this->tbl_events, $this->tbl_events . '.evnt_id = ' . $this->tbl_register_master . '.vreg_event', 'LEFT')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_register_master . '.vreg_brand', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_register_master . '.vreg_model', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_register_master . '.vreg_varient', 'left')
               ->join($this->tbl_departments, $this->tbl_departments . '.dep_id = ' . $this->tbl_register_master . '.vreg_department', 'left');

          if (!empty($id)) {
               return $this->db->get_where($this->tbl_register_master, array($this->tbl_register_master . '.vreg_id' => $id))->row_array();
          }
          //debug($this->userAccess);
          if ($this->uid != ADMIN_ID) {
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {

                    $this->db->where(array('vreg_first_owner' => $this->uid));
               }
          }
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where(array('vreg_first_owner' => $this->uid));
          }

          $enq_date_from = (isset($filter['enq_date_from']) && !empty($filter['enq_date_from'])) ?
               date('Y-m-d', strtotime($filter['enq_date_from'])) : '';

          $enq_date_to = (isset($filter['enq_date_to']) && !empty($filter['enq_date_to'])) ?
               date('Y-m-d', strtotime($filter['enq_date_to'])) : '';

          if (!empty($enq_date_from)) {
               $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) >=', $enq_date_from);
          }
          if (!empty($enq_date_to)) {
               $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) <=', $enq_date_to);
          }
          if (isset($filter['mode']) && !empty($filter['mode'])) {
               $this->db->where_in($this->tbl_register_master . '.vreg_contact_mode', $filter['mode']);
          }
          if (empty($enq_date_from) && empty($enq_date_to)) {
               $this->db->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) = ' . "DATE('" . date('Y-m-d') . "')");
          }
          if (isset($filter['showroom']) && !empty($filter['showroom'])) {
               $this->db->where($this->tbl_register_master . '.vreg_showroom', $filter['showroom']);
          }

          if (isset($filter['vreg_department']) && !empty($filter['vreg_department'])) {
               $this->db->where($this->tbl_register_master . '.vreg_department', $filter['vreg_department']);
          }

          if (isset($filter['executive']) && !empty($filter['executive'])) {
               //debug(122313);
               // debug($filter['executive']);
               //Register created by myself and assigned to SE
               //                 $this->db->where_in('('.$this->tbl_register_master . '.vreg_first_owner', $filter['executive']);
               $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $filter['executive']) . ') OR ' .
                    $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $filter['executive']) . '))');
          } else {
               if (!is_roo_user($this->usr_grp) && check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
          }

          if (isset($filter['vreg_call_type']) && !empty($filter['vreg_call_type'])) {
               $this->db->where($this->tbl_register_master . '.vreg_call_type', $filter['vreg_call_type']);
          }

          $effective = isset($filter['vreg_is_effective']) ? $filter['vreg_is_effective'] : '';
          if ($effective == '0' || $effective == '1') {
               $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
          }
          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);

          $return = $this->db->get($this->tbl_register_master)->result_array();
          return $return;
     }

     function getDistricts($state = '')
     {
          if ($state) {
               return $this->db->where_in($this->tbl_district_statewise . '.std_state', $state)->get($this->tbl_district_statewise)->result_array();
               // return $this->db->where('std_state', $state)->get($this->tbl_district_statewise)->result_array();
          }
     }

     function addRegisterHistory($datas, $updateRegMstr = true)
     {
          $datas['regh_added_by'] = $this->uid;
          $datas['regh_added_date'] = date('Y-m-d H:i:s');
          $this->db->insert($this->tbl_register_history, $datas);
          if ($updateRegMstr) {
               $this->db->where('vreg_id', $datas['regh_register_master'])
                    ->update($this->tbl_register_master, array('vreg_assigned_to' => $datas['regh_assigned_to']));
          }
     }

     ///$new///
     function getInquiryQuestions()
     {
          
          /*             if ($this->uid != ADMIN_ID) {
              $this->db->where('qus_designation', $this->grp_id);
              } */
              $questions['sell'] = $this->db->order_by('qus_order')
              ->get_where($this->tbl_questions, '(qus_category = 1 AND qus_status = 1) AND (qus_type = 2 OR qus_type = 1)')
              ->result_array();
         /* echo $this->db->last_query();exit;
             if ($this->uid != ADMIN_ID) {
             $this->db->where('qus_designation', $this->grp_id);
             } */
         $questions['buy'] = $this->db->order_by('qus_order')
              ->get_where($this->tbl_questions, '(qus_category = 1 AND qus_status = 1) AND (qus_type = 3 OR qus_type = 1)')
              ->result_array();

         /*            if ($this->uid != ADMIN_ID) {
             $this->db->where('qus_designation', $this->grp_id);
             } */
         $questions['exch'] = $this->db->order_by('qus_order')
              ->get_where($this->tbl_questions, '(qus_category = 1 AND qus_status = 1) AND (qus_type = 4 OR qus_type = 1)')
              ->result_array();
         return $questions;
     }

     function getOwnParkAndSaleCars()
     {
          return $this->db->select($this->tbl_valuation . '.val_id,' . $this->tbl_valuation . '.val_veh_no,' . $this->tbl_model . '.mod_title,' . $this->tbl_brand . '.brd_title,' .
               $this->tbl_variant . '.var_variant_name,' . $this->tbl_users . '.usr_id,' . $this->tbl_showroom . '.shr_id,' . $this->tbl_enquiry . '.enq_id')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_valuation . '.val_added_by', 'left')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'left')
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_valuation . '.val_enquiry_id', 'left')
               ->where_in($this->tbl_valuation . '.val_type', array(1, 2, 3))
               ->where($this->tbl_valuation . '.val_status', 39)/* Stock vehicle */
               ->where($this->tbl_valuation . '.val_is_sold', 0)
               ->get($this->tbl_valuation)->result_array();
     }

     function salesExecutives()
     {
          $userAccess = getUserAcess($this->uid);
          $this->db->where('usr_id != ', $this->uid);
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_users . '.usr_showroom', $this->shrm);
          }
          // $this->userAccess = $this->common_model->getUser($this->uid);
          //debug( $this->userAccess);
          if (check_permission($this->uid, $userAccess, 'emp_details', 'showinnactivestaffs')) {
               $this->db->where($this->tbl_users . '.usr_active = 1 OR ' . $this->tbl_users . '.usr_active = 0');
          } else {
               $this->db->where($this->tbl_users . '.usr_active = 1');
          }
          if ($this->usr_grp == 'TL') {
               //$this->db->where($this->tbl_users . '.usr_tl', $this->uid);
               //                 $this->db->where($this->tbl_users . '.usr_showroom', $this->shrm);
               $result = $this->db->select($this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_first_name,' . $this->tbl_users_groups . '.group_id,' . $this->tbl_groups . '.grp_slug')->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
                    ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
                    ->where(array($this->tbl_users . '.usr_can_auto_assign' => 1))->order_by($this->tbl_users . '.usr_first_name', 'ASC')->get($this->tbl_users)->result_array();
          } else {
               $result = $this->db->select($this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_first_name,' . $this->tbl_users_groups . '.group_id,' . $this->tbl_groups . '.grp_slug')->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
                    ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
                    ->where(array($this->tbl_users . '.usr_can_auto_assign' => 1))->order_by($this->tbl_users . '.usr_first_name', 'ASC')->get(
                         $this->tbl_users
                    )->result_array();
          }
          return $result;
     }

     public function getVehicleReg($id = '', $limit = 0, $page = 0, $filter = array())
     { //chng*
          $userAccess = getUserAcess($this->uid);
          $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)
               ->get($this->tbl_users)->row()->usr_id);

          $enqExclude = loss_of_sale_or_buy . ',' . sale_closed . ',' . enq_req_drop;

          $vregDivision = isset($filter['vreg_division']) ? $filter['vreg_division'] : 0;
          $vregShowroom = isset($filter['vreg_showroom']) ? $filter['vreg_showroom'] : 0;
          $showallsts = isset($filter['showallsts']) ? $filter['showallsts'] : 0;

          $vreg_assigned_to = isset($filter['vreg_assigned_to']) ? $filter['vreg_assigned_to'] : 0;
          $vreg_first_owner = isset($filter['vreg_first_owner']) ? $filter['vreg_first_owner'] : 0;
          $dept = isset($filter['vreg_department']) ? $filter['vreg_department'] : '';
          $type = isset($filter['vreg_call_type']) ? $filter['vreg_call_type'] : '';
          $mode = isset($filter['vreg_contact_mode']) ? $filter['vreg_contact_mode'] : '';
          $effective = isset($filter['vreg_is_effective']) ? $filter['vreg_is_effective'] : '';
          $addedEntry = (isset($filter['added_entry']) && !empty($filter['added_entry'])) ? $filter['added_entry'] : 'vreg_added_on';

          $enq_date_from = (isset($filter['vreg_added_on_fr']) && !empty($filter['vreg_added_on_fr'])) ?
               date('Y-m-d', strtotime($filter['vreg_added_on_fr'])) : '';

          $enq_date_to = (isset($filter['vreg_added_on_to']) && !empty($filter['vreg_added_on_to'])) ?
               date('Y-m-d', strtotime($filter['vreg_added_on_to'])) : '';
          $search = isset($filter['search']) ? $filter['search'] : '';

          if (($this->uid != ADMIN_ID) && empty($search)) {
               //  $this->userAccess = $this->common_model->getUser($this->uid);

               if (!check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where(array('vreg_assigned_to' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where(array('vreg_added_by' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where_in('vreg_department', array(7));
               }
          }
          //debug($this->uid);
          if (!empty($filter)) {

               if ($vreg_assigned_to > 0) {
                    $this->db->where('vreg_assigned_to', $vreg_assigned_to);
               }

               if ($vreg_first_owner > 0) {
                    $this->db->where('vreg_first_owner', $vreg_first_owner);
               }

               $type = isset($filter['type']) ? $filter['type'] : '';
               $brd = isset($filter['vreg_brand']) ? $filter['vreg_brand'] : '';
               $mod = isset($filter['vreg_model']) ? $filter['vreg_model'] : '';
               $var = isset($filter['vreg_varient']) ? $filter['vreg_varient'] : '';

               if ($type == 'ex') {
                    $this->db->where('vreg_inquiry != 0');
               } else if ($type == 'nw') {
                    $this->db->where('vreg_inquiry = 0');
               }

               if ($dept > 0) {
                    $this->db->where('vreg_department', $dept);
               }
               if ($type > 0) {
                    $this->db->where('vreg_call_type', $type);
               }
               if ($mode > 0) {
                    $this->db->where('vreg_contact_mode', $mode);
               }

               if ($vregDivision > 0) {
                    $this->db->where('vreg_division', $vregDivision);
               }
               if ($vregShowroom > 0) {
                    $this->db->where('vreg_showroom', $vregShowroom);
               }

               if (!empty($search)) {
                    $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
                    $this->db->where($whereSearch);
               }
               if ($brd > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_brand", $brd);
               }
               if ($mod > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_model", $mod);
               }
               if ($var > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_varient", $var);
               }
          }
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'EV' || $this->usr_grp == 'TL') {
               $this->db->where('vreg_is_punched = 0');
          }
          if (!empty($enq_date_from) && !empty($enq_date_to)) {
               $this->db->where('(DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') >= DATE(' . "'" . $enq_date_from . "'" . ') AND ' .
                    'DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') <= DATE(' . "'" . $enq_date_to . "'" . ') )');
          }
          if ($effective == '0' || $effective == '1') {
               $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
          }
          $this->db->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'left');
          $this->db->where('(' . $this->tbl_enquiry . '.enq_current_status IN (' . $enqExclude . ') OR ' . $this->tbl_enquiry . '.enq_current_status IS NULL)');
          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          $return['count'] = $this->db->count_all_results($this->tbl_register_master);

          $selectArray = array(
               $this->tbl_register_master . '.vreg_brand', $this->tbl_register_master . '.vreg_model',
               $this->tbl_register_master . '.vreg_varient', $this->tbl_register_master . '.vreg_year',
               $this->tbl_register_master . '.vreg_existing_vehicle', $this->tbl_register_master . '.vreg_id',
               $this->tbl_register_master . '.vreg_assigned_to', $this->tbl_register_master . '.vreg_department',
               $this->tbl_register_master . '.vreg_customer_status', $this->tbl_register_master . '.vreg_cust_name',
               $this->tbl_register_master . '.vreg_address', $this->tbl_register_master . '.vreg_cust_phone',
               $this->tbl_register_master . '.vreg_cust_place', $this->tbl_register_master . '.vreg_occupation',
               $this->tbl_register_master . '.vreg_company', $this->tbl_register_master . '.vreg_district',
               $this->tbl_register_master . '.vreg_investment', $this->tbl_register_master . '.vreg_contact_mode',
               $this->tbl_register_master . '.vreg_referal_name', $this->tbl_register_master . '.vreg_referal_type',
               $this->tbl_register_master . '.vreg_referal_enq_id', $this->tbl_register_master . '.vreg_customer_remark',
               $this->tbl_register_master . '.vreg_department',
               'assign.usr_first_name AS assign_usr_first_name',
               'assign.usr_last_name AS assign_usr_last_name',
               'addedby.usr_first_name AS addedby_usr_first_name',
               'addedby.usr_last_name AS addedby_usr_last_name',
               'exstse.usr_username AS exstse_usr_username',
               $this->tbl_events . '.evnt_title',
               $this->tbl_brand . '.brd_id', $this->tbl_brand . '.brd_title',
               $this->tbl_model . '.mod_id', $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_id', $this->tbl_variant . '.var_variant_name',
               $this->tbl_enquiry . '.enq_current_status',
               $this->tbl_callcenterbridging . '.ccb_recording_URL',
               $this->tbl_callcenterbridging . '.ccb_callStatus_id',
               $this->tbl_departments . '.dep_name', $this->tbl_district_statewise . '.*'
          );
          $this->db->select($selectArray, false)
               ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
               ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
               ->join($this->tbl_events, $this->tbl_events . '.evnt_id = ' . $this->tbl_register_master . '.vreg_event', 'LEFT')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_register_master . '.vreg_brand', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_register_master . '.vreg_model', 'left')
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'left')
               ->join($this->tbl_users . ' exstse', $this->tbl_enquiry . '.enq_se_id = ' . 'exstse.usr_id', 'left')
               ->join($this->tbl_callcenterbridging, $this->tbl_callcenterbridging . '.ccb_id = ' . $this->tbl_register_master . '.vreg_voxbay_ref', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_register_master . '.vreg_varient', 'left')
               ->join($this->tbl_departments, $this->tbl_departments . '.dep_id = ' . $this->tbl_register_master . '.vreg_department', 'left')
               ->join($this->tbl_district_statewise, $this->tbl_district_statewise . '.std_id = ' . $this->tbl_register_master . '.vreg_district', 'left');

          if (!empty($id)) {
               return $this->db->order_by($this->tbl_register_master . '.vreg_entry_date', 'DESC')
                    ->get_where($this->tbl_register_master, array($this->tbl_register_master . '.vreg_id' => $id))->row_array();
          }
          /* $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses); */
          if ($limit) {
               $this->db->limit($limit, $page);
          }
          if (($this->uid != ADMIN_ID) && empty($search)) {
               if (!check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where(array('vreg_assigned_to' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {
                    $this->db->where(array('vreg_added_by' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregistersmartpurchaseonly')) {
                    $this->db->where_in('vreg_department', array(7));
               }
          }
          if (!empty($filter)) {
               if ($vreg_assigned_to > 0) {
                    $this->db->where('vreg_assigned_to', $vreg_assigned_to);
               }
               if ($vreg_first_owner > 0) {
                    $this->db->where('vreg_first_owner', $vreg_first_owner);
               }
               $type = isset($filter['type']) ? $filter['type'] : '';
               if ($type == 'ex') {
                    $this->db->where('vreg_inquiry != 0');
               } else if ($type == 'nw') {
                    $this->db->where('vreg_inquiry = 0');
               }
               if ($dept > 0) {
                    $this->db->where('vreg_department', $dept);
               }
               if ($type > 0) {
                    $this->db->where('vreg_call_type', $type);
               }
               if ($mode > 0) {
                    $this->db->where('vreg_contact_mode', $mode);
               }
               if (!empty($search)) {
                    $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
                    $this->db->where($whereSearch);
               }
               if ($brd > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_brand", $brd);
               }
               if ($mod > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_model", $mod);
               }
               if ($var > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_varient", $var);
               }
               if ($vregDivision > 0) {
                    $this->db->where('vreg_division', $vregDivision);
               }
               if ($vregShowroom > 0) {
                    $this->db->where('vreg_showroom', $vregShowroom);
               }
          }
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'EV' || $this->usr_grp == 'TL') {
               $this->db->where('vreg_is_punched = 0');
          }

          if (!empty($enq_date_from) && !empty($enq_date_to)) {
               $this->db->where('(DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') >= DATE(' . "'" . $enq_date_from . "'" . ') AND ' .
                    'DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') <= DATE(' . "'" . $enq_date_to . "'" . '))');
          }
          if ($effective == '0' || $effective == '1') {
               $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
          }
          $this->db->order_by('vreg_entry_date', 'DESC');
          $this->db->where('(' . $this->tbl_enquiry . '.enq_current_status NOT IN (' . $enqExclude . ') OR ' .
               $this->tbl_enquiry . '.enq_current_status IS NULL)');

          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);

          $return['data'] = $this->db->get($this->tbl_register_master)->result_array();
          return $return;
     }

     function getProfession()
     {
          return $this->db->select('*')
               ->get($this->tbl_occupation)->result_array();
     }

     function getProfessionCategory()
     {
          return $this->db->select('*')
               ->get($this->tbl_occupation_category)->result_array();
     }

     function getpurposeOfPurchase()
     {
          return $this->db->select('*')
               ->get($this->tbl_purpose_of_purchase)->result_array();
     }

     function getCustomerGrade($id = '')
     {
          if (!empty($id)) {
               return $this->db->get_where($this->tbl_supplier_grade, array('sgrd_id' => $id))->row_array();
          }
          return $this->db->order_by('sgrd_priority')->get($this->tbl_supplier_grade)->result_array();
     }

     function get_districts($id = '')
     {
          if ($id) {
               //return $this->db->where($this->tbl_district_statewise . '.std_state', $id)->get($this->tbl_district_statewise)->result_array();   
               return $this->db->where_in($this->tbl_district_statewise . '.std_state', $id)->get($this->tbl_district_statewise)->result_array();
          }
          return $this->db->get($this->tbl_district_statewise)->result_array();
     }

     function getAllBanks($id = '')
     {
          if ($id) {
               return $this->db->order_by('bnk_name')->where('bnk_id', $id)->get($this->tbl_banks)->row_array();
          }
          return $this->db->order_by('bnk_name')->get($this->tbl_banks)->result_array();
     }

     function newEnquiry($data, $valId = 0)
     { //jjj
          //echo 1212;
          //debug($this->uid,1);
          generate_log(array(
               'log_title' => 'New inquiry',
               'log_desc' => serialize($data),
               'log_controller' => 'new-enquiry',
               'log_action' => 'C',
               'log_ref_id' => 1425,
               'log_web_or_mob' => '2',
               'log_added_by' => $this->uid
          ));
          $regId = 0;
          if (isset($data['vreg_id']) && !empty($data['vreg_id'])) {
               $regId = $data['vreg_id'];
               unset($data['vreg_id']);
          }

          // $this->load->model('followup/followup_model', 'followup');
          if (isset($data['enquiry']['enq_cus_mobile']) && !empty($data['enquiry']['enq_cus_mobile'])) {
               $cusMobile = substr($data['enquiry']['enq_cus_mobile'], -10);
               $duplicateEntry = $this->db->like('enq_cus_mobile', $cusMobile, 'before')->get($this->tbl_enquiry)->row_array();
               if (!empty($duplicateEntry)) {
                    $data['enquiry']['enq_current_status'] = 9;
               }
          }
          $showroom = get_logged_user('usr_showroom');
          if (!empty($data)) {
               $enquiryId = '';

               /* Set default values */

               $data['enquiry']['enq_punched_by'] = $this->uid;
               $data['enquiry']['enq_added_by'] = $this->uid;
               $data['enquiry']['enq_showroom_id'] = $showroom;
               $data['enquiry']['enq_cus_pin'] = empty($data['enquiry']['enq_cus_pin']) ? 0 : $data['enquiry']['enq_cus_pin'];
               $data['enquiry']['enq_cus_when_buy'] = isset($data['followup']['foll_status']) ? $data['followup']['foll_status'] : 0;
               $data['enquiry']['enq_cus_loan_emi'] = empty($data['enquiry']['enq_cus_loan_emi']) ? 0 : $data['enquiry']['enq_cus_loan_emi'];
               $data['enquiry']['enq_cus_status'] = empty($data['enquiry']['enq_cus_status']) ? 0 : $data['enquiry']['enq_cus_status'];
               $data['enquiry']['enq_cus_test_drive'] = 0; //isset($data['enquiry']['enq_cus_test_drive']) ? 0 : $data['enquiry']['enq_cus_test_drive'];
               $data['enquiry']['enq_current_status'] = empty($data['enquiry']['enq_current_status']) ? 1 : $data['enquiry']['enq_current_status'];
               $data['enquiry']['enq_cus_loan_period'] = empty($data['enquiry']['enq_cus_loan_period']) ? 0 : $data['enquiry']['enq_cus_loan_period'];
               $data['enquiry']['enq_cus_loan_amount'] = empty($data['enquiry']['enq_cus_loan_amount']) ? 0 : $data['enquiry']['enq_cus_loan_amount'];
               //$data['enquiry']['enq_cus_loan_amount'] = empty($data['enquiry']['enq_cus_loan_amount']) ? 0 : $data['enquiry']['enq_cus_loan_amount'];
               $data['enquiry']['enq_cus_family_members'] = empty($data['enquiry']['enq_cus_family_members']) ? 0 : $data['enquiry']['enq_cus_family_members'];
               $data['enquiry']['enq_cus_gender'] = isset($data['enquiry']['enq_cus_gender']) ? $data['enquiry']['enq_cus_gender'] : 0;
               $data['enquiry']['enq_cus_age'] = isset($data['enquiry']['enq_cus_age']) ? $data['enquiry']['enq_cus_age'] : 0;
               $data['enquiry']['enq_cus_address'] = isset($data['enquiry']['enq_cus_address']) ? $data['enquiry']['enq_cus_address'] : '';
               $data['enquiry']['enq_cus_ofc_address'] = isset($data['enquiry']['enq_cus_ofc_address']) ? $data['enquiry']['enq_cus_ofc_address'] : '';
               $data['enquiry']['enq_cus_office_no'] = isset($data['enquiry']['enq_cus_office_no']) ? $data['enquiry']['enq_cus_office_no'] : '';
               $data['enquiry']['enq_cus_occu'] = isset($data['enquiry']['enq_cus_occu']) ? $data['enquiry']['enq_cus_occu'] : '';
               $data['enquiry']['enq_cus_occu_category'] = isset($data['enquiry']['enq_cus_occu_category']) ? $data['enquiry']['enq_cus_occu_category'] : '';
               $data['enquiry']['enq_cus_purpose'] = isset($data['enquiry']['enq_cus_purpose']) ? $data['enquiry']['enq_cus_purpose'] : '';
               $data['enquiry']['enq_money_name'] = isset($data['money']['name']) ? $data['money']['name'] : '';
               $data['enquiry']['enq_money_phone'] = isset($data['money']['phone']) ? $data['money']['phone'] : '';
               $data['enquiry']['enq_money_relation'] = isset($data['money']['relation']) ? $data['money']['relation'] : '';
               $data['enquiry']['enq_money_remarks'] = isset($data['money']['remarks']) ? $data['money']['remarks'] : '';
               $data['enquiry']['enq_need_name'] = isset($data['need']['name']) ? $data['need']['name'] : '';
               $data['enquiry']['enq_need_phone'] = isset($data['need']['phone']) ? $data['need']['phone'] : '';
               $data['enquiry']['enq_need_relation'] = isset($data['need']['relation']) ? $data['need']['relation'] : '';
               $data['enquiry']['enq_need_remarks'] = isset($data['need']['remarks']) ? $data['need']['remarks'] : '';
               $data['enquiry']['enq_authority_name'] = isset($data['authority']['name']) ? $data['authority']['name'] : '';
               $data['enquiry']['enq_authority_phone'] = isset($data['authority']['phone']) ? $data['authority']['phone'] : '';
               $data['enquiry']['enq_authority_relation'] = isset($data['authority']['relation']) ? $data['authority']['relation'] : '';
               $data['enquiry']['enq_authority_remarks'] = isset($data['authority']['remarks']) ? $data['authority']['remarks'] : '';
               /* Set default values */

               if (isset($data['enquiry']) && !empty($data['enquiry'])) {
                    if (isset($data['enquiry']['other_purpose']) && !empty($data['enquiry']['other_purpose'])) {
                         $this->db->insert($this->tbl_purpose_of_purchase, array('purp_name' => $data['enquiry']['other_purpose'], 'purp_status' => 0, 'purp_addded_by' => $this->uid, 'purp_added_on' => date('Y-m-d H:i:s')));
                         $data['enquiry']['enq_cus_purpose'] = $this->db->insert_id();
                         unset($data['enquiry']['other_purpose']);
                    }

                    /* Occupation */
                    //                    if (isset($data['enquiry']['enq_cus_occu']) && !empty($data['enquiry']['enq_cus_occu'])) {
                    //                         $occu = $this->db->like('occ_name', $data['enquiry']['enq_cus_occu'], 'both')->get($this->tbl_occupation)->row_array();
                    //                         if (empty($occu)) {
                    //                              $this->db->insert($this->tbl_occupation, array('occ_name' => $data['enquiry']['enq_cus_occu']));
                    //                              $data['enquiry']['enq_cus_occu'] = $this->db->insert_id();
                    //                         } else {
                    //                              $data['enquiry']['enq_cus_occu'] = $occu['occ_id'];
                    //                         }
                    //                    } else {
                    //                         $data['enquiry']['enq_cus_occu'] = 0;
                    //                    }
                    /* City */
                    if (isset($data['enquiry']['enq_cus_city']) && !empty($data['enquiry']['enq_cus_city'])) {
                         $city = $this->db->like('cit_name', $data['enquiry']['enq_cus_city'], 'both')->get($this->tbl_city)->row_array();
                         if (empty($city)) {
                              $this->db->insert($this->tbl_city, array('cit_name' => $data['enquiry']['enq_cus_city']));
                              $data['enquiry']['enq_cus_city'] = $this->db->insert_id();
                         } else {
                              $data['enquiry']['enq_cus_city'] = $city['cit_id'];
                         }
                    } else {
                         $data['enquiry']['enq_cus_city'] = 0;
                    }
                    /* District */
                    /* if (isset($data['enquiry']['enq_cus_dist']) && !empty($data['enquiry']['enq_cus_dist'])) {
                        $dist = $this->db->like('dit_name', $data['enquiry']['enq_cus_dist'], 'both')->get($this->tbl_district)->row_array();
                        if (empty($dist)) {
                        $this->db->insert($this->tbl_district, array('dit_name' => $data['enquiry']['enq_cus_dist']));
                        $data['enquiry']['enq_cus_dist'] = $this->db->insert_id();
                        } else {
                        $data['enquiry']['enq_cus_dist'] = $dist['dit_id'];
                        }
                        } else {
                        $data['enquiry']['enq_cus_dist'] = 0;
                        } */
                    /* State */
                    //                    if (isset($data['enquiry']['enq_cus_state']) && !empty($data['enquiry']['enq_cus_state'])) {
                    //                         $state = $this->db->like('stt_name', $data['enquiry']['enq_cus_state'], 'both')->get($this->tbl_state)->row_array();
                    //                         if (empty($state)) {
                    //                              $this->db->insert($this->tbl_state, array('stt_name' => $data['enquiry']['enq_cus_state']));
                    //                              $data['enquiry']['enq_cus_state'] = $this->db->insert_id();
                    //                         } else {
                    //                              $data['enquiry']['enq_cus_state'] = $state['stt_id'];
                    //                         }
                    //                    } else {
                    //                         $data['enquiry']['enq_cus_state'] = 0;
                    //                    }
                    /* Country */
                    //                    if (isset($data['enquiry']['enq_cus_country']) && !empty($data['enquiry']['enq_cus_country'])) {
                    //                         $country = $this->db->like('cnt_name', $data['enquiry']['enq_cus_country'], 'both')->get($this->tbl_country)->row_array();
                    //                         if (empty($country)) {
                    //                              $this->db->insert($this->tbl_country, array('cnt_name' => $data['enquiry']['enq_cus_country']));
                    //                              $data['enquiry']['enq_cus_country'] = $this->db->insert_id();
                    //                         } else {
                    //                              $data['enquiry']['enq_cus_country'] = $country['cnt_id'];
                    //                         }
                    //                    } else {
                    //                         $data['enquiry']['enq_cus_country'] = 0;
                    //                    }
                    /* Sale and purchase */
                    $data['enquiry']['enq_se_id'] = isset($data['enquiry']['enq_se_id']) ? $data['enquiry']['enq_se_id'] : $this->uid;
                    $data['enquiry']['enq_entry_date'] = (isset($data['enquiry']['enq_entry_date']) && !empty($data['enquiry']['enq_entry_date'])) ?
                         date('Y-m-d', strtotime($data['enquiry']['enq_entry_date'])) : '';

                    $data['enquiry']['enq_next_foll_date'] = (isset($data['followup']['foll_next_foll_date']) &&
                         !empty($data['followup']['foll_next_foll_date'])) ?
                         date('Y-m-d', strtotime($data['followup']['foll_next_foll_date'])) : null;

                    $data['enquiry']['enq_added_on'] = date('Y-m-d H:i:s'); //03-12-2020 changed to h -> H
                    if ($this->db->insert($this->tbl_enquiry, array_filter($data['enquiry']), true)) {
                         $enquiryId = $this->db->insert_id();

                         $this->db->where('enq_id', $enquiryId)->update(
                              $this->tbl_enquiry,
                              array('enq_number' => generate_vehicle_virtual_id($enquiryId))
                         );

                         //Questions  
                         /* $questions = array();
                             if ($data['enquiry']['enq_cus_status'] == 1) { // Sale
                             $questions = explode(',', $this->db->select('GROUP_CONCAT(qus_id) AS qus_id')
                             ->get_where($this->tbl_questions, 'qus_type = 1 OR qus_type = 2')->row()->qus_id);
                             } else if ($data['enquiry']['enq_cus_status'] == 2) { // Buy
                             $questions = explode(',', $this->db->select('GROUP_CONCAT(qus_id) AS qus_id')
                             ->get_where($this->tbl_questions, 'qus_type = 1 OR qus_type = 3')->row()->qus_id);
                             } else if ($data['enquiry']['enq_cus_status'] == 3) { // Exch
                             $questions = explode(',', $this->db->select('GROUP_CONCAT(qus_id) AS qus_id')
                             ->get_where($this->tbl_questions, 'qus_type = 1 OR qus_type = 4')->row()->qus_id);
                             }
                             if (!empty($questions) && !empty($data['questions'])) {
                             foreach ($data['questions'] as $key => $value) {
                             $quesId = substr($key, 4);
                             if (in_array($quesId, $questions) && !empty($value)) {
                             $qstArray = array(
                             'enqq_enq_id' => $enquiryId,
                             'enqq_question_id' => $quesId,
                             'enqq_answer' => $value
                             );
                             $this->db->insert($this->tbl_enquiry_questions, $qstArray);
                             }
                             }
                             } */
                         if ($data['enquiry']['enq_cus_status'] == 1) {
                              if (!empty($data['saquestions'])) {
                                   foreach ($data['saquestions'] as $key => $value) {
                                        /*                                   $quesId = substr($key, 4);
                                            if (in_array($quesId, $questions) && !empty($value)) { */
                                        if (!empty($value)) {
                                             $qstArray = array(
                                                  'enqq_enq_id' => $enquiryId,
                                                  'enqq_question_id' => $key,
                                                  'enqq_answer' => $value
                                             );
                                             $this->db->insert($this->tbl_enquiry_questions, $qstArray);
                                        }
                                   }
                              }
                         } elseif ($data['enquiry']['enq_cus_status'] == 2) {


                              if (!empty($data['byquestions'])) {
                                   foreach ($data['byquestions'] as $key => $value) {
                                        //                                     $quesId = substr($key, 4);
                                        if (!empty($value)) {
                                             $qstArray = array(
                                                  'enqq_enq_id' => $enquiryId,
                                                  'enqq_question_id' => $key,
                                                  'enqq_answer' => $value
                                             );
                                             $this->db->insert($this->tbl_enquiry_questions, $qstArray);
                                        }
                                   }
                              }
                         } else {

                              if (!empty($data['exquestions'])) {
                                   foreach ($data['exquestions'] as $key => $value) {
                                        //                                     $quesId = substr($key, 4);
                                        if (!empty($value)) {
                                             $qstArray = array(
                                                  'enqq_enq_id' => $enquiryId,
                                                  'enqq_question_id' => $key,
                                                  'enqq_answer' => $value
                                             );
                                             $this->db->insert($this->tbl_enquiry_questions, $qstArray);
                                        }
                                   }
                              }
                         }
                         //Questions

                         if ($regId > 0) {
                              /* Update register master */
                              $this->db->where('vreg_id', $regId);
                              $this->db->update($this->tbl_register_master, array('vreg_status' => 1, 'vreg_inquiry' => $enquiryId));
                         }
                         if ($data['enquiry']['enq_cus_status'] == 1 || $data['enquiry']['enq_cus_status'] == 3) { //sale or Exchange
                              $noOfSale = isset($data['vehicle']['sale']['veh_brand']) ? count($data['vehicle']['sale']['veh_brand']) : 0; //required
                              if ($noOfSale > 0) {
                                   $this->storeReqVeh($data['vehicle']['sale'], $noOfSale, $enquiryId); //req
                              }

                              $noOfPitched = isset($data['vehicle']['pitched']['veh_val_id']) ? count($data['vehicle']['pitched']['veh_val_id']) : 0;
                              if ($noOfPitched > 0) {
                                   $this->storePitchedVeh($data['vehicle']['pitched'], $noOfPitched, $enquiryId);
                              }
                         }
                         /* Existing veh */
                         $noOfExisting = isset($data['vehicle']['existing']['veh_brand']) ? count($data['vehicle']['existing']['veh_brand']) : 0;
                         if ($noOfExisting > 0) {
                              $this->storeExistingVeh($data['vehicle']['existing'], $noOfExisting, $enquiryId);
                         }
                         /* @Existing veh */
                         if ($data['enquiry']['enq_cus_status'] == 2 || $data['enquiry']['enq_cus_status'] == 3) { //purchase //jsk create function
                              $noOfBuy = isset($data['vehicle']['buy']['veh_brand']) ? count($data['vehicle']['buy']['veh_brand']) : 0;
                              $this->storePurchaseVeh($data['vehicle']['buy'], $noOfBuy, $enquiryId, $data['enquiry']);
                         }

                         if (isset($data['followup']) && !empty($data['followup'])) {/* Followup */
                              // debug($data['followup']);
                              if (!empty($noOfPitched)) {
                                   $veh_id = $this->db->select('veh_id')->order_by('veh_id', 'ASC')->get_where($this->tbl_vehicle, array('veh_enq_id' => $enquiryId, 'veh_type' => 3))->row_array();
                              } else {
                                   $veh_id = $this->db->select('veh_id')->order_by('veh_id', 'ASC')->get_where($this->tbl_vehicle, array('veh_enq_id' => $enquiryId, 'veh_type' => 1))->row_array();
                              }
                              $data['followup']['foll_cus_id'] = $enquiryId;
                              // $data['followup']['foll_cus_vehicle_id'] = $veh_id;
                              $this->addFollowUp($data['followup']);
                         }
                         generate_log(array(
                              'log_title' => 'Added new row',
                              'log_desc' => serialize($data),
                              'log_controller' => strtolower(__CLASS__),
                              'log_action' => 'C',
                              'log_ref_id' => $enquiryId,
                              'log_web_or_mob' => '2',
                              'log_added_by' => get_logged_user('usr_id')
                         ));
                    } else {
                         generate_log(array(
                              'log_title' => 'Error while add new enquiry',
                              'log_desc' => 'Error while add new enquiry',
                              'log_controller' => strtolower(__CLASS__),
                              'log_action' => 'C',
                              'log_web_or_mob' => '2',
                              'log_added_by' => get_logged_user('usr_id')
                         ));
                    }
               }
               return $enquiryId;
          } else {
               return false;
          }
     }

     function addFollowUp($datas)
     {
          if (!empty($datas)) {

               $datas['foll_next_foll_date'] = (isset($datas['foll_next_foll_date']) && !empty($datas['foll_next_foll_date'])) ?
                    date('Y-m-d h:i:s', strtotime($datas['foll_next_foll_date'])) : '';

               $datas['foll_added_by'] = get_logged_user('usr_id');
               $datas['foll_entry_date'] = date('Y-m-d H:i:s');
               $datas = array_filter($datas);
               if ($this->db->insert($this->tbl_followup, $datas)) {
                    $id = $this->db->insert_id();
                    generate_log(array(
                         'log_title' => 'New followup',
                         'log_desc' => serialize($datas),
                         'log_controller' => strtolower(__CLASS__),
                         'log_action' => 'C',
                         'log_ref_id' => $id,
                         'log_web_or_mob' => '2',
                         'log_added_by' => get_logged_user('usr_id')
                    ));

                    if ((isset($datas['foll_cus_id']) && !empty($datas['foll_cus_id'])) &&
                         !empty($datas['foll_next_foll_date'])
                    ) {
                         $follStatus = isset($datas['foll_status']) ? $datas['foll_status'] : 0;
                         $this->db->where('enq_id', $datas['foll_cus_id']);
                         $this->db->update(
                              $this->tbl_enquiry,
                              array(
                                   'enq_next_foll_date' => $datas['foll_next_foll_date'],
                                   'enq_cus_when_buy' => $follStatus
                              )
                         );

                         generate_log(array(
                              'log_title' => 'Followup updated',
                              'log_desc' => 'Followup date updated on inquiry follup id-' . $id,
                              'log_controller' => 'update-foll-date-enq',
                              'log_action' => 'U',
                              'log_ref_id' => $datas['foll_cus_id'],
                              'log_web_or_mob' => '2',
                              'log_added_by' => get_logged_user('usr_id')
                         ));
                    }
                    /* Update as punched */
                    $this->db->where('vreg_inquiry', $datas['foll_cus_id']);
                    $this->db->update($this->tbl_register_master, array('vreg_is_punched' => 1));

                    return true;
               }
          } else {
               return false;
          }
     }

     function storeReqVeh($data, $noOfSale, $enquiryId)
     {
          $showroom = get_logged_user('usr_showroom');
          for ($i = 0; $i < $noOfSale; $i++) {
               $req['veh_enq_id'] = $enquiryId;
               $req['veh_status'] = 1;
               $req['veh_brand'] = isset($data['veh_brand'][$i]) ? $data['veh_brand'][$i] : 0;
               $req['veh_model'] = isset($data['veh_model'][$i]) ? $data['veh_model'][$i] : 0;
               $req['veh_varient'] = isset($data['veh_varient'][$i]) ? $data['veh_varient'][$i] : 0;
               $req['veh_fuel'] = $data['veh_fuel'][$i];
               $req['veh_color'] = $data['veh_color'][$i];
               $req['veh_exptd_date_purchase'] = $data['veh_exptd_date_purchase'][$i];
               $req['veh_price_id'] = empty($data['veh_price_id'][$i]) ? 0 : $data['veh_price_id'][$i];
               $req['veh_prefer_no'] = $data['veh_prefer_number'][$i];
               $req['veh_year'] = empty($data['veh_year'][$i]) ? 0 : $data['veh_year'][$i];
               $req['veh_km_id'] = empty($data['veh_km_id'][$i]) ? 0 : $data['veh_km_id'][$i];
               $req['veh_remarks'] = empty($data['veh_remarks'][$i]) ? 0 : $data['veh_remarks'][$i];
               $req['veh_manf_year_from'] = isset($data['veh_manf_year_from'][$i]) ? $data['veh_manf_year_from'][$i] : '';
               $req['veh_manf_year_to'] = isset($data['veh_manf_year_to'][$i]) ? $data['veh_manf_year_to'][$i] : '';
               $req['veh_type'] = 1; //required
               $req['veh_added_by'] = $this->uid;
               if (!empty($showroom)) {
                    $sale['veh_showroom_id'] = $showroom;
               }
               if (isset($data['veh_id'][$i]) && !empty($data['veh_id'][$i])) {
                    $this->db->where('veh_id', $data['veh_id'][$i]);
                    $this->db->update($this->tbl_vehicle, $req);
               } else {
                    $this->db->insert($this->tbl_vehicle, $req);
               }

               /*  $vehId = $this->db->insert_id();
                   if (isset($data['followup']) && !empty($data['followup'])) {
                   $data['followup']['foll_cus_id'] = $enquiryId;
                   $data['followup']['foll_cus_vehicle_id'] = $vehId;
                   $this->followup->addFollowUp($data['followup']);
                   } */

               if (isset($data['veh_color'][$i]) && !empty($data['sale']['veh_color'][$i])) {
                    $PrfColorData = array(
                         'prf_key' => '1',
                         'prf_value' => $data['vehicle']['veh_color'][$i],
                         'prf_description' => 'Submited from Enquiry form',
                         'prf_enq_id' => $enquiryId,
                         'prf_addded_by' => $this->uid,
                         'prf_added_on' => date("Y-m-d H:i:s"),
                         'prf_showoom' => $this->shrm
                    );
                    $this->db->insert('cpnl_enq_prefrences', $PrfColorData);
                    $PrfColorData['proc_id'] = $this->db->insert_id();
                    generate_log(array(
                         'log_title' => 'New preference',
                         'log_desc' => serialize($PrfColorData),
                         'log_controller' => 'new-preference',
                         'log_action' => 'C',
                         'log_ref_id' => $PrfColorData['proc_id'],
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));
               }
               if (isset($data['veh_prefer_number'][$i]) && !empty($data['veh_prefer_number'][$i])) {
                    $PrfNumberData = array(
                         'prf_key' => '1',
                         'prf_value' => $data['veh_prefer_number'][$i],
                         'prf_description' => 'Submited from Enquiry form',
                         'prf_enq_id' => $enquiryId,
                         'prf_addded_by' => $this->uid,
                         'prf_added_on' => date("Y-m-d H:i:s"),
                         'prf_showoom' => $this->shrm
                    );
                    $this->db->insert('cpnl_enq_prefrences', $PrfNumberData);
                    $PrfNumberData['proc_id'] = $this->db->insert_id();
                    generate_log(array(
                         'log_title' => 'New preference',
                         'log_desc' => serialize($PrfNumberData),
                         'log_controller' => 'new-preference',
                         'log_action' => 'C',
                         'log_ref_id' => $PrfNumberData['proc_id'],
                         'log_web_or_mob' => '2',
                         'log_added_by' => $this->uid
                    ));
               }
          }
          //return true;
     }

     function storePitchedVeh($data, $noOfPitched, $enquiryId)
     {
          $showroom = get_logged_user('usr_showroom');
          for ($i = 0; $i < $noOfPitched; $i++) {
               $pitched['veh_enq_id'] = $enquiryId;
               $pitched['veh_status'] = 1;
               $pitched['veh_stock_id'] = $data['veh_val_id'][$i];
               $pitched['veh_exch_cus_expect'] = $data['veh_customer_offer'][$i];
               $pitched['veh_remarks'] = $data['veh_remarks'][$i];
               $pitched['veh_tl_remarks'] = $data['veh_tl_remarks'][$i];
               $pitched['veh_sm_remarks'] = $data['veh_sm_remarks'][$i];
               $pitched['veh_gm_remarks'] = $data['veh_gm_remarks'][$i];
               $pitched['veh_type'] = 3;
               $pitched['veh_added_by'] = $this->uid;
               if (!empty($showroom)) {
                    $sale['veh_showroom_id'] = $showroom;
               }
               // $this->db->insert($this->tbl_vehicle, $pitched);
               if (isset($data['veh_id'][$i]) && !empty($data['veh_id'][$i])) {
                    $this->db->where('veh_id', $data['veh_id'][$i]);
                    $this->db->update($this->tbl_vehicle, $pitched);
               } else {
                    $this->db->insert($this->tbl_vehicle, $pitched);
               }
          }
     }

     function storeExistingVeh($data, $noOfExisting, $enquiryId)
     {
          $showroom = get_logged_user('usr_showroom');
          for ($i = 0; $i < $noOfExisting; $i++) {
               $existing['veh_enq_id'] = $enquiryId;
               $existing['veh_status'] = 0;
               $existing['veh_brand'] = isset($data['veh_brand'][$i]) ? $data['veh_brand'][$i] : 0;
               $existing['veh_model'] = isset($data['veh_model'][$i]) ? $data['veh_model'][$i] : 0;
               $existing['veh_varient'] = isset($data['veh_varient'][$i]) ? $data['veh_varient'][$i] : 0;
               $existing['veh_fuel'] = $data['veh_fuel'][$i];
               $existing['veh_color'] = $data['veh_color'][$i];
               $existing['veh_km_from'] = empty($data['veh_km_from'][$i]) ? 0 : $data['veh_km_from'][$i];
               $existing['veh_exchange_intrested'] = empty($data['exchange_intrested'][$i]) ? 0 : $data['exchange_intrested'][$i];
               $existing['veh_exch_dealer_value'] = empty($data['market_value'][$i]) ? 0 : $data['market_value'][$i];
               $existing['veh_exch_estimate'] = empty($data['our_offer'][$i]) ? 0 : $data['our_offer'][$i];
               $existing['veh_exch_cus_expect'] = empty($data['veh_exch_cus_expect'][$i]) ? 0 : $data['veh_exch_cus_expect'][$i]; //db Customer expectation
               $existing['veh_insurance_validity'] = $data['insurance_validity'][$i];
               $existing['veh_tyre_condition'] = $data['tyre_condition'][$i];
               $existing['veh_remarks'] = $data['veh_remarks'][$i];
               $existing['veh_manf_year'] = empty($data['veh_manf_year'][$i]) ? 0 : $data['veh_manf_year'][$i];
               $existing['veh_reg'] = $data['veh_reg1'][$i] . '-' . $data['veh_reg2'][$i] . '-' . $data['veh_reg3'][$i] . '-' . $data['veh_reg4'][$i];
               $existing['veh_owner'] = empty($data['veh_owner'][$i]) ? 0 : $data['veh_owner'][$i];
               $existing['veh_type'] = 2; //Existing
               $existing['veh_added_by'] = $this->uid;
               if (!empty($showroom)) {
                    $sale['veh_showroom_id'] = $showroom;
               }
               if (isset($data['veh_id'][$i]) && !empty($data['veh_id'][$i])) {
                    $this->db->where('veh_id', $data['veh_id'][$i]);
                    $this->db->update($this->tbl_vehicle, $existing);
               } else {
                    $this->db->insert($this->tbl_vehicle, $existing);
               }
          }
     }

     function storePurchaseVeh($data, $noOfBuy, $enquiryId, $enquiry)
     {
          // $valuationDetails['val_hypo_bank'] = !empty($data['bank'][0]) ? $data['bank'][0] :0;
          //debug($valuationDetails['val_hypo_bank']);//$data['val_hypo_close_by_cust'][$i]
          //  debug($data['veh_id']);
          //debug($valId);
          //$data['enquiry']['enq_cus_name']
          // debug($enquiry['enq_cus_name']);
          // exit;
          $showroom = get_logged_user('usr_showroom');
          for ($i = 0; $i < $noOfBuy; $i++) {
               $buy['veh_enq_id'] = $enquiryId;
               $buy['veh_status'] = 2;
               $buy['veh_type'] = 0;
               $buy['veh_brand'] = isset($data['veh_brand'][$i]) ? $data['veh_brand'][$i] : 0;
               $buy['veh_model'] = isset($data['veh_model'][$i]) ? $data['veh_model'][$i] : 0;
               $buy['veh_varient'] = isset($data['veh_varient'][$i]) ? $data['veh_varient'][$i] : 0;
               $buy['veh_fuel'] = $data['veh_fuel'][$i];
               $buy['veh_year'] = empty($data['veh_year'][$i]) ? 0 : $data['veh_year'][$i];
               $buy['veh_color'] = $data['veh_color'][$i];
               //$buy['veh_price_from'] = empty($data['vehicle']['buy']['veh_price_from'][$i]) ? 0 : $data['vehicle']['buy']['veh_price_from'][$i];
               //$buy['veh_price_to'] = empty($data['vehicle']['buy']['veh_price_to'][$i]) ? 0 : $data['vehicle']['buy']['veh_price_to'][$i];
               $buy['veh_price_id'] = empty($data['veh_price_id'][$i]) ? 0 : $data['veh_price_id'][$i];
               $buy['veh_km_from'] = empty($data['veh_km_from'][$i]) ? 0 : $data['veh_km_from'][$i];
               //$buy['veh_km_to'] = empty($data['vehicle']['buy']['veh_km_to'][$i]) ? 0 : $data['vehicle']['buy']['veh_km_to'][$i];
               //$buy['veh_km_id'] = empty($data['vehicle']['buy']['veh_km_id'][$i]) ? 0 : $data['vehicle']['buy']['veh_km_id'][$i];
               $buy['veh_chassis_number'] = isset($data['veh_chassis_number'][$i]) ? $data['veh_chassis_number'][$i] : 0;
               $buy['veh_reg'] = $data['veh_reg1'][$i] . '-' . $data['veh_reg2'][$i] . '-' . $data['veh_reg3'][$i] . '-' . $data['veh_reg4'][$i];
               $buy['veh_owner'] = $data['veh_owner'][$i];
               $buy['veh_remarks'] = $data['veh_remarks'][$i];
               //
               $buy['veh_color_in_rc'] = $data['veh_color_in_rc'][$i] ? $data['veh_color_in_rc'][$i] : 0;
               $buy['veh_delivery_location'] = $data['veh_delivery_location'][$i];
               $buy['veh_delivery_state'] = $data['veh_delivery_state'][$i];
               $buy['veh_comprossr'] = $data['veh_comprossr'][$i];
               $buy['veh_dealership'] = $data['veh_dealership'][$i];
               $buy['veh_re_reg'] = $data['veh_re_reg'][$i];
               //
               //$buy['veh_exch_cus_expect'] = !empty($data['vehicle']['buy']['veh_exch_cus_expect'][$i]) ? $data['vehicle']['buy']['veh_exch_cus_expect'][$i] : 0;
               // $buy['veh_exch_estimate'] = !empty($data['vehicle']['buy']['veh_exch_estimate'][$i]) ? $data['vehicle']['buy']['veh_exch_estimate'][$i] : 0;
               //$buy['veh_exch_dealer_value'] = !empty($data['vehicle']['buy']['veh_exch_dealer_value'][$i]) ? $data['vehicle']['buy']['veh_exch_dealer_value'][$i] : 0;

               $buy['veh_first_reg'] = !empty($data['veh_first_reg'][$i]) ? date('Y-m-d', strtotime($data['veh_first_reg'][$i])) : 0;
               $buy['veh_delivery_date'] = !empty($data['veh_delivery_date'][$i]) ? date('Y-m-d', strtotime($data['veh_delivery_date'][$i])) : 0;
               $buy['veh_manf_year'] = !empty($data['veh_manf_year'][$i]) ? $data['veh_manf_year'][$i] : 0;
               $buy['veh_ac'] = !empty($data['veh_ac'][$i]) ? $data['veh_ac'][$i] : 0;
               $buy['veh_ac_zone'] = !empty($data['veh_ac_zone'][$i]) ? $data['veh_ac_zone'][$i] : 0;
               $buy['veh_cc'] = !empty($data['veh_cc'][$i]) ? $data['veh_cc'][$i] : 0;
               $buy['veh_vehicle_type'] = !empty($data['veh_vehicle_type'][$i]) ? $data['veh_vehicle_type'][$i] : 0;
               $buy['veh_engine_num'] = !empty($data['veh_engine_num'][$i]) ? $data['veh_engine_num'][$i] : 0;
               $buy['veh_transmission'] = !empty($data['veh_transmission'][$i]) ? $data['veh_transmission'][$i] : 0;
               $buy['veh_seat_no'] = !empty($data['veh_seat_no'][$i]) ? $data['veh_seat_no'][$i] : 0;

               $buy['veh_added_by'] = $this->uid;
               $buy['veh_showroom_id'] = $showroom;
               $buy['veh_stock_id'] = isset($data['is_stock_veh'][$i]) ? $data['val_id'][$i] : 0;
               // unset($data['is_stock_veh'][$i]);
               $buy['veh_type'] = 0;
               //  $this->db->insert($this->tbl_vehicle, $buy);
               // $vehId = $this->db->insert_id();
               if (isset($data['veh_id'][$i]) && !empty($data['veh_id'][$i])) {
                    $vehId = $data['veh_id'][$i];
                    $buy['check'] = 'Old';
                    $this->db->where('veh_id', $data['veh_id'][$i]);
                    $this->db->update($this->tbl_vehicle, $buy);
               } else {
                    $buy['check'] = 'New';
                    $this->db->insert($this->tbl_vehicle, $buy);
                    $vehId = $this->db->insert_id();
               }

               //                                   if (isset($data['followup']) && !empty($data['followup'])) {
               //                                        $data['followup']['foll_cus_id'] = $enquiryId;
               //                                        $data['followup']['foll_cus_vehicle_id'] = $vehId;
               //                                        $this->followup->addFollowUp($data['followup']);
               //                                   }
               $valuationDetails['val_vehicle_id'] = $vehId;
               $valuationDetails['val_enquiry_id'] = $enquiryId;
               $valuationDetails['val_veh_no'] = isset($buy['veh_reg']) ? $buy['veh_reg'] : '';
               $valuationDetails['val_showroom'] = $showroom;
               $valuationDetails['val_division'] = $this->div;
               $valuationDetails['val_brand'] = $buy['veh_brand'];
               $valuationDetails['val_model'] = $buy['veh_model'];
               $valuationDetails['val_variant'] = $buy['veh_varient'];
               $valuationDetails['val_fuel'] = $buy['veh_fuel'];
               $valuationDetails['val_color'] = $buy['veh_color'];
               $valuationDetails['val_chasis_no'] = $buy['veh_chassis_number'];
               $valuationDetails['val_added_by'] = $this->uid;
               $valuationDetails['val_status'] = 0;
               $valuationDetails['val_type'] = 3;
               $valuationDetails['val_km'] = !empty($buy['veh_km_from']) ? $buy['veh_km_from'] : $buy['veh_km_to'];

               $valuationDetails['val_model_year'] = $buy['veh_year'];
               $valuationDetails['val_delv_date'] = !empty($buy['veh_delivery_date']) ? date('Y-m-d', strtotime($buy['veh_delivery_date'])) : '';
               $valuationDetails['val_reg_date'] = !empty($buy['veh_first_reg']) ? date('Y-m-d', strtotime($buy['veh_first_reg'])) : '';
               $valuationDetails['val_minif_year'] = $buy['veh_manf_year'];
               $valuationDetails['val_ac'] = $buy['veh_ac'];
               $valuationDetails['val_ac_zone'] = $buy['veh_ac_zone'];
               $valuationDetails['val_eng_cc'] = $buy['veh_cc'];
               $valuationDetails['val_veh_type'] = $buy['veh_vehicle_type'];
               $valuationDetails['val_model_year'] = $buy['veh_year'];
               $valuationDetails['val_engine_no'] = $buy['veh_engine_num'];
               $valuationDetails['val_transmission'] = $buy['veh_transmission'];
               $valuationDetails['val_no_of_seats'] = $buy['veh_seat_no'];
               $valuationDetails['val_delv_date'] = !empty($buy['veh_delivery_date']) ? date('Y-m-d', strtotime($buy['veh_delivery_date'])) : '';
               $valuationDetails['val_reg_date'] = !empty($buy['veh_first_reg']) ? date('Y-m-d', strtotime($buy['veh_first_reg'])) : '';
               $valuationDetails['val_cust_name'] = isset($enquiry['enq_cus_name']) ? $enquiry['enq_cus_name'] : '';
               $valuationDetails['val_cust_phone'] = isset($enquiry['enq_cus_mobile']) ? $enquiry['enq_cus_mobile'] : '';
               $valuationDetails['val_cust_email'] = isset($enquiry['enq_cus_email']) ? $enquiry['enq_cus_email'] : '';
               $valuationDetails['val_cust_source'] = isset($enquiry['enq_mode_enq']) ? $enquiry['enq_mode_enq'] : '';
               $valuationDetails['veh_color_in_rc'] = $data['veh_color_in_rc'][$i];
               $valuationDetails['veh_delivery_location'] = $data['veh_delivery_location'][$i];
               $valuationDetails['veh_delivery_state'] = $data['veh_delivery_state'][$i];
               $valuationDetails['veh_comprossr'] = $data['veh_comprossr'][$i];
               $valuationDetails['veh_dealership'] = $data['veh_dealership'][$i];
               $valuationDetails['veh_re_reg'] = $data['veh_re_reg'][$i];

               $vhNum = (isset($buy['veh_reg']) && !empty($buy['veh_reg'])) ? explode('-', str_replace(' ', '-', $buy['veh_reg'])) : '';
               $valuationDetails['val_prt_1'] = isset($vhNum['0']) ? $vhNum['0'] : '';
               $valuationDetails['val_prt_2'] = isset($vhNum['1']) ? $vhNum['1'] : '';
               $valuationDetails['val_prt_3'] = isset($vhNum['2']) ? $vhNum['2'] : '';
               $valuationDetails['val_prt_4'] = isset($vhNum['3']) ? $vhNum['3'] : '';
               $valuationDetails['val_insurance_company'] = isset($data['insurance_company'][$i]) ? $data['insurance_company'][$i] : '';
               $valuationDetails['val_insurance_comp_date'] = !empty($data['valid_up_to'][$i]) ? date('Y-m-d', strtotime($data['valid_up_to'][$i])) : ''; //isset($data['vehicle']['buy']['valid_up_to'][$i]) ? $data['vehicle']['buy']['valid_up_to'][$i] : '';
               $valuationDetails['val_insurance_ll_date'] = !empty($data['val_insurance_ll_date'][$i]) ? date('Y-m-d', strtotime($data['val_insurance_ll_date'][$i])) : ''; //isset($data['vehicle']['buy']['val_insurance_ll_date'][$i]) ? $data['vehicle']['buy']['val_insurance_ll_date'][$i] : '';
               $valuationDetails['val_insurance_comp_idv'] = isset($data['idv'][$i]) ? $data['idv'][$i] : '';
               $valuationDetails['val_insurance_ll_idv'] = isset($data['ncb_percentage'][$i]) ? $data['ncb_percentage'][$i] : '';
               //$valuationDetails['val_insurance_need_ncb'] = isset($data['vehicle']['buy']['ncb_req'][$i]) ? $data['vehicle']['buy']['ncb_req'][$i] : '';
               $valuationDetails['val_insurance_need_ncb'] = $data['ncb_req'][0] ? 1 : 0;
               $valuationDetails['val_insurance'] = isset($data['insurance_type'][$i]) ? $data['insurance_type'][$i] : 0;
               //hypothication
               $valuationDetails['val_hypo_bank'] = !empty($data['bank'][$i]) ? $data['bank'][$i] : 0;
               $valuationDetails['val_hypo_bank_branch'] = isset($data['bank_branch'][$i]) ? $data['bank_branch'][$i] : '';
               //$valuationDetails['val_hypo_close_by_cust'] = isset($data['vehicle']['buy']['val_hypo_close_by_cust'][$i]) ? $data['vehicle']['buy']['val_hypo_close_by_cust'][$i] : '';
               $valuationDetails['val_hypo_loan_date'] = !empty($data['loan_starting_date'][$i]) ? date('Y-m-d', strtotime($data['loan_starting_date'][$i])) : ''; //isset($data['vehicle']['buy']['loan_starting_date'][$i]) ? $data['vehicle']['buy']['loan_starting_date'][$i] : '';
               $valuationDetails['val_hypo_loan_end_date'] = !empty($data['loan_ending_date'][$i]) ? date('Y-m-d', strtotime($data['loan_ending_date'][$i])) : ''; //isset($data['vehicle']['buy']['loan_ending_date'][$i]) ? $data['vehicle']['buy']['loan_ending_date'][$i] : '';
               $valuationDetails['val_hypo_daily_int'] = isset($data['daily_interest'][$i]) ? $data['daily_interest'][$i] : '';
               $valuationDetails['val_hypo_frclos_val'] = isset($data['forclousure_value'][$i]) ? $data['forclousure_value'][$i] : '';
               $valuationDetails['val_hypo_frclos_val'] = isset($data['forclousure_value'][$i]) ? $data['forclousure_value'][$i] : '';
               $valuationDetails['val_hypo_frclos_date'] = !empty($data['forclousure_date'][$i]) ? date('Y-m-d', strtotime($data['forclousure_date'][$i])) : ''; //isset($data['vehicle']['buy']['forclousure_date'][$i]) ? $data['vehicle']['buy']['forclousure_date'][$i] : '';
               $valuationDetails['val_top_up_loan'] = isset($data['any_top_up_loan'][$i]) ? 1 : 0;
               $valuationDetails['val_hypo_close_by_cust'] = isset($data['val_hypo_close_by_cust'][$i]) ? 1 : 0;
               $valuationDetails['val_hypo_loan_amt'] = isset($data['loan_amount'][$i]) ? $data['loan_amount'][$i] : '';
               if (isset($data['val_id'][$i])) { //Check if Selected already added vehicle from the select box
                    //debug($data['val_id'][$i]);
                    $this->db->where('val_id', $data['val_id'][$i]);
                    //$this->db->update($this->tbl_valuation, ['val_enquiry_id' => $enquiryId]);
                    $this->db->update($this->tbl_valuation, $valuationDetails);
               } else { //Newly added vehicle
                    //debug('new');
                    $this->db->insert($this->tbl_valuation, $valuationDetails);
               }
          }
     }

     function addEnquiryHistory($datas)
     {
          if (!empty($datas)) {
               $this->db->insert($this->tbl_enquiry_history, $datas);
               return $this->db->insert_id();
          }
          return false;
     }

     function registerTodaysanalysis()
     {
          // $this->load->model('emp_details/emp_details_model', 'emp_details');
          $tc = $this->teleCallers();
          if (!empty($tc)) {
               foreach ($tc as $key => $value) {
                    $tc[$key]['analysis'] = $this->db->select('COUNT(*) AS cnt, vreg_contact_mode')->group_by('vreg_contact_mode')
                         ->where('DATE(' . $this->tbl_register_master . '.vreg_added_on) = ' . "DATE('" . date('Y-m-d') . "')")
                         ->where('vreg_first_owner', $value['user_id'])->get($this->tbl_register_master)->result_array();
               }
          }
          return $tc;
     }

     function teleCallers()
     {
          return $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->where(array($this->tbl_groups . '.grp_slug' => 'TC'))->where(array($this->tbl_users . '.usr_active' => 1))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();
     }

     public function getVehicleRegData($id = '', $limit = 0, $page = 0, $filter = array(), $userAccess)
     { //readVehicleReg *renamed
          //  $userAccess=getUserAcess($this->uid);
          $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)
               ->get($this->tbl_users)->row()->usr_id);

          $enqExclude = loss_of_sale_or_buy . ',' . sale_closed . ',' . enq_req_drop;

          $vregDivision = isset($filter['vreg_division']) ? $filter['vreg_division'] : 0;
          $vregShowroom = isset($filter['vreg_showroom']) ? $filter['vreg_showroom'] : 0;
          $showallsts = isset($filter['showallsts']) ? $filter['showallsts'] : 0;

          $vreg_assigned_to = isset($filter['vreg_assigned_to']) ? $filter['vreg_assigned_to'] : 0;
          $vreg_first_owner = isset($filter['vreg_first_owner']) ? $filter['vreg_first_owner'] : 0;
          $dept = isset($filter['vreg_department']) ? $filter['vreg_department'] : '';
          $type = isset($filter['vreg_call_type']) ? $filter['vreg_call_type'] : '';
          $mode = isset($filter['vreg_contact_mode']) ? $filter['vreg_contact_mode'] : '';
          $effective = isset($filter['vreg_is_effective']) ? $filter['vreg_is_effective'] : '';
          $addedEntry = (isset($filter['added_entry']) && !empty($filter['added_entry'])) ? $filter['added_entry'] : 'vreg_added_on';

          $enq_date_from = (isset($filter['vreg_added_on_fr']) && !empty($filter['vreg_added_on_fr'])) ?
               date('Y-m-d', strtotime($filter['vreg_added_on_fr'])) : '';

          $enq_date_to = (isset($filter['vreg_added_on_to']) && !empty($filter['vreg_added_on_to'])) ?
               date('Y-m-d', strtotime($filter['vreg_added_on_to'])) : '';
          $search = isset($filter['search']) ? $filter['search'] : '';

          // $this->userAccess = $this->common_model->getUser($this->uid);
          //                 if (!check_permission($this->userAccess, 'registration', 'showallregisters')) {
          //                      $this->db->where(array('vreg_assigned_to' => $this->uid));
          //                 }

          if (($this->uid != ADMIN_ID) && empty($search)) {
               if (!check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where(array('vreg_assigned_to' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {
                    $this->db->where(array('vreg_added_by' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregistersmartpurchaseonly')) {
                    $this->db->where_in('vreg_department', array(7));
               }
          }

          if (!empty($filter)) {

               if ($vreg_assigned_to > 0) {
                    $this->db->where('vreg_assigned_to', $vreg_assigned_to);
               }

               if ($vreg_first_owner > 0) {
                    $this->db->where('vreg_first_owner', $vreg_first_owner);
               }

               $type = isset($filter['type']) ? $filter['type'] : '';
               $brd = isset($filter['vreg_brand']) ? $filter['vreg_brand'] : '';
               $mod = isset($filter['vreg_model']) ? $filter['vreg_model'] : '';
               $var = isset($filter['vreg_varient']) ? $filter['vreg_varient'] : '';

               if ($type == 'ex') {
                    $this->db->where('vreg_inquiry != 0');
               } else if ($type == 'nw') {
                    $this->db->where('vreg_inquiry = 0');
               }

               if ($dept > 0) {
                    $this->db->where('vreg_department', $dept);
               }
               if ($type > 0) {
                    $this->db->where('vreg_call_type', $type);
               }
               if ($mode > 0) {
                    $this->db->where('vreg_contact_mode', $mode);
               }

               if ($vregDivision > 0) {
                    $this->db->where('vreg_division', $vregDivision);
               }
               if ($vregShowroom > 0) {
                    $this->db->where('vreg_showroom', $vregShowroom);
               }

               if (!empty($search)) {
                    $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
                    $this->db->where($whereSearch);
               }
               if ($brd > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_brand", $brd);
               }
               if ($mod > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_model", $mod);
               }
               if ($var > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_varient", $var);
               }
          }
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'EV' || $this->usr_grp == 'TL') {
               $this->db->where('vreg_is_punched = 0');
          }
          if (!empty($enq_date_from) && !empty($enq_date_to)) {
               $this->db->where('(DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') >= DATE(' . "'" . $enq_date_from . "'" . ') AND ' .
                    'DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') <= DATE(' . "'" . $enq_date_to . "'" . ') )');
          }
          if ($effective == '0' || $effective == '1') {
               $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
          }
          $this->db->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'left');
          $this->db->where('(' . $this->tbl_enquiry . '.enq_current_status IN (' . $enqExclude . ') OR ' . $this->tbl_enquiry . '.enq_current_status IS NULL)');
          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          $return['count'] = $this->db->count_all_results($this->tbl_register_master);

          $selectArray = array(
               $this->tbl_register_master . '.*',
               'assign.usr_first_name AS assign_usr_first_name',
               'assign.usr_last_name AS assign_usr_last_name',
               'addedby.usr_first_name AS addedby_usr_first_name',
               'addedby.usr_last_name AS addedby_usr_last_name',
               'exstse.usr_username AS exstse_usr_username',
               $this->tbl_events . '.evnt_title',
               $this->tbl_brand . '.brd_id', $this->tbl_brand . '.brd_title',
               $this->tbl_model . '.mod_id', $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_id', $this->tbl_variant . '.var_variant_name',
               $this->tbl_enquiry . '.enq_current_status',
               $this->tbl_callcenterbridging . '.ccb_recording_URL',
               $this->tbl_callcenterbridging . '.ccb_callStatus_id',
               $this->tbl_departments . '.dep_name', $this->tbl_district_statewise . '.*'
          );
          $this->db->select($selectArray, false)
               ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
               ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
               ->join($this->tbl_events, $this->tbl_events . '.evnt_id = ' . $this->tbl_register_master . '.vreg_event', 'LEFT')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_register_master . '.vreg_brand', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_register_master . '.vreg_model', 'left')
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'left')
               ->join($this->tbl_users . ' exstse', $this->tbl_enquiry . '.enq_se_id = ' . 'exstse.usr_id', 'left')
               ->join($this->tbl_callcenterbridging, $this->tbl_callcenterbridging . '.ccb_id = ' . $this->tbl_register_master . '.vreg_voxbay_ref', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_register_master . '.vreg_varient', 'left')
               ->join($this->tbl_departments, $this->tbl_departments . '.dep_id = ' . $this->tbl_register_master . '.vreg_department', 'left')
               ->join($this->tbl_district_statewise, $this->tbl_district_statewise . '.std_id = ' . $this->tbl_register_master . '.vreg_district', 'left');

          if (!empty($id)) {
               return $this->db->order_by($this->tbl_register_master . '.vreg_entry_date', 'DESC')
                    ->get_where($this->tbl_register_master, array($this->tbl_register_master . '.vreg_id' => $id))->row_array();
          }
          /* $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses); */
          if ($limit) {
               $this->db->limit($limit, $page);
          }
          if (($this->uid != ADMIN_ID) && empty($search)) {
               if (!check_permission($this->uid, $userAccess, 'registration', 'showallregisters')) {
                    $this->db->where(array('vreg_assigned_to' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'registration', 'registrationcreatedbyme')) {
                    $this->db->where(array('vreg_added_by' => $this->uid));
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregshowonlymyshowroom')) {
                    array_push($mystaffs, $this->uid);
                    $this->db->where('(' . $this->tbl_register_master . '.vreg_first_owner IN (' . implode(',', $mystaffs) . ') OR ' .
                         $this->tbl_register_master . '.vreg_assigned_to IN (' . implode(',', $mystaffs) . '))');
               }
               if (check_permission($this->uid, $userAccess, 'enquiry', 'myregistersmartpurchaseonly')) {
                    $this->db->where_in('vreg_department', array(7));
               }
          }
          if (!empty($filter)) {
               if ($vreg_assigned_to > 0) {
                    $this->db->where('vreg_assigned_to', $vreg_assigned_to);
               }
               if ($vreg_first_owner > 0) {
                    $this->db->where('vreg_first_owner', $vreg_first_owner);
               }
               $type = isset($filter['type']) ? $filter['type'] : '';
               if ($type == 'ex') {
                    $this->db->where('vreg_inquiry != 0');
               } else if ($type == 'nw') {
                    $this->db->where('vreg_inquiry = 0');
               }
               if ($dept > 0) {
                    $this->db->where('vreg_department', $dept);
               }
               if ($type > 0) {
                    $this->db->where('vreg_call_type', $type);
               }
               if ($mode > 0) {
                    $this->db->where('vreg_contact_mode', $mode);
               }
               if (!empty($search)) {
                    $whereSearch = '(' . $this->tbl_register_master . ".vreg_cust_name LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_phone LIKE '%" . $search . "%' OR " .
                         $this->tbl_register_master . ".vreg_cust_place LIKE '%" . $search . "%' )";
                    $this->db->where($whereSearch);
               }
               if ($brd > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_brand", $brd);
               }
               if ($mod > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_model", $mod);
               }
               if ($var > 0) {
                    $this->db->where($this->tbl_register_master . ".vreg_varient", $var);
               }
               if ($vregDivision > 0) {
                    $this->db->where('vreg_division', $vregDivision);
               }
               if ($vregShowroom > 0) {
                    $this->db->where('vreg_showroom', $vregShowroom);
               }
          }
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'EV' || $this->usr_grp == 'TL') {
               $this->db->where('vreg_is_punched = 0');
          }

          if (!empty($enq_date_from) && !empty($enq_date_to)) {
               $this->db->where('(DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') >= DATE(' . "'" . $enq_date_from . "'" . ') AND ' .
                    'DATE(' . $this->tbl_register_master . '.' . $addedEntry . ') <= DATE(' . "'" . $enq_date_to . "'" . '))');
          }
          if ($effective == '0' || $effective == '1') {
               $this->db->where($this->tbl_register_master . '.vreg_is_effective', $effective);
          }
          $this->db->order_by('vreg_entry_date', 'DESC');
          $this->db->where('(' . $this->tbl_enquiry . '.enq_current_status NOT IN (' . $enqExclude . ') OR ' .
               $this->tbl_enquiry . '.enq_current_status IS NULL)');

          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);

          $return['data'] = $this->db->get($this->tbl_register_master)->result_array();

          if (check_permission($this->uid, $userAccess, 'registration', 'caneditmyregister') || $this->usr_grp == 'AD') {
               $return['user_access']['update'] = 1;
          } else {
               $return['user_access']['update'] = 0;
          }
          $return['user_access']['delete'] = (check_permission($this->uid, $userAccess, 'registration', 'candelete')) ? 1 : 0;
          $return['user_access']['showassignto'] = (check_permission($this->uid, $userAccess, 'registration', 'showassignto')) ? 1 : 0;
          $return['user_access']['show_punch_popup'] = (check_permission($this->uid, $userAccess, 'registration', 'alloworeassign')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['reassign'] = (check_permission($this->uid, $userAccess, 'registration', 'reassigntosalesstaff')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['showreghistory'] = (check_permission($this->uid, $userAccess, 'registration', 'showreghistory')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['canpnchenqorfolup'] = (check_permission($this->uid, $userAccess, 'registration', 'canpnchenqorfolup')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['candoregfolup'] = (check_permission($this->uid, $userAccess, 'registration', 'candoregfolup')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['canretnregister'] = (check_permission($this->uid, $userAccess, 'registration', 'canretnregister')) ? 1 : 0; //And vreg_is_verified=1
          $return['user_access']['export_excel'] = (check_permission($this->uid, $userAccess, 'registration', 'export_excel')) ? 1 : 0;
          $return['user_access']['myregistercallanalysis'] = (check_permission($this->uid, $userAccess, 'registration', 'myregistercallanalysis')) ? 1 : 0; //if !empty($tc)

          return $return;
     }

     public function getData($id = '')
     {

          if (!empty($id)) {
               $this->db->where('dep_id', $id);
               return $this->db->get($this->tbl_departments)->row_array();
          }
          return $this->db->select($this->tbl_departments . '.*,' . $this->tbl_divisions . '.* , parentDep.dep_name AS dep_parent_name', false)
               ->join($this->tbl_divisions, $this->tbl_divisions . '.div_id = ' . $this->tbl_departments . '.dep_division', 'LEFT')
               ->join($this->tbl_departments . ' parentDep', 'parentDep.dep_id = ' . $this->tbl_departments . '.dep_parent', 'LEFT')
               ->where($this->tbl_departments . '.dep_status', 1)->get($this->tbl_departments)->result_array();
     }

     function teleCallersSalesStaffs()
     {
          return $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->where(array($this->tbl_groups . '.grp_slug' => 'TC', $this->tbl_groups . '.grp_slug' => 'SE'))->where(array($this->tbl_users . '.usr_active' => 1))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();
     }

     function staffCanAssignEnquires()
     {
          return $this->db->select(
               array(
                    $this->tbl_users . '.usr_id',
                    $this->tbl_users . '.usr_first_name',
                    $this->tbl_users . '.usr_last_name',
                    $this->tbl_users_groups . '.group_id as group_id',
                    $this->tbl_groups . '.name as group_name',
                    $this->tbl_groups . '.description as group_desc',
                    $this->tbl_showroom . '.*'
               )
          )
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_users_groups . '.group_id = ' . $this->tbl_groups . '.id')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->where(array($this->tbl_users . '.usr_active' => 1, $this->tbl_users . '.usr_can_auto_assign' => 1))
               ->order_by($this->tbl_users . '.usr_first_name')->get($this->tbl_users)->result_array();
     }

     function get_enquiryByMobile($phoneNo)
     { //renamed getEnquiryByMobile
          if (!empty($phoneNo)) {
               $cusMobile = substr(trim($phoneNo), -10);
               $whr = array($this->tbl_vehicle . '.veh_status' => 2, $this->tbl_vehicle . '.veh_type' => 0, $this->tbl_vehicle . '.veh_enq_type_old' => NULL);
               return $this->db->select($this->tbl_enquiry . '.*,' . $this->tbl_users . '.*,' . $this->tbl_vehicle . '.*,' . $this->tbl_register_master . '.*,' . $this->tbl_valuation . '.*,')
                    ->join($this->tbl_register_master, $this->tbl_register_master . '.vreg_inquiry = ' . $this->tbl_enquiry . '.enq_id', 'LEFT')
                    ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_enq_id = ' . $this->tbl_enquiry . '.enq_id', 'LEFT')
                    //   ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_vehicle . '.veh_enq_id', 'LEFT')
                    //->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_id = ' . $this->tbl_valuation . '.tbl_valuation', 'LEFT')
                    ->join($this->tbl_valuation, $this->tbl_valuation . '.val_vehicle_id = ' . $this->tbl_vehicle . '.veh_id', 'LEFT')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT')->where($whr)
                    ->like('enq_cus_mobile', $cusMobile, 'before')->get($this->tbl_enquiry)->row_array();
          }
          return false;
     }

     function getInsurers()
     {
          return $this->db->order_by('ins_insurer')->get($this->tbl_insurers)->result_array();
     }

     function getAllEvaluators()
     {
          return $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->where(array($this->tbl_groups . '.grp_slug' => 'EV'))->where(array($this->tbl_users . '.usr_active' => 1))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();
     }

     function getAllManagers()
     {
          return $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->where($this->tbl_groups . ".grp_slug = 'MG' OR " . $this->tbl_groups . ".grp_slug = 'TL'")
               ->where(array($this->tbl_users . '.usr_active' => 1))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();
     }

     function salesExecutivesOnly()
     {
          $userAccess = getUserAcess($this->uid);
          if ($this->usr_grp == 'TL') {
               $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)
                    ->get($this->tbl_users)->row()->usr_id);
          }
          $this->db->where('usr_id != ', $this->uid);
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_users . '.usr_showroom', $this->shrm);
          }

          // $this->userAccess = $this->common_model->getUser($this->uid);

          if (check_permission($this->uid, $userAccess, 'emp_details', 'showinnactivestaffs')) {
               $this->db->where($this->tbl_users . '.usr_active = 1 OR ' . $this->tbl_users . '.usr_active = 0');
          } else {
               $this->db->where($this->tbl_users . '.usr_active = 1');
          }
          if ($this->usr_grp == 'TL') {
               $this->db->select($this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_showroom,' . $this->tbl_users_groups . '.group_id,' . $this->tbl_groups . '.grp_slug')
                    ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
                    ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
                    ->where(array($this->tbl_users . '.usr_active' => 1, $this->tbl_groups . '.id' => GRP_SALES_OFFICER))
                    ->where_in($mystaffs);
               return $this->db->order_by($this->tbl_users . '.usr_first_name', 'ASC')->get($this->tbl_users)->result_array();
          } else {
               return $this->db->select($this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_id,' . $this->tbl_users . '.usr_showroom,' . $this->tbl_users_groups . '.group_id,' . $this->tbl_groups . '.grp_slug')
                    ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
                    ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
                    ->where(array($this->tbl_users . '.usr_active' => 1, $this->tbl_groups . '.id' => GRP_SALES_OFFICER))
                    ->order_by($this->tbl_users . '.usr_first_name', 'ASC')->get($this->tbl_users)->result_array();
          }
     }

     function getAllVehicleFeatures()
     {
          return $this->db->order_by('vftr_order', 'ASC')->get_where($this->tbl_vehicle_features, array('vftr_status' => 1, 'vftr_features_add_on' => 0))->result_array();
     }

     function getVehicleAddOnFeatures()
     {
          return $this->db->order_by('vftr_order', 'ASC')->get_where($this->tbl_vehicle_features, array('vftr_status' => 1, 'vftr_features_add_on' => 1))->result_array();
     }

     function getFullBodyCheckupMaster($oddOrEven = '')
     {


          if ($oddOrEven and $oddOrEven == 'odd') {
               $sql = "SELECT * FROM ( SELECT @row := @row +1 AS rownum,`vfbcm_order`,`vfbcm_id`,vfbcm_title,vfbcm_status FROM ( SELECT @row :=0) r, cpnl_valuation_ful_bd_chkup_master ) ranked WHERE rownum % 2 != 0 AND vfbcm_status=1 ORDER BY `vfbcm_order` asc";
               $query = $this->db->query($sql);
               $res = $query->result_array();
               return $res;
          } elseif ($oddOrEven and $oddOrEven == 'even') {
               $sql = "SELECT * FROM ( SELECT @row := @row +1 AS rownum,`vfbcm_order`,`vfbcm_id`,vfbcm_title,vfbcm_status FROM ( SELECT @row :=0) r, cpnl_valuation_ful_bd_chkup_master ) ranked WHERE rownum % 2 = 0 AND vfbcm_status=1 ORDER BY `vfbcm_order` asc";
               $query = $this->db->query($sql);
               $res = $query->result_array();
               return $res;
          } else {
               $qry = $this->db->order_by('vfbcm_order');
               $res = $qry->get_where($this->tbl_valuation_ful_bd_chkup_master, array('vfbcm_status' => 1))->result_array();
               return $res;
          }
     }

     function newEvaluation($data)
     {
          $k = get_logged_user_for_api('usr_showroom', $this->uid);
          //return $k;
          // exit;
          if (!empty($data)) {
               foreach ($data as $key => $value) {
                    if (empty($data[$key])) {
                         unset($data[$key]);
                    }
               }
               $data['val_added_by'] = $this->uid;
               $data['val_showroom'] = (isset($data['val_showroom']) && !empty($data['val_showroom'])) ?
                    $data['val_showroom'] : get_logged_user_for_api('usr_showroom', $this->uid);
               $insDate = $data['val_insurance_comp_date'];
               isset($data['val_delv_date']) ? $data['val_delv_date'] = date('Y-m-d', strtotime($data['val_delv_date'])) : '';
               isset($data['val_reg_date']) ? $data['val_reg_date'] = date('Y-m-d', strtotime($data['val_reg_date'])) : '';
               isset($data['val_insurance_validity']) ? $data['val_insurance_validity'] = date('Y-m-d', strtotime($data['val_insurance_validity'])) : '';
               isset($data['val_last_service']) ? $data['val_last_service'] = date('Y-m-d', strtotime($data['val_last_service'])) : '';
               isset($data['val_manf_date']) ? $data['val_manf_date'] = date('Y-m-d', strtotime($data['val_manf_date'])) : '';
               isset($data['val_valuation_date']) ? $data['val_valuation_date'] = date('Y-m-d', strtotime($data['val_valuation_date'])) : '';
               isset($data['val_hypo_loan_date']) ? $data['val_hypo_loan_date'] = date('Y-m-d', strtotime($data['val_hypo_loan_date'])) : '';
               isset($data['val_hypo_frclos_date']) ? $data['val_hypo_frclos_date'] = date('Y-m-d', strtotime($data['val_hypo_frclos_date'])) : '';
               isset($data['val_hypo_loan_end_date']) ? $data['val_hypo_loan_end_date'] = date('Y-m-d', strtotime($data['val_hypo_loan_end_date'])) : '';
               isset($data['val_insurance_comp_date']) ? $data['val_insurance_comp_date'] = date('Y-m-d', strtotime($data['val_insurance_comp_date'])) : '';
               isset($data['val_insurance_ll_date']) ? $data['val_insurance_ll_date'] = date('Y-m-d', strtotime($data['val_insurance_ll_date'])) : '';
               isset($data['val_ex_wrnty_validity']) ? $data['val_ex_wrnty_validity'] = date('Y-m-d', strtotime($data['val_ex_wrnty_validity'])) : '';
               isset($data['val_wrnty_nxt_ser_date']) ? $data['val_wrnty_nxt_ser_date'] = date('Y-m-d', strtotime($data['val_wrnty_nxt_ser_date'])) : '';

               $data['val_veh_no'] = strtoupper($data['val_prt_1'] . '-' . $data['val_prt_2'] . '-' . $data['val_prt_3'] . '-' . $data['val_prt_4']);
               $data['val_top_up_loan'] = isset($data['val_top_up_loan']) ? 1 : 0;
               $data['val_battery_warranty'] = isset($data['val_battery_warranty']) ? 1 : 0;
               $data['val_status'] = 12;
               $this->db->insert($this->tbl_valuation, $data);
               $id = $this->db->insert_id();

               generate_log(array(
                    'log_title' => 'New Evaluation',
                    'log_desc' => 'New evaluation ',
                    'log_controller' => strtolower(__CLASS__),
                    'log_action' => 'C',
                    'log_ref_id' => $id,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));

               //Add dummy product
               $product = array(
                    'prd_valuation_id' => $id,
                    'prd_number' => gen_random(),
                    'prd_regno_prt_1' => strtoupper($data['val_prt_1']),
                    'prd_regno_prt_2' => $data['val_prt_2'],
                    'prd_regno_prt_3' => strtoupper($data['val_prt_3']),
                    'prd_regno_prt_4' => $data['val_prt_4'],
                    'prd_km_run' => $data['val_km'],
                    'prd_variant' => $data['val_variant'],
                    'prd_model' => $data['val_model'],
                    'prd_brand' => $data['val_brand'],
                    'prd_insurance_validity' => $insDate,
                    'prd_insurance_idv' => $data['val_insurance_comp_idv'],
                    'prd_fual' => $data['val_fuel'],
                    'prd_year' => $data['val_model_year'],
                    'prd_color' => $data['val_color'],
                    'prd_owner' => $data['val_no_of_owner'],
                    'prd_engine_cc' => $data['val_eng_cc'],
                    'prd_date' => date('Y-m-d:H:i:s'),
                    'prd_status' => 0,
               );
               $this->db->insert($this->tbl_products, $product);
               //Add dummy product
               return $id;
          } else {
               generate_log(array(
                    'log_title' => 'New Evaluation',
                    'log_desc' => 'Error while add new evaluation ',
                    'log_controller' => strtolower(__CLASS__),
                    'log_action' => 'C',
                    'log_ref_id' => 0,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid
               ));
               return false;
          }
     }

     function newEvaluationComplaints($data)
     {
          if (!empty($data)) {
               $this->db->insert($this->tbl_valuation_complaint, $data);
               return true;
          } else {
               return false;
          }
     }

     function newEvaluationDocument($data)
     {
          if (!empty($data)) {
               $this->db->insert($this->tbl_valuation_documents, $data);
               return true;
          } else {
               return false;
          }
     }

     function newFeatures($data)
     {
          if (!empty($data)) {
               $this->db->insert($this->tbl_valuation_features, $data);
               return true;
          }
          return false;
     }

     function fullBodyCheckup($data)
     {
          if (!empty($data)) {
               $this->db->insert($this->tbl_valuation_ful_bd_chkup, $data);
               return true;
          }
          return false;
     }

     function upgradeDetails($data, $evId)
     {
          if (!empty($data)) {
               $count = count($data['upgrd_key']);
               for ($i = 0; $i < $count; $i++) {
                    $upgrKey = isset($data['upgrd_key'][$i]) ? $data['upgrd_key'][$i] : 0;
                    $upgrVal = isset($data['upgrd_value'][$i]) ? $data['upgrd_value'][$i] : 0;
                    $this->db->insert($this->tbl_valuation_upgrade_details, array(
                         'upgrd_master_id' => $evId, 'upgrd_key' => $upgrKey, 'upgrd_value' => $upgrVal
                    ));
               }
          }
     }

     function uploadEvaluationVehicleImages($data)
     {
          if (!empty($data)) {
               $this->db->insert($this->tbl_valuation_veh_images, $data);
               return true;
          }
          return false;
     }

     function reqToDropRegister($data)
     {
          $regDetails = $this->db->get_where($this->tbl_register_master, array('vreg_id' => $data['regMaster']))->row_array();
          if (!empty($regDetails)) {
               $comment = isset($data['reason']) ? $data['reason'] : '';
               $status = isset($data['status']) ? $data['status'] : '';
               $this->db->where('vreg_id', $data['regMaster'])->update($this->tbl_register_master, array(
                    'vreg_status' => $status
               ));
               $username = $this->session->userdata('usr_username');
               //h -> H added on 03-12-2020 06:00 AM
               $this->db->insert($this->tbl_register_history, array(
                    'regh_phone_num' => $regDetails['vreg_cust_phone'],
                    'regh_register_master' => $data['regMaster'],
                    'regh_assigned_by' => $regDetails['vreg_added_by'],
                    'regh_assigned_to' => $regDetails['vreg_assigned_to'],
                    'regh_added_date' => date('Y-m-d H:i:s'),
                    'regh_added_by' => $this->uid,
                    'regh_remarks' => $comment,
                    'regh_system_cmd' => 'Requested to drop this register by ' . $username . ' on ' . date('j M Y h:i A'),
                    'regh_status' => $status
               ));
          }
          $alldetails['reqDrop'] = $data;
          $alldetails['register'] = $regDetails;
          generate_log(array(
               'log_title' => 'Request for drop register',
               'log_desc' => serialize($alldetails),
               'log_controller' => 'reg-req-drop',
               'log_action' => 'U',
               'log_ref_id' => $data['regMaster'],
               'log_web_or_mob' => '2',
               'log_added_by' => $this->uid
          ));
          return true;
     }

     function setRegisterFollowup($data)
     {
          $follData = $data['regfoll'];
          if (!empty($follData['regf_next_folowup'])) {
               $datetime = explode(' ', $follData['regf_next_folowup']);
               $originalDateTime = $follData['regf_next_folowup'];
               $times = explode(':', $datetime[1]);
               $times = $times[0] . ':' . $times[1] . ' ' . $times[2];
               $date = isset($datetime[0]) ? date('Y-m-d', strtotime($datetime[0])) : '';
               $time = isset($datetime[1]) ? date('H:i', strtotime($times)) : '';
               $follData['regf_next_folowup'] = $date . ' ' . $time;
               $this->db->insert($this->tbl_register_followup, $follData);
               //not reach, line buzy, 

               $follCount = $this->db->select('vreg_next_followup_cont')->get_where($this->tbl_register_master, array('vreg_id' => $follData['regf_reg_id']))->row()->vreg_next_followup_cont + 1;

               $this->db->where(array('vreg_id' => $follData['regf_reg_id']))
                    ->update($this->tbl_register_master, array(
                         'vreg_next_followup' => $follData['regf_next_folowup'],
                         'vreg_next_followup_cont' => $follCount
                    ));

               $this->addRegisterHistory(
                    array(
                         'regh_register_master' => $follData['regf_reg_id'],
                         'regh_assigned_by' => $data['vreg_added_by'],
                         'regh_assigned_to' => $data['vreg_assigned_to'],
                         'regh_remarks' => $follData['regf_desc'],
                         'regh_call_type' => $follData['regf_reson'],
                         'regh_system_cmd' => 'Followup register as on ' . $originalDateTime
                    )
               );

               return true;
          }
     }

     function regFollowups($regId)
     {
          return $this->db->select($this->tbl_register_followup . '.*,' . $this->tbl_users . '.usr_username')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_register_followup . '.regf_added_by', 'LEFT')
               ->order_by($this->tbl_register_followup . '.regf_next_folowup', 'DESC')
               ->get_where($this->tbl_register_followup, array($this->tbl_register_followup . '.regf_reg_id' => $regId))->result_array();
     }
     function bindAllRdStaffs()
     {
          $userAccess = getUserAcess($this->uid);
          //fetch All RD staffs For Referance 
          if (check_permission($this->uid, $userAccess, 'registration', 'canselfassignregister')) { //usr_phone
               $this->db->where('usr_id != ', $this->uid);
          }
          $salesStaff = $this->db->select($this->tbl_users . '.usr_id AS col_id, ' . $this->tbl_users . '.usr_first_name AS col_title, ' . $this->tbl_users . '.usr_phone AS satff_phone, '
               . $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location,' . $this->tbl_users . '.usr_active')
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               //->where('(' . $this->tbl_groups . ".grp_slug = 'SE' OR " . $this->tbl_groups . ".grp_slug = 'DE' OR " . $this->tbl_groups . ".grp_slug = 'TL')")
               ->where(array($this->tbl_users . '.usr_active' => 1))
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->get($this->tbl_users)->result_array();

          // if (check_permission('registration', 'canselfassignregister')) {
          $myself = $this->db->select($this->tbl_users . ".usr_id AS col_id, 'Self' AS col_title, " . $this->tbl_users . '.usr_phone AS satff_phone, ' .
               $this->tbl_users_groups . '.*,' . $this->tbl_groups . '.*,' . $this->tbl_showroom . '.shr_location,' . $this->tbl_users . '.usr_active', false)
               ->join($this->tbl_users_groups, $this->tbl_users_groups . '.user_id = ' . $this->tbl_users . '.usr_id')
               ->join($this->tbl_groups, $this->tbl_groups . '.id = ' . $this->tbl_users_groups . '.group_id')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
               ->where(array($this->tbl_users . '.usr_id' => $this->uid))->get($this->tbl_users)->result_array();

          array_splice($salesStaff, 0, 0, $myself); //Insert new item in array on any position;
          //  }
          //   debug($salesStaff);
          return $salesStaff;
     }
     function regPendingCount($uid = 0)
     {
          /*  $selectArray = array(
                $this->tbl_register_master . '.vreg_cust_name',
                $this->tbl_register_master . '.vreg_cust_place',
                $this->tbl_register_master . '.vreg_cust_phone',
                $this->tbl_register_master . '.vreg_customer_remark',
                $this->tbl_register_master . '.vreg_last_action',
                $this->tbl_register_master . '.vreg_added_by',
                $this->tbl_register_master . '.vreg_assigned_to',
                $this->tbl_register_master . '.vreg_inquiry',
                $this->tbl_register_master . '.vreg_id',
                $this->tbl_register_master . '.vreg_added_on',
                'assign.usr_first_name AS assign_usr_first_name',
                'assign.usr_last_name AS assign_usr_last_name',
                'addedby.usr_first_name AS addedby_usr_first_name',
                'addedby.usr_last_name AS addedby_usr_last_name',
                $this->tbl_enquiry . '.enq_current_status'
          );*/
          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          /* $return = $this->db->select($selectArray, false)
                            ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
                            ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
                            ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'LEFT')*/
          $return = $this->db->where('vreg_assigned_to', $uid)->where('(vreg_is_punched = 0 OR vreg_inquiry = 0)')
               /*                           ->where('MONTH(' . $this->tbl_register_master . '.vreg_added_on) = MONTH(CURRENT_DATE())')
                      ->where_in($this->tbl_enquiry . '.enq_current_status', $this->myEnqStatuses) */
               ->count_all_results($this->tbl_register_master);
          return $return;
     }
     public function updateRegistration($datas)
     {
          date_default_timezone_set("Asia/Calcutta");
          $id = $datas['vreg_id'];
          unset($datas['vreg_id']);
          $datas['vreg_is_effective'] = (isset($datas['vreg_is_effective']) && !empty($datas['vreg_is_effective'])) ? $datas['vreg_is_effective'] : 0;
          $oldAssign = isset($datas['vreg_assigned_to_old']) ? $datas['vreg_assigned_to_old'] : 0;
          unset($datas['vreg_assigned_to_old']);
          if (!empty($oldAssign) && isset($datas['vreg_assigned_to'])) {
               if ($oldAssign != $datas['vreg_assigned_to']) { //Assigned to changed
                    $assignedBy = $this->user_name;
                    $assignedTo = $this->db->select('usr_username')->get_where($this->tbl_users, array('usr_id' => $datas['vreg_assigned_to']))->row_array();
                    $assignedTo = isset($assignedTo['usr_username']) ? $assignedTo['usr_username'] : '';

                    $this->addRegisterHistory(
                         array(
                              'regh_register_master' => $id,
                              'regh_assigned_by' => $this->uid,
                              'regh_assigned_to' => $datas['vreg_assigned_to'],
                              'regh_remarks' => $datas['vreg_customer_remark'],
                              'regh_call_type' => $datas['vreg_call_type'],
                              'regh_system_cmd' => 'Register reassigned by ' . $assignedBy . ' to ' . $assignedTo
                         )
                    );
                    $this->db->where(array('vreg_id' => $_POST['regMaster']))->update($this->tbl_register_master, array(
                         'vreg_last_action' => $_POST['reason'], 'vreg_call_type' => $_POST['call_type'],
                         'vreg_assigned_to' => $_POST['assignedTo'], 'vreg_added_by' => $this->uid
                    ));
               }
          }

          $datas['vreg_event'] = ($datas['vreg_contact_mode'] == 5) ? $datas['vreg_event'] : 0;
          $datas['vreg_entry_date'] = (isset($datas['vreg_entry_date']) && !empty($datas['vreg_entry_date'])) ?
               date('Y-m-d', strtotime($datas['vreg_entry_date'])) : null;

          /* change 13-10-2020 */
          $datas['vreg_brand'] = isset($datas['vreg_brand']) ? $datas['vreg_brand'] : 0;
          $datas['vreg_model'] = isset($datas['vreg_model']) ? $datas['vreg_model'] : 0;
          $datas['vreg_varient'] = isset($datas['vreg_varient']) ? $datas['vreg_varient'] : 0;
          $datas['vreg_assigned_to'] = isset($datas['vreg_assigned_to']) ? $datas['vreg_assigned_to'] : 0;
          $datas['vreg_department'] = (isset($datas['vreg_department']) && !empty($datas['vreg_department'])) ? $datas['vreg_department'] : 0;
          $datas['vreg_added_by'] = $this->uid;
          /* change 13-10-2020 */

          $this->db->where('vreg_id', $id);
          if ($this->db->update($this->tbl_register_master, $datas)) {
               generate_log(array(
                    'log_title' => 'Updated vehicle register',
                    'log_desc' => 'Updated vehicle register  ',
                    'log_controller' => strtolower(__CLASS__),
                    'log_action' => 'U',
                    'log_ref_id' => $id,
                    'log_web_or_mob' => '2',
                    'log_added_by' => $this->uid,
               ));
               return true;
          } else {
               return false;
          }
     }
     function getModeOfContact()
     {
          return $this->db->select('cmd_mod_id, cmd_title,cmd_category')->where('cmd_category', 1)->or_where('cmd_category', 2)->order_by('cmd_category', 'asc')->order_by('cmd_order', 'asc')->get($this->tbl_contact_mode)->result_array();
     }
     ///@new////

     ////03-10-2022
     function getDepartmentByDivision($division)
     {

          $selectArray = array(
               $this->tbl_departments . '.dep_id',
               $this->tbl_departments . '.dep_name',
               $this->tbl_departments . '.dep_is_sale_rel',
               'parentDep.dep_name AS dep_parent_name'
          );

          return $this->db->select($selectArray, false)->join($this->tbl_departments . ' parentDep', 'parentDep.dep_id = ' . $this->tbl_departments . '.dep_parent', 'LEFT')
               ->where(array($this->tbl_departments . '.dep_status' => 1, $this->tbl_departments . '.dep_division' => $division))
               ->get($this->tbl_departments)->result_array();
     }
     function getShowRoomByDivision($division)
     {
          return $this->db->get_where($this->tbl_showroom, array('shr_division' => $division, 'shr_status' => 1))->result_array();
     }
     function getDivisionName($division)
     {
        
          $data=$this->db->where('div_id',$division)->get($this->tbl_divisions)->row_array();
          return $data['div_name'];
     }
     function getShowRoomName($division)
     {
        
         $data=$this->db->get_where($this->tbl_showroom, array('shr_id' => $division, 'shr_status' => 1))->row_array();
          return $data['shr_location'];
     }
     function getDepartmentName($id)
     {
        
         $data=$this->db->get_where($this->tbl_departments, array('dep_id' => $id))->row_array();
          return $data['dep_name'];
     }
      function readEvent() {
          $id = !isset($_GET['id']) ? 0 : $_GET['id'];
          if (!empty($id)) {
               return $this->db->get_where($this->tbl_events, array('evnt_id' => $id))->row_array();
          }
          return $this->db->order_by('evnt_date', 'DESC')->get($this->tbl_events)->result_array();
     } 
     

     ////
}
