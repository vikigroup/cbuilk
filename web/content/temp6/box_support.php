<div class="support_online_w">
    <?php echo module_keyword($mang11,$mang22,"support");?>
    <span class="arrow_spo"></span>
    <div class="frame_hotline_sow">
        <ul>
        <?php
        $cate=get_records("tbl_support","status=0 AND idshop='{$idshop}' "," "," "," ");
        while($row_cate=mysql_fetch_assoc($cate)){
        ?>
            <li>
                <img src='http://opi.yahoo.com/online?u=<?php echo $row_cate['nickyahoo'];?>&m=g&t=5&l=vi' alt ='' />
                <a href='ymsgr:sendIM?<?php echo $row_cate['nickyahoo'];?>'><?php echo $row_cate['name'];?></a>
            </li>
         <?php }?>    
        </ul>
    </div><!-- End .frame_hotline_sow -->
</div>