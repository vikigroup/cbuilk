<?php
require("config.php");
require("common_start.php");
include("lib/func.lib.php");

$cache = get_field('tbl_config','id','2','cache');
if($cache == 1){
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
        $page = "thong-tin-".$pageName.".html";
    }

    /* Define path and name of cached file */
    $cachefile = 'cache/' .$page;

    /* How long to keep cache file? */
    $cachetime = 300;

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
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php include("module/title.php") ;?>
    <meta name="robots" content="index, follow"/>
    <meta name="author" content="www.cbuilk.com"/>
    <meta content="vi-VN" itemprop="inLanguage" />
    <link rel="shortcut icon" href="imgs/layout/logo.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/css.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/bxslider/jquery.bxslider.css" media="screen and (min-width: 991px)">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/scrolltopcontrol.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/html5.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/templates/FIX_IE.css" />
    <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/selectivizr-min.js"></script>
    <![endif]-->

    <link href="<?php echo $linkrootshop?>/templates/css1.css" rel="stylesheet" />
    <link href="<?php echo $linkrootshop?>/templates/hover.css" rel="stylesheet" />

    <link href="<?php echo $linkrootshop?>/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.css" media="screen and (min-width: 991px)">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/plugins/jquery.fitvids.js"></script>

    <link rel="stylesheet" href="<?php echo $linkrootshop?>/lib/SlickNav/slicknav.css" media="screen and (max-width: 991px)"/>
    <script src="<?php echo $linkrootshop?>/lib/SlickNav/jquery.slicknav.js"></script>
</head>
<body>
<div id="closed"></div>
<header class="menu">
    <div class="m-wrap">
        <?php include("module/box_logo.php") ;?>
        <?php include("module/box_search.php") ;?>
        <?php include("module/box_tool_ad.php") ;?>
    </div><!-- End .m-wrap -->
</header>

<div class="m-wrap menu-wrap">
    <section class="tool-ct">
        <?php include("module/box_support.php") ;?>
        <?php include("module/info_user.php") ;?>
    </section><!-- End .tool-ct -->
</div><!-- End .m-wrap -->

<?php if($frame==""){ ?>
<div class="m-wrap">
    <?php include("module/menu_left_home.php") ;?>
</div>
<header class="m-slider">
    <div id="slider">
        <?php
        $gt=get_records("tbl_slider","status=0 AND idshop=0"," ","0,20"," ");
        $index = 0;
        while($row_slide=mysql_fetch_assoc($gt)){
            ?>
            <a id="aSlider<?php echo $index ?>" href="#" style="background-color: <?php echo $row_slide['color']?>"><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="" /></a>
        <?php $index++; } ?>
    </div>
</header>
<script>
    $(function() {
        $('#slider').nivoSlider({
            effect: 'random',
            controlNav: false,
            directionNav: false,
            control: false,
            afterChange: function(){
                var totalSlides = $('#slider a img').length;
                var currentSlide = $('#slider').data('nivo:vars').currentSlide;
                $('.m-slider').css("background-color", $("#aSlider"+currentSlide).css('background-color'));
            }
        });
        $('.m-slider').css("background-color", $("#aSlider"+0).css('background-color'));
    });
</script>
<?php } ?>

<div class="clear"></div>

<section id="container" <?php if($frame == ''){echo 'class="fix_main"';} ?>>
    <div class="m-wrap">
        <?php include("module/processFrame.php");?>
        <?php

        if (isset($_POST['btn_dangnhap_in'])==true){
            $username= $_POST['username'];
            $password= md5(md5(md5($_POST['password'])));// md5()

            if (get_magic_quotes_gpc()== false)
            {
                $username=trim(mysql_real_escape_string($username));
                $password=trim(mysql_real_escape_string($password));
            }
            $coloi=false;
            if ($username == NULL) {$coloi=true; $error_username_in = "Bạn chưa nhập tên đăng nhập";}
            elseif ($_POST['password'] == NULL) {$coloi=true; $error_password_in = "Bạn chưa nhập password";}

            if ($coloi==FALSE) {

                $sql = sprintf("SELECT * FROM tbl_customer WHERE username='%s'", $username);
                $user = mysql_query($sql);
                $row_user=mysql_fetch_assoc($user);
                if (check_table('tbl_customer',"username='".$username."' AND password='".$password."'",'id')==true)
                { $coloi=true;  $error_login="Tài khoản hoặc mật khẩu không đúng, vui lòng đăng nhập lại";}
                elseif($row_user['active']==0)
                { $error_login="Bạn chưa kích hoạt tài khoản, vui lòng kích hoạt mới đăng nhập tiếp";}
                elseif($row_user['status']==0)
                { location($linkrootshop.'dang-nhap.html');$error_login="Tài khoản của bạn đã bị khóa, vui lòng liên hệ Admin để biết thêm chi tiếp";}

                else {	//check neu dung chay
                    $sql = sprintf("SELECT * FROM tbl_customer WHERE username='%s' AND password ='%s'",$username, $password);
                    $user = mysql_query($sql);
                    if (mysql_num_rows($user)==1) {//Thành công
                        $row_user = mysql_fetch_assoc($user);
                        $_SESSION['kh_login_id'] = $row_user['id'];
                        $_SESSION['kh_login_username'] = $row_user['username'];
                        /*	  chinh_table('tbl_customer',$row_user['id'],'xem=xem+1',' ',' ');*/

                        //luu usernam va pass words
                        if (isset($_POST['nho'])== true){
                            setcookie("un", $_POST['username'], time() + 60*60*24*7 );
                            setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
                        } else
                        {
                            setcookie("un", $_POST['username'], time()-1);
                            setcookie("pw", $_POST['password'], time()-1);
                        }

                        if(isset($_SESSION['kh_login_username'])){
                            $row_user  = getRecord('tbl_customer', "username='".$_SESSION['kh_login_username']."'");

                            if($row_user['mobile']=="" || $row_user['address']=="") {
                                header("location: ".$linkrootshop."/quan-ly.html");
                            }
                        }


                        if(isset($_SESSION['back_raovat'])) echo '<script>window.location="'.$_SESSION['back_raovat'].'"</script>';
                        if(isset($_SESSION['back_bds'])) echo '<script>window.location="'.$_SESSION['back_bds'].'"</script>';

                        if(check_table('tbl_shop',"iduser='".$row_user['id']."'",'id')==false){
                            $shop=getRecord('tbl_shop', "iduser='".$row_user['id']."'");
                            echo '<script>window.location="http://'.$shop['subject'].'.'.$sub.'/quantri.html"</script>';
                        }
                        else echo '<script>window.location="'.$linkrootshop.'/dang-ky-gian-hang.html'.'"</script>';

                        echo '<script>window.location="'.$linkrootshop.''.'"</script>';

                    }else{ //Thất bại
                        header("location: $linkrootshop");
                    }
                }//else
            }//if ($coloi==FALSE)
        }// if isset
        if (isset($_POST['quayra'])==true) {

            header("location: $linkrootshop");
        }
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("form[name=form1]").bind('submit',function(){
                    var username=$("#username").val();
                    var password=$("#password").val();
                    if(username=="") {
                        alert("Bạn chưa nhập tài khoản");
                        return false;
                    }
                    if(password=="") {
                        alert("Bạn chưa nhập mật khẩu");
                        return false;
                    }
                });
            });
        </script>
    </div><!-- End .m-wrap -->
</section><!-- End #container -->

<div class="mini-bar">
    <?php if(!isset($_SESSION['kh_login_username'])){ ?>
        <div class="mini-user">
            <p><i class="fa fa-user fa-lg"></i></p>
            <p>Tài khoản</p>
        </div>
        <div style="padding:5px 5px 10px 5px; color:#F00; text-align: center">
            <?php if($_SERVER['HTTP_REFERER']=="http://shop.jbs.vn/dang-ky.html" && $_SESSION['register_re']==1)echo "Bạn vừa đăng ký thành công tài khoản ";?>
        </div>
        <div class="mini-login">
            <div class="main_f_dn">
                <h1 class="title_f_tt"> Đăng nhập </h1>
                <form id="form1" name="form1" method="post" action="#">
                    <div class="main_f_tt">
                        <div class="module_ftt">
                            <div class="l_f_tt">
                                Tên
                            </div>
                            <div class="r_f_tt">
                                <input class="ipt_f_tt" type="text" id="username" name="username" value="<?php  echo $_COOKIE['un'];?>" />
                                <span class="star_style">*</span>
                            </div>
                            <div class="clear"></div>
                        </div><!-- End .module_ftt -->

                        <div class="module_ftt">
                            <div class="l_f_tt">
                                Mật khẩu
                            </div>
                            <div class="r_f_tt">
                                <input class="ipt_f_tt" type="password" id="password" name="password" value="<?php  echo $_COOKIE['pw'];?>" />
                                <span class="star_style">*</span>
                            </div>
                            <div class="clear"></div>
                        </div><!-- End .module_ftt -->

                        <div class="module_ftt">
                            <div class="l_f_tt">
                                &nbsp;
                            </div>
                            <div class="r_f_tt mini-remember">
                                <input type="checkbox"  name="nho" />
                                <span style="padding-left:5px;">Ghi nhớ</span> | <a href="<?php echo $linkrootshop?>/quen-mat-khau.html" title="">Quên mật khẩu</a>
                            </div>
                            <div class="clear"></div>
                        </div><!-- End .module_ftt -->

                        <div class="module_ftt" style="color:#F00; text-align:center;">
                            <?php echo $error_login;?>
                        </div>

                        <div class="module_ftt">
                            <div class="l_f_tt">
                                &nbsp;
                            </div>
                            <div class="r_f_tt">
                                <div style="padding-bottom:15px;">
                                    <input name="btn_dangnhap_in" class="btn_dn" type="submit" value="&nbsp;"/>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div><!-- End .module_ftt -->

                        <div class="info_f_tt">
                            Đăng nhập bây giờ để quá trình mua hàng diễn ra nhanh chóng. Bạn cũng có thể xem chi tiết lịch sử giao dịch & tình trạng đơn hàng trong tài khoản của bạn.
                        </div><!-- End .info_f_tt -->

                    </div><!-- End .main_f_tt -->
                </form>
            </div><!-- End .main_f_dn -->
        </div>
        <div class="mini-angle"><i class="fa fa-caret-right fa-3x"></i></div>
    <?php } ?>
    <div class="mini-shopping">
        <a href="#">
            <p><i class="fa fa-shopping-cart fa-lg"></i></p>
            <p>Giỏ hàng</p>
        </a>
    </div>
</div>

<?php include("module/footer.php") ;?>

<?php require("common_end.php");?>

<link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/nivo-slider.css" media="screen and (min-width: 991px)">
<link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/scripts/nivo-slider/themes/default/default.css" media="screen and (min-width: 991px)">
<script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript"  src="<?php echo $linkrootshop?>/scripts/responsive.js"></script>
</body>
</html>

<?php
if($cache == 1){
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