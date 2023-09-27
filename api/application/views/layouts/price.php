

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--  <script src="https://www.royaldrive.in/rdportal/vendors/jquery/dist/jquery.min.jsk"></script>
  <script src="https://www.royaldrive.in/rdportal/vendors/datatables.net/js/jquery.dataTables.min.jsk"></script>-->
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>  
   <script>
               var site_url = "<?php echo site_url();?>";
               var none_image = "<?php echo $this->config->item('none_image');?>";
          </script>
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#" class="w3-bar-item w3-button"><b>PRICE</b> List</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="<?php echo site_url('/');?>" class="w3-bar-item w3-button">Home</a>
      
    </div>
  </div>
</div>
  <body>
        
        
          <?php echo $template['body']?>
         
     </body>
<body>



</body>
</html>
