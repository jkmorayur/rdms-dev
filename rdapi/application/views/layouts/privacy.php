<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
          <base href="<?php echo base_url('assets/');?>/"/>
          <title><?php echo $template['title']?></title>
          <?php echo $template['metadata']?>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <link rel="icon" type="image/png" id="favicon" href="images/favicon.png" />
          <meta name="author" content=""/>
          <meta name="robots" content="index, follow"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
          <!--CSS -->
          <link rel="stylesheet" type="text/css" href="styles/rd.css"/>
          <link rel="stylesheet" type="text/css" href="styles/jk-style.css"/>
     </head>
     <body class="fixed-top">
          <?php echo $template['body']?>
     </body>
</html>