<link href="style/css.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery.validate.min.js"></script>
<style>
     span.error  {
          color: red;
          display: none !important;
     }
     input.error {
          border-bottom: 1px solid red;
     }

</style>
<script>
     $(function () {
          $("#frmContactus").validate({
               rules: {
                    name: "required",
                    email: {
                         required: true,
                         email: true
                    },
                    mobile: {
                         number: true
                    },
                    captcha: "required"
               },
               // Specify the validation error messages
               messages: {
                    name: "Please enter name",
                    email: {
                         required: "Please enter username",
                         email: "Please enter valid email"
                    },
                    mobile: {
                         number: "Please enter valid mobile"
                    },
                    captcha: "Please enter captcha"
               },
               submitHandler: function (form) {
                    $('.btnSubmit').val('PLEASE WAIT...');
                    $.ajax({
                         type: "POST",
                         url: site_url + "contactus/sendContact",
                         data: $(form).serialize(),
                         dataType: "json",
                         success: function (res) {
                              //messageBox(res);
                              $('.msgContactus').html(res.msg);
                              if (res.status == 'success') {
                                   $(form)[0].reset();
                                   $('.btnSubmit').val('SEND MESSAGE');
                              }
                         }
                    });
               }
          });
     });
</script>

<div class="inner-banner contact-banner">
     <div id="banner_inner">
          <div class="heading-wrp">
               <div class="heading"></div>
          </div>
     </div>
</div><!--banner_wrapper-->

<!-- Content -->
<div class="cnt-wrapper contact-page">
     <div class="cnt-inner">
          <div class="cnt-h">send us mail</div>
          <div class="h-line"></div>
          <div class="address-form-container">
               <!-- Right -->
               <div class="form-container">
                    <div class="form">
                         <form action="#" id="frmContactus" method="post" enctype="multipart/form-data">
                              <div class="form-row">
                                   <div class="image"><img src="images/f-name-icon.png" alt="Queen Filters" /></div>
                                   <input type="text" name="name" class="field" placeholder="YOUR NAME *" />
                              </div>
                              <div class="form-row">
                                   <div class="image"><img src="images/f-mail-icon.png" alt="Queen Filters" /></div>
                                   <input type="text" name="email" class="field" placeholder="YOUR E-MAIL *" />
                              </div>
                              <div class="form-row">
                                   <div class="image"><img src="images/f-phone-icon.png" alt="Queen Filters" /></div>
                                   <input name="mobile" type="text" class="field" placeholder="YOUR NUMBER" />
                              </div>
                              <div class="form-row">
                                   <div class="image"><img src="images/f-message-icon.png" alt="Queen Filters" /></div>
                                   <textarea name="message" class="area" placeholder="MESSAGE"></textarea>
                              </div>
                              <div class="form-row">
                                   <div class="image"><img src="images/f-sec-icon.png" alt="Queen Filters" /></div>
                                   <input name="captcha" type="text" class="field sec-field" placeholder="SECURITY CODE *" />
                                   <div class="captcha-wrp">
                                        <img style="height: 43px;width: 155px;" src="<?php echo site_url('contactus/captcha'); ?>" alt="Queen Filters" />
                                   </div>
                                   <div style="clear:both"></div>
                              </div>
                              <div class="form-row">
                                   <input type="submit" class="btn-sub btnSubmit" value="SEND MESSAGE" />
                                   <div class="msgContactus"></div>
                              </div>
                         </form>
                    </div>
               </div>
               <!-- End Right -->

               <!-- Left -->
               <div class="address-container">
                    <!-- Address -->
                    <div class="address">
                         <div class="image">
                              <img src="images/loc-icon.png" alt="Queen Filters" />
                         </div>
                         <div class="text">
                              <h6>Malappuram</h6>
                              <span>Royal Drive<br />
                                   Pre Owned Cars LLP <br />Calicut Rd -  Machingal<br />
                                   Melmuri PO<br />
                                   Malappuram - 676517 <br /></span>
                              <div style="clear:both"></div>
                         </div>
                        </div> 
<!--                    <div class="address">
                          <div class="image">
                              <img src="images/loc-icon.png" alt="Queen Filters" />
                         </div>
                         <div class="text">
                              <h6>Calicut</h6>
                              <span>Royal Drive<br />
                                   Pre Owned Cars LLP <br />Ramanatukara-Calicut By-pass <br />
                                   Koodathumpara, Palazhi, Opp:Landmark Builders<br />
                                   Kozhikode - 673008 <br /></span>
                              <div style="clear:both"></div>
                         </div>
                    </div>-->
                    <!-- Phone -->
                    <div class="address">
                         <div class="image">
                              <img src="images/phone-icon.png" alt="Queen Filters" />
                         </div>
                         <div class="text">
                              <h6>Telephone</h6>
                              <!--<span>9745-059-090</span>-->
                              <br />
                              <span>9539-069-090</span>
                              <div style="clear:both"></div>
                         </div>
                    </div>
                    <!-- Email -->
                    <div class="address">
                         <div class="image">
                              <img src="images/mail-icon.png" alt="Queen Filters" />
                         </div>
                         <div class="text">
                              <h6>E-mail Address</h6>
                              <span>admin@royaldrive.in</span>
                              <div style="clear:both"></div>
                         </div>
                    </div>
                    <!-- Email -->
                   <!-- <div class="address">
                         <div class="image">
                              <img src="images/fax-icon.png" alt="Queen Filters" />
                         </div>
                         <div class="text">
                              <h6>Fax</h6>
                              <span>+971-6-6548217</span>
                              <div style="clear:both"></div>
                         </div>
                    </div>-->
               </div>
               <!-- End Left -->
               <div style="clear:both"></div>
          </div>
     </div>
</div>
<!-- Map -->
<div id="map-container"> 
<!--     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d248803.886645605!2d77.47549224251897!3d12.99992380468632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1458578147937" width="" height="367" frameborder="0" style="width: 100%; border:0" allowfullscreen></iframe>-->
</div>
<!-- Map -->