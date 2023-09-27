<div id="Latest_tab" >
     <?php
     $category = $this->uri->segment(1);
     if (!empty($result)) {
          foreach ($result as $key => $value) {
               $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
               echo ($key != 0 && $key % 6 == 0) ? '</div>' : '';
               echo ($key == 0 || $key % 6 == 0) ? '<div class="item">' : '';
               ?>

               <a title="<?php echo $name; ?>" href="<?php echo site_url($category . '/' . get_url_string($name) . '-' . $value['prd_id']); ?>" class="hproduct-bg">
                    <?php
                    $img = '';
                    if (isset($value['default_image']) && !empty($value['default_image'])) {
                         $img = $value['default_image']['pdi_image'];
                    } else {
                         $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : '';
                    }
                    ?>
                    <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : ''; ?>>
                         <div class="product_box">
                              <div class="image_box">
                                   <?php echo img(array('src' => PRODUCT_BASE_URL . '380X238_' . $img, 'alt' => $value['prd_name'])); ?>
                                   <?php //echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Booked</div>' : ''; ?>
                                   <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : ''; ?>
                                   <p class="price">₹ <?php echo number_format($value['prd_price']); ?></p>
                              </div>
                              <div class="info_box">
                                   <h3><?php echo get_snippet($name, 3); ?></h3> 
                                   <p class=""><?php echo $value['prd_year']; ?>  |  <?php echo number_format($value['prd_km_run']); ?>kms</p>
                              </div>
                         </div>
                    </div>
               </a>
               <?php
               echo ($key == (count($result) - 1)) ? '</div>' : '';
          }
     }
     ?>                 
</div>