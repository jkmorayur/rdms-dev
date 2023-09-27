<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
          <base href="<?php echo base_url('assets/');?>/"/>
          <title><?php echo $template['title'] . STATIC_TITLE?></title>
          <?php echo $template['metadata']?>
          
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <link rel="icon" type="image/png" id="favicon" href="https://www.royaldrive.in/assets/images/favicon.png" />
          <meta name="author" content=""/>
          <meta name="robots" content="index, follow"/>
          <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> -->
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
          <!--CSS -->
          <link rel="stylesheet" type="text/css" href="styles/rd-min.css"/>
          <link rel="stylesheet" type="text/css" href="styles/jk-style-min.css"/>
          <!--Icon Fonts-->
          <link rel="stylesheet" media="screen" href="styles/font-awesome.min.css"/>
          <!-- Extras -->
          <link rel="stylesheet" type="text/css" href="styles/animate.css"/>

          <!-- Blog Og Tags -->
          <?php
            if ($controller == 'blog' && $method == 'index' && (isset($_GET['ci']) && !empty($_GET['ci']))) {
                 $id = encryptor($_GET['ci'], 'D');
                 $blogog = $this->blog->getBlog($id);
                 $img = isset($blogog['images'][0]['bimg_image']) ? $blogog['images'][0]['bimg_image'] : '';
                 ?>
                 <meta property="og:url"           content="<?php echo site_url() . 'blog/' . $blogog['blog_slug'] . '?ci=' . $_GET['ci'];?>" />
                 <meta property="og:type"          content="website" />
                 <meta property="og:title"         content="<?php echo $blogog['blog_title'];?>" />
                 <meta property="og:description"   content="<?php echo strip_tags($blogog['blog_desc']); ?>" />
                 <meta property="og:image"         content="<?php echo site_url() . 'assets/uploads/blog/' . $img;?>" />
            <?php }?>
          <!-- Blog Og Tags -->
          <?php //echo $blogog['blog_title'];?>
          <?php //echo strip_tags($blogog['blog_desc']); ?>
          <script>
               var site_url = "<?php echo site_url();?>";
               var none_image = "<?php echo $this->config->item('none_image');?>";
          </script>
          <!-- Global site tag (gtag.js) - Google Analytics -->
<!--          <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111086231-2"></script>
          <script>
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());

               gtag('config', 'UA-111086231-2');
          </script>-->
          <script src="scripts/jquery-3.3.1.min.js"></script>
         
         
<!-- Meta Pixel Code -->
<script>
     !function(f,b,e,v,n,t,s)
     {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
     n.callMethod.apply(n,arguments):n.queue.push(arguments)};
     if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
     n.queue=[];t=b.createElement(e);t.async=!0;
     t.src=v;s=b.getElementsByTagName(e)[0];
     s.parentNode.insertBefore(t,s)}(window, document,'script',
     'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '666005641693181');
     fbq('track', 'PageView');
</script>
<noscript>
     <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=666005641693181&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->

     <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MPR62TG');</script>
<!-- End Google Tag Manager -->

     </head>
     <body class="fixed-top">
          <!-- Google Tag Manager (noscript) -->
          <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MPR62TG"
          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
          <!-- End Google Tag Manager (noscript) -->
                    <?php echo $template['partials']['header'];?>
                    <?php echo $template['partials']['flash_messages']?>
                    <?php echo $template['body']?>
                    <?php echo $template['partials']['footer'];?>

                    <!-- -->
                    <script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
                    <script>
                      // Your web app's Firebase configuration
                      var firebaseConfig = {
                        apiKey: "AIzaSyDLvyGrKPSR8dlGAjGMw_5Vt6PaCenMqoE",
                        authDomain: "instant-keel-239508.firebaseapp.com",
                        databaseURL: "https://instant-keel-239508.firebaseio.com",
                        projectId: "instant-keel-239508",
                        storageBucket: "instant-keel-239508.appspot.com",
                        messagingSenderId: "475986271415",
                        appId: "1:475986271415:web:b6172f9cf25c1a146fc132"
                      };
                      // Initialize Firebase
                      firebase.initializeApp(firebaseConfig);
                    </script>
                    <!-- -->
     </body>
</html>