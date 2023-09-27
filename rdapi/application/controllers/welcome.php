<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');
  
  class welcome extends CI_Controller {
       public $childrens = array();
       public function __construct() {
            parent::__construct();
       }

       function reassignregister() {
          define('loss_of_sale_or_buy', 4);
          define('sale_closed', 6);
          define('enq_req_drop', 2);
          define('reg_new_register', 0);
          define('reg_alrd_inq_punched', 1);
          $this->myRegStatuses = array(reg_new_register, reg_alrd_inq_punched);
          $fr = 872;//Prasad
          $to = 703;//Hilna
          $enqExclude = loss_of_sale_or_buy . ',' . sale_closed . ',' . enq_req_drop;
          
          $toName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $to))->row()->usr_username;
          $frName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $fr))->row()->usr_username;
          
          //$qry = 'SELECT * FROM `cpnl_register_master` WHERE `vreg_assigned_to` = ' . $fr . ' AND vreg_is_punched = 0 AND vreg_inquiry = 0 ORDER BY vreg_id ASC LIMIT 15';
          //->where("DATE(vreg_added_on) <= '2021-12-31'")
          $data = $this->db->select(array('cpnl_register_master.vreg_id'))
                         ->join('cpnl_enquiry', 'cpnl_enquiry.enq_id = cpnl_register_master.vreg_inquiry', 'left')
                         ->where(array('vreg_assigned_to' => $fr, 'vreg_is_punched' => 0))
                         ->where_in('vreg_status', $this->myRegStatuses)
                         ->where('(cpnl_enquiry.enq_current_status NOT IN (' . $enqExclude . ') OR cpnl_enquiry.enq_current_status IS NULL)')
                         ->get('cpnl_register_master')->result_array();
          
          $narration = "Reassigned some of " . $frName . "'s registers to " . $toName . ", due to request of Shiny for recalling purpose, beacuse of daisy promoted to sales - assigned by Super admin";
          // echo $narration;debug($data);
          // exit;
          foreach ((array) $data as $inqKey => $value) {
               $this->db->where('vreg_id', $value['vreg_id'])->update('cpnl_register_master', array('vreg_assigned_to' => $to, 'flg' => 1));
               //'vreg_added_by' => 100,
               $this->db->insert('cpnl_register_history', array(
                    'regh_phone_num' => $value['vreg_cust_phone'],
                    'regh_register_master' => $value['vreg_id'],
                    'regh_assigned_by' => 100,
                    'regh_assigned_to' => $to,
                    'regh_added_date' => date('Y-m-d H:i:s'),
                    'regh_added_by' => 100,
                    'regh_remarks' => $narration,
                    'regh_system_cmd' => $narration
               ));

               generate_log(array(
                    'log_title' => $narration,
                    'log_desc' => serialize($value),
                    'log_controller' => 'quick-assign-register-master',
                    'log_action' => 'C',
                    'log_ref_id' => $value['vreg_id'],
                    'log_added_by' => 100
               ));
          }
       }

       function reasignmissedfolup() {
          $fr = 846;//Ashraf
          $to = 700;//Deepa
          
          $toName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $to))->row()->usr_username;
          $frName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $fr))->row()->usr_username;

          $enquiry = $this->db->query("SELECT `cpnl_enquiry`.`enq_id`, enq_next_foll_date, DATEDIFF(DATE(cpnl_enquiry.enq_next_foll_date), DATE('2021-12-31')) AS dif 
           FROM (`cpnl_enquiry`) LEFT JOIN `cpnl_users` ON `cpnl_users`.`usr_id` = `cpnl_enquiry`.`enq_se_id` 
           LEFT JOIN `cpnl_users` enqaddedby ON `enqaddedby`.`usr_id` = `cpnl_enquiry`.`enq_added_by` 
           WHERE `cpnl_enquiry`.`enq_se_id` = $fr AND `cpnl_enquiry`.`enq_current_status` IN (1, 15, 14) 
           AND (DATE(cpnl_enquiry.enq_next_foll_date) < DATE('2021-12-31')) ORDER BY `cpnl_enquiry`.`enq_next_foll_date` LIMIT 25")->result_array();
          
           echo $frName . ' - ' . $toName . '<br>';
           devbug($enquiry);
          if(!empty($enquiry)) {
            foreach ($enquiry as $key => $enq) {
                 $nextFolDate = date('Y-m-d H:i:s');
                 $rand = rand(3, 15);
                 $rand = (int) $rand;
                 $nextFolDate = date('Y-m-d H:i:s', strtotime($nextFolDate. ' +' . $rand . ' days'));
                 $weekday = strtolower(date("D", strtotime($nextFolDate)));
                 if($weekday != 'sun') {
                    $nextFolDate = date('Y-m-d H:i:s', strtotime($nextFolDate. ' +' . $rand . ' days'));
                 }
                 $fol =  $this->db->order_by('foll_id', 'DESC')->limit(1)->get_where('cpnl_followup', array('foll_cus_id' => $enq['enq_id'], 'foll_is_cmnt' => 0))->row_array();

                 if(!empty($fol)) {
                    //Comment
                    $comment = $frName . "'s " . ' missed followup enquires reassigned to  ' . $toName . ', for calling, suggested by Ummarali, Reshma';
                    $follCmd['foll_remarks'] = $comment;
                    $follCmd['foll_cus_id'] = $enq['enq_id'];
                    $follCmd['foll_parent'] = 0;
                    $follCmd['foll_cus_vehicle_id'] = 0;
                    $follCmd['foll_entry_date'] = date('Y-m-d H:i:s');
                    $follCmd['foll_customer_feedback'] = '';
                    $follCmd['foll_can_show_all'] = 1;
                    $follCmd['foll_contact'] = 0;
                    $follCmd['foll_action_plan'] = '';
                    $follCmd['foll_added_by'] = 100;
                    $follCmd['foll_updated_by'] = 100;
                    $follCmd['foll_is_dar_submited'] = 0;
                    $follCmd['foll_is_cmnt'] = 1;
                    $this->db->insert('cpnl_followup', $follCmd);

                    //Insert new followup
                    $foll = array(
                         'foll_cus_id' => $enq['enq_id'],
                         'foll_showroom' => 0,
                         'foll_sales_staff' => $to,
                         'foll_cus_vehicle_id' => $fol['foll_cus_vehicle_id'],
                         'foll_entry_date' => date('Y-m-d H:i:s'),
                         'foll_status' => $fol['foll_status'],
                         'foll_remarks' => $frName . "'s enquires reassigned to " . $toName . ' due to missed follow up',
                         'foll_can_show_all' => 0,
                         'foll_customer_feedback_added_date' => date('Y-m-d H:i:s'),
                         'foll_contact' => $fol['foll_contact'],
                         'foll_action_plan' => $fol['foll_action_plan'],
                         'foll_next_foll_date' => $nextFolDate,
                         'foll_added_by' => 100,
                         'foll_updated_by' => 0,
                         'foll_is_dar_submited' => 0,
                         'foll_is_cmnt' => 0
                    );
                    
                    $this->db->insert('cpnl_followup', $foll);
                    //Reset new followup on enquiry

                    generate_log(array(
                         'log_title' => 'Quick assign enquiry ' . $frName . ' to ' . $toName,
                         'log_desc' => serialize($foll),
                         'log_controller' => 'misd-foll-enq-assigned',
                         'log_action' => 'C',
                         'log_ref_id' => $enq['enq_id'],
                         'log_added_by' => 100
                    ));

                    //Enquiry history
                    $enqHtry = array(
                         'enh_enq_id' => $enq['enq_id'],
                         'enh_current_sales_executive' => $to,
                         'enh_status' => 1,
                         'enh_remarks' => $comment
                    );

                    $this->db->insert('cpnl_enquiry_history', $enqHtry);
                    $hisId = $this->db->insert_id();
                    
                    //Update enquiry
                    $this->db->where('enq_id', $enq['enq_id'])->update('cpnl_enquiry', array(
                         'enq_last_viewd' => $to, 'enq_se_id' => $to, 'is_exe' => 1, 'enq_next_foll_date' => $nextFolDate, 'enq_current_status_history' => $hisId));
                 } else {
                      echo 'Empty followup : ' . $enq['enq_id'] . '<br>';
                 }
            }
          } else {
               echo 'Empty';
          }
       }

       public function index() {
            echo 'Here';exit;
            error_reporting(E_ALL);
//            $this->load->library('user_agent');
//
//            if ($this->agent->is_browser()) {
//                 $agent = $this->agent->browser() . ' ' . $this->agent->version();
//            } elseif ($this->agent->is_robot()) {
//                 $agent = $this->agent->robot();
//            } elseif ($this->agent->is_mobile()) {
//                 $agent = $this->agent->mobile();
//            } else {
//                 $agent = 'Unidentified User Agent';
//            }
            //echo $agent . '<br>';
            //echo 'Mobile : ' . $this->agent->mobile() . '<br>';
            //echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
            //$this->load->view('welcome_message');
            //Detect special conditions devices
            $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
            $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

//do something with this information
            if ($iPod || $iPhone) {
                 echo 'iphone';
            } else if ($iPad) {
                 echo 'ipad';
                 //browser reported as an iPad -- do something here
            } else if ($Android) {
                 echo 'andriod';
            } else if ($webOS) {
                 echo 'web';
                 //browser reported as a webOS device -- do something here
            }

//            echo $this->agent->agent_string();
       }

       function homevisit() {
          $hw = $this->db->query("SELECT enq_id FROM `cpnl_enquiry` WHERE `enq_cus_home_visit` = 1")->result_array();
          //debug($hw);
          foreach ($hw as $key => $enq) {
               echo $enq['enq_id'] . '<br>';
               $f = $this->db->order_by('foll_id', 'DESC')->get_where('cpnl_followup', array('foll_contact' => 2, 'foll_cus_id' => $enq['enq_id']))->row_array();
               debug($f, 0);
               echo '------------<br>';
          }
      }

      function missed() {
         $g = $this->db->query("SELECT `cpnl_enquiry`.`enq_id`, `cpnl_enquiry`.`enq_next_foll_date`, `cpnl_enquiry`.`enq_added_by`, `cpnl_enquiry`.`enq_cus_name`, 
                                   `cpnl_enquiry`.`enq_cus_mobile`, `cpnl_enquiry`.`enq_cus_whatsapp`, `cpnl_enquiry`.`enq_entry_date`, `cpnl_enquiry`.`enq_added_by`, 
                                   `cpnl_enquiry`.`enq_se_id`, `cpnl_enquiry`.`enq_mode_enq`, `cpnl_users`.`usr_id`, `cpnl_users`.`usr_first_name`, 
                                   `enqaddedby`.`usr_first_name` AS enq_added_by_name, `enqaddedby`.`usr_id` AS enq_added_by_id 
                                   FROM (`cpnl_enquiry`) 
                                   LEFT JOIN `cpnl_users` ON `cpnl_users`.`usr_id` = `cpnl_enquiry`.`enq_se_id` 
                                   LEFT JOIN `cpnl_users` enqaddedby ON `enqaddedby`.`usr_id` = `cpnl_enquiry`.`enq_added_by` 
                                   WHERE `cpnl_enquiry`.`enq_se_id` = 856 AND `cpnl_enquiry`.`enq_current_status` IN (1, 15, 14) 
                                   AND (DATEDIFF(DATE(cpnl_enquiry.enq_next_foll_date), DATE('2022-07-01')) <= -3) 
                                   AND DATE(cpnl_enquiry.enq_entry_date) < DATE('2022-05-01')
                                   ORDER BY `cpnl_enquiry`.`enq_next_foll_date` DESC")->result_array();
          debug($g);                                   
      }

      function timetable() {
          //$this->db->insert('test', array('number' => '123123', 'done' => 0, 'sys_time3' => date('Y-m-d H:i:s')));
          // $f = $this->db->get_where('test', array('id' => '8602'))->row_array();
          // debug($f, 0);
          // $to = $f['sys_time2'];
          //echo $f['sys_time2'] . '<br>';
          //echo date("Y-m-d H:i:s", strtotime("$to -6:00 hours"));

          $f = $this->db->get_where('cpnl_enquiry_history', array('enh_flag' => 1))->result_array();
          
          foreach ($f as $key => $enq) {
               if(empty($enq['enh_added_on'])) {
                    $d = $enq['enh_id'];
                    $dt = date("Y-m-d H:i:s", strtotime("$d -6:00 hours"));
                    $this->db->where('enh_id', $enq['enh_id'])->update('cpnl_enquiry_history', array('enh_added_on' => $dt));
               }
          }
      }

      function updateHW() {
          $f = $this->db->select('hmv_date, hmv_enq_id')->get('cpnl_home_visits')->result_array();
          foreach ($f as $key => $enq) {
               debug($enq, 0);
               //$d = $this->db->select('enq_cus_home_visit, enq_home_visit_date')->where('enq_id', $enq['hmv_enq_id'])->get('cpnl_enquiry')->result_array();
               //$this->db->where('enq_id', $enq['hmv_enq_id'])->update('cpnl_enquiry', array('enq_cus_home_visit' => 1, 'enq_home_visit_date' => $enq['hmv_date']));
          }
      }

      function getc() {
          //931
          debug($this->mystaf(963), 0);
          debug($this->childrens);
      }
      
      function myStaf($id) {
          $this->db->select('usr_id');
          $this->db->from('cpnl_users');
          $this->db->where(array('usr_tl' => $id, 'usr_resigned' => 0, 'usr_active' => 1));

          $child = $this->db->get();
          $categories = $child->result_array();
          $i=0;
          foreach($categories as $p_cat){
               $categories[$i]['sub'] = $this->mystaf($p_cat['usr_id']); 
               array_push($this->childrens, $p_cat['usr_id']);
               $i++;
          }
          return $categories; 
      }

      function valcolor() {
          
          error_reporting(E_ALL);
          error_reporting(1);
          $val = $this->db->select('val_id, val_color, val_color_id')->where("val_color != '' AND val_color_id = 0")->get('cpnl_valuation')->result_array();
          foreach ($val as $key => $v) {
              $color = ucwords(strtolower(trim($v['val_color'])));
              $col = $this->db->select('vc_id, vc_color')->like("vc_color", $color)->get('cpnl_vehicle_colors')->row_array();
    
              if(!empty($col)) {
                  $this->db->where('val_id', $v['val_id'])->update('cpnl_valuation', array('val_color_id' => $col['vc_id']));
              } else {
                  //$this->db->insert('cpnl_vehicle_colors', array('vc_color' => $color, 'vc_added_on' => date('Y-m-d H:i:s'), 'vc_added_by' => 100));
                  //$vcId = $this->db->last_insert();
                  //$this->db->where('val_id', $v['val_id'])->update('cpnl_valuation', array('val_color_id' => $vcId));
              }
          }
      }

      function revetenqmoove() {
          $v = $this->db->query("SELECT * FROM `cpnl_general_log` WHERE `log_added_by` = 870 AND log_controller LIKE '%quk-assign-inquiry-%' AND log_added_on LIKE '2023-05-06%'")->result_array();
          foreach ($v as $key => $val) {
               $enq = unserialize($val['log_desc']);
               if(!empty($enq)) {
                    $fr = $enq['to_staff'];
                    $to = $enq['frm_staff'];
                    $toName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $to))->row()->usr_username;
                    $frName = $this->db->select('usr_username')->get_where('cpnl_users', array('usr_id' => $fr))->row()->usr_username;
                         
                    $enqHtry = array(
                         'enh_enq_id' => $enq['enquiry']['enq_id'],
                         'enh_current_sales_executive' => $enq['frm_staff'],
                         'enh_status' => 1,
                         'enh_alias' => 'Wrangle allocaked warm cold by Shiny sales officer ' . $toName . ', due to resignation of ' . $frName,
                         'enh_remarks' => 'Enquiry moved misplaced Shiny'
                    );
                    $this->db->insert('cpnl_enquiry_history', $enqHtry);
                    $hisId = $this->db->insert_id();

                    $this->db->where('enq_id', $enq['enquiry']['enq_id'])->update('cpnl_enquiry', array(
                         'enq_last_viewd' => 0, 'enq_se_id' => $to, 'is_exe' => 0, 
                         'enq_current_status_history' => $hisId, 'enq_last_viewd' => 0
                         ,'enq_is_pool' => 0, 'enq_pool_entry_date' => NULL, 'enq_pool_lst_cmd' => ''
                    ));
               }
          }
      }

      function stocknum() {
          
            $f = $this->db->select('pcl_created_at, val_id,val_prt_1,div_short_code,shr_id')
                            ->join('cpnl_valuation', 'val_id = pcl_val_id')
                            ->join('cpnl_showroom', 'val_showroom = shr_id')
                            ->join('cpnl_divisions', 'shr_division = div_id')
                            ->where('pcl_stock_num IS NULL')->get('cpnl_purchase_check_list')->result_array();
            
            foreach ($f as $key => $value) {
                 $stockNumber = strtoupper($value['div_short_code'] . 'KL') . date('Ym', strtotime($value['pcl_created_at'])) . generate_vehicle_virtual_id($value['val_id']);
            
                 $this->db->where('pcl_val_id', $value['val_id'])->update('cpnl_purchase_check_list', array('pcl_stock_num' => $stockNumber));
                 $this->db->where('val_id', $value['val_id'])->update('cpnl_valuation', array('val_stock_num' => $stockNumber));
            }
       }
  }
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */