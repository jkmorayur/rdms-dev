<script src="scripts/jquery-1.11.2.min.js"></script>
<script src="scripts/jquery.validate.min.js"></script>
<script>
     $(function () {
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
                    $.ajax({
                         type: "POST",
                         url: "<?php echo site_url('user/doForgotPassword'); ?>",
                         data: $(form).serialize(),
                         dataType: "json",
                         success: function (res) {
                              messageBox(res);
                              $(form)[0].reset();
                         }
                    });
               }
          });
     });
</script>
<style>
     span.error {
          color: #F00;
          font-size: 11px;
          padding-left: 42px;
     }
</style>
<!--CONTACT-->
<div id="sectionb_wrapper">
     <div id="sectionb_inner">
          <div id="inner_breadcombmenu">
               <ul>
                    <li><a href="<?php echo site_url(); ?>"> Home &raquo; </a></li>
                    <li><a href="javascript:void(0);" style="color:#d92523;">Forgot Your Password </a></li>
               </ul>
          </div><!--inner_breadcombmenu-->
          <h1>Forgot Your Password?  </h1>
          <div style="clear:both"></div>
     </div><!--sectionb_inner-->
</div><!--sectionb_wrapper-->

<!--INNER-->
<div id="contentmatter_wrapper" style="background:url(images/contactbuilging.jpg) repeat-x left bottom; padding-bottom:30px;">
     <div id="contentcart_inner">
          <div id="login_inner">
               <div class="forget_inner">
                    <div class="forget_loginbg" >
                         <p>Please enter your email below and we will send you a new password.</p><br>
                         <form method="post" name="frmForgotPassword" id="frmForgotPassword"  action="" >
                              <div class="loginfield">
                                   <label>Email Address<strong> *</strong></label>
                                   <input name="email" type="text"  id="email" value=""  class="logininput"/>
                              </div>
                              <span for="email" generated="true" class="error"></span>
                              <input type="submit"  id="submit_form"   value="SUBMIT" name="submit" class="createacc"  style="margin-top:10px;"  />
                              <a href="<?php echo site_url('user/login'); ?>" class="cart_multipleaddress" style="margin-top:20px;">« Back to Login </a>
                         </form>
                         <div style="clear:both"></div>
                    </div>
               </div>
          </div>
          <div style="clear:both"></div>
     </div>
</div>



