<script type="text/javascript">
     $(document).ready(function () {
          setTimeout(function () {
               $('.loading').hide();
               $('.contenttabbg').fadeIn();
          }
          , 2000);
     });
     $(function () {
          $("#frmAddressBook").validate({
               // Specify the validation rules
               rules: {
                    first_name: "required",
                    last_name: "required",
                    phone: {
                         number: true
                    },
                    city: "required",
                    address: "required",
                    postcode: "required",
                    country: "required",
                    state: "required"
               },
               // Specify the validation error messages
               messages: {
                    first_name: "Please enter your first name",
                    last_name: "Please enter your last name",
                    phone: "Please enter phone number",
                    city: "Please enter city",
                    address: "Please enter address",
                    postcode: "Please enter postcode",
                    country: "Please select country",
                    state: "Please select country"
               }
          });

          $("#frmAccountInfo").validate({
               // Specify the validation rules
               rules: {
                    first_name: "required",
                    email: {
                         email: true,
                         required: true
                    },
                    password: {
                         minlength: 8
                    },
                    password_confirmation: {
                         equalTo: "#password"
                    },
                    old_password: {
                         remote: {
                              url: base_url + '/user/checkValidPassword',
                              type: "post"
                         }
                    }
               },
               messages: {
                    first_name: "Please enter your first name",
                    email: {
                         email: "Please enter valid email",
                         required: "Please enter email"
                    },
                    old_password: {
                         remote: "Incorrect old password"
                    }
               },
               submitHandler: function (form) {
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/updateAccountInfo'); ?>",
                         data: $(form).serialize(),
                         dataType: "json",
                         success: function (res) {
                              messageBox(res);
                         }
                    });
               }
          });
          $('.add_new_address').click(function () {
               $('.address_book_title').html('Add New Address');
               $('#divAddressBook').hide();
               $('#frmAddressBook').show();
          });
          $('.back_to_add_book').click(function () {
               $('.address_book_title').html('Address Book');
               $('#divAddressBook').show();
               $('#frmAddressBook').hide();
          });
          $('.deleteAddress').click(function () {
               var id = $(this).attr('id');
               if (confirm("Are you sure want to delete this address?")) {
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/deleteAddress'); ?>",
                         data: {id: id},
                         dataType: "json",
                         success: function (res) {
                              messageBox(res);
                              $('#divAddressRows' + id).hide();
                         }
                    });
               }
          });
     });
</script>
<style type="text/css">
     .logininput {
          float:left; height:46px;
     }
     :root .css4-metro-dropdown select,
     :root .css4-metro-dropdown:after,
     :root .css4-metro-dropdown::after
     {
          margin-top:1px;
     }
     span.error {
          font-size: 13px;
          color: red;
          float: right;
     }
     .logininput {
          height:40px;
     }
</style>
<!--CONTACT-->
<div id="sectionb_wrapper">
     <div id="sectionb_inner">
          <div id="inner_breadcombmenu">
               <ul>
                    <li><a href="<?php echo site_url(); ?>"> Home &raquo; </a></li>
                    <li><a href="javascript:void(0);" style="color:#d92523;">My Account </a></li>
               </ul>
          </div><!--inner_breadcombmenu-->
          <h1>My Account </h1>
          <div style="clear:both"></div>
     </div><!--sectionb_inner-->
</div><!--sectionb_wrapper-->
<!--INNER-->
<div id="contentmatter_wrapper" >
     <div id="contentcart_inner">
          <div class="contenttabbg">
               <!--vertical Tabs-->
               <div class="loading" style="text-align: center;padding: 200px 0px;width: 100%;">
                    <img src="images/loading_spinner.gif"/>
               </div>
               <div class="contenttabbg" style="display: none;">
                    <div id="myaccount" class="MTime">
                         <ul class="resp-tabs-list">
                              <h1>MY ACCOUNT</h1>
                              <li id="tab1" class="tablist">Account Dashboard</li> <!-- 1 -->
                              <li id="tab2" class="tablist">Account Information</li> <!-- 2 -->
                              <li id="tab3" class="tablist">Address Book</li> <!-- 3 -->
                              <li id="tab4" class="tablist">My Orders</li> <!-- 4 -->
                         </ul>
                         <div class="resp-tabs-container">
                              <!-- 1 -->
                              <div>
                                   <div class="myaccound_title"> MY Dashboard </div>
                                   <strong>Hello, <?php echo $logedUser['first_name'] . ' ' . $logedUser['last_name']; ?> ....</strong>
                                   <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                                   <div class="acc_informationbg">
                                        <div class="myaccound_caption">Account Information</div>
                                        <div class="dashboardgray">
                                             Account holder name : <?php echo $logedUser['first_name'] . ' ' . $logedUser['last_name']; ?><br>
                                             Account Email ID : <?php echo $logedUser['email']; ?>
                                             <a href="javascript:void(0);" onclick="$('#tab2').trigger('click');"><img src="images/edit.jpg" alt="" style="float:right; margin-top:-10px;" class="editico"></a>
                                        </div>
                                        <div class="myaccound_caption">Address Book</div>
                                        <div class="dashboardgray">
                                             <strong>Default Billing Address</strong><br>
                                             You have not set a default billing address.
                                             <a href="javascript:void(0);" onclick="$('#tab3').trigger('click');"><img src="images/edit.jpg" alt="" style="float:right; margin-top:-10px;" class="editico"></a>
                                        </div>
                                   </div>
                                   <div style="clear:both;"></div> 
                              </div>
                              <!-- 2 -->
                              <div>
                                   <div class="myaccound_title"> Edit Account Information </div>
                                   <form method="post" name="frmAccountInfo" id="frmAccountInfo"  action="">
                                        <div class="acc_informationbg">
                                             <div class="accinfo_informationbg">
                                                  <div class="myaccound_caption">Account Information</div>
                                                  <div class="loginfield accinfomar">
                                                       <label>First Name</label>
                                                       <input name="first_name" type="text"  id="first_name" value="<?php echo $logedUser['first_name']; ?>"  class="logininput"   style="width:98%;"  placeholder="First Name" />
                                                       <dialog><span for="first_name" generated="true" class="error"></span></dialog>
                                                  </div>
                                                  <div class="loginfield accinfomar">
                                                       <label>Last Name</label>
                                                       <input name="last_name" type="text"  id="last_name" value="<?php echo $logedUser['last_name']; ?>"  class="logininput"    style="width:98%;"  placeholder="Last Name" />
                                                  </div>
                                                  <div class="loginfield accinfomar">
                                                       <label>Email Address</label>
                                                       <input name="email" type="text"  id="email" value="<?php echo $logedUser['email']; ?>"  class="logininput"    style="width:98%;"  placeholder="Email Address" /> 
                                                       <dialog><span for="email" generated="true" class="error"></span></dialog>
                                                  </div>
                                             </div>
                                             <div class="accinfo_informationbg" style="float:right;">
                                                  <div class="myaccound_caption">Account Information</div>
                                                  <div class="loginfield accinfomar">
                                                       <label>Current Password</label>
                                                       <input name="old_password" type="password"  id="old_password" value=""  class="logininput"   style="width:98%;"  placeholder="********"/>
                                                       <dialog><span for="old_password" generated="true" class="error"></span></dialog>
                                                  </div>
                                                  <div class="loginfield accinfomar">
                                                       <label>New Password</label>
                                                       <input name="password" type="password"  id="password" value="" class="logininput"  style="width:98%;"/>
                                                       <dialog><span for="password" generated="true" class="error"></span></dialog>
                                                  </div>
                                                  <div class="loginfield accinfomar">
                                                       <label>Confirm New Password</label>
                                                       <input name="password_confirmation" type="password" id="password_confirmation" value="" class="logininput"  style="width:98%;"/>
                                                       <dialog><span for="password_confirmation" generated="true" class="error"></span></dialog>
                                                       <input type="submit"  id="submit_form"   value="SAVE" name="" class="createacc"  style="margin-top:20px; margin-right:1%;"  /> 
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
                                   <div style="clear:both;"></div>
                              </div>
                              <!-- 3 -->
                              <div>                        
                                   <div class="myaccound_title address_book_title"> Address Book </div>
                                   <?php
                                     //debug($addToEdit); 
                                     if (!empty($addToEdit)) {
                                          ?>
                                          <form method="post" name="frmAddressBook" id="frmAddressBook"  action="<?php echo site_url('user/updateAddress'); ?>">
                                               <input type="hidden" name="id" value="<?php echo $addid; ?>" />
                                               <div class="acc_informationbg">
                                                    <div class="myaccound_caption">Account Information</div>

                                                    <div class="add_bookfield">
                                                         <div class="loginfield ">
                                                              <label>First Name</label>
                                                              <input name="first_name" type="text"  id="first_name" value="<?php echo $addToEdit['first_name'] ?>"  class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div>  

                                                    <div class="add_bookfield" style="float:right;">
                                                         <div class="loginfield ">
                                                              <label>Last Name</label>
                                                              <input name="last_name" type="text"  id="last_name" value="<?php echo $addToEdit['last_name'] ?>" class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div> 

                                                    <div class="add_bookfield">
                                                         <div class="loginfield ">
                                                              <label>Company</label>
                                                              <input name="company" type="text"  id="company" value="<?php echo $addToEdit['company'] ?>"  class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div>  

                                                    <div class="add_bookfield" style="float:right;">
                                                         <div class="loginfield ">
                                                              <label>Telephone</label>
                                                              <input name="phone" type="text"  id="phone" value="<?php echo $addToEdit['phone'] ?>" class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div>  

                                                    <div class="myaccound_caption" style="margin-top:30px;">Address</div>  

                                                    <div class="add_bookfield" style="width:100%;">
                                                         <label>Street Address</label>
                                                         <textarea name="address" id="address" rows="" cols=""  class="inputtextarea" style="width:99%; margin-top:2px; margin-bottom:20px;" ><?php echo $addToEdit['address'] ?></textarea>
                                                    </div>


                                                    <div class="add_bookfield">
                                                         <div class="loginfield ">
                                                              <label>City</label>
                                                              <input name="city" type="text"  id="city" value="<?php echo $addToEdit['city'] ?>"  class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div>  

                                                    <div class="add_bookfield" style="float:right;">
                                                         <div class="loginfield ">
                                                              <label>State/Province</label>
                                                              <span class="css4-metro-dropdown" style="width:100%;">
                                                                   <select name="state" id="state">
                                                                        <option value="">Please select region, state or province</option>
                                                                        <?php foreach (get_state_province() as $key => $value) { ?>
                                                                             <option <?php echo ($addToEdit['state'] == $value['id']) ? "selected='selected'" : ''; ?> value="<?php echo $value['id'] ?>"><?php echo $value['stat_long_name'] ?></option>
                                                                        <?php } ?>
                                                                   </select>
                                                              </span>
                                                         </div>
                                                    </div>

                                                    <div class="add_bookfield">
                                                         <div class="loginfield ">
                                                              <label>Zip/Postal Code</label>
                                                              <input name="postcode" type="text"  id="postcode" value="<?php echo $addToEdit['postcode'] ?>"  class="logininput"   style="width:98%;"  />
                                                         </div>
                                                    </div>  
                                                    <div class="add_bookfield" style="float:right;">
                                                         <div class="loginfield ">
                                                              <label>Country</label>
                                                              <span class="css4-metro-dropdown" style="width:100%;">
                                                                   <select name="country">
                                                                        <option class="" value="">Please Select Country</option>
                                                                        <?php foreach (get_country_list() as $key => $value) { ?>
                                                                             <option <?php echo ($addToEdit['country'] == $value['ctr_id']) ? "selected='selected'" : ''; ?> value="<?php echo $value['ctr_id'] ?>"><?php echo $value['ctr_country'] ?></option>
                                                                        <?php } ?>
                                                                   </select>
                                                              </span>
                                                         </div>
                                                    </div>
                                                    <input type="submit"  id="submit_form"   value="SAVE" name="" class="createacc"  style="margin-top:10px; margin-right:1%;"  />
                                                    <a href="javascript:void(0);" class="createacc back_to_add_book" style="margin-top:10px; float:left;">BACK </a>
                                               </div>
                                          </form>
                                     <?php } else { ?>
                                          <div id="divAddressBook">
                                               <a href="javascript:void(0);" class="createacc add_new_address" style="margin-top:0px;"> ADD NEW ADDRESS </a>
                                               <div class="acc_informationbg">
                                                    <div class="myaccound_caption">Default Addresses</div>
                                                    <div class="dashboardgray">
                                                         <strong>Default Billing Address</strong><br>
                                                         <?php echo isset($addressBook['default']['first_name']) ? $addressBook['default']['first_name'] : ''; ?>
                                                         <?php echo isset($addressBook['default']['last_name']) ? $addressBook['default']['last_name'] . '<br>' : ''; ?>
                                                         <?php echo isset($addressBook['default']['address']) ? $addressBook['default']['address'] . '<br>' : ''; ?>
                                                         <?php echo isset($addressBook['default']['city']) ? $addressBook['default']['city'] . '<br>' : ''; ?>
                                                         <?php echo isset($addressBook['default']['stat_short_name']) ? $addressBook['default']['stat_short_name'] . '<br>' : ''; ?>
                                                         <?php echo isset($addressBook['default']['ctr_country']) ? $addressBook['default']['ctr_country'] . '<br>' : ''; ?>
                                                         <?php echo isset($addressBook['default']['phone']) ? 'T: ' . $addressBook['default']['phone'] . '<br>' : ''; ?>
                                                         <a href="<?php echo site_url('user/myaccount/3/' . $addressBook['default']['add_id']); ?>" title="edit"><img src="images/edit.jpg" alt="" style="float:right; margin-top:-10px;" class="editico"></a>
                                                    </div>
                                                    <div class="myaccound_caption">Additional Address Entries</div>
                                                    <div id="nonDefaultAddress">
                                                         <?php if (!empty($addressBook['nonDefault'])) { ?>
                                                              <?php foreach ($addressBook['nonDefault'] as $key => $value) { ?>
                                                                   <div class="dashboardgray" id="divAddressRows<?php echo $value['add_id']; ?>">
                                                                        <?php echo isset($value['first_name']) ? $value['first_name'] : ''; ?>
                                                                        <?php echo isset($value['last_name']) ? $value['last_name'] . '<br>' : ''; ?>
                                                                        <?php echo isset($value['address']) ? $value['address'] . '<br>' : ''; ?>
                                                                        <?php echo isset($value['city']) ? $value['city'] . '<br>' : ''; ?>
                                                                        <?php echo isset($value['stat_short_name']) ? $value['stat_short_name'] . '<br>' : ''; ?>
                                                                        <?php echo isset($value['ctr_country']) ? $value['ctr_country'] . '<br>' : ''; ?>
                                                                        <?php echo isset($value['phone']) ? 'T: ' . $value['phone'] . '<br>' : ''; ?>
                                                                        <a href="<?php echo site_url('user/myaccount/3/' . $value['add_id']); ?>" title="edit">
                                                                             <img src="images/edit.jpg" alt="" style="float:right; margin-top:-10px;" class="editico"></a>

                                                                        <a class="deleteAddress" id="<?php echo $value['add_id']; ?>" href="javascript:void(0);" title="delete">
                                                                             <img src="images/delete.png" alt="" style="float:right; margin-top:-10px; margin-right:10px;" class="editico"></a>
                                                                   </div>
                                                              <?php } ?>
                                                         <?php } ?>
                                                    </div>
                                               </div>
                                          </div>
                                     <?php } ?>
                                   <form method="post" name="frmAddressBook" id="frmAddressBook"  action="<?php echo site_url('user/newAddress'); ?>" style="display: none;">
                                        <div class="acc_informationbg">
                                             <div class="myaccound_caption">Account Information</div>

                                             <div class="add_bookfield">
                                                  <div class="loginfield ">
                                                       <label>First Name</label>
                                                       <input name="first_name" type="text"  id="first_name" value=""  class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div>  

                                             <div class="add_bookfield" style="float:right;">
                                                  <div class="loginfield ">
                                                       <label>Last Name</label>
                                                       <input name="last_name" type="text"  id="last_name" value="" class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div> 

                                             <div class="add_bookfield">
                                                  <div class="loginfield ">
                                                       <label>Company</label>
                                                       <input name="company" type="text"  id="company" value=""  class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div>  

                                             <div class="add_bookfield" style="float:right;">
                                                  <div class="loginfield ">
                                                       <label>Telephone</label>
                                                       <input name="phone" type="text"  id="phone" value="" class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div>  

                                             <div class="myaccound_caption" style="margin-top:30px;">Address</div>  

                                             <div class="add_bookfield" style="width:100%;">
                                                  <label>Street Address</label>
                                                  <textarea name="address" id="address" rows="" cols=""  class="inputtextarea" style="width:99%; margin-top:2px; margin-bottom:20px;" ></textarea>
                                             </div>


                                             <div class="add_bookfield">
                                                  <div class="loginfield ">
                                                       <label>City</label>
                                                       <input name="city" type="text"  id="city" value=""  class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div>  

                                             <div class="add_bookfield" style="float:right;">
                                                  <div class="loginfield ">
                                                       <label>State/Province</label>
                                                       <span class="css4-metro-dropdown" style="width:100%;">
                                                            <select name="state" id="state">
                                                                 <option value="">Please select region, state or province</option>
                                                                 <?php foreach (get_state_province() as $key => $value) { ?>
                                                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['stat_long_name'] ?></option>
                                                                   <?php } ?>
                                                            </select>
                                                       </span>
                                                  </div>
                                             </div> 

                                             <div class="add_bookfield">
                                                  <div class="loginfield ">
                                                       <label>Zip/Postal Code</label>
                                                       <input name="postcode" type="text"  id="postcode" value=""  class="logininput"   style="width:98%;"  />
                                                  </div>
                                             </div>  

                                             <div class="add_bookfield" style="float:right;">
                                                  <div class="loginfield ">
                                                       <label>Country</label>
                                                       <span class="css4-metro-dropdown" style="width:100%;">
                                                            <select name="country">
                                                                 <option class="" value="">Please Select Country</option>
                                                                 <?php foreach (get_country_list() as $key => $value) { ?>
                                                                        <option value="<?php echo $value['ctr_id'] ?>"><?php echo $value['ctr_country'] ?></option>
                                                                   <?php } ?>
                                                            </select>
                                                       </span>
                                                  </div>
                                             </div>
                                             <input type="submit"  id="submit_form"   value="SAVE" name="" class="createacc"  style="margin-top:10px; margin-right:1%;"  />
                                             <a href="javascript:void(0);" class="createacc back_to_add_book" style="margin-top:10px; float:left;">BACK </a>
                                        </div>
                                   </form>
                                   <div style="clear:both;"></div>
                              </div>
                              <!-- 4 -->
                              <div>
                                   <div class="myaccound_title"> My ORDERS </div>

                                   <div class="innerordertittlebg">
                                        <div class="order_date">DATE </div>    
                                        <div class="order_1d"> ORDER ID</div>
                                        <div class="order_total">GRAND TOTAL </div>    
                                        <div class="order_details"> DETAIlS</div>                                                                              
                                   </div><!--innerordertittlebg-->
                                   <div class="innercarwhitebg ">
                                        <?php if (!empty($myorder)) { ?>
                                               <?php foreach ($myorder as $key => $value) { ?>
                                                    <div class="innercarwhitborder orderpadding">
                                                         <summary>DATE</summary>
                                                         <div class="orderitem_date">
                                                              <!--Feb 20, 2015-->
                                                              <?php echo date('M d, Y', strtotime($value['ord_date'])) ?>
                                                         </div> <!--cartitem_name-->
                                                         <summary>ORDER ID</summary>
                                                         <div class="orderitem_1d"> 
                                                              <?php echo $value['ord_id']; ?>
                                                         </div>    
                                                         <summary>GRAND TOTAL </summary>
                                                         <div class="orderitem_total">
                                                              <!--$25--> 
                                                         </div>  
                                                         <div class="orderitem_details">
                                                              <a  href="<?php echo site_url('user/order_details/' . $value['odr_serial']); ?>">
                                                                   <img src="images/detail.jpg" alt="delete" style="margin-right:5px;">Details
                                                              </a>
                                                         </div> 
                                                    </div>
                                               <?php } ?>
                                          <?php } ?>
                                   </div><!--innercarwhitebg-->
                                   <div style="clear:both;"></div>
                              </div>
                         </div><!--resp-tabs-container-->
                    </div><!--vertical Tabs-->
               </div>
          </div><!--contenttabbg-->
          <div style="clear:both"></div>
     </div><!--contentcart_inner-->
</div><!--contentmatter_wrapper-->

<script type="text/javascript">
     $(document).ready(function () {
          $('#myaccount').easyResponsiveTabs({
               type: 'vertical',
               width: 'auto',
               fit: true
          });
          var tab = "<?php echo $section; ?>";
          if (tab) {
               $('#tab' + tab).trigger('click');
          }
     });
</script>