<header class="logo-menu"> 
     <!-- Nav Menu Section -->
     <nav class="navbar-default navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
          <!-- Nav Menu Section -->
          <div class="container">

               <div class="navbar navbar-inverse">
                    <div class="top_nav" >

                         <div>      	
                              <div class="socia_icons">
                                   <a class="social" href="https://www.facebook.com/royaldrivellp" target="_blank">
                                        <i class="fa fa-facebook fa-2x">
                                        </i>
                                   </a>
                                   <!-- <a class="social" href="https://twitter.com/DrivePre?s=08" target="_blank">
                                        <i class="fa fa-twitter fa-2x">
                                        </i>
                                   </a> -->
                                   <a class="social" href="https://www.instagram.com/royaldrivellp/" target="_blank">
                                        <i class="fa fa-instagram fa-2x">
                                        </i>
                                   </a>
                                   <a class="social" href="https://api.whatsapp.com/send?phone=919539069090" target="_blank">
                                        <i class="fa fa-whatsapp fa-2x">
                                        </i>
                                   </a>
                                   <a class="social" href="https://www.youtube.com/channel/UCVxYCu-mOfV3fkBRQjOS0yw" target="_blank">
                                        <i class="fa fa-youtube-play fa-2x">
                                        </i>
                                   </a>
                              </div>
                              <div class="phone">(+91) 81299 09090 <!-- <span>(+91) 85930 19090</span> --></div>
                              <div class="phone login">
                                   <?php if (!empty($logged_uid)) {?>
                                          <a href="<?php echo site_url('user/myaccount');?>">My account  </a>|  
                                          <a href="<?php echo site_url('user/logout');?>">Logout</a>
                                     <?php } else {?>
                                          <a class="setCallBack" data-callback="<?php echo $controller . '/' . $method;?>" href="javascript:;" data-toggle="modal" data-target="#loginModal">Login  </a>|  
                                          <a href="javascript:;" data-toggle="modal" data-target="#registerModal">Register</a>
                                     <?php }?>
                              </div>
                              <!-- Button trigger modal -->
                         </div>

                    </div>
                    <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"> 
                              <span class="sr-only"> Toggle navigation </span> 
                              <span class="icon-bar top-bar"> </span> 
                              <span class="icon-bar middle-bar"> </span> 
                              <span class="icon-bar bottom-bar"> </span> 
                         </button>
                         <a class="navbar-brand" href="<?php echo site_url();?>">
                              <img src="images/logo-royal-drive.svg" alt="BCCS-British Columbia Canadian School"/>
                              <!-- <img src="images/rdsmart-logo.png" alt="Royal Drive Smart"/> -->
                              <!-- <img src="images/christmas-edition.png" alt="Royaldrive"/> -->
                         </a>
                    </div>

                    <!-- Header -->

                    <!-- Navbar Links --> 
                    <div class="collapse navbar-collapse" id="navbar">
                         <ul class="nav navbar-nav animated-nav navbar-right"  id="nav">   
                              <li><a href="<?php echo site_url(); ?>">Home</a> </li>
                              <li class="dropdown">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                      aria-expanded="false">Pre-owned luxury cars <span class="caret"></span></a>
                                   <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo site_url('used-audi-cars'); ?>">Used AUDI Cars</a></li>
                                        <li><a href="<?php echo site_url('used-bmw-cars'); ?>">Used BMW Cars</a></li>
                                        <li><a href="<?php echo site_url('used-mercedes-benz-cars'); ?>">Used Mercedes-Benz Cars</a></li>
                                        <li><a href="<?php echo site_url('used-lamborghini-cars'); ?>">Used Lamborghini Cars</a></li>
                                        <li><a href="<?php echo site_url('used-porsche-cars'); ?>">Used Porsche Cars</a></li>
                                        <li><a href="<?php echo site_url('used-volvo-cars'); ?>">Used Volvo Cars</a></li>
                                        <li><a href="<?php echo site_url('used-jaguar-cars'); ?>">Used Jaguar Cars</a></li>
                                        <li><a href="<?php echo site_url('used-land-rover-cars'); ?>">Used Land Rover Cars</a></li>
                                        <li><a href="<?php echo site_url('used-lexus-cars'); ?>">Used Lexus Cars</a></li>
                                        <li><a href="<?php echo site_url('used-mini-cooper-cars'); ?>">Used Mini Cooper Cars</a></li>
                                        <li><a href="<?php echo site_url('used-bentley-cars'); ?>">Used Bentley Cars</a></li>
                                        <li><a href="<?php echo site_url('used-ford-cars'); ?>">Used Ford Cars</a></li>
                                        <li><a href="<?php echo site_url('used-jeep-cars'); ?>">Used Jeep Cars</a></li>
                                        <li><a href="<?php echo site_url('pre-owned-luxury-cars'); ?>">All brands</a></li>
                                   </ul>
                              </li>
                              <li class="dropdown">
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                      aria-expanded="false">Pre-owned luxury bikes <span class="caret"></span></a>
                                   <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo site_url('used-harley-davidson-bikes'); ?>">Used Harley Davidson Bikes</a></li>
                                        <li><a href="<?php echo site_url('used-triumph-bikes'); ?>">Used Triumph Bikes</a></li>
                                        <li><a href="<?php echo site_url('used-kawasaki-bikes'); ?>">Used Kawasaki Bikes</a></li>
                                        <li><a href="<?php echo site_url('used-bmw-motorrad'); ?>">Used BMW Motorrad</a></li>
                                        <li><a href="<?php echo site_url('used-tvs-bikes'); ?>">Used TVS Bikes</a></li>
                                        <li><a href="<?php echo site_url('used-ktm-bikes'); ?>">Used KTM Bikes</a></li>
                                        <li><a href="<?php echo site_url('pre-owned-luxury-bikes'); ?>">All brands</a></li>
                                   </ul>
                              </li>
                              <li><a href="<?php echo site_url('aboutus');?>">About us </a> </li>
                              <li><a href="<?php echo site_url('contactus');?>">Contact us</a></li>
                              <li><a href="<?php echo site_url('career');?>">Careers</a></li>
                              <li><a data-callback="sell-your-vehicle" href="<?php echo site_url('sell-your-vehicle');?>">Sell your car</a></li>
                         </ul>
                    </div>
               </div>
          </div>
     </nav>
     <!-- Login Modal -->
     <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-vertical-centered">
               <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-header">                
                         <h2 class="modal-title text-center" id="myModalLabel">Login to your Account</h2>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                         <form class="login-form" id="frmLogin" action="<?php echo site_url('user/doLogin');?>" method="post">
                              <div class="form-group">
                                   <input type="text" class="form-control" placeholder="Email Address" name="username" id="username"/>
                              </div>
                              <div class="form-group">
                                   <input type="password" class="form-control" placeholder="Password" name="password" id="password"/>
                              </div>
                              <a class="text-right" href="javascript:;">Forgot Password?</a>
                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary">Login</button>                  
                              </div>
                         </form>
                    </div>
                    <!--  <div class="login_using" style="float: left;width: 100%;">
                         <p>or login using</p>
                    </div> -->
                    <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-default"><i class="fa fa-facebook"></i> facebook</button>
                         <button type="button" class="btn btn-default"> <i class="fa fa-google-plus"></i>Google</button>-->
                    </div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>
     <!-- Login Modal ends-->
     <!-- Register Modal -->
     <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-vertical-centered">
               <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-header">                
                         <h2 class="modal-title text-center" id="myModalLabel">Create a new Account</h2>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                         <form class="register-form" action="<?php echo site_url('user/doRegister');?>" id="frmRegister" method="post">  
                              <div class="form-group">
                                   <input name="email" type="text" class="form-control" placeholder="Email Address">
                              </div>
                              <div class="form-group">
                                   <input name="phone" type="text" class="form-control" placeholder="Mobile number">
                              </div>
                              <div class="form-group">
                                   <input name="password" id="regPassword" type="password" class="form-control" placeholder="Password">
                              </div>
                              <div class="form-group">
                                   <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                              </div>
                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary">Register</button>                  
                              </div>
                         </form>
                    </div>
                    <div class="modal-footer"></div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>
</header>