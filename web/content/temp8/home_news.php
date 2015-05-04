<div class="frame_product_mau_gh">
	<h2 class="title_f_p_m_gh">
		<?php echo module_keyword($mang11,$mang22,"home_news");?>
	</h2><!-- End .title_f_p_m_gh -->
	<div class="main_f_p_m_gh">
		<?php 
        $new=get_records("tbl_item","status=0 AND cate=1 AND idshop='{$idshop}' and hot=1 ","id DESC","0,5"," ");
        $row_new=mysql_fetch_assoc($new)
        ?>
		<div class="news_mau_gh">
			<span class="img_gy_news">
			 <a title="" href="<?php echo $row_new['subject']?>.html"><img alt="" src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>"></a>                            
			</span>
			<div class="nd_news">
				<h2><a href="<?php echo $row_new['subject']?>.html" title=""> <?php echo $row_new['name']?> </a> </h2>
				<p>
					<?php echo catchuoi_tuybien($row_new['detail_short'],40)?>  
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
                            
                        </li>
                    <?php } ?>
                    </ul>
			</div><!-- End .news_other_mau_gh -->
		</div><!-- End .news_mau_gh -->

		
	</div><!-- End .main_f_p_m_gh -->
	<div class="footer_f_p_m_gh"></div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->