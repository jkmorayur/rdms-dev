<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class seo_analytics_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->tbl_seo_pages = TABLE_PREFIX_PORTAL . 'seo_pages';
            $this->tbl_seo_analytics = TABLE_PREFIX_PORTAL . 'seo_analytics';
            $this->tbl_seo_hit_analytics = TABLE_PREFIX_PORTAL . 'seo_hit_analytics';
       }
       
       function getPageTitleAndMetaDescription($cntrlr) {
            if(!empty($cntrlr)) {
                 return $this->db->get_where($this->tbl_seo_pages, array('seop_controllers' => trim($cntrlr)))->row_array();
            }
            return false;
       }
       
       function pageHit($cntrlr) {
            $this->load->library('user_agent');
            $ip = $this->input->ip_address();
            $userAgent = $this->agent->agent;
            
            $pageDetails = $this->getPageTitleAndMetaDescription($cntrlr);
            $pageId = isset($pageDetails['seop_id']) ? $pageDetails['seop_id'] : 0;
            $hitArray = array(
                'seoa_page_id' => $pageId,
                'seoa_section' => '',
                'seoa_ip' => $ip,
                'seoa_user_agent' => $userAgent,
                'seoa_added_on' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->tbl_seo_analytics, $hitArray);
            return true;
       }

       function hitCounter($data) {
          if (!empty($data)) {
               $this->load->library('user_agent');
               $data['sha_ip'] = $this->input->ip_address();
               $data['sha_usr_agent'] = $this->agent->agent;
               $data['sha_date'] = date('Y-m-d H:i:s');
               $this->db->insert($this->tbl_seo_hit_analytics, $data);
               return true;
          }
          return false;
     }
  }