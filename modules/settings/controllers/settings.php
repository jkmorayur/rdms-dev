<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class settings extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->load->model('settings_model');
            $this->page_title = 'General Settings';
       }

       function general_settings() {
            $data['downldcallstpend'] = $this->settings_model->getDownloadCallListPendning();
            $this->section = 'General Settings';
            $this->page_title = 'General Settings';
            $this->render_page(__CLASS__ . '/index', $data);
       }

       function insert() {
            if (!empty($_FILES) && isset($_FILES['site_logo'])) {
                 $newFileName = rand(9999999, 0) . $_FILES['site_logo']['name'];
                 $config['upload_path'] = './assets/uploads/admin_logo';
                 $config['allowed_types'] = 'gif|jpg|png';
                 $config['file_name'] = $newFileName;
                 $this->load->library('upload');
                 $this->upload->initialize($config);

                 $angle['x1']['0'] = $_POST['x1'];
                 $angle['x2']['0'] = $_POST['x2'];
                 $angle['y1']['0'] = $_POST['y1'];
                 $angle['y2']['0'] = $_POST['y2'];
                 $angle['w']['0'] = $_POST['w'];
                 $angle['h']['0'] = $_POST['h'];

                 if (!$this->upload->do_upload('site_logo')) {
                      $up = array('error' => $this->upload->display_errors());
                 } else {
                      $data = $this->upload->data();
                      $_POST['settings']['site_logo'] = $data['file_name'];
                      crop($data, $angle);
                 }
            }
            $this->settings_model->newSettings($this->input->post('settings'));
            $this->session->set_flashdata('app_success', 'Settings successfully updated!');
            redirect(strtolower(__CLASS__) . '/general_settings');
       }

       function removeSettings($key) {
            if ($key && $this->settings_model->dropSettingsByKey($key)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Logo successfully deleted'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't delete logo"));
            }
       }

       function database_backup() {
            $this->section = 'Database backup';
            $this->page_title = 'Database backup';
            $this->render_page(__CLASS__ . '/backupdb');
       }

       function doBckupdb() {
            $this->load->dbutil();
            $backup = $this->dbutil->backup();
            $this->load->helper('file');
            $fileName = date('d-m-Y') . '_' . time();
            if (write_file(UPLOAD_PATH . 'db_backup/' . $fileName . '.gz', $backup)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Database backup successfully completed'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't take database backup"));
            }
       }

       function downloadpbxcalllist() {
          $recordsList = $this->settings_model->getCallList();
          $records = implode(array_column($recordsList, 'ccb_recording_URL'), "\n");

          $file = "./assets/records.txt";
          $txt = fopen($file, "w") or die("Unable to open file!");
          fwrite($txt, $records);
          fclose($txt);

          header('Content-Description: File Transfer');
          header('Content-Disposition: attachment; filename=' . basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          header("Content-Type: text/plain");
          readfile($file);
     }
  }
  