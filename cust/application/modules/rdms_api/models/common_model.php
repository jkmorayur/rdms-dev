<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class Common_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->tbl_users = TABLE_PREFIX_PORTAL . 'users';
          $this->tbl_groups = TABLE_PREFIX_PORTAL . 'groups';
          $this->tbl_vehicle = TABLE_PREFIX_PORTAL . 'vehicle';
          $this->tbl_enquiry = TABLE_PREFIX_PORTAL . 'enquiry';
          $this->tbl_model = TABLE_PREFIX . 'model';
          $this->tbl_brand = TABLE_PREFIX . 'brand';
          $this->tbl_showroom = TABLE_PREFIX_PORTAL . 'showroom';
          $this->tbl_statuses = TABLE_PREFIX_PORTAL . 'statuses';
          $this->tbl_followup = TABLE_PREFIX_PORTAL . 'followup';
          $this->tbl_km_ranges = TABLE_PREFIX_PORTAL . 'km_ranges';
          $this->tbl_divisions = TABLE_PREFIX_PORTAL . 'divisions';
          $this->tbl_valuation = TABLE_PREFIX_PORTAL . 'valuation';
          $this->tbl_variant = TABLE_PREFIX . 'variant';
          $this->tbl_dar_master = TABLE_PREFIX_PORTAL . 'dar_master';
          $this->tbl_general_log = TABLE_PREFIX_PORTAL . 'general_log';
          $this->tbl_user_access = TABLE_PREFIX_PORTAL . 'user_access';
          $this->tbl_users_groups = TABLE_PREFIX_PORTAL . 'users_groups';
          $this->tbl_contact_mode = TABLE_PREFIX_PORTAL . 'contact_mode';
          $this->tbl_vehicle_status = TABLE_PREFIX_PORTAL . 'vehicle_status';
          $this->tbl_customer_grade = TABLE_PREFIX_PORTAL . 'customer_grade';
          $this->tbl_register_master = TABLE_PREFIX_PORTAL . 'register_master';
          $this->tbl_vehicle_booking_master = TABLE_PREFIX_PORTAL . 'vehicle_booking_master';
          $this->view_vehicle_vehicle_status = TABLE_PREFIX_PORTAL . 'view_vehicle_vehicle_status';
          $this->view_enquiry_vehicle_master = TABLE_PREFIX_PORTAL . 'view_enquiry_vehicle_master';
          $this->tbl_vehicle_booking_confirmations = TABLE_PREFIX_PORTAL . 'vehicle_booking_confirmations';
          $this->tbl_price_range = TABLE_PREFIX_PORTAL . 'price_range';
          $this->tbl_vehicle_colors = TABLE_PREFIX_PORTAL . 'vehicle_colors';
     }

     public function getUser($id = null, $excludeAdminUser = false)
     {

          $this->db->select($this->tbl_users . '.*');
          if ($excludeAdminUser) {
               $this->db->where("usr_id !=", 1);
          }

          if ($id) {
               $this->db->where('usr_id', $id);
               $user = $this->db->get($this->tbl_users)->row_array();
          } else {
               $user = $this->db->get($this->tbl_users)->result_array();
          }
          $permission = $this->db->select(array($this->tbl_users_groups . '.*', $this->tbl_user_access . '.*'))
               ->join($this->tbl_user_access, $this->tbl_user_access . '.cua_user_id = ' . $this->tbl_users_groups . '.user_id', 'left')
               ->where($this->tbl_users_groups . '.user_id', $id)->get($this->tbl_users_groups)->row_array();
          return array_merge($user, $permission);
     }
     public function getUserloginData($id = null)
     { //jsk
          if ($id) {
               $this->db->select('usr_division');
               $this->db->where('usr_id', $id);
               $user = $this->db->get($this->tbl_users)->row_array();
               return $user;
          }
          return 0;
     }

     public function generateLog($data, $table)
     {
          //  debug($data,1);
          $this->load->library('user_agent');
          if (!empty($data)) {
               $data['log_user_agent'] = $this->agent->agent;
               $this->db->insert(TABLE_PREFIX_PORTAL . $table, $data);
               return true;
          } else {
               return false;
          }
     }

     function todaysFollowups()
     {
          if ($this->uid > 0) {
               if ($this->usr_grp == 'SE') {
                    $this->db->where($this->tbl_enquiry . '.enq_se_id = ' . $this->uid);
               } else if ($this->usr_grp == 'TC') {
                    $this->db->where($this->tbl_followup . '.foll_updated_by = ' . $this->uid);
               }
               $selectArray = array(
                    $this->tbl_followup . '.foll_id', $this->tbl_followup . '.foll_next_foll_date',
                    $this->tbl_followup . '.foll_next_foll_date', $this->tbl_followup . '.foll_customer_feedback',
                    $this->tbl_vehicle . '.veh_id', $this->tbl_vehicle . '.veh_brand', $this->tbl_vehicle . '.veh_model',
                    $this->tbl_vehicle . '.veh_varient', $this->tbl_vehicle . '.veh_status', $this->tbl_enquiry . '.enq_cus_name',
                    $this->tbl_enquiry . '.enq_id', $this->tbl_brand . '.brd_title', $this->tbl_model . '.mod_title',
                    $this->tbl_variant . '.var_variant_name'
               );
               return $this->db->select($selectArray)
                    ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_followup . '.foll_cus_id', 'LEFT')
                    ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_id = ' . $this->tbl_followup . '.foll_cus_vehicle_id', 'LEFT')
                    ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_vehicle . '.veh_brand', 'LEFT')
                    ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_vehicle . '.veh_model', 'LEFT')
                    ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_vehicle . '.veh_varient', 'LEFT')
                    ->where('(DATE(' . $this->tbl_followup . '.foll_next_foll_date) = CURDATE() OR DATE(' . $this->tbl_followup . ".foll_next_foll_date) = DATE_ADD(CURDATE(), INTERVAL +1 DAY)) AND " . $this->tbl_followup . ".foll_customer_feedback IS NULL")
                    ->get($this->tbl_followup)->result_array();
          }
     }

     /* function todaysFollowups() {
       if ($this->uid > 0) {
       if ($this->usr_grp == 'SE' || $this->usr_grp == 'TC') {
       $this->db->where($this->tbl_enquiry . '.enq_se_id = ' . $this->uid);
       }
       $selectArray = array(
       $this->tbl_followup . '.foll_id',
       $this->tbl_followup . '.foll_next_foll_date',
       $this->tbl_followup . '.foll_next_foll_date',
       $this->tbl_followup . '.foll_customer_feedback',
       $this->view_vehicle_vehicle_status . '.veh_id',
       $this->view_vehicle_vehicle_status . '.veh_status',
       $this->view_vehicle_vehicle_status . '.brd_title',
       $this->view_vehicle_vehicle_status . '.mod_title',
       $this->view_vehicle_vehicle_status . '.var_variant_name',
       $this->view_vehicle_vehicle_status . '.vst_all_statuses',
       $this->tbl_enquiry . '.enq_cus_name',
       $this->tbl_enquiry . '.enq_id'
       );
       return $this->db->select($selectArray)->join($this->view_vehicle_vehicle_status, $this->view_vehicle_vehicle_status . '.veh_id = ' . $this->tbl_followup . '.foll_cus_vehicle_id', 'LEFT')
       ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_followup . '.foll_cus_id', 'LEFT')
       ->where($this->view_vehicle_vehicle_status . '.vst_all_statuses IS NULL AND ' .
       '(DATE(' . $this->tbl_followup . '.foll_next_foll_date) = CURDATE() OR DATE(' . $this->tbl_followup . ".foll_next_foll_date) = DATE_ADD(CURDATE(), INTERVAL +1 DAY)) AND " . $this->tbl_followup . ".foll_customer_feedback IS NULL")
       ->get($this->tbl_followup)->result_array();
       }
       } */

     function analytics()
     {
          //Sale requist
          $userId = $this->session->userdata('usr_user_id');
          $user = $this->getUser($userId);
          $showroom = isset($user['usr_showroom']) ? $user['usr_showroom'] : 0;

          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id', $userId);
          }
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }

          $this->db->where($this->tbl_enquiry . '.enq_current_status', 6);
          $data['count_sale_req'] = $this->db->select("COUNT(*) AS enq_total")->get($this->tbl_enquiry)->row()->enq_total;

          //Drop requist
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id', $userId);
          }
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }

          $this->db->where($this->tbl_enquiry . '.enq_current_status', 2);
          $data['count_drop_req'] = $this->db->select("COUNT(*) AS enq_total")->get($this->tbl_enquiry)->row()->enq_total;

          //Delete requist
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id', $userId);
          }
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }

          $this->db->where($this->tbl_enquiry . '.enq_current_status', 8);
          $data['count_delete_req'] = $this->db->select("COUNT(*) AS enq_total")->get($this->tbl_enquiry)->row()->enq_total;

          //Loss requist
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id', $userId);
          }
          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }

          $this->db->where($this->tbl_enquiry . '.enq_current_status', 4);
          $data['count_loss_req'] = $this->db->select("COUNT(*) AS enq_total")->get($this->tbl_enquiry)->row()->enq_total;

          //Running followup count
          /* $this->db->where($this->tbl_enquiry . '.enq_delete != 99 AND ' . $this->tbl_enquiry . '.enq_current_status != 9 ');
            if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
            $this->db->where($this->tbl_enquiry . '.enq_se_id = ' . $this->uid);
            }

            if ($this->usr_grp == 'MG') {
            $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
            }

            $data['count_running_followup'] = $this->db->select($this->tbl_followup . '.*,' . $this->view_vehicle_vehicle_status . '.*,' . $this->tbl_enquiry . '.*,' .
            $this->tbl_users . '.*')
            ->join($this->view_vehicle_vehicle_status, $this->view_vehicle_vehicle_status .
            '.veh_id = ' . $this->tbl_followup . '.foll_cus_vehicle_id', 'LEFT')
            ->join($this->tbl_enquiry, $this->tbl_enquiry .
            '.enq_id = ' . $this->tbl_followup . '.foll_cus_id', 'LEFT')
            ->join($this->tbl_users, $this->tbl_users .
            '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT')
            ->where($this->view_vehicle_vehicle_status . '.vst_all_statuses IS NULL AND ' .
            '((DATEDIFF(DATE(' . $this->tbl_followup . '.foll_next_foll_date), CURDATE()) >= 0 AND
            DATEDIFF(DATE(' . $this->tbl_followup . '.foll_next_foll_date), CURDATE()) <= 10) OR
            (DATEDIFF(DATE(' . $this->tbl_followup . '.foll_next_foll_date), CURDATE()) = -2)) ' .
            " AND (" . $this->tbl_followup . ".foll_customer_feedback IS NULL OR " . $this->tbl_followup . ".foll_customer_feedback = '')")
            ->order_by($this->tbl_followup . '.foll_next_foll_date ASC')
            ->get($this->tbl_followup)->num_rows(); */

          //Missed followup count
          $this->db->where('(' . $this->tbl_enquiry . '.enq_current_status IS NULL OR ' . $this->tbl_enquiry . '.enq_current_status = 1)');
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id = ' . $this->uid);
          }

          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }
          $this->db->where('(DATEDIFF(DATE(' . $this->tbl_enquiry . '.enq_next_foll_date), ' . "DATE('" . date('Y-m-d') . "')" . ') <= -3)');
          $data['count_missed_followup'] = $this->db->select("COUNT(*) AS enq_total")->get($this->tbl_enquiry)->row()->enq_total;

          //Freezed enquires
          $this->db->where('enq_current_status', 9);
          if ($this->usr_grp == 'SE' || $this->usr_grp == 'TL') {
               $this->db->where($this->tbl_enquiry . '.enq_se_id = ' . $this->uid);
          }

          if ($this->usr_grp == 'MG') {
               $this->db->where($this->tbl_enquiry . '.enq_showroom_id = ' . $showroom);
          }
          $data['count_freezed_enquiry'] = $this->db->select('COUNT(*) AS freeze_count')->get($this->tbl_enquiry)->row()->freeze_count;

          //Pending evaluation
          $this->db->where('val_status', 0);
          $data['count_pending_evaluation'] = $this->db->select('COUNT(*) AS pending_evaluation')->get($this->tbl_valuation)->row()->pending_evaluation;

          //evaluated vehicles
          $this->db->where('val_status', 1);
          $data['count_evaluated_vehicle'] = $this->db->select('COUNT(*) AS pending_evaluation')->get($this->tbl_valuation)->row()->pending_evaluation;

          return $data;
     }

     function clearEnquiry()
     {
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'enquiry');
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'followup');
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'general_log');
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'vehicle');
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'vehicle_status');
          return true;
     }

     function cleanEvaluation()
     {
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'valuation');
          $this->db->truncate(TABLE_PREFIX_PORTAL . 'valuation_complaint');
     }

     function getStatuses($category)
     {
          return $this->db->where_in('sts_category', $category)->where(array('sts_status' => 1))
               ->order_by('sts_order')->like('sts_access', $this->usr_grp, 'BOTH')
               ->get($this->tbl_statuses)->result_array();
     }

     function getStatusById($stsid)
     {
          return $this->db->where(array('sts_id' => $stsid))->get($this->tbl_statuses)->row_array();
     }

     function recentEnquiry()
     {
          $this->db->query('SET SESSION group_concat_max_len = 1000000');
          $newlyAdded = $this->db->select('GROUP_CONCAT(log_ref_id) AS log_ref_id')
               ->where(array('log_action =' => 'R', 'log_controller' => 'enquiry_model', 'log_added_by' => $this->uid))
               ->get($this->tbl_general_log)->row()->log_ref_id;

          $this->db->select($this->tbl_enquiry . '.*,' . $this->tbl_users . '.*, tbl_added_by.usr_username AS enq_added_by_name')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'left')
               ->join($this->tbl_users . ' tbl_added_by', 'tbl_added_by.usr_id = ' . $this->tbl_enquiry . '.enq_added_by', 'left');
          return $this->db->order_by($this->tbl_enquiry . '.enq_id', 'DESC')
               ->where_not_in($this->tbl_enquiry . '.enq_id', explode(',', $newlyAdded))
               ->where($this->tbl_enquiry . '.enq_se_id', $this->uid)
               ->get($this->tbl_enquiry)->result_array();
     }

     function getContactModes($id = '')
     {
          if (!empty($id)) {
               return $this->db->get_where($this->tbl_contact_mode, array('cmd_id' => $id))->row_array();
          }
          return $this->db->get($this->tbl_contact_mode)->result_array();
     }

     function TLDARforApproval()
     {

          if (check_permission('dar', 'denaydarallbrnch', $this->userAccess)) {
               $this->db->where($this->tbl_showroom . '.shr_id', get_logged_user('usr_showroom'));
          }

          if ($this->usr_grp == 'TL') {
               $this->db->where('addedby.usr_tl', $this->uid);
               $this->db->where($this->tbl_dar_master . '.darm_is_verified_team_lead = 0');
               $this->db->select($this->tbl_dar_master . '.*, addedby.usr_username AS ab_usr_username, verifiedbytl.usr_username AS vb_usr_username,' .
                    $this->tbl_showroom . '.*, verifiedbymg.usr_username AS vb_usr_username_mg')
                    ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_dar_master . '.darm_added_by', 'LEFT')
                    ->join($this->tbl_users . ' verifiedbytl', 'verifiedbytl.usr_id = ' . $this->tbl_dar_master . '.darm_is_verified_team_lead', 'LEFT')
                    ->join($this->tbl_users . ' verifiedbymg', 'verifiedbymg.usr_id = ' . $this->tbl_dar_master . '.darm_is_verified_manager', 'LEFT')
                    ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_dar_master . '.darm_showroom', 'LEFT');
               $this->db->order_by($this->tbl_dar_master . '.darm_added_on', 'DESC');
               return $this->db->get($this->tbl_dar_master)->result_array();
          }
          if (is_roo_user() || $this->usr_grp == 'MG') {
               $this->db->where($this->tbl_dar_master . '.darm_is_verified_team_lead > 1 AND ' . $this->tbl_dar_master . '.darm_is_verified_manager = 0');
               $this->db->select($this->tbl_dar_master . '.*, addedby.usr_username AS ab_usr_username, verifiedbytl.usr_username AS vb_usr_username,' .
                    $this->tbl_showroom . '.*, verifiedbymg.usr_username AS vb_usr_username_mg')
                    ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_dar_master . '.darm_added_by', 'LEFT')
                    ->join($this->tbl_users . ' verifiedbytl', 'verifiedbytl.usr_id = ' . $this->tbl_dar_master . '.darm_is_verified_team_lead', 'LEFT')
                    ->join($this->tbl_users . ' verifiedbymg', 'verifiedbymg.usr_id = ' . $this->tbl_dar_master . '.darm_is_verified_manager', 'LEFT')
                    ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_dar_master . '.darm_showroom', 'LEFT');
               $this->db->order_by($this->tbl_dar_master . '.darm_added_on', 'DESC');
               return $this->db->get($this->tbl_dar_master)->result_array();
          }
     }

     /**
      * This is a general function to change status field of any table 
      * @param int $pkId <primary key id>
      * @param int $ischecked <current status 0/1>
      * @param string $table <table name which we want to edit>
      * @param int $statusFieldName <status field name in specified table>
      * @param string $whrFieldName <primary key field name>
      * @return boolean
      * Author : JK
      */
     function changeStatus($pkId, $ischecked, $table, $statusFieldName, $whrFieldName)
     {
          $this->db->where($whrFieldName, $pkId);
          if ($this->db->update(TABLE_PREFIX_PORTAL . $table, array($statusFieldName => $ischecked))) {
               return true;
          }
          return false;
     }

     /**
      * This is a general function to change status field of any table 
      * @param int $pkId <primary key id>
      * @param int $ischecked <current status 0/1>
      * @param string $table <table name which we want to edit>
      * @param int $statusFieldName <status field name in specified table>
      * @param string $whrFieldName <primary key field name>
      * @return boolean
      * Author : JK
      */
     function changeStatusRana($pkId, $ischecked, $table, $statusFieldName, $whrFieldName)
     {
          $this->db->where($whrFieldName, $pkId);
          if ($this->db->update(TABLE_PREFIX . $table, array($statusFieldName => $ischecked))) {
               return true;
          }
          return false;
     }

     function getEnquiresByStatus($status)
     {
          if (!empty($status)) {
               return $this->db->select($this->tbl_enquiry . '.*,' . $this->tbl_users . '.*')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT')
                    ->where('enq_current_status', $status)->get($this->tbl_enquiry)->result_array();
          }
          return false;
     }

     function pendingRegisterApproval()
     {
          $salesPurchaseEnq = array(4, 6, 7, 8);
          return $this->db->where('vreg_is_verified', 0)->where_in('vreg_department', $salesPurchaseEnq)
               ->get($this->tbl_register_master)->result_array();
     }

     function pendingCustGradeNotification()
     {

          $grades = $this->db->select('sgrd_id')->get_where($this->tbl_customer_grade, array('sgrd_need_verification' => 1))->result_array();
          $grades = array_column($grades, 'sgrd_id');
          $select = array(
               $this->tbl_enquiry . '.enq_cus_name',
               $this->tbl_enquiry . '.enq_id',
               $this->tbl_customer_grade . '.sgrd_id',
               $this->tbl_customer_grade . '.sgrd_grade'
          );
          return $this->db->select($select, false)->join($this->tbl_customer_grade, $this->tbl_enquiry . '.enq_customer_grade = ' . $this->tbl_customer_grade . '.sgrd_id', 'LEFT')
               ->where($this->tbl_enquiry . '.enq_customer_grade > 0 AND ' . $this->tbl_enquiry . '.enq_customer_grade_verify_by = 0')
               ->get($this->tbl_enquiry)->result_array();
     }

     function assignedEnquires()
     {
          if ($this->uid > 0) {
               $ArrSelect = array(
                    $this->tbl_enquiry . '.enq_cus_name',
                    $this->tbl_enquiry . '.enq_id',
                    $this->tbl_enquiry . '.enq_cus_mobile',
                    $this->tbl_users . '.usr_first_name',
                    $this->tbl_users . '.usr_last_name',
                    'tbl_added_by.usr_username AS enq_added_by_name'
               );

               return $this->db->select($ArrSelect)->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'left')
                    ->join($this->tbl_users . ' tbl_added_by', 'tbl_added_by.usr_id = ' . $this->tbl_enquiry . '.enq_added_by', 'left')
                    ->order_by($this->tbl_enquiry . '.enq_id', 'DESC')->where($this->tbl_enquiry . '.enq_se_id', $this->uid)
                    ->where($this->tbl_enquiry . '.enq_last_viewd != ' . $this->uid)->where($this->tbl_enquiry . '.enq_added_by != ', $this->uid)
                    ->get($this->tbl_enquiry)->result_array();
          }
     }

     function pendingRegisters()
     {
          $selectArray = array(
               $this->tbl_register_master . '.vreg_cust_name',
               $this->tbl_register_master . '.vreg_cust_place',
               $this->tbl_register_master . '.vreg_cust_phone',
               $this->tbl_register_master . '.vreg_customer_remark',
               $this->tbl_register_master . '.vreg_last_action',
               $this->tbl_register_master . '.vreg_added_by',
               $this->tbl_register_master . '.vreg_assigned_to',
               $this->tbl_register_master . '.vreg_inquiry',
               $this->tbl_register_master . '.vreg_id',
               'assign.usr_first_name AS assign_usr_first_name',
               'assign.usr_last_name AS assign_usr_last_name',
               'addedby.usr_first_name AS addedby_usr_first_name',
               'addedby.usr_last_name AS addedby_usr_last_name',
               $this->tbl_enquiry . '.enq_current_status'
          );
          $this->db->where_in($this->tbl_register_master . '.vreg_status', $this->myRegStatuses);
          $return['pendingRegisters'] = $this->db->select($selectArray, false)
               ->join($this->tbl_users . ' assign', 'assign.usr_id = ' . $this->tbl_register_master . '.vreg_assigned_to', 'LEFT')
               ->join($this->tbl_users . ' addedby', 'addedby.usr_id = ' . $this->tbl_register_master . '.vreg_added_by', 'LEFT')
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_register_master . '.vreg_inquiry', 'LEFT')
               ->where('vreg_assigned_to', $this->uid)->where('(vreg_is_punched = 0 OR vreg_inquiry = 0)')
               //                            ->where('MONTH(' . $this->tbl_register_master . '.vreg_added_on) =  MONTH(CURRENT_DATE())')
               ->where_in($this->tbl_enquiry . '.enq_current_status', $this->myEnqStatuses)->get($this->tbl_register_master)->result_array();
          return $return;
     }

     function getCustomeUserDetails($uid, $fields)
     {
          return $this->db->select($fields)->where('usr_id', $uid)->get($this->tbl_users)->row_array();
     }

     function todaysFollowup()
     {
          if ($this->uid != ADMIN_ID) {
               if (check_permission('notify_todayfollowup', 'showmyselffollowup')) {
                    $this->db->where($this->tbl_enquiry . '.enq_se_id', $this->uid);
               }
               if (check_permission('notify_todayfollowup', 'showmystaff')) {
                    $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
                         ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
                    $this->db->where_in($this->tbl_enquiry . '.enq_se_id', $mystaffs);
               }
               if (check_permission('notify_todayfollowup', 'showmyshowroom')) {
                    $this->db->where($this->tbl_enquiry . '.enq_showroom_id', $this->shrm);
               }

               if (check_permission('notify_todayfollowup', 'hothotpls')) {
                    $this->db->where_in($this->tbl_enquiry . '.enq_cus_when_buy', array(1, 2));
               }

               if (check_permission('notify_todayfollowup', 'hothotplswrm')) {
                    $this->db->where_in($this->tbl_enquiry . '.enq_cus_when_buy', array(1, 2, 3));
               }
          }
          $this->db->where('DATE(' . $this->tbl_enquiry . '.enq_next_foll_date)', date('Y-m-d'));
          if (strtoupper(date("D")) == 'MON') {
               $yesterday = date('Y-m-d', strtotime("-1 days"));
               $this->db->or_where('DATE(' . $this->tbl_enquiry . '.enq_next_foll_date)', $yesterday);
          }
          $ArrSelect = array(
               $this->tbl_enquiry . '.enq_cus_name',
               $this->tbl_enquiry . '.enq_id',
               $this->tbl_enquiry . '.enq_cus_mobile',
               $this->tbl_enquiry . '.enq_next_foll_date',
               $this->tbl_users . '.usr_first_name',
               $this->tbl_users . '.usr_last_name',
               'tbl_added_by.usr_username AS enq_added_by_name'
          );

          return $this->db->select($ArrSelect)->from($this->tbl_enquiry)->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'left')
               ->join($this->tbl_users . ' tbl_added_by', 'tbl_added_by.usr_id = ' . $this->tbl_enquiry . '.enq_added_by', 'left')->count_all_results();
     }

     function follUnreadMessage()
     {
          if ($this->uid != ADMIN_ID) {
               if (check_permission('folup_trck_comment_notify', 'foluptrckcommentnotify_mystaff')) {
                    $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
                         ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
                    $this->db->where_in($this->tbl_enquiry . '.enq_se_id', $mystaffs);
               }

               if (check_permission('folup_trck_comment_notify', 'foluptrckcommentnotify_myfollowup')) {
                    $this->db->where($this->tbl_enquiry . '.enq_se_id', $this->uid);
               }

               if (check_permission('folup_trck_comment_notify', 'foluptrckcommentnotify_myshowroom')) {
                    $this->db->where($this->tbl_enquiry . '.enq_showroom_id', $this->shrm);
               }
               $this->db->where('(' . $this->tbl_followup . '.foll_msg_read IS NULL || ' . $this->tbl_followup . '.foll_msg_read LIKE ' . "'%:" . $this->uid . ";%'" . ')');
          }
          return $this->db->select($this->tbl_followup . '.foll_id,' . $this->tbl_followup . '.foll_cus_id,' . $this->tbl_enquiry . '.enq_showroom_id, ' . $this->tbl_enquiry . '.enq_se_id')
               ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_followup . '.foll_cus_id', 'LEFT')
               ->where(array('foll_is_cmnt' => 1))->count_all_results($this->tbl_followup);
     }

     function outDatingInsurance()
     {
          //SELECT NOW(), val_insurance_comp_date, DATEDIFF(val_insurance_comp_date, NOW()) FROM `cpnl_valuation`
          $selectAray = array(
               'NOW()',
               'val_insurance_comp_date', 'DATEDIFF(val_insurance_comp_date, NOW()) AS diff_val_insurance_comp_date',
               'val_insurance_ll_date', 'DATEDIFF(val_insurance_ll_date, NOW()) AS diff_val_insurance_ll_date'
          );
          $return = $this->db->select($selectAray)->get($this->tbl_valuation)->result_array();
          debug($return);
     }

     function regiFollNotification()
     {

          if (check_permission('notification', 'myregallfollwup')) {
               $this->db->where_in($this->tbl_register_master . '.vreg_status', array(0, 1));
               return $this->db->select($this->tbl_register_master . '.vreg_cust_phone, ' . $this->tbl_register_master . '.vreg_cust_name,' .
                    $this->tbl_register_master . '.vreg_next_followup, ' . 'TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' .
                    $this->tbl_register_master . '.vreg_next_followup ' . ') AS dateDiff, ' . $this->tbl_register_master . '.vreg_id, ' .
                    $this->tbl_users . '.usr_first_name', false)
                    ->join($this->tbl_users, $this->tbl_register_master . '.vreg_added_by = ' . $this->tbl_users . '.usr_id', 'LEFT')
                    ->where($this->tbl_register_master . '.vreg_is_punched', 0)->where($this->tbl_register_master . '.vreg_next_followup IS NOT NULL')
                    ->where('(TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' . $this->tbl_register_master . '.vreg_next_followup ' . ')) <= 0')
                    ->get($this->tbl_register_master)->result_array();
          } else if (check_permission('notification', 'myregfollwup')) {
               $this->db->where_in($this->tbl_register_master . '.vreg_status', array(0, 1));
               return $this->db->select($this->tbl_register_master . '.vreg_cust_phone, ' . $this->tbl_register_master . '.vreg_cust_name,' .
                    $this->tbl_register_master . '.vreg_next_followup, ' . 'TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' .
                    $this->tbl_register_master . '.vreg_next_followup ' . ') AS dateDiff, ' . $this->tbl_register_master . '.vreg_id, ' .
                    $this->tbl_users . '.usr_first_name', false)
                    ->join($this->tbl_users, $this->tbl_register_master . '.vreg_added_by = ' . $this->tbl_users . '.usr_id', 'LEFT')
                    ->where($this->tbl_register_master . '.vreg_is_punched', 0)->where($this->tbl_register_master . '.vreg_next_followup IS NOT NULL')
                    ->where('(TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' . $this->tbl_register_master . '.vreg_next_followup ' . ')) <= 0')
                    ->where($this->tbl_register_master . '.vreg_assigned_to', $this->uid)->get($this->tbl_register_master)->result_array();
          } else if (check_permission('notification', 'mystaffregfollwup')) {
               $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
               array_push($mystaffs, $this->uid);
               $this->db->where_in($this->tbl_register_master . '.vreg_status', array(0, 1));
               return $this->db->select($this->tbl_register_master . '.vreg_cust_phone, ' . $this->tbl_register_master . '.vreg_cust_name,' .
                    $this->tbl_register_master . '.vreg_next_followup, ' . 'TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' .
                    $this->tbl_register_master . '.vreg_next_followup ' . ') AS dateDiff, ' . $this->tbl_register_master . '.vreg_id,' .
                    $this->tbl_users . '.usr_first_name', false)
                    ->join($this->tbl_users, $this->tbl_register_master . '.vreg_added_by = ' . $this->tbl_users . '.usr_id', 'LEFT')
                    ->where($this->tbl_register_master . '.vreg_is_punched', 0)->where($this->tbl_register_master . '.vreg_next_followup IS NOT NULL')
                    ->where('(TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' . $this->tbl_register_master . '.vreg_next_followup ' . ')) <= 0')
                    ->where_in($this->tbl_register_master . '.vreg_assigned_to', $mystaffs)->get($this->tbl_register_master)->result_array();
          } else if (check_permission('notification', 'myshowroomregfollwup')) {
               $this->db->where_in($this->tbl_register_master . '.vreg_status', array(0, 1));
               return $this->db->select($this->tbl_register_master . '.vreg_cust_phone, ' . $this->tbl_register_master . '.vreg_cust_name,' .
                    $this->tbl_register_master . '.vreg_next_followup, ' . 'TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' .
                    $this->tbl_register_master . '.vreg_next_followup ' . ') AS dateDiff, ' . $this->tbl_register_master . '.vreg_id,' .
                    $this->tbl_users . '.usr_first_name', false)
                    ->join($this->tbl_users, $this->tbl_register_master . '.vreg_added_by = ' . $this->tbl_users . '.usr_id', 'LEFT')
                    ->where($this->tbl_register_master . '.vreg_is_punched', 0)->where($this->tbl_register_master . '.vreg_next_followup IS NOT NULL')
                    ->where('(TIMESTAMPDIFF(MINUTE, ' . '"' . date('Y-m-d H:i') . '", ' . $this->tbl_register_master . '.vreg_next_followup ' . ')) <= 0')
                    ->where($this->tbl_register_master . '.vreg_showroom', $this->shrm)->get($this->tbl_register_master)->result_array();
          }
     }

     function getShowroomDetails($id)
     {
          return $this->db->get_where($this->tbl_showroom, array('shr_id' => $id))->row_array();
     }

     function getDivisionDetails($id)
     {
          return $this->db->get_where($this->tbl_divisions, array('div_id' => $id))->row_array();
     }

     /* function getBookedVehicle() {
       $this->tbl_vehicle_booking_master = TABLE_PREFIX_PORTAL . 'vehicle_booking_master';
       $this->tbl_vehicle_booking_confirmations = TABLE_PREFIX_PORTAL . 'vehicle_booking_confirmations';

       $fields = array(
       $this->tbl_vehicle_booking_master . '.*', $this->tbl_vehicle_booking_confirmations . '.*'
       );

       $bookedVehicle = $this->db->select($fields)
       ->join($this->tbl_vehicle_booking_confirmations, $this->tbl_vehicle_booking_confirmations . '.vbc_book_master = ' .
       $this->tbl_vehicle_booking_master . '.vbk_id', 'LEFT')
       ->where('(cpnl_vehicle_booking_confirmations.vbc_verify_by = ' . $this->uid . ' OR cpnl_vehicle_booking_confirmations.vbc_verify_by IS NULL)')
       ->get($this->tbl_vehicle_booking_master)->result_array();
       return $bookedVehicle;
       } */

     function getRegectedVehicle()
     {
          $this->load->model('followup/followup_model', 'followup');
          $this->followup->getRejectBooking();
     }

     function sideBarNotifications()
     {
          if ($this->uid > 0) {
               $return = array();
               $mystaffs = array();
               if (check_permission('booking', 'mystaffbking')) {
                    $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
                         ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
                    array_push($mystaffs, $this->uid);
               }

               /* Get rejected booking */
               $this->db->where('enq_current_status', reject_book);
               if (check_permission('booking', 'showall')) {
               } else if (check_permission('booking', 'mybking')) {
                    $this->db->where('enq_se_id', $this->uid);
               } else if (check_permission('booking', 'mystaffbking')) {
                    $this->db->where_in($this->tbl_enquiry . '.enq_se_id', $mystaffs);
               } else if (check_permission('booking', 'myshowroombking')) {
                    $this->db->where($this->tbl_enquiry . '.enq_showroom_id', $this->shrm);
               }
               $return['reject_book'] = $this->db->count_all_results($this->tbl_enquiry);

               /* Booked or rebooked */
               if (check_permission('booking', 'showonlyconfmbooking')) {
                    $this->db->where($this->tbl_vehicle_booking_confirmations . '.vbc_verify_by != NULL');
               }
               if (check_permission('booking', 'showall')) {
               } else if (check_permission('booking', 'mybking')) {
                    $this->db->where($this->tbl_vehicle_booking_master . '.vbk_sales_staff', $this->uid);
               } else if (check_permission('booking', 'mystaffbking')) {
                    $this->db->where_in($this->tbl_vehicle_booking_master . '.vbk_sales_staff', $mystaffs);
               } else if (check_permission('booking', 'myshowroombking')) {
                    $this->db->where($this->tbl_vehicle_booking_master . '.vbk_showroom', $this->shrm);
               }
               $return['booked'] = $this->db->join($this->tbl_vehicle_booking_confirmations, $this->tbl_vehicle_booking_confirmations .
                    '.vbc_book_master = ' . $this->tbl_vehicle_booking_master . '.vbk_id AND ' . $this->tbl_vehicle_booking_confirmations .
                    '.vbc_verify_by = ' . $this->uid, 'LEFT')->where($this->tbl_vehicle_booking_confirmations . '.vbc_id IS NULL')
                    ->where_in(
                         $this->tbl_vehicle_booking_master . '.vbk_status',
                         array(vehicle_booked)
                    )->count_all_results($this->tbl_vehicle_booking_master);
               //, confm_book, rfi_loan_approved, dc_ready_to_del

               /* Booking confirmed */
               if (check_permission('booking', 'showall')) {
               } else if (check_permission('booking', 'mybking')) {
                    $this->db->where($this->tbl_vehicle_booking_master . '.vbk_sales_staff', $this->uid);
               } else if (check_permission('booking', 'mystaffbking')) {
                    $this->db->where_in($this->tbl_vehicle_booking_master . '.vbk_sales_staff', $mystaffs);
               } else if (check_permission('booking', 'myshowroombking')) {
                    $this->db->where($this->tbl_vehicle_booking_master . '.vbk_showroom', $this->shrm);
               }
               $return['bookConfirmed'] = $this->db->where_in(
                    $this->tbl_vehicle_booking_master . '.vbk_status',
                    array(confm_book, rfi_loan_approved, dc_ready_to_del)
               )->count_all_results($this->tbl_vehicle_booking_master);
          }
          return array_filter($return);
     }

     function getStatus($stsValue, $field = array())
     {
          if (!empty($field)) {
               $this->db->select($field);
          }
          return $this->db->where(array('sts_value' => $stsValue))->get($this->tbl_statuses)->row();
     }

     function getKMRanges()
     {
          return $this->db->get($this->tbl_km_ranges)->result_array();
     }

     function getPriceRanges()
     {
          return $this->db->order_by('pr_sort_order', 'asc')->get($this->tbl_price_range)->result_array();
     }

     function getVehicleColors($id = '')
     {
          if ($id) {
               return $this->db->select($this->tbl_vehicle_colors . '.vc_color,')
                    ->where('vc_id ', $id)->get($this->tbl_vehicle_colors)->row()->vc_color;
          }
          return $this->db->order_by('vc_sort_order', 'asc')->get($this->tbl_vehicle_colors)->result_array();
     }
     function getVehicleName($brdId = '', $modId = '', $varId = '')
     {
          if ($brdId) {
               $bmv[0] = $this->db->select('brd_title AS bmv')->where('brd_id', $brdId)->get($this->tbl_brand)->row()->bmv;
          }
          if ($modId) {
               $bmv[1] = $this->db->select('mod_title AS bmv')->where('mod_id', $modId)->get($this->tbl_model)->row()->bmv;
          }
          if ($varId) {
               $bmv[2] = $this->db->select('var_variant_name AS bmv')->where('var_id', $varId)->get($this->tbl_variant)->row()->bmv;
          }

          return implode(', ', $bmv);
     }
     function getSettings($key = '')
     {

          $this->db->select('*')->from(TABLE_PREFIX_PORTAL . 'settings');
          if (!empty($key)) {
               return $this->db->where('set_key', $key)->get()->row_array();
          } else {
               return $this->db->get()->result_array();
          }
     }
}
