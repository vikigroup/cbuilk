<footer>
<div class="m-wrap">
    
    <div class="i-foot">
        <div class="bg-ifoot">
            <ul class="ul-ifoot">
                <li>
                    <h4 class="t-ifoot">Giới thiệu</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',1,'subject');?>.html"><?=get_field('jbs_tin','id',1,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',2,'subject');?>.html"><?=get_field('jbs_tin','id',2,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',3,'subject');?>.html"><?=get_field('jbs_tin','id',1,'name');?></a></li>  
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người bán</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                             <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',6,'subject');?>.html"><?=get_field('jbs_tin','id',6,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',7,'subject');?>.html"><?=get_field('jbs_tin','id',7,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',8,'subject');?>.html"><?=get_field('jbs_tin','id',8,'name');?></a></li>  
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>                    
                <li>
                    <h4 class="t-ifoot">Dành cho người mua</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="news">
                             <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',9,'subject');?>.html"><?=get_field('jbs_tin','id',9,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',10,'subject');?>.html"><?=get_field('jbs_tin','id',10,'name');?></a></li>
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',11,'subject');?>.html"><?=get_field('jbs_tin','id',11,'name');?></a></li> 
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
                <li>
                    <h4 class="t-ifoot">Hỗ trợ trực tuyến</h4><!-- End .t-ifoot -->
                    <div class="m-ifoot">
                        <ul class="yahoo">
                        <?php
						$gt=get_records("tbl_support","status=0 and idshop=0"," ","0,20"," ");
						while($row_slide=mysql_fetch_assoc($gt)){
						?>
                            <li>
                                <div class="l-yahoo">
                                    <a href="ymsgr:sendIM?<?=$row_slide['name']?>"><?=$row_slide['name']?></a>
                                </div>
                                <div class="r-yahoo">
                                    <a href="ymsgr:sendIM?<?=$row_slide['name']?>"><img src='http://opi.yahoo.com/online?u=<?=$row_slide['name']?>&m=g&t=1&l=vi' alt ='<?=$row_slide['name']?>' /></a>
                                </div>
                                <div class="clear"></div>
                            </li>
                       <?php }?>      
                             
                             
                        </ul>
                    </div><!-- End .m-ifoot -->
                </li>
            </ul>
            <div class="clear"></div>
        </div><!-- End .bg-ifoot -->
    </div><!-- End .i-foot -->
    
    <div class="text-foot">
        Bản quyền © 2014  <b> <?php echo   str_replace("http://", "", $linkrootshop);?> </b> - Bản quyền được bảo vệ<br>
        Website đang hoạt động thử nghiệm
    </div><!-- End .text-foot -->
    
</div><!-- End .m-wrap -->
</footer>