<article class="search_top_header">
    <form action="<?php echo $linkrootshop ;?>/xu-ly.html" method="post">
        <div class="select_item_search">
            <span class="sp1_select">
                <select class="select22" name="loai" id="loai">
                    <option value="tat-ca">Tất cả</option>
					<?php
                    $cate=get_records("tbl_shop_category","status=0 AND  parent=2"," "," "," ");
                    while($row_cate=mysql_fetch_assoc($cate)){
                    ?>
                    <option value="<?php echo $row_cate['id'];?>"><?php echo $row_cate['name'];?></option>
                    <?php }?>
                </select>
            </span>
        </div><!-- End .select_item_search -->
        <div class="select_input_search">
            <input name="keyword" id="keyword" class="ipt_s" type="text" placeholder="Bạn tìm kiếm điều gì..."/>
        </div><!-- End .select_input_search -->
        <button class="btn_s" type="submit" id="btnSearchTopHeader"><i class='fa fa-search fa-lg'></i></button>
        <div class="clear"></div>
        </form>
</article><!-- End .search_top_header -->
