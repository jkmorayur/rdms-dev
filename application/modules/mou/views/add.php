<div class="right_col" role="main">
     <div class="clearfix"></div>
     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                    <div class="x_title">
                         <h2>Create MOU</h2>
                         <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                         <?php echo form_open_multipart("mou/add", array('id' => "frmAccessories", 'class' => "form-horizontal form-label-left"))?>
                         <div class="row">
                              <div class="col-sm-6">
                                   <div class="panel panel-default">
                                        <div class="panel-heading">Memorandum Of Understanding</div>
                                        <div class="panel-body">
                                             <div class="form-group">
                                                  <label for="foll_contact" class="control-label col-md-3 col-sm-3 col-xs-12">Division <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <select class="select2_group form-control cmbBindShowroomByDivision" name="moum_division" id="moum_division"
                                                               data-url="<?php echo site_url('enquiry/bindShowroomByDivision');?>" data-bind="cmbShowroom" 
                                                               required data-dflt-select="Select Showroom">
                                                            <option value="">Select division</option>
                                                            <?php foreach ($division as $key => $value) {?>
                                                                   <option value="<?php echo $value['div_id'];?>"><?php echo $value['div_name'];?></option>
                                                              <?php }?>
                                                       </select>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label for="foll_contact" class="control-label col-md-3 col-sm-3 col-xs-12">Showroom <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <select required class="select2_group form-control cmbShowroom shorm_stf" name="moum_showroom" id="moum_showroom">
                                                            <option value="">Select showroom</option>
                                                       </select>
                                                  </div>
                                             </div>

                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Regn Number <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="text" class="form-control col-md-7 col-xs-12 regNumber" name="moum_reg_num" 
                                                              required id="moum_reg_num" placeholder="KL00AA0000"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle</label>
                                                  <div class="col-md-3 col-sm-7 col-xs-12">
                                                       <select data-url="<?php echo site_url('enquiry/bindModel');?>" data-bind="cmbEvModel" 
                                                               data-dflt-select="Select Model" class="cmbBrand select2_group form-control bindToDropdown" name="moum_brand" id="invv_brand">
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
                                                  </div>
                                                  <div class="col-md-3 col-sm-6 col-xs-12">
                                                       <select data-url="<?php echo site_url('enquiry/bindVarient');?>" data-bind="cmbEvVariant" data-dflt-select="Select Variant"
                                                               class="cmbEvModel select2_group form-control bindToDropdown" name="moum_model" id="invv_model">
                                                       </select>
                                                  </div>
                                                  <div class="col-md-3 col-sm-6 col-xs-12">
                                                       <select class="select2_group form-control cmbEvVariant" name="moum_varient" id="invv_varient"></select>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Place <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="text" class="form-control col-md-7 col-xs-12" name="moum_purchase_place" 
                                                              required id="moum_purchase_place" placeholder="Purchase Place"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <div class="input-group date" id="dtpMOUDate">
                                                            <input required type="text" class="form-control" name="moum_date" placeholder="Date"/>
                                                            <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="text" class="form-control col-md-7 col-xs-12" name="moum_customer_name" 
                                                              required id="moum_customer_name" placeholder="Customer Name"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Phone <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" name="moum_cust_phone" 
                                                              required id="moum_customer_name" placeholder="Customer Phone"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Email</label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="email" class="form-control col-md-7 col-xs-12" name="moum_cust_email" 
                                                              id="moum_cust_email" placeholder="Customer Email"/>
                                                  </div>
                                             </div>
                                             
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Name of father <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="text" class="form-control col-md-7 col-xs-12" name="moum_father_name" 
                                                               required id="moum_father_name" placeholder="Name Of Father"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Age <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" 
                                                               required name="moum_age" id="moum_age" placeholder="Age"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <textarea class="form-control col-md-7 col-xs-12" 
                                                                 required placeholder="Address"  name="moum_address"></textarea>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Pin <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" 
                                                              required name="moum_pin" id="moum_pin" placeholder="Pin"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <select required class="select2_group form-control" name="moum_dist" id="moum_dist">
                                                            <option value="">Select District</option>
                                                            <?php foreach ($districts as $key => $value) {?>
                                                                   <option value="<?php echo $value['std_id'];?>"><?php echo $value['std_district_name'];?></option>
                                                              <?php }?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Staff <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <select required class="select2_group form-control" name="moum_pur_staff" id="moum_pur_staff">
                                                            <option value="">Purchase Staff</option>
                                                            <?php foreach ($purchaseStaff as $key => $value) {?>
                                                                   <option value="<?php echo $value['usr_id'];?>"><?php echo $value['usr_username'] . ' - ' . $value['desig_title'];?></option>
                                                              <?php }?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Net Price <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" 
                                                              required name="moum_net_price" id="moum_net_price" placeholder="Net Price"/>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Advance Token <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" 
                                                              required name="moum_adv_token" id="moum_adv_token" placeholder="Advance Token"/>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-6">
                                   <div class="panel panel-default">
                                        <div class="panel-heading"> </div>
                                        <div class="panel-body">
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">First Party convey on <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <div class="input-group date" id="dtpConveyOn">
                                                            <input required type="text" class="form-control" name="moum_convey_on" placeholder="First Party convey on"/>
                                                            <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Agreement Days <span class="required">*</span></label>
                                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                                       <input type="number" class="form-control col-md-7 col-xs-12" name="moum_agrmnt_days" 
                                                              required id="moum_agrmnt_days" placeholder="Agreement Days"/>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-6">
                                   <div class="panel panel-default">
                                        <div class="panel-heading">ANNEXURE - I</div>
                                        <div class="panel-body">
                                             <label>A. IDENTIFICATION NUMBERS MAJOR COMPONENTS OF THE SAID VEHICLE</label>

                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Name Major Component</th>
                                                            <th>Identification Number</th>
                                                            <th>Remarks</th>
                                                            <th><span style="cursor: pointer;" class="glyphicon glyphicon-plus btnComponents"></span></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody class="tbUpgradDet">
                                                       <tr>
                                                            <td>Engine Number
                                                                 <input type="hidden" name="AA[component][]" value="1"/>
                                                            </td>
                                                            <td>
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        required name="AA[number][]" id="mou_engine_number" placeholder="Engine Number"/>
                                                            </td>
                                                            <td colspan="2">
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        required name="AA[remarks][]" id="mou_engine_number" placeholder="Remarks"/>
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                            <td>Chassis Number
                                                                 <input type="hidden" name="AA[component][]" value="2"/>
                                                            </td>
                                                            <td>
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        required name="AA[number][]" id="mou_chassis_number" placeholder="Chassis Number"/>
                                                            </td>
                                                            <td colspan="2">
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        name="AA[remarks][]" id="mou_engine_number" placeholder="Remarks"/>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>

                                             <label>B. DETAILS OF SERVICE PACKAGES, EXTENDED WARRANTY, INSURANCE POLICY NUMBER ETC.</label>

                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Particulars <i>(of service Package, Warranty policy, Insurance Policy etc.)</i></th>
                                                            <th>Identification Number</th>
                                                            <th>Remarks</th>
                                                            <th><span style="cursor: pointer;" class="glyphicon glyphicon-plus btnWarranty"></span></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody class="tbWarranty">
                                                       <tr>
                                                            <td><input class="form-control col-md-7 col-xs-12"  type="text" name="AB[component][]" 
                                                                       placeholder="Particulars"/></td>
                                                            <td>
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        placeholder="Identification Number" id="mou_engine_number" name="AB[number][]"/>
                                                            </td>
                                                            <td colspan="2">
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        placeholder="Remarks" id="mou_engine_number" name="AB[remarks][]"/>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="row">
                              <div class="col-sm-12">
                                   <div class="panel panel-default">
                                        <div class="panel-heading">ANNEXURE - II</div>
                                        <div class="panel-body">
                                             <label style="text-align: center; width: 100%;">
                                                  LIST OF COMPLAINTS / DEFECTS NOTICED IN THE SAID VEHICLE <br> & <br>
                                                  REFURBISHING WORK TO DONE TO MAKE THE SAID VEHICLE TO MAKE IT A MARKETABLE PRE-OWNED CAR
                                             </label>

                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Complaints / Defects noticed</th>
                                                            <th>Refurbish work to be done</th>
                                                            <th>Remarks</th>
                                                            <th><span style="cursor: pointer;" class="glyphicon glyphicon-plus btnRefurb"></span></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody class="tbRefurb">
                                                       <tr>
                                                            <td><input class="form-control col-md-7 col-xs-12"  type="text" name="RF[complaints][]" 
                                                                       placeholder="Complaints / Defects noticed"/></td>
                                                            <td>
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        placeholder="Refurbish work to be done" name="RF[works][]"/>
                                                            </td>
                                                            <td colspan="2">
                                                                 <input type="text" class="form-control col-md-7 col-xs-12" 
                                                                        placeholder="Remarks" name="RF[remarks][]"/>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="ln_solid"></div>
                         <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                                   <button class="btn btn-primary" type="reset">Reset</button>
                              </div>
                         </div>
                         <?php echo form_close()?>
                    </div>
               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
     $(function () {
          $('.btnRefurb').on('click', function () {
               var tmp = '<tr><td><input class="form-control col-md-7 col-xs-12"  type="text" name="RF[complaints][]" placeholder="Complaints / Defects noticed"/></td>' +
                       '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="Refurbish work to be done" name="RF[works][]"/></td>' +
                       '<td colspan="2"><input type="text" class="form-control col-md-7 col-xs-12" placeholder="Remarks" name="RF[remarks][]"/></td></tr>';
               $('.tbRefurb').append(tmp);
          });

          $('.btnWarranty').on('click', function () {
               var tmp = '<tr><td><input class="form-control col-md-7 col-xs-12"  type="text" name="AB[component][]" placeholder="Particulars"/></td>' +
                       '<td><input type="text" class="form-control col-md-7 col-xs-12" placeholder="Identification Number" id="mou_engine_number" name="AB[number][]"/></td>' +
                       '<td colspan="2"><input type="text" class="form-control col-md-7 col-xs-12" placeholder="Remarks" id="mou_engine_number" name="AB[remarks][]"/></td></tr>';
               $('.tbWarranty').append(tmp);
          });

          $('.btnComponents').on('click', function () {
               var tmp = '<tr><td>' +
                       '<select class="form-control col-md-7 col-xs-12" name="AA[component][]">' +
                       '<option value="0">Name Of Component</option>' +
<?php foreach ($identComponent as $compId => $comp) {?>
                      '<option value="<?php echo $compId;?>"><?php echo $comp;?></option>' +
  <?php }?>
               '</select></td>' +
                       '<td><input type="text" class="form-control col-md-7 col-xs-12" required name="AA[number][]" id="mou_chassis_number" placeholder="Identification Number"/></td>' +
                       '<td colspan="2"><input type="text" class="form-control col-md-7 col-xs-12" name="AA[remarks][]" id="mou_engine_number" placeholder="Remarks"/></td>' +
                       '</tr>';
               $('.tbUpgradDet').append(tmp);
          });

          $('#dtpMOUDate').datetimepicker({
               useCurrent: false,
               format: 'YYYY-MM-DD'
                       //minDate: moment('2023-03-28'),
                       //maxDate: moment('2023-04-28')
          });
          $(document).on('keypress keyup', '#dtpMOUDate', function () {
               return false;
          });

          $('#dtpConveyOn').datetimepicker({
               useCurrent: false,
               format: 'YYYY-MM-DD'
                       //minDate: moment('2023-03-28'),
                       //maxDate: moment('2023-04-28')
          });
          $(document).on('keypress keyup', '#dtpConveyOn', function () {
               return false;
          });

          $(document).on('keypress keyup blur', '.regNumber', function () {
               $(this).val($(this).val().replace(/[^A-Z0-9]/ig, '').toUpperCase());
          });
     });
</script>