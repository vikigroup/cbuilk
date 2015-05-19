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
    <meta name="author" content="www.cbuilk.com"/>

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

    <link href="<?php echo $linkrootshop?>/templates/css1.css" rel="stylesheet" />
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css2.css" media="screen and (max-width: 1280px) and (min-width: 1025px)" />-->
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css3.css" media="screen and (max-width: 1024px) and (min-width: 769px)"  />-->
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css4.css" media="screen and (max-width: 768px) and (min-width: 641px)"  />-->
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css5.css" media="screen and (max-width: 640px) and (min-width: 481px)"  />-->
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css6.css" media="screen and (max-width: 480px) and (min-width: 361px)"  />-->
<!--    <link rel="stylesheet" href="--><?php //echo $linkrootshop?><!--/templates/css7.css" media="screen and (max-width: 360px) and (min-width: 321px)"  />-->
<!--    <link href="--><?php //echo $linkrootshop?><!--/templates/css8.css" media="screen and (max-width: 320px)" rel="stylesheet" />-->
    <link href="<?php echo $linkrootshop?>/templates/hover.css" rel="stylesheet" />

    <link href="<?php echo $linkrootshop?>/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.css">
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo $linkrootshop?>/jquery.bxslider/plugins/jquery.fitvids.js"></script>

</head>
<body>
<script>
    $(document).ready(function(){
        /*$("img").lazyload({ placeholder : "<?php echo $linkrootshop?>/imgs/grey.gif" });*/
    });
</script>
<div id="closed"></div>
<header class="menu">
    <div class="m-wrap">

        <?php include("module/box_logo.php") ;?>

        <?php include("module/box_search.php") ;?>

        <?php include("module/box_tool_ad.php") ;?>

    </div><!-- End .m-wrap -->
</header>

<div class="m-wrap">
    <section class="tool-ct">
        <?php include("module/box_support.php") ;?>
        <?php include("module/info_user.php") ;?>
    </section><!-- End .tool-ct -->
</div><!-- End .m-wrap -->

<div class="m-wrap menu-responsive">
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

<?php if($frame==""){ ?>
<div class="m-wrap">
    <?php include("module/menu_left_home.php") ;?>
</div>

<div id="slider">
    <?php
    $gt=get_records("tbl_slider","status=0 AND idshop=0"," ","0,20"," ");
    while($row_slide=mysql_fetch_assoc($gt)){
        ?>
        <a href="#"><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="" /></a>
    <?php } ?>
</div>
<?php } ?>

<section id="container" <?php if($frame == ''){echo 'class="fix_main"';} ?>>
    <div class="m-wrap">

        <?php include("module/processFrame.php");?>

<!--        --><?php
//        if($frame!="register" && $frame!="login" &&  $frame!="changepass" &&  $frame!="changeinfo" &&  $frame!="addshop" ){
//            ?>
<!--            --><?php //include("module/service_new.php") ;?>
<!---->
<!--            <section class="app-orther" style="clear: both">-->
<!---->
<!--                --><?php //include("module/box_shop_new.php") ;?>
<!---->
<!--                --><?php //include("module/box_shop_best.php") ;?>
<!---->
<!--                --><?php ////include("module/box_news.php") ;?>
<!--                --><?php // include("module/box_raovat.php") ;?>
<!--                <div class="clear"></div>-->
<!---->
<!--            </section><!-- End .app-orther -->
<!---->
<!--        --><?php //}?>

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
        <div style="padding:5px;   color:#F00; padding-bottom:10px;">
            <center>
                <?php if($_SERVER['HTTP_REFERER']=="http://shop.jbs.vn/dang-ky.html" && $_SESSION['register_re']==1)echo "Bạn vừa đăng ký thành công tài khoản ";?>
            </center>
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

//        $('.ul-Pnb').css('width', '100%');
    });

    $('.mini-user').hover(function(){
        $('.mini-login').show();
        $('.mini-angle').show();
    });

    $('.mini-login').hover(
        function(){
            $('.mini-login').show(); $('.mini-angle').show();
        },
        function(){
            $('.mini-login').hide(); $('.mini-angle').hide();
        });

    $(window).load(function() {
        var $document, didScroll, offset;
        offset = $('.menu').position().top;
        $document = $(document);
        didScroll = false;
        $(window).on('scroll touchmove', function() {
            return didScroll = true;
        });
        var k = 0;
        return setInterval(function() {
            if (didScroll) {
                $('.menu').toggleClass('fixed', $document.scrollTop() > offset);
                if($document.scrollTop() == offset){
                    $('.dmsp3').css('top', '119px');
                }
                else{
                    $('.dmsp3').css('top', '37px');
                }
                if(k == 0){
                    $( ".menu" ).fadeIn(3000);
                    k++;
                }
                return didScroll = false;
            }
        }, 250);
    });
</script>

<script>
    window.onload = function(){
        autoHome();
        $(window).resize(function () {
            autoHome();
        });
    };

    function autoHome(){
        var windowSize = $(window).width();
        if($(window).width() < 992){
            $('.m-wrap, .dmsp4-3, .ads-home, .btn-gh3, .form_dn, .form_dn ul li, .l-fcont, .r-fcont' +
                ', .sli-fcon-1 .bx-wrapper .bx-viewport, .filter-Prod, .content').css('width', windowSize);
            $('.divProductLine1, .divProductOverlay1').css('width', windowSize/2 - 2);
            $('.sli-fcon-1').css('width', windowSize - 2);
            $('.li-Pc1').css('width', windowSize/2 - 23);
            $('.ul-ifoot li, .menu').css('width', '100%');
            $('.arrowCategory').css('width', windowSize - 52);
            $('.t-Pnb').css('max-width', windowSize - 2);
            $('.hotline').attr('style', 'margin: 0 0 0 5px !important;');
            $('.dmsp4-3').css('max-width', windowSize);
            $('.prod_row1').css('width', windowSize/2 - 20);

            for(var i = 0; i < 8; i++){
                if($('#aCategoryName'+i).height() > 14){
                    $('#divCategoryID'+i).css('padding', '5px 0 0 0');
                }
            }
        }

        if($(window).width() >= 992){
            $('.m-wrap, .f-cont').css('max-width', 1210);
            $('.m-wrap, .f-cont').css('width', '100%');
            $('.menu').css('width', '100%');
            $('.mini-bar').css('width', '3%');
            $('.form_dn').css('width', windowSize - 139);
            $('.dmsp4-3').css('width', windowSize - 190 - 390 - 139);
//            $('.dmsp4-3').css('max-width', windowSize - 190 - 390 - 139);
            $('.ads-home').css('max-width', windowSize - 190 - 190 - 139);
            $('.btn-gh3').css('width', 190);
            $('.arrowCategory').css('width', 137);
            $('.btn-gh3').css('width', 190);
            $('.form_dn ul li').css('width', 480);
            $('.divProductLine1, .divProductOverlay1').css('width', 198);
            $('.ul-ifoot li').css('width', '25%');
            $('.news li, .yahoo li').css('width', '100%');
            $('.sli-fcon-1 .bx-wrapper .bx-viewport').css('width', '100%');
            $('.t-Pnb, .filter-Prod, .content').css('max-width', 1000);
            $('.li-Pc1').css('width', 173);
            $('.hotline').attr('style', 'margin: 10px 30px 10px 30px !important;');
            $('.prod_row1').css('width', 'inherit');
            $('.t-Pnb').css('width', windowSize - 412);
            $('.content').css('width', windowSize - 350);

            for(var i = 0; i < 8; i++){
                if($('#aCategoryName'+i).height() > 14){
                    $('#divCategoryID'+i).css('padding', '5px 0 11px 0');
                }
            }
        }
    }
</script>
</body>
</html>