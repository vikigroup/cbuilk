<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
require("config.php");
require("common_start.php");
include("lib/func.lib.php");
$cache = get_field('tbl_config','id','2','cache');
if($cache == 1 && !isset($_SESSION['kh_login_username']) && $_SESSION['kt_login_level'] != 3){
    $link = $_SERVER['REQUEST_URI'];
    $myLink = explode("?", $link);
    $myData = explode("&", $myLink[1]);
    $myFilter = explode("=", $myData[0]);
    $filterCache = $myFilter[1];
    $myPage = explode("=", $myData[1]);
    $pageNumCache = $myPage[1];
    /* Assign your dynamically generated page to $page */
    $pageName = $_GET['tensanpham'];
    $page = $pageName.".html";
    if($filterCache != ''){
        $page .= "?filter1=".$filterCache."&page=".$pageNumCache;
    }
    if($pageName == ''){
        $pageName = $_GET['tenthongtin'];
        if($pageName != ''){
            $page = "thong-tin-".$pageName.".html";
        }
        else{
            if($link == '/'){
                $pageName = "home";
                $page = "home.html";
            }
            if(strpos($link, "tat-ca-danh-muc") !== false){
                $pageName = "tat-ca-danh-muc";
                $page = "tat-ca-danh-muc.html";
            }
            else if(strpos($link, "dang-nhap") !== false || strpos($link, "dang-ky") !== false){
                    $pageName = "";
            }
        }
    }
    /* Define path and name of cached file */
    $cachefile = 'cache/' .$page;
    /* How long to keep cache file? */
    $cachetime = 18000;
    /* Is cache file still fresh? If so, serve it */
    if($pageName != ''){
        if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
            include($cachefile);
            exit;
        }
    }
    /* If no file or too old, render and capture HTML page. */
    ob_start();
}
?>

<?php
if($frame!="login" && $frame!="register" && $frame!="changepass" && $frame!="changeinfo"){
    unset($_SESSION['back_raovat']);
}
require("module/box_device.php");
$myProduct = getRecord('tbl_item', "subject='".$_GET['tensanpham']."'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "hrvp://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml"
      prefix="og: http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <?php include("module/title.php") ;?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="author" content="<?php echo $root; ?>"/>
    <meta name="generator" content="<?php echo $sub; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="<?php echo $title_t; ?>"/>
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:title" content="<?php echo $title_t; ?>" />
    <meta property="og:description" content="<?php echo $description_t; ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image" content="<?php if($myProduct['image'] != ''){echo $linkroot;?>/<?php echo $myProduct['image'];}else{echo $root.'/imgs/layout/logo.png';} ?>" />
    <meta property="fb:app_id" content="1460618637571000"/>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="449603416239-se132bqu56psukmq6o0n7poegu17rgur.apps.googleusercontent.com">

    <link rel="shortcut icon" href="imgs/layout/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/css.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/html5.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/FIX_IE.css" />
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/selectivizr-min.js"></script>
    <![endif]-->

    <link href="<?php echo $linkrootshop?>/templates/css1.css" rel="stylesheet"  />
    <link href="<?php echo $linkrootshop?>/templates/hover.css" rel="stylesheet" />
    <link href="<?php echo $linkrootshop?>/lib/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/lib/jquery.bxslider/jquery.bxslider.css"/>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/lib/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/lib/jquery.bxslider/plugins/jquery.fitvids.js"></script>
    <script type="text/javascript"  src="<?php echo $linkrootshop?>/scripts/responsive.js"></script>

    <link rel="stylesheet" href="<?php echo $linkrootshop?>/lib/SlickNav/slicknav.css" media="screen and (max-width: 991px)"/>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/lib/SlickNav/jquery.slicknav.js"></script>

    <link rel="stylesheet" href="<?php echo $linkrootshop?>/templates/pure-min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/nivo-slider.css"   />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/themes/default/default.css">
</head>
<body>
<div id="fb-root"></div>
<div id="closed"></div>
<input type="hidden" id="hiddenHomeLink" value="<?php echo $root; ?>">
<div class="m-header">
    <div class="menu">
        <?php include("module/box_logo.php") ;?>
        <?php include("module/box_search.php") ;?>
        <?php include("module/box_tool_ad.php") ;?>
    </div>
</div><!-- End .m-wrap -->

<div class="m-wrap menu-wrap">
    <div class="tool-ct">
        <?php include("module/box_support.php") ;?>
    </div><!-- End .tool-ct -->
</div><!-- End .m-wrap -->

<?php if($frame==""){ ?>
<div class="m-wrap">
    <?php include("module/menu_left_home.php") ;?>
</div>
<?php include("module/slider.php") ;?>
<?php } ?>

<div class="clear"></div>

<div id="container" <?php if($frame == ''){echo 'class="fix_main"';} ?>>
    <div class="m-wrap">
        <?php include("module/processFrame.php");?>
    </div><!-- End .m-wrap -->
</div><!-- End #container -->
<?php include("module/box_system.php") ;?>

<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery.popupoverlay.js"></script>
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/resolve.js"></script>
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/platform.js?onload=renderButton" async defer></script>
<script type="text/javascript" async defer data-pin-color="red" data-pin-height="28" data-pin-hover="true" src="<?php echo $linkrootshop?>/scripts/pinit.js"></script>
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/nivo-slider/jquery.nivo.slider.js"></script>

<?php include("module/footer.php") ;?>
<?php require("common_end.php");?>
</body>
</html>

<?php
if($cache == 1 && !isset($_SESSION['kh_login_username'])){
    /* Save the cached content to a file */
    if($pageName != ''){
        $fp = fopen($cachefile, 'w');
        fwrite($fp, ob_get_contents());
        fclose($fp);
    }
    /* Send browser output */
    ob_end_flush();
}
?>