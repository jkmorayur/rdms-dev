
<style type="text/css">
     .header-support{
          color:#039de2;}
     #refinesearchbg{
          width:100%;}	
     .hproduct-bg{
          margin-bottom:20px;
     }
</style>

<div id="home-car-wrapper">
     <div id="home-car-inner">

          <div class="hproduct-title">
               <h1>Accessories</h1>	
          </div>

          <div class="hproduct-container">
               <?php if (!empty($accessories)) { ?>
                      <?php foreach ($accessories as $key => $value) { ?>
                           <div class="hproduct-bg">
                                <div class="hproduct-imagebg">
                                     <?php echo img(array('src' => './assets/uploads/accessories/thumb_' . $value['acc_logo'], 'alt' => $value['acc_title'])); ?>
                                </div>
                                <div class="accessories-desbg">
                                     <div class="hproduct-name">
                                          <?php echo $value['acc_title']; ?>
                                     </div>
                                     <div class="hproduct-rate">
                                          <del>&#2352;</del> <?php echo number_format($value['acc_price']); ?>
                                     </div>  
                                </div>
                           </div>
                      <?php } ?>
                 <?php } ?>
          </div>
          <div style="clear:both"></div>
     </div>
</div>