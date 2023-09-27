<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
          <base href="<?php echo base_url('assets/'); ?>/"/>
          <title><?php echo $template['title'] ?></title>
          <?php echo $template['metadata'] ?>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <link rel="icon" type="image/png" id="favicon" href="images/favicon.png" />
          <meta name="author" content=""/>
          <meta name="robots" content="index, follow"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
          <!--CSS -->
          <link rel="stylesheet" type="text/css" href="styles/rd.css"/>
          <link rel="stylesheet" type="text/css" href="styles/jk-style.css"/>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     </head>
     <body class="fixed-top">
          <header class="logo-menu"> 
               <!-- Nav Menu Section -->
               <nav class="navbar-default navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
                    <!-- Nav Menu Section -->
                    <div class="container">
                         <div class="navbar navbar-inverse">
                              <div class="top_nav" style="margin: 0px;">
                                   <div>
                                        <div class="phone"><span><a href="tel:918129909090"><i class="fa fa-phone"></i>  (+91) 81299 09090</a></span></div>
                                   </div>
                              </div>
                              <div class="navbar-header">
                                   <a class="navbar-brand" href="javascript:void(0);" style="padding: 8px;">
                                        <img src="images/logo-royal-drive.svg" alt="Royal Drive"/>
                                   </a>
                              </div>
                         </div>
                    </div>
               </nav>
          </header>
          <?php echo $template['body'] ?>
          <section class="copyright">
               <div class="container">
                    <div class="row">
                         <div class="col-sm-9">
                              <ul class="list-inline">
                                   <li>Copyright @ 2022 royaldrive.in</li>
                              </ul>
                         </div>
                    </div>
               </div>
          </section>
          <script  src="scripts/jquery-3.3.1.min.js"></script>
          <script src="scripts/my.script.js" type="text/javascript"></script>
          <style>
               .phone {
                    font-size: 23px !important;
                    margin:38px;
               }
               @media (max-width: 575px) {
                    .top_nav .phone span {
                         display: block !important;
                    }
                    .top_nav .phone {
                         float: right;
                    }
                    .phone {
                         font-size: 23px;
                         margin-left: 15px;
                         margin: 35px;
                    }
               }
               @media (max-width: 767px) {
                    .top_nav {
                         width: 50%;
                    }
                    .phone {
                         margin: 33px;
                    }
               }
               @media (max-width: 490px) {
                    .phone {
                         font-size: 15px !important;
                    }
               }
          </style>
     </body>
</html>

