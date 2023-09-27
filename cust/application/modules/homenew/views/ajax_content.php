<?php
if (!empty($newArrivals['product_details'])) {
     foreach ($newArrivals['product_details'] as $key => $value) {
          $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
          echo ($key != 0 && $key % 6 == 0) ? '</div>' : '';
          echo ($key == 0 || $key % 6 == 0) ? '<div class="item">' : '';
          ?>
          <a title="<?php echo $name; ?>" href="<?php echo site_url() . 'vehicle/' . $value['prd_id'] . '-' . get_url_string($value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name']); ?>" class="hproduct-bg">
               <?php
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
               <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : ''; ?>>
                    <div class="product_box">
                         <div class="image_box" img="<?php echo $img; ?>">
                              <?php echo img(array('src' => './assets/uploads/product/380X238_' . $img, 'alt' => $imgAlt)); ?>
                              <?php //echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Booked</div>' : ''; ?>
                              <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : ''; ?>
                              <?php if (($value['prd_soled'] != 1) && ($value['prd_price'] > 0)) { 
                                   // $value['prd_booked'] != 1 && ?>
                                   <p class="price">₹ <?php echo number_format($value['prd_price']); ?></p>
                              <?php } ?>
                              <a href="tel:<?php echo get_settings_by_key('qck_contact_mobile') ?>" 
                              data-ss="btn-call" data-p="<?php echo $value['prd_id']; ?>" 
                              data-l="<?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>"
                              style="margin-right: 50px;" class="call_actn"><img src="images/call.png"></a>
                              
                              <a href="https://wa.me/<?php echo get_settings_by_key('qck_contact_mobile') ?>?text=Hi, Royad Drive. I would like to know more about <?php echo $name; ?>. Please see this link <?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>" 
                              data-ss="btn-wp" data-p="<?php echo $value['prd_id']; ?>" 
                              data-l="<?php echo site_url($value['brd_slug'] . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>"
                              class="call_actn"><img src="images/wp.png"></a>
                         </div>
                         <div class="info_box"> 
                              <h3>PC--<?php echo get_snippet($name, 4); ?></h3> 
                              <p class=""><?php echo $value['prd_year']; ?>  |  <?php echo number_format($value['prd_km_run']); ?>kms</p>
                         </div>
                    </div>
               </div>
          </a>
          <?php
          echo ($key == (count($newArrivals['product_details']) - 1)) ? '</div>' : '';
     }
}
?>  