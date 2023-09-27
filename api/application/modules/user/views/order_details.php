<?php
  //debug($order, 0);
  //debug($product_info);
?>

<div id="sectionb_wrapper">
     <div id="sectionb_inner">
          <div id="inner_breadcombmenu">
               <ul>
                    <li><a href="<?php echo site_url(); ?>"> Home &raquo; </a></li>
                    <li><a href="<?php echo site_url('user/myaccount'); ?>"> My Account  &raquo; </a></li>
                    <li><a href="javascript:void(0);" style="color:#d92523;">Order Details </a></li>
               </ul>
          </div><!--inner_breadcombmenu-->
          <h1>Order Details  </h1>
          <div style="clear:both"></div>
     </div><!--sectionb_inner-->
</div><!--sectionb_wrapper-->

<!--INNER-->
<div id="contentmatter_wrapper">
     <div id="orderdetail_inner">
          <div style="float:left;width:100%;"> 
               <div class="dialog_dateand_id">PURCHASE DATE :  <?php echo date('Y-m-d', strtotime($order['ord_date'])); ?></div> 
               <div class="dialog_dateand_id" style="text-align:right;">ORDER ID:  <?php echo $order['ord_id']; ?></div>
          </div>
          <div class="accinfo_informationbg orderlleft">
               <div class="myaccound_caption">Billing Address</div>
               <div class="loginfield accinfomar">
                    <h2>Name :	<?php echo $billing_address['first_name'] . ' ' . $billing_address['last_name']; ?></h2>
                    <h5>Email:	<?php echo $billing_address['email']; ?></h5>
                    <h2>Street Adress:	<?php echo $billing_address['address']; ?></h2>
                    <h5>Phone	:<?php echo $billing_address['phone']; ?></h5>
                    <h2>Country	:<?php echo $billing_address['ctr_country']; ?></h2>
               </div>
          </div><!--accinfo_informationbg-->

          <div class="accinfo_informationbg orderlright" >
               <div class="myaccound_caption">Shipping Address</div>
               <div class="loginfield accinfomar">
                    <h2>Name :	<?php echo $shipping_address['first_name'] . ' ' . $shipping_address['last_name']; ?></h2>
                    <h5>Email:	<?php echo $shipping_address['email']; ?></h5>
                    <h2>Street Adress:	<?php echo $shipping_address['address']; ?></h2>
                    <h5>Phone	:<?php echo $shipping_address['phone']; ?></h5>
                    <h2>Country	:<?php echo $shipping_address['ctr_country']; ?></h2>
               </div>
          </div><!--accinfo_informationbg-->

          <div style="float:left;width:100%;"> 
               <div class="dialog_dateand_id">Product Details</div> 
          </div>
          <div id="cart_inner">
               <div class="innercarttittlebg">
                    <div class="cart_name">PEODUCTS </div> 
                    <div class="cart_price">BRAND </div> 
                    <div class="cart_total">&nbsp;</div>      
                    <div class="cart_qty">QTY </div>
                    <div class="cart_edit"></div>
               </div><!--innercarttittlebg-->
               <div class="innercarwhitebg">
                    <?php if (!empty($product_info)) { ?>
                           <?php foreach ($product_info as $key => $value) { ?>
                                <div class="innercarwhitborder">
                                     <div class="cartitem_name">
                                          <div class="cart_imagebg">
                                               <?php
                                                    $img = isset($value['product_images'][0]['pdi_image']) ?
                                                            $value['product_images'][0]['pdi_image'] : '';

                                                    echo img(array('src' => ADMIN_FOLDER . '/assets/uploads/product/' .
                                                        $img, 'id' => 'imgBrandImage'));
                                                    ?>
                                          </div>
                                          <div class="namewrapper">
                                               <span><?php echo $value['prd_name']; ?></span><br>
                                               Part No : <?php echo $value['prd_part_number']; ?><br>
                                          </div>
                                     </div> <!--cartitem_name-->

                                     <div class="cartitem_price"><small>BRAND</small> 
                                          <?php echo img(array('src' => ADMIN_FOLDER . '/assets/uploads/brand/' . $value['brd_logo'], 'id' => 'imgBrandImage')); ?>
                                     </div>
                                     <div class="cartitem_total"><small> TOTAL </small> </div>      
                                     <div class="cartitem_qty"><small>QTY</small>
                                          <?php echo $value['orp_qty']; ?>
                                     </div>

                                     <div class="cartitem_edit">
                                          <!--<small>TOTAL </small>-->
                                     </div> 
                                     <div style="clear:both"></div>
                                </div>
                           <?php } ?>
                      <?php } ?>
               </div><!--innercarwhitebg-->
               <div class="innercargrandtotalbg">
                    &nbsp;&nbsp; 
               </div><!--innercargrandtotalbg-->
          </div><!--cart_inner-->
          <div style="clear:both"></div>
     </div><!--orderdetail_inner-->
</div><!--contentmatter_wrapper-->