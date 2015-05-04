<div class="cate_w space_bottom">

    <div class="title_cate_w">
        <?php echo module_keyword($mang11,$mang22,"menu_left");?>
    </div><!-- End .title_cate_w -->
    
    <div class="main_cate_w">                        
        <ul>
        <?php
        $cate=get_records("tbl_item_category","status=0 AND idshop='{$idshop}' AND  parent=2"," "," "," ");
        while($row_cate=mysql_fetch_assoc($cate)){
        ?>
            <li>
                <a href="<?php echo $row_cate['subject']?>.html" title=""><?php echo $row_cate['name'];?></a>
				<?php 
                $cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
                $sl=mysql_num_rows($cate1);
                if($sl>0){
                ?>
                <ul class="dmsp_child">
                <?php
                while($row_cate1=mysql_fetch_assoc($cate1)){
                ?>
                    <li><a href="<?php echo $row_cate1['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
                <?php } ?>
                </ul><!-- End .dmsp_child -->
                 <?php }?>
               <!-- <span>(3)</span>-->
            </li>
        <?php }?>     
            
        </ul>
    </div><!-- End .main_cate_w -->
    
</div><!-- End .cate_w -->