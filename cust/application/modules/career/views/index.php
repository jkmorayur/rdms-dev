<section class=""></section>
<!--feedback starts-->
<section class="feedback career inner_pages">
     <div class="container">
          <div class="row">
               <?php cms('career'); ?>
               <div class="col-sm-12">
                    <h2 class="career_head">Current Openings</h2>
                    <?php foreach ((array) $careers as $key => $value) {?>
                           <div class="product_box">
                                <div class="col-sm-10 brdr_rgt">
                                     <h2><?php echo $value['car_title'];?></h2>
                                     <div class="text-container">
                                          <div class="text-content short-text">
                                               <ul>
                                                    <li>No of Vacancies : <?php echo $value['car_no_of_vacancies'];?></li>
                                                    <li>Qualification : <?php echo strip_specific_tag(str_replace('<p "="">', '<p>', $value['car_qualification']), 'p');?></li>
                                                    <li>Location : <?php echo strip_specific_tag($value['car_location'], 'p');?></li>
                                               </ul>
                                          </div>
                                          <!--                                          <div class="show-more">
                                                                                         <a href="#">View more</a>
                                                                                    </div>-->
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
                                                              <div class="wizard">
                                                                   <!-- SECTION 1 -->
                                                                   <h4></h4>
                                                                   <section>
                                                                        <?php if (!empty(clean_text($value['car_experience_total']))) {?>
                                                                             <div class="form-row" style="margin-bottom: 26px;">
                                                                                  <label for=""><strong>Total Experience:</strong></label>
                                                                                  <div class="form-holder">
                                                                                       <?php echo $value['car_experience_total'];?>
                                                                                  </div>
                                                                             </div>
                                                                        <?php } if (!empty(clean_text($value['car_experience_preferably']))) {?>
                                                                             <div class="form-row" style="margin-bottom: 26px;">
                                                                                  <label for=""><strong>Preferably Experience:</strong></label>
                                                                                  <div class="form-holder">
                                                                                       <?php echo $value['car_experience_preferably'];?>
                                                                                  </div>
                                                                             </div>
                                                                        <?php } if (!empty(clean_text($value['car_pref_industry']))) {?>
                                                                             <div class="form-row" style="margin-bottom: 26px;">
                                                                                  <label for=""><strong>Preferred Industry:</strong></label>
                                                                                  <div class="form-holder">
                                                                                       <?php echo $value['car_pref_industry'];?>
                                                                                  </div>
                                                                             </div>
                                                                        <?php } if (!empty(clean_text($value['car_preferred_competencies']))) {?>
                                                                             <div class="form-row" style="margin-bottom: 26px;">
                                                                                  <label for=""><strong>Preferred Competencies:</strong></label>
                                                                                  <div class="form-holder">
                                                                                       <?php echo $value['car_preferred_competencies'];?>
                                                                                  </div>
                                                                             </div>
                                                                        <?php } if (!empty(clean_text($value['car_age_limit']))) {?>
                                                                             <div class="form-row" style="margin-bottom: 26px;">
                                                                                  <label for=""><strong>Age Limit:</strong></label>
                                                                                  <div class="form-holder">
                                                                                       <?php echo $value['car_age_limit'];?>
                                                                                  </div>
                                                                             </div>
                                                                        <?php }?>
                                                                   </section>

                                                                   <!-- SECTION 2 -->
                                                                   <h4></h4>
                                                                   <section>
                                                                        <h5 for=""><strong>Functional Competencies</strong></h5>
                                                                        <div class="form-row">
                                                                             <div class="text-container">
                                                                                  <?php echo $value['car_functional_competencies'];?>
                                                                             </div>
                                                                        </div>	

                                                                        <h5 for=""><strong>Behavioral Competencies</strong></h5>
                                                                        <div class="form-row">
                                                                             <div class="text-container">
                                                                                  <?php echo $value['car_behavioral_competencies'];?>
                                                                             </div>
                                                                        </div>	

                                                                        <h5 for=""><strong>Job Description</strong></h5>
                                                                        <div class="form-row">
                                                                             <div class="text-container">
                                                                                  <?php echo $value['car_job_description'];?>
                                                                             </div>
                                                                        </div>	
                                                                   </section>

                                                                   <!-- SECTION 3 -->
                                                                   <h4></h4>
                                                                   <section>
                                                                        <form class="refer_friend frmCareers" id="frmCareers<?php echo $value['car_id'];?>">
                                                                             <input type="hidden" name="cap_post" value="<?php echo $value['car_id'];?>"/>
                                                                             <div class="col-sm-6">
                                                                                  <div class="form-group">
                                                                                       <input autocomplete="off" name="cap_fname" type="text" class="form-control" placeholder="First name">
                                                                                  </div>
                                                                                  <div class="form-group">
                                                                                       <input autocomplete="off" name="cap_email" type="text" class="form-control" placeholder="Email address">
                                                                                  </div>
                                                                             </div>
                                                                             <div class="col-sm-6">
                                                                                  <div class="form-group">
                                                                                       <input autocomplete="off" name="cap_lname" type="text" class="form-control" placeholder="Last name">
                                                                                  </div>
                                                                                  <div class="form-group">
                                                                                       <input autocomplete="off" name="cap_mobile" type="text" class="numOnly form-control" placeholder="Phone number">
                                                                                  </div>
                                                                             </div>
                                                                             <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                       <input autocomplete="off" name="cap_experience" type="text" class="form-control" placeholder="Experience">
                                                                                </div>
                                                                             </div>
                                                                             <div class="col-sm-12">
                                                                                  <div class="form-group" style="float:left;width: 48%;">
                                                                                     <select class="form-control" name="cap_district">
                                                                                          <?php if (!empty($districts)) { ?>
                                                                                               <option value="">Select District</option>
                                                                                               <?php foreach ($districts as $key => $value) { ?>
                                                                                                    <option value="<?php echo $value['std_id']; ?>"><?php echo $value['std_district_name']; ?></option>
                                                                                                    <?php
                                                                                               }
                                                                                          }
                                                                                          ?>
                                                                                     </select>
                                                                                </div>
                                                                                <div class="form-group" style="float:right;width: 48%;">
                                                                                       <span class="dragBox" style="padding: 15px 30px;width: 100%;"><span>+</span>Upload resume
                                                                                            <input type="file" onchange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" 
                                                                                                   name="attachment">
                                                                                       </span>
                                                                                  </div>
                                                                             </div>
                                                                             <div class="form-group">
                                                                                       <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
                                                                                       <button type="reset" value="Reset" class="btn btn-link" >Clear</button>                  
                                                                             </div>
                                                                        </form>
                                                                   </section>
                                                              </div>
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