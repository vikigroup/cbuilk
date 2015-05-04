<style>

</style>
<div class="menu_main">
    <ul>
        <li class="active_m"><a href="" title=""><?php echo module_keyword($mang11,$mang22,"home");?></a></li>
        <li><img src="skin/temp<?php echo $url;?>/imgs/layout/line_menu.jpg" alt=""/></li>

        <li><a href="#" title=""><?php echo module_keyword($mang11,$mang22,"products");?></a>
            <ul class="menu_child">
            <?php
			$cate=get_records("tbl_item_category","status=0 AND cate=0 AND parent=2 AND idshop='".$idshop."'"," "," "," ");
			while($row_cate=mysql_fetch_assoc($cate)){
			?>
                <li><a href="/<?php echo $row_cate['subject']?>.html" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>
                	<?php 
					$cate1=get_records("tbl_item_category","status=0 AND cate=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
					$sl=mysql_num_rows($cate1);
					if($sl>0 && 1>2){
					?>
                    <ul class="menu_child">
						<?php
                        while($row_cate1=mysql_fetch_assoc($cate1)){
                        ?>
                        <li><a href="/<?php echo $row_cate1['subject']?>.<?php echo $row_cate['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
                        <?php } ?>
                    </ul><!-- End .menu_2_child -->
                    <?php }?>
                </li>
           <?php } ?>     
                
            </ul><!-- End .menu_child -->
        </li>
        <li><img src="skin/temp<?php echo $url;?>/imgs/layout/line_menu.jpg" alt=""/></li>
        
        <?php
        $news=get_records("tbl_item_category","status=0 AND parent=2 and cate=1 AND idshop='{$idshop}' "," "," "," ");
        while($row_news=mysql_fetch_assoc($news)){
        ?>
        <li>
            <a href="<?php if($row_news['link']==""){?><?php echo $row_news['subject'];?>.html<?php }else{?><?php echo $row_news['link'];?><?php }?>" title=""><?php echo $row_news['name'];?></a>
            <?php 
            $cate1=get_records("tbl_item_category","status=0 AND cate=1 AND parent='".$row_news['id']."' AND idshop='".$idshop."'"," "," "," ");
            $sl=mysql_num_rows($cate1);
            if($sl>0){
            ?>
            <ul class="menu_child">
                <?php
                while($row_cate1=mysql_fetch_assoc($cate1)){
                ?>
                <li><a href="/<?php echo $row_cate1['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
                <?php } ?>
            </ul><!-- End .menu_2_child -->
            <?php }?>
        </li>
        <li><img src="skin/temp<?php echo $url;?>/imgs/layout/line_menu.jpg" alt=""/></li>
       	<?php }?>
        
        <li><a href="lien-he.html" title="">liên hệ</a></li>
        <li><img src="skin/temp<?php echo $url;?>/imgs/layout/line_menu.jpg" alt=""/></li>
    </ul>
    
    <div class="clear"></div> 
    
    <div class="search_m">
    	<form name="frmSearch" id="frmSearch" method="post" action="xu-ly.html" enctype="multipart/form-data" >
            <input id="keyword" name="keyword" class="ipt_s" type="text" value="Nhập từ khóa cần tìm..." onfocus="if(this.value=='Nhập từ khóa cần tìm...') this.value='';" onblur="if(this.value=='') this.value='Nhập từ khóa cần tìm...';"/>
            <input class="sub_s" type="submit" value="&nbsp;" />
        </form>
    </div><!-- End .search_m -->
    
</div><!-- End .menu_main -->