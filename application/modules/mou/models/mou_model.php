<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class mou_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_users = TABLE_PREFIX . 'users';
            $this->tbl_mou_rf = TABLE_PREFIX . 'mou_rf';
            $this->tbl_showroom = TABLE_PREFIX . 'showroom';
            $this->tbl_mou_master = TABLE_PREFIX . 'mou_master';
            $this->tbl_accessories = TABLE_PREFIX . 'accessories';
            $this->tbl_designation = TABLE_PREFIX . 'designation';
            $this->tbl_model = TABLE_PREFIX_RANA . 'model';
            $this->tbl_brand = TABLE_PREFIX_RANA . 'brand';
            $this->tbl_variant = TABLE_PREFIX_RANA . 'variant';
            $this->tbl_divisions = TABLE_PREFIX . 'divisions';
            $this->tbl_district_statewise = TABLE_PREFIX . 'district_statewise';
            $this->tbl_mou_identification = TABLE_PREFIX . 'mou_identification';
            $this->tbl_mou_service_package = TABLE_PREFIX . 'mou_service_package';
       }

       function getMou($id) {

            $return['master'] = $this->db->select($this->tbl_mou_master . '.*,' . $this->tbl_district_statewise . '.*,' .
                                    $this->tbl_brand . '.brd_title,' . $this->tbl_model . '.mod_title,' . $this->tbl_variant . '.var_variant_name,' .
                                    $this->tbl_users . '.usr_username,' . $this->tbl_designation . '.desig_title')
                            ->join($this->tbl_district_statewise, $this->tbl_district_statewise . '.std_id = ' . $this->tbl_mou_master . '.moum_dist', 'LEFT')
                            ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_mou_master . '.moum_brand', 'LEFT')
                            ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_mou_master . '.moum_model', 'LEFT')
                            ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_mou_master . '.moum_varient', 'LEFT')
                            ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_mou_master . '.moum_pur_staff', 'LEFT')
                            ->join($this->tbl_designation, $this->tbl_designation . '.desig_id = ' . $this->tbl_users . '.usr_designation_new', 'LEFT')
                            ->get_where($this->tbl_mou_master, array('moum_token' => $id))->row_array();
            $id = isset($return['master']['moum_id']) ? $return['master']['moum_id'] : 0;
            $return['rf'] = $this->db->get_where($this->tbl_mou_rf, array('mour_master' => $id))->result_array();
            $return['service'] = $this->db->get_where($this->tbl_mou_service_package, array('mous_master' => $id))->result_array();
            $return['identification'] = $this->db->get_where($this->tbl_mou_identification, array('moui_master' => $id))->result_array();
            return $return;
       }

       function addNewMOU($datas) {
//            $this->db->truncate($this->tbl_mou_rf);
//            $this->db->truncate($this->tbl_mou_master);
//            $this->db->truncate($this->tbl_mou_identification);
//            $this->db->truncate($this->tbl_mou_service_package);
//            generate_log(array(
//                'log_title' => 'New mou',
//                'log_desc' => serialize($datas),
//                'log_controller' => 'new-mou',
//                'log_action' => 'C',
//                'log_ref_id' => 0,
//                'log_added_by' => $this->uid
//            ));
            //Master.
            $maxId = $this->db->select_max('moum_id')->get($this->tbl_mou_master)->row()->moum_id + 1;
            $numPart = sprintf("%04d", $maxId);

            $AA = isset($datas['AA']) ? $datas['AA'] : array();
            $AB = isset($datas['AB']) ? $datas['AB'] : array();
            $RF = isset($datas['RF']) ? $datas['RF'] : array();
            unset($datas['AA']);
            unset($datas['AB']);
            unset($datas['RF']);

            if ($datas['moum_division'] == 1) {
                 $div = 'S';
            } else if ($datas['moum_division'] == 2) {
                 $div = 'L';
            }


            $datas['moum_number'] = '';
            $datas['moum_added_by'] = $this->uid;
            $datas['moum_added_on'] = date('Y-m-d H:i:s');
            $datas['moum_number'] = 'RD/' . $div . '/' . date('Y') . '/' . $numPart;
            $datas['moum_token'] = md5($maxId);
            $datas['moum_engine_number'] = isset($AA['number']['0']) ? $AA['number']['0'] : '';
            $datas['moum_chassis_number'] = isset($AA['number']['1']) ? $AA['number']['1'] : '';
            $datas['moum_cust_ref_no'] = generate_vehicle_virtual_id($maxId);
            $this->db->insert($this->tbl_mou_master, $datas);
            $masterId = $this->db->insert_id();

            //Identification.
            if (!empty($AA) && isset($AA['component'])) {
                 $count = count($AA['component']);
                 for ($i = 0; $i < $count; $i++) {
                      $c = isset($AA['component'][$i]) ? $AA['component'][$i] : 0; //component
                      $n = isset($AA['number'][$i]) ? $AA['number'][$i] : 0; //number
                      $r = isset($AA['remarks'][$i]) ? $AA['remarks'][$i] : 0; //remarks
                      if (!empty($c) && !empty($n)) {
                           $this->db->insert($this->tbl_mou_identification, array(
                               'moui_master' => $masterId,
                               'moui_component' => $c,
                               'moui_id_num' => $n,
                               'moui_remarks' => $r
                           ));
                      }
                 }
            }

            //service package.
            if (!empty($AB) && isset($AB['component'])) {
                 $count = count($AB['component']);
                 for ($i = 0; $i < $count; $i++) {
                      $c = isset($AB['component'][$i]) ? $AB['component'][$i] : 0; //component
                      $n = isset($AB['number'][$i]) ? $AB['number'][$i] : 0; //number
                      $r = isset($AB['remarks'][$i]) ? $AB['remarks'][$i] : 0; //remarks
                      if (!empty($c) && !empty($n)) {
                           $this->db->insert($this->tbl_mou_service_package, array(
                               'mous_master' => $masterId,
                               'mous_particulars' => $c,
                               'mous_id_num' => $n,
                               'mous_remaks' => $r
                           ));
                      }
                 }
            }

            //Refurbishment.
            if (!empty($RF) && isset($RF['complaints'])) {
                 $count = count($RF['complaints']);
                 for ($i = 0; $i < $count; $i++) {
                      $c = isset($RF['complaints'][$i]) ? $RF['complaints'][$i] : 0; //complaints
                      $n = isset($RF['works'][$i]) ? $RF['works'][$i] : 0; //works
                      $r = isset($RF['remarks'][$i]) ? $RF['remarks'][$i] : 0; //remarks
                      if (!empty($c) && !empty($n)) {
                           $this->db->insert($this->tbl_mou_rf, array(
                               'mour_master' => $masterId,
                               'mour_complaints' => $c,
                               'mour_rf_to_done' => $n,
                               'mour_remarks' => $r
                           ));
                      }
                 }
            }
       }

       function getPurchaseStaff() {
            //81 - Purchase Head - North Kerala
            //22 - Purchase Manager
            //24 - Assistant Manager Purchase
            //40 - Area Manager - Purchase
            //35 - Purchase Executive
            //69 - Sr. Purchase Executive
            //64 - Evaluator Sourcer

            return $this->db->select($this->tbl_users . '.usr_id,' .
                                    $this->tbl_users . '.usr_username,' .
                                    $this->tbl_showroom . '.shr_location,' .
                                    $this->tbl_designation . '.desig_title', false)
                            ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users . '.usr_showroom', 'left')
                            ->join($this->tbl_designation, $this->tbl_designation . '.desig_id = ' . $this->tbl_users . '.usr_designation_new', 'left')
                            ->where_in($this->tbl_users . '.usr_designation_new', array(81, 22, 24, 40, 35, 69, 64))
                            ->where(array($this->tbl_users . '.usr_active' => 1, $this->tbl_users . '.usr_resigned' => 0))
                            ->order_by('usr_username')->get($this->tbl_users)->result_array();
       }

       function approval($id) {
            $data['moum_approved_on'] = date('Y-m-d H:i:s');
            $data['moum_approved_by'] = $this->uid;
            $this->db->where('moum_id', $id)->update($this->tbl_mou_master, $data);
            return true;
       }

       function getAllRecords() {

            if (check_permission('mou', 'mou_view_smart')) {
                 $this->db->where($this->tbl_mou_master . '.moum_division', 1);
            } else if (check_permission('mou', 'mou_view_luxury')) {
                 $this->db->where($this->tbl_mou_master . '.moum_division', 2);
            } else if (check_permission('mou', 'mou_view_self')) {
                 $this->db->where($this->tbl_mou_master . '.moum_added_by', $this->uid);
            } else if (check_permission('mou', 'mou_view_my_showroom')) {
                 $this->db->where($this->tbl_mou_master . '.moum_showroom', $this->shrm);
            } else if (check_permission('mou', 'mou_view_my_staff')) {
                 $mystaff = my_staff($this->uid);
                 $this->db->where_in($this->tbl_mou_master . '.moum_added_by', $mystaff);
            } else if (check_permission('mou', 'mou_view_all')) {
                 
            }

            $return = $this->db->select($this->tbl_mou_master . '.*,' . $this->tbl_district_statewise . '.*,' .
                                    $this->tbl_brand . '.brd_title,' . $this->tbl_model . '.mod_title,' . $this->tbl_variant . '.var_variant_name,' .
                                    $this->tbl_users . '.usr_username,' . $this->tbl_designation . '.desig_title,' .
                                    $this->tbl_showroom . '.shr_location,' . $this->tbl_divisions . '.div_name')
                            ->join($this->tbl_district_statewise, $this->tbl_district_statewise . '.std_id = ' . $this->tbl_mou_master . '.moum_dist', 'LEFT')
                            ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_mou_master . '.moum_brand', 'LEFT')
                            ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_mou_master . '.moum_model', 'LEFT')
                            ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_mou_master . '.moum_varient', 'LEFT')
                            ->join($this->tbl_users, $this->tbl_users . '.usr_id = ' . $this->tbl_mou_master . '.moum_pur_staff', 'LEFT')
                            ->join($this->tbl_designation, $this->tbl_designation . '.desig_id = ' . $this->tbl_users . '.usr_designation_new', 'LEFT')
                            ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_mou_master . '.moum_showroom', 'LEFT')
                            ->join($this->tbl_divisions, $this->tbl_divisions . '.div_id = ' . $this->tbl_mou_master . '.moum_division', 'LEFT')
                            ->get_where($this->tbl_mou_master)->result_array();
            return $return;
       }

  }
  