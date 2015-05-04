<div>

    <h1 class="title_cnt">
         <?php echo module_keyword($mang11,$mang22,"products");?>  <?php echo $row_shop['name'];?>
    </h1><!-- End .title_cnt -->
    
    <div class="main_cnt">
        <ul>
			<?php
            $new=get_records("tbl_item","status=0 AND cate=0 AND idshop='{$idshop}' ","id DESC","0,22"," ");
            while($row_new=mysql_fetch_assoc($new)){
            ?>
            <li>
                <div class="space_img">
                    <a href="/<?php echo $row_new['subject']?>.html" title="">
                    	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                    </a>
                </div><!-- End .space_img -->
                <div class="space_text">
                    <h4>
                        <a href="/<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </h4>
                    <p>
                        <?php echo catchuoi_tuybien(strip_tags($row_new['detail_short']),15);?> 
                    </p>
                </div><!-- End .space_text -->
                <div class="clear"></div>
            </li>
           <?php }?> 
            
        </ul>
        <div class="clear"></div>
    </div><!-- End .main_cnt -->
    
</div>