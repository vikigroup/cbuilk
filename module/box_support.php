<article class="l-tool-ct all-categories">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/xem-tat-ca.html"><i class="fa fa-arrow-circle-o-down fa-lg"></i>Toàn bộ danh mục</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/16-may-thiet-bi-cu.html">Máy, thiết bị củ</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/17-cho-thue-may-thiet-bi.html">Thuê Máy, thiết bị</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/18-tin-tuc-chuyen-nganh.html">Tin chuyên ngành</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<script>
    $('.all-categories').hover(function(){
            $(".left-home").slideDown(1000);
            $(".ads-top").attr("style", "margin-top: 10px; display: block !important;");
            $('.left-home').hover(
                function(){
                $(".left-home").show();
                },
                function(){
                    $(".left-home").slideUp(1000);
                    $(".ads-top").attr("style", "margin-top: 495px; display: block !important;");
            });
        });
</script>
