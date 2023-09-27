<?php

if (!defined('BASEPATH'))
     exit('No direct script access allowed');

class Product_model extends CI_Model
{

     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->db->query("SET time_zone = '+05:30'");

          $this->table = TABLE_PREFIX_RANA . 'products';
          $this->tbl_brand = TABLE_PREFIX_RANA . 'brand';
          $this->tbl_model = TABLE_PREFIX_RANA . 'model';
          $this->tbl_variant = TABLE_PREFIX_RANA . 'variant';
          $this->tbt_prod_features = TABLE_PREFIX_RANA . 'prod_features';
          $this->tbt_prod_images = TABLE_PREFIX_RANA . 'prod_images';
          $this->tbl_users = TABLE_PREFIX_RANA . 'users';
          $this->tbl_users_admin = TABLE_PREFIX . 'users';
          $this->tbl_showroom = TABLE_PREFIX . 'showroom';
          $this->tbl_vehicle = TABLE_PREFIX . 'vehicle';
          $this->tbl_enquiry = TABLE_PREFIX . 'enquiry';
          $this->tbl_valuation = TABLE_PREFIX . 'valuation';
          $this->tbl_vehicle_colors = TABLE_PREFIX . 'vehicle_colors';
     }

     function getColor()
     {
          return $this->db->order_by('vc_color', 'ASC')->get_where($this->tbl_vehicle_colors, array('vc_status' => 1))->result_array();
     }

     public function getBrands($id = '')
     {
          $this->db->select("branda.*, brandb.brd_title AS parent")
               ->from($this->tbl_brand . ' branda')
               ->join($this->tbl_brand . ' brandb', 'branda.brd_parent = brandb.brd_id', 'left');

          if (!empty($id)) {
               $this->db->where('branda.brd_id', $id);
          }
          $this->db->order_by('branda.brd_title', 'asc');
          $brands = $this->db->get()->result_array();
          return $brands;
     }
     public function getProduct($limit = 0, $page = 0, $filter = array())
     {
          $data = array();

          //Count
          if (isset($filter['search_string']) && !empty($filter['search_string'])) {
               $this->db->where("(prd_regno_prt_1 LIKE '%" . $filter['search_string'] . "%' OR prd_regno_prt_2 LIKE '%"
                    . $filter['search_string'] . "%' OR " . "prd_regno_prt_3 LIKE '%" . $filter['search_string'] . "%' OR prd_regno_prt_4 LIKE '%" .
                    $filter['search_string'] . "%' OR prd_number LIKE '%" . $filter['search_string'] . "%' OR prd_id = " . $filter['search_string'] . ") ");
          }
          if (isset($filter['who'])) {
               $this->db->where($this->table . '.prd_added_by_user', $filter['who']);
          }
          if (isset($filter['lux'])) {
               $this->db->where($this->table . '.prd_rd_mini', $filter['lux']);
          }
          if (isset($filter['sts'])) {
               $this->db->where($this->table . '.prd_status', $filter['sts']);
          }
          if (isset($filter['sld'])) {
               $this->db->where($this->table . '.prd_soled', $filter['sld']);
          }

          if (isset($filter['prd_rd_mini']) && ($filter['prd_rd_mini'] >= 0)) {
               $this->db->where($this->table . '.prd_rd_mini', $filter['prd_rd_mini']);
          }

          if (isset($filter['prd_status']) && ($filter['prd_status'] >= 0)) {
               $this->db->where($this->table . '.prd_status', $filter['prd_status']);
          } else {
               //$this->db->where($this->table . '.prd_status', 1);
          }

          if (isset($filter['prd_booking_status']) && ($filter['prd_booking_status'] >= 0)) {
               $this->db->where($this->table . '.prd_booking_status', $filter['prd_booking_status']);
          }

          if (isset($filter['prd_photo_upld_by'])) {
               $this->db->where($this->table . '.prd_photo_upld_by', 0);
          }

          if (isset($filter['prd_verified_by']) && ($filter['prd_verified_by'] > 0)) {
               $this->db->where($this->table . '.prd_verified_by > 0');
          }

          if (isset($filter['prd_brand']) && $filter['prd_brand'] > 0) {
               $this->db->where($this->table . '.prd_brand', $filter['prd_brand']);
          }

          if (isset($filter['prd_model']) && $filter['prd_model'] > 0) {
               $this->db->where($this->table . '.prd_model', $filter['prd_model']);
          }

          if (isset($filter['prd_variant']) && ($filter['prd_variant'] > 0)) {
               $this->db->where($this->table . '.prd_variant', $filter['prd_variant']);
          }
          $data['count'] = $this->db->count_all_results($this->table);

          $selectArray = array(
               $this->table . '.prd_id',
               $this->table . '.prd_regno_prt_1',
               $this->table . '.prd_regno_prt_2',
               $this->table . '.prd_regno_prt_3',
               $this->table . '.prd_regno_prt_4',
               $this->table . '.prd_number',
               $this->table . '.prd_name',
               $this->table . '.prd_status',
               $this->table . '.prd_rd_mini',
               $this->table . '.prd_popular',
               $this->table . '.prd_booked',
               $this->table . '.prd_soled',
               $this->table . '.prd_latest',
               $this->table . '.prd_date',
               $this->table . '.prd_color',
               $this->table . '.prd_price',
               $this->tbl_vehicle_colors . '.vc_color',
               $this->tbl_brand . '.*',
               $this->tbl_model . '.*',
               $this->tbl_variant . '.*'
          );

          $this->db->select($selectArray);
          $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'left');
          $this->db->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->table . '.prd_brand', 'left');
          $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->table . '.prd_model', 'left');
          $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->table . '.prd_variant', 'left');

          if (isset($filter['who'])) {
               $this->db->where($this->table . '.prd_added_by_user', $filter['who']);
          }
          if (isset($filter['lux'])) {
               $this->db->where($this->table . '.prd_rd_mini', $filter['lux']);
          }
          if (isset($filter['sts'])) {
               $this->db->where($this->table . '.prd_status', $filter['sts']);
          }
          if (isset($filter['sld'])) {
               $this->db->where($this->table . '.prd_soled', $filter['sld']);
          }

          if (isset($filter['prd_rd_mini']) && ($filter['prd_rd_mini'] >= 0)) {
               $this->db->where($this->table . '.prd_rd_mini', $filter['prd_rd_mini']);
          }

          if (isset($filter['prd_status']) && ($filter['prd_status'] >= 0)) {
               $this->db->where($this->table . '.prd_status', $filter['prd_status']);
          } else {
               //$this->db->where($this->table . '.prd_status', 1);
          }

          if (isset($filter['prd_booking_status']) && ($filter['prd_booking_status'] >= 0)) {
               $this->db->where($this->table . '.prd_booking_status', $filter['prd_booking_status']);
          }

          if (isset($filter['prd_photo_upld_by'])) {
               $this->db->where($this->table . '.prd_photo_upld_by', 0);
          }

          if (isset($filter['prd_verified_by']) && ($filter['prd_verified_by'] > 0)) {
               $this->db->where($this->table . '.prd_verified_by > 0');
          }
          if (isset($filter['search_string']) && !empty($filter['search_string'])) {
               $this->db->where("(prd_regno_prt_1 LIKE '%" . $filter['search_string'] . "%' OR prd_regno_prt_2 LIKE '%"
                    . $filter['search_string'] . "%' OR " . "prd_regno_prt_3 LIKE '%" . $filter['search_string'] . "%' OR prd_regno_prt_4 LIKE '%" .
                    $filter['search_string'] . "%' OR prd_number LIKE '%" . $filter['search_string'] . "%' OR prd_id = " . $filter['search_string'] . " ) ");
          }
          if (isset($filter['prd_brand']) && $filter['prd_brand'] > 0) {
               $this->db->where($this->table . '.prd_brand', $filter['prd_brand']);
          }

          if (isset($filter['prd_model']) && $filter['prd_model'] > 0) {
               $this->db->where($this->table . '.prd_model', $filter['prd_model']);
          }

          if (isset($filter['prd_variant']) && ($filter['prd_variant'] > 0)) {
               $this->db->where($this->table . '.prd_variant', $filter['prd_variant']);
          }
          //Data
          if ($limit) {
               $this->db->limit($limit, $page);
          }
          $this->db->order_by($this->table . '.prd_id', 'DESC');
          $productsArray = $this->db->get($this->table)->result_array();
          // echo $this->db->last_query();
          // debug($productsArray);
          if (!empty($productsArray)) {
               foreach ($productsArray as $key => $value) {
                    $prodImages = $this->db->get_where(TABLE_PREFIX_RANA . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                    $value['product_images'] = $prodImages;
                    $data['data'][] = $value;
               }
          }
          return $data;
     }

     function getSingleProduct($id)
     {
          $this->load->model('brand_model');
          $this->db->select($this->table . '.*, ' . TABLE_PREFIX_RANA . 'brand.*, ' . $this->tbl_model . '.*,' . $this->tbl_variant . '.*,' . $this->tbl_users . '.*,' .
               $this->tbl_showroom . '.*,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color');
          $this->db->join(TABLE_PREFIX_RANA . 'brand', TABLE_PREFIX_RANA . 'brand.brd_id = ' . $this->table . '.prd_brand', 'left');

          $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'left');
          $this->db->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->table . '.prd_location', 'left');
          $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->table . '.prd_model', 'left');
          $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->table . '.prd_variant', 'left');
          $this->db->join($this->tbl_users, $this->tbl_users . '.id = ' . $this->table . '.prd_user_id', 'left');

          if ($id) {
               $this->db->where($this->table . '.prd_id', $id);
          }
          $productsArray = $this->db->get($this->table)->row_array();

          $products['product_details'] = array();
          $products['product_specification'] = array();
          $products['product_images'] = array();
          if (!empty($productsArray)) {

               $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX_RANA . 'prod_specifications', array('spe_prod_id' => $productsArray['prd_id']))->result_array();
               $products['product_features'] = $this->db->select("GROUP_CONCAT(pft_feature_id) AS features")->get_where($this->tbt_prod_features, array('pft_prod_id' => $productsArray['prd_id']))->row_array();

               $prodImages = $this->db->get_where(TABLE_PREFIX_RANA . 'prod_images', array('pdi_prod_id' => $productsArray['prd_id']))->result_array();

               $products['product_specification'] = $prodSpecifications;

               $products['product_images'] = $prodImages;

               $products['product_details'] = $productsArray;
          }
          return $products;
     }

     public function addNewProduct($datas)
     {

          if (isset($datas['product']['prd_brand'])) {
               $datas['product']['prd_order'] = $this->db->select_max('prd_order')->where('prd_brand', $datas['product']['prd_brand'])
                    ->get($this->table)->row()->prd_order + 1;
          }
          $datas['prd_order'] = $this->getNextOrder();
          $datas['product']['prd_regno_prt_1'] = strtoupper($datas['product']['prd_regno_prt_1']);
          $datas['product']['prd_regno_prt_3'] = strtoupper($datas['product']['prd_regno_prt_3']);
          $datas['product']['prd_status'] = 1;
          $datas['product']['prd_rd_mini'] = isset($datas['product']['prd_rd_mini']) ? $datas['product']['prd_rd_mini'] : 0;
          $datas['product']['prd_fst_added_by'] = $this->uid;
          $datas['product']['prd_data_updated'] = $this->uid; //Data updated by
          $datas['product']['prd_date'] = date('Y-m-d H:i:s');
          $datas['product']['prd_price'] = !empty($datas['product']['prd_price']) ? str_replace(',', '', $datas['product']['prd_price']) : 0;
          if ($this->db->insert($this->table, array_filter($datas['product']))) {
               $lastId = $this->db->insert_id();

               $specifications = $datas['specification'];
               if ($specifications) {
                    for ($i = 0; $i < count($specifications['spe_specification']); $i++) {
                         if (!empty($specifications['spe_specification'][$i]) || !empty($specifications['spe_specification_detail'][$i])) {
                              $specifi = array(
                                   'spe_prod_id' => $lastId,
                                   'spe_specification' => $specifications['spe_specification'][$i],
                                   'spe_specification_detail' => $specifications['spe_specification_detail'][$i],
                              );
                              $this->db->insert(TABLE_PREFIX_RANA . 'prod_specifications', $specifi);
                         }
                    }
               }

               if (isset($datas['features']) && !empty($datas['features'])) {
                    foreach ($datas['features'] as $key => $value) {
                         $features = array(
                              'pft_prod_id' => $lastId,
                              'pft_feature_id' => $key,
                         );
                         $this->db->insert($this->tbt_prod_features, $features);
                    }
               }

               //SMS to customer
               $beforeOneWeek = date('Y-m-d', strtotime("-1 week")); //1 week ago
               $brand = $datas['product']['prd_brand'];
               $model = $datas['product']['prd_model'];
               $varnt = $datas['product']['prd_variant'];
               $currentProduct = $this->common_model->getVehicleName($brand, $model, $varnt);
               $selectArray = array(
                    $this->tbl_enquiry . '.enq_cus_name', $this->tbl_enquiry . '.enq_cus_mobile', $this->tbl_enquiry . '.enq_se_id',
                    $this->tbl_enquiry . ".enq_cus_status", $this->tbl_users_admin . '.usr_active', $this->tbl_users_admin . '.usr_first_name',
                    $this->tbl_users_admin . '.usr_phone', $this->tbl_brand . '.brd_title', $this->tbl_model . '.mod_title',
                    $this->tbl_variant . '.var_variant_name', $this->tbl_showroom . '.shr_phone_num'
               );
               $this->db->where_in($this->tbl_enquiry . '.enq_current_status', $this->myEnqStatuses);
               $relatedCustomers = $this->db->select($selectArray)
                    ->join($this->tbl_vehicle, $this->tbl_vehicle . '.veh_enq_id = ' . $this->tbl_enquiry . '.enq_id', 'LEFT')
                    ->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->tbl_vehicle . '.veh_brand', 'LEFT')
                    ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_vehicle . '.veh_model', 'LEFT')
                    ->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->tbl_vehicle . '.veh_varient', 'LEFT')
                    ->join($this->tbl_users_admin, $this->tbl_users_admin . '.usr_id = ' . $this->tbl_enquiry . '.enq_se_id', 'LEFT')
                    ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_users_admin . '.usr_showroom', 'LEFT')
                    ->where(array($this->tbl_vehicle . '.veh_brand' => $brand, $this->tbl_vehicle . '.veh_model' => $model))
                    ->where($this->tbl_enquiry . ".enq_next_foll_date >= DATE('" . $beforeOneWeek . "')")
                    ->where($this->tbl_enquiry . ".enq_cus_status", '1')->get($this->tbl_enquiry)->result_array();
               foreach ($relatedCustomers as $key => $value) {
                    $sms = '';
                    if ($value['usr_active'] == 1) { // Active members
                         $sms = "Dear " . $value['enq_cus_name'] . ", we've launched a new stock " . $currentProduct .
                              ", contact for more info " . $value['usr_first_name'] . ', ' . $value['usr_phone'] .
                              " - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
                    } else { // Resigned members
                         $sms = "Dear " . $value['enq_cus_name'] . ", we've launched a new stock " . $currentProduct .
                              ", contact for more info " . $value['shr_phone_num'] .
                              " - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
                    }
                    send_sms($sms, $value['enq_cus_mobile'], 'new product launch to customer', '1607100000000042909');
               }
               $mymsg = 'Dear jk, enq cnt : ' . count($relatedCustomers) . " prd no  " . $datas['product']['prd_number'] . " - Royal Drive South India's Largest Pre-Owned Luxury Car Showroom";
               send_sms($mymsg, 919745661946, 'new product launch to customer', '1607100000000042909');
               /**/
               return $lastId;
          } else {
               return false;
          }
     }

     public function addImages($image)
     {
          if ($this->db->insert(TABLE_PREFIX_RANA . 'prod_images', $image)) {
               return true;
          } else {
               return false;
          }
     }

     public function removePrductImage($id)
     {
          if ($id) {
               $this->db->where('pdi_id', $id);
               $image = $this->db->get(TABLE_PREFIX_RANA . 'prod_images')->result_array();
               $image = isset($image['0']) ? $image['0'] : array();
               if (isset($image['pdi_image']) && !empty($image['pdi_image'])) {
                    if (file_exists(FILE_UPLOAD_PATH . 'product/' . $image['pdi_image'])) {
                         unlink(FILE_UPLOAD_PATH . 'product/' . $image['pdi_image']);
                         @unlink(FILE_UPLOAD_PATH . 'product/thumb_' . $image['pdi_image']);
                    }
                    $this->db->where('pdi_id', $id);
                    $this->db->delete(TABLE_PREFIX_RANA . 'prod_images');
                    return true;
               }
          }
          return false;
     }

     public function updateProduct($datas)
     {

          if (isset($datas['prd_id']) && !empty($datas['prd_id'])) {

               $datas['product']['prd_new_arrivals'] = isset($datas['product']['prd_new_arrivals']) ? $datas['product']['prd_new_arrivals'] : 0;
               $datas['product']['prd_loan_avail'] = isset($datas['product']['prd_loan_avail']) ? $datas['product']['prd_loan_avail'] : 0;
               $datas['product']['prd_regno_prt_1'] = strtoupper($datas['product']['prd_regno_prt_1']);
               $datas['product']['prd_regno_prt_3'] = strtoupper($datas['product']['prd_regno_prt_3']);
               $this->db->where('prd_id', $datas['prd_id']);
               $datas['product'] = array_filter($datas['product']);
               $datas['product']['prd_wrapp_color'] = isset($datas['product']['prd_wrapp_color']) ? $datas['product']['prd_wrapp_color'] : '';
               $datas['product']['prd_order'] = isset($datas['product']['prd_order']) ? $datas['product']['prd_order'] : 0;
               $datas['product']['prd_price'] = isset($datas['product']['prd_price']) ? $datas['product']['prd_price'] : 0;
               $datas['product']['prd_km_run'] = isset($datas['product']['prd_km_run']) ? $datas['product']['prd_km_run'] : 0;
               $datas['product']['prd_sync'] = 0;

               if ($this->db->update($this->table, $datas['product'])) {
                    $prodId = $datas['prd_id'];
                    if (isset($datas['specification']) && !empty($datas['specification'])) {
                         $specifications = $datas['specification'];

                         $this->db->delete(TABLE_PREFIX_RANA . 'prod_specifications', array('spe_prod_id' => $prodId));
                         if ($specifications) {
                              for ($i = 0; $i < count($specifications['spe_specification']); $i++) {
                                   if (!empty($specifications['spe_specification'][$i]) || !empty($specifications['spe_specification_detail'][$i])) {
                                        $specifi = array(
                                             'spe_prod_id' => $prodId,
                                             'spe_specification' => $specifications['spe_specification'][$i],
                                             'spe_specification_detail' => $specifications['spe_specification_detail'][$i],
                                        );
                                        $this->db->insert(TABLE_PREFIX_RANA . 'prod_specifications', $specifi);
                                   }
                              }
                         }
                    }
                    if (isset($datas['features']) && !empty($datas['features'])) {
                         $this->db->delete($this->tbt_prod_features, array('pft_prod_id' => $prodId));
                         foreach ($datas['features'] as $key => $value) {
                              $features = array(
                                   'pft_prod_id' => $prodId,
                                   'pft_feature_id' => $key,
                              );
                              $this->db->insert($this->tbt_prod_features, $features);
                         }
                    }
                    return true;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     public function deleteProduct($id)
     {
          if (!empty($id)) {
               $this->db->delete($this->table, array('prd_id' => $id));
               $this->db->delete(TABLE_PREFIX_RANA . 'prod_specifications', array('spe_prod_id' => $id));

               $this->db->where('pdi_prod_id', $id);
               $images = $this->db->get(TABLE_PREFIX_RANA . 'prod_images')->result_array();
               $this->db->delete(TABLE_PREFIX_RANA . 'prod_images', array('pdi_prod_id' => $id));
               if (!empty($images)) {
                    foreach ($images as $key => $value) {
                         if (file_exists(FILE_UPLOAD_PATH . 'product/' . $value['pdi_image'])) {
                              unlink(FILE_UPLOAD_PATH . 'product/' . $value['pdi_image']);
                              @unlink(FILE_UPLOAD_PATH . 'product/thumb_' . $image['pdi_image']);
                         }
                    }
               }

               return true;
          } else {
               return false;
          }
     }

     /* related to excel import */

     function getBrandIdByBrandName($brandName)
     {
          $brandName = trim($brandName);
          if (!empty($brandName)) {
               $result = $this->db->select('brd_id')->from(TABLE_PREFIX_RANA . 'brand')->like('brd_title', $brandName)->get()->row_array();
               if (isset($result['brd_id']) && !empty($result['brd_id'])) {
                    return $result['brd_id'];
               } else {
                    return null;
               }
          } else {
               return null;
          }
     }

     function getCategoryIdByCategoryName($categoryName)
     {
          $categoryName = trim($categoryName);
          if (!empty($categoryName)) {
               $result = $this->db->select('cat_id')->from(TABLE_PREFIX_RANA . 'category')->like('cat_title', $categoryName)->get()->row_array();
               if (isset($result['cat_id']) && !empty($result['cat_id'])) {
                    return $result['cat_id'];
               } else {
                    return null;
               }
          } else {
               return null;
          }
     }

     function importNewProduct($datas)
     {
          if (!empty($datas)) {
               $datas['prd_from_excel'] = 1;
               if ($this->db->insert(TABLE_PREFIX_RANA . 'products', $datas)) {
                    return $this->db->insert_id();
               }
          }
     }

     function addNewProductSpecification($datas)
     {
          if (!empty($datas)) {
               if ($this->db->insert(TABLE_PREFIX_RANA . 'prod_specifications', $datas)) {
                    return $this->db->insert_id();
               }
          }
     }

     function addNewProductImage($datas)
     {
          if (!empty($datas)) {
               if ($this->db->insert(TABLE_PREFIX_RANA . 'prod_images', $datas)) {
                    return $this->db->insert_id();
               }
          }
     }

     public function getProductByBrandId($brandId = '')
     {
          $this->load->model('brand_model');
          $this->db->select($this->table . '.*, ' . TABLE_PREFIX_RANA . 'category.cat_id AS sub_category,' . TABLE_PREFIX_RANA . 'category.cat_title AS sub_category_name , ' . TABLE_PREFIX_RANA . 'brand.*, '
               . 'cat1.cat_id AS category_id, cat1.cat_title AS category_name')->from($this->table);
          $this->db->join(TABLE_PREFIX_RANA . 'brand', TABLE_PREFIX_RANA . 'brand.brd_id = ' . $this->table . '.prd_brand', 'left');
          $this->db->join(TABLE_PREFIX_RANA . 'category', TABLE_PREFIX_RANA . 'category.cat_id = ' . $this->table . '.prd_category ', 'left');
          $this->db->join(TABLE_PREFIX_RANA . 'category cat1', 'cat1.cat_id = ' . TABLE_PREFIX_RANA . 'category.cat_parent ', 'left');
          if ($brandId) {
               $this->db->where($this->table . '.prd_brand', $brandId);
          }

          $productsArray = $this->db->get()->result_array();
          $products['product_details'] = array();
          $products['product_specification'] = array();
          $products['product_images'] = array();
          if (!empty($productsArray)) {
               foreach ($productsArray as $key => $value) {
                    $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX_RANA . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();
                    $prodImages = $this->db->get_where(TABLE_PREFIX_RANA . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();

                    $value['fit_to'] = $this->brand_model->getFitTo($value['prd_brand']);
                    $value['product_specification'] = $prodSpecifications;
                    $value['product_images'] = $prodImages;

                    $products['product_details'][] = $value;
               }
          }
          return $products;
     }

     function getNextOrder($max = false)
     {
          if ($max) {
               return $this->db->count_all_results($this->table);
          } else {
               return $this->db->select_max('prd_order')->get($this->table)->row()->prd_order + 1;
          }
     }

     function arrangeProductOrder($datas)
     {

          $product = $this->db->select('*')->from($this->table)->where('prd_id', $datas['product'])->get()->row_array();

          $productInNewOrder = $this->db->select('*')
               ->from($this->table)
               ->where(array('prd_order' => $datas['newOrder'], 'prd_brand' => $datas['brand']))->get()->row_array();

          if (!empty($productInNewOrder) && isset($productInNewOrder['prd_id'])) {
               $this->db->update($this->table, array('prd_order' => $product['prd_order']), 'prd_id = ' . $productInNewOrder['prd_id']);
          }

          if ($this->db->update($this->table, array('prd_order' => $datas['newOrder']), 'prd_id = ' . $datas['product'])) {
               return true;
          } else {
               return false;
          }
     }

     function changesStatus($field, $prdId, $status)
     {
          if (!empty($prdId)) {
               if ($field == 'prd_booked') {
                    $update['prd_booking_status'] = ($status == 1) ? 28 : 1;
               }
               if ($field == 'prd_soled') {
                    $update['prd_booking_status'] = ($status == 1) ? 40 : 1;
               }
               $update[$field] = $status;
               if ($field == 'prd_status') {
                    if ($status == 1) {
                         $update['prd_verified_by'] = $this->uid;
                    } else {
                         $update['prd_verified_by'] = 0;
                    }
               }
               $update['prd_sync'] = 0;
               $this->db->where('prd_id', $prdId);
               $this->db->update($this->table, $update);
               //return $status . '-' .  $this->db->last_query();
               return true;
          } else {
               return false;
          }
     }

     function setDefaultImage($imgId, $prodId)
     {
          $this->db->where('prd_id', $prodId)->update($this->table, array('prd_sync' => 0));

          $this->db->where('pdi_prod_id', $prodId);
          $this->db->update($this->tbt_prod_images, array('pdi_is_default' => 0));

          $this->db->where('pdi_id', $imgId);
          $this->db->update($this->tbt_prod_images, array('pdi_is_default' => 1));
          return true;
     }

     function getValuationProduct($data)
     {
          return $this->db->order_by('val_id', 'DESC')->limit(1)->get_where($this->tbl_valuation, array(
               'UPPER(val_prt_1)' => strtoupper($data['regNo1']), 'val_prt_2' => $data['regNo2'],
               'UPPER(val_prt_3)' => strtoupper($data['regNo3']), 'val_prt_4' => $data['regNo4']
          ))->row_array();
     }

     function getProductValuation($valId)
     {
          return $this->db->select($this->tbl_valuation . '.*,' . $this->tbl_showroom . '.*')
               ->join($this->tbl_showroom, $this->tbl_showroom . '.shr_id = ' . $this->tbl_valuation . '.val_showroom', 'LEFT')
               ->get_where($this->tbl_valuation, array($this->tbl_valuation . '.val_id' => $valId))->row_array();
     }

     function pendingVerification()
     {
          $selArray = array(
               $this->table . '.prd_id',
               $this->table . '.prd_number',
               $this->table . '.prd_regno_prt_1',
               $this->table . '.prd_regno_prt_2',
               $this->table . '.prd_regno_prt_3',
               $this->table . '.prd_regno_prt_4',
               $this->tbl_brand . '.*',
               $this->tbl_model . '.*',
               $this->tbl_variant . '.*'
          );
          $this->db->select($selArray);
          $this->db->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->table . '.prd_brand', 'left');
          $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->table . '.prd_model', 'left');
          $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->table . '.prd_variant', 'left');
          $this->db->where(array($this->table . '.prd_verified_by' => 0, 'prd_photo_upld_by > ' => 0));
          return $this->db->get($this->table)->result_array();
     }

     function pendingPhotoupload()
     {
          $selArray = array(
               $this->table . '.prd_id',
               $this->table . '.prd_number',
               $this->table . '.prd_regno_prt_1',
               $this->table . '.prd_regno_prt_2',
               $this->table . '.prd_regno_prt_3',
               $this->table . '.prd_regno_prt_4',
               $this->tbl_brand . '.*',
               $this->tbl_model . '.*',
               $this->tbl_variant . '.*'
          );
          $this->db->select($selArray);
          $this->db->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->table . '.prd_brand', 'left');
          $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->table . '.prd_model', 'left');
          $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->table . '.prd_variant', 'left');
          $this->db->where($this->table . '.prd_photo_upld_by', 0);
          return $this->db->get($this->table)->result_array();
     }

     function upldphotostockvehicle($filter = array())
     {
          $selArray = array(
               $this->table . '.prd_id',
               $this->table . '.prd_number',
               $this->table . '.prd_rd_mini',
               $this->table . '.prd_regno_prt_1',
               $this->table . '.prd_regno_prt_2',
               $this->table . '.prd_regno_prt_3',
               $this->table . '.prd_regno_prt_4',
               $this->tbl_brand . '.*',
               $this->tbl_model . '.*',
               $this->tbl_variant . '.*'
          );
          if (isset($filter['prd_rd_mini']) && ($filter['prd_rd_mini'] == 0 || $filter['prd_rd_mini'] == 1)) {
               $this->db->where(array($this->table . '.prd_rd_mini' => $filter['prd_rd_mini']));
          }
          $this->db->select($selArray);
          $this->db->join($this->tbl_brand, $this->tbl_brand . '.brd_id = ' . $this->table . '.prd_brand', 'left');
          $this->db->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->table . '.prd_model', 'left');
          $this->db->join($this->tbl_variant, $this->tbl_variant . '.var_id = ' . $this->table . '.prd_variant', 'left');
          $this->db->where(array($this->table . '.prd_status' => 1));
          //'prd_photo_upld_by' => 0
          return $this->db->get($this->table)->result_array();
     }

     function updatePhotoloaded($prdId)
     {
          if (check_permission('product', 'canuploadprdimage_notify')) {
               $this->db->where('prd_id', $prdId)->update($this->table, array('prd_photo_upld_by' => $this->uid, 'prd_sync' => 0));
               generate_log(array(
                    'log_title' => 'Update product images',
                    'log_desc' => 'Update product images',
                    'log_controller' => 'update-prod-images',
                    'log_action' => 'U',
                    'log_ref_id' => $prdId,
                    'log_added_by' => $this->uid
               ));
          }
          return true;
     }

     function verifyProduct($prdId)
     {
          $this->db->where('prd_id', $prdId)->update($this->table, array('prd_sync' => 0, 'prd_status' => 1, 'prd_verified_by' => $this->uid));
          generate_log(array(
               'log_title' => 'Verify product',
               'log_desc' => 'Verify product',
               'log_controller' => 'verify-prod',
               'log_action' => 'U',
               'log_ref_id' => $prdId,
               'log_added_by' => $this->uid
          ));
          return true;
     }

     function getProdImagesByVehRegNumber($data)
     {
          return $this->db->select('prd_id')->order_by('prd_id', 'DESC')->limit(1)->get_where($this->table, array(
               'UPPER(prd_regno_prt_1)' => strtoupper($data['regNo1']), 'prd_regno_prt_2' => $data['regNo2'],
               'UPPER(prd_regno_prt_3)' => strtoupper($data['regNo3']), 'prd_regno_prt_4' => $data['regNo4']
          ))->row_array();
     }

     function updateWalkaround($prdId, $video)
     {
          $this->db->where('prd_id', $prdId)->update($this->table, array('prd_sync' => 0, 'prd_video' => $video));
          generate_log(array(
               'log_title' => 'Update product walkaround',
               'log_desc' => 'Update product walkaround',
               'log_controller' => 'update-prod-walkaround',
               'log_action' => 'U',
               'log_ref_id' => $prdId,
               'log_added_by' => $this->uid
          ));
          return true;
     }
}
