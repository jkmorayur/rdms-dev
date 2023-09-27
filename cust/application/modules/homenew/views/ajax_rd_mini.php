<?php
  foreach ((array) $rdMini['product_details'] as $key => $value) {
       $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
       $img = '';
       if (isset($value['default_image']) && !empty($value['default_image'])) {
            $img = $value['default_image']['pdi_image'];
       } else {
            $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : '';
       }
       ?>
       <a href="<?php echo site_url() . 'vehicle/' . $value['prd_id'] . '-' . get_url_string($value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name']);?>">
            <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : '';?>>
                 <div class="product_box">
                      <div class="image_box">
                           <?php echo img(array('src' => './assets/uploads/product/380X238_' . $img, 'alt' => $value['prd_name']));?>
                                  <?php //echo ($value['prd_booking_status'] == 13) ? '<div class="booked">Booked</div>' : '';?>
                                  <?php echo ($value['prd_booking_status'] == 28) ? '<div class="booked">Booked</div>' : '';?>
                                  <?php echo ($value['prd_booking_status'] == 40) ? '<div class="sold booked">Sold Out</div>' : '';?>
                                  <p class="price">₹ <?php echo number_format($value['prd_price']);?></p>
                                  <a href="tel:<?php echo get_settings_by_key('qck_contact_mobile')?>" class="call_actn"><img src="images/call.png"></a>
                             </div>
                             <div class="info_box">
                           <h3><?php echo get_snippet($name, 4);?></h3> 
                           <p class=""><?php echo $value['prd_year']? $value['prd_year'].'|':'';?> <?php echo number_format($value['prd_km_run']) . '-' . $value['prd_id'];?>-kms</p>
                      </div>
                 </div>
            </div>
       </a>
  <?php
  }?>