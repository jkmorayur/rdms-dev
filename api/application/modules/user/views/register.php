<link href="style/css.css" rel="stylesheet" type="text/css" />
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
          <div class="cnt-h"></div>
          <div class="about-form-container">
               <!-- Right -->
               <div class="cnt-inner">
                    <div id="login-page">
                         <div class="login-reg-form">
                              <form class="login-form" id="frmRegister" action="<?php echo site_url('user/doRegister'); ?>" method="post">
                                   <h2>REGISTER</h2>
                                   <p>Profile Informations</p>	
                                   <input type="text" name="email" id="email" placeholder="email address"/>
                                   <input type="text" name="phone" id="phone" placeholder="mobile"/>
                                   <input type="password" name="password" id="password" placeholder="password"/>
                                   <input type="password" name="password_confirmation" placeholder="confirm password"/>
                                   <input type="submit" name="" value="Submit" class="btn-submit"/>
                              </form>
                         </div>
                    </div>
               </div>
               <div style="clear:both"></div>
          </div>
     </div>
</div>

<style type="text/css">
     .err_login{
          color:#F00;
          font-size:14px;
          font-family: 'PT Sans', sans-serif;
          padding-bottom:10px;
          background:url(images/icon_error.png) no-repeat top 5px left;
          padding-left:20px;
          display: none;
     }
     .msgSuccess {
          color: red;
     }
</style>
<script src="scripts/jquery.validate.min.js"></script>
<script>
     $(function () {
          $("#frmRegister").validate({
               // Specify the validation rules
               rules: {
                    email: {
                         required: true,
                         email: true,
                         remote: {
                              url: site_url + 'user/userAlreadyRegistered',
                              type: "post"
                         }
                    },
                    phone: {
                         required : true,
                         number: true
                    },
                    password: {
                         required: true,
                         minlength: 8
                    },
                    password_confirmation: {
                         equalTo: "#password"
                    }
               },
               // Specify the validation error messages
               messages: {
                    email: {
                         required: "Please enter email",
                         email: "Please enter valid email",
                         remote: "User already registered"
                    },
                    phone: {
                         required : "Please enter phone number",
                         number: "Please enter valid phone number"
                    }
               }
          });
     });
</script>
<style>
     span.error  {
          color: red;
          display: none !important;
     }
     input.error {
          border-bottom: 1px solid red;
     }

</style>