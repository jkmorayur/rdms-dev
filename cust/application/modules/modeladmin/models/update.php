<?php






  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class update extends CI_Model {

       public function __construct() {
            parent::__construct();
             $this->load->database();
            $this->tbl_brands = TABLE_PREFIX . "brand";
            $this->tbl_products = TABLE_PREFIX . "products";
            $this->tbl_products_image = TABLE_PREFIX . "prod_images";
            $this->tbl_products_specification = TABLE_PREFIX . "prod_specifications";
            $this->tbl_model = TABLE_PREFIX . "model";
            $this->tbl_variant = TABLE_PREFIX . "variant";
            $this->tbl_prod_features= TABLE_PREFIX . "prod_features";
            $this->tbl_features= TABLE_PREFIX . "features";
            $this->tbl_users= TABLE_PREFIX . "users";


       }




function approved() {

$this->db->select('prd_id,mod_title,brd_title,prd_year,prd_color,prd_price AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", '.', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands,'brd_id = prd_brand','right');
            $this->db->join($this->tbl_model,'mod_id = prd_model','right');
            $this->db->join($this->tbl_products_image,'pdi_prod_id = prd_id','right');
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";

            $this->db->where($where);

            $this->db->order_by('prd_id');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();
            } return $vechicles;
                 

}

function unapproved() {

$this->db->select('prd_id,mod_title,brd_title,prd_year,prd_color,prd_price AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", '.', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands,'brd_id = prd_brand','right');
            $this->db->join($this->tbl_model,'mod_id = prd_model','right');
            $this->db->join($this->tbl_products_image,'pdi_prod_id = prd_id','right');
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='0'";

            $this->db->where($where);

            $this->db->order_by('prd_id');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();
            } return $vechicles;
                 

}



 function approve($prd_id) {
            if ($prd_id!=null) {

                  //$password = get_hashed_password($password);
                  $array = array('prd_id' => $prd_id, 'prd_status' => '0');

                                   $this->db->where($array);
                                  //$this->db->where('id', $userid);


              $result = $this->db->select('*')->from($this->tbl_products)->get()->row_array();
               if (!empty($result)) {
               $result = array('prd_status'=>'1'); 
                                   $this->db->where($array);
                                  $status= $this->db->update($this->tbl_products, $result);
                                  return true;
                                  }
              return false;


                                    }
                      else{
              return false;
                           }


     }



 function unapprove($prd_id) {
            if ($prd_id!=null) {

                 // $password = get_hashed_password($password);
                  $array = array('prd_id' => $prd_id, 'prd_status' => '1');

                                   $this->db->where($array);
                                  //$this->db->where('id', $userid);


              $result = $this->db->select('*')->from($this->tbl_products)->get()->row_array();
               if (!empty($result)) {
               $result = array('prd_status'=>'0'); 
                                   $this->db->where($array);
                                  $status= $this->db->update($this->tbl_products, $result);
                                  return true;
                                  }
              return false;


                                    }
                      else{
              return false;
                           }


     }

















}