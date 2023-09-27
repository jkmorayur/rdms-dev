<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>General Tech Services LLC</title>
     </head>

     <body style="margin:0px; padding:0px;">
          <div style="width:760px;height:auto;border:1px solid #dbdada;padding:10px 20px; margin:10px auto; ">
<!--               <div style="float:left; text-align:center; padding:20px 0px; width:100%;">
                    <img src="http://talktomydesigner.com/projects/general_tech/dynamic/assets/images/logo.jpg"  />
               </div>-->
               <div style="font-family:Arial; font-size:18px; color:#d72422;text-transform:uppercase; float:left;
                    text-align:left; padding:5px 0px; ">
                    Dear <?php echo $first_name . ' ' . $first_name; ?>,
               </div>

               <div style="font-family:Arial; font-size:14px; color:#333333;float:left; text-align:left; padding:5px 0px; line-height:24px; margin-bottom:20px; ">
                    Welcome to <strong>General Tech Services LLC</strong>. To log in when visiting our site just click 
                    <a href="<?php echo site_url('user/login'); ?>" target="_blank" style="color:#F00;">Login</a> or My 
                    <a href="<?php echo site_url('user/register'); ?>" target="_blank" style="color:#F00;">Account</a> at the top of every page, and then enter your e-mail address and password.
               </div>
               <div style="font-family:Arial; font-size:14px; color:#333333;float:left; text-align:left; padding:5px 0px; line-height:24px;">
                    Use the following values when prompted to log in:
               </div>

               <table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-family:sans-serif; color:#333; font-size:13px;">
                    <tr style="background:#f2f2f2;">
                         <td width="20%"><strong>E-mail:  </strong></td>
                         <td width="87%"><?php echo $email; ?></td>
                    </tr>
                    <tr style="background:#f2f2f2;">
                         <td><strong>Password: </strong></td>
                         <td><?php echo $password; ?></td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              <div style="font-family:Arial; font-size:14px; color:#333333;float:left; text-align:left; padding:5px 0px; line-height:22px; margin-top:10px; ">  
                                   If you have any questions about your account or any other matter, please feel free to contact us at admin@royaldrive.in or by phone at  9745-059-090 Please do not reply to this address.
                              </div>
                         </td>
                    </tr>
               </table>
               <div style="clear:both"></div>
          </div><!-- END-->
     </body>
</html>