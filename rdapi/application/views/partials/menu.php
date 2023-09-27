<div class="header-support">

     <img src="images/header-support.png" alt="support" class="support">

     <span ><a href="tel:9539069090" style="color:#039de2; text-decoration: none;"> 9539 06 90 90</a></span>

</div>

<div class="top-menu">

     <span class="menu"><img src="images/nav.png" alt=""/> </span>

     <ul>

          <li><a style="<?php echo ($controller == 'home') ? "color:black" : ''; ?>" href="<?php echo site_url(); ?>">Home</a></li>

          <li><a style="<?php echo ($controller == 'vision') ? 'color:black' : ''; ?>" href="<?php echo site_url('vision'); ?>">Vision</a></li>
          
          <li><a style="<?php echo ($controller == 'aboutus') ? 'color:black' : ''; ?>" href="<?php echo site_url('aboutus'); ?>">About</a></li>

          <!--<li><a style="<?php echo ($controller == 'vision') ? 'color:black' : ''; ?>" href="<?php echo site_url('vision'); ?>">Vision</a></li>-->
          
          <li><a style="<?php echo ($controller == 'mdmsg') ? 'color:black' : ''; ?>" href="<?php echo site_url('mdmsg'); ?>">MD's Message</a></li>

          <!--<li><a style="<?php echo ($controller == 'accessories') ? 'color:black' : ''; ?>" href="<?php echo site_url('accessories'); ?>">Accessories</a></li>-->

          <li><a style="<?php echo ($controller == 'contactus') ? 'color:black' : ''; ?>" href="<?php echo site_url('contactus'); ?>">Contact</a></li>

          <li><a style="<?php echo ($controller == 'career') ? 'color:black' : ''; ?>" href="<?php echo site_url('career'); ?>">Career</a></li>


          <?php if (!empty($logged_uid)) { ?>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'myaccount') ? 'color:black' : ''; ?>" href="<?php echo site_url('user/myaccount'); ?>">My account</a></li>

                 <li><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>

            <?php } else { ?>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'login') ? 'color:black' : ''; ?>" href="<?php echo site_url('user/login'); ?>">Login</a></li>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'register') ? 'color:black' : ''; ?>" href="<?php echo site_url('user/register'); ?>">Register</a></li>

            <?php } ?>

     </ul>

</div>  



<!--<div class="header-support">

     <img src="images/header-support.png" alt="support" class="support">

     <span style="color: black;"><a href="tel:9539069090">9539 06 90 90</a></span>

</div>

<div class="top-menu">

     <span class="menu"><img src="images/nav.png" alt=""/> </span>

     <ul>

          <li><a style="<?php echo ($controller == 'home') ? "color:#039de2" : ''; ?>" href="<?php echo site_url(); ?>">Home</a></li>

          <li><a style="<?php echo ($controller == 'accessories') ? 'color:#039de2' : ''; ?>" href="<?php echo site_url('accessories'); ?>">Accessories</a></li>

          <li><a style="<?php echo ($controller == 'aboutus') ? 'color:#039de2' : ''; ?>" href="<?php echo site_url('aboutus'); ?>">About</a></li>

          <li><a style="<?php echo ($controller == 'contactus') ? 'color:#039de2' : ''; ?>" href="<?php echo site_url('contactus'); ?>">Contact</a></li>



          <?php if (!empty($logged_uid)) { ?>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'myaccount') ? "color:#039de2" : ''; ?>" href="<?php echo site_url('user/myaccount'); ?>">My account</a></li>

                 <li><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>

            <?php } else { ?>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'login') ? "color:#039de2" : ''; ?>" href="<?php echo site_url('user/login'); ?>">Login</a></li>

                 <li><a style="<?php echo ($controller == 'user' && $method == 'register') ? "color:#039de2" : ''; ?>" href="<?php echo site_url('user/register'); ?>">Register</a></li>

            <?php } ?>

     </ul>

</div>  -->