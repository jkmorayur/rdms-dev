<!--CSS -->
<link href="styles/reset.css" rel="stylesheet" type="text/css" />
<link href="styles/header_footer.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="styles/style.css"/>

<link href="styles/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="styles/metro.css"/>
<link rel="stylesheet" href="styles/bootstrap.min.css"/>

<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- -->
<style> 
     #panel {
          padding: 1px;
     }
</style>
<!-- -->
<script src="scripts/jquery.sumoselect.js"></script>
<script src="scripts/zelect.js"></script>

<link href="styles/sumoselect.min.css" rel="stylesheet" />
<link href="styles/zelect.css" rel="stylesheet" />

<script type="text/javascript">
     $(document).ready(function () {
          $('.SlectBox').SumoSelect({
               csvDispCount: 3
          });
          $('.cmbFualType').SumoSelect();
          $('.intro .opt2').zelect({
               placeholder: 'Budget',
               showrange: true
          });
     });

</script>
<style type="text/css">
     .header-support{
          color:#039de2;}
     .field_label{
          min-height:30px;margin-bottom:20px;}
     .eng-btn{
          padding:8px 20px;font-size:16px;font-weight:600;}		
     </style>

     <div id="inner-wrapper">
     <div id="inner-inner">

          <h3><?php echo (isset($products['product_details'])) ? count($products['product_details']) : ''; ?> search results found for <span> Maruti Suzuki Swift </span> </h3>

          <div class="matterbg">

               <?php $this->load->view('partials/search'); ?>

               <div id="searchresultbg">

                    <div class="serchfilter-menubg">
                         Sort : 
                         <ul class="serchfilter">
                              <li class="searchSort" sort-key="popular">
                                   <a href="javascript:void(0);" style="<?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'popular') ? 'color:#039de2;' : '' ?>">Popular</a>
                              </li>
                              <li class="searchSort" sort-key="new">
                                   <a href="javascript:void(0);" style="<?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'new') ? 'color:#039de2;' : '' ?>">New</a>
                              </li>
                              <li class="searchSort" sort-key="high-price">
                                   <a href="javascript:void(0);" style="<?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'high-price') ? 'color:#039de2;' : '' ?>">High Price</a>
                              </li>
                              <li class="searchSort" sort-key="low-price">
                                   <a href="javascript:void(0);" style="<?php echo (isset($searchParams['sort']) && $searchParams['sort'] == 'low-price') ? 'color:#039de2;' : '' ?>">Low Price</a>
                              </li>
                         </ul>
                    </div>

                    <?php if (!empty($products['product_details'])) { ?>
                           <?php foreach ($products['product_details'] as $key => $value) { ?>
                                <div class="serchresultcarbg">
                                     <a href="<?php echo site_url() . 'vehicle/' . get_url_string($value['prd_name']); ?>">
                                          <div class="serchresultcar-img">
                                               <?php $img = isset($value['product_images'][0]['pdi_image']) ? $value['product_images'][0]['pdi_image'] : ''; ?>
                                               <?php echo img(array('src' => './assets/uploads/product/' . $img, 'alt' => $value['prd_name'])); ?>
                                          </div>
                                     </a>
                                     <div class="search-desmatter">
                                          <div class="serchresultcar-des">
                                               <div class="car-desmatter">
                                                    <h1><?php echo $value['prd_name']; ?></h1>
                                                    <h2>
                                                         <?php echo $value['prd_year'] . '/'; ?>
                                                         <?php echo ($value['prd_km_run']) ? number_format($value['prd_km_run']) . '/' : '0/'; ?>
                                                         <?php echo $value['prd_fual_type']; ?>
                                                    </h2>
                                               </div>	
                                               Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod ...
                                          </div>
                                          <div class="serchresultcar-price">
                                               <strong> &#2352; <?php echo number_format($value['prd_price']); ?> </strong>
                                               <a href="#" class="prolink7" data-toggle="modal" data-target="#myModa01">Connect with Seller </a>

                                               <!-- Modal -->
                                               <div class="modal fade" id="myModa01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                         <div class="modal-content">
                                                              <div class="modal-header">
                                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                   <h4 class="modal-title" id="myModalLabel">Connect with Seller</h4>
                                                              </div>
                                                              <div class="modal-body">

                                                                   <div class="field_box">
                                                                        First Name
                                                                        <input name="name" id="name" type="text" class="refinesearch-input" placeholder="Enter your first name " />
                                                                   </div>
                                                                   <div class="field_box">
                                                                        Last Name
                                                                        <input name="name" id="name" type="text" class="refinesearch-input" placeholder="Enter your last name " />
                                                                   </div>

                                                                   <div class="field_box">
                                                                        Email Address
                                                                        <input name="name" id="name" type="text" class="refinesearch-input" placeholder="Enter email address " />
                                                                   </div>
                                                                   <div class="field_box">
                                                                        Phone Number
                                                                        <input name="name" id="name" type="text" class="refinesearch-input" placeholder="Enter your phone number " />
                                                                   </div>

                                                                   <div class="field_box field_new">
                                                                        Comments
                                                                        <textarea  name="message" id='message' cols="" rows="" class="refinesearch-textarea" placeholder="Enter your comments" > Enter your comments </textarea>
                                                                   </div>

                                                                   <div class="field_box field_new">
                                                                        <input type="submit" name="send" value="Submit" class="eng-btn" >
                                                                   </div>
                                                                   <div style="clear:both"></div>
                                                              </div>
                                                         </div>
                                                    </div>
                                               </div>
                                               <!-- Modal -->
                                          </div>
                                     </div>     
                                </div><!--serchresultcarbg-->
                           <?php } ?>
                      <?php } ?>
               </div><!--searchresultbg-->
          </div><!--matterbg-->
          <div style="clear:both"></div>
     </div><!--inner-inner-->
</div><!--inner-wrapper-->
<script src="scripts/bootstrap.min.js"></script>     

<script>
     $(document).ready(function () {
          //$(".slidingDiv").hide();
          $('.show_hide').click(function (e) {
               $(".slidingDiv").slideToggle("slow");
               var val = $(this).html() == '<img src="images/close.jpg">' ? '<img src="images/open.jpg">' : '<img src="images/close.jpg">';
               $(this).hide().html(val).fadeIn("slow");
               e.preventDefault();
          });
     });
</script>

<!-- -->
<script src="scripts/jquery.slidereveal.min.js"></script>


<script>
     $(document).ready(function () {
          var slider = $("#menu-bar").slideReveal({
               // width: 100,
               push: false,
               position: "left",
               // speed: 600,
               trigger: $(".handle"),
               // autoEscape: false,
               shown: function (obj) {
                    obj.addClass("left-shadow-overlay");
               },
               hidden: function (obj) {
                    obj.removeClass("left-shadow-overlay");
               }
          });
     });
</script>
<!-- -->

<style>
    

</style>
