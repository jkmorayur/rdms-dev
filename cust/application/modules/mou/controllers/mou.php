<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class mou extends App_Controller {

       public function __construct() {

            parent::__construct();
            $this->page_title = 'MOU Generation';
            $this->load->model('mou_model', 'mou');
       }

       function view($id) {
            $this->template->set_layout('mou');
            $data['datas'] = $this->mou->getMou($id);
            
            if(!empty($data['datas'])) {
               $data['id'] = $data['datas']['master']['moum_id'];
               $data['view'] = $this->load->view(strtolower(__CLASS__) . '/print', $data, true);
               $this->render_page(strtolower(__CLASS__) . '/mouview', $data);
            } else {
               redirect('pnf');
            }
       }
       
       function approval($id) {
            if ($f = $this->mou->approval($id)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Product status successfully changed'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't change product status"));
            }
       }
  }