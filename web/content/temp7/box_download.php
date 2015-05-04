<?php 
$new=get_records("tbl_other","status=0 AND cate=2 AND idshop='{$idshop}'","id DESC","0,5"," ");
?>
<div class="dmmn">

    <h5 class="title_dmmn">
        <?php echo module_keyword($mang11,$mang22,"box_download");?>
        <div class="arrown_bottom2"></div>
    </h5><!-- End .title_dmmn -->

    <div class="main_dmmn">
        
		<div class="box_download_t">
        	<?php
            while($row_new=mysql_fetch_assoc($new)){
            ?>
            <li>
            &nbsp; &nbsp; <a href="<?php echo $linkroot ;?>/<?php echo $row_new['image_large']?>" title=""> <?php echo catchuoi_tuybien($row_new['name'],5);?>  </a>
            </li>
            <?php } ?>
        </div>
        
    </div><!-- End .main_dmmn -->

</div><!-- End .dmmn -->