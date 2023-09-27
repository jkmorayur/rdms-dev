<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class admin extends REST_Controller
{



  public function __construct(){
      parent::__construct();
       $this->load->model('modeladmin/update');

     }


public function approved_get(){

    $data['cars'] = $this->update->approved();
           // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);

}

public function unapproved_get(){

    $data['cars'] = $this->update->unapproved();
           // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);

}





   public function approve_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
          $return = $this->update->approve($params['prd_id']);

 
    if(!$return)
        {
                      $this->response(array('error' => 'unknown'), 400);

        }

       else
        {
                      $this->response(array('post' => 'approved'), 200);

        }
    }



   public function unapprove_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
          $return = $this->update->unapprove($params['prd_id']);

 
    if(!$return)
        {
                      $this->response(array('error' => 'unknown'), 400);

        }

       else
        {
                      $this->response(array('post' => 'unapproved'), 200);

        }
    }






}