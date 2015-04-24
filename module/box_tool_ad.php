<article class="r-tool-ct r-box-tool">
    <ul>
        <li>
<!--            <span class="sp-gh1">0</span>-->
<!--            <a class="btn-gh1" href="#"></a>-->
        </li>
        <li><span class="hotline">hotline: <?=$row_title_lap['hotlinekh'];?></span></li>
        <li>|</li>
        <?php if($_SESSION['kh_login_username']==""){?>
            <li><a href="<?php echo $linkrootshop;?>/dang-nhap.html">Đăng nhập</a></li>
            <li>|</li>
            <li><a href="<?php echo $linkrootshop;?>/dang-ky.html">Đăng ký</a></li>
        <?php }else{?>
            <li><a href="<?php echo $linkrootshop;?>/quan-ly.html">Xin chào ! <?php echo $_SESSION['kh_login_username'];?></a>
            <li>|</li>
            </li>
            <li><a href="<?php echo $linkrootshop;?>/doi-mat-khau.html" title="">Đổi mật khẩu</a></li>
            <li>|</li>
            <li><a href="<?php echo $linkrootshop;?>/thoat.html" title="">Thoát</a></li>
        <?php }?>
    </ul>
    <!--    <div class="clear"></div>-->
</article><!-- End .r-tool-ct -->