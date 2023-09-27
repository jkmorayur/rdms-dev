<section class=""></section>
<!--feedback starts-->
<section class="feedback career inner_pages">
     <div class="container">
          <div class="row">
               <div class="col-sm-12">
                    <h1>Join Our Team</h1>                
               </div>
               <div class="testimonial_hero wow bounceInLeft" data-wow-delay="1s">
                    <div class="col-sm-6 padding_right0 hero_img">
                         <img src="images/career_bg.jpg" alt="Add to Your Power">
                    </div>
                    <div class="col-sm-6 padding_left0">
                         <div class="main_fedbak">
                              <p class="animated fadeInUpQuick delay-1-2 cmnt">We understand the value we and our 
                                   customer gain when we work with intelligent 
                                   people who make smart decisions, 
                                   so that is who we hire !</p> 
                         </div>

                    </div> 
               </div>
               <div class="col-sm-12">
                    <h2 class="career_head">Current Openings</h2>
                    <?php foreach ((array) $careers as $key => $value) {?>
                           <div class="product_box">
                                <div class="col-sm-10 brdr_rgt">
                                     <h2><?php echo $value['car_title'];?></h2>
                                     <div class="text-container">
                                          <div class="text-content short-text">
                                               <?php echo $value['car_desc'];?>
                                          </div>
                                          <div class="show-more">
                                               <a href="#">View more</a>
                                          </div>
                                     </div>
                                </div>
                                <div class="col-sm-2">
                                     <div class="text-center">
                                          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $value['car_id'];?>">Apply</button>
                                     </div>
                                     <!-- Refer Modal -->
                                     <div class="modal fade" id="<?php echo $value['car_id'];?>" tabindex="-1" role="dialog" 
                                          aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-vertical-centered modal-lg">
                                               <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <div class="modal-header">                
                                                         <h2 class="modal-title text-center" id="myModalLabel">Apply for <?php echo $value['car_title'];?></h2>
                                                    </div>
                                                    <div class="row">
                                                         <div class="modal-body">
                                                              <form class="refer_friend frmCareers" id="frmCareers<?php echo $value['car_id'];?>">
                                                                   <input type="hidden" name="cap_post" value="<?php echo $value['car_id'];?>"/>
                                                                   <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                             <input name="cap_fname" type="text" class="form-control" placeholder="First name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <input name="cap_email" type="text" class="form-control" placeholder="Email address">
                                                                        </div>
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                             <input name="cap_lname" type="text" class="form-control" placeholder="Last name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <input name="cap_mobile" type="text" class="form-control" placeholder="Phone number">
                                                                        </div>
                                                                   </div>
                                                                   <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                             <input name="cap_experience" type="text" class="form-control" placeholder="Experience">
                                                                        </div>
                                                                        <div class="uploadOuter form-group">
                                                                             <span class="dragBox"><span>+</span>Upload resume
                                                                                  <input type="file" onchange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" 
                                                                                         name="attachment">
                                                                             </span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
                                                                             <button type="reset" value="Reset" class="btn btn-link" >Clear</button>                  
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
                           </div>
                      <?php }?>
               </div>
          </div>
     </div>
</section>

<script type="text/javascript">
     $(document).ready(function () {
          $(".show-more a").each(function () {
               var $link = $(this);
               var $content = $link.parent().prev("div.text-content");

               console.log($link);

               var visibleHeight = $content[0].clientHeight;
               var actualHide = $content[0].scrollHeight - 1;

               console.log(actualHide);
               console.log(visibleHeight);

               if (actualHide > visibleHeight) {
                    $link.show();
               } else {
                    $link.hide();
               }
          });

          $(".show-more a").on("click", function () {
               var $link = $(this);
               var $content = $link.parent().prev("div.text-content");
               var linkText = $link.text();

               $content.toggleClass("short-text, full-text");

               $link.text(getShowLinkText(linkText));

               return false;
          });
     });

     function getShowLinkText(currentText) {
          var newText = '';
          if (currentText.toUpperCase() === "VIEW MORE") {
               newText = "View less";
          } else {
               newText = "View more";
          }
          return newText;
     }
</script>