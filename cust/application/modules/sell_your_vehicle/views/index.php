<section class="inner_pages">
     <div class="container">
          <div class="row">
               <div class="col-sm-12"> 
                    <h1>Post your car details</h1> 
               </div>
               <form class="refer_friend cell_car" id="frmPostYourCar" action="<?php echo site_url('sell_your_vehicle/postCarDetails');?>" enctype="multipart/form-data" method="post">  
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Your name</label>
                              <input required type="text" class="form-control" name="basicinfo[prd_usr_name]"/>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Phone number</label>
                              <input required type="number" class="form-control" name="basicinfo[prd_usr_ph_num]"/>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Email id</label>
                              <input required type="text" class="form-control" name="basicinfo[prd_email]"/>
                         </div>       
                    </div>
                    <div class="col-sm-12"><div class="block_devider"></div></div>

                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Brand</label>
                              <?php if (!empty($brands)) {?>                                          
                                     <select name="basicinfo[prd_brand]" class="cmbBindModel form-control"
                                             data-url="<?php echo site_url('sell-your-vehicle/bindModel');?>">
                                          <option value="">Select Brand</option>
                                          <?php foreach ($brands as $key => $value) {?>                                                    
                                               <option value="<?php echo $value['brd_id'];?>"><?php echo $value['brd_title'];?></option>
                                          <?php }?>                                          
                                     </select>
                                <?php }?>      
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Model</label>
                              <span class="field_label spanModel">
                                   <span class="css4-metro-dropdown">
                                        <select name="basicinfo[prd_model]" class="form-control">
                                             <option value="">Select Brand First</option>
                                        </select>
                                   </span>
                              </span>
                         </div>
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Variant</label>
                              <span class="field_label spanVarient">
                                   <span class="css4-metro-dropdown">
                                        <select name="basicinfo[prd_variant]" class="form-control">
                                             <option value="">Select Model First</option>
                                        </select>
                                   </span>
                              </span>
                         </div>
                    </div>
                    <div class="col-sm-12">
                         <div class="block_devider"></div>
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Price</label>
                              <input type="number" class="form-control" name="basicinfo[prd_price]"/>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Kms driven</label>
                              <input type="number" class="form-control" name="basicinfo[prd_km_run]"/>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Fuel type</label>
                              <select name="basicinfo[prd_fual]" class="form-control">
                                   <option value="">Select Fuel Type</option>
                                   <option value="diesel">Diesel</option>
                                   <option value="petrol">Petrol</option>
                                   <option value="gas">Gas</option>
                                   <option value="Hybrid">Hybrid</option>
                                   <option value="Electric">Electric</option>
                                   <option value="CNG">CNG</option>
                              </select>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Color</label>
                              <select name="basicinfo[prd_color]" class="form-control" placeholder="Color" >
                                   <option value="">Select color</option>
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
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Milage</label>
                              <input type="number" name="basicinfo[prd_mileage]" class="form-control" placeholder="Mileage"/>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Owner type</label>
                              <input type="text" name="basicinfo[prd_owner]" class="form-control" placeholder="Owner Type"/>
                         </div>       
                    </div>
                    <div class="col-sm-12">
                         <div class="block_devider"></div>
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Engine in CC</label>
                              <input type="text" name="basicinfo[prd_engine_cc]" class="form-control" placeholder="Engine in cc" />
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Insurance validity</label>
                              <div class="datepicker" >
                                   <input type="text" name="basicinfo[prd_insurance_validity]" class="form-control datepicker" placeholder="DD/MM/YY" />
                              </div>
                         </div>       
                    </div>
                    <div class="col-sm-4">      
                         <div class="form-group">
                              <label class="control-label" for="inputDefault">Year of registration</label>
                              <select name="basicinfo[prd_year]" class="form-control css4-metro-dropdown" placeholder="Year of registered" >
                                   <option value="none">Select year</option>
                                   <?php for ($i = date('Y') - 30; $i <= date('Y'); $i++) {?>
                                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                     <?php }?>
                              </select>
                         </div>       
                    </div>
                    <div class="col-sm-12">
                         <div class="block_devider"></div>
                    </div>
                    <div class="col-sm-12"> 
                         <div class="col-sm-8 padding_0">
                              <div class="form-group">
                                   <label class="control-label" for="inputDefault">Additional details</label>
                                   <input name="basicinfo[prd_desc]" type="text" class="form-control" placeholder="write here" />
                              </div>
                         </div>       
                    </div>
                    <div class="upload_section" id="upload_section">
                         <div class="col-sm-4"> 
                              <div class="uploadOuter form-group">
                                   <span class="dragBox" ><br><span class="loading">+</span><br>Upload or drag photos here <br>
                                        <small style="font-size: 12px;">(Size should be less than 760X476)</small>
                                        <input type="file" class="fleVehicles" id="uploadFile"/>
                                   </span>
                              </div>
                         </div>
                         <div class="divPreview"></div>
                    </div>
                    <div class="col-sm-12">
                         <div class="block_devider"></div>
                    </div>
                    <div class="check_section">
                         <div class="col-sm-12">
                              <h2>Select the features which your vehicle have,</h2>
                         </div>
                         <?php if (!empty($features)) {?>                                     
                                <?php
                                foreach ($features as $key => $value) {
                                     echo ($key != 0 && $key % 4 == 0) ? '</div>' : '';
                                     echo ($key == 0 || $key % 4 == 0) ? '<div class="col-sm-3">' : '';
                                     ?>
                                     <label class="check_box">
                                          <input type='checkbox' name="features[<?php echo $value['ftr_id'];?>]" value="1">
                                          <span></span>
                                          <div class="features"><?php echo $value['ftr_feature'];?></div>
                                     </label>
                                     <?php
                                     echo ($key == (count($features) - 1)) ? '</div>' : '';
                                }
                           }
                         ?>
                    </div>
                    <div class="col-sm-12">
                         <div class="block_devider" style="margin-top:5px;"></div>
                    </div>
                    <div class="check_section terms_condtn">
                         <div class="col-sm-12">
                              <label class="check_box">
                                   <input type="checkbox" name="chkTerms" class="chkTerms" id="chkTerms"/>
                                   <span></span>
                                   <span for="chkTerms" generated="true" class="error"></span>
                                   <div class="features">By submitting i agree to the 
                                        <a target="blank" href="<?php echo site_url('app-privacy-policy');?>">Terms, conditions and privacy policy</a>
                                   </div>
                              </label>
                         </div>
                    </div>
                    <div class="col-sm-12">
                         <div class="form-group">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-link">Clear</button>                  
                         </div>
                    </div>
               </form>
          </div>
     </div>
</section>

<script>
     $(document).ready(function () {
          $(".fleVehicles").change(function (e) {
               var form = $('#frmPostYourCar')[0];
               var formData = new FormData(form);

               file = this.files[0];
               if (window.FileReader) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {};
                    reader.readAsDataURL(file);
               }
               if (formData) {
                    formData.append("files", file);
               }

               $.ajax({
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    url: '<?php echo site_url('sell_your_vehicle/uploadFiles');?>',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    dataType: 'json',
                    beforeSend: function () {
                         //$('.loading').html('<img src="images/loadning.gif"/>');
                    },
                    success: function (data) {
                         var thumb = '<div class="divSectionVehicle col-sm-2 secImg' + data.imgId + '">' +
                                 '<div class="uploadOuter"><img width="476" src="' + data.src + '"></div>' +
                                 '<div img-id="' + data.imgId + '"><input id="' + data.imgId + '" class="radSetDefault" type="radio" name="setdefault"/>&nbsp;Set default</div>' +
                                 '<i img-id="' + data.imgId + '" class="fa fa-times-circle trash-sell-vehicle btnRemoveTempImage" aria-hidden="true"></i>\n\
                                 <input type="hidden" name="imgs[]" value="' + data.imgId + '"/> </div>';
                         $('.divPreview').append(thumb);
                    },
                    complete: function () {
                         //$('.loading').html('+');
                    }
               });
          });
     });
</script>
<style>
     span.error  {
          color: red;
     }
     select.error {
          border: 1px solid red;
     }
</style>
