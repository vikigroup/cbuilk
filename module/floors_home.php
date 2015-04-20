<section class="Prod-nb clearfix ads-article">
    <article class="dmsp4-1">
        <div class="arrowLine">
            <span>1c</span>
        </div>
        <div class="arrowCategory">
            <span>Điện tử, máy tính</span>
        </div>
        <div class="divCategory">
            <div class="divContent">
                <i class="fa fa-mobile fa-3x"></i>
                <p><span>Điện thoại</span></p>
            </div>
            <div class="sep"></div>
            <div class="divContent">
                <i class="fa fa-laptop fa-3x"></i>
                <p><span>laptop</span></p>
            </div>
        </div>
        <div class="divSubCategory">
            <p class="aSubCategory"><a href="#">1</a></p>
            <p class="aSubCategory"><a href="#">2</a></p>
            <p class="aSubCategory"><a href="#">3</a></p>
            <p class="aSubCategory"><a href="#">4</a></p>
            <p class="aSubCategory"><a href="#">5</a></p>
            <p class="aSubCategory"><a href="#">6</a></p>
        </div>
        <div class="divAds">
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar1"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar2"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar3"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar4"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar5"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar6"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar7"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar8"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar9"></div>
            <div class="slide"><img src="http://placehold.it/300x100&text=FooBar10"></div>
        </div>
    </article>
    <article class="dmsp4-2">
        <img src="http://placehold.it/390x420">
    </article>
    <article class="dmsp4-3">
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine1"><a href="#"><img src="http://placehold.it/210x256"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
        <div class="divProductLine2"><a href="#"><img src="http://placehold.it/210x164"></a></div>
    </article>
</section><!-- End .Prod-nb -->

<section class="Adv ads-floors">
    <a href="#" target="_blank">
        <img src="http://cpcmart.com/web/images/adv/advs2.png" alt="">
    </a>
</section>

<div class="mini-bar">
    <div class="mini-user">
        <p><i class="fa fa-user fa-2x"></i></p>
        <p>Tài khoản</p>
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
                        <div class="r_f_tt">
                            <input type="checkbox"  name="nho" />
                            <span style="padding-left:5px;">Nhớ mật khẩu</span> | <a href="<?php echo $linkrootshop?>/quen-mat-khau.html" title="">Quên mật khẩu</a>
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
</div>

<script>
    $(document).ready(function(){
        $('.divAds').bxSlider({
            mode: 'vertical',
            slideWidth: 300,
            minSlides: 2,
            slideMargin: 2,
            auto: true,
            pager: false
//            controls: false
        });

        $('.bx-wrapper').css('max-width', '185px');
        $('.bx-viewport').css('width', '185px');
    });
</script>
