<link rel="stylesheet" type="text/css" href="styles/style.css"/>
<link rel="stylesheet" type="text/css" href="styles/metro2.css"/>
<style type="text/css">     .header-support{color:#039de2;}     #refinesearchbg{width:100%;}</style>
<div id="inner-wrapper">
     <div id="inner-inner">
          <div class="matterbg">
               <div id="refinesearchbg">
                    <h1>Post Your Car</h1>
                    <form method="post" id="frmPostYourCar" action="<?php echo site_url('sell_your_vehicle/postCarDetails');?>">
                         <div class="field_new">
                              Brand <span for="basicinfo[prd_brand]" generated="true" class="error"></span>                              
                              <span class="css4-metro-dropdown" style="width:101%;">
                                   <?php if (!empty($brands)) {?>                                          
                                          <select name="basicinfo[prd_brand]" class="cmbBindModel" data-url="<?php echo site_url('sell-your-vehicle/bindModel');?>">
                                               <option value="">Select Brand</option>
                                               <?php foreach ($brands as $key => $value) {?>                                                    
                                                    <option value="<?php echo $value['brd_id'];?>"><?php echo $value['brd_title'];?></option>
                                               <?php }?>                                          
                                          </select>
                                     <?php }?>                              
                              </span>
                         </div>
                         <div class="field_new field_new-margin">
                              Model <span for="basicinfo[prd_model]" generated="true" class="error"></span>                              
                              <span class="field_label spanModel" style="width:101%;">
                                   <span class="css4-metro-dropdown" style="width:101%;">
                                        <select name="basicinfo[prd_model]">
                                             <option value="">Select Brand First</option>
                                        </select>
                                   </span>
                              </span>
                         </div>
                         <div class="field_new">
                              Variant <span for="basicinfo[prd_variant]" generated="true" class="error"></span>                              
                              <span class="field_label spanVarient" style="width:101%;">
                                   <span class="css4-metro-dropdown" style="width:101%;">
                                        <select name="basicinfo[prd_variant]">
                                             <option value="">Select Model First</option>
                                        </select>
                                   </span>
                              </span>
                         </div>
                         <div class="field-inner">
                              <div class="field_new">Price 
                                   <span for="basicinfo[prd_price]" generated="true" class="error"></span>                                   
                                   <input type="number" name="basicinfo[prd_price]" class="refinesearch-input" placeholder="Price" />                              </div>
                              <div class="field_new field_new-margin">Kms Driven                                   
                                   <input type="number" name="basicinfo[prd_km_run]" class="refinesearch-input" placeholder="Kms Driven" />                              </div>
                              <div class="field_new">
                                   Fuel Type                                   
                                   <span class="css4-metro-dropdown" style="width:101%;">
                                        <select name="basicinfo[prd_fual]">
                                             <option value="0">Select Fuel Type</option>
                                             <option value="diesel">Diesel</option>
                                             <option value="petrol">Petrol</option>
                                             <option value="gas">Gas</option>
                                             <option value="Hybrid">Hybrid</option>
                                             <option value="Electric">Electric</option>
                                             <option value="CNG">CNG</option>
                                        </select>
                                   </span>
                              </div>
                              <div class="field_new">
                                   Color                                   
                                   <span class="css4-metro-dropdown" style="width:101%;">
                                        <select name="basicinfo[prd_color]" class="refinesearch-input css4-metro-dropdown" placeholder="Color" >
                                             <option value="none">Select color</option>
                                             <option value="Black">Black</option>
                                             <option value="Blue">Blue</option>
                                             <option value="Gray">Gray</option>
                                             <option value="Red">Red</option>
                                             <option value="Silver">Silver</option>
                                             <option value="White">White</option>
                                             <option value="Beige">Beige</option>
                                             <option value="Golden">Golden</option>
                                             <option value="Green">Green</option>
                                             <option value="Orange">Orange</option>
                                             <option value="Purple">Purple</option>
                                             <option value="Yellow">Yellow</option>
                                             <option value="Other">Other</option>
                                        </select>
                                   </span>
                     <!--    <input type="text" name="basicinfo[prd_color]" class="refinesearch-input" placeholder="Color"/> -->                              
                              </div>
                              <div class="field_new field_new-margin">                                   
                                   Mileage                                   
                                   <input type="number" name="basicinfo[prd_mileage]" class="refinesearch-input" placeholder="Mileage"/>                              </div>
                              <div class="field_new">                                   Owner Type                                   
                                   <input type="text" name="basicinfo[prd_owner]" class="refinesearch-input" placeholder="Owner Type"/>                              </div>
                         </div>

                         <div class="field-inner">
                              <div class="field_new">Engine in cc
                                   <input type="text" name="basicinfo[prd_engine_cc]" class="refinesearch-input" placeholder="Engine in cc" />
                              </div>
                              <div class="field_new field_new-margin">Insurance validity
                                   <input type="text" name="basicinfo[prd_insurance_validity]" class="refinesearch-input" placeholder="Insurance validity" />
                              </div>
                              <div class="field_new ">Year of registered
                                   <span class="css4-metro-dropdown" style="width:101%;">
                                        <select name="basicinfo[prd_year]" class="refinesearch-input css4-metro-dropdown" placeholder="Year of registered" >
                                             <option value="none">Select year</option>
                                             <?php for ($i = date('Y') - 30; $i <= date('Y'); $i++) {?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                               <?php }?>
                                        </select>
                                   </span>                         
                              </div>
                         </div>
                         <div class="field-inner">
                              <div class="field_new_textarea">Details
                                   <span class="field_label" style="width:101%;">
                                        <textarea name="basicinfo[prd_desc]" class="refinesearch-input-textarea"></textarea>
                                   </span>
                              </div>
                              <div class="field_new_upload">
                                   <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span style='color: #656464'>Select Image to Upload / Drag and Drop Files.</span>
                                        <input id="fileupload" type="file" name="files" multiple>
                                   </span>                              
                              </div>
                              <div style="float: left;width: 100%;">
                                   <div id="progress" class="progress">
                                        <div class="progress-bar progress-bar-success"></div>
                                   </div>
                                   <div id="files" class="files"></div>
                              </div>
                              <div style="float: left;width: 100%;" class="divImageCollection"></div>
                         </div>
                         <div class="field-inner">
                              <h3>Select the features which your vehicles have,</h3>
                              <?php if (!empty($features)) {?>                                     
                                     <?php foreach ($features as $key => $value) {?>
                                          <div class="field_features">                                               
                                               <input id="checkbox" type="checkbox" value="Phone" name="features[<?php echo $value['ftr_id'];?>]" value="1"><?php echo $value['ftr_feature'];?>
                                          </div>
                                     <?php }?>                                
                                <?php }?>                         
                         </div>
                         <div class="field-link">
                              <input type="checkbox" name="chkTerms"/> By submiting i agree to the <a href="<?php echo site_url('terms-of-use');?>">Terms and Conditions </a> and                               <a href="<?php echo site_url('privacy-policy');?>">Privacy Policy</a>                              
                              <p><span for="chkTerms" generated="true" class="error"></span></p>
                         </div>
                         <input type="submit" value="Submit" class="eng-btn btnSubmit" />                    
                    </form>
               </div>
               <!--refinesearchbg-->          
          </div>
          <!--matterbg-->          
          <div style="clear:both"></div>
     </div>
     <!--inner-inner-->
</div>
<!--inner-wrapper--><!-- -->
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/file-upload.css">
<link rel="stylesheet" href="styles/jquery.fileupload.css">

<script src="scripts/vendor/jquery.ui.widget.js"></script>
<script src="scripts/jquery.iframe-transport.js"></script>
<script src="scripts/jquery.fileupload.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/jquery.validate.min.js"></script>
<script>
     $(function () {
          'use strict';
          var url = "<?php echo site_url() . 'sell_your_vehicle/uploadFiles'?>";
          $('#fileupload').fileupload({
               url: url,
               dataType: 'json',
               success: function (data) {
                    $('.divImageCollection').append('<a href="javascript:void(0);" class="hproduct-bg hproduct-bg-sell-product secImg' + data.imgId + '">' +
                            '<div class="hproduct-imagebg">' +
                            '<img src="' + data.src + '"/>' +
                            '</div>' +
                            '<div class="hproduct-desbg-sell-product">' +
                            '<div img-id="' + data.imgId + '"><input id="' + data.imgId + '" class="radSetDefault" type="radio" name="setdefault"/>&nbsp;Set default</div>' +
                            '<div img-id="' + data.imgId + '" class="btnRemoveTempImage">Remove</div>' +
                            '</div></a>');
               },
               progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css('width', progress + '%');
               }
          }).prop('disabled', !$.support.fileInput)
                  .parent().addClass($.support.fileInput ? undefined : 'disabled');
     });
</script>

<script>
     $(function () {
          $("#frmPostYourCar").validate({
               rules: {
                    'basicinfo[prd_brand]': "required",
                    'basicinfo[prd_name]': "required",
                    'basicinfo[prd_price]': {
                         number: true,
                         required: true
                    },
                    'basicinfo[prd_engine_cc]': {
                         number: true
                                 //  required: true
                    },
                    'basicinfo[prd_mileage]': {
                         number: true
                                 // required: true
                    },
                    'basicinfo[prd_km_run]': {
                         number: true,
                         required: true
                    },
                    'basicinfo[prd_fual]': "required",
                    'basicinfo[prd_model]': "required",
                    /* 'basicinfo[prd_variant]' : "required",*/
                    chkTerms: "required"
               },
               // Specify the validation error messages
               messages: {
                    'basicinfo[prd_brand]': "Please select brand",
                    'basicinfo[prd_name]': "Please enter vehicle name",
                    'basicinfo[prd_price]': {
                         number: "Please enter number",
                         required: "Please enter price"
                    },
                    'basicinfo[prd_engine_cc]': {
                         number: "Please enter number",
                         required: "Please enter engine cc"
                    },
                    'basicinfo[prd_mileage]': {
                         number: "Please enter number",
                         required: "Please enter mileage"
                    },
                    'basicinfo[prd_km_run]': {
                         number: "Please enter number",
                         required: "Please enter kms run"
                    },
                    'basicinfo[prd_fual]': "Please select fule type",
                    'basicinfo[prd_model]': "Select model",
                    /* 'basicinfo[prd_variant]' : "Select variant",*/
                    chkTerms: "Please accept terms and Conditions"
               }
          });
     });
</script>
<style>
     span.error  {
          color: red;
     }
</style>
