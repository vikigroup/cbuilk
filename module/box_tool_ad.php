<article class="r-tool-ct r-box-tool">
    <span class="hotline">Liên hệ quảng cáo: </i> <?=$row_title_lap['hotlinekh'];?></span>
    <ul>
        <li>
<!--            <span class="sp-gh1">0</span>-->
<!--            <a class="btn-gh1" href="#"></a>-->
        </li>
        <?php if($_SESSION['kh_login_username']==""){?>
            <li><a href="<?php echo $linkrootshop;?>/dang-nhap.html">Đăng nhập</a></li>
            <li>|</li>
            <li><a href="<?php echo $linkrootshop;?>/dang-ky.html">Đăng ký</a></li>
        <?php }else{$id = get_field("tbl_customer","username",$_SESSION['kh_login_username'],"id"); $domain = get_field("tbl_shop","iduser",$id,"subject");?>
            <?php if($domain != ""){ ?>
            <li><a href="http://<?php echo $domain ?>.<?php echo $sub ?>/quantri.html">Trang quản trị</a></li>
            <?php }else{ ?>
            <li>Xin chào ! <?php echo $_SESSION['kh_login_username'];?></li>
            <?php } ?>
            <li>|</li>
            <li><a href="<?php echo $linkrootshop;?>/doi-mat-khau.html" title="">Đổi mật khẩu</a></li>
            <li>|</li>
            <li><a href="<?php echo $linkrootshop;?>/thoat.html" title="">Thoát</a></li>
        <?php }?>
    </ul>
    <!--    <div class="clear"></div>-->
</article><!-- End .r-tool-ct -->