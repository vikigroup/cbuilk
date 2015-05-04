<?php 
$new=get_records("tbl_other","status=0 AND cate=2 AND idshop='{$idshop}'","id DESC","0,5"," ");
?>
<div class="qc_tai">
	<div class="title_cate_w">
       <?php echo module_keyword($mang11,$mang22,"box_download");?>
    </div><!-- End .title_cate_w -->
    <div>
    	<div class="box_download_t">
        	<ul>
        	<?php
            while($row_new=mysql_fetch_assoc($new)){
            ?>
            <li>
            &nbsp; &nbsp; <a href="<?php echo $linkroot ;?>/<?php echo $row_new['image_large']?>" title=""> <?php echo catchuoi_tuybien($row_new['name'],5);?>  </a>
            </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>