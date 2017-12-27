<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Hello World</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="<?=base_url()?>res/css/base.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/vendor.min.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/article.css">

    <link rel="stylesheet" href="<?=base_url()?>res/css/w3.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/normalize.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/defaults.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/nav-core.css">
    <link rel="stylesheet" href="<?=base_url()?>res/css/nav-layout.css">

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/ie8-core.min.css">
    <link rel="stylesheet" href="css/ie8-layout.min.css">
    <![endif]-->
    <!-- script
    ================================================== -->
    <script src="<?=base_url()?>res/js/modernizr.js"></script>
    <!-- Java Script
================================================== -->
    <script src="<?=base_url()?>res/js/jquery-1.11.3.min.js"></script>

    <script src="<?=base_url()?>res/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?=base_url()?>res/js/jquery.flexslider-min.js"></script>
    <script src="<?=base_url()?>res/js/jquery.waypoints.min.js"></script>
    <script src="<?=base_url()?>res/js/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>res/js/jquery.fittext.js"></script>
    <script src="<?=base_url()?>res/js/jquery.placeholder.min.js"></script>
    <script src="<?=base_url()?>res/js/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>res/js/main.js"></script>
    <script src="<?=base_url()?>res/js/html5shiv.min.js"></script>
    <script src="<?=base_url()?>res/js/rem.min.js"></script>

</head>

<body>
<?php
$this->load->view('partials/Header_view')
?>


<!-- pre-content, display Category Name
==================================================-->
<section id="pre_content_section">

    <div class="pre_content">

        <?php
        if($pre_content_partial_name){
            $this->load->view('partials/'.$pre_content_partial_name);
        }

        ?>

    </div>
    <!-- homepage hero
   ==================================================-->
</section>

<section id="content_section">

    <div class="content">

            <?php
            if($content_partial_name){
                $this->load->view('partials/'.$content_partial_name);
            }

            ?>



    </div>


</section>


<?$this->load->view('partials/Footer_view');?>
</body>
</html>