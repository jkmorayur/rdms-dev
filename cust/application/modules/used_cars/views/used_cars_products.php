<section class="inner_pages">
     <div class="container">
          <?php cms($urisegment); ?>
          <div class="row">  
               <div class="col-sm-12 padding_0">
                    <div class="col-sm-12 result_sec">
                         <!-- <h2><span><?php //echo isset($result) ? count($result) : 0; ?> vehicles found</span></h2> -->
                    </div>
                    <div class="bs-example search_results">
                         <div class="tab-content">
                              <div id="popular">
                                   <div class="divProducts">
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
                                                                      <div class="image_box" id="<?php echo $value['prd_soled']; ?>" bkd="<?php echo $value['prd_booked']; ?>">
                                                                           <?php echo img(array('src' => PRODUCT_BASE_URL . '380X238_' . $img, 'alt' => $value['prd_name'])); ?>
                                                                           <?php //echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Reserved</div>' : ''; ?>
                                                                           <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : ''; ?>
                                                                           <?php if (($value['prd_soled'] != 1) && ($value['prd_price'] > 0)) { 
                                                                                //$value['prd_booked'] != 1 && ?>
                                                                                <p class="price">₹ <?php echo $value['prd_price'] > 0 ? number_format($value['prd_price']) : ''; ?></p>
                                                                           <?php } ?>
                                                                      </div>
                                                                      <div class="info_box">
                                                                           <h3><?php echo get_snippet($name, 3); ?></h3> 
                                                                           <p class=""><?php echo $value['prd_year']; ?> | <?php echo number_format($value['prd_km_run']); ?> kms</p>
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
                                   </div>
                                   <div style="width: 100%;float: left;" id="pagination"><?php echo $pagination; ?></div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

<script type='text/javascript'>
     $(document).ready(function () {
          $('#pagination').on('click', 'a', function (e) {
               console.log('#pagination>a');
               e.preventDefault();
               var pageno = $(this).attr('data-ci-pagination-page');
               loadPagination(pageno);
          });

          function loadPagination(pagno) {
               $.ajax({
                    url: site_url + '<?php echo $urisegment . "/xhr/" ?>' + pagno,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                         $('#pagination').html(response.pagination);
                         $('.divProducts').html(response.result);
                         window.scrollTo({top: 0, behavior: 'smooth'});
                    }
               });
          }
     });
</script>