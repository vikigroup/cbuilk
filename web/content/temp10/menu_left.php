
<?php
$cate=get_records("tbl_item_category","status=0 AND idshop='{$idshop}' AND  parent=2"," "," "," ");
while($row_cate=mysql_fetch_assoc($cate)){
?>
<div class="block_ct">
    <div class="product_m">
        <h1 class="title_pm">
            <a href="<?php echo $row_cate['subject']?>/" title=""><?php echo $row_cate['name'];?></a>
        </h1><!-- End .title_pm -->
        <div class="main_pm">
            <ul>
				<?php 
                $cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
                $sl=mysql_num_rows($cate1);
                if($sl>0){
                ?>
                <ul class="dmsp_child">
                <?php
                while($row_cate1=mysql_fetch_assoc($cate1)){
                ?>
                <li><a href="<?php echo $row_cate1['subject']?>/" title=""><?php echo $row_cate1['name'];?></a></li>
                <?php } ?>
                </ul><!-- End .dmsp_child -->
                <?php }?>
                
            </ul>
        </div><!-- End .main_pm -->
    </div><!-- End .product_m -->
</div><!-- End .block_ct -->
 <?php }?>

