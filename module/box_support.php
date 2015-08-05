<article class="l-tool-ct all-categories">
    <ul class="ul-ltct">
        <li>
            <a class="btn-gh3 <?php if($_SESSION['kt_login_level'] == 3){echo 'btn-float-left';} ?>" href="<?php echo $linkrootshop?>/tat-ca-danh-muc.html"><i class="fa fa-bars fa-lg"></i>
                Tất cả danh mục
            </a>
            <?php if($_SESSION['kt_login_level'] == 3){ ?>
                <a href="#basic" class="initialism basic_open btn-float-left button-transparent pure-button" title="Nhấn để chỉnh sửa"><i class="fa fa-pencil"></i></a>
                <!-- Fade & scale -->
                <div id="basic" class="well">
                    <h4>Chỉnh sửa hệ thống</h4>
                    <form class="pure-form pure-form-aligned" id="popSystemForm">
                        <fieldset>
                            <div class="pure-control-group">
                                <label for="popSystemName" class="button-secondary">Tên liên kết</label>
                                <input id="popSystemName" type="text" value="<?php echo $row_sanpham['brand_name']; ?>" required>
                            </div>
                            <div class="pure-control-group">
                                <label for="popSystemLink" class="button-secondary">Đường dẫn</label>
                                <input id="popSystemLink" type="text" value="<?php echo $row_sanpham['brand_link']; ?>" required onchange="addhttp(this.id, this.value);">
                            </div>
                            <div class="pure-control-group">
                                <label for="popSystemBG" class="button-secondary">Màu nền</label>
                                <input type="text" id="popSystemBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popSystemColorBG').val($('#popSystemBG').val());"/>
                                <input type="color" id="popSystemColorBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popSystemBG').val(this.value);">
                            </div>
                            <div class="pure-control-group">
                                <label for="popSystemFC" class="button-secondary">Màu chữ</label>
                                <input type="text" id="popSystemFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popSystemColorFC').val($('#popSystemFC').val());"/>
                                <input type="color" id="popSystemColorFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popSystemFC').val(this.value);">
                            </div>
                            <div class="pure-control-group">
                                <label for="popSystemDisplay" class="button-secondary">Hiển thị</label>

                            </div>
                        </fieldset>
                        <button type="submit" class="button-success pure-button" id="popSystemSubmit">Hoàn tất</button>
                        <button class="basic_close button-error pure-button" id="popSystemClose">Đóng</button>
                    </form>
                </div>
            <?php } ?>
        </li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $old=getRecord('tbl_shop_category', "id=210"); ?>
        <li><a class="btn-gh3 btn-category" href="<?php echo $linkrootshop?>/<?php echo $old['subject']; ?>.html"><?php echo $old['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $rent=getRecord('tbl_shop_category', "id=209"); ?>
        <li><a class="btn-gh3 btn-category" href="<?php echo $linkrootshop?>/<?php echo $rent['subject']; ?>.html"><?php echo $rent['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $news=getRecord('tbl_shop_category', "id=211"); ?>
        <li><a class="btn-gh3 btn-category" href="<?php echo $linkrootshop; ?>/<?php echo $news['subject']; ?>.html" style="background-color: #2A70D2; color: white !important;"><?php echo $news['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $video=getRecord('tbl_shop_category', "id=390"); ?>
        <li><a class="btn-gh3 btn-category" href="<?php echo $linkrootshop; ?>/<?php echo $video['subject']; ?>.html"><?php echo $video['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $accessory=getRecord('tbl_shop_category', "id=500"); ?>
        <li><a class="btn-gh3 btn-category" href="<?php echo $linkrootshop; ?>/<?php echo $accessory['subject']; ?>.html"><?php echo $accessory['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category menu-category">
    <ul class="ul-ltct">
        <ul id="menu">
            <li><a href="<?php echo $linkrootshop?>/tat-ca-danh-muc.html">Tất cả danh mục</a></li>
            <li><a href="<?php echo $linkrootshop?>/<?php echo $old['subject']; ?>.html"><?php echo $old['name']; ?></a></li>
            <li><a href="<?php echo $linkrootshop?>/<?php echo $rent['subject']; ?>.html"><?php echo $rent['name']; ?></a></li>
            <li><a href="<?php echo $linkrootshop; ?>/<?php echo $news['subject']; ?>.html"><?php echo $news['name']; ?></a></li>
            <li><a href="<?php echo $linkrootshop; ?>/<?php echo $video['subject']; ?>.html"><?php echo $video['name']; ?></a></li>
            <li><a href="<?php echo $linkrootshop; ?>/<?php echo $accessory['subject']; ?>.html"><?php echo $accessory['name']; ?></a></li>
            <?php if($_SESSION['kh_login_username']==""){?>
            <li><a href="<?php echo $linkrootshop?>/dang-ky-gian-hang.html" class="menu-shop">Mở gian hàng miễn phí</a></li>
            <?php } ?>
        </ul>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<script>
    $('.all-categories').hover(function(){
            var windowSize = $(window).width();
            if(windowSize >= 992){
                $(".left-home").slideDown(1000);
                $('.ads-home').css('max-width', windowSize - 190 - 190 - 139);
            }
        $('.left-home').hover(
                function(){
                    $(".left-home").show();
                    $('.ads-home').css('max-width', windowSize - 190 - 190 - 139);
                },
                function(){
                    $(".left-home").slideUp(1000);
                    $('.ads-home').css('max-width', windowSize - 190 - 190 - 139);
                });
        });
</script>
