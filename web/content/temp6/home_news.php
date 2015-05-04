

<div class="title_frame_main_text">
    <?php echo module_keyword($mang11,$mang22,"home_news");?>
</div><!-- End .title_frame_main_text -->

<div class="main_frame_main_text">
                
    <!-- End #psp_ul3 -->
    <div class="news_mau_gh">
            	<?php 
				$new=get_records("tbl_item","status=0 and cate=1 AND idshop='{$idshop}' and hot=1 ","id DESC","0,5"," ");
				$row_new=mysql_fetch_assoc($new)
				?>
                <span class="img_gy_news">
                      <a title="" href="<?php echo $row_new['subject']?>.html"><img alt="" src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>"></a>                            
                </span>
                <div class="nd_news">
                    <h2><a href="<?php echo $row_new['subject']?>.html" title=""> <?php echo $row_new['name']?> </a> </h2>
                    <p>
                       <?php echo catchuoi_tuybien($row_new['detail_short'],15)?>                             
                    </p>
                </div>
                <div class="clear"></div>
                <div class="news_other_mau_gh">
                    <ul>
                    <?php
					while($row_new=mysql_fetch_assoc($new)){
					?>
                        <li>
                        	<a href="<?php echo $row_new['subject']?>.html" title=""> -:- <?php echo $row_new['name']?> </a>
                            <!--onmouseout="AJAXHideTooltip();" onmouseover="AJAXShowToolTip('tootip/1127'); return false;"-->
                        </li>
                    <?php } ?>
                    </ul>
                </div><!-- End .news_other_mau_gh -->
            </div>
    <div class="clear"></div>
    <br />
    
    
    
</div><!-- End .main_frame_main_text -->

