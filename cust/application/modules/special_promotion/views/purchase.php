<!-- about Section --> 
<section class="inner_pages" style="margin-top:133px;">
     <div class="container">
          <div class="row" style="padding:0px 0px 20px 0px">  
               <div class="col-sm-12">
                    <!--<h1>Let us keep in touch</h1>-->
                    <div class="contact_box" style="margin-bottom: 0px;">
                         <div class="col-sm-6 padding_0">
                              <img src="images/purchase.jpeg"/>
                         </div>
                         <div class="col-sm-6 padding_0">
                              <div class="form_section">
                                   <div class="col-sm-12">
                                        <h2 class="txt-center">Get in touch with us</h2>
                                   </div>
                                   <form action="" id="frmContactus" method="post" enctype="multipart/form-data">
                                        <input name="eve_event" type="hidden" value="21"/>
                                        <input name="eve_type" type="hidden" value="2"/>
                                        <input name="mailtitle" type="hidden" value="Purchase promotion"/>
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input required autocomplete="off" type="text" name="eve_name"  class="form-control" placeholder="Your name*">
                                             </div>
                                             <div class="form-group">
                                                  <input required minlength="10" autocomplete="off" type="text" name="eve_mobile"  class="form-control numOnlyWithoutMsg" placeholder="Your phone number*">
                                             </div>
                                             <div class="form-group">
                                                  <input required autocomplete="off" type="text" name="eve_location"  class="form-control" placeholder="Your location*">
                                             </div>
                                             <div class="form-group">
                                                  <input required autocomplete="off" type="email" name="eve_email" class="form-control" placeholder="Your email*"
                                                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                             </div>
                                             <div class="form-group">
                                                  <input required autocomplete="off" type="text" name="eve_whatsapp" class="form-control numOnlyWithoutMsg" placeholder="WhatsApp*">
                                             </div>
                                        </div>

                                        <div class="col-sm-6">     
                                             <div class="form-group">
                                                  <input type="hidden" name="eve_vehicle" value="0"/> <!-- ID from rana_product table -->
                                             </div>
                                             <div class="form-group">
                                                  <select required class="form-control" name="eve_year">
                                                       <option value="0">Year</option>
                                                       <?php for($i = 2013; $i <= 2023; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php } ?>
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <select required class="form-control" name="eve_km">
                                                       <option value="0">Kilometer</option>
                                                       <option value="1">Below 50,000</option>
                                                       <option value="2">50,000 - 100,000</option>
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <select data-url="<?php echo site_url('special_promotion/bindModel'); ?>" data-bind="cmbEvModel" data-dflt-select="Select Model" class="form-control bindToDropdown" name="eve_brand" id="vreg_brand">
                                                       <option value="">Select Brand</option>
                                                       <?php foreach ((array) $brand as $key => $value) { ?>
                                                            <option <?php echo $value['brd_id'] == $data['vreg_brand'] ? 'selected="selected"' : ''; ?> value="<?php echo $value['brd_id']; ?>"><?php echo $value['brd_title']; ?></option>
                                                       <?php } ?>
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <select required data-url="<?php echo site_url('special_promotion/bindVarient'); ?>" data-bind="cmbEvVariant" data-dflt-select="Select Variant"
                                                       class="cmbEvModel select2_group form-control bindToDropdown" name="eve_model" id="vreg_model">
                                                       <option value="">Select Model</option>
                                                  </select>
                                             </div>
                                             <div class="form-group">
                                                  <select class="select2_group form-control cmbEvVariant" name="eve_varient" id="vreg_varient">
                                                       <option value="">Select Variant</option>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="col-sm-12"> 
                                             <div class="form-group">
                                                  <button type="submit" class="btn btn-primary btnSubmit">Send</button>
                                                  <div class="msgContactus"></div>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "fe63d506c671ba46667b8018cab74406119acfb3006f534f8129d9cf9f3eedec084640d749c5a27dc8dc9bbec022e4d0", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>


<style>
     /* .form-control { padding: 8px 30px !important; margin-bottom: 16px !important;} */
</style>

<script type="text/javascript">
$(document).ready(function(){
     $('.btnSubmit').click(function(){
	     $(this).text('Please wait ...');
          $(this).prop('disabled', true);
     });
});     
     
</script>