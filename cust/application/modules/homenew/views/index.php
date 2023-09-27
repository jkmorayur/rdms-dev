<style>
     .popular .owl-buttons .owl-next {
          width: 17px;
          height: 38px;
          text-indent: -99999px;
          right: -30px;
          top: 352px!important;
     }
     .popular .owl-buttons .owl-prev {
          width: 17px;
          height: 38px;
          text-indent: -99999px;
          right: -30px;
          top: 352px!important;
     }
     .popular .owl-buttons div {
          position: absolute;
     }
     
     #ajx-lat-lgkkk {
          height: 200px;

          transition: height 0.66s ease-out;
     }
     .ajx-lat-lg_loading{
          position: absolute;
          margin-top: 10px;
          margin-left: 484px;
     }
     .ajxPopular_loading{
          position: absolute;
          margin-top: 10px;
          margin-left: 484px; 
     }
     .ajxRdMini_loading{
          position: absolute;
          margin-top: 10px;
          margin-left: 484px;  
     }
  
     
</style>

<!-- slider Section --> 
<section id="demo" class="hero">
     <div class="container" style="width: 100%;padding: 0px;">
          <div id="owl-carousel-main-banner" class="owl-carousel" style="padding : 0px;">
               <div class="item wow bounceInRight" data-wow-delay="1s">
                    <img onclick="getMobileOperatingSystem()" src="images/b0.webp" alt="Add to Your Power" usemap="#rdbanner">
                    <map name="rdbanner">
                         <area style="border:none; text-decoration:none; outline:none" target="_blank" alt="Google play store" title="Google play store" href="<?php echo get_settings_by_key('app_android_link');?>" 
                               coords="844,101,976,136" shape="rect">
                         <area style="border:none; text-decoration:none; outline:none" target="_blank" alt="App store" title="App store" href="<?php echo get_settings_by_key('app_ios_link_app_store');?>" coords="706,101,834,134" shape="rect">
                    </map>
                    <div class="caption">
                         <div class="summary">
                              <h1 class="animated-late fadeInUpQuick delay-1-5">Add to Your Power</h1>
                              <p class="animated fadeInUpQuick delay-1-8">Biggest Collection of Luxury Cars and Bikes <br>Biggest Showroom in South India </p> 
                              <div class="hero_btn animated fadeInUpQuick delay-1-8">
                                   <a href="<?php echo site_url('aboutus');?>">Know More</a>
                              </div> 
                         </div>
                    </div>    
               </div>
               <div class="item wow bounceInRight" data-wow-delay="1s" style="padding : 0px;">
                    <img src="images/b1.webp" alt="Add to Your Power">
               </div> 
               <div class="item">
                    <img src="images/b2.webp" alt="Add to Your Power" style="padding : 0px;">
               </div>
               <div class="item">
                    <img src="images/b3.webp" alt="Add to Your Power" style="padding : 0px;">
               </div>
               <div class="item" style="padding : 0px;">
                    <?php $smrt = "https://www.rdsmart.in";?>
                    <img style="cursor: pointer;" src="images/b4.webp" alt="Add to Your Power" onclick="window.location.href = '<?php echo $smrt;?>'">
               </div>
          </div>
     </div>
</section>
<!-- slider Section ends--> 

<!-- -->
<section class="about">
     <div class="container">
          <div class="row">
               <div class="col-sm-6 wow bounceInLeft" data-wow-delay="1s">
                    <div id="owl-demo" class="owl-carousel">
                         <div class="item wow bounceInRight" data-wow-delay="1s">
                              <img src="images/slider1.webp" alt="Add to Your Power">
                         </div>
                         <div class="item wow bounceInRight" data-wow-delay="1s">
                              <img src="images/slider2.webp" alt="Add to Your Power">
                         </div>
                         <div class="item wow bounceInRight" data-wow-delay="1s">
                              <img src="images/slider3.webp" alt="Add to Your Power">
                         </div>
                         <!--                         <div class="item wow bounceInRight" data-wow-delay="1s">
                                                       <img src="images/slider4.jpg" alt="Add to Your Power">
                                                  </div>
                                                  <div class="item wow bounceInRight" data-wow-delay="1s">
                                                       <img src="images/slider5.jpg" alt="Add to Your Power">
                                                  </div>-->
                    </div>
               </div>
               <div class="col-sm-6 about_imge wow bounceInRight" data-wow-delay="1s">
                    <?php cms('shrm_desc');?>
               </div>
          </div>
     </div>
</section>
<!-- -->

<!-- search box starts--> 
<section class="search">
     <div class="container">
          <div class="row">        
               <form class="bs-example" method="post" name="frmSearch" id="frmSearch" enctype="multipart/form-data">  
                    <div class="col-sm-4">              
                         <div class="form-group">
                              <input type="text" class="form-control txtKeyword" placeholder="Type the keyword here" name="txtKeyword">
                         </div>
                    </div>
                    <div class="col-sm-2">              
                         <div class="form-group">
                              <select class="form-control SlectBox inputs cmbBrand" name="cmbBrand[]" 
                                      multiple="multiple" placeholder="Brand">
                                           <?php foreach ((array) $brands as $key => $value) {?>
                                          <option value="<?php echo trim($value['brd_title']);?>">
                                               <?php echo $value['brd_title'];?>
                                          </option>
                                     <?php }?>
                              </select>
                         </div>
                    </div>
                    <div class="col-sm-2">              
                         <div class="form-group">
                              <input autocomplete="off" type="text" class="form-control inputs budget onlynumber keypressdisabled txtBudget" placeholder="Budget" name="txtKeyword">
                              <div class="bubble">
                                   <input placeholder="From" autocomplete="off" type="text" name="txtBudgetFrom" 
                                          class="inputs txtCustBudget onlynumber txtHomeSerachBudgetFrom txtBudgetFrom"/>
                                   <input placeholder="To" autocomplete="off" type="text" name="txtBudgetTo" 
                                          class="inputs txtCustBudget onlynumber txtHomeSerachBudgetTo txtBudgetTo"/>
                                   <ul class="liBudget">
                                        <li>&#2352; 0</li>
                                        <li value="25000">&#2352; 25.0 K +</li>
                                        <li value="100000">&#2352; 1.0 Lacs +</li>
                                        <li value="500000">&#2352; 5.0 Lacs +</li>
                                        <li value="1000000">&#2352; 10.0 Lacs +</li>
                                   </ul>
                              </div>
                         </div>
                    </div>
                    <div class="col-sm-4">              
                         <div class="form-group">
                              <button type="submit" class="btn btn-primary">Search</button>
                              <div class="advanced">
                                   +<a href=""  data-toggle="modal" data-target="#advanced_search"> Advanced Search</a>
                              </div>
                         </div>
                    </div>
               </form>
               <!-- Advanced search popup -->
               <div class="col-sm-4">              
                    <div class="form-group">
                         <!-- advance search Modal -->
                         <div class="modal fade" id="advanced_search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-vertical-centered modal-lg">
                                   <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <div class="modal-header">                
                                             <h2 class="modal-title text-center" id="myModalLabel">Advanced Search</h2>
                                        </div>
                                        <div class="row">
                                             <div class="modal-body">
                                                  <form class="refer_friend advnc_srch frmAdvSearch">
                                                       <div class="col-sm-12">
                                                            <div class="form-group">
                                                                 <input name="txtKeyword" type="text" class="form-control txtAdvKeyword" placeholder="Keyword">
                                                            </div>

                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <?php
                                                                   $selectedBrands = (isset($searchParams['brand']) && !empty($searchParams['brand'])) ? explode(',', $searchParams['brand']) : array();
                                                                 ?>
                                                                 <select name="cmbBrand[]" multiple="multiple" placeholder="Brand" class="cmbBrand SlectBox form-control inputs cmbAdvBrand">
                                                                      <?php
                                                                        if (!empty($brands)) {
                                                                             foreach ($brands as $key => $value) {
                                                                                  ?>
                                                                                  <option value="<?php echo $value['brd_title'];?>"><?php echo $value['brd_title'];?></option>
                                                                                  <?php
                                                                             }
                                                                        }
                                                                      ?>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <input type="text" name="txtColor" class="form-control txtAdvColor" placeholder="Color" />
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-12">
                                                            <div class="block_devider"></div>
                                                       </div> 
                                                       <div class="col-sm-3">
                                                            <div class="form-group">
                                                                 <select name="txtBudgetFrom" class="form-control txtAdvBudgetFrom">
                                                                      <option value="">Budget From</option>
                                                                      <option value="0">&#2352; 0</option>
                                                                      <option value="25000">&#2352; 25.0 K +</option>
                                                                      <option value="100000">&#2352; 1.0 Lacs +</option>
                                                                      <option value="500000">&#2352; 5.0 Lacs +</option>
                                                                      <option value="1000000">&#2352; 10.0 Lacs +</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-3">
                                                            <div class="form-group">
                                                                 <select name="txtBudgetTo" class="form-control txtAdvBudgetTo">
                                                                      <option value="">Budget To</option>
                                                                      <option value="0">&#2352; 0</option>
                                                                      <option value="25000">&#2352; 25.0 K +</option>
                                                                      <option value="100000">&#2352; 1.0 Lacs +</option>
                                                                      <option value="500000">&#2352; 5.0 Lacs +</option>
                                                                      <option value="1000000">&#2352; 10.0 Lacs +</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-3">
                                                            <div class="form-group">
                                                                 <input type="text" name="txtModelFrom" class="form-control onlynumber txtAdvModelFrom" placeholder="Year From" />
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-3">
                                                            <div class="form-group">
                                                                 <input type="text" name="txtModelTo" class="form-control onlynumber txtAdvModelTo" placeholder="Year To" />
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <input type="text" class="form-control txtAdvKmDriven onlynumber" placeholder="Kms driven" name="txtKmDriven">
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <select class="form-control cmbAdvFualType" name="cmbFualType">
                                                                      <option value="0">Select Fuel Type</option>
                                                                      <option value="diesel">Diesel</option>
                                                                      <option value="petrol">Petrol</option>
                                                                      <option value="gas">Gas</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-12">
                                                            <div class="form-group">
                                                                 <button type="submit" class="btn btn-primary">Search</button>
                                                                 <button type="reset" class="btn btn-link">Clear</button>                  
                                                            </div>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div><!-- /.modal-content -->                           
                              </div><!-- /.modal-dialog -->
                         </div>
                    </div>                
               </div>
          </div>
     </div>
</section>
<!-- search box ends--> 
<style>
     .cardj{
          margin: 10px !important;
     }
     .nav-left{
          margin-left: 3px;
          line-height: 1.42857143;
          border-radius: 50px;
          font-size: 14px;
          font-family: 'LatoBold';
          padding: 6px 22px;
          border: 2px
     }

     .nav-left>li>a {
          position: relative;
          display: block;
     }
     .jnavleft-tabs>li>a {
          margin-right: 2px;
          line-height: 1.42857143;
          border-radius: 50px;
          font-size: 14px;
          font-family: 'LatoBold';
          padding: 6px 22px;
          border: 2px solid transparent;
     }
     .end-msg{
          position: absolute;
          margin-top: 10px;
          margin-left: 484px; 
          z-index: 1;
     }
    .nav-tabs>.ev.active>a,
     .nav-tabs>.ev.active>a:focus,
     .nav-tabs>.ev.active>a:hover {
          color: #343434 !important;
          cursor: default !important;
          border: 2px solid #39ff05 !important;
     }

     .nav-tabs>.ev>a:hover {
          border: 2px solid #34cb17 !important;
          color: #343434 !important;
     }
     .nav-tabs{
   height: 81px !important;
    /* width: 100%!important; */
    padding: 0!important;
    margin: 0px!important;
     }
     .mnu{
          margin-top: 60px!important;
      width: 100%;
     }
     .prdj{

          height: 46px !important;
     }
</style>
<!--product starts--> 
<section class="popular">
     <div class="container">

          <div class="col-sm-6 pull-right mnu"> 
               <ul class="nav nav-tabs" >
                    <li class="ev"><a class="tab" data-count='<?php print $evCount ?>' data-category='ev' href="#ev" data-toggle="tab">EV</a></li>
                    <li class="active"><a id='newTb' class="tab" data-count='<?php print $newCount ?>' data-category='new' href="#latest" data-toggle="tab">Latest</a></li>
                    <li><a class="tab" data-count='<?php print $popularCount ?>' data-category='popular' href="#popular" data-toggle="tab">Popular</a></li>
                    <li><a class="tab" href="https://www.rdsmart.in/" target="_blank">RD Smart</a></li>
               </ul>
          </div>
          <div class="row prd"> 
               <div class="bs-example">

                    <div id="myTabContent" class="tab-content scroll-to">

                         <!------------------- ev -->
                         <div class="tab-pane fade " id="ev">
                              <div id="ev_tab" class="owl-carouselj">

                                   <div  id="ajx-ev-lg">
                                        ....                       
                                   </div>
                                   <div class='ajx-ev-lg_loading' style="display:none">
                                        <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                                   </div>
                                   <div class="owl-controls clickable" style="display: block;">
                                        <div class="owl-buttons">
                                             <div class="owl-prev evPrv"></div>
                                             <div class="owl-next evNext"></div>

                                        </div>

                                   </div>
                              </div>

                              <!--item for mobile starts-->
                              <div class="item_formobile">
                                   <div id='ajx-ev-mob'>

                                   </div>
                                   <div class='mob_ajx-ev_loading' style="display:none" >
                                        <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                                   </div>
                              </div>

                              <!--item for mobile starts-->
                         </div>
                         <!------------------- @ev -->
                         <div class="tab-pane fade active in" id="latest">
                              <div id="Latest_tab" class="owl-carouselj">
                                   <div  id="ajx-lat-lg">
                                        ....                       
                                   </div>
                                   <div class='ajx-lat-lg_loading' style="display:none">
                                        <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                                   </div>
                                   <div class="owl-controls clickable" style="display: block;">
                                        <div class="owl-buttons">
                                             <div class="owl-prev newPrv"></div>
                                             <div class="owl-next newNext"></div>

                                        </div>

                                   </div>
                              </div>

                              <!--item for mobile starts-->
                              <div class="item_formobile">
                                   <div id='ajx-lat-mob'>

                                   </div>
                                   <div class='mob_ajx-lat_loading' style="display:none" >
                                        <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                                   </div>
                              </div>

                              <!--item for mobile starts-->
                         </div>

                         <div class="tab-pane fade" id="popular">

                              <div id="popular_tab" class="owl-carouselj">
                                   <div id="ajxPopular">
                                        ..........
                                   </div>
                                   <div class='ajxPopular_loading' style="display:none">
                                        <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                                   </div>
                                   <div class="owl-controls clickable" style="display: block;">
                                        <div class="owl-buttons">
                                             <div class="owl-prev popPrv"></div>
                                             <div class="owl-next popNext"></div>

                                        </div>

                                   </div>
                              </div>
                              <!--item for mobile starts-->
                              <div class="item_formobile">
                                   <div class="ajxPopularMob" id="ajxPopularMob">

                                   </div>
                              </div>
                              <!--item for mobile starts-->
                         </div>
                    </div>
                    <div class='mob_ajx_loading' style="display:none" >
                         <img src="<?php echo base_url();?>rdportal/assets/images/loading.gif">
                    </div>
                    <!--                    <div class="prod_endk" style="height:5px; width:10px;">Loading... </div>-->
               </div>
          </div>
     </div>
     <div class="prod_end" style="height:5px; width:10px;"></div>
</section>
<!--product ends--> 

<!--feedback starts-->
<section class="feedback">
     <div class="container">
          <div class="row">
               <div class="col-sm-6 wow bounceInLeft" data-wow-delay="1s">
                    <h1>What our customer says</h1>
                    <div id="owl-demo" class="owl-carousel">
                         <div class="item wow bounceInLeft" data-wow-delay="1s">
                              <img src="images/nl.webp"/>
                         </div>

                         <div class="item wow bounceInLeft" data-wow-delay="1s">
                              <img src="images/nl2.webp"/>
                         </div>

                         <div class="item wow bounceInLeft" data-wow-delay="1s">
                              <img src="images/nl3.webp"/>
                         </div>
                    </div>
               </div>
               <div class="col-sm-6 about_imge wow bounceInRight" data-wow-delay="1s">
                    <div class="vid-main-wrapper clearfix">

                         <!-- THE YOUTUBE PLAYER -->
                         <div class="vid-container">
                              <iframe style="width: 100%" id="vid_frame" src="https://www.youtube.com/embed/<?php echo $lastvideo;?>?rel=0&showinfo=0&autohide=1" 
                                      frameborder="0" width="200" height="315"></iframe>
                         </div>
                         <!-- THE PLAYLIST -->

                         <div class="vid-list-container">
                              <div class="scrollmenu">
                                   <?php
                                     if (!empty($youtubeList)) {
                                          foreach ($youtubeList as $key => $item) {
                                               $url = "'https://youtube.com/embed/" . $item['snippet']['resourceId']['videoId'] . "?rel=0&showinfo=0&autohide=1'";
                                               ?>
                                               <a title="<?php echo $item['snippet']['title'] . '<br>' . $item['snippet']['channelTitle'];?>" href="javascript:void();" onClick="document.getElementById('vid_frame').src = <?php echo $url;?>">
                                                    <div class="vid-thumb">
                                                         <img width=72 src="<?php echo $item['snippet']['thumbnails']['default']['url'];?>"/>
                                                    </div>
                                               </a>
                                               <?php
                                          }
                                     }
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row plan_policy">
               <div class="col-sm-3 brdr_rgt text-center">
                    <div class="icon_bx"><img src="images/icons-03.svg"></div>
                    <h2>Buyback Policy*</h2>
                    <p>
                         Royal Drive will buyback for the best price. We will also let you display the car at our showroom and help you sell it.
                         You can also feature the car on our website without displaying at our showroom.<br>
                    </p>
               </div>
               <div class="col-sm-3 brdr_rgt text-center">
                    <div class="icon_bx"><img src="images/icons-02.svg"></div>
                    <h2>Easy Finance Plans</h2>
                    <p>
                         We will give you the best loans and EMI plans, we have tie-up with several banks in all over India. 
                         And provide you with fast and hassle-free loans through these banks after checking your bank statements.
                    </p>
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#mdlEMICalculator">EMI Calculator</button>
                    <!-- Refer Modal -->
                    <div class="modal fade" id="mdlEMICalculator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-vertical-centered modal-lg">
                              <div class="modal-content">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   <div class="modal-header">                
                                        <h2 class="modal-title text-center" id="myModalLabel">EMI Calculator</h2>
                                   </div>
                                   <div class="row">
                                        <div class="modal-body">
                                             <form class="refer_friend advnc_srch frmEMICalculator" action="<?php echo site_url('vehicle/emiCalculator');?>">
                                                  <div class="col-sm-12">
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <span class="form-control-label">Loan amount <span>*</span> </span>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <input name="emi_loan_amt" autocomplete="off" type="text" class="numOnly form-control emi_loan_amt" value=""/>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12">
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <span class="form-control-label">Percentage rate of interest <span>*</span></span>
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <input name="emi_int_per" autocomplete="off" type="text" 
                                                                        class="numOnly form-control emi_int_per" value=""/>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12">
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <span class="form-control-label">Tenure (Year) <span>*</span></span> 
                                                            </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <input name="emi_tenure" autocomplete="off" type="text" class="numOnly form-control emi_int_per" value=""/>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12">
                                                       <div class="col-sm-6">
                                                            <div class="form-group divEMIError" style="float: right;font-size: 12px;font-weight: bold;color: red;"></div>
                                                       </div>
                                                  </div>

                                                  <div class="col-sm-12">
                                                       <div class="col-sm-12">
                                                            <div class="form-group">
                                                                 <button type="submit" class="btn btn-primary btnCalculate">Calculate</button>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12 divEMICalcResult"></div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Refer Modal -->
               </div>
               <div class="col-sm-3 text-center">
                    <div class="icon_bx"><img src="images/icons-04.svg"></div>
                    <h2>Refer and win assured Gift</h2>
                    <p>Refer your friends or colleagues to us and win assured surprise gift.</p>
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#referFriend">Refer Now</button>
                    <!-- Refer Modal -->
                    <div class="modal fade" id="referFriend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-vertical-centered modal-lg">
                              <div class="modal-content">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   <div class="modal-header">                
                                        <h2 class="modal-title text-center" id="myModalLabel">Refer a Friend</h2>
                                   </div>
                                   <div class="row">
                                        <div class="modal-body">
                                             <form class="refer_friend frmReferFriend" action="<?php echo site_url('home/referFriend');?>" method="post">
                                                  <input type="hidden" name="ref_user_id" value="<?php echo empty($logged_uid) ? 0 : $logged_uid;?>"/>
                                                  <div class="col-sm-12">
                                                       <h2  class="line-title"><span>Your details</span> <hr /></h2>
                                                  </div>  
                                                  <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <input value="<?php
                                                              echo isset($this->session->userdata['gtech_logged_user']['first_name']) ?
                                                                      $this->session->userdata['gtech_logged_user']['first_name'] : '';
                                                            ?>" type="text" class="form-control" placeholder="First name" name="ref_first_name">
                                                       </div>
                                                       <div class="form-group">
                                                            <input value="<?php
                                                              echo isset($this->session->userdata['gtech_logged_user']['phone']) ?
                                                                      $this->session->userdata['gtech_logged_user']['phone'] : '';
                                                            ?>" type="text" class="form-control" placeholder="Mobile number" name="ref_mobile">
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <input value="<?php
                                                              echo isset($this->session->userdata['gtech_logged_user']['last_name']) ?
                                                                      $this->session->userdata['gtech_logged_user']['last_name'] : '';
                                                            ?>" type="text" class="form-control" placeholder="Last name" name="ref_last_name">
                                                       </div>
                                                       <div class="form-group">
                                                            <input value="<?php
                                                              echo isset($this->session->userdata['gtech_logged_user']['email']) ?
                                                                      $this->session->userdata['gtech_logged_user']['email'] : '';
                                                            ?>" type="text" class="form-control" placeholder="Email address" name="ref_email">
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12">
                                                       <h2 class="line-title"><span>Your friendâ€™s details</span><hr/></h2>
                                                  </div>  
                                                  <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="First name" name="ref_frnd_first_name">
                                                       </div>
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Mobile number" name="ref_frnd_mobile">
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Last name" name="ref_frnd_last_name">
                                                       </div>
                                                       <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Email address" name="ref_frnd_email">
                                                       </div>
                                                  </div>
                                                  <div class="col-sm-12">
                                                       <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Register</button>
                                                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>                  
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>

                              </div><!-- /.modal-content -->
                         </div><!-- /.modal-dialog -->
                    </div>
                    <!-- Refer Modal ends-->
               </div>
               <div class="col-sm-3 brdr_rgt text-center">
                    <div class="icon_bx"><img width="42" src="images/150.png"></div>
                    <h2>150+ Check points</h2>
                    <p>
                         Our 150+ multi check point will ensure every feature and function of the car is carefully inspected. 
                         When you buy a RD pre owned certified car you have our assurance that all cars have to meet our meticulous standards.
                    </p>
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#150CheckPoints">Our 150 + Check points</button>

                    <div class="modal fade " id="150CheckPoints" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-vertical-centered modal-lg">
                              <div class="modal-content">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   <div class="modal-header">                
                                        <h2 class="modal-title text-center" id="myModalLabel">150+ Check points</h2>
                                   </div>
                                   <div class="row">
                                        <div class="modal-body">
                                             <iframe src="150-check-points.pdf#toolbar=0&navpanes=0&scrollbar=0&zoom=100" 
                                                     title="PDF in an i-Frame" frameborder="0" scrolling="auto" 
                                                     style="width:100%;height: 500px;cursor: pointer;"></iframe>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!--feedback ends-->
<style>
     .modal-lg {
          width: 900px;
          height: 1000px;
          position: absolute;
          top: 1%;
          left: 15%;
     }
     @media (max-width:760px) {
          .modal-lg {
               left: 0%;
               width: 90%;
          }
     }
     @media (min-width:300px) {
          .owl-carousel {
               /*display:none !important;*/
          }
          .item_formobile {
               display : block !important;
          }
     }

  @media (min-width:1081px) {
          /* new */
          .owl-carousel {
               display: block !important;
          }

          .item_formobile {
               display: none !important;
          }
     }

      @media only screen and (max-width: 811px) and (min-width: 809px) {
          /* new */
          .veh_name_h3{
               display: none;
          }  
          .veh_name_h5{
               color:#343434;
               font-size 1.7vw;
           display: block!important;
          }    
     }
     div.scrollmenu {
          background-color: #333;
          overflow: auto;
          white-space: nowrap;
     }
     div.scrollmenu a {
          display: inline-block;
          color: white;
          text-align: center;
          padding: 14px;
          text-decoration: none;
     }

     div.scrollmenu a:hover {
          background-color: #777;
     }

</style>
<!--about starts-->
<section class="about">
     <div class="container">
          <div class="row">
               <div class="col-sm-6 wow bounceInLeft" data-wow-delay="1s">
                    <?php cms('abt_rd');?>
               </div>

               <div class="col-sm-6 about_imge wow bounceInRight" data-wow-delay="1s">
                    <img src="images/360.webp" id="imgthree"> 
               </div>
               <script type="text/javascript">
                                                    document.getElementById("imgthree").onclick = function () {
                                                         location.href = "https://www.google.com/maps/place/Royal+Drive+Calicut/@11.2407532,75.8379936,3a,75y,350.76h,79.21t/data=!3m8!1e1!3m6!1sAF1QipMZ35Ir3gb3GXtAXJf2DF_dFusKnOeGA-OuVfTB!2e10!3e11!6shttps:%2F%2Flh5.googleusercontent.com%2Fp%2FAF1QipMZ35Ir3gb3GXtAXJf2DF_dFusKnOeGA-OuVfTB%3Dw203-h100-k-no-pi-20-ya216.8-ro0-fo100!7i5500!8i2750!4m9!1m2!2m1!1sroyal+drive+luxury+cars+360!3m5!1s0x3ba64a855137bcd1:0x514c08f81866999e!8m2!3d11.2405545!4d75.8380974!15sChtyb3lhbCBkcml2ZSBsdXh1cnkgY2FycyAzNjAiBogBAaABAVodIhtyb3lhbCBkcml2ZSBsdXh1cnkgY2FycyAzNjCSAQ91c2VkX2Nhcl9kZWFsZXKaASNDaFpEU1VoTk1HOW5TMFZKUTBGblNVUmphVzlUZDJWbkVBRQ";
                                                    };
               </script>
          </div>
          <div class="row plan_policy">
               <div class="col-sm-12">
                    <div id="brand_logos" class="owl-carousel">
                         <?php
                           foreach ($brandsLogo as $key => $value) {
                                $img = '';
                                if (isset($value['brd_logo']) && !empty($value['brd_logo'])) {
                                     $img = $value['brd_logo'];
                                }
                                ?>
                                <div class="item wow bounceInRight" data-wow-delay="0.<?php echo $key;?>s">
                                     <?php echo img(array('src' => './assets/uploads/brand/' . $img, 'alt' => $value['brd_title']));?>
                                </div>
                                <?php
                           }
                           foreach ($brandsLogo as $key => $value) {
                                $img = '';
                                if (isset($value['brd_logo']) && !empty($value['brd_logo'])) {
                                     $img = $value['brd_logo'];
                                }
                                ?>
                                <div class="item wow bounceInRight" data-wow-delay="0.<?php echo $key;?>s">
                                     <?php echo img(array('src' => './assets/uploads/brand/' . $img, 'alt' => $value['brd_title']));?>
                                </div> 
                                <?php
                           }
                         ?>
                    </div>
               </div>
          </div>
</section>
<div class="modal fade" id="emiCalculatorWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-vertical-centered modal-lg">
          <div class="modal-content" style="float: left;">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <div class="modal-header">                
                    <h2 class="modal-title text-center" id="myModalLabel">EMI Calculator Info</h2>
               </div>

               <div class="modal-body">
                    <p>Above eligibility is subject to you, complying with bank Sanction terms & conditions including</p>
                    <ul class="fa-ul">
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Submission of necessary login Documents</i></li>
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Signing of necessary Loan Agreements & related documents</i></li>
                         <li><i class="fa-li fa fa-get-pocket" style="color:#ffcb05;"></i>Providing appropriate Collateral Security or demanded documents of finance company or both</i></li>
                    </ul>
               </div>

               <div class="modal-footers" style="padding: 35px;">
                    <button type="button" class="btn btn-primary btnEMIAgree" data-dismiss="modal">Agree</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>


<script>
     $(document).ready(function () {
          $('.vid-item').each(function (index) {
               $(this).on('click', function () {
                    var current_index = index + 1;
                    $('.vid-item .thumb').removeClass('active');
                    $('.vid-item:nth-child(' + current_index + ') .thumb').addClass('active');
               });
          });
     });

     var formData = '';
     $(document).on('submit', '.frmEMICalculator', function (e) {
          //  alert('ddd');
          e.preventDefault();
          $('.divEMIError').html('');
          $('.divEMICalcResult').html('');
          formData = $('.frmEMICalculator').serializeArray();
          console.log(formData);
          var emi_loan_amt = formData[0]['value'].trim(); //loadn amount
          var emi_int_per = formData[1]['value'].trim(); //interest rate
          var emi_tenure = formData[2]['value'].trim(); //tenure
          if (emi_loan_amt !== '' && emi_int_per !== '' && emi_tenure !== '') {
               $('#emiCalculatorWarning').modal();
          } else {
               $('.divEMIError').html('Please fill all details');
          }
     });
     $(document).on('click', '.btnEMIAgree', function (e) {
          $.ajax({
               type: 'post',
               url: '<?php echo site_url('vehicle/emiCalculator');?>',
               data: formData,
               beforeSend: function (xhr) {
                    $('.btnCalculate').html('Calculating please wait...');
               },
               success: function (resp) {
                    $('.divEMICalcResult').html(resp);
                    $('.divLoading').hide();
                    $('.btnCalculate').html('Calculate');
               },
               submitHandler: function () {

               }
          });
     });

</script>

<script type="text/javascript">
     $(window).on('beforeunload', function () {// Prevent automatic browser scroll on refresh 
          $(window).scrollTop(0);
     });
     $(document).ready(function () {
          if (window.location.hash) {
               //bind to scroll function
               $(document).scroll(function () {
                    var hash = window.location.hash
                    var hashName = hash.substring(1, hash.length);
                    var element;

                    //if element has this id then scroll to it
                    if ($(hash).length != 0) {
                         element = $(hash);
                    }
                    //catch cases of links that use anchor name
                    else if ($('a[name="' + hashName + '"]').length != 0)
                    {
                         //just use the first one in case there are multiples
                         element = $('a[name="' + hashName + '"]:first');
                    }

                    //if we have a target then go to it
                    if (element != undefined) {
                         window.scrollTo(0, element.position().top);
                    }
                    //unbind the scroll event
                    $(document).unbind("scroll");
               });
          }

     });
     var img = '/assets/images/loading.gif';
     var Mobcategory = 'new';
     // var Mobcategory = 'new';
     var mobPage = 0;
     var pageEv = 0;
     var pageNew = 0;
     var pagePop = 0;
     var pageMini = 0;
     var mobTotalRecords = parseInt(<?php print $newCount?>);
     // $(document).on('click', '.tab', function (e) {
     //      mobTotalRecords = parseInt($(this).data("count"));
     //      Mobcategory = $(this).data("category");
     //      alert(Mobcategory);
     //      mobPage = 0;
     //      loadMoreMob(mobPage, Mobcategory);
     // });
     $(document).on('click', '.tab', function(e) {
//alert('tbClick');
          mobTotalRecords = parseInt($(this).data("count"));
          Mobcategory = $(this).data("category");
        //  alert(Mobcategory);
          mobPage = 0;
          if (Mobcategory == 'ev') {
               $("#ajx-lat-mob").html("");
               $("#ajxPopularMob").html("");
             //  loadMoreMob(mobPage, Mobcategory);
          }else if(Mobcategory=='new'){
               $("#ajx-ev-mob").html("");
               $("#ajxPopularMob").html("");
          }
          else if(Mobcategory=='popular'){
               $("#ajx-ev-mob").html("");
               $("#ajx-lat-mob").html("");
          }
          //alert('hh'+Mobcategory);
         
     });
     var ActiveTab = '';
     var total_pagesEv = parseInt(<?php print $evCount?>);
     var total_pagesNew = parseInt(<?php print $newCount?>);
     var total_pagesPop = parseInt(<?php print $popularCount?>);


     $(document).ready(function () { //ajxPopular
          loadMore('first', 'ev');
          loadMore('first', 'new');
          loadMore('first', 'popular');

     });
     $(document).on('click', '.evNext', function (e) {
          // $('.newNext').hide();
          console.log('cp:' + pageEv + 'tot:' + total_pagesEv);
          pageEv++;
          $('.evPrv').show();
          if (pageEv * 6 < total_pagesEv) {

               loadMore(pageEv, 'ev');
          } else {
               pageEv--;
               console.log('End');
               $(this).hide();
          }
     });
     $(document).on('click', '.newNext', function (e) {
          // $('.newNext').hide();
          console.log('cp:' + pageNew + 'tot:' + total_pagesNew);
          pageNew++;
          $('.newPrv').show();
          if (pageNew * 6 < total_pagesNew) {

               loadMore(pageNew, 'new');
          } else {
               pageNew--;
               console.log('End');
               $(this).hide();
          }
     });
     $(document).on('click', '.popNext', function (e) {
          console.log('cp:' + pagePop + 'tot:' + total_pagesPop);
          pagePop++;
          $('.popPrv').show();
          if (pagePop * 6 < total_pagesPop) {
               loadMore(pagePop, 'popular');
          } else {
               pagePop--;
               $(this).hide();
          }
     });

     function loadMore(page, category) {
          $.ajax({
               url: site_url + 'homenew/loadmore?page=' + page,
               type: "GET",
               data: {cateory: category, device: 'pc'},
               // dataType: "JSON",
               beforeSend: function () {
                    if (category == 'ev') {
                         $(".ajx-ev-lg_loading").show();
                    } else if (category == 'new') {
                         $(".ajx-lat-lg_loading").show();
                    } else if (category == 'popular') {
                         $(".ajxPopular_loading").show();
                    }
               }
          }).done(function (data) {
               if (category == 'ev') {
                    $(".ajx-ev-lg_loading").hide();
                    $("#ajx-ev-lg").html(data);
               } else if (category == 'new') {
                    $(".ajx-lat-lg_loading").hide();
                    $("#ajx-lat-lg").html(data);
               } else if (category == 'popular') {
                    $(".ajxPopular_loading").hide();
                    $("#ajxPopular").html(data);
               }
          });
     }

     $(document).on('click', '.evPrv', function (e) {
          console.log('cp:' + pageEv + 'tot:' + total_pagesEv);
          pageEv--;
          $('.evNext').show();
          if (pageEv == 0) {
               loadPrv('first', 'ev');
          } else if (pageEv > 0) {
               loadPrv(pageEv, 'ev');
          } else if (pageEv < 0) {
               pageEv++;
               $(this).hide();
          }
     });

     $(document).on('click', '.newPrv', function (e) {
          console.log('cp:' + pageNew + 'tot:' + total_pagesNew);
          pageNew--;
          $('.newNext').show();
          if (pageNew == 0) {
               loadPrv('first', 'new');
          } else if (pageNew > 0) {
               loadPrv(pageNew, 'new');
          } else if (pageNew < 0) {
               pageNew++;
               $(this).hide();
          }
     });

     $(document).on('click', '.popPrv', function (e) {
          console.log('cp:' + pagePop + 'tot:' + total_pagesPop);
          pagePop--;
          $('.popNext').show();
          if (pagePop == 0) {
               loadPrv('first', 'popular');
          } else if (pagePop > 0) {
               loadPrv(pagePop, 'popular');
          } else if (pagePop < 0) {
               pagePop++;
               $(this).hide();
          }
     });

     function loadPrv(page, category) {
          $.ajax({
               url: site_url + 'homenew/loadmore?page=' + page,
               type: "GET",
               data: {cateory: category, device: 'pc'},
               beforeSend: function () {
                    if (category == 'ev') {
                         $(".ajx-ev-lg_loading").show();
                    } else if (category == 'new') {
                         $(".ajx-lat-lg_loading").show();
                    } else if (category == 'popular') {
                         $(".ajxPopular_loading").show();
                    }
               }
          }).done(function (data) {
               if (category == 'ev') {
                    $(".ajx-ev-lg_loading").hide();
                    $("#ajx-ev-lg").html(data);
               } else if (category == 'new') {
                    $(".ajx-lat-lg_loading").hide();
                    $("#ajx-lat-lg").html(data);
               } else if (category == 'popular') {
                    $(".ajxPopular_loading").hide();
                    $("#ajxPopular").html(data);
               }
          });
     }
     if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|SymbianOS|Windows Phone|Opera Mini/i.test(navigator.userAgent)) {
          var ready = true; //Assign the flag here
          $(window).scroll(function () {
              // console.log('mobPage--'+mobPage);
               var hT = $('.prod_end').offset().top,
                       hH = $('.prod_end').outerHeight(),
                       wH = $(window).height(),
                       wS = $(this).scrollTop();
                       var loadingTimes=mobTotalRecords;
                       if(mobTotalRecords>6){
                         var leftCount=mobTotalRecords-6;
                    loadingTimes=leftCount/6;
                  var reminder= loadingTimes % 1;
                   if(reminder!=0){
                    loadingTimes=parseInt(loadingTimes)+1;
                   }
                       }else if(mobTotalRecords==1){
                         loadingTimes=0;
                       }
                  
                   console.log('loadingTimes='+loadingTimes);   
               if (mobPage < loadingTimes && ready && wS > (hT + hH - wH)) {
                    ready = false; //Set the flag here
                    mobPage++;
                 
                   // alert('ready='+ready+' mobPage='+mobPage+' mobTotalRecords='+mobTotalRecords+'Mobcategory+'+Mobcategory);
                   
                         loadMoreMob(mobPage, Mobcategory);
                   
               }
               
          });
     }
     function loadMoreMob(mobPage, Mobcategory) {
          $.ajax({
               url: site_url + 'homenew/loadmore?page=' + mobPage,
               type: "GET",
               data: {cateory: Mobcategory, device: 'mobile'},
               // dataType: "JSON",
               beforeSend: function () {
                    $(".mob_ajx_loading").show();

               }
          }).done(function (data) {
               if (data) {
                    if (Mobcategory == 'ev') {
                         $(".mob_ajx-ev_loading").hide();
                         $("#ajx-ev-mob").append(data);
                    } else if (Mobcategory == 'new') {
                         $(".mob_ajx-lat_loading").hide();
                         $("#ajx-lat-mob").append(data);
                    } else if (Mobcategory == 'popular') {

                         $("#ajxPopularMob").append(data);
                    }
                    $(".mob_ajx_loading").hide();
                    ready = true; //Reset the flag here
               } else {
                    alert('end');
                    $(".mob_ajx-ev_loading").hide();
                    $(".mob_ajx_loading").hide();
                   // ready = true; 
               }
               timeout:7001;
          });
     }
     /**
      * Determine the mobile operating system.
      * This function returns one of 'iOS', 'Android', 'Windows Phone', or 'unknown'.
      *
      * @returns {String}
      */
     function getMobileOperatingSystem() {
          var userAgent = navigator.userAgent || navigator.vendor || window.opera;
          console.log(userAgent);
          // Windows Phone must come first because its UA also contains "Android"
          if (/windows phone/i.test(userAgent)) {
               location.href = "";
          }

          if (/android/i.test(userAgent)) {
               location.href = "<?php echo get_settings_by_key('app_android_link');?>";
          }

          // iOS detection from: http://stackoverflow.com/a/9039885/177710
          if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
               location.href = "<?php echo get_settings_by_key('app_ios_link_app_store');?>";
          }

          return "unknown";
     }

     $(window).load(function () {
          alert('page is loaded');

          setTimeout(function () {
               alert('page is loaded and 1 minute has passed');
          }, 60000);

     });
//       $(window).on('load', showDatetime());
//      
//        function showDatetime() {
//        alert(13213);
////            document.querySelector(".date").textContent
////                    = new Date();
//        }
</script>

