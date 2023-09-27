<section class="inner_pages" style="margin-top:133px;">
     <div class="container">
          <div class="row" style="padding:0px 0px 20px 0px">  
               <?php if (isset($author['usr_username']) && !empty($author['usr_username'])) { ?>
                    <div class="col-sm-12">
                         <h2>Hi <?php echo $author['usr_username']; ?></h2>
                    </div>
               <?php } ?>
               <div class="col-sm-12">
                    <!--<h1>Let us keep in touch</h1>-->
                    <div class="contact_box" style="margin-bottom: 0px;">
                         <!--<div class="col-sm-8 padding_0"><img src="images/promo.jpeg"/></div>-->
                         <div class="col-sm-12 padding_0">
                              <div class="form_section">
                                   <div class="col-sm-12">
                                        <h2>Get in touch with us</h2>
                                   </div>
                                   <?php $auth = isset($auth) ? $auth : 0;  ?>
                                   <form action="<?php echo site_url('comeonkerala/index/' . $auth); ?>" id="frmComonKerala" method="post" enctype="multipart/form-data">
                                        <?php if(!empty($auth)) { ?>
                                             <div class="col-sm-12">
                                                  <div class="form-group">
                                                       <select class="form-control" name="eve_type">
                                                            <!-- <option value="">Select one</option> -->
                                                            <option value="1">Sales</option>
                                                            <option value="2">Purchase</option>
                                                            <option value="3">Investment</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        <?php } ?>

                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input required name="eve_name" type="text" class="form-control" placeholder="Your name" autocomplete="off">
                                             </div>
                                             <div class="form-group">
                                                  <input type="text" readonly value="971" name="eve_mobile_non_india_code" class="form-control" style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;"/>
                                                  <div style="width:65%;float: right;margin-bottom: 20px;">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 <input name="radUseMe" class="radUseThisAsWhatsApp1" type="radio" value="1" title="Click here to set WhatsApp number">
                                                            </div>
                                                       </div>
                                                       <input required name="eve_mobile_non_india" type="number" class="txtNRINumber form-control numOnlyWithoutMsg" 
                                                               autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="NRI number">
                                                  </div>
                                             </div> 
                                        </div>
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input autocomplete="off" type="email" name="eve_email" class="form-control" 
                                                          autocomplete="off" placeholder="Your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                             </div>
                                             <div class="form-group">
                                                  <input type="text" readonly value="91" name="eve_mobile_india_code" class="form-control" style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;"/>
                                                  <div style="width:65%;float: right;margin-bottom: 20px;">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 <input name="radUseMe" class="radUseThisAsWhatsApp2" type="radio" value="1" title="Click here to set WhatsApp number">
                                                            </div>
                                                       </div>
                                                       <input name="eve_mobile" type="number" class="txtINDNumber form-control numOnlyWithoutMsg" placeholder="Indian number"
                                                               autocomplete="off" style="border-radius: 0px 50px 50px 0px;">
                                                  </div> 
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input  autocomplete="off" required autocomplete="off" type="number" name="eve_whatsapp"  class="txtWhatsApp form-control numOnlyWithoutMsg" placeholder="WhatsApp">
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                             <div class="form-group">
                                                  <input  autocomplete="off" required autocomplete="off" type="text" name="eve_location"  class="form-control" placeholder="Your location">
                                             </div>
                                        </div>

                                        <div class="col-sm-12">   
                                             <div class="form-group">
                                                  <textarea name="eve_desc" type="text" class="form-control" placeholder="Message"></textarea>
                                             </div>   
                                        </div>
                                        <?php if(!empty($auth)) { ?>
                                             <div class="col-sm-12">   
                                                  <div class="form-group">
                                                       <div id="controls">
                                                            <button id="recordButton" class="btn-primary">Record</button>
                                                            <button id="pauseButton" class="btn-primary" disabled>Pause</button>
                                                            <button id="stopButton" class="btn-primary" disabled>Stop</button>
                                                       </div>
                                                       <div id="formats"></div>
                                                       <div id="recordingsList" style="margin-top: 20px;"></div>
                                                  </div>
                                             </div>
                                        <?php } ?>
                                        <!-- -->
                                        <div class="col-sm-12">
                                             <div class="col-sm-12">
                                                  <h2>Refer a friend 
                                                       <!--<i style="float:right;cursor: pointer;" class="btnNewReference">+</i>-->
                                                  </h2>
                                             </div>
                                             <div class="col-sm-12">
                                                  <div class="form-group">
                                                       <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_name][]" class="form-control" placeholder="Friend name">
                                                  </div>
                                             </div>

                                             <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="971" type="text" readonly name="refer[eve_mobile_ref_non_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_non_india][]" type="text" class="txtNRINumber form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="NRI Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

                                             <div class="col-sm-12" style="float:left;">
                                                  <div class="form-group">
                                                       <input value="91" type="text" readonly name="refer[eve_mobile_ref_india_code][]" class="form-control" 
                                                            style="float: left;width: 35%;border-radius: 50px 0px 0px 50px;border-right: none;">
                                                       <div style="width:65%;float: right;margin-bottom: 20px;">
                                                            <input name="refer[eve_mobile_india][]" type="text" class="txtINDNumber form-control numOnlyWithoutMsg" 
                                                                 autocomplete="off" style="border-radius: 0px 50px 50px 0px;" placeholder="Indian Contact number">
                                                       </div>
                                                  </div> 
                                             </div>

                                             <div class="col-sm-12" style="float: left;width: 100%;">
                                                  <div class="form-group">
                                                       <input autocomplete="off" autocomplete="off" type="text" name="refer[eve_ref_location][]"  class="form-control" placeholder="Friend location">
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="divRefere"></div>
                                        <!-- -->

                                        <div class="col-sm-12" style="width:100%;float:left;">     
                                             <div class="form-group">
                                                  <button type="submit" class="btn btn-primary btnSubmit" id="btnSubmit">Submit</button>      
                                                  <div class="msgContactus"></div>
                                             </div>
                                        </div>

                                        <input class="txtAuth" type="hidden" name="eve_auther_id" value="<?php echo !empty($auth) ? $auth : 0; ?>"/>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- <div class="col-sm-4" style="float: left;">
                    <div class="col-sm-8 padding_0"><img style="max-width: inherit;" src="images/comeonkerala.jpg"/></div>
               </div> -->
          </div>
     </div>
</section>

<?php if ($success = $this->session->flashdata('app_success')): ?>
     <div id="note"><?php echo $success; ?></div>
<?php endif ?>

<script src="scripts/recorder.js"></script>
<script src="scripts/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/modernizr.custom.80028.js"></script>

<script>
     /*WhatsApp copy past number*/
     $(document).ready(function () {
          $('.radUseThisAsWhatsApp1').click(function () {
               $('.txtWhatsApp').val($('.txtNRINumber').val());
          });
          $('.radUseThisAsWhatsApp2').click(function () {
               $('.txtWhatsApp').val($('.txtINDNumber').val());
          });
     });
</script>
<style>
     .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
          background-color:#fff;
     }
     /* Chrome, Safari, Edge, Opera */
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
     }
     /* Firefox */
     input[type=number] {
          -moz-appearance: textfield;
     }
     .col-sm-6, col-sm-12 {
          position: inherit !important;
     }
     #note {
          position: absolute;
          z-index: 6001;
          top: 0;
          left: 0;
          right: 0;
          background: #fde073;
          text-align: center;
          line-height: 2.5;
          overflow: hidden; 
          -webkit-box-shadow: 0 0 5px black;
          -moz-box-shadow:    0 0 5px black;
          box-shadow:         0 0 5px black;
     }
     .cssanimations.csstransforms #note {
          -webkit-transform: translateY(-50px);
          -webkit-animation: slideDown 2.5s 1.0s 1 ease forwards;
          -moz-transform:    translateY(-50px);
          -moz-animation:    slideDown 2.5s 1.0s 1 ease forwards;
     }
     #close {
          position: absolute;
          right: 10px;
          top: 9px;
          text-indent: -9999px;
          background: url(images/close.png);
          height: 16px;
          width: 16px;
          cursor: pointer;
     }
     .cssanimations.csstransforms #close {
          display: none;
     }
     @-webkit-keyframes slideDown {
          0%, 100% { -webkit-transform: translateY(-50px); }
          10%, 90% { -webkit-transform: translateY(0px); }
     }
     @-moz-keyframes slideDown {
          0%, 100% { -moz-transform: translateY(-50px); }
          10%, 90% { -moz-transform: translateY(0px); }
     }
     .input-group-text {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-align: center;
          -ms-flex-align: center;
          align-items: center;
          padding: 0.375rem 0.75rem;
          margin-bottom: 0;
          font-size: 1rem;
          font-weight: 400;
          line-height: 1.5;
          color: #495057;
          text-align: center;
          white-space: nowrap;
          position: absolute;
          border-radius: 0.25rem;
          margin-top: 13px;
     }
     .input-group-append, .input-group-prepend {
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
     }
     .input-group-prepend {
          margin-right: -1px;
     }
     .btn-primary.disabled, .btn-primary.disabled.active, .btn-primary.disabled:active, 
     .btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary[disabled], 
     .btn-primary[disabled].active, .btn-primary[disabled]:active, .btn-primary[disabled]:focus, 
     .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary, fieldset[disabled] 
     .btn-primary.active, fieldset[disabled] .btn-primary:active, fieldset[disabled] 
     .btn-primary:focus, fieldset[disabled] .btn-primary:hover {
          background-color: #b2b5b8;
          border-color: #b2b5b8;
     }
     @media (max-width:390px) {
          .form-control {
               padding: 9px 9px 9px 20px;
          }
          input[type="radio"], input[type="checkbox"] {
               margin: -2px 0 0;
          }
          .form_section {
               padding: -3px 25px 10px 25px !important;
          }
          .padding_0 {
               padding-left: 0px;
               padding-right: 0px;
          }
          .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
               padding-left: 0px;
               padding-right: 0px;
          }
     }
      @media (max-width:767px) { 
          .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
               padding-left: 0px;
               padding-right: 0px;
          }
     }
</style>