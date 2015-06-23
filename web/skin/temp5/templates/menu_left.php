<div class="cate_dmsp space_bottom">
    <h1 class="title_rso">Danh mục sản phẩm</h1>
    <div class="main_rso">
        <ul>
		<?php
        $cate=get_records("tbl_item_category","status=0 AND idshop='{$idshop}' AND  parent=2"," "," "," ");
        while($row_cate=mysql_fetch_assoc($cate)){
        ?>
            <li>
                 <a href="danh-muc/<?php echo $row_cate['subject']?>.html" title=""><?php echo $row_cate['name'];?></a>
                <?php 
                    $cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
                    $sl=mysql_num_rows($cate1);
                    if($sl>0){
                    ?>
                    <ul class="dmsp_child">
                    <?php
                    while($row_cate1=mysql_fetch_assoc($cate1)){
                    ?>
                        <li><a href="danh-muc/<?php echo $row_cate1['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
                    <?php } ?>
                    </ul><!-- End .dmsp_child -->
                     <?php }?>
            </li>
         <?php }?>   
            
        </ul>
    </div>
</div><!-- End .cate_dmsp -->