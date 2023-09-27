<meta property="og:url"           content="<?php echo site_url() . 'vehicle/' . $this->uri->segment(2);?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo $productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name'];?>" />
<meta property="og:description"   content="<?php echo $productDetails['prd_desc']?>" />
<meta property="og:image"         content="<?php
  echo isset($productDetails['product_images'][0]['pdi_image']) ?
          site_url() . 'assets/uploads/product/' . $productDetails['product_images'][0]['pdi_image'] : '';
?>" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type='text/javascript'></script>
<script src='https://unpkg.com/spritespin@x.x.x/release/spritespin.js' type='text/javascript'></script>
<style>
     .html5gallery-car-0 {
    position: absolute!important;
    display: block!important;
    overflow: hidden!important;
    left: 12px!important;
    top: 294px!important;
    width: 480px!important;
    height: 84px!important;
    background-color: transparent!important;
    zoom: 85%!important;
    width: 739px!important;
    top: 522px!important;
    height: 91px!important;
     }
     
     @media only screen and (max-width: 600px) {
  .html5gallery-car-0 {
   top: 304px!important;
   zoom: 75%!important;
  }
  .threeSix{
    top: 323px!important;
    left: 400px!important;
    zoom: 75%!important;
  }
}
.threeSix {
    margin-left: 3px!important;
    display: block;
    overflow: hidden;
    position: absolute;
    width: 99px;
    height: 47px;
    top: 456px;
    left: 662px;
}
 .mySpriteSpin{
               z-index: 1;
               top: 2px;
               width: 771px!important;
               height: 436px!important;
               position: absolute!important;
}
.html5gallery {
               overflow: hidden !important;
          }
     </style>
     
<section class="inner_pages">
     <?php
          preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$productDetails['prd_video'], $match);
          $youtube_id = isset($match[1]) ? 'http://img.youtube.com/vi/' . $match[1] . '/2.jpg' : '';
     ?>
     
     <div class="container"> 
          <div class="row">   
               <div class="col-sm-8">
                    <div style="display:none;" class="mySpriteSpin" id='mySpriteSpin'></div>
                    <?php if (!empty($productDetails['product_images'])) {?>
                         <div style="display:none;margin:0 auto;" class="html5gallery" data-skin="gallery" data-width="480" 
                              data-height="272" data-resizemode="fill" data-thumbshowtitle="false" data-responsive="true">
                              <?php if(!empty($productDetails['prd_video'])) { ?>
                                   <a href="<?php echo $productDetails['prd_video']; ?>"><img src="<?php echo $youtube_id; ?>" alt="Youtube Video"></a>
                              <?php } ?>
                              <?php  foreach ($productDetails['product_images'] as $key => $value) {?>
                              <a href="<?php echo site_url() . 'assets/uploads/product/' . $value['pdi_image'];?>"><img src="<?php echo site_url() . 'assets/uploads/product/' . $value['pdi_image'];?>"></a>
                              <?php } ?>
                         </div>
                    <?php }?>

                    <div style="position: absolute;right: 14px;top: 0px;width: 100%;" class="product_box">
                         <div class="image_box">
                              <?php
                                echo ( $productDetails['prd_booking_status'] == 13 ) ? '<div class="booked">Booked</div>' : '';
                                echo ( $productDetails['prd_booking_status'] == 40) ? '<div class="sold booked">Sold Out</div>' : '';
                              ?>
                         </div>
                    </div>
               </div>

               <div class="col-sm-4 detail_cntnt wow bounceInRight" data-wow-delay="1s">
                    <h2><?php echo $productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name'];?><br>
                         <?php if ($productDetails['prd_booked'] != 1 && $productDetails['prd_soled'] != 1) {?>
                                <span>₹ <?php echo number_format($productDetails['prd_price']);?></span>
                           <?php }?>
                    </h2>
                    <?php echo 'Vehicle no : ' . $productDetails['prd_number'];?>
                    <h4>Current Condition :</h4>
                    <p><?php echo $productDetails['prd_desc']?></p>
                    <button style="padding: 10px 20px;" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ContactWithSeller">Connect with Seller</button>
                    <?php if ($productDetails['prd_loan_avail'] == 1) {?>
                           <button style="padding: 10px 20px;" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#emiCalculator">EMI Calculator</button>
                    <?php }?>
                    <div class="share">
                         <p>
                              Share with friends
                              <!--                              <a class="social" href="#" target="_blank">
                                                                 <i class="fa fa-facebook">
                                                                 </i>
                                                            </a>
                                                            <a class="social" href="#" target="_blank">
                                                                 <i class="fa fa-twitter">
                                                                 </i>
                                                            </a>
                                                            <a class="social" href="#" target="_blank">
                                                                 <i class="fa fa-google-plus">
                                                                 </i>
                                                            </a>-->
                              <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>

                         <div class="a2a_kit a2a_kit_size_32 a2a_default_style" 
                              data-a2a-url="<?php echo site_url() . 'vehicle/' . $this->uri->segment(2);?>" 
                              data-a2a-title="<?php echo $productDetails['prd_name']?>">
                              <a class="a2a_button_facebook indproduct-social"></a>
                              <a class="a2a_button_twitter indproduct-social"></a>
                              <a class="a2a_button_google_plus indproduct-social"></a>
                              <a class="a2a_button_whatsapp"></a>
                         </div>
                         </p>
                    </div>
                           
                           
               </div>

               <div class="col-sm-12 iconic_block padding_0">
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-01.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_year'];?></p>
                              <p class="info">Year</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.2s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-02.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_color'];?>..
                                   <?php if(isset($productDetails['prd_wrapp_color']) && !empty($productDetails['prd_wrapp_color'])) { ?>
                                        <br><small> (<?php echo $productDetails['prd_wrapp_color']; ?>) </small>
                                   <?php } ?>
                              </p>
                              <p class="info">Color</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.4s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-03.svg">
                              </div>                        
                              <p class="value"><?php echo number_format($productDetails['prd_km_run']);?></p>
                              <p class="info">Kms</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.6s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-04.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_owner'];?></p>
                              <p class="info">Owner</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-05.svg">
                              </div>                        
                              <p class="value"><?php echo ucfirst($productDetails['prd_fual']);?></p>
                              <p class="info">Fuel</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.2s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-06.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_mileage']?> kmpl</p>
                              <p class="info">Mileage</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.4s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-07.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_engine_cc']?></p>
                              <p class="info">Engine CC</p>
                         </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 wow fadeInUp" data-wow-offset="10" data-wow-delay="0.6s">
                         <div class="text-center icon_box">
                              <div class="icon">
                                   <img src="images/detail_icons-08.svg">
                              </div>                        
                              <p class="value"><?php echo $productDetails['prd_insurance_validity']?></p>
                              <p class="info">Insurance Validity</p>
                         </div>
                    </div>
               </div>

               <div class="col-sm-12 wow fadeInUp" data-wow-offset="10">
                    <div class="info_bx">
                         <?php
                           $productFeatures = !empty($productDetails['product_features']) ?
                                   explode(',', $productDetails['product_features']) : array();
                           foreach ((array) $features as $key => $value) {
                                echo ($key != 0 && $key % 7 == 0) ? '</ul></div>' : '';
                                echo ($key == 0 || $key % 7 == 0) ? '<div class="col-sm-6 border-right"><ul>' : '';
                                if (in_array($value['ftr_id'], $productFeatures)) {
                                     ?>
                                     <li><i class="fa fa-check-circle-o"></i><?php echo $value['ftr_feature']?></li>
                                <?php } else {?>
                                     <li><i class="fa fa-times-circle-o"></i><?php echo $value['ftr_feature']?></li>
                                     <?php
                                }
                                echo ($key == (count($features) - 1)) ? '</ul></div>' : '';
                           }
                         ?>
                         <!--                         <div class="col-sm-6 border-right">
                                                       <ul>
                                                            <li><i class="fa fa-check-circle-o"></i>Adjustable Seats</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Adjustable Steering</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Air Conditioner</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Anti Lock Braking System</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Central Locking</li>
                                                            <li><i class="fa fa-times-circle-o"></i>Crash Sensor</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Digital Clock</li>                            
                                                       </ul>
                                                  </div>
                                                  <div class="col-sm-6">
                                                       <ul>
                                                            <li><i class="fa fa-check-circle-o"></i>Driver Airbag</li>
                                                            <li><i class="fa fa-check-circle-o"></i>DVD Player</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Heater</li>
                                                            <li><i class="fa fa-times-circle-o"></i>Navigation System</li>
                                                            <li><i class="fa fa-times-circle-o"></i>Parking Sensors</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Power Door Locks</li>
                                                            <li><i class="fa fa-check-circle-o"></i>Rear Camera </li>  
                                                       </ul>
                                                  </div>-->
                    </div>
               </div>

               <div class="popular similar" >
                    <div class="col-sm-12">
                         <h1>Similar cars in our list</h1>
                    </div>
                    <div class="owl-carousel">
                         <?php
                           foreach ($relatedVehicle as $key => $value) {
                                $name = $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name'];
                                echo ($key != 0 && $key % 3 == 0) ? '</div>' : '';
                                echo ($key == 0 || $key % 3 == 0) ? '<div class="item">' : '';
                                ?>

                                <a title="<?php echo $name;?>" href="<?php echo site_url() . 'vehicle/' . $value['prd_id'] . '-' . get_url_string($value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name']);?>" class="hproduct-bg">
                                     <?php
                                     $img = '';
                                     if (isset($value['default_image']) && !empty($value['default_image'])) {
                                          $img = $value['default_image']['pdi_image'];
                                     } else {
                                          $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : '';
                                     }
                                     ?>
                                     <div class="col-sm-4 wow fadeInUp" data-wow-offset="10" <?php echo $key > 0 ? ' data-wow-delay="0.2s"' : '';?>>
                                          <div class="product_box">
                                               <div class="image_box">
                                                    <?php echo img(array('src' => './assets/uploads/product/380X238_' . $img, 'alt' => $value['prd_name']));?>
                                                    <?php if ($value['prd_booked'] != 1 && $value['prd_soled'] != 1) {?>
                                                         <p class="price">₹ <?php echo number_format($value['prd_price']);?></p>
                                                    <?php }?>
                                                    <?php echo ($value['prd_booked'] == 1 && $value['prd_soled'] != 1) ? '<div class="booked">Booked</div>' : '';?>
                                                    <?php echo ($value['prd_soled'] == 1) ? '<div class="sold booked">Sold Out</div>' : '';?>
                                                    <a href="tel:<?php echo get_settings_by_key('qck_contact_mobile')?>" class="call_actn"><img src="images/call.png"></a>
                                               </div>
                                               <div class="info_box">
                                                    <h3><?php echo get_snippet($name, 5);?></h3> 
                                                    <p class=""><?php echo $value['prd_year'];?>  |  <?php echo @number_format($value['prd_km_run']);?> kms</p>
                                               </div>
                                          </div>
                                     </div>
                                </a>
                                <?php
                                echo ($key == (count($relatedVehicle) - 1)) ? '</div>' : '';
                           }
                         ?>
                    </div>
               </div>
          </div>
     </div>
</section>

<div class="modal fade" id="ContactWithSeller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-vertical-centered modal-lg">
          <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <div class="modal-header">                
                    <h2 class="modal-title text-center" id="myModalLabel">Connect with Seller</h2>
               </div>
               <div class="row">
                    <div class="modal-body">
                         <form class="refer_friend advnc_srch frmConnectWithSeller" action="<?php echo site_url('search/connectToseller');?>">
                              <input type="hidden" name="cws_prod_id" value="<?php echo $productDetails['prd_id'];?>"/>
                              <input type="hidden" name="cws_url" value="<?php echo site_url('vehicle') . '/' . $productDetails['prd_id'] . '-' . get_url_string($productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name']);?>"/>
                              <div class="col-sm-6">
                                   <div class="form-group">
                                        <input name="cws_first_name" id="cws_first_name" type="text" class="form-control" required="true" placeholder="Enter your first name"/>
                                   </div>
                                   <div class="form-group">
                                        <input name="cws_email" id="cws_email" type="text" class="form-control" placeholder="Enter email address " />
                                   </div>
                              </div>
                              <div class="col-sm-6">
                                   <div class="form-group">
                                        <input name="cws_last_name" id="cws_last_name" type="text" class="form-control" placeholder="Enter your last name " />
                                   </div>
                                   <div class="form-group">
                                        <input name="cws_phone" id="cws_phone" type="text" class="form-control" placeholder="Enter your phone number " />
                                   </div>
                              </div>
                              <div class="col-sm-12">
                                   <div class="form-group">
                                        <textarea  name="cws_comments" id='cws_comments' cols="" rows="" class="form-control-textarea" placeholder="Enter your comments"></textarea>
                                   </div>
                              </div>

                              <div class="col-sm-12">
                                   <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-link">Clear</button>                  
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div><!-- /.modal-content -->                           
     </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="emiCalculator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-vertical-centered modal-lg">
          <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <div class="modal-header">                
                    <h2 class="modal-title text-center" id="myModalLabel">EMI Calculator (<?php echo $productDetails['brd_title'] . ' ' . $productDetails['mod_title'] . ' ' . $productDetails['var_variant_name'];?>)</h2>
               </div>
               <div class="row">
                    <div class="modal-body">
                         <form class="refer_friend advnc_srch frmEMICalculator" action="<?php echo site_url('vehicle/emiCalculator');?>">
                              <input type="hidden" name="emi_prod_id" value="<?php echo $productDetails['prd_id'];?>"/>

                              <div class="col-sm-12">
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <span class="form-control-label">Vehicle amount</span> 
                                        </div>
                                   </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <input readonly="true" autocomplete="off" type="text" class="form-control" 
                                                    name="emi_prod_price" value="<?php echo $productDetails['prd_price'];?>"/>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-12">
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <span class="form-control-label">Loan amount <span>*</span> </span>
                                        </div>
                                   </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <?php
                                               $defTenure = 0;
                                               $tun = ($productDetails['prd_year'] + 10) - date('Y');
                                               if ($tun <= 5) {
                                                    $defTenure = abs($tun);
                                               } else if ($tun > 5) {
                                                    $defTenure = get_settings_by_key('emi_def_tenure');
                                               }
                                               $defPerLoanAmt = get_settings_by_key('emi_def_loan_amt_perce');
                                               $defPer = get_settings_by_key('emi_def_perce');

                                               $loanAmt = ($productDetails['prd_price'] * $defPerLoanAmt) / 100;
                                             ?>
                                             <input name="emi_loan_amt" autocomplete="off" type="text" 
                                                    class="numOnly form-control emi_loan_amt" value="<?php echo $loanAmt;?>"/>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-12">
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <span class="form-control-label">Percentage rate of interest <span>*</span></span>
                                        </div>
                                   </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <input name="emi_int_per" autocomplete="off" type="text" 
                                                    class="numOnly form-control emi_int_per" value="<?php echo $defPer;?>"/>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-12">
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <span class="form-control-label">Tenure (Year) <span>*</span></span> 
                                        </div>
                                   </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                             <input name="emi_tenure" autocomplete="off" type="text" 
                                                    class="numOnly form-control emi_int_per" value="<?php echo $defTenure;?>"/>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-12">
                                   <div class="col-sm-6">
                                        <div class="form-group divEMIError" style="float: right;font-size: 12px;font-weight: bold;color: red;"></div>
                                   </div>
                              </div>

                              <div class="col-sm-12">
                                   <div class="col-sm-12">
                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary btnCalculate">Calculate</button>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-12 divEMICalcResult"></div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>

<style>
     .form-control-label {
          display: block;
          width: 100%;
          padding: 15px 30px;
          font-size: 16px;
          font-weight: bolder;
          line-height: 1.42857143;
          color: rgba(51,51,51,0.8);
          background-color: #fff;
          border: none;
          border-radius: 50px;
          border: 1px solid #cfcfcf;
     }
</style>
<div class="modal fade" id="emiCalculatorWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-vertical-centered modal-lg">
          <div class="modal-content" style="float: left;">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <div class="modal-header">                
                    <h2 class="modal-title text-center" id="myModalLabel">EMI Calculator Info</h2>
               </div>

               <div class="modal-body">
                    <p>Above eligibility is subject to you, complying with bank Sanction terms & conditions including</p>
                    <ul class="fa-ul">
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Submission of necessary login Documents</i></li>
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Signing of necessary Loan Agreements & related documents</i></li>
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Providing appropriate Collateral Security or demanded documents of finance company or both</i></li>
                    </ul>
               </div>
               
               <div class="modal-footers" style="padding: 35px;">
                    <button type="button" class="btn btn-primary btnEMIAgree" data-dismiss="modal">Agree</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<script>
     var formData = '';
     $(document).on('submit', '.frmEMICalculator', function (e) {
          e.preventDefault();
          $('.divEMIError').html('');
          $('.divEMICalcResult').html('');
          formData = $('.frmEMICalculator').serializeArray();
          var emi_loan_amt = formData[2]['value'].trim(); //loadn amount
          var emi_int_per = formData[3]['value'].trim(); //interest rate
          var emi_tenure = formData[4]['value'].trim(); //tenure
          if (emi_loan_amt !== '' && emi_int_per !== '' && emi_tenure !== '') {
               $('#emiCalculatorWarning').modal();
          } else {
               $('.divEMIError').html('Please fill all details');
          }
     });
     $(document).on('click', '.btnEMIAgree', function (e) {
          $.ajax({
               type: 'post',
               url: '<?php echo site_url('vehicle/emiCalculator');?>',
               data: formData,
               beforeSend: function (xhr) {
                    $('.btnCalculate').html('Calculating please wait...');
               },
               success: function (resp) {
                    $('.divEMICalcResult').html(resp);
                    $('.divLoading').hide();
                    $('.btnCalculate').html('Calculate');
               },
               submitHandler: function () {

               }
          });
     });
     
   </script>
   <script type="text/javascript">
     $(document).ready(function () {


//          $(document).on('click', 'a[id^="html5gallery-tn-0-*"]', function () {
          $(document).on('click', '.html5gallery-car-mask-0', function () {

               $('.html5gallery-elem-0').show();
               $('#mySpriteSpin').hide();
               $('.html5gallery-title-text-0').show();
          });
          $('#html5-watermark').hide();
          $('#html5-title').hide();
     });
     $('.360img').click(function (e) {
          $('.html5gallery-elem-0').hide();
          $('#mySpriteSpin').show();
          $('.html5gallery-title-text-0').hide();
     });
     $('.html5gallery-car-mask').click(function (e) {
          alert();
     });

</script>
<script type='text/javascript'>
     $("#mySpriteSpin").spritespin({
          // path to the source images.
          source: [
               "360/download (1).PNG",
               "360/download (2).PNG",
               "360/download (3).PNG",
               "360/download (4).PNG",
               "360/download (5).PNG",
               "360/download (6).PNG",
               "360/download (7).PNG",
               "360/download (8).PNG",
               "360/download (9).PNG",
               "360/download (10).PNG",
               "360/download (11).PNG",
               "360/download (12).PNG",
               "360/download (13).PNG",
               "360/download (14).PNG",
               "360/download (15).PNG",
               "360/download (16).PNG",
          ],
          width: 480, // width in pixels of the window/frame
          height: 327,
          animate: false, // height in pixels of the window/frame
     });
</script>