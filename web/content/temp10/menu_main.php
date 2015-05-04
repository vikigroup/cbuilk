<div class="ul_menu">
    <ul class="ulmn">
        <li class="atv_mn"><a href="<?php echo $linkroot ;?>/<?php echo $shop;?>" title=""><span>trang chủ</span></a></li>
        <li><a title=""><span><?php echo module_keyword($mang11,$mang22,"products");?></span></a>
            <ul class="mn_child">
            <?php
			$cate=get_records("tbl_item_category","status=0 and cate=0 AND parent=2 AND idshop='".$idshop."'"," "," "," ");
			while($row_cate=mysql_fetch_assoc($cate)){
			?>
                <li><a href="<?php echo $row_cate['subject']?>/" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a></li>
             <?php } ?>    
            </ul><!-- End .mn_child -->
        </li>
        <?php
        $news=get_records("tbl_item_category","status=0 and cate=1 AND idshop='{$idshop}' "," "," "," ");
        while($row_news=mysql_fetch_assoc($news)){
        ?>
        <li><a  href="<?php if($row_news['link']==""){?><?php echo $row_news['subject'];?>/<?php }else{?><?php echo $row_news['link'];?><?php }?>"  title=""><span><?php echo $row_news['name'];?></span></a></li>
		<?php }?>

         <li><a href="lien-he.html" title=""><span><?php echo module_keyword($mang11,$mang22,"contact");?></span></a></li>
    </ul>
    <div class="clear"></div>
</div><!-- End .ul_menu -->