<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class purchase_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->db->query("SET time_zone = '+05:30'");

          $this->tbl_model = TABLE_PREFIX_RANA . 'model';
          $this->tbl_brand = TABLE_PREFIX_RANA . 'brand';
          $this->tbl_users = TABLE_PREFIX . 'users';
          $this->tbl_enquiry = TABLE_PREFIX . 'enquiry';
          $this->tbl_variant = TABLE_PREFIX_RANA . 'variant';
        
          $this->tbl_showroom = TABLE_PREFIX . 'showroom';
          $this->tbl_valuation = TABLE_PREFIX . 'valuation';
          $this->tbl_vehicle = TABLE_PREFIX . 'vehicle';
          $this->view_vehicle_vehicle_status = TABLE_PREFIX . 'view_vehicle_vehicle_status';

          $this->tbl_mou_master = TABLE_PREFIX . 'mou_master';

          $this->tbl_purchase = TABLE_PREFIX . 'purchase';
          $this->tbl_vehicle_colors = TABLE_PREFIX . 'vehicle_colors';
          $this->tbl_state = TABLE_PREFIX . 'state';
          $this->tbl_district = TABLE_PREFIX . 'district_statewise';
     }


     function getData($val_id){
 
         $data['mou']= $this->db->select("`{$this->tbl_mou_master}`.`moum_number`, `{$this->tbl_mou_master}`.`moum_reg_num`, `{$this->tbl_mou_master}`.`moum_adv_token`") //
          ->get($this->tbl_mou_master)
          ->result_array();
          $this->db->where('val_id', $val_id);
          $data['valuation']= $this->db->select("`{$this->tbl_valuation}`.`val_refurb_cost`, `{$this->tbl_valuation}`.`val_trade_in_price`") //
          ->get($this->tbl_valuation)
          ->row_array();
          return $data;
         
     }

     
     function gePurchaseData($id){
          $this->db->where('pr_id', $id);
          return $this->db->select("`{$this->tbl_purchase}`.`pr_id`, `{$this->tbl_purchase}`.`pr_enq_id`, `{$this->tbl_purchase}`.`pr_mou_no`        
          , `{$this->tbl_purchase}`.`pr_reg_no`, `{$this->tbl_purchase}`.`pr_total`, `{$this->tbl_purchase}`.`pr_refurb_total`, `{$this->tbl_purchase}`.`pr_advance`
          , `{$this->tbl_purchase}`.`pr_fine`, `{$this->tbl_purchase}`.`pr_brokerage`, `{$this->tbl_purchase}`.`pr_insurance`
          ") //
          ->get($this->tbl_purchase)
          ->row_array();
         
     }
 
     function insert($data)
     {
          if (!empty($data)) {
            //   debug($data);
              // $prefix = 'RD';
              // $number = rand(0, 99999) + time();
              // $data['trk_number'] = $prefix . '-' . $number;
               $data['pr_added_by'] = $this->uid;
               $data['pr_added_date'] = date('Y-m-d H:i:s');
               $data['pr_division'] = $this->div;
               $data['pr_showroom'] =  get_logged_user('usr_showroom');
               //unset($data['pr_val_id']);
            //  debug(array_filter($data));
                   ;
               if ($this->db->insert($this->tbl_purchase, array_filter($data))) {
                    $lastId = $this->db->insert_id();
                    generate_log(array(
                         'log_title' => 'Create purchase' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'purchase',
                         'log_action' => 'C',
                         'log_ref_id' => $lastId,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return $lastId;
               } else {
                    generate_log(array(
                         'log_title' => 'New records',
                         'log_desc' => 'Error while issue new purchase',
                         'log_controller' => 'purchase',
                         'log_action' => 'C',
                         'log_added_by' => get_logged_user('usr_id')
                    ));
               }
          } else {
               return false;
          }
     }

     function updateApproval($data)
     {
          if (!empty($data)) {
               $approved_by = $data['pr_approve']!=0?$this->uid:0;
               $id= $data['pr_id'];
              // debug($approved_by);
               unset($data['pr_approve']);
               $data['pr_approved_by'] = $this->uid;
               $data['pr_approved_on'] = date('Y-m-d H:i:s');

               $this->db->where('pr_id', $id);

               if ($this->db->update($this->tbl_purchase, array_filter($data))) {
                    generate_log(array(
                         'log_title' => 'Update purchase Approval ' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'update-purchase approval',
                         'log_action' => 'U',
                         'log_ref_id' => $id,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return true;
               } else {
                    generate_log(array(
                         'log_title' => 'Update purchase approval',
                         'log_desc' => 'Error on update approval',
                         'log_controller' => 'update-purchase-approval',
                         'log_action' => 'U',
                         'log_ref_id' => $id,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return false;
               }
          } else {
               return false;
          }
     }

     function getPurcasePaginate($postDatas) {

          $draw = isset($postDatas['draw']) ? $postDatas['draw'] : 0;
          $row = isset($postDatas['start']) ? $postDatas['start'] : 0;
          $rowperpage = isset($postDatas['length']) ? $postDatas['length'] : 0; // Rows display per page
          $columnIndex = isset($postDatas['order'][0]['column']) ? $postDatas['order'][0]['column'] : 0; // Column index
          $columnName = isset($postDatas['columns'][$columnIndex]['data']) ? $postDatas['columns'][$columnIndex]['data'] : ''; // Column name
          $columnSortOrder = isset($postDatas['order'][0]['dir']) ? $postDatas['order'][0]['dir'] : ''; // asc or desc
          $searchValue = isset($postDatas['search']['value']) ? $postDatas['search']['value'] : ''; // Search value
           
          if ($this->uid !=100 && check_permission('purchase', 'purchase_view_my_staff')) {
       $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
               ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
     } 


          
          $totalRecords = $this->getPurcaseTotal($searchValue );
        $this->db->where($this->tbl_purchase . '.pr_approved_by', 0);
        if($this->uid !=100){
        if (check_permission('purchase', 'purchase_view_smart')) {
          // $this->db->where($this->tbl_mou_master . '.moum_division', 1);
          $this->db->or_where($this->tbl_purchase . '.pr_division', 1);

       }  if (check_permission('purchase', 'purchase_view_luxury')) {
          // $this->db->where($this->tbl_mou_master . '.moum_division', 2);
          $this->db->or_where($this->tbl_purchase . '.pr_division', 2);
       }  if (check_permission('purchase', 'purchase_view_self')) {
           $this->db->or_where($this->tbl_purchase . '.pr_added_by', $this->uid);
       }  if (check_permission('purchase', 'purchase_view_my_showroom')) {
           //$this->db->where($this->tbl_mou_master . '.moum_showroom', $this->shrm);
           $this->db->or_where($this->tbl_purchase . '.pr_showroom', $this->shrm);
       }  
       
       if (check_permission('purchase', 'purchase_view_my_staff')) {

$this->db->where_in($this->tbl_purchase . '.pr_added_by', $mystaffs);

     
       } 

     }
   $selArray = array(
              $this->tbl_purchase . '.pr_id',
              $this->tbl_purchase . '.pr_enq_id',
              $this->tbl_purchase . '.pr_mou_no',
              $this->tbl_purchase . '.pr_reg_no',
              $this->tbl_purchase . '.pr_total',
              $this->tbl_purchase . '.pr_refurb_total',
              $this->tbl_purchase . '.pr_advance',
              $this->tbl_purchase . '.pr_fine',
              $this->tbl_purchase . '.pr_brokerage',
              $this->tbl_purchase . '.pr_insurance',
              $this->tbl_purchase . '.pr_remarks',
              $this->tbl_purchase . '.pr_val_id',
              $this->tbl_purchase . '.pr_added_by',
              "DATE_FORMAT(".$this->tbl_purchase . ".pr_added_date, '%m-%d-%Y') AS pr_added_date",     
              'addeddBy.usr_username AS added_usr_username',
            
          );
      
          // if (!empty($searchValue)) {
          //      $this->db->where("(val_veh_no LIKE '%" . $searchValue . "%' OR shr_location LIKE '%" . $searchValue . "%' OR "
          //              . "brd_title LIKE '%" . $searchValue . "%' OR mod_title LIKE '%" . $searchValue . "%' OR enq_cus_name LIKE '%" . $searchValue . "%' OR enq_cus_mobile LIKE '%" . $searchValue . "%') ");
          // }

       
          if ($rowperpage > 0) {
             $this->db->limit($rowperpage, $row);
          }
        
          $data = $this->db->select($selArray)
                          ->join($this->tbl_users . ' addeddBy', 'addeddBy.usr_id = ' . $this->tbl_purchase . '.pr_added_by', 'left')
                          //->join($this->tbl_mou_master, $this->tbl_mou_master . '.moum_number = ' . $this->tbl_purchase . '.pr_mou_no', 'LEFT')
                       ->get($this->tbl_purchase)->result_array();
    
          $response = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecords,
              "aaData" => $data
          );
          return $response;
     }

     function getPurcaseTotal($searchValue) {

          if ($this->uid !=100 && check_permission('purchase', 'purchase_view_my_staff')) {
               $mystaffs = explode(',', $this->db->select('GROUP_CONCAT(usr_id) AS usr_id')
                       ->where('usr_tl', $this->uid)->get($this->tbl_users)->row()->usr_id);
             } 
     

          $this->db->where($this->tbl_purchase . '.pr_approved_by', 0);
          if($this->uid !=100){
        if (check_permission('purchase', 'purchase_view_smart')) {
         // $this->db->where($this->tbl_mou_master . '.moum_division', 1);
         $this->db->or_where($this->tbl_purchase . '.pr_division', 1);
      }  if (check_permission('purchase', 'purchase_view_luxury')) {
         // $this->db->where($this->tbl_mou_master . '.moum_division', 2);
         $this->db->or_where($this->tbl_purchase . '.pr_division', 2);

      }  if (check_permission('purchase', 'purchase_view_self')) {
          $this->db->or_where($this->tbl_purchase . '.pr_added_by', $this->uid);
      }  if (check_permission('purchase', 'purchase_view_my_showroom')) {
          //$this->db->where($this->tbl_mou_master . '.moum_showroom', $this->shrm);
          $this->db->or_where($this->tbl_purchase . '.pr_showroom', $this->shrm);
      }  
      if (check_permission('purchase', 'purchase_view_my_staff')) {
          $this->db->where_in($this->tbl_purchase . '.pr_added_by', $mystaffs);
      } 
     }
          $this->db->join($this->tbl_users . ' addeddBy', 'addeddBy.usr_id = ' . $this->tbl_purchase . '.pr_added_by', 'left');
      
         // $this->db->join($this->tbl_mou_master, $this->tbl_mou_master . '.moum_number = ' . $this->tbl_purchase . '.pr_mou_no', 'LEFT');
      
          // Apply any additional conditions here based on  searchValue
      
          $this->db->from($this->tbl_purchase);
          return $this->db->count_all_results();
      }
     

     function getApprovedPaginate($postDatas) {


          $draw = isset($postDatas['draw']) ? $postDatas['draw'] : 0;
          $row = isset($postDatas['start']) ? $postDatas['start'] : 0;
          $rowperpage = isset($postDatas['length']) ? $postDatas['length'] : 0; // Rows display per page
          $columnIndex = isset($postDatas['order'][0]['column']) ? $postDatas['order'][0]['column'] : 0; // Column index
          $columnName = isset($postDatas['columns'][$columnIndex]['data']) ? $postDatas['columns'][$columnIndex]['data'] : ''; // Column name
          $columnSortOrder = isset($postDatas['order'][0]['dir']) ? $postDatas['order'][0]['dir'] : ''; // asc or desc
          $searchValue = isset($postDatas['search']['value']) ? $postDatas['search']['value'] : ''; // Search value

         $totalRecords = $this->getApprovedTotal($searchValue);
        

          $selArray = array(
              $this->tbl_purchase . '.pr_id',
              $this->tbl_purchase . '.pr_enq_id',
              $this->tbl_purchase . '.pr_mou_no',//need to change pr_mou_id
              $this->tbl_purchase . '.pr_reg_no',
              $this->tbl_purchase . '.pr_total',
              $this->tbl_purchase . '.pr_refurb_total',
              $this->tbl_purchase . '.pr_advance',
              $this->tbl_purchase . '.pr_fine',
              $this->tbl_purchase . '.pr_brokerage',
              $this->tbl_purchase . '.pr_insurance',
              $this->tbl_purchase . '.pr_approve_remarks',
              $this->tbl_purchase . '.pr_val_id',
              $this->tbl_purchase . '.pr_added_by',
              "DATE_FORMAT(".$this->tbl_purchase . ".pr_added_date, '%m-%d-%Y') AS pr_added_date", 
              'addeddBy.usr_username AS added_usr_username',    
  "DATE_FORMAT(".$this->tbl_purchase . ".pr_approved_on, '%m-%d-%Y') AS pr_approved_on", 
  'approvedBy.usr_username AS approvedBy',
            
          );
      
          // if (!empty($searchValue)) {
          //      $this->db->where("(val_veh_no LIKE '%" . $searchValue . "%' OR shr_location LIKE '%" . $searchValue . "%' OR "
          //              . "brd_title LIKE '%" . $searchValue . "%' OR mod_title LIKE '%" . $searchValue . "%' OR enq_cus_name LIKE '%" . $searchValue . "%' OR enq_cus_mobile LIKE '%" . $searchValue . "%') ");
          // }

       
          if ($rowperpage > 0) {
             $this->db->limit($rowperpage, $row);
          }
          $this->db->where('pr_approved_by !=', 0);
          $data = $this->db->select($selArray)
                          ->join($this->tbl_users . ' addeddBy', 'addeddBy.usr_id = ' . $this->tbl_purchase . '.pr_added_by', 'left')
                          ->join($this->tbl_users . ' approvedBy', 'approvedBy.usr_id = ' . $this->tbl_purchase . '.pr_approved_by', 'left')
                          ->get($this->tbl_purchase)->result_array();
    
          $response = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecords,
              "aaData" => $data
          );
          return $response;
     }

     function getApprovedTotal($searchValue) {
          $this->db->where('pr_approved_by !=', 0);
                   $this->db->from($this->tbl_purchase);
                   return $this->db->count_all_results();
          
              }

     function update($data)
     {
          if (!empty($data)) {

               $this->db->where('pr_id', $data['pr_id']);

               if ($this->db->update($this->tbl_purchase,$data)) {
                    generate_log(array(
                         'log_title' => 'Update purchase ' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'update-purchase ',
                         'log_action' => 'U',
                         'log_ref_id' => $id,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return true;
               } else {
                    generate_log(array(
                         'log_title' => 'Update purchase ',
                         'log_desc' => 'Error on update ',
                         'log_controller' => 'update-purchase-',
                         'log_action' => 'U',
                         'log_ref_id' => $id,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return false;
               }
          } else {
               return false;
          }
     }

     function purchaseApiK(){
          $selArray = array(
               $this->tbl_brand . '.brd_title',
               $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_variant_name',
               $this->tbl_vehicle_colors . '.vc_color',
               $this->tbl_valuation . '.val_model_year',
               $this->tbl_valuation . '.val_engine_no',
               $this->tbl_valuation . '.val_chasis_no',
              // $this->tbl_valuation . '.val_veh_no',
           //    $this->tbl_valuation . '.val_id',
           //    $this->tbl_valuation . '.val_prt_1',
           //    $this->tbl_valuation . '.val_prt_2',
           //    $this->tbl_valuation . '.val_prt_3',
           //    $this->tbl_valuation . '.val_prt_4',
              "UPPER(CONCAT(val_prt_1, '-', val_prt_2, '-', val_prt_3, '-', val_prt_4)) AS val_veh_no",
              $this->tbl_valuation . '.val_cust_name',
               
               $this->tbl_valuation . '.val_refurb_cost',
               'slsOfficer.usr_first_name AS val_sales_officer_name',
               //$this->tbl_purchase . '.pr_sourcing_type as val_type_title',
           
               $this->tbl_showroom . '.shr_location as val_showroom',
               $this->tbl_valuation . '.val_stock_num',
               // $this->tbl_purchase . '.pr_tcs_amt as tcS_Amt',
               // $this->tbl_purchase . '.pr_added_date as enq_agreement_date',
          
               // $this->tbl_users . '.usr_id',
               // $this->tbl_users . '.usr_username',
               // $this->tbl_showroom . '.shr_id',

              $this->tbl_enquiry . '.enq_cus_address',
               $this->tbl_enquiry . '.enq_cus_ofc_address',
               $this->tbl_enquiry . '.enq_cus_state',
               $this->tbl_enquiry . '.enq_cus_dist',
               $this->tbl_district . '.std_district_name as enq_cus_dist',
             
              // $this->tbl_state . '.stt_name',
               
              
           
               ////
           );
    $selArraykk = array(
    $this->tbl_brand . '.brd_title',
    $this->tbl_model . '.mod_title',
    $this->tbl_variant . '.var_variant_name',
    $this->tbl_vehicle_colors . '.vc_color',
    $this->tbl_valuation . '.val_model_year',
    $this->tbl_valuation . '.val_engine_no',
    $this->tbl_valuation . '.val_chasis_no',
    "UPPER(CONCAT(val_prt_1, '-', val_prt_2, '-', val_prt_3, '-', val_prt_4)) AS val_veh_no",
    $this->tbl_valuation . '.val_cust_name',
    $this->tbl_valuation . '.val_refurb_cost',
    'slsOfficer.usr_first_name AS val_sales_officer_name',
    $this->tbl_showroom . '.shr_location as val_showroom',
    $this->tbl_valuation . '.val_stock_num',
    $this->tbl_enquiry . '.enq_cus_address',
    $this->tbl_enquiry . '.enq_cus_ofc_address',
    $this->tbl_enquiry . '.enq_cus_dist',
    $this->tbl_district . '.std_district_name as enq_cus_dist',
    'Kerala as enq_cus_state' // Use 'Kerala' as a literal string without single quotes
);

           
           
           $this->db->where('val_id', 8020);
           $data = $this->db->select($selArray)
           ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
           ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
           ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
           ->join($this->tbl_vehicle_colors, $this->tbl_vehicle_colors . '.vc_id = ' . $this->tbl_valuation . '.val_color', 'left')
           ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'left')
           ->join($this->tbl_enquiry, $this->tbl_enquiry . '.enq_id = ' . $this->tbl_valuation . '.val_enquiry_id', 'left')
           
          ->join($this->tbl_users . ' slsOfficer', 'slsOfficer.usr_id = ' . $this->tbl_valuation . '.val_sales_officer', 'left')
           ->join($this->tbl_purchase, $this->tbl_purchase . '.pr_val_id = ' . $this->tbl_valuation . '.val_id', 'left')
           ->join($this->tbl_district, $this->tbl_district . '.std_id = ' . $this->tbl_enquiry . '.enq_cus_dist', 'left')
           //->join($this->tbl_state, $this->tbl_state . '.stt_id = ' . $this->tbl_enquiry . '.enq_cus_state', 'left')
           
           ->get($this->tbl_valuation)->row_array();
           return $data ;
     }

     public function purchaseApi(){
          $this->db->where('val_id',8047);//8020///8038

          $this->db->select("
              {$this->tbl_brand}.brd_title,
              {$this->tbl_model}.mod_title,
              {$this->tbl_variant}.var_variant_name,
              {$this->tbl_vehicle_colors}.vc_color,
              {$this->tbl_valuation}.val_model_year,
              {$this->tbl_valuation}.val_engine_no,
              {$this->tbl_valuation}.val_chasis_no,
              UPPER(CONCAT({$this->tbl_valuation}.val_prt_1, '-', {$this->tbl_valuation}.val_prt_2, '-', {$this->tbl_valuation}.val_prt_3, '-', {$this->tbl_valuation}.val_prt_4)) AS val_veh_no,
              {$this->tbl_valuation}.val_cust_name,
              {$this->tbl_valuation}.val_refurb_cost,//val else enter and store purch tbl
              slsOfficer.usr_first_name AS val_sales_officer_name,
              {$this->tbl_showroom}.shr_location as val_showroom,
              {$this->tbl_valuation}.val_stock_num,
              {$this->tbl_enquiry}.enq_cus_address,
              {$this->tbl_enquiry}.enq_cus_ofc_address,
              {$this->tbl_purchase}.pr_advance As enh_adv_amt,
              {$this->tbl_district}.std_district_name as enq_cus_dist,
              'Kerala' as enq_cus_state,
              0 as enh_booking_amt,//Trade in Price	evl table else new frm pur
              0 as enh_discount_amt,//purch form new
              'Full Purchase' as val_type_title,drp dwn pur form new
              'C' as enq_trans_mode
          ", false);//add sourcing type ->
          //pr_agreement_date=enq_agreement_date
          
          $this->db->from($this->tbl_valuation);
          
          $this->db->join($this->tbl_brand, "{$this->tbl_brand}.brd_id = {$this->tbl_valuation}.val_brand", 'left');
          $this->db->join($this->tbl_model, "{$this->tbl_model}.mod_id = {$this->tbl_valuation}.val_model", 'left');
          $this->db->join($this->tbl_variant, "{$this->tbl_variant}.var_id = {$this->tbl_valuation}.val_variant", 'left');
          $this->db->join($this->tbl_vehicle_colors, "{$this->tbl_vehicle_colors}.vc_id = {$this->tbl_valuation}.val_color", 'left');
          $this->db->join($this->tbl_showroom, "{$this->tbl_showroom}.shr_id = {$this->tbl_valuation}.val_showroom", 'left');
          $this->db->join($this->tbl_enquiry, "{$this->tbl_enquiry}.enq_id = {$this->tbl_valuation}.val_enquiry_id", 'left');
          $this->db->join($this->tbl_users . ' slsOfficer', "slsOfficer.usr_id = {$this->tbl_valuation}.val_sales_officer", 'left');
          $this->db->join($this->tbl_purchase, "{$this->tbl_purchase}.pr_val_id = {$this->tbl_valuation}.val_id", 'left');
          $this->db->join($this->tbl_district, "{$this->tbl_district}.std_id = {$this->tbl_enquiry}.enq_cus_dist", 'left');
         
          
          $data = $this->db->get()->row_array();
          
          return $data;
          

     }



}
