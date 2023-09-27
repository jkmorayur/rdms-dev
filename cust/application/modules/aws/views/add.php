<div class="right_col" role="main">
     <div class="clearfix"></div>
     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                    <div class="x_title">
                         <h2>New Blog</h2>
                         <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                         <?php echo form_open_multipart("aws/add", array('id' => "frmNewsEvents", 'class' => "form-horizontal"))?>
                         <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                   <div id="newupload">
                                        <input type="hidden" id="x10" name="x1[]" />
                                        <input type="hidden" id="y10" name="y1[]" />
                                        <input type="hidden" id="x20" name="x2[]" />
                                        <input type="hidden" id="y20" name="y2[]" />
                                        <input type="hidden" id="w0" name="w[]" />
                                        <input type="hidden" id="h0" name="h[]" />
                                        <input type="file" class="form-control col-md-7 col-xs-12" style="display: table;margin-bottom: 10px;" 
                                               name="image[]" id="image_file0" onchange="fileSelectHandler('0', '870', '340',  true)" />
                                        <img id="preview0" class="preview"/>
                                   </div>
                                   <span class="help-inline">You can crop image</span>
                              </div>
                         </div>

                         <!-- Technical details -->
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