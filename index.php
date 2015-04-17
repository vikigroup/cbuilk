<?php
require("config.php");
require("common_start.php");
include("lib/func.lib.php");



if($frame!="login" && $frame!="register" && $frame!="changepass" && $frame!="changeinfo"){
    unset($_SESSION['back_raovat']);
}

require("module/box_device.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php include("module/title.php") ;?>
    <meta name="robots" content="index, follow"/>
    <meta name="author" content="www.cpckids.com"/>

    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/css.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/bxslider/jquery.bxslider.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/scrolltopcontrol.js"></script>
    <!--<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery.lazyload.pack.js"></script>-->

    <!--[if IE 6]>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/DD_belatedPNG_0.0.8a.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('img, div, span, a, h1, h2, h3, h4, h5, h6, p, table, input');
    </script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/html5.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/FIX_IE.css" />
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/selectivizr-min.js"></script>
    <![endif]-->

    <link href="<?php echo $linkrootshop?>/templates/css1.css" media="screen and (min-width: 1281px)" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css2.css" media="screen and (max-width: 1280px) and (min-width: 1025px)" />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css3.css" media="screen and (max-width: 1024px) and (min-width: 769px)"  />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css4.css" media="screen and (max-width: 768px) and (min-width: 641px)"  />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css5.css" media="screen and (max-width: 640px) and (min-width: 481px)"  />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css6.css" media="screen and (max-width: 480px) and (min-width: 361px)"  />
    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/css7.css" media="screen and (max-width: 360px) and (min-width: 321px)"  />
    <link href="<?php echo $linkrootshop?>/templates/css8.css" media="screen and (max-width: 320px)" rel="stylesheet" />

    <link href="<?php echo $linkrootshop?>/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.min.js"></script>

</head>
<body>
<script>
    $(document).ready(function(){
        /*$("img").lazyload({ placeholder : "<?php echo $linkrootshop?>/imgs/grey.gif" });*/
    });
</script>
<header>
    <div class="m-wrap">

        <?php include("module/box_logo.php") ;?>

        <?php include("module/box_search.php") ;?>

        <?php include("module/box_tool_ad.php") ;?>

    </div><!-- End .m-wrap -->
</header>

<div class="container">
    <div class="m-wrap">
        <section class="tool-ct">
            <?php include("module/box_support.php") ;?>
            <?php include("module/info_user.php") ;?>
        </section><!-- End .tool-ct -->
    </div><!-- End .m-wrap -->
</div>

<div class="container menu-responsive">
    <div class="m-wrap">
        <section class="top-ct">
            <article class="dmsp2">
                <nav id="nav-wrap">
                    <ul id="nav">
                        <?php
                        $cate=get_records("tbl_shop_category","status=0 AND  parent=2"," "," "," ");
                        $i=1;
                        while($row_cate=mysql_fetch_assoc($cate)){
                            ?>
                            <li>
                                <a href="<?php echo $linkrootshop?>/<?php echo $row_cate['subject'];?>.html"><?php echo $row_cate['name'];?></a>
                            </li>
                        <?php }?>
                    </ul>
                    <div class="clear"></div>
                    <script type="text/javascript">
                        jQuery(document).ready(function($){
                            /* prepend menu icon */
                            $('#nav-wrap').prepend('<div id="menu-icon">Menu</div>');
                            /* toggle nav */
                            $("#menu-icon").on("click", function(){
                                $("#nav").slideToggle();
                                $(this).toggleClass("active");
                            });
                        });
                    </script>
                </nav>
            </article><!-- Responsive dmsp -->
        </section><!-- End .top-ct -->
    </div><!-- End .m-wrap -->
</div>

<div class="container-fluid">
    <div class="row" id="slider">
        <?php
        $gt=get_records("tbl_slider","status=0 AND idshop=0"," ","0,20"," ");
        while($row_slide=mysql_fetch_assoc($gt)){
            ?>
            <a href="#"><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="" /></a>
        <?php } ?>
    </div>
</div>

<section id="container">
    <div class="m-wrap">

        <?php include("module/processFrame.php");?>

        <?php
        if($frame!="register" && $frame!="login" &&  $frame!="changepass" &&  $frame!="changeinfo" &&  $frame!="addshop" ){
            ?>
            <?php include("module/service_new.php") ;?>

            <section class="app-orther" style="clear: both">

                <?php include("module/box_shop_new.php") ;?>

                <?php include("module/box_shop_best.php") ;?>

                <?php //include("module/box_news.php") ;?>
                <?php  include("module/box_raovat.php") ;?>
                <div class="clear"></div>

            </section><!-- End .app-orther -->

        <?php }?>

    </div><!-- End .m-wrap -->
</section><!-- End #container -->

<?php include("module/footer.php") ;?>

<?php require("common_end.php");?>

<link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/nivo-slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/themes/default/default.css">
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
            effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
            controlNav: false,
            directionNav: false
        });
    });
</script>
</body>
</html>