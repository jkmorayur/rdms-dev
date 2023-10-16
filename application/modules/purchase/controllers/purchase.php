<?php

defined('BASEPATH') or exit('No direct script access allowed');

class purchase extends App_Controller
{

     public function __construct()
     {

          parent::__construct();
          $this->page_title = 'Purchase';
          $this->load->model('purchase_model', 'purchase');
          $this->load->model('followup/followup_model', 'followup');
     }

     public function index()
     {
          $this->render_page(strtolower(__CLASS__) . '/list');
     }
     public function list_ajax()
     {


          $response = $this->purchase->getPurcasePaginate($this->input->post());
          //  debug( $response);
          echo json_encode($response);
     }
     public function create($enq_id = '', $val_id)
     {  //debug($enq_id);
          $data['purchase_data'] = $this->purchase->getData($val_id);
      //    print_r($data); exit;
     //    debug( $data);
          $data['enq_id'] = $enq_id;
          $data['val_id'] = $val_id;

          $this->render_page(strtolower(__CLASS__) . '/view', $data);
     }

     public function add()
     {
          if (!empty($_POST)) {

               if ($this->purchase->insert($_POST)) {

                    $data['enh_enq_id'] = $_POST['pr_enq_id'];
                    $data['quickfollowup'] = '';
                    $data['cb'] = '';
                    $data['enh_status'] = 6;
                    $data['enh_booked_vehicle'] = $_POST['pr_val_id']; //val_id
                    $data['enh_booking_amt'] = $_POST['pr_total'];
                    $data['enh_remarks'] = 'wwsewqe';
                    $this->changeStatus($data);
                    $this->session->set_flashdata('app_success', 'Successfully added!');
               }
          }


          redirect(strtolower(__CLASS__));
     }

     function changeStatus($data)
     {
          //debug($data);
          $cb = isset($data['cb']) ? $data['cb'] : '';
          unset($data['cb']);
          if (isset($data['quickfollowup'])) {
               $msg = isset($data['enh_remarks']) ? $data['enh_remarks'] : '';
               $this->followup->removeRow($data['quickfollowup'], $msg);
               unset($data['quickfollowup']);
          }
          if ($this->followup->changeStatus($data)) {

               $msg = isset($data['enh_remarks']) ? $data['enh_remarks'] : '';
               $enqId = isset($data['enh_enq_id']) ? $data['enh_enq_id'] : '';

               $status = $this->common_model->getStatusById($data['enh_status']);
               $stsmsg = isset($status['sts_des']) ? $status['sts_des'] : '';

               if ($enqId > 0) {
                    $this->followup->updateComments(array(
                         'foll_is_cmnt' => 1, 'foll_remarks' => $msg . ' ' . $stsmsg,
                         'foll_cus_id' => $enqId, 'foll_parent' => 0
                    ));
               }
          }
     }



     public function updateApproval()
     {
          //  debug($_POST);
          if (!empty($_POST)) {
               $this->purchase->updateApproval($_POST);
               $message = 'successfully Added!';
               echo json_encode($message);
          }
     }

     public function approved()
     {
          $this->render_page(strtolower(__CLASS__) . '/list_approved');
     }
     public function approved_list_ajax()
     {
          $response = $this->purchase->getApprovedPaginate($this->input->post());

          echo json_encode($response);
     }

     public function edit($id = '')
     {
          $data['mou_data'] = $this->purchase->geData();
          $data['purchase'] = $this->purchase->gePurchaseData($id);
          //debug($data);
          $this->render_page(strtolower(__CLASS__) . '/edit', $data);
     }
     public function update()
     {
          //  debug($_POST);
          if (!empty($_POST)) {
               if ($this->purchase->update($_POST)) {
                    $this->session->set_flashdata('app_success', 'Successfully added!');
               }
          }
          redirect(strtolower(__CLASS__));
     }
     public function get_column_names() {
          $table_name = 'cpnl_purchase';
      
          $sql = "DESCRIBE $table_name";
      
          $query = $this->db->query($sql);
      
          // Check if the query was successful
          if ($query) {
              $result = $query->result();
      
              // Extract and display the column names and data types
              foreach ($result as $row) {
                  echo $row->Field . " (" . $row->Type . ")<br>";
              }
          } else {
              echo "Error fetching column names: " . $this->db->error();
          }
      }
      

      public function add_pr_new_field() {//db
         // echo $this->div;  
         // exit;
         // $sql = "ALTER TABLE cpnl_purchase ADD pr_approve_remarks TEXT";
         //$sql = "ALTER TABLE cpnl_purchase CHANGE moum_division pr_division INT";
         $sql = "ALTER TABLE cpnl_purchase CHANGE pr_val_type pr_val_type INT";
        
         $sql = "ALTER TABLE cpnl_purchase
         ADD pr_sourcing_type int";
  
          // Execute the SQL query
          $this->db->query($sql);
  
          // Check if the query was successful
          if ($this->db->affected_rows() > 0) {
              echo "Field 'pr_val_type' added successfully.";
          } else {
              echo "Error adding field: " . $this->db->error();
          }
      }
      
      public function purchase_api(){
          $data=$this->purchase->purchaseApi();
          debug($data);

      }
}
