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
                              <form class="register-form" id="frmForgotPassword">
                                   <h2>Forgot Your Password?</h2>
                                   <p>Please enter your email below and we'll send you a new password.</p>	
                                   <input type="text" name="email" id="email" placeholder="email address"/>
                                   <input type="submit" name="send" value="Submit" class="btn-submit " >
                                   <p class="message"><a href="javascript:void(0);">Back to Sign In</a></p>
                              </form>
                              <form class="login-form" id="frmLogin" action="<?php echo site_url('user/doLogin'); ?>" method="post">
                                   <h1>Sign In</h1>
                                   <p>If you have a Royal Drive customer account, please sign in.</p>
                                   <input type="text" name="username" id="username" placeholder="Email address"/>	
                                   <input type="password" name="password" id="password" placeholder="Password"/>
                                   <input type="submit" name="send" value="Sign In" class="btn-submit " >
                                   <p class="message">
                                        <a href="<?php echo site_url('user/register'); ?>">Register</a><br /><br />
                                        <a href="javascript:void(0);">Forgot Your Password?</a>
                                   </p>
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
          $("#frmLogin").validate({
               rules: {
                    username: {
                         required: true,
                         email: true
                    },
                    password: {
                         required: true,
                         minlength: 8
                    }
               },
               // Specify the validation error messages
               messages: {
                    email: {
                         required: "Please enter username",
                         email: "Please enter valid email"
                    },
                    password: {
                         required: "please enter password",
                         minlength: "Please enter at least 8 characters"
                    }
               }
          });

          $("#frmForgotPassword").validate({
               // Specify the validation rules
               rules: {
                    email: {
                         required: true,
                         email: true
                    }
               },
               // Specify the validation error messages
               messages: {
                    email: {
                         required: "Please enter email",
                         email: "Please enter valid email"
                    }
               },
               submitHandler: function (form) {
                    $('.btnForgetPass').val('Please wait...');
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/doForgotPassword'); ?>",
                         data: $(form).serialize(),
                         dataType: "json",
                         success: function (res) {
                              $('.btnForgetPass').val('SUBMIT');
                              messageBox(res);
                              $(form)[0].reset();
                         }
                    });
               }
          });
     });
</script><!--CONTACT-->
<style>
     span.error  {
          color: red;
          display: none !important;
     }
     input.error {
          border-bottom: 1px solid red;
     }

</style>
<script type="text/javascript">
     $(document).ready(function(){
          $('.message a').click(function(){
               $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
          });
     });
</script>