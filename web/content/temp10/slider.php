<div class="slider">
    <div class="frame_slider">
		<?php
        $gt=get_records("tbl_slider","status=0 AND idshop='{$idshop}'"," ","0,6"," ");
        while($row_slide=mysql_fetch_assoc($gt)){
        ?>
        <div><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt=""/></div>
        <?php } ?>
    </div>
    <div class="clear"></div>
</div><!-- End .slider -->