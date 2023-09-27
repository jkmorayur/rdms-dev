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
  require APPPATH . '/libraries/REST_Controller.php';

  class rest extends REST_Controller {

       public function __construct() {
            parent::__construct();
            $this->load->model('api_logic/advanced');
       }

       /* function users_get()
         {
         //$users = $this->some_model->getSomething( $this->get('limit') );
         $users =array(
         array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
         array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
         array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com'),
         );

         if($users)
         {
         $this->response($users, 200); // 200 being the HTTP response code
         }

         else
         {
         $this->response(array('error' => 'Couldn\'t find any users!'), 404);
         }
         } */

       public function login_post() {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            $search = $this->advanced->getVariant($params['identity'], $params['password']);
            if ($search) {
                 $this->response($search, 200); // 200 being the HTTP response code
            } else {
                 $this->response(array('error' => 'Couldn\'t find any any matching variant!'), 404);
            }
       }
       
       
       /////jwt
       
       public function user_post()
	{  
		$array  = array('status'=>'ok','data'=>1);
		$this->response($array); 
	}
	public function record_post()
	{  
		$array  = array('status'=>'ok','data'=>'post api');
		$this->response($array); 
	}
	
	public function register_post()
	{   
		$token_data['user_id'] = 121;
		$token_data['fullname'] = 'code'; 
		$token_data['email'] = 'code@gmail.com';

		$tokenData = $this->authorization_token->generateToken($token_data);

		$final = array();
		$final['token'] = $tokenData;
		$final['status'] = 'ok';
 
		$this->response($final); 

	}
	public function verify_post()
	{  
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		$this->response($decodedToken);  
	}


      
      
  } 