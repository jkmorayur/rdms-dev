<div class="right_col" role="main">
     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                    <div class="x_title">
                         <h2>Server</h2>
                         <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table>
                            <tr>
                                <td style="padding-left: 10px;">
                                    <button data-url="<?php echo site_url('server/checkStatus'); ?>" class="btnChkSts" type="submit" class="btn btn-round btn-primary">Check status</button>
                                </td>

								<td style="padding-left: 10px;">
                                    <button data-url="<?php echo site_url(''); ?>" class="btnStartServer" type="submit" class="btn btn-round btn-primary">Server Start</button>
                                </td>
								<td class="tdMessage">

								</td>
                            </tr>
                        </table>
                    </div>
               </div>
          </div>
     </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
     $(document).ready(function () {
          $(document).on('click', '.btnChkSts', function () {
               var url = $(this).data('url');
               $.ajax({
                    type: 'post',
                    url: url,
                    dataType: 'json',
                    success: function (resp) {
                         $('.tdMessage').html(resp);
                    }
               });
          });
     });
</script>