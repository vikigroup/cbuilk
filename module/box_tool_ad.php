<article class="r-tool-ct r-box-tool">
    <ul>
        <?php if($_SESSION['kh_login_username']==""){?>
            <li class="r-box-language">
                <a href="<?php echo $root; ?>/dang-nhap.html">Đăng nhập</a>
                <span> | </span>
                <a href="<?php echo $root; ?>/dang-ky.html">Đăng ký</a>
            </li>
            <li class="r-box-language">
                <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_vietnamese.png"></a>
                <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_english.png"></a>
            </li>
        <?php }else{
            $id = get_field("tbl_customer","username",$_SESSION['kh_login_username'],"id");
            $domain = get_field("tbl_shop","iduser",$id,"subject");
            $avatar = get_field("tbl_customer","username",$_SESSION['kh_login_username'],"image");
            if($avatar != ''){if(strpos($avatar, 'http') >= 0){
            ?>
            <li class="r-avatar">
                <div class="size">
                    <img class="avatar field" src="<?php echo $avatar; ?>" alt="<?php echo $_SESSION['kh_login_username']; ?>" />
                    <ul class="list">
                        <?php if($domain != ""){ ?>
                        <li><a onclick="if($(window).width() > 991){window.location.href = 'http://<?php echo $domain ?>.<?php echo $sub ?>/quantri.html';} else{alert('Chức năng này chỉ dành cho phiên bản đầy đủ...');}">Trang quản trị</a></li>
                        <?php } ?>
                        <li><a href="<?php echo $root; ?>/thoat.html" title="">Thoát</a></li>
                        <li class="r-box-language">
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_vietnamese.png"></a>
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_english.png"></a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php }else{ ?>
            <li class="r-avatar">
                <div class="size">
                    <img class="avatar field" src="<?php echo '/web/images/avatar/'.$avatar; ?>" alt="<?php echo $_SESSION['kh_login_username']; ?>" />
                    <ul class="list">
                        <?php if($domain != ""){ ?>
                            <li><a onclick="if($(window).width() > 991){window.location.href = 'http://<?php echo $domain ?>.<?php echo $sub ?>/quantri.html';} else{alert('Chức năng này chỉ dành cho phiên bản đầy đủ...');}">Trang quản trị</a></li>
                        <?php } ?>
                        <li><a href="<?php echo $root; ?>/doi-mat-khau.html" title="">Đổi mật khẩu</a></li>
                        <li><a href="<?php echo $root; ?>/thoat.html" title="">Thoát</a></li>
                        <li class="r-box-language">
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_vietnamese.png"></a>
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_english.png"></a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php }}else{ ?>
            <li class="r-avatar">
                <div class="size">
                    <img class="avatar field" src="<?php echo $root; ?>/imgs/noavatar.jpg" alt="<?php echo $_SESSION['kh_login_username']; ?>" />
                    <ul class="list">
                        <?php if($domain != ""){ ?>
                            <li><a onclick="if($(window).width() > 991){window.location.href = 'http://<?php echo $domain ?>.<?php echo $sub ?>/quantri.html';} else{alert('Chức năng này chỉ dành cho phiên bản đầy đủ...');}">Trang quản trị</a></li>
                        <?php } ?>
                        <li><a href="<?php echo $root; ?>/doi-mat-khau.html" title="">Đổi mật khẩu</a></li>
                        <li><a href="<?php echo $root; ?>/thoat.html" title="">Thoát</a></li>
                        <li class="r-box-language">
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_vietnamese.png"></a>
                            <a href="#"><img src="<?php echo $root; ?>/imgs/icon_flag_english.png"></a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php } ?>
            <li class="c-sale">
                <a href="<?php echo $root; ?>/dang-ky-gian-hang.html"> Bán hàng cùng <?php echo $subname; ?></a>
                <img src="<?php echo $root; ?>/imgs/icon-hot.gif">
            </li>
        <?php }?>
    </ul>
</article><!-- End .r-tool-ct -->
