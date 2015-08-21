<article class="l-tool-ct all-categories l-system" id="l-system1">
    <ul class="ul-ltct">
        <li>
            <a class="btn-gh3" style="float: left;" href="<?php echo $linkrootshop?>/tat-ca-danh-muc.html">
                <i class="fa fa-bars fa-lg"></i>
                Tất cả danh mục
            </a>
        </li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category l-system" id="l-system2">
    <ul class="ul-ltct">
        <?php $old = getRecord('tbl_shop_category', "id=210"); ?>
        <li><a <?php if($old['target'] == 1){echo 'target="_blank"';} ?> class="btn-gh3 btn-category" href="<?php if($old['other_link'] != ''){echo $old['other_link'];}else{echo $root.'/'.$old['subject'].'.html';} ?>"><?php echo $old['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category l-system" id="l-system3">
    <ul class="ul-ltct">
        <?php $rent = getRecord('tbl_shop_category', "id=209"); ?>
        <li><a <?php if($rent['target'] == 1){echo 'target="_blank"';} ?> class="btn-gh3 btn-category" href="<?php if($rent['other_link'] != ''){echo $rent['other_link'];}else{echo $root.'/'.$rent['subject'].'.html';} ?>"><?php echo $rent['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category l-system" id="l-system4" style="background-color: #2A70D2;">
    <ul class="ul-ltct">
        <?php $news = getRecord('tbl_shop_category', "id=211"); ?>
        <li><a style="color: #ffffff !important;" <?php if($news['target'] == 1){echo 'target="_blank"';} ?> class="btn-gh3 btn-category" href="<?php if($news['other_link'] != ''){echo $news['other_link'];}else{echo $root.'/'.$news['subject'].'.html';} ?>"><?php echo $news['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category l-system" id="l-system5">
    <ul class="ul-ltct">
        <?php $video = getRecord('tbl_shop_category', "id=390"); ?>
        <li><a <?php if($video['target'] == 1){echo 'target="_blank"';} ?> class="btn-gh3 btn-category" href="<?php if($video['other_link'] != ''){echo $video['other_link'];}else{echo $root.'/'.$video['subject'].'.html';} ?>"><?php echo $video['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category l-system" id="l-system6">
    <ul class="ul-ltct">
        <?php $accessory = getRecord('tbl_shop_category', "id=500"); ?>
        <li><a <?php if($accessory['target'] == 1){echo 'target="_blank"';} ?> class="btn-gh3 btn-category" href="<?php if($accessory['other_link'] != ''){echo $accessory['other_link'];}else{echo $root.'/'.$accessory['subject'].'.html';} ?>"><?php echo $accessory['name']; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="l-tool-ct primary-category menu-category">
    <ul class="ul-ltct">
        <ul id="menu">
            <li><a href="<?php echo $root; ?>/tat-ca-danh-muc.html">Tất cả danh mục</a></li>
            <li><a href="<?php echo $root; ?>/<?php echo $old['subject']; ?>.html"><?php echo $old['name']; ?></a></li>
            <li><a href="<?php echo $root; ?>/<?php echo $rent['subject']; ?>.html"><?php echo $rent['name']; ?></a></li>
            <li><a href="<?php echo $root; ?>/<?php echo $news['subject']; ?>.html"><?php echo $news['name']; ?></a></li>
            <li><a href="<?php echo $root; ?>/<?php echo $video['subject']; ?>.html"><?php echo $video['name']; ?></a></li>
            <li><a href="<?php echo $root; ?>/<?php echo $accessory['subject']; ?>.html"><?php echo $accessory['name']; ?></a></li>
            <?php if($_SESSION['kh_login_username'] == ""){?>
            <li><a href="#" class="menu-shop" onclick="confirmRegisterShop('<?php echo $_SESSION['kh_login_username']; ?>');">Bán hàng cùng <?php echo ucfirst($subname); ?></a></li>
            <?php } ?>
        </ul>
    </ul>
    <div class="clear"></div>
</article><!-- End .l-tool-ct -->

<article class="r-tool-ct l-system" id="l-system7">
    <ul>
        <li><a class="btn-gh3" href="#" onclick="confirmRegisterShop('<?php echo $_SESSION['kh_login_username']; ?>');"><i class="fa fa-home fa-lg"></i>Bán hàng cùng <?php echo $subname; ?></a></li>
    </ul>
    <div class="clear"></div>
</article><!-- End .r-tool-ct -->

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
