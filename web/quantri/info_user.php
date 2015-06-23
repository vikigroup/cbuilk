<div class="cont_head">            
    
    <div class="info_gh">
        <a target="_blank" href="<?php echo $shophomepage; ?>" title="">Trang chủ gian hàng</a>
    </div><!-- End .info_gh -->
    
    <div class="info_user">
        Chào ! <?php echo $_SESSION['cu_login_username'];?>
        <span class="arrow_info_user"></span>
        <div class="frame_info_user" style="display:none;" tks=0>
            <ul>
                <li><a href="index.php?act=user_m" title="">Thông tin cá nhân</a></li>
                <li><a href="index.php?act=pass_m" title="">Đổi mật khẩu</a></li>
                <li><a href="index.php?act=logout" title="">Thoát</a></li>
            </ul>
        </div>
    </div><!-- End .info_user -->
    
    <div class="clear"></div>
    
</div><!-- End .cont_head -->

