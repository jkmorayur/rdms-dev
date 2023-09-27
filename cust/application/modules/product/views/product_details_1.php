<meta property="og:url"           content="<?php echo site_url() . 'vehicle/' . $this->uri->segment(2); ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo $productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name']; ?>" />
<meta property="og:description"   content="<?php echo $productDetails['prd_desc'] ?>" />
<meta property="og:image"         content="<?php
  echo isset($productDetails['product_images'][0]['pdi_image']) ?
          site_url() . 'assets/uploads/product/' . $productDetails['product_images'][0]['pdi_image'] : '';
?>" />

<link type="text/css" rel="stylesheet" href="styles/easy-responsive-tabs.css" />
<link rel="stylesheet" href="styles/bootstrap.min.css"/>
<script src="scripts/jquery.validate.min.js"></script>
<script defer src="scripts/jquery.flexslider.js"></script>
<link rel="stylesheet" type="text/css" href="styles/slider.css"/>
<link rel="stylesheet" href="styles/flexslider.css" type="text/css" media="screen" />
<script>
     // Can also be used with $(document).ready()
     $(window).load(function() {
          $('.flexslider').flexslider({
               animation: "slide",
               controlNav: "thumbnails",
               animationLoop: true,
               slideshow: false
          });
     });
</script>      

<style type="text/css">
     .header-support{
          color:#039de2;
     }
     .field_label{
          min-height:30px;margin-bottom:20px;}
     .eng-btn{
          padding:8px 20px;font-size:16px;font-weight:600;
     }	
     span.error  {
          color: red;
          display: none !important;
     }
     input.error {
          border-bottom: 1px solid red;
     }
</style>
<!--FOOTER-->
<div id="specification-wrapper">
     <div id="specification-inner">
          <div id="product_singleimage">
               <div class="flexslider">
                    <ul class="slides">
                         <?php if (!empty($productDetails['product_images'])) { ?>
                                <?php foreach ($productDetails['product_images'] as $key => $value) { ?>
                                     <li data-thumb="uploads/product/thumb_<?php echo $value['pdi_image']; ?>">
                                          <div class="thumb-image"> 
                                               <?php
                                               echo img(array('src' => './assets/uploads/product/' . $value['pdi_image'],
                                                   'class' => 'img-responsive', 'data-imagezoom' => 'true'));
                                               ?>
                                     </li>
                                <?php } ?>
                           <?php } ?>
                    </ul>
               </div>
          </div>

          <div id="product_singledes">
               <div class="indproduct_name">
                    <?php echo $productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name']; ?>
               </div>
               <h4>
                    <?php echo 'Vehicle no : '.$productDetails['prd_number']; ?>
               </h4>
               
               <span><?php echo (isset($productDetails['prd_year']) && $productDetails['prd_year'] != '0') ? 'Year : ' .$productDetails['prd_year'] : ''; ?></span>
               <div class="indproduct_des"><?php echo $productDetails['prd_desc'] ?></div>
               <div class="indproduct_price"> &#2352; <?php echo number_format($productDetails['prd_price']); ?></div>
               <a href="#" class="indproduct_connect prolink7" data-toggle="modal" data-target="#myModa01">Connect with Seller </a>
               <div class="indproduct_des"> Share with friends<br>
                    <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>

                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style" 
                         data-a2a-url="<?php echo site_url() . 'vehicle/' . $this->uri->segment(2); ?>" 
                         data-a2a-title="<?php echo $productDetails['prd_name'] ?>">
                         <a class="a2a_button_facebook indproduct-social"></a>
                         <a class="a2a_button_twitter indproduct-social"></a>
                         <a class="a2a_button_google_plus indproduct-social"></a>
                    </div>

                    <!-- -->
<!--                    <a href="javascript:void(0);"><img src="images/facebook-pro.png" alt="facebook" class="indproduct-social"></a>
                    <a href="javascript:void(0);"><img src="images/twitter-pro.png" alt="twitter" class="indproduct-social"></a>
                    <a href="javascript:void(0);"><img src="images/mail-pro.png" alt="mail" class="indproduct-social"></a>-->
               </div>

               <!-- Modal -->
               <div class="modal fade" id="myModa01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                   <h4 class="modal-title" id="myModalLabel">Connect with Seller</h4>
                              </div>
                              <form class="modal-body frmConnectWithSeller" method="post" action="<?php echo site_url('search/connectToseller'); ?>">
                                   <input type="hidden" name="cws_prod_id" value="<?php echo $productDetails['prd_id']; ?>"/>
                                   <input type="hidden" name="cws_url" value="<?php echo site_url('vehicle') . '/' . $productDetails['prd_id'] . '-' . get_url_string($productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name']); ?>"/>
                                   <div class="field_box">
                                        First Name
                                        <input name="cws_first_name" id="cws_first_name" type="text" class="refinesearch-input" placeholder="Enter your first name"/>
                                   </div>
                                   <div class="field_box">
                                        Last Name
                                        <input name="cws_last_name" id="cws_last_name" type="text" class="refinesearch-input" placeholder="Enter your last name " />
                                   </div>

                                   <div class="field_box">
                                        Email Address
                                        <input name="cws_email" id="cws_email" type="text" class="refinesearch-input" placeholder="Enter email address " />
                                   </div>
                                   <div class="field_box">
                                        Phone Number
                                        <input name="cws_phone" id="cws_phone" type="text" class="refinesearch-input" placeholder="Enter your phone number " />
                                   </div>

                                   <div class="field_new2">
                                        Comments
                                        <textarea  name="cws_comments" id='cws_comments' cols="" rows="" class="refinesearch-textarea" placeholder="Enter your comments"></textarea>
                                   </div>

                                   <div class="field_new2">
                                        <input type="submit"  value="Submit" class="eng-btn" >
                                   </div>

                                   <div style="clear:both"></div>
                              </form>
                         </div>
                    </div>
               </div>
               <!-- Modal -->			
          </div><!--product_singledes-->


          <!--inner-details-box-->

          <div class="inner_tabbg">

               <!--Horizontal Tab-->
               <div id="horizontalTab">
                    <ul class="resp-tabs-list">
                         <li>Specifications</li>
                         <li>Features </li>
                    </ul>

                    <div class="resp-tabs-container" >
                         <div>
                              <?php /* if (!empty($productDetails['product_specification'])) { ?>
                                  <?php foreach ($productDetails['product_specification'] as $key => $value) { ?>
                                  <div class="tab-specificationbg">
                                  <div class="tab-spe-cap"><?php echo $value['spe_specification']; ?></div>
                                  <div class="tab-spe-des"><?php echo $value['spe_specification_detail']; ?></div>
                                  </div>
                                  <?php } ?>
                                  <?php } */ ?>
                              <div id="inner-details-box">

                                   <div class="detalis-box">
                                        Model
                                        <span><?php echo $productDetails['mod_title'] ?></span>
                                   </div>
                                   <div class="detalis-box">
                                        Driven <?php $kmRun = (isset($productDetails['prd_km_run']) && !empty($productDetails['prd_km_run'])) ? str_replace(',', '', $productDetails['prd_km_run']) : ''; ?>
                                        <span> <?php echo ($kmRun) ? number_format($kmRun) : 0; ?> kms </span>
                                   </div>
                                   <div class="detalis-box">
                                        Fuel
                                        <span> <?php echo $productDetails['prd_fual']; ?> </span>
                                   </div>
                                   <div class="detalis-box">
                                        Mileage
                                        <span> <?php echo $productDetails['prd_mileage'] ?> kmpl </span>
                                   </div>
                                   <div class="detalis-box">
                                        Owner
                                        <span> <?php echo $productDetails['prd_owner'] ?> </span>
                                   </div>
                                   <div class="detalis-box">
                                        Engine in cc
                                        <span> <?php echo $productDetails['prd_engine_cc'] ?> cc </span>
                                   </div>
                                   <div class="detalis-box">
                                        Color
                                        <span> <?php echo $productDetails['prd_color'] ?> </span>
                                   </div>
                              </div>
                              <div style="clear:both;"></div>
                         </div>

                         <div>
                              <?php
                                $productFeatures = !empty($productDetails['product_features']) ?
                                        explode(',', $productDetails['product_features']) : array();
                              ?>
                              <?php if (!empty($features)) { ?>
                                     <?php foreach ($features as $key => $value) { ?>
                                          <div class="tab-specificationbg">
                                               <div class="tab-spe-cap"><?php echo $value['ftr_feature'] ?></div>
                                               <div class="tab-spe-des">
                                                    <?php if (in_array($value['ftr_id'], $productFeatures)) { ?>
                                                         <img src="images/green.png" alt="<?php echo $value['ftr_feature'] ?>"/>
                                                    <?php } else { ?>
                                                         <img src="images/red.png" alt="<?php echo $value['ftr_feature'] ?>"/>
                                                    <?php } ?>
                                               </div>
                                          </div>
                                     <?php } ?>
                                <?php } ?>
                              <div style="clear:both;"></div>
                         </div>
                    </div><!--resp-tabs-container-->
               </div><!--Horizontal Tab-->
          </div><!--inner_tabbg--> 	
          <div style="clear:both"></div>
     </div><!--specification-headerinner-->
</div><!--specification-header-->
<script src="scripts/imagezoom.js"></script>
<script src="scripts/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
     $(document).ready(function() {
          $('#horizontalTab').easyResponsiveTabs({
               type: 'default', //Types: default, vertical, accordion           
               width: 'auto', //auto or any width like 600px
               fit: true, // 100% fit in a container
               closed: 'accordion', // Start closed if in accordion view
               activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);

                    $name.text($tab.text());

                    $info.show();
               }
          });
     });

</script>      
<script src="scripts/bootstrap.min.js"></script>     
