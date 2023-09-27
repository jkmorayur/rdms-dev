<?php
require APPPATH . '/libraries/JWT.php';
class ProcessJwt
{
  

    //////////The function generate token/////////////
    PRIVATE $key = "1237"; 
    public function GenerateToken($data)
    {         
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }
   


   //////This function decode the token////////////////////
    public function DecodeToken($token)
    {         
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }
}
?> 