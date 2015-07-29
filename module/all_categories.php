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
        $cate = get_records("tbl_shop_category","status=0 AND  parent=2","name COLLATE utf8_unicode_ci"," "," ");
        while($row_cate=mysql_fetch_assoc($cate)){ ?>
        <div class="divMainCategory" id="divMainCategory<?php echo $cateNum; ?>" onclick="moveToMainCategory(this.id, '<?php echo $row_cate['subject']; ?>'); scrollTopDesc();">
            <div class="divMainImage"><img src="<?php echo $root; ?>/web/<?php if($row_cate['image'] != ''){echo $row_cate['image'];}else{echo '/images/item_noimage.png';} ?>"></div>
            <div class="divMainName"><span><?php echo $row_cate['name']; ?></span></div>
        </div>
        <?php $cateNum++;} ?>
    </div><!-- End .t-mn-dm -->
    <div class="clear"></div>
    <div class="f-list">
        <?php
        $cate = get_records("tbl_shop_category","status=0 AND  parent=2","name COLLATE utf8_unicode_ci"," "," ");
        $k = 1;
        $h = 1;
        while($row_cate = mysql_fetch_assoc($cate)){ ?>
        <div class="divMainSubCategory" id="<?php echo $row_cate['subject']; ?>">
            <input type="hidden" id="hiddenMainSubCategory" value="<?php echo $k; ?>">
            <div class="divMainSubCategoryTitle"><h3><a href="<?php echo $root; ?>/<?php echo $row_cate['subject']; ?>.html"><?php echo $row_cate['name']; ?></a></h3></div>
            <?php $subCate = get_records("tbl_shop_category","status=0 AND parent='".$row_cate['id']."'","name COLLATE utf8_unicode_ci"," "," ");
            while($row_subCate = mysql_fetch_assoc($subCate)){ ?>
            <div class="divMainSubCategoryName" id="divMainSubCategoryName<?php echo $h; ?>">
                <a class="main_subCategory" href="<?php echo $root; ?>/<?php echo $row_subCate['subject']; ?>.html"><?php echo $row_subCate['name']; ?></a>
                <?php $subSubCate = get_records("tbl_shop_category","status=0 AND parent='".$row_subCate['id']."'","name COLLATE utf8_unicode_ci","0,6"," ");
                $num_rows = count_category($row_subCate['id']);
                $i = 1;
                while($row_subSubCate = mysql_fetch_assoc($subSubCate)){ ?>
                    <?php if($i <= 6){ ?>
                    <div class="divMainSubCategoryName">
                        <a href="<?php echo $root; ?>/<?php echo $row_subSubCate['subject']; ?>.html"><?php echo $row_subSubCate['name']; ?></a>
                    </div>
                    <?php } ?>
                    <?php if($i == 6 && $num_rows > 6){ ?>
                    <div class="clear"></div>
                        <input type="hidden" id="hiddenMainSubCategoryLoadMore<?php echo $h; ?>" value="1">
                    <div class="divMainSubCategoryLoadMore" id="divMainSubCategoryLoadMore<?php echo $h; ?>"><a class="button-success pure-button" onclick="loadMoreMainSubCategory('<?php echo $row_subCate['id']; ?>','<?php echo $h; ?>');">&#187; Tải thêm</a></div>
                    <?php } ?>
                <?php $i++; } ?>
            </div>
            <?php $h++; } ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <?php $k++; } ?>
    </div><!-- End .f-list -->
    <div class="clear"></div>
</section>
<script>
    $(function(){
        $(window).scroll(function(){
            if($(document).scrollTop() > 60) {
                $('.menu').css('position', 'absolute');
                $('.l-list').css('position', 'fixed');
                $('.l-list').css('top', '0');
            }else{
                $('.menu').css('position', 'fixed');
                $('.l-list').css('position', 'initial');
                $('.l-list').css('top', 'initial');
                $('#hiddenScrollTop').val('0');
            }
        });
    });
</script>
