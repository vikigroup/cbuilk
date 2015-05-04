<div class="block_ct">                    

    <div class="news">
        <h1 class="title_news">
            <span> <?php echo module_keyword($mang11,$mang22,"box_news");?> </span>
        </h1><!-- End .title_news -->
        <div class="main_news">
            <ul>
            <?php 
			$new=get_records("tbl_item","status=0 and cate=1 AND idshop='{$idshop}' ","id DESC","0,5"," ");
			while($row_new=mysql_fetch_assoc($new)){
			?>
                <li>
                    <a href="<?php echo $row_cate['subject']?>.html" title="" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_cate['name'];?></a>
                </li>
             <?php }?>  
               
            </ul>
        </div><!-- End .main_news -->
    </div><!-- End .news -->

</div><!-- End .block_ct -->