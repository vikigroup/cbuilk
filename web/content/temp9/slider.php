<div class="slide_mau_g">
    <ul id="slider1" class="multiple">
		<?php
        $gt=get_records("tbl_slider","status=0 AND idshop='{$idshop}'"," ","0,6"," ");
        while($row_slide=mysql_fetch_assoc($gt)){
        ?>
        
        <li><img src="<?php echo $linkroot ;?>/<?php echo $row_slide['image']?>" alt="<?php echo $row_slide['name']?>"/></li>
        <?php 
        }
        ?>
       
    </ul>
</div> 