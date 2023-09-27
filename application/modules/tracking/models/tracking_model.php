<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class tracking_model extends CI_Model
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
          $this->tbl_tracking = TABLE_PREFIX . 'tracking';
          $this->tbl_showroom = TABLE_PREFIX . 'showroom';
          $this->tbl_valuation = TABLE_PREFIX . 'valuation';
          $this->tbl_vehicle = TABLE_PREFIX . 'vehicle';
          $this->view_vehicle_vehicle_status = TABLE_PREFIX . 'view_vehicle_vehicle_status';
     }

     function getVehicles()
     {
          return $this->db->select($this->tbl_valuation . '.val_veh_no,' . $this->tbl_model . '.mod_title,' . $this->tbl_brand . '.brd_title,' .
               $this->tbl_variant . '.var_variant_name')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->get($this->tbl_valuation)->result_array();
     }


     function getEvaluation()
     {
          $excludeId = $this->db->select('GROUP_CONCAT(trk_vehicle_no) AS trk_vehicle_no')->where('trk_check_in_date IS NULL')
               ->get($this->tbl_tracking)->row()->trk_vehicle_no;

          if (!empty($excludeId)) {
               $this->db->where_not_in($this->tbl_valuation . '.val_id', explode(',', $excludeId));
          }
          $select = array(
               $this->tbl_valuation . '.val_id',
               $this->tbl_valuation . '.val_veh_no',
               $this->tbl_model . '.mod_title',
               $this->tbl_brand . '.brd_title',
               $this->tbl_variant . '.var_variant_name'
          );
          return $this->db->select($select)
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->where($this->tbl_valuation . '.val_status >= 1')->get($this->tbl_valuation)->result_array();
          //, array(1, 39)
     }

     function getTracking($id = '')
     {
          $fields = array(
               $this->tbl_tracking . '.trk_number',
               $this->tbl_tracking . '.trk_vehicle_no',
               $this->tbl_tracking . '.trk_out_pass_time',
               $this->tbl_tracking . '.trk_out_pass_purpose',
               $this->tbl_tracking . '.trk_out_pass_other_driver',
               $this->tbl_tracking . '.trk_out_pass_to_place',
               $this->tbl_tracking . '.trk_out_pass_km',
               $this->tbl_tracking . '.trk_out_pass_est_return_time',
               $this->tbl_tracking . '.trk_id',
               $this->tbl_tracking . '.trk_out_pass_purpose',
               $this->tbl_tracking . '.trk_out_pass_rd_driver',
               $this->tbl_tracking . '.trk_check_in_rd_driver',
               $this->tbl_tracking . '.trk_check_in_other_driver',
               $this->tbl_tracking . '.trk_check_in_rd_showroom',
               $this->tbl_tracking . '.trk_check_in_date',
               $this->tbl_tracking . '.trk_check_in_km',
               $this->tbl_tracking . '.trk_check_in_remarks',
               $this->tbl_valuation . '.val_id',
               $this->tbl_valuation . '.val_veh_no',
               $this->tbl_valuation . '.val_fuel',
               $this->tbl_users . '.usr_username',
               'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name',
               'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name',
               'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address',
               $this->tbl_model . '.mod_title',
               $this->tbl_brand . '.brd_title',
               $this->tbl_variant . '.var_variant_name'
          );
          if (!empty($id)) {

               generate_log(array(
                    'log_title' => 'Read records',
                    'log_desc' => 'Read tracking pass issued',
                    'log_controller' => strtolower(__CLASS__),
                    'log_action' => 'R',
                    'log_ref_id' => $id,
                    'log_added_by' => get_logged_user('usr_id')
               ));

               return $this->db->select($fields)
                    ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
                    ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
                    ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
                    ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
                    ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
                    ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
                    ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
                    ->where($this->tbl_tracking . '.trk_id', $id)->get($this->tbl_tracking)->row_array();
          } else {
               return $this->db->select($this->tbl_tracking . '.*,' . $this->tbl_valuation . '.*,' . $this->tbl_users . '.*,' .
                    'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name, '
                    . 'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name,'
                    . 'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address')
                    ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
                    ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
                    ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
                    ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
                    ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
                    ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
                    ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
                    ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
                    ->get($this->tbl_tracking)->result_array();
          }
     }

     function insert($data)
     {
          if (!empty($data)) {
               $prefix = 'RD';
               $number = rand(0, 99999) + time();
               $data['trk_number'] = $prefix . '-' . $number;
               $data['trk_out_pass_added_by'] = $this->uid;
               $data['trk_out_pass_added_date'] = date('Y-m-d H:i:s');
               $data['trk_out_pass_showroom'] = isset($data['trk_out_pass_showroom']) ? $data['trk_out_pass_showroom'] :
                    get_logged_user('usr_showroom');
               if ($this->db->insert($this->tbl_tracking, array_filter($data))) {
                    $lastId = $this->db->insert_id();
                    generate_log(array(
                         'log_title' => 'Issue gate pass' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'issue-gate-pass',
                         'log_action' => 'C',
                         'log_ref_id' => $lastId,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return $lastId;
               } else {
                    generate_log(array(
                         'log_title' => 'New records',
                         'log_desc' => 'Error while issue new tracking card',
                         'log_controller' => 'issue-gate-pass-error',
                         'log_action' => 'C',
                         'log_added_by' => get_logged_user('usr_id')
                    ));
               }
          } else {
               return false;
          }
     }

     function update($data)
     {
          if (!empty($data)) {
               $id = $data['trk_id'];
               unset($data['trk_id']);
               $data['trk_last_updated_by'] = $this->uid;
               $data['trk_last_updated_on'] = date('Y-m-d H:i:s');
               $this->db->where('trk_id', $id);

               if ($this->db->update($this->tbl_tracking, array_filter($data))) {
                    generate_log(array(
                         'log_title' => 'Update records ' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'update-gate-pass',
                         'log_action' => 'U',
                         'log_ref_id' => $id,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return true;
               } else {
                    generate_log(array(
                         'log_title' => 'Update records',
                         'log_desc' => 'Error on update tracking pass',
                         'log_controller' => 'update-gate-pass-error',
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

     function checkinVehicle($data)
     {
          if (!empty($data)) {
               $trkId = $data['trk_id'];
               unset($data['trk_id']);
               $this->db->where('trk_id', $trkId);
               $data['trk_check_in_added_by'] = $this->uid;
               $data['trk_check_in_added_date'] = date('Y-m-d H:i:s');
               if ($this->db->update($this->tbl_tracking, $data)) {
                    generate_log(array(
                         'log_title' => 'Check in vehicle ' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'check-in',
                         'log_action' => 'U',
                         'log_ref_id' => $trkId,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return true;
               } else {
                    generate_log(array(
                         'log_title' => 'Check in vehicle ' . date('Y-m-d H:i:s'),
                         'log_desc' => serialize($data),
                         'log_controller' => 'check-in-error',
                         'log_action' => 'U',
                         'log_ref_id' => $trkId,
                         'log_added_by' => get_logged_user('usr_id')
                    ));
                    return false;
               }
          } else {
               return false;
          }
     }

     /* function getTrackingByVehicleId($vehId) {
         return $this->db->select($this->tbl_tracking . '.*,' . $this->tbl_valuation . '.*,' . $this->tbl_users . '.*,' .
         'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name, '
         . 'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name, '
         . 'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address, '
         . 'check_in.shr_location AS check_in_location, check_in.shr_address AS check_in_address, '
         . 'check_in.shr_location AS check_out_from_location, check_in.shr_address AS check_out_from_address, ' .
         $this->view_vehicle_vehicle_status . '.*')
         ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
         ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
         ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
         ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
         ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
         ->join($this->tbl_showroom . ' check_in', 'check_in.shr_id = ' . $this->tbl_tracking . '.trk_check_in_rd_showroom', 'left')
         ->join($this->tbl_showroom . ' check_out_from', 'check_out_from.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_showroom', 'left')
         ->join($this->view_vehicle_vehicle_status, $this->view_vehicle_vehicle_status . '.veh_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
         ->where($this->tbl_tracking . '.trk_vehicle_no', $vehId)->get($this->tbl_tracking)->result_array();
         } */

     //       function getTrackingByVehicleId($vehId) {
     //            return $this->db->select($this->tbl_tracking . '.*,' . $this->tbl_valuation . '.*,' . $this->tbl_users . '.*,' .
     //                                    'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name, '
     //                                    . 'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name, '
     //                                    . 'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address, '
     //                                    . 'check_in.shr_location AS check_in_location, check_in.shr_address AS check_in_address, '
     //                                    . 'check_in.shr_location AS check_out_from_location, check_in.shr_address AS check_out_from_address, ' .
     //                                    $this->tbl_vehicle . '.*,' . $this->tbl_variant . '.*,' . $this->tbl_model . '.*,' . $this->tbl_brand . '.*')
     //                            ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
     //                            ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
     //                            ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
     //                            ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
     //                            ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
     //                            ->join($this->tbl_showroom . ' check_in', 'check_in.shr_id = ' . $this->tbl_tracking . '.trk_check_in_rd_showroom', 'left')
     //                            ->join($this->tbl_showroom . ' check_out_from', 'check_out_from.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_showroom', 'left')
     //                            ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
     //                            ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
     //                            ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
     //                            ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
     //                            ->order_by($this->tbl_tracking . '.trk_check_in_date', 'DESC')
     //                            ->where($this->tbl_tracking . '.trk_vehicle_no', $vehId)->get($this->tbl_tracking)->result_array();
     //       }

     function getTrackingByVehicleId($vehId)
     {
          return $this->db->select($this->tbl_tracking . '.trk_check_in_date, trk_check_in_date, trk_number, trk_check_in_other_place, trk_check_in_other_driver,trk_check_in_km,' .
               'trk_out_pass_purpose,trk_out_pass_time, trk_out_pass_to_place, trk_out_pass_other_driver, trk_out_pass_km,' .
               $this->tbl_valuation . '.val_id,' . $this->tbl_users . '.usr_first_name,' .
               'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name, added_by.usr_showroom AS added_show_room,'
               . 'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name, checkin_by.usr_showroom AS checkin_show_room,'
               . 'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address, '
               . 'check_in.shr_location AS check_in_location, check_in.shr_address AS check_in_address, '
               . 'check_in.shr_location AS check_out_from_location, check_in.shr_address AS check_out_from_address, ' .
               $this->tbl_vehicle . '.veh_id,' . $this->tbl_variant . '.var_variant_name,' . $this->tbl_model .
               '.mod_title,' . $this->tbl_brand . '.brd_title,' .
               'added_by_tmp.shr_location AS added_by_tmp_show, checkin_by_tmp.shr_location AS checkin_by_tmp_show,' .
               'check_out_from.shr_location AS checkout_from, checkin_driver.usr_first_name AS checkin_driver_first_name')
               ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
               ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
               ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
               ->join($this->tbl_users . ' checkin_driver', 'checkin_driver.usr_id = ' . $this->tbl_tracking . '.trk_check_in_rd_driver', 'left')
               ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
               ->join($this->tbl_showroom . ' check_in', 'check_in.shr_id = ' . $this->tbl_tracking . '.trk_check_in_rd_showroom', 'left')
               ->join($this->tbl_showroom . ' check_out_from', 'check_out_from.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_showroom', 'left')
               ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_showroom . ' added_by_tmp', 'added_by_tmp.shr_id = added_by.usr_showroom', 'LEFT')
               ->join($this->tbl_showroom . ' checkin_by_tmp', 'checkin_by_tmp.shr_id = checkin_by.usr_showroom', 'LEFT')
               ->order_by($this->tbl_tracking . '.trk_id', 'DESC')
               ->where($this->tbl_tracking . '.trk_vehicle_no', $vehId)->get($this->tbl_tracking)->result_array();
     }

     function getAllVehiclesForTracking()
     {
          return $this->db->select($this->tbl_valuation . '.*,' . $this->tbl_model . '.*,' .
               $this->tbl_brand . '.*,' . $this->tbl_variant . '.*,' . $this->tbl_users . '.*,' . $this->tbl_showroom . '.*')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_valuation . '.val_added_by', 'left')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'left')
               ->where_in($this->tbl_valuation . '.val_type', array(1, 2))->get($this->tbl_valuation)->result_array();
     }
     function getAllVehiclesForTrackingAjax($postDatas)
     { //jsk
          $draw = $postDatas['draw'];
          $row = $postDatas['start'];
          $rowperpage = $postDatas['length']; // Rows display per page
          $columnIndex = isset($postDatas['order'][0]['column']) ? $postDatas['order'][0]['column'] : ''; // Column index
          $columnName = isset($postDatas['columns'][$columnIndex]['data']) ? $postDatas['columns'][$columnIndex]['data'] : 'ccb_id'; // Column name 
          $columnSortOrder = isset($postDatas['order'][0]['dir']) ? $postDatas['order'][0]['dir'] : 'DESC'; // asc or desc
          $searchValue = $postDatas['search']['value']; // Search value

          $totalRecords = $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_valuation . '.val_added_by', 'left')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'left')
               ->where_in($this->tbl_valuation . '.val_type', array(1, 2))->count_all_results($this->tbl_valuation);

          if ($rowperpage > 0) {
               $this->db->limit($rowperpage, $row);
          }
          if ($searchValue != '') {
               $this->db->where("(val_veh_no LIKE '%" . $searchValue . "%' OR brd_title LIKE '%" . $searchValue . "%' OR "
                    . "var_variant_name LIKE '%" . $searchValue . "%' OR mod_title LIKE '%" . $searchValue . "%') ");
          }
          $data = $this->db->select($this->tbl_valuation . '.val_id,' . $this->tbl_valuation . '.val_veh_no,' . $this->tbl_model . '.mod_id,' . $this->tbl_model . '.mod_title,' .
               $this->tbl_brand . '.brd_id,' . $this->tbl_brand . '.brd_title,' . $this->tbl_variant . '.var_id,' . $this->tbl_variant . '.var_variant_name,' . $this->tbl_users . '.usr_id,' . $this->tbl_showroom . '.shr_id')
               ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_valuation . '.val_model', 'left')
               ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_valuation . '.val_brand', 'left')
               ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_valuation . '.val_variant', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_valuation . '.val_added_by', 'left')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'left')
               ->where_in($this->tbl_valuation . '.val_type', array(1, 2))->get($this->tbl_valuation)->result_array();

          $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecords,
               "aaData" => $data
          );
          return $response;
     }
     function getTrackingPaginate($postDatas)
     {
          $draw = $postDatas['draw'];
          $row = $postDatas['start'];
          $rowperpage = $postDatas['length']; // Rows display per page
          $columnIndex = isset($postDatas['order'][0]['column']) ? $postDatas['order'][0]['column'] : ''; // Column index
          $columnName = isset($postDatas['columns'][$columnIndex]['data']) ? $postDatas['columns'][$columnIndex]['data'] : 'ccb_id'; // Column name 
          $columnSortOrder = isset($postDatas['order'][0]['dir']) ? $postDatas['order'][0]['dir'] : 'DESC'; // asc or desc
          $searchValue = $postDatas['search']['value']; // Search value

          if ($rowperpage > 0) {
               $this->db->limit($rowperpage, $row);
          }
          if (!empty($searchValue)) {
               // try {
               //      $date = new DateTime($searchValue);
               //      $searchValue = $date->format('Y-m-d');
               // } catch (Exception $e) {
               //      $searchValue;
               // }
               $this->db->where("(trk_number LIKE '%" . $searchValue . "%' OR val_veh_no LIKE '%" . $searchValue . "%')");
               //    $this->db->where("(trk_number LIKE '%" . $searchValue . "%' OR trk_vehicle_no LIKE '%" . $searchValue . "%' OR "
               //        . "trk_out_pass_time LIKE '%" . $searchValue . "%' OR trk_out_pass_other_driver LIKE '%" . $searchValue . "%' OR trk_out_pass_to_place LIKE '%" . $searchValue . "%' OR added_by.usr_first_name LIKE '%" . $searchValue . "%'OR val_veh_no LIKE '%" . $searchValue . "%'OR $this->tbl_valuation.val_prt_4 LIKE '%" . $searchValue . "%') ");
          }

          $fields = array(
               $this->tbl_tracking . '.trk_number',
               $this->tbl_tracking . '.trk_vehicle_no',
               $this->tbl_tracking . '.trk_out_pass_time',
               $this->tbl_tracking . '.trk_out_pass_purpose',
               $this->tbl_tracking . '.trk_out_pass_other_driver',
               $this->tbl_tracking . '.trk_out_pass_to_place',
               $this->tbl_tracking . '.trk_out_pass_km',
               $this->tbl_tracking . '.trk_out_pass_est_return_time',
               $this->tbl_tracking . '.trk_id',
               $this->tbl_tracking . '.trk_out_pass_purpose',
               $this->tbl_tracking . '.trk_out_pass_rd_driver',
               $this->tbl_tracking . '.trk_check_in_rd_driver',
               $this->tbl_tracking . '.trk_check_in_other_driver',
               $this->tbl_tracking . '.trk_check_in_rd_showroom',
               $this->tbl_tracking . '.trk_check_in_date',
               $this->tbl_tracking . '.trk_check_in_km',
               $this->tbl_tracking . '.trk_check_in_remarks',
               $this->tbl_valuation . '.val_id',
               $this->tbl_valuation . '.val_veh_no',
               $this->tbl_users . '.usr_username',
               'added_by.usr_id AS added_id, added_by.usr_first_name AS added_first_name',
               'checkin_by.usr_id AS checkin_by_id, checkin_by.usr_first_name AS checkin_by_first_name',
               'out_pass_to.shr_location AS out_pass_to_location, out_pass_to.shr_address AS out_pass_to_address'
          );

          $data = $this->db->select($fields)
               ->join($this->tbl_valuation, $this->tbl_valuation . '.val_id = ' . $this->tbl_tracking . '.trk_vehicle_no', 'left')
               ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_rd_driver', 'left')
               ->join($this->tbl_users . ' added_by', 'added_by.usr_id = ' . $this->tbl_tracking . '.trk_out_pass_added_by', 'left')
               ->join($this->tbl_users . ' checkin_by', 'checkin_by.usr_id = ' . $this->tbl_tracking . '.trk_check_in_added_by', 'left')
               ->join($this->tbl_showroom . ' out_pass_to', 'out_pass_to.shr_id = ' . $this->tbl_tracking . '.trk_out_pass_to', 'left')
               ->order_by('trk_id', 'DESC')->get($this->tbl_tracking)->result_array();
          // Count total records
          $this->db->from($this->tbl_tracking);
          $totalRecords = $this->db->count_all_results();

          $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecords,
               "aaData" => $data
          );
          return $response;
     }
}
