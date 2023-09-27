<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

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


class messaging extends REST_Controller
{



  public function __construct(){
      parent::__construct();
        $this->load->model('api_logic/message');

     }



     public function addtoken_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->message->updatetoken($params['id'],$params['fcmtoken']);

    if($search)
        {
            $this->response(array('status' => 'token updated'), 200);
        }

       else
        {
            $this->response(array('error' => 'Couldn\'t find any any matching user!'), 404);
        }
    }

public function addmessage_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
      $msg =$params['message'];
          $search = $this->message->newmessage($params['id'],$params['message'],$params['sender']);
          $admin_id="30"; ///admin
          $tokenuser = $this->message->tokensearch($params['id']);
          $tokenadmin = $this->message->tokensearch("$admin_id");
          $email = $this->message->emailsearch($params['id']);
if(($params['sender'])=="0")
{ 
    $token = $tokenuser;
}
if(($params['sender'])=="1"){
      $token = $tokenadmin;

}

 $aa=array(
   'to' => $token,
   'notification' => 
 (array(
     'body' => $params['message'],
     'title' => $email,
      'sound' => 'default',
  )),
   'data' => 
 (array(
     'chatid' => $params['id'],
     'sender' => $params['sender'],
  )),
);
     $new= json_encode($aa);
          $this->load->library('HttpClient');

       $this->httpclient->setOptions(
     array(
  'headers' => array(
     'Authorization: key=AAAAE7X_chE:APA91bHqKh6VTcnxul3lmV_j22X5flaovzs7dFgCX5Q-iAOjKPXC5ydhSqD_2qE-4ot8poW-U6byixKpbOYcaDWUAKhQ9EM1wcLqvSyuxUDKk19JGWvL59ot5XE86Vo5CZUOibF9Zt_B',
         'Content-Type: application/json',
  ),
  'data' => $new,
  'url' => 'https://fcm.googleapis.com/fcm/send',
)
  );
          




    if($search && $this->httpclient->post())
        {
            $this->response(array('status' => 'sucess'), 200);
        }

       else
        {

            $this->response(array('error' => 'error sending message'), 404);
        }
             //  $this->load->library('HttpClient');

 
    }


public function chatrooms_get(){

    $data['chatrooms'] = $this->message->getchatrooms();
           // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            
if(!$this->message->getchatrooms())
{
 $this->response(array('error' => 'no data'), 404);

}
else{
echo json_encode($data);
}
}


public function chatmessage_post($num){
      $params = json_decode(file_get_contents('php://input'), TRUE);

    $data= $this->message->chats($params['chatroom_id']);
           // header("Set-Cookie: ci_session= no session_commit()");
            //header('Access-Control-Allow-Origin: *');
            echo json_encode($data);
}



public function deletechat_post($num){
      $params = json_decode(file_get_contents('php://input'), TRUE);

    $data= $this->message->deleteroom($params['chatroom_id']);
 if($data){
           $this->response(array('status' => 'sucess','message' => 'all message for '.$params['chatroom_id']." cleared"), 200);
}
else
{
          $this->response(array('error' => 'error deleting'), 404); 
}


       
}



 public function deletetoken_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
          $search = $this->message->deletetoken($params['id']);

    if($search)
        {
            $this->response(array('status' => 'token deleted'), 200);
        }

       else
        {
            $this->response(array('error' => 'Couldn\'t delete'), 404);
        }
    }







public function notification_post() {
      $params = json_decode(file_get_contents('php://input'), TRUE);
      $msg =$params['message'];
            $title =$params['title'];

         // $search = $this->message->newnotification($params['message']);


 $aa=array(
   'to' => "duzlpc5VR4A:APA91bEe4co-HdppTMDTa-ezaq7U9-hx0wYWZXZactai9gOrUi_qwaqyObEr7GmDYrEH56JMfh3lBmbQYXkbx_nT2gEAFU97_7AViKcLtAq75cNNGN3MCLcz-DGx83ezwF4tX4Cqa0-g",
   'notification' => 
 (array(
     'body' => $msg,
     'title' => $title,
  ))
);
     $new= json_encode($aa);
          $this->load->library('HttpClient');

       $this->httpclient->setOptions(
     array(
  'headers' => array(
     'Authorization: key=AAAAO75BXJI:APA91bFfMPgiRHHww4xrkpqHwiPDEQuZzi6wPYho5_M_Hv6A35iM2c57uV4tJTQGLryOoDW_BMZPNWkjti1BIPvn0vy8OCJH3xdk9LGTDwULKR-20IFu48C-Vy26IBm9gEEY815xh6tj',
         'Content-Type: application/json',
  ),
  'data' => $new,
  'url' => 'https://fcm.googleapis.com/fcm/send',
)
  );
          




    if($this->httpclient->post())
        {
            $this->response(array('status' => 'sucess'), 200);
        }

       else
        {

            $this->response(array('error' => 'error sending message'), 404);
        }
             //  $this->load->library('HttpClient');

 
    }



















}