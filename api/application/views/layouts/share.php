<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
          <!-- Blog Og Tags -->
          <?php
            if ($controller == 'blog' && $method == 'share' && (isset($_GET['ci']) && !empty($_GET['ci']))) {
                 $id = encryptor($_GET['ci'], 'D');
                 $blogog = $this->blog->getBlog($id);
                 $img = isset($blogog['images'][0]['bimg_image']) ? $blogog['images'][0]['bimg_image'] : '';
                 ?>
                 <title><?php echo $blogog['blog_title']?></title>
                 <meta name="description" content="<?php echo $blogog['blog_desc']?>"/>
                 <meta property="og:url"           content="<?php echo site_url() . 'blog/' . $blogog['blog_slug'] . '?ci=' . $_GET['ci'];?>" />
                 <meta property="og:type"          content="article" />
                 <meta property="og:title"         content="<?php echo $blogog['blog_title'];?>" />
                 <meta property="og:description"   content="<?php echo $blogog['blog_desc']?>" />
                 <meta property="og:image"         content="<?php echo site_url() . 'assets/uploads/blog/' . $img;?>" />
            <?php }?>
     </head>
     <body class="fixed-top">
          <?php echo $template['body']?>
     </body>
</html>