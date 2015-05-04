<div class="slider_m">
    <ul id="sld_m">
		<?php
        $gt=get_records("tbl_slider","status=0 AND idshop='{$idshop}'"," ","0,6"," ");
        while($row_slide=mysql_fetch_assoc($gt)){
        ?>
        <li><a href="<?php echo $row_slide['link']?>" target="_blank"><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt=""/></a></li>
        <?php } ?>
    </ul>
</div><!-- End .slider_m -->