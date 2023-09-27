<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class User_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'users';
            $this->children = array();
       }

       public function getUser($id) {
            $this->db->select('*');
            $this->db->from($this->table);
            if (!empty($id)) {
                 $this->db->where('id', $id);
                 $user = $this->db->get()->row_array();
            } else {
                 $user = $this->db->get()->result_array();
            }
            return $user;
       }

       public function newUser($datas) {
            unset($datas['persistent_remember_me']);
            unset($datas['password_confirmation']);
//            $datas['username'] = $datas['first_name'];
            $datas['password'] = get_hashed_password($datas['password']);
            if ($this->db->insert($this->table, $datas)) {
                 $userId = $this->db->insert_id();
                 $datas['user_id'] = $userId;
                 $datas['is_default_add'] = 1;
                 $datas['is_shipping_add'] = 1;
                 $datas['is_billing_add'] = 1;
                 //$this->db->insert('gtech_address_book', $datas);
                 return true;
            } else {
                 return false;
            }
       }

       function getUserByEmail($email) {
            if ($email) {
                 $this->db->where('email', trim($email));
                 return $this->db->get($this->table)->row_array();
            } else {
                 return null;
            }
       }

       function checkLogin($data) {
            if (!empty($data)) {
                 $uname = trim($data['username']);
                 $paswd = get_hashed_password($data['password']);
                 $this->db->where('email', $uname);
                 $this->db->where('password', $paswd);
                 $result['gtech_logged_user'] = $this->db->select('*')->from($this->table)->get()->row_array();
                 if (!empty($result['gtech_logged_user'])) {
                      unset($result['gtech_logged_user']['password']);
                      $this->session->set_userdata($result);
                      return true;
                 } else {
                      return false;
                 }
            } else {
                 return false;
            }
       }

       function editUser($data, $id) {
            if (!empty($data) && !empty($id)) {
                 $this->db->where('id', $id);
                 if ($this->db->update($this->table, $data)) {
                      return true;
                 } else {
                      return false;
                 }
            } else {
                 return false;
            }
       }

       function getBillingAddressBook() {

            $userId = get_logged_user('id');
            $this->db->select('gtech_address_book.id AS add_id, gtech_address_book.*, gtech_state_province.*,  gtech_country.*')->from('gtech_address_book');
            $this->db->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left');
            $this->db->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left');
            $this->db->where('gtech_address_book.is_default_add', 1);
            $this->db->where('gtech_address_book.user_id', $userId);
            $addressBook['default'] = $this->db->get()->row_array();

            $this->db->select('gtech_address_book.id AS add_id, gtech_address_book.*, gtech_state_province.*,  gtech_country.*')->from('gtech_address_book');
            $this->db->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left');
            $this->db->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left');
            $this->db->where('gtech_address_book.is_default_add <> ', 1);
            $this->db->where('gtech_address_book.user_id', $userId);
            $addressBook['nonDefault'] = $this->db->get()->result_array();
            return $addressBook;
       }

       function addNewAddress($datas, $id) {
            if (!empty($datas) && !empty($id)) {
                 $datas['user_id'] = $id;
                 $this->db->insert('gtech_address_book', $datas);
                 return $this->db->insert_id();
            } else {
                 return false;
            }
       }

       function getAddress($id = '') {
            if ($id) {
                 $this->db->select('gtech_address_book.id AS add_id, gtech_address_book.*, gtech_state_province.*,  gtech_country.*')->from('gtech_address_book');
                 $this->db->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left');
                 $this->db->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left');
                 $this->db->where('gtech_address_book.id', $id);
                 return $this->db->get()->row_array();
            } else {
                 return null;
            }
       }

       function updateAddress($data) {
            if (!empty($data)) {
                 $id = $data['id'];
                 unset($data['id']);
                 $this->db->where('id', $id);
                 if ($this->db->update('gtech_address_book', $data)) {
                      return true;
                 } else {
                      return false;
                 }
            }
       }

       function deleteAddress($id) {
            if ($id) {
                 $this->db->where('id', $id);
                 $this->db->delete('gtech_address_book');
                 return true;
            } else {
                 return false;
            }
       }

       function getBillingAddress($userId) {
            if ($userId) {
                 $this->db->select('gtech_address_book.id AS add_id, gtech_address_book.*, gtech_state_province.*,  gtech_country.*')->from('gtech_address_book');
                 $this->db->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left');
                 $this->db->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left');
                 $this->db->where('gtech_address_book.user_id', $userId);
                 $this->db->where('gtech_address_book.is_billing_add', 1);
                 return $this->db->get()->result_array();
            } else {
                 return null;
            }
       }

       function getShippingAddress($userId) {
            if ($userId) {
                 $this->db->select('gtech_address_book.id AS add_id, gtech_address_book.*, gtech_state_province.*,  gtech_country.*')->from('gtech_address_book');
                 $this->db->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left');
                 $this->db->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left');
                 $this->db->where('gtech_address_book.user_id', $userId);
                 $this->db->where('gtech_address_book.is_shipping_add', 1);
                 return $this->db->get()->result_array();
            } else {
                 return null;
            }
       }

       function addNewOrder($datas, $cart) {
            if ($datas) {
                 $this->db->insert('gtech_orders', $datas);
                 $orderSerial = $this->db->insert_id();
                 if ($cart) {
                      foreach ($cart as $items) {

                           $orderProduct['orp_order_id'] = $orderSerial;
                           $orderProduct['orp_prod_id'] = $items['id'];
                           $orderProduct['orp_qty'] = $items['qty'];
                           $orderProduct['orp_unit_price'] = $items['price'];
                           $orderProduct['orp_grand_total'] = $items['price'] * $items['qty'];
                           $this->db->insert('gtech_orders_products', $orderProduct);
                      }
                 }
            }
            return true;
       }

       function getOrderByUser($userId) {
            if ($userId) {
                 return $this->db->select('*')->from('gtech_orders')->where('ord_user_id', $userId)
                                 ->get()->result_array();
            } else {
                 return null;
            }
       }

       function getOrder($userId, $orderId) {
            if ($userId && $orderId) {
                 $return['order'] = $this->db->select('*')->from('gtech_orders')
                                 ->where('ord_user_id', $userId)
                                 ->where('odr_serial', $orderId)
                                 ->get()->row_array();

                 $return['product_info'] = '';
                 $product_info = $this->db->select('gtech_orders_products.*, gtech_products.*, gtech_brand.*')
                                 ->from('gtech_orders_products')
                                 ->join('gtech_products', 'gtech_products.prd_id = gtech_orders_products.orp_prod_id', 'left')
                                 ->join('gtech_brand', 'gtech_products.prd_brand = gtech_brand.brd_id', 'left')
                                 ->where('orp_order_id', $orderId)
                                 ->get()->result_array();

                 if (!empty($product_info)) {
                      foreach ($product_info as $key => $value) {
                           $value['product_images'] = $this->getProductImages($value['prd_id']);
                           $return['product_info'][] = $value;
                      }
                 }
                 $return['shipping_address'] = '';
                 $return['billing_address'] = '';
                 if (isset($return['order']['ord_shipping_id'])) {
                      $return['shipping_address'] = $this->db->select('gtech_address_book.*, gtech_address_book.id as add_id, gtech_country.*, gtech_state_province.*')
                                      ->from('gtech_address_book')->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left')
                                      ->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left')
                                      ->where('gtech_address_book.id', $return['order']['ord_shipping_id'])
                                      ->get()->row_array();
                 }
                 if (isset($return['order']['ord_billing_id'])) {
                      $return['billing_address'] = $this->db->select('gtech_address_book.*, gtech_address_book.id as add_id, gtech_country.*, gtech_state_province.*')
                                      ->from('gtech_address_book')->join('gtech_country', 'gtech_country.ctr_id = gtech_address_book.country', 'left')
                                      ->join('gtech_state_province', 'gtech_state_province.id = gtech_address_book.state', 'left')
                                      ->where('gtech_address_book.id', $return['order']['ord_billing_id'])
                                      ->get()->row_array();
                 }
                 return $return;
            } else {
                 return null;
            }
       }

       function getProductImages($pid) {
            return $this->db->select('*')->from('gtech_prod_images')
                            ->where('pdi_prod_id', $pid)->get()->result_array();
       }

       function newUserLog() {
            $data['log_user_id'] = get_logged_user('id');
            $this->db->insert(TABLE_PREFIX . 'login_log', $data);
       }
  }
?>