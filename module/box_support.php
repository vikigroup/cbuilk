<article class="l-tool-ct">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/xem-tat-ca.html"><i class="fa fa-arrow-circle-o-down fa-lg"></i>Toàn bộ danh mục</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<script>
    $('.l-tool-ct').hover(function(){
            $(".left-home").slideDown(1000);
            $(".ads-top").attr("style", "margin-top: 0; display: block !important;");
            $('.left-home').hover(
                function(){
                $(".left-home").show();
                },
                function(){
                    $(".left-home").slideUp(1000);
                    $(".ads-top").attr("style", "margin-top: 480px; display: block !important;");
            });
        });
</script>
