<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require './rdportal/vendors/aws-vendor/autoload.php';
class aws extends App_Controller {

     public function __construct() {
          parent::__construct();
          //$this->load->model('s3_model', 'blog');
     }

     public function index() {
          $data['blogList'] = $this->blog->getBlog();
          $this->render_page(strtolower(__CLASS__) . '/list', $data);
     }

     public function add() {
          error_reporting(E_ALL);
          if (!empty($_POST)) {
               debug($_POST, 0);
               debug($_FILES, 0);
               $this->load->library('upload');
               $x1 = $this->input->post('x1');
               
               $fileCount = count($x1); 
               $up = array();
               if (isset($_FILES['image']['name'][0])) {
                    for ($j = 0; $j < $fileCount; $j++) {
                         /**/
                         $data = array();
                         $angle = array();
                         $newFileName = rand(9999999, 0) . $_FILES['image']['name'][$j];
                         $config['upload_path'] = FILE_UPLOAD_PATH . 'tmp/';
                         $config['allowed_types'] = 'gif|jpg|png';
                         $config['file_name'] = $newFileName;
                         $this->upload->initialize($config);

                         $angle['x1']['0'] = $_POST['x1'][$j];
                         $angle['x2']['0'] = $_POST['x2'][$j];
                         $angle['y1']['0'] = $_POST['y1'][$j];
                         $angle['y2']['0'] = $_POST['y2'][$j];
                         $angle['w']['0'] = $_POST['w'][$j];
                         $angle['h']['0'] = $_POST['h'][$j];

                         $_FILES['prd_image_tmp']['name'] = $_FILES['image']['name'][$j];
                         $_FILES['prd_image_tmp']['type'] = $_FILES['image']['type'][$j];
                         $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['image']['tmp_name'][$j];
                         $_FILES['prd_image_tmp']['error'] = $_FILES['image']['error'][$j];
                         $_FILES['prd_image_tmp']['size'] = $_FILES['image']['size'][$j];

                         $file_name = rand(9999999, 0) . $_FILES['prd_image_tmp']['name'];
                         $temp_file_location = $_FILES['prd_image_tmp']['tmp_name'];
                         
                         $mydir = './assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;

                         echo '<img src="' . $mydir . '380X238_8345747WhatsApp_Image_2021-08-06_at_2.16_.29_PM_(1)_.jpeg"/>';
                         //$this->s3->putObjectFile($mydir . '380X238_8345747WhatsApp_Image_2021-08-06_at_2.16_.29_PM_(1)_.jpeg', 'royaldrive', 'test/' . $file_name);
                         $s3 = new Aws\S3\S3Client([
                                   'region' => 'ap-south-1',
                                   'version' => 'latest',
                                   'credentials' => [
                                        'key' => "AKIAS4CD2OOUQZJNMDXG",
                                        'secret' => "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",
                         ]]);
                         
                         try {
                              $s3->putObject([
                                   'Bucket' => 'royaldrive',
                                   'Key' => 'test/' . $file_name,
                                   'Body' => fopen($mydir . '380X238_8345747WhatsApp_Image_2021-08-06_at_2.16_.29_PM_(1)_.jpeg', 'r'), 
                                   'ACL' => 'public-read',
                              ]);
                         } catch (Aws\S3\Exception\S3Exception $e) {
                              echo "There was an error uploading the file.\n";
                              echo $e;
                         }
                    }
               }
               $this->session->set_flashdata('app_success', 'News successfully added!');
          } else {
               $this->render_page(strtolower(__CLASS__) . '/add');
          }
     }

     function download() { 
          error_reporting(1);
          error_reporting(E_ALL);
          $this->load->library('zip');
          $keyPath = array('75851805copy.jpg', 'cell_car3.jpg');
          $files_to_zip = array();
          //S3 connection 
          try {
               $s3 = new Aws\S3\S3Client([
                    'region' => 'ap-south-1',
                    'version' => 'latest',
                    'credentials' => [
                         'key' => "AKIAS4CD2OOUQZJNMDXG",
                         'secret' => "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",
               ]]);
               
               foreach ($keyPath as $f) {

                    $result = $s3->getObject(array(
                         'Bucket' => 'royaldrive',
                         'Key'    => urldecode('test/' . $f),
                         'SaveAs' => './assets/uploads/tmp/'. $f
                    ));

                    $this->zip->read_file('./assets/uploads/tmp/' . $f);
                    unlink('./assets/uploads/tmp/' . $f);     
               }

               $this->zip->download('test.zip');

               // $result = $s3->getObject(array(
               //      'Bucket' => 'royaldrive',
               //      'Key'    => $keyPath
               // ));
               
               // echo $result['Body'];
               // $this->zip->read_file($result);
               // $this->zip->download('test.zip');
               // echo 'Here';
               // echo '<pre>';
               // print_r($result);

               // header("Content-Type: {$result['ContentType']}");
               // header('Content-Disposition: filename="' . basename($keyPath) . '"');
               // echo $result['Body'];
          } catch (Exception $e) {
               die("Error: " . $e->getMessage());
          }
     }
}