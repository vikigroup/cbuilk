<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a title="<?php echo $row_sanpham['title'];?>">Tất cả danh mục</a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->
<section class="list-cate">
    <input type="hidden" id="hiddenScrollTop" value="0">
    <div class="l-list">
        <?php
        $cateNum = 1;
        $cate = get_records("tbl_shop_category","status=0 AND  parent=2","sort, name COLLATE utf8_unicode_ci","0,6"," ");
        while($row_cate=mysql_fetch_assoc($cate)){ ?>
        <div class="divMainCategory" id="divMainCategory<?php echo $cateNum; ?>" onclick="moveToMainCategory(this.id, '<?php echo $row_cate['subject']; ?>'); scrollTopDesc();">
            <div class="divMainCategoryContents">
                <div class="divMainImage"><img src="<?php echo $root; ?>/web/<?php if($row_cate['image'] != ''){echo $row_cate['image'];}else{echo '/images/item_noimage.png';} ?>"></div>
                <div class="divMainName"><span><?php echo $row_cate['name']; ?></span></div>
            </div>
        </div>
        <?php $cateNum++;} ?>
    </div><!-- End .t-mn-dm -->
    <div class="clear"></div>
    <div class="f-list">
        <?php
        $cate = get_records("tbl_shop_category","status=0 AND  parent=2","sort, name COLLATE utf8_unicode_ci"," "," ");
        $k = 1;
        $h = 1;
        while($row_cate = mysql_fetch_assoc($cate)){ ?>
        <div class="divMainSubCategory" id="<?php echo $row_cate['subject']; ?>">
            <input type="hidden" id="hiddenMainSubCategory" value="<?php echo $k; ?>">
            <div class="divMainImage"><img src="<?php echo $root; ?>/web/<?php if($row_cate['image'] != ''){echo $row_cate['image'];}else{echo '/images/item_noimage.png';} ?>"></div>
            <div class="divMainSubCategoryTitle"><h3><a href="<?php echo $root; ?>/<?php echo $row_cate['subject']; ?>.html"> <?php echo $row_cate['name']; ?> </a></h3></div>
            <?php $subCate = get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'","sort, name COLLATE utf8_unicode_ci"," "," ");
            $m = 1;
            while($row_subCate = mysql_fetch_assoc($subCate)){ ?>
            <div class="divMainSubCategoryName" id="divMainSubCategoryName<?php echo $h; ?>">
                <a class="main_subCategory" href="<?php echo $root; ?>/<?php echo $row_subCate['subject']; ?>.html"><?php echo $row_subCate['name']; ?></a>
                <span class="main_total_items">(<?php echo count_items($row_subCate['id']); ?>)</span>
                <div class="clear"></div>
                <?php $subSubCate = get_records("tbl_shop_category","status=0 AND parent='".$row_subCate['id']."'","sort, name COLLATE utf8_unicode_ci","0,20"," ");
                $num_rows = count_category($row_subCate['id']);
                $i = 1;
                while($row_subSubCate = mysql_fetch_assoc($subSubCate)){ ?>
                    <?php if($i <= 20){ ?>
                    <div class="divMainLastCategoryName">
                        <a href="<?php echo $root; ?>/<?php echo $row_subSubCate['subject']; ?>.html"><?php echo $row_subSubCate['name']; ?></a>
                    </div>
                    <?php } ?>
                    <?php if($i == 20 && $num_rows > 20){ ?>
                    <div class="clear"></div>
                        <input type="hidden" id="hiddenMainSubCategoryLoadMore<?php echo $h; ?>" value="1">
                    <div class="divMainSubCategoryLoadMore" id="divMainSubCategoryLoadMore<?php echo $h; ?>"><a class="button-transparent pure-button" onclick="loadMoreMainSubCategory('<?php echo $row_subCate['id']; ?>','<?php echo $h; ?>');">&#187; Tải thêm</a></div>
                    <?php } ?>
                <?php $i++; } ?>
            </div>
            <?php if($m % 2 == 0){ ?>
                <div class="clear"></div>
            <?php } ?>
            <?php $h++; $m++; } ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <?php $k++; } ?>
    </div><!-- End .f-list -->
    <div class="r-list"><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',7,'subject');?>.html"><img src="<?php echo $linkrootshop?>/imgs/chinhsachbanhang.png"></a></div>
    <div class="clear"></div>
</section>
<div class="r-cate">
    <div class="r-title">
        <h2>Những sản phẩm có thể bạn quan tâm</h2>
    </div>
    <div class="r-products">
        <div class="r-center">
            <?php
            $interProducts = get_records("tbl_item","status=0 AND style=0","time_view DESC","0,5"," ");
            while($row=mysql_fetch_assoc($interProducts)){ ?>
            <div class="r-contents" onclick="window.location.href = '<?php echo $root; ?>/<?php echo $row['subject']; ?>.html'">
                <div class="r-image">
                    <img src="<?php echo $root; ?>/web/<?php echo $row['image']; ?>">
                </div>
                <div class="r-contents-title">
                    <p><?php echo $row['name']; ?></p>
                </div>
            </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $(window).scroll(function(){
            if($(window).width() > 991){
                if($(document).scrollTop() > 60) {
                    $('.menu').css('position', 'absolute');
                    $('.l-list').css('position', 'fixed');
                    $('.l-list').css('top', '0');
                    $('.divMainCategory').css("background-color", '#ffffff');
                }else{
                    $('.menu').css('position', 'fixed');
                    $('.l-list').css('position', 'initial');
                    $('.l-list').css('top', 'initial');
                    $('#hiddenScrollTop').val('0');
                    $('.divMainCategory').css("background-color", 'initial');
                }
            }
        });
    });
</script>
