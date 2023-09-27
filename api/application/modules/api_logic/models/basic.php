<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class basic extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->tbl_brands = TABLE_PREFIX . "brand";
            $this->tbl_products = TABLE_PREFIX . "products";
            $this->tbl_products_image = TABLE_PREFIX . "prod_images";
            $this->tbl_products_specification = TABLE_PREFIX . "prod_specifications";
            $this->tbl_model = TABLE_PREFIX . "model";
            $this->tbl_variant = TABLE_PREFIX . "variant";
            $this->tbl_prod_features = TABLE_PREFIX . "prod_features";
            $this->tbl_features = TABLE_PREFIX . "features";
            $this->tbl_banner = "app_banner";
            $this->tbl_showroom = "app_showroom";
            $this->tbl_faq = "app_faq";
            $this->tbl_banners = 'cpnl_banner';
            $this->tbl_vehicle_colors = TABLE_PREFIX_PORTAL . 'vehicle_colors';
            $this->tbl_cpnl_showroom = TABLE_PREFIX_PORTAL . 'showroom';
            $this->tbl_transmission = TABLE_PREFIX_PORTAL . 'transmission';
       }
       
       function getbmv() {
          $selectArray = array(
               $this->tbl_brands . '.brd_id',
               $this->tbl_brands . '.brd_title',
               $this->tbl_brands . '.brd_section AS brd_luxury',
               $this->tbl_model . '.mod_id',
               $this->tbl_model . '.mod_title',
               $this->tbl_variant . '.var_id',
               $this->tbl_variant . '.var_variant_name',
               
          );
          return $this->db->select($selectArray)->join($this->tbl_brands, $this->tbl_brands . '.brd_id = ' . $this->tbl_variant . '.var_brand_id')
          ->join($this->tbl_model, $this->tbl_model . '.mod_id = ' . $this->tbl_variant . '.var_model_id')->order_by('brd_title')->get($this->tbl_variant)->result_array();
       }

       function getBrands($id = '') {
            $this->db->select('brd_id,brd_title,CONCAT("https://www.royaldrive.in/assets/uploads/brand/", ' . ', brd_logo) AS image', FALSE);
            $this->db->from($this->tbl_brands);
            $this->db->order_by('brd_title');
            if (!empty($id)) {
                 $this->db->where('brd_id', $id);
                 $categories = $this->db->get()->row_array();
            } else {
                 $categories = $this->db->get()->result_array();
            } return $categories;
       }

       function GetCars($id = '') {
         // debug(1213);

            /*$this->db->select('prd_id,brd_title,mod_title,var_variant_name,prd_year,prd_owner AS ownership,prd_color,prd_rd_mini,prd_popular,prd_latest,prd_soled,prd_booked,prd_price AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
            $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
            $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
            $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_added_by_user='0'";

            $this->db->where($where);

            $this->db->order_by('prd_order');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles['cars'] = $this->db->get()->row_array();
            } else {
                 $vechicles['cars'] = $this->db->get()->result_array();
            }
            $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
            $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
            return $vechicles;*/
            
              //if(!empty($vechicles)){
              //foreach($vechicles as $key => $item){
              //if(isset($item['prd_booked']) && $item['prd_booked'] =='1' ){
              //$prd_status = 'booked';
              //}else if(isset($item['prd_soled']) && $item['prd_soled'] =='1'){
              //$prd_status = 'soled';
              //}else{
              //$prd_status = 'none';
              //}
              //$vechicles[$key]['prd_status_new'] = $prd_status;
              //}
              //} 


            $selectFields = array(
                'prd_id', 'prd_number', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
                $this->tbl_vehicle_colors . '.vc_color AS prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked', 'IF(prd_show_price = 1, prd_price, 0) AS price',
                'prd_km_run AS kms',  "CONCAT('" . PRODUCT_BASE_URL . "380X238_'," . 'pdi_image) AS image',
                "(CASE WHEN prd_fual = 1 THEN 'Petrol'
                    WHEN prd_fual = 2 THEN 'Diesel'
                    WHEN prd_fual = 3 THEN 'Gas'
                    WHEN prd_fual = 4 THEN 'Hybrid'
                    WHEN prd_fual = 5 THEN 'Electric'
                    WHEN prd_fual = 6 THEN 'CNG' END) AS fuel"
            );
          // $selectFields = array(
          //      'prd_id', 'prd_number', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
          //      'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked', 'IF(prd_show_price = 1, prd_price, 0) AS price',
          //      'prd_km_run AS kms',  "CONCAT('" . PRODUCT_BASE_URL . "380X238_'," . 'pdi_image) AS image',
          //      "(CASE WHEN prd_fual = 1 THEN 'Petrol'
          //          WHEN prd_fual = 2 THEN 'Diesel'
          //          WHEN prd_fual = 3 THEN 'Gas'
          //          WHEN prd_fual = 4 THEN 'Hybrid'
          //          WHEN prd_fual = 5 THEN 'Electric'
          //          WHEN prd_fual = 6 THEN 'CNG' END) AS fuel"
          //  );

            if (!empty($id)) {
                 $this->db->select($selectFields, FALSE);
                 $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
                 $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
                 $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
                 $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
                 $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
                 $this->db->where("prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'");
                 $this->db->order_by('price', 'DESC');
                 $this->db->where('prd_id', $id);
                 $vechicles['cars'] = $this->db->get($this->tbl_products)->row_array();
                 $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
                 $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
                 return $vechicles; 
            }

            /* not book or sold */
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
            $ntBkdSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                            ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
            //$vechicles['qry_ntBkdSld'] = $this->db->last_query();

            /* Booked but not sold */
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '1' AND prd_soled = '0'";
            $bkdNotSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                            ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
            //$vechicles['qry_bkdNotSld'] = $this->db->last_query();

            /* Only sold */
            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_soled = '1'";
            $sld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                            ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
            //$vechicles['qry_sld'] = $this->db->last_query();

            $vechicles['cars'] = array_merge($ntBkdSld, $bkdNotSld, $sld);
            $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
            $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
            
            return $vechicles;
       }

       function getCarsWithPage($limit = 0, $page = 0) {
          $limit =($limit/3);
        //debug($limit);
     $selectFields = array(
                 'prd_id', 'prd_number', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
                 $this->tbl_vehicle_colors . '.vc_color AS prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked', 'IF(prd_show_price = 1, prd_price, 0) AS price',
                 'prd_km_run AS kms',  "CONCAT('" . PRODUCT_BASE_URL . "380X238_'," . 'pdi_image) AS image',
                 "(CASE WHEN prd_fual = 1 THEN 'Petrol'
                     WHEN prd_fual = 2 THEN 'Diesel'
                     WHEN prd_fual = 3 THEN 'Gas'
                     WHEN prd_fual = 4 THEN 'Hybrid'
                     WHEN prd_fual = 5 THEN 'Electric'
                     WHEN prd_fual = 6 THEN 'CNG' END) AS fuel"
             );
 
 
             if (!empty($id)) {
                  $this->db->select($selectFields, FALSE);
                  $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
                  $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
                  $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
                  $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
                  $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
                  $this->db->where("prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'");
                  $this->db->order_by('price', 'DESC');
                  $this->db->where('prd_id', $id);
                  $vechicles['cars'] = $this->db->get($this->tbl_products)->row_array();
                  $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
                  $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
                  return $vechicles; 
             }
 
             /* not book or sold */
             $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
             if ($limit) {
               $this->db->limit($limit, $page);
          }
             $ntBkdSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                             ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
             //$vechicles['qry_ntBkdSld'] = $this->db->last_query();
 
             /* Booked but not sold */
             $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '1' AND prd_soled = '0'";
             if ($limit) {
               $this->db->limit($limit, $page);
          }
             $bkdNotSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                             ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
             //$vechicles['qry_bkdNotSld'] = $this->db->last_query();
 
             /* Only sold */
             $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_soled = '1'";
             if ($limit) {
               $this->db->limit($limit, $page);
          }
             $sld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                             ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
             //$vechicles['qry_sld'] = $this->db->last_query();
 
             $vechicles['cars'] = array_merge($ntBkdSld, $bkdNotSld, $sld);
            // $vechicles['total_num'] =  $this->getTotalcars();
             $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
             $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
             
             return $vechicles;
        }

        function getCarsWithPageNew($limit = 0, $page = 0) {
         // $limit =($limit/3);
        //debug($limit);

             $selectFields = array($this->tbl_products . '.*,'.
                    $this->tbl_vehicle_colors . '.vc_color AS prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked','brd_title', 'mod_title','mod_is_ev','mod_veh_type', 'var_variant_name', 'prd_year', 'prd_owner AS ownership', 'IF(prd_show_price = 1, prd_price, 0) AS price',
                    'prd_km_run AS kms',
                    "(CASE WHEN prd_fual = 1 THEN 'Petrol'
                    WHEN prd_fual = 2 THEN 'Diesel'
                    WHEN prd_fual = 3 THEN 'Gas'
                    WHEN prd_fual = 4 THEN 'Hybrid'
                    WHEN prd_fual = 5 THEN 'Electric'
                    WHEN prd_fual = 6 THEN 'CNG' END) AS fuel", $this->tbl_cpnl_showroom . '.shr_location', $this->tbl_transmission . '.trns_title'
             );
 
             if (!empty($id)) {
                  $this->db->select($selectFields, FALSE);
                  $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'left');
                  $this->db->join($this->tbl_model, 'mod_id = prd_model', 'left');
                  $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'left');
                  
                  $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'left');

                  $this->db->join($this->tbl_cpnl_showroom, 'shr_id = prd_location', 'left');
                  $this->db->join($this->tbl_transmission, 'trns_id = prd_transmission', 'left');

                  $this->db->where("prd_status='1'");
                  $this->db->order_by('price', 'DESC');
                  $this->db->where('prd_id', $id);
                  $vechicles['cars'] = $this->db->get($this->tbl_products)->row_array();
                  $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
                  $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
                  return $vechicles; 
             }
 
             /* not book or sold */
             //$where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
             $where = $this->tbl_products . ".prd_status = 1";
             if ($limit) {
               $this->db->limit($limit, $page);
          }
          $productsArray['mdata']= $this->db->select($selectFields, FALSE)
                             ->join($this->tbl_brands, 'brd_id = prd_brand', 'left')
                             ->join($this->tbl_model, 'mod_id = prd_model', 'left')
                             ->join($this->tbl_variant, 'var_id = prd_variant', 'left')
                             //->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'left')
                             ->join($this->tbl_cpnl_showroom, 'shr_id = prd_location', 'left')
                             ->join($this->tbl_transmission, 'trns_id = prd_transmission', 'left')
                             ->where($this->tbl_products . ".prd_status", 1)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();

                             //$where = "prd_status='1'";
                 
                             
               //   $products['product_details'] = array();
               //   $products['product_specification'] = array();
               //   $products['product_images'] = array();
                 //$productsArray['mdata']=$productsArray;

                          // debug($productsArray);
                             //debug(TABLE_PREFIX);
                           ///s
                           if (!empty( $productsArray['mdata'])) {
                              foreach ( $productsArray['mdata'] as $key => $value) {
                                   $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();
        
                                   $prodImages = $this->db->order_by('pdi_is_default', 'DESC')->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                                   //$features = $this->db->select("GROUP_CONCAT(pft_feature_id) AS features")->get_where($this->tbl_prod_features, array('pft_prod_id' => $value['prd_id']))->row_array();
                              ///j$features = $this->db->get_where( $this->tbl_prod_features, array('pft_prod_id' => $value['prd_id']))->result_array();ftr_id pft_prod_id
                              $features = $this->db->select('rana_prod_features.pft_prod_id,rana_prod_features.pft_feature_id,rana_features.ftr_feature,ftr_status')
                              ->join('rana_features', 'ftr_id  = pft_feature_id', 'left')->where('pft_prod_id', $value['prd_id'])
                              ->get($this->tbl_prod_features)->result_array();
                              
                              //debug($features);
                              
        
                                  //$f['product_features'] = isset($features['features']) ? $features['features'] : '';
                                  
                                   $p['data'][$key]=$value;
                                   $p['data'][$key]['prd_image'] = isset($prodImages['0']['pdi_image']) ? $prodImages['0']['pdi_image'] : '';
                                   $p['data'][$key]['product_specification'] = $prodSpecifications;
                                   //$p['main'][$key]['features'] = $features;
                                  // $p['data'][$key]['product_features'] =  isset($features['features']) ? $features['features'] : '';;
                                  $p['data'][$key]['product_features'] =  $features;
        
                                   $p['data'][$key]['product_images']= $prodImages;
                                   $productsArray = $p;
                                   //debug($productsArray);
                              }
                         }
                           ///e
                           //debug($productsArray);
             return $productsArray;
             $vechicles['cars'] = array_merge($ntBkdSld, $bkdNotSld, $sld);
            // $vechicles['total_num'] =  $this->getTotalcars();
             $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
             $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
             
             return $vechicles;
        }

        function getTotalcars() {
      $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
             
             $ntBkdSld = $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->count_all_results($this->tbl_products);
         /* Booked but not sold */
             $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '1' AND prd_soled = '0'";
          
             $bkdNotSld = $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->count_all_results($this->tbl_products);
        /* Only sold */
             $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_soled = '1'";
        
             $sld = $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                             ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                             ->where($where)->count_all_results($this->tbl_products);
                             
            $total = $ntBkdSld+$bkdNotSld+$sld;
     return $total;
        }
        function getTotalcarsNew() {
          $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'";
                 
          // $total = $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
          //                        ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
          //                        ->where($where)->count_all_results($this->tbl_products);

          $total = $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
                             ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
                                                    ->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right')
                                                    ->where($where)->count_all_results($this->tbl_products);
             
         return $total;
            }
       
//       function GetCars($id = '') {
//            
//            $selectFields = array(
//                'prd_id', 'brd_title', 'mod_title', 'var_variant_name', 'prd_year', 'prd_owner AS ownership',
//                'prd_color', 'prd_rd_mini', 'prd_popular', 'prd_latest', 'prd_soled', 'prd_booked', 'prd_price AS price',
//                'prd_km_run AS kms', 'prd_fual AS fuel', "CONCAT('http://www.royaldrive.in/assets/uploads/product/'," . 'pdi_image) AS image',
//            );
//
//            if (!empty($id)) {
//                 $this->db->select($selectFields, FALSE);
//                 $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
//                 $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
//                 $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
//                 $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
//                 $this->db->where("prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1'");
//                 $this->db->order_by('price', 'DESC');
//                 $this->db->where('prd_id', $id);
//                 $vechicles['cars'] = $this->db->get($this->tbl_products);
//                 $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
//                 $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
//                 return $vechicles;
//            }
//
//            /* not book or sold */
//            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '0' AND prd_soled = '0'";
//            $ntBkdSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
//                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
//                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
//
//            /* Booked but not sold */
//            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_booked = '1' AND prd_soled = '0'";
//            $bkdNotSld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
//                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
//                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
//
//            /* Only sold */
//            $where = "prd_id is NOT NULL AND pdi_is_default='1' AND prd_status='1' AND prd_soled = '1'";
//            $sld = $this->db->select($selectFields, FALSE)->join($this->tbl_brands, 'brd_id = prd_brand', 'right')->join($this->tbl_model, 'mod_id = prd_model', 'right')
//                            ->join($this->tbl_variant, 'var_id = prd_variant', 'right')->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right')
//                            ->where($where)->order_by('price', 'DESC')->get($this->tbl_products)->result_array();
//
//            $vechicles['cars'] = array_merge($ntBkdSld, $bkdNotSld, $sld);
//            $vechicles['applink'] = "https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
//            $vechicles['ioslink'] = "https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
//
//            return $vechicles;
//       }
       
       function GetAllfeature() {

            $this->db->select('ftr_feature AS feature,ftr_id', FALSE);
            $this->db->from($this->tbl_features);

            $vechicles = $this->db->get()->result_array();


            return $vechicles;
       }

       function GetFeatures($num) {

            $this->db->select('prd_id,ftr_feature AS features_available', FALSE);

            $this->db->join($this->tbl_prod_features, 'pft_prod_id = prd_id', 'right');
            $this->db->join($this->tbl_features, 'ftr_id = pft_feature_id', 'right');

            $this->db->from($this->tbl_products);

            $where = "prd_id is NOT NULL AND prd_id=$num";
            $this->db->order_by('prd_id');

            $this->db->where($where);

            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();

                 $idm['features_available'] = array_map(function($element) {
                      return $element['features_available'];
                 }, $vechicles);
                 $uniq = array();
                 foreach ($vechicles as $val) {
                      $uniq = array_merge($uniq, $val, $idm);
                 }

                 $vechicles = array_unique($uniq, SORT_REGULAR);
            } return $vechicles;
       }

       function GetCar($num) {
            if (!empty($num)) {
                 $this->db->select('prd_id,prd_number AS number,brd_title,mod_title,var_variant_name,prd_year,prd_km_run AS km,prd_year AS year,
                 prd_owner AS ownership,prd_mileage AS mileage,prd_engine_cc AS engine,prd_insurance_validity AS insurance,prd_soled,prd_booked, IF(prd_show_price = 1, prd_price, 0) AS price,prd_fual,
                 ' . " (CASE WHEN prd_fual = 1 THEN 'Petrol'
                           WHEN prd_fual = 2 THEN 'Diesel'
                           WHEN prd_fual = 3 THEN 'Gas'
                           WHEN prd_fual = 4 THEN 'Hybrid'
                           WHEN prd_fual = 5 THEN 'Electric'
                           WHEN prd_fual = 6 THEN 'CNG' END) AS fuel, prd_desc AS description, " . $this->tbl_vehicle_colors . '.vc_color AS prd_color' , FALSE);

                 $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'LEFT');
                 $this->db->join($this->tbl_model, 'mod_id = prd_model', 'LEFT');
                 $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'LEFT');
                 $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
                 $this->db->where('prd_id', $num);
                 $vechicles = $this->db->get($this->tbl_products)->row_array();
                 $images = $this->db->select('CONCAT("' . PRODUCT_BASE_URL . '", ' . ', pdi_image) AS images', false)
                 ->get_where($this->tbl_products_image, array('pdi_prod_id' => $num))->result_array();
                 
                 $vechicles['images'] = array_map(function($element) {
                      return $element['images'];
                 }, $images);   
            } else {
                 $this->db->select('prd_id,prd_number AS number,brd_title,mod_title,var_variant_name,prd_year,prd_km_run AS km,prd_year AS year,
                 prd_owner AS ownership,prd_mileage AS mileage,prd_engine_cc AS engine,prd_insurance_validity AS insurance,prd_soled,prd_booked, IF(prd_show_price = 1, prd_price, 0) AS price,prd_fual,
                 CONCAT("'.PRODUCT_BASE_URL.'380X238_", ' . ', pdi_image) AS images,' . " (CASE WHEN prd_fual = 1 THEN 'Petrol'
                         WHEN prd_fual = 2 THEN 'Diesel'
                         WHEN prd_fual = 3 THEN 'Gas'
                         WHEN prd_fual = 4 THEN 'Hybrid'
                         WHEN prd_fual = 5 THEN 'Electric'
                         WHEN prd_fual = 6 THEN 'CNG' END) AS fuel, prd_desc AS description, prd_fual AS prdfuel, " . $this->tbl_vehicle_colors . '.vc_color AS prd_color', FALSE);
                 $this->db->from($this->tbl_products);
                 $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
                 $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
                 $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
                 $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
                 $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
                 $where = "prd_id is NOT NULL AND prd_id=$num";

                 $this->db->where($where);

                 $this->db->order_by('prd_id');
                 $vechicles = $this->db->get()->result_array();

                 $idm['images'] = array_map(function($element) {
                      return $element['images'];
                 }, $vechicles);

                 $uniq = array();
                 foreach ($vechicles as $val) {
                      $uniq = array_merge($uniq, $val, $idm);
                 }

                 $vechicles = array_unique($uniq, SORT_REGULAR);
                 //echo json_encode($vechicles);exit; 
                 foreach ($vechicles as $key => $value) {
                      $vechicles['description'] = preg_replace(array("[</p>]", "[\n]", "[<p>]"), ' ', $value);
                 }
            }
            $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
            $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
            return $vechicles;
       }

       /*function GetCar($num) {
            $function_var = $num;
            $this->db->select('prd_id,prd_number AS number,brd_title,mod_title,var_variant_name,prd_year,prd_color,prd_km_run AS km,prd_year AS year,
            prd_owner AS ownership,prd_mileage AS mileage,prd_engine_cc AS engine,prd_insurance_validity AS insurance,prd_soled,prd_booked,prd_price AS price,prd_fual,
            CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS images,' . " (CASE WHEN prd_fual = 1 THEN 'Petrol'
                    WHEN prd_fual = 2 THEN 'Diesel'
                    WHEN prd_fual = 3 THEN 'Gas'
                    WHEN prd_fual = 4 THEN 'Hybrid'
                    WHEN prd_fual = 5 THEN 'Electric'
                    WHEN prd_fual = 6 THEN 'CNG' END) AS fuel, prd_desc AS description, prd_fual AS prdfuel", FALSE);
            $this->db->from($this->tbl_products);

            $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');

            $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
            $this->db->join($this->tbl_variant, 'var_id = prd_variant', 'right');
            $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
            $where = "prd_id is NOT NULL AND prd_id=$num";

            $this->db->where($where);

            $this->db->order_by('prd_id');

            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {

                 $vechicles = $this->db->get()->result_array();

                 $idm['images'] = array_map(function($element) {
                      return $element['images'];
                 }, $vechicles);

                 $uniq = array();
                 foreach ($vechicles as $val) {
                      $uniq = array_merge($uniq, $val, $idm);
                 }

                 $vechicles = array_unique($uniq, SORT_REGULAR);
                 foreach ($vechicles as $key => $value) {
                      $vechicles['description'] = preg_replace(array("[</p>]", "[\n]", "[<p>]"), ' ', $value);
                 }

                 $vechicles['applink'] = get_settings_by_key('app_android_link');//"https://play.google.com/store/apps/details?id=in.codemac.royaldrive.code";
                 $vechicles['ioslink'] = get_settings_by_key('app_ios_link_app_store');//"https://itunes.apple.com/us/app/royal-drive/id1223421080?mt=8";
            }

            return $vechicles;
       }*/

       function GetNew($id = '') {

            $this->db->select('prd_id,mod_title,brd_title,prd_year,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color ,IF(prd_show_price = 1, prd_price, 0) AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
            $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
            $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
            $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
            $where = "prd_added_by_user='0' AND prd_id is NOT NULL AND pdi_is_default='1'";

            $this->db->where($where);

            $this->db->order_by('prd_id', 'DESC');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();
            } return $vechicles;
       }

       function GetHighprice($id = '') {

            $this->db->select('prd_id,mod_title,brd_title,prd_year,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color ,IF(prd_show_price = 1, prd_price, 0) AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
            $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
            $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
            $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
            $where = "prd_added_by_user='0' AND prd_id is NOT NULL AND pdi_is_default='1'";

            $this->db->where($where);

            $this->db->order_by('price', 'DESC');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();
            } return $vechicles;
       }

       function GetLowprice($id = '') {

            $this->db->select('prd_id,mod_title,brd_title,prd_year,' . $this->tbl_vehicle_colors . '.vc_color AS prd_color, IF(prd_show_price = 1, prd_price, 0) AS price,prd_km_run AS kms,prd_fual AS fuel,CONCAT("http://www.royaldrive.in/assets/uploads/product/", ' . ', pdi_image) AS image', FALSE);
            $this->db->from($this->tbl_products);
            $this->db->join($this->tbl_brands, 'brd_id = prd_brand', 'right');
            $this->db->join($this->tbl_model, 'mod_id = prd_model', 'right');
            $this->db->join($this->tbl_products_image, 'pdi_prod_id = prd_id', 'right');
            $this->db->join($this->tbl_vehicle_colors, 'vc_id = prd_color_id', 'right');
            $where = "prd_added_by_user='0' AND prd_id is NOT NULL AND pdi_is_default='1'";

            $this->db->where($where);

            $this->db->order_by('price', 'ASC');
            if (!empty($id)) {
                 $this->db->where('prd_id', $id);
                 $vechicles = $this->db->get()->row_array();
            } else {
                 $vechicles = $this->db->get()->result_array();
            } return $vechicles;
       }

       function getModel($num) {
            $this->db->select('mod_id,mod_title', FALSE);
            $this->db->from($this->tbl_model);
            $this->db->where('mod_brand', $num);
            $vechicles = $this->db->get()->result_array();
            return $vechicles;
       }

//    function getBanner($id = '') {
//        $this->db->select('app_banner_id, app_banner_status, CONCAT("http://www.royaldrive.in/assets/uploads/product/", '.', app_banner_img_ulr) AS image', FALSE);
//        $this->db->from($this->tbl_banner);
//
//        $this->db->order_by('app_banner_id');
//        if (!empty($id)) {
//             $this->db->where('app_banner_id', $id);
//             $banner = $this->db->get()->row_array();
//        } else {
//             $banner = $this->db->get()->result_array();
//        }
//        
//      /*  $this->db->select('app_roya_status');
//        $this->db->from('app_roya');
//        $banner_status = $this->db->get()->result_array();
//        
//        if($banner_status){
//             $banner[0] = $banner[0] + $banner_status[0] ;
//        }
//        */
//       // var_dump($this->db->last_query());
//        return $banner;
//    }

       function getBanner($id = '') {
            $this->db->select('bnr_id AS app_banner_id, bnr_status AS app_banner_status, '
                    . 'CONCAT("https://www.royaldrive.in/assets/uploads/banner/", ' . ', bnr_image) AS image, bnr_url', FALSE);
            $this->db->from($this->tbl_banners);
            $this->db->where(array('bnr_category' => 2, 'bnr_status' => 1));
            $this->db->order_by('bnr_order');
            if (!empty($id)) {
                 $this->db->where('bnr_id', $id);
                 $banner = $this->db->get()->row_array();
            } else {
                 $banner = $this->db->get()->result_array();
            }
            return $banner;
       }

       function getShowrooms($id = '') {
            $this->db->select('shr_id,shr_id_name,shr_id_call,shr_id_whatsapp AS whatsapp', FALSE);
            $this->db->from($this->tbl_showroom);

            $this->db->order_by('shr_id');
            if (!empty($id)) {
                 $this->db->where('shr_id', $id);
                 $showroom = $this->db->get()->row_array();
            } else {
                 $showroom = $this->db->get()->result_array();
            }
            return $showroom;
       }

       function getQuestions($id = '') {
            $this->db->select('app_faq_id, app_faq_que, app_faq_ans', FALSE);
            $this->db->from($this->tbl_faq);

            $this->db->order_by('app_faq_id');
            if (!empty($id)) {
                 $this->db->where('app_faq_id', $id);
                 $faq = $this->db->get()->row_array();
            } else {
                 $faq = $this->db->get()->result_array();
            }
            return $faq;
       }

  }
  