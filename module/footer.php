<div class="light" id="lightConfirm">
    <div class="lightTitle">
        <p class="pTitle">THÔNG BÁO</p>
        <div id="divConfirm"></div>
    </div>
    <p class="pCloseConfirm" onclick='lightbox_close("lightConfirm", "fadeConfirm");'>Đóng cửa sổ</p>
</div>
<div class="fade" id="fadeConfirm"></div>
<div class="clear"></div>
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
                            <li><a href="<?php echo $linkrootshop?>/thong-tin/<?=get_field('jbs_tin','id',3,'subject');?>.html"><?=get_field('jbs_tin','id',3,'name');?></a></li>
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
                                    <span><?=$row_slide['name']?></span>
                                </div>
                                <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
                                <div id="SkypeButton" class="r-yahoo">
                                    <script type="text/javascript">
                                        Skype.ui({
                                            "name": "chat",
                                            "element": "SkypeButton",
                                            "participants": ["<?=$row_slide['nickyahoo']?>"],
                                            "imageSize": 22
                                        });
                                    </script>
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
        <span>Bản quyền © 2015  <b> <a href="http://<?php echo $sub; ?>/"><?php echo $sub; ?></a></span><br/>
        <span><?php echo get_field('tbl_config','id',2,'tenkh'); ?></span><br/>
        <span>Trụ sở: <?php echo get_field('tbl_config','id',2,'dckh'); ?></span><br/>
        <span>Giấy phép: <?php echo get_field('tbl_config','id',2,'faxkh'); ?></span><br/>
        <?php if(get_field('tbl_config','id',2,'contentkh') != ''){ ?>
            <span>Chịu trách nhiệm nội dung: <?php echo get_field('tbl_config','id',2,'contentkh'); ?></span><br/>
        <?php } ?>
        <br/>
        <p><a href="<?php echo $root; ?>/<?php echo get_field('tbl_shop_category','id',458,'subject'); ?>.html"><span class="hotline">QUẢNG CÁO</span></a></p>
    </div><!-- End .text-foot -->
</div><!-- End .m-wrap -->
</footer>
