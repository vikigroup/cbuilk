<article class="l-tool-ct all-categories">
    <ul class="ul-ltct">
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/xem-tat-ca.html"><i class="fa fa-arrow-circle-o-down fa-lg"></i>Danh mục sản phẩm</a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $old=getRecord('tbl_shop_category', "id=210"); ?>
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/<?php echo $old['subject']; ?>.html"><?php echo $old['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $rent=getRecord('tbl_shop_category', "id=209"); ?>
        <li><a class="btn-gh3" href="<?php echo $linkrootshop?>/<?php echo $rent['subject']; ?>.html"><?php echo $rent['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $news=getRecord('tbl_shop_category', "id=211"); ?>
<li><a class="btn-gh3" href="<?php echo $linkrootshop; ?>/<?php echo $news['subject']; ?>.html"><?php echo $news['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $video=getRecord('tbl_shop_category', "id=390"); ?>
        <li><a class="btn-gh3" href="<?php echo $linkrootshop; ?>/<?php echo $video['subject']; ?>.html"><?php echo $video['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category">
    <ul class="ul-ltct">
        <?php $note=getRecord('tbl_shop_category', "id=391"); ?>
        <li><a class="btn-gh3" href="<?php echo $linkrootshop; ?>/<?php echo $note['subject']; ?>.html"><?php echo $note['name']; ?></a></li>
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
