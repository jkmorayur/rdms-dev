<?php
foreach ((array) $newArrivals['product_details'] as $key => $value) {
     $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
     $img = '';
     $imgAlt = '';
     if (isset($value['default_image']) && !empty($value['default_image'])) {
          $img = $value['default_image']['pdi_image'];
          $imgAlt = $value['default_image']['pdi_image_alt'];
     } else {
          $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : '';
          $imgAlt = isset($value['product_images'][0]['pdi_image_alt']) ? $value['product_images'][0]['pdi_image_alt'] : '';
     }
?>
     <a href="<?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>">
          <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : ''; ?>>
               <div class="product_box">
                    <div class="image_box">
                         <?php echo img(array('src' => './assets/uploads/product/380X238_' . $img, 'alt' => $imgAlt)); ?>
                         <?php //echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Booked</div>' : ''; 
                         ?>
                         <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : ''; ?>
                         <?php if (($value['prd_booking_status'] != 40) && ($value['prd_price'] > 0)) {
                              //$value['prd_booking_status'] != 13 && 
                         ?>
                              <p class="price">₹ <?php echo number_format($value['prd_price']); ?></p>
                         <?php } ?>
                         <a href="tel:<?php echo get_settings_by_key('qck_contact_mobile') ?>" data-ss="btn-call" data-p="<?php echo $value['prd_id']; ?>" data-l="<?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>" style="margin-right: 50px;" class="call_actn"><img src="images/call.png"></a>

                         <a href="https://wa.me/<?php echo get_settings_by_key('qck_contact_mobile') ?>?text=Hi, Royad Drive. I would like to know more about <?php echo $name; ?>. Please see this link <?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>" data-ss="btn-wp" data-p="<?php echo $value['prd_id']; ?>" data-l="<?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>" class="call_actn"><img src="images/wp.png"></a>
                    </div>
                    <div class="info_box">
                         <?php
                         $comment = $name;
                         $name = (strlen($comment) > 23) ? substr($comment, 0, 20) . '...' : $comment;

                         ?>

                         <h3 class="veh_name_h3"><?php echo $name; ?></h3>
                         <span class="veh_name_h5" style="display:none"><?php echo $name; ?></span>
                         <p class=""><?php echo $value['prd_year']; ?> | <?php echo number_format($value['prd_km_run']); ?>kms</p>
                    </div>
               </div>
          </div>
     </a>
<?php } ?>