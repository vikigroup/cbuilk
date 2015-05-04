<div class="support_onl">

    <h1 class="title_sport">
        <span>HOTLINE: <?php echo $row_shop['hotline'];?></span>
    </h1><!-- End .title_sport -->
    
    <div class="main_sport">
    
        <ul>
		<?php
        $cate=get_records("tbl_support","status=0 AND idshop='{$idshop}' "," "," "," ");
        while($row_cate=mysql_fetch_assoc($cate)){
        ?>
            <li>
                <a href='ymsgr:sendIM?<?php echo $row_cate['nickyahoo'];?>'>
                    <img src='http://opi.yahoo.com/online?u=<?php echo $row_cate['nickyahoo'];?>&m=g&t=1&l=vi' alt ='' />
                </a>
                <span><?php echo $row_cate['name'];?></span>
            </li>
         <?php }?>   
        </ul>
        
        <div class="clear"></div>
    
    </div><!-- End .main_sport -->
    
</div><!-- End .support_onl -->