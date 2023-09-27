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
                    var formData = new FormData(form);
                    $.ajax({
                         type: "POST",
                         url: site_url + "career/sendCareer",
                         data: formData,
                         dataType: "json",
                         contentType: false,
                         processData: false,
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
<div class="inner-banner about-banner">
     <div id="banner_inner">
          <div class="heading-wrp">
               <div class="heading"></div>
          </div>
     </div>
</div><!--banner_wrapper-->

<!-- Content -->
<div class="cnt-wrapper contact-page">
     <div class="cnt-inner">


          <div class="form-container">

               <div class="cnt-h" style=" margin-top: 40px !important">Job Openings</div>
               <br>


               <!--         <div class="form">   
                         <div style="font-weight: 800; padding-bottom: 10px;">
                        1. SALES MANAGER (M)(Malappuram, Calicut)</div>
                
                            <div style="line-height: 80%;">          
                <div><img src="images/job.png"/> Graduation And Above</div> <br>
               <div><img src="images/job.png"/> 10 Year + Experience</div> <br>
               <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
               <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                            </div>
                     </div>
                        
                        <br>-->
               
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         1. GENERAL MANAGER </div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> 8+ Year Experience</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                    </div>
               </div>
               
               
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         2. BRANCH MANAGER </div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> 6+ Year Experience</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                    </div>
               </div>
               
               
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         3. SALES MANAGER </div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> 4+ Year Experience</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                    </div>
               </div>
               
               
               
               
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         4. ASSISTANT SALES MANAGER (M/F) (Malappuram, Calicut, Kannur & Kasaragod)</div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> 3+ Year Experience</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                    </div>
               </div>


               <br>
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         5. SENIOR SALES EXECUTIVE (M/F) (Malappuram, Calicut, Kannur & Kasaragod)</div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> 4+ Year Experience</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>
                    </div>
               </div>



               <br>
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         6. SALES EXECUTIVE (M)(Calicut & Vadakara)</div>

                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> Experience Preferred</div> <br>
                         <div><img src="images/job.png"/> Salary and Incentive Best in the Industry</div> <br>
                         <!--<div><img src="images/job.png"/> Automobile Industry Preferred</div> <br>-->
                    </div>
               </div>


               <!--          <br>
                         <div class="form">   
                         <div style="font-weight: 800; padding-bottom: 10px;">
                        4. FRONT OFFICE EXECUTIVE (F)(Calicut)</div>
                
                            <div style="line-height: 80%;">          
                <div><img src="images/job.png"/> Any Graduation</div> <br>
               <div><img src="images/job.png"/> Pleasing Personality </div> <br>
               <div><img src="images/job.png"/> Good Communication Skill</div> <br>
               <div><img src="images/job.png"/> Excellent Interpersonal Skill</div> <br>
               
                            </div>
                     </div>-->

               <br>
               <!--               <div class="form">   
                                   <div style="font-weight: 800; padding-bottom: 10px;">
                                        4. Marketing Executive (Calicut, Malappuram)</div>
               
                                   <div style="line-height: 80%;">          
                                        <div><img src="images/job.png"/> Any Degree</div> <br>
                                        <div><img src="images/job.png"/> Freshers can also apply </div> <br>
                                        <div><img src="images/job.png"/> Pleasing Personality</div> <br>
                                        <div><img src="images/job.png"/> Willing to work in field</div> <br>
               
                                   </div>
                              </div>-->
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         7. SALES TRAINEE (Calicut, Malappuram)</div>
                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Any Graduation</div> <br>
                         <div><img src="images/job.png"/> Freshers can also apply </div> <br>
                         <div><img src="images/job.png"/> Pleasing Personality</div> <br>
                         <div><img src="images/job.png"/> Willing to work in field</div> <br>
                    </div>
               </div>
               <br>
<!--               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         5. OFFICE BOY (M)(Calicut)</div>
                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Pleasing Personality</div> <br>
                    </div>
               </div>
               <br>
               <div class="form">   
                    <div style="font-weight: 800; padding-bottom: 10px;">
                         6. HOUSE KEEPING (M/F)(Calicut)</div>
                    <div style="line-height: 80%;">          
                         <div><img src="images/job.png"/> Pleasing Personality</div> <br>
                    </div>
               </div>-->
          </div>

          <div class="cnt-h">contact us</div>
          <!--          <div class="h-line"></div>-->
          <div class="about-form-container">
               <!-- Right -->

               <div class="cnt-inner">
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

                                   <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="attachment" name="attachment">
                                   </div>


                                   <div class="form-row">
                                        <div class="image"><img src="images/f-sec-icon.png" alt="Queen Filters" /></div>
                                        <input name="captcha" type="text" class="field sec-field" placeholder="SECURITY CODE *" />
                                        <div class="captcha-wrp">
                                             <img style="height: 43px;width: 155px;" src="<?php echo site_url('contactus/captcha');?>" alt="Queen Filters" />
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
               </div>
               <div style="clear:both"></div>
          </div>
     </div>
</div>