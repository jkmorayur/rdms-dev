
<?php
  if (!empty($reports)) {
       foreach ($reports as $key => $report) {
            //$count = $this->reports->getPurchaseCount($enquery['veh_varient'], $enquery['veh_year'], $date_filter, $formFilter);
          
            ?>
          <tr class="bdy singleline" data-url="<?php echo site_url('reports_1/enquiry_pool/' . encryptor($report['val_veh_no']) . '/' . encryptor($report['val_veh_no']));?>">
                 <td class="details-control trVOE"><?php echo $key + 1;?></td>
                 <td class="details-control trVOE"><?php echo $report['shr_location'];?></td>
                 <td style="width:21%" class="details-control trVOE"><?php echo date('d-m-Y', strtotime($report['val_purchased_date']));?></td>
                 <td class="details-control trVOE">
                      <?php
                      $purchased_date = date('Y-m-d', strtotime($report['val_purchased_date']));
                      $startDate = new DateTime($purchased_date);
                      $tdy=date('Y-m-d');
                      $endDate = new DateTime($tdy);
                     // $endDate = new DateTime("2021-10-06");
                      $difference = $endDate->diff($startDate);
                      echo $difference->format("%a");
                      $interval = $startDate->diff($endDate);
//echo $interval->d;
                      ?>

                 </td>
                 <td class="details-control trVOE"><?php echo $interval->m?></td>
                 <td class="details-control trVOE"><?php //echo unserialize(MODE_OF_CONTACT)[$report['val_cust_source']]
                                   echo $report['val_type']==1?'Purchase':($report['val_type']==3?'Park and sale':($report['val_type']==4?'Park and sale':($report['val_type']==5?'Exchange':'')));
                   ?></td>
                 <td><?php echo $report['sales_staff'];?></td>
                 <td><?php echo $report['val_cust_name'];?></td>
                 <td><?php echo unserialize(REFERAL_TYPES)[$report['enq_ref_type']]?></td>
                 <td><?php 
                 if($report['enq_ref_type']==4){
                    $staff = $this->enquiry->getStaffNameById($report['enq_ref_name']);
                    echo $staff['usr_first_name'];
                 }else{
                  echo $report['enq_ref_name'];
                 }
                
                 
                // echo $report['enq_ref_name'];
                ?></td>
                 <td style="width:7%" class="details-control trVOE"><?php echo $report['val_veh_no'];?></td>
                 <td class="details-control trVOE"><?php echo $report['brd_title'];?></td>
                 <td class="details-control trVOE"><?php echo $report['mod_title'];?></td>
                 <td  style="width:21%" class="details-control trVOE"><?php echo $report['var_variant_name'];?></td>
                 <td class="details-control trVOE"><?php echo $report['val_model_year'];?></td>
                 <td class="details-control trVOE"><?php echo $report['val_km'];?></td>
                 <td class="details-control trVOE"><?php echo $report['status'];?></td>
                 <td class="details-control trVOE"><?php echo $report['val_next_serv_km'];?></td>
                 
                 <td  style="width:19%" class="details-control trVOE">
                     
                      <?php
                      $rf_d=array();
                      unset($rf_d);

                      $refurb_data = $this->reports->getRefurbByValId($report['val_id']);
                      foreach ($refurb_data as $key => $value) {

                           $rf_d[] = $value->comp_complaint;
                      }
                      $List = implode('&nbsp<b><font color="black">,</font></b>&nbsp', $rf_d);
                      echo $List;
                                 ?>
                 </td>
                 <td class="details-control trVOE"><?php echo $report['val_refurb_remark'];?></td>
                   <td> Delivery Date </td>
            </tr>
            <?php
       }
  }
?>

<script>
     $(document).ready(function () {
          $("#rowClick .bdy").click(function (e) {
               window.open($(this).data("url"), '_blank');
          });
     });
</script>

