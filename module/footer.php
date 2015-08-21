<footer>
<div class="m-wrap">
    <div class="i-foot">
        <div class="bg-ifoot">
            <ul class="ul-ifoot">
                <li>
                    <h4 class="t-ifoot">Giới thiệu</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result1 = get_records("viki_tin","status = 0 AND pos = 1","sort, date_added DESC"," "," ");
                            while($row_result1 = mysql_fetch_assoc($result1)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result1['subject'];?>.html"><?php echo $row_result1['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người bán</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result2 = get_records("viki_tin","status = 0 AND pos = 2","sort, date_added DESC"," "," ");
                            while($row_result2 = mysql_fetch_assoc($result2)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result2['subject'];?>.html"><?php echo $row_result2['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người mua</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result3 = get_records("viki_tin","status = 0 AND pos = 3","sort, date_added DESC"," "," ");
                            while($row_result3 = mysql_fetch_assoc($result3)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result3['subject'];?>.html"><?php echo $row_result3['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
                <li>
                    <h4 class="t-ifoot">Hỗ trợ trực tuyến</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <?php
                            $result4 = get_records("viki_tin","status = 0 AND pos = 4","sort, date_added DESC"," "," ");
                            while($row_result4 = mysql_fetch_assoc($result4)){
                            ?>
                            <li><a href="<?php echo $root; ?>/thong-tin/<?php echo $row_result4['subject'];?>.html"><?php echo $row_result4['name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
            </ul>
            <div class="clear"></div>
        </div><!-- End .bg-ifoot -->
    </div><!-- End .i-foot -->
    
    <div class="text-foot">
        <span>Bản quyền © 2015  <b> <a href="http://<?php echo $sub; ?>/"><?php echo $sub; ?></a></span><br/>
        <span><?php echo get_field('tbl_config','id',2,'tenkh'); ?></span><br/>
        <span>Trụ sở: <?php echo get_field('tbl_config','id',2,'dckh'); ?></span><br/>
        <span>Giấy phép: <?php echo get_field('tbl_config','id',2,'faxkh'); ?></span><br/>
        <?php if(get_field('tbl_config','id',2,'contentkh') != ''){ ?>
            <span>Chịu trách nhiệm nội dung: <?php echo get_field('tbl_config','id',2,'contentkh'); ?></span><br/>
        <?php } ?>
        <br/>
        <p>
            <a <?php if(get_field('tbl_shop_category','id',458,'target') == 1){echo 'target="_blank"';}; ?> href="<?php if(get_field('tbl_shop_category','id',458,'other_link') != ''){echo get_field('tbl_shop_category','id',458,'other_link');}else{echo $root.'/'.get_field('tbl_shop_category','id',458,'subject').'.html';} ?>">
                <span class="hotline"><?php echo get_field('tbl_shop_category','id',458,'name'); ?></span>
            </a>
        </p>
    </div><!-- End .text-foot -->
</div><!-- End .m-wrap -->
</footer>
