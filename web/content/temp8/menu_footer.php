
<div class="menu_footer">

    
        <span>
        	<a href="" title="">Trang chủ</a>    
        </span>
        <span>|</span>  
        
        <?php
        $cate=get_records("tbl_item_category","status=0 and cate=1 AND parent=2 AND idshop='".$idshop."'"," "," "," ");
        while($row_news=mysql_fetch_assoc($cate)){
        ?>
        <span>
        	<a href="<?php echo $row_news['subject'];?>.html" title=""><?php echo $row_news['name'];?></a>  
        </span>
        <span>|</span>  
		<?php }?>
        
        
        <span><a href="lien-he.html" title="">Liên hệ</a></span>

</div><!-- End .menu_mau_gh -->