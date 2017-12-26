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

<? $this->load->view('partials/Header_view');?>

   <!-- homepage hero
   ==================================================-->
   <section id="hero">

		<div class="row hero-content">

        </div>

       <!-- hero-slider start-->
   </section>





   <div id="preloader">
<div id="loader"></div>
   </div>


<?$this->load->view('partials/Footer_view');?>
</body>

</html>
<script type="text/javascript">
    $(window).load(function() {

        setTimeout(
            function()
            {
                $('#hero').append('<div id="slide_left" class="w3-container w3-center w3-animate-left"><div class="title"><h1>Hello, world</h1></div><div class="text">Following us, Changing mind, Developing view,<p>To be a Professional talent</p> </div></div>');
            }, 2000);


    });

</script>