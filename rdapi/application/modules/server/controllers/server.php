<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class server extends App_Controller {
       public function __construct() {
            parent::__construct();
       }

       function index() {
          $host = '45.249.170.209';
          $port = 95;
          $username = 'root';
          $password = 'DG%E6s$#sd5q@%^$ES5ARQq@';
          
          $connection = ssh2_connect($host, $port);
          ssh2_auth_password($connection, $username, $password);
          
          $stream = ssh2_exec($connection, 'df -h');
          stream_set_blocking($stream, true);
          $output = stream_get_contents($stream);
          print_r($output);     
          exit;

          $this->template->set_layout('mou');
          $this->render_page(strtolower(__CLASS__) . '/index');
       }

       function checkStatus() {
          error_reporting(E_ALL);
          error_reporting(1);
          $host = '45.249.170.209';
          $port = 95;
          $username = 'root';
          $password = 'DG%E6s$#sd5q@%^$ES5ARQq@';
          
          $connection = ssh2_connect($host, $port);
          ssh2_auth_password($connection, $username, $password);
          
          $stream = ssh2_exec($connection, 'asterisk -rx "sip show registry"');
          stream_set_blocking($stream, true);
          $output = stream_get_contents($stream);
          print_r($output);     
          exit;
          die(json_encode($output));
       }

       function startServer() {

       }
  }