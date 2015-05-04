<div class="dmmn">

    <h5 class="title_dmmn">
        <?php echo module_keyword($mang11,$mang22,"menu_left");?> 
        <div class="arrown_bottom2"></div>
    </h5><!-- End .title_dmmn -->

    <div class="main_dmmn">
        
        <ul>
			<?php
            $cate=get_records("tbl_item_category","status=0 and cate=0 AND idshop='{$idshop}' AND  parent=2"," "," "," ");
            while($row_cate=mysql_fetch_assoc($cate)){
            ?>
                <li>
                	<a href="/<?php echo $row_cate['subject']?>.html" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?> </a>
                </li>
            <?php }?>   
            
        </ul>
        
    </div><!-- End .main_dmmn -->

</div><!-- End .dmmn -->