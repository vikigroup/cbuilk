<div class="dmmn">

    <h5 class="title_dmmn">
         <?php echo module_keyword($mang11,$mang22,"box_news");?> 
        <div class="arrown_bottom2"></div>
    </h5><!-- End .title_dmmn -->

    <div class="main_dmmn">
        
        <ul>
			<?php
            $new=get_records("tbl_item","status=0 and cate=1 AND idshop='{$idshop}'","id DESC","0,10"," ");
            while($row_new=mysql_fetch_assoc($new)){
            ?>
                <li>
                	<a href="/<?php echo $row_new['subject']?>.html" title=""> <?php echo $row_new['name']?> </a> 
                </li>
            <?php }?>   
            
        </ul>
        
    </div><!-- End .main_dmmn -->

</div><!-- End .dmmn -->