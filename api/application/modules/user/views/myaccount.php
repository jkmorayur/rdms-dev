<link type="text/css" rel="stylesheet" href="styles/myaccount.css" />
<link rel="stylesheet" type="text/css" href="styles/metro2.css" >
<script type="text/javascript">
     $(function() {

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
                              url: site_url + 'user/checkValidPassword',
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
               submitHandler: function(form) {
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/updateAccountInfo'); ?>",
                         data: $(form).serialize(),
                         dataType: "json",
                         success: function(res) {
                              messageBox(res);
                         }
                    });
               }
          });
          $('.add_new_address').click(function() {
               $('.address_book_title').html('Add New Address');
               $('#divAddressBook').hide();
               $('#frmAddressBook').show();
          });
          $('.back_to_add_book').click(function() {
               $('.address_book_title').html('Address Book');
               $('#divAddressBook').show();
               $('#frmAddressBook').hide();
          });
          $('.deleteAddress').click(function() {
               var id = $(this).attr('id');
               if (confirm("Are you sure want to delete this address?")) {
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/deleteAddress'); ?>",
                         data: {id: id},
                         dataType: "json",
                         success: function(res) {
                              messageBox(res);
                              $('#divAddressRows' + id).hide();
                         }
                    });
               }
          });
     });
</script>
<style>
     span.error {
          color: red;
          font-size: 13px;
          float: right;
     }
</style>

<div id="inner-wrapper">
     <div id="inner-inner">
          <div class="contenttabbg">
               <div id="myaccount" class="MTime">
                    <ul class="resp-tabs-list">
                         <h1>MY ACCOUNT</h1>
                         <li id="tab2" class="tablist">Account Information</li> <!-- 2 -->
                         <li id="my-vehicle" class="tablist">My Vehicle</li> <!-- 4 -->
                    </ul>

                    <div class="resp-tabs-container">
                         <div>
                              <div class="myaccound_title"> Edit Account Information </div>
                              <form method="post" name="frmAccountInfo" id="frmAccountInfo"  action="">
                                   <div class="acc_informationbg">
                                        <div class="accinfo_informationbg">
                                             <div class="myaccound_caption">Account Information</div>
                                             <div class="loginfield accinfomar">
                                                  <label>First Name</label><span class="error" generated="true" for="first_name"></span>
                                                  <input name="first_name" type="text"  id="first_name" value="<?php echo $logedUser['first_name']; ?>"  class="acc-input"  placeholder="First Name" />
                                             </div>
                                             <div class="loginfield accinfomar">
                                                  <label>Last Name</label><span class="error" generated="true" for="last_name"></span>
                                                  <input name="last_name" type="text"  id="last_name" value="<?php echo $logedUser['last_name']; ?>"  class="acc-input"  placeholder="Last Name" />
                                             </div>
                                             <div class="loginfield accinfomar">
                                                  <label>Email Address</label><span class="error" generated="true" for="email"></span>
                                                  <input name="email" type="text"  id="email" value="<?php echo $logedUser['email']; ?>"  class="acc-input" placeholder="Email Address" /> 
                                             </div>
                                        </div>
                                        <div class="accinfo_informationbg" style="float:right;">
                                             <div class="myaccound_caption">Account Information</div>
                                             <div class="loginfield accinfomar">
                                                  <label>Current Password</label><span class="error" generated="true" for="old_password"></span>
                                                  <input name="old_password" type="password"  id="old_password" value=""  class="acc-input"  placeholder="********"/>
                                             </div>
                                             <div class="loginfield accinfomar">
                                                  <label>New Password</label><span class="error" generated="true" for="password"></span>
                                                  <input name="password" type="password"  id="password" value="" class="acc-input"/>
                                             </div>
                                             <div class="loginfield accinfomar">
                                                  <label>Confirm New Password</label><span class="error" generated="true" for="password_confirmation"></span>
                                                  <input name="password_confirmation" type="password" id="password_confirmation" value="" class="acc-input" />
                                                  <input type="submit"  id="submit_form"   value="SAVE" name="" class="createacc"  style="margin-top:20px; margin-right:1%;"  /> 
                                             </div>
                                        </div>
                                   </div>
                              </form>
                              <div style="clear:both;"></div>
                         </div>
                         <!-- 5 -->
                         <div>
                              <div class="myaccound_title"> My VEHICLE </div>

                              <div class="innerordertittlebg">
                                   <div class="order_date">DATE</div>
                                   <div class="order_1d">VEHICLE</div>
                                   <div class="order_details">IMAGE</div>
                                   <div class="order_total">GRAND TOTAL </div>    
                              </div>

                              <div class="innercarwhitebg ">
                                   <?php if (!empty($myUploads)) { ?>
                                          <?php foreach ($myUploads as $key => $value) { ?>
                                               <div class="innercarwhitborder orderpadding" id="div<?php echo $value['prd_id']; ?>">
                                                    <summary>DATE</summary>
                                                    <div class="orderitem_date">
                                                         <?php echo date('M d, Y', strtotime($value['prd_date'])); ?>
                                                    </div>

                                                    <summary>VEHICLE</summary>
                                                    <div class="orderitem_1d"> 
                                                         <?php echo $value['brd_title'] . ' ' . $value['mod_title'] . ' ' . $value['var_variant_name']; ?>
                                                    </div>    
                                                    <div class="orderitem_details">
                                                         <a  href="<?php echo site_url('user/update_my_vehicle') . '/' . $value['prd_id']; ?>">
                                                              <?php $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : ''; ?>
                                                              <?php echo img(array('src' => './assets/uploads/product/thumb_' . $img, 'alt' => $value['prd_name'], 'style' => 'margin-right:5px;width: 20%;')); ?>
                                                         </a>
                                                    </div> 
                                                    <div class="orderitem_total">
                                                         <a href="javascript:void(0);" class="btnDrop" vehicle-id="<?php echo $value['prd_id']; ?>">DROP</a>
                                                    </div>  
                                               </div>
                                          <?php } ?>
                                     <?php } ?>
                              </div>
                              <div style="clear:both;"></div> 
                         </div>
                    </div>
               </div>
          </div>
          <div class="clear"></div>
     </div>
</div>
<script src="scripts/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
     $(document).ready(function () {
		
          $('#myaccount').easyResponsiveTabs({
               type: 'vertical',
               width: 'auto',
               fit: true
          });
          var tab = "<?php echo $section; ?>";
          if (tab) {
               $('#' + tab).trigger('click');
          }
     });
</script>