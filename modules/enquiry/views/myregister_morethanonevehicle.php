<div class="right_col" role="main">     
     <div class="row">          
          <div class="col-md-12 col-sm-12 col-xs-12">               
               <div class="x_panel">                    
                    <div class="x_title">
                         <h2>My register</h2>
                         <div style="float: right;">                              
                              <a href="<?php echo site_url($controller . '/myregister?type=ex');?>">
                                   <i class="fa fa-circle" style="color: #003580;"> Existing </i>
                              </a>                              
                              <a href="<?php echo site_url($controller . '/myregister?type=nw');?>">
                                   <i class="fa fa-circle" style="color: red;"> New </i>
                              </a>                              
                              <a href="<?php echo site_url($controller . '/myregister');?>">
                                   <i class="fa fa-circle" style="color: black;"> All </i>
                              </a>
                         </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                         <form method="get">
                              <table>
                                   <tr>
                                        <td>
                                             <input autocomplete="off" name="search" type="text" class="form-control col-md-7 col-xs-12" 
                                                    placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>"/>
                                        </td>
                                        <td style="padding-left: 10px;">
                                             <button type="submit" class="btn btn-round btn-primary">Search</button>
                                        </td>
                                   </tr>
                              </table>
                         </form>
                    </div>
                    <!-- -->
                    <?php if (check_permission('enquiry', 'myregistercallanalysis')) {?>
                           <div class="x_content">
                                <table class="table table-striped table-bordered">
                                     <tbody>
                                          <?php
                                          if (!empty($tc)) {
                                               foreach ($tc as $key => $value) {
                                                    $mod = unserialize(MODE_OF_CONTACT);
                                                    ?>
                                                    <tr>
                                                         <td>
                                                              <?php echo $value['col_title'];?>
                                                         </td>
                                                         <td class="bold-text">
                                                              <?php foreach ($value['analysis'] as $k => $val) {
                                                                   ?> <span><?php echo $mod[$val['vreg_contact_mode']];?></span> : 
                                                                   <span><?php echo $val['cnt'];?></span> <?php
                                                              }
                                                              ?>
                                                         </td>
                                                    </tr>
                                                    <?php
                                               }
                                          }
                                          ?>
                                     </tbody>
                                </table>
                           </div>
                      <?php }?>
                    <div class="x_content">
                         <?php
                           $currentURL = current_url();
                           $params = $_SERVER['QUERY_STRING'];
                           $fullURL = $currentURL . '?' . $params;
                         ?>
                         <form action="<?php echo $fullURL;?>" method="get">
                              <input type="hidden" name="type" value="<?php echo isset($_GET['type']) ? $_GET['type'] : '';?>"/>
                              <table>
                                   <tr>
                                        <td>
                                             <select class="select2_group form-control" name="vreg_department">
                                                  <option value="">Select Departments</option>
                                                  <?php
                                                    foreach ($departments as $key => $value) {
                                                         $selected = (isset($_GET['vreg_department']) && ($_GET['vreg_department'] == $value['dep_id'])) ? 'selected="selected"' : '';
                                                         ?>
                                                         <option <?php echo $selected;?>
                                                              value="<?php echo $value['dep_id'];?>"><?php echo $value['dep_name'] . ' (' . $value['div_name'] . ')';?></option>
                                                         <?php }?>
                                             </select>
                                        </td>
                                        <td>
                                             <select class="select2_group form-control" name="vreg_call_type">
                                                  <option value="">Select Lead type</option>
                                                  <?php
                                                    foreach (unserialize(CALL_TYPE) as $key => $value) {
                                                         $selected = (isset($_GET['vreg_call_type']) && ($_GET['vreg_call_type'] == $key)) ? 'selected="selected"' : '';
                                                         ?>
                                                         <option <?php echo $selected;?> value="<?php echo $key;?>"><?php echo $value;?></option><?php
                                                    }
                                                  ?>
                                             </select>
                                        </td>
                                        <td>
                                             <select class="select2_group form-control" name="vreg_contact_mode">
                                                  <option value="">Mode of contact</option>
                                                  <?php
                                                    foreach (unserialize(MODE_OF_CONTACT) as $key => $value) {
                                                         $selected = (isset($_GET['vreg_contact_mode']) && ($_GET['vreg_contact_mode'] == $key)) ?
                                                                 'selected="selected"' : '';
                                                         ?>
                                                         <option <?php echo $selected;?> value="<?php echo $key;?>"><?php echo $value;?></option><?php
                                                    }
                                                  ?>
                                             </select>
                                        </td>
                                        <td>
                                             <input autocomplete="off" name="enq_date_from" type="text" class="dtpDatePickerDMY form-control col-md-7 col-xs-12" 
                                                    placeholder="Date from" value="<?php echo isset($_GET['type']) ? $_GET['type'] : '';?>"/>
                                        </td>
                                        <td style="padding-left: 10px;">
                                             <input autocomplete="off" name="enq_date_to" type="text" class="dtpDatePickerDMY form-control col-md-7 col-xs-12" 
                                                    placeholder="Date to" value="<?php echo isset($_GET['type']) ? $_GET['type'] : '';?>"/>
                                        </td>
                                        <td style="padding-left: 10px;">
                                             <button type="submit" class="btn btn-round btn-primary">Filter</button>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <select data-url="<?php echo site_url('enquiry/bindModel');?>" data-bind="cmbEvModel" 
                                                     data-dflt-select="Select Model" class="cmbBrand select2_group form-control bindToDropdown" name="vreg_brand" id="vreg_brand">
                                                  <option value="">Select Brand</option>
                                                  <?php
                                                    if (!empty($brand)) {
                                                         foreach ($brand as $key => $value) {
                                                              ?>
                                                              <option value="<?php echo $value['brd_id'];?>"><?php echo $value['brd_title'];?></option>
                                                              <?php
                                                         }
                                                    }
                                                  ?>
                                             </select>
                                        </td>
                                        <td>
                                             <select data-url="<?php echo site_url('enquiry/bindVarient');?>" data-bind="cmbEvVariant" data-dflt-select="Select Variant"
                                                     class="cmbEvModel select2_group form-control bindToDropdown" name="vreg_model" id="vreg_model">
                                             </select>
                                        </td>
                                        <td>
                                             <select class="select2_group form-control cmbEvVariant" name="vreg_varient" id="vreg_varient"></select>
                                        </td>
                                   </tr>
                              </table>
                         </form>
                    </div>
                    <!-- -->
                    <div class="x_content">
                         <div style="width: 100%;overflow-x: scroll;">
                              <table class="table table-striped table-bordered">                              
                                   <thead>
                                        <tr>
                                             <th>Entry date</th>
                                             <th>Customer name</th>
                                             <th>Contact</th>
                                             <th>Place</th>
                                             <th>Contact mode</th>
                                             <th>Event</th>
                                             <th>Brand</th>
                                             <th>Model</th>
                                             <th>Variant</th>
                                             <th>Year</th>
                                             <th>Investment</th>
                                             <th>Added on</th>
                                             <th>Status</th>
                                             <th>Call type</th>
                                             <?php if (check_permission('registration', 'showassignto')) {?>        
                                                    <th>Assigned to</th>
                                               <?php }?>
                                             <th>Added by</th>
                                             <?php if (check_permission('registration', 'candelete')) {?>        
                                                    <th>Delete</th>
                                               <?php } if (check_permission('registration', 'alloworeassign')) {?>
                                                    <th>Punch</th>
                                               <?php }?>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                          $colspan = 16;
                                          if (!empty($datas)) {
                                               foreach ((array) $datas as $key => $value) {
                                                    $regHistory = $this->registration->reghistory($value['vreg_id']);
                                                    $regFollowups = $this->enquiry->regFollowups($value['vreg_id']);
                                                    $url = '';
                                                    if ($value['vreg_is_verified']) {
                                                         $url = !empty($value['vreg_inquiry']) ?
                                                                 site_url('followup/viewFollowup/' . encryptor($value['vreg_inquiry'])) : site_url($controller . '/regiter_2_inquiry/' . encryptor($value['vreg_id']));
                                                    }
                                                    $color = 'color: #fff';
                                                    $bgColor = '';
                                                    $canPunch = 1;
                                                    if (empty($value['vreg_inquiry'])) {
                                                         $bgColor = 'red';
                                                    } else if ($value['vreg_is_verified'] != 1) {
                                                         $bgColor = '#4c3000';
                                                         $canPunch = 0;
                                                    } else {
                                                         $bgColor = '#004099';
                                                    }
                                                    ?>
                                                    <tr style="<?php echo $color;?>;background-color: <?php echo $bgColor;?>">
                                                         <td style="wid"><?php echo date('j M Y', strtotime($value['vreg_entry_date']));?></td>
                                                         <td><?php echo $value['vreg_cust_name'];?></td>
                                                         <td><a style="color: #fff;" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $value['vreg_cust_phone'];?>"><?php echo $value['vreg_cust_phone'];?></a></td>
                                                         <td><?php echo $value['vreg_cust_place'];?></td>
                                                         <td>
                                                              <?php
                                                              $modes = unserialize(MODE_OF_CONTACT);
                                                              echo isset($modes[$value['vreg_contact_mode']]) ? $modes[$value['vreg_contact_mode']] : '';
                                                              ?>                                               
                                                         </td>
                                                         <td><?php echo $value['evnt_title'];?></td>
                                                         <td><?php echo $value['brd_title'];?></td>
                                                         <td><?php echo $value['mod_title'];?></td>
                                                         <td><?php echo $value['var_variant_name'];?></td>
                                                         <td><?php echo $value['vreg_year'];?></td>
                                                         <td><?php echo $value['vreg_investment'];?></td>
                                                         <td><?php echo date('j M Y', strtotime($value['vreg_added_on']));?></td>
                                                         <td><?php echo ($value['vreg_is_verified'] == 1) ? 'Verified' : 'Pending';?></td>
                                                         <td>
                                                              <?php
                                                              $callTypes = unserialize(CALL_TYPE);
                                                              echo isset($callTypes[$value['vreg_call_type']]) ? $callTypes[$value['vreg_call_type']] : '';
                                                              ?>
                                                         </td>
                                                         <?php if (check_permission('registration', 'showassignto')) {?>        
                                                              <td><?php echo $value['assign_usr_first_name'];?></td>
                                                         <?php }?>
                                                         <td><?php echo $value['addedby_usr_first_name'];?></td>
                                                         <?php
                                                         if (check_permission('registration', 'candelete')) {
                                                              $colspan = $colspan + 1;
                                                              ?>    
                                                              <td>
                                                                   <a class="pencile deleteListItem" href="javascript:void(0);" data-url="<?php echo site_url('registration/delete/' . $value['vreg_id']);?>">  
                                                                        <i class="fa fa-remove"></i>
                                                                   </a>
                                                              </td>
                                                         <?php }?>
                                                         <td>
                                                              <?php if (check_permission('registration', 'alloworeassign') && ($canPunch == 1)) {?>
                                                                   <div onclick="$('#<?php echo $value['vreg_id'];?>').modal({backdrop: false});"><i class="fa fa-pencil-square" data-toggle="modal" data-target="#<?php //echo $value['vreg_id'];?>"></i></div>
                                                                   <div class="modal fade divModel" id="<?php echo $value['vreg_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document" style="width: 100%;">
                                                                             <div class="modal-content" style="color: black;">
                                                                                  <div class="modal-header">
                                                                                       <h5 style="width: 66px;float: left;" class="modal-title" id="exampleModalLabel">Punch register</h5>
                                                                                       <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                       </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                       <div class="container">
                                                                                            <div class="row">
                                                                                                 <div class="col-sm">
                                                                                                      <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                                           <div class="x_panel">
                                                                                                                <div class="x_content">
                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer name</label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <?php echo $value['vreg_cust_name'];?>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer contact</label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <a style="color: #000;" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $value['vreg_cust_phone'];?>"><?php echo $value['vreg_cust_phone'];?></a>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <?php echo $value['vreg_cust_place'];?>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;white-space: normal;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer feedback</label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <?php echo $value['vreg_customer_remark'];?>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Assigned by</label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <?php echo $value['addedby_usr_first_name'] . ' ' . $value['addedby_usr_last_name'];?>
                                                                                                                          </div>
                                                                                                                     </div>
                                                                                                                     <?php if ($value['ccb_callStatus_id'] == VB_CONNECTED) {?>
                                                                                                                          <div class="form-group" style="width: 100%;float: left;">
                                                                                                                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Call record</label>
                                                                                                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                                    <audio controls><source src="<?php echo 'http://pbx.voxbaysolutions.com/callrecordings/' . $value['ccb_recording_URL'];?>"/></audio>
                                                                                                                               </div>
                                                                                                                          </div>
                                                                                                                     <?php }?>
                                                                                                                </div>
                                                                                                                <div style="width: 100%;overflow-x: scroll;">
                                                                                                                     <table class="table table-striped table-bordered">
                                                                                                                          <thead>
                                                                                                                               <tr>
                                                                                                                                    <th>Date</th>
                                                                                                                                    <th>Assigned By</th>
                                                                                                                                    <th>Assigned To</th>
                                                                                                                                    <th>Comments</th>
                                                                                                                                    <th>Remarks</th>
                                                                                                                               </tr>
                                                                                                                          </thead>
                                                                                                                          <tbody>
                                                                                                                               <?php
                                                                                                                               foreach ($regHistory as $hkey => $hvalue) {
                                                                                                                                    ?>
                                                                                                                                    <tr>
                                                                                                                                         <td><?php echo date('j M Y h:i', strtotime($hvalue['regh_added_date']));?></td>
                                                                                                                                         <td><?php echo $hvalue['addedby_usr_first_name'] . ' ' . $hvalue['addedby_usr_last_name'];?></td>
                                                                                                                                         <td><?php echo $hvalue['assign_usr_first_name'] . ' ' . $hvalue['assign_usr_last_name'];?></td>
                                                                                                                                         <td><?php echo $hvalue['regh_remarks'];?></td>
                                                                                                                                         <td><?php echo $hvalue['regh_system_cmd'];?></td>
                                                                                                                                    </tr>
                                                                                                                               <?php }?>
                                                                                                                          </tbody>
                                                                                                                     </table>
                                                                                                                </div>
                                                                                                                <div class="row" style="text-align: center;">
                                                                                                                     <div>
                                                                                                                          <?php $txtPunch = !empty($value['vreg_inquiry']) ? 'Followup' : 'Punch to enquiry';?>
                                                                                                                          <a class="btn btn-primary" href="<?php echo $url;?>"><?php echo $txtPunch;?></a><br>
                                                                                                                     </div>
                                                                                                                </div>
                                                                                                           </div>
                                                                                                      </div>
                                                                                                 </div>
                                                                                                 <div class="col-sm">
                                                                                                      <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                                           <div class="x_panel">
                                                                                                                <!-- -->
                                                                                                                <?php if (!empty($regFollowups)) {?>
                                                                                                                     <div style="height: 150px;overflow-x: hidden;overflow-y: scroll;">
                                                                                                                          <?php foreach ($regFollowups as $fkey => $fvalue) {?>
                                                                                                                               <div style="float: left;width: 100%; font-style: italic;background: #E7E7E7;padding: 10px;border-radius: 10px;margin-bottom: 10px;">
                                                                                                                                    <p class="excerpt">Remarks : <?php echo isset($fvalue['regf_desc']) ? $fvalue['regf_desc'] : '';?></p>
                                                                                                                                    <p class="excerpt">Followup date : <?php echo isset($fvalue['regf_next_folowup']) ? date('d-m-Y h:i A', strtotime($fvalue['regf_next_folowup'])) : '';?></p>
                                                                                                                                    <p class="excerpt" style="float: right;">Added on : <?php echo isset($fvalue['regf_added_on']) ? $fvalue['regf_added_on'] : '';?></p>
                                                                                                                               </div>
                                                                                                                          <?php }?>
                                                                                                                     </div>
                                                                                                                <?php }?>
                                                                                                                <!-- -->
                                                                                                                <form class="x_content frmRegisterFollowup" method="post" action="<?php echo site_url($controller . '/setRegisterFollowup');?>">
                                                                                                                     <input type="hidden" name="vreg_assigned_to" value="<?php echo $value['vreg_assigned_to'];?>"/>
                                                                                                                     <input type="hidden" name="vreg_added_by" value="<?php echo $value['vreg_added_by'];?>"/>
                                                                                                                     <input type="hidden" name="regfoll[regf_reg_id]" value="<?php echo $value['vreg_id'];?>"/>
                                                                                                                     <input type="hidden" name="regfoll[regf_added_by]" value="<?php echo $this->uid;?>"/>
                                                                                                                     <input type="hidden" name="regfoll[regf_added_on]" value="<?php echo date('Y-m-d H:i:s');?>"/>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Call type <span class="required">*</span></label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <select required class="select2_group form-control cmbContactMode" name="regfoll[regf_reson]" id="vreg_contact_mode">
                                                                                                                                    <option value="">Call type</option>
                                                                                                                                    <?php
                                                                                                                                    foreach (unserialize(CALL_TYPE) as $tkey => $tvalue) {
                                                                                                                                         ?>
                                                                                                                                         <option value="<?php echo $tkey;?>"><?php echo $tvalue;?></option>
                                                                                                                                         <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                               </select>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Followup <span class="required">*</span></label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <textarea required name="regfoll[regf_desc]" class="form-control col-md-5 col-xs-12"></textarea>
                                                                                                                          </div>
                                                                                                                     </div>

                                                                                                                     <div class="form-group" style="width: 100%;float: left;">
                                                                                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Next followup date <span class="required">*</span></label>
                                                                                                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                               <input type="text" name="regfoll[regf_next_folowup]" class="form-control col-md-5 col-xs-12 dtpDateTimePicker" 
                                                                                                                                      required value="<?php echo date('Y-m-d H:i:s');?>"/>
                                                                                                                          </div>
                                                                                                                     </div>
                                                                                                                     <div class="form-group" style="width: 100%;float: left;text-align: center;">
                                                                                                                          <div>
                                                                                                                               <button class="btn btn-primary btnSubmitRegFollowup" type="submit">Set followup</button>
                                                                                                                          </div>
                                                                                                                     </div>
                                                                                                                </form>
                                                                                                           </div>
                                                                                                      </div>
                                                                                                 </div>
                                                                                            </div>

                                                                                            <div class="row" style="text-align: center;font-weight: bolder;font-size: 25px;">OR</div>
                                                                                            <form method="post" class="row" action="<?php echo site_url($controller . '/sendBackRegister');?>">
                                                                                                 <input type="hidden" name="assignedTo" value="<?php echo $value['vreg_added_by']?>"/>
                                                                                                 <input type="hidden" name="assignedFrom" value="<?php echo $value['vreg_assigned_to']?>"/>
                                                                                                 <input type="hidden" name="regMaster" value="<?php echo $value['vreg_id']?>"/>

                                                                                                 <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                                      <div class="x_panel">
                                                                                                           <div class="form-group">
                                                                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Call type <span class="required">*</span></label>
                                                                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                     <select required class="select2_group form-control cmbContactMode" name="call_type" id="vreg_contact_mode">
                                                                                                                          <option value="">Call type</option>
                                                                                                                          <?php
                                                                                                                          foreach (unserialize(CALL_TYPE) as $key => $value) {
                                                                                                                               ?>
                                                                                                                               <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                                                                                                               <?php
                                                                                                                          }
                                                                                                                          ?>
                                                                                                                     </select>
                                                                                                                </div>
                                                                                                           </div>
                                                                                                      </div>
                                                                                                 </div>
                                                                                                 <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                                      <div class="x_panel">
                                                                                                           <div class="form-group">
                                                                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Reason for send back <span class="required">*</span>
                                                                                                                </label>
                                                                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                                     <textarea required name="reason" class="form-control col-md-5 col-xs-12 "></textarea>
                                                                                                                </div>
                                                                                                           </div>
                                                                                                      </div>
                                                                                                 </div>
                                                                                                 <div class="modal-footer" style="float: left;width: 100%;text-align: center;">
                                                                                                      <button type="submit" class="btn btn-primary">Reassign to telecaller</button>
                                                                                                 </div>
                                                                                            </form>
                                                                                       </div>
                                                                                  </div>
                                                                             </div>
                                                                        </div>
                                                                   </div>
                                                              <?php }?>
                                                         </td>
                                                    </tr>
                                                    <?php
                                               }
                                          } else {
                                               ?> 
                                               <tr>
                                                    <td style="text-align: center;" colspan="<?php echo $colspan;?>">No data available in table</td>
                                               </tr>
                                          <?php }?>
                                   </tbody>                         
                              </table>                         

                         </div>
                         <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing <?php echo $pageIndex;?> to <?php echo $limit;?> of <?php echo $totalRow;?> entries</div>                         
                         <div style="float: right;">                              
                              <?php echo $links;?>                         
                         </div>
                    </div>               
               </div>          
          </div>     
     </div>
</div>

<style>
     .table>thead>tr>th {
          white-space: nowrap;
          width: 1%;
     }
     .table>tbody>tr>td {
          white-space: nowrap;
          width: 1%;
     }
</style>