<div class="right_col" role="main">
     <div class="clearfix"></div>
     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                    <div class="x_title">
                         <h2>Stock issue</h2>
                         <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                         <?php echo form_open_multipart("fixedassets/issueAssets", array('id' => "frmPermission", 'class' => "form-horizontal form-label-left")) ?>
                         <div class="form-group">
                              <label for="usr_showroom" class="control-label col-md-3 col-sm-3 col-xs-12">All staff</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?php if (!empty($users)) { ?>
                                        <select required name="usr_id" class="select2_group form-control cmbSearchList">
                                             <option value="">Select user</option>
                                             <?php
                                             foreach ($users as $key => $value) {
                                                  $users = $this->fixedassets->getUsers($value['desig_id']);
                                                  if (!empty($users)) {
                                             ?>
                                                       <optgroup label="<?php echo $value['desig_title']; ?>">
                                                            <?php foreach ($users as $ukey => $usr) { ?>
                                                                 <option value="<?php echo $usr['usr_id']; ?>"><?php echo $usr['usr_first_name'] . ' / ' . $usr['group_name'] . ' / ' . $usr['shr_location']; ?></option>
                                                            <?php } ?>
                                                       </optgroup>
                                             <?php
                                                  }
                                             }
                                             ?>
                                        </select>
                                   <?php } ?>
                              </div>
                         </div>
                         <div class="form-group">
                              <label for="usr_showroom" class="control-label col-md-3 col-sm-3 col-xs-12">Issue on</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input required type="text" class="dtpDMY select2_group form-control" name="fai_issue_date" />
                              </div>
                         </div>

                         <div class="form-group">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                   <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                  <th></th>
                                                  <th>Asset No</th>
                                                  <th>Name</th>
                                                  <th>Category</th>
                                                  <th>Company</th>
                                                  <th>Serial No</th>
                                                  <th>Warranty</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             if (!empty($assets)) {
                                                  foreach ($assets as $key => $value) {
                                             ?>
                                                       <tr>
                                                            <td><input type="checkbox" name="asset[<?php echo $value['fap_id']; ?>]" value="1"></td>
                                                            <td><?php echo $value['fap_number']; ?></td>
                                                            <td><?php echo $value['fap_name']; ?></td>
                                                            <td><?php echo $value['fac_title']; ?></td>
                                                            <td><?php echo $value['facm_title']; ?></td>
                                                            <td><?php echo $value['fap_slno']; ?></td>
                                                            <td><?php echo $value['fap_warty_till']; ?></td>
                                                       </tr>
                                             <?php
                                                  }
                                             }
                                             ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                         <div class="ln_solid"></div>
                         <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </div>
                         <?php form_close(); ?>
                    </div>
               </div>
          </div>
     </div>
</div>