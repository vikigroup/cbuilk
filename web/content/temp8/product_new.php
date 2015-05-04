<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
        <?php echo module_keyword($mang11,$mang22,"product_new");?>
	</h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
                
        <div class="product_t_t">
        		<?php
				$sl=get_field("tbl_module","idshop",$row_shop['id'],"sl1");
				if($sl=="") $sl=6;
				$new=get_records("tbl_item","status=0 AND cate=0 AND idshop='{$idshop}'  and cate=0","id DESC","0,".$sl," ");
				$dem=1;
				while($row_new=mysql_fetch_assoc($new)){
				?>
                <div class="m_upsp">
                    <div class="space_img_sp">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>"  >
                        	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                        </a>
                    </div><!-- End .space_img_sp -->
                    <h4 class="name_prod">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>"  ><?php echo $row_new['name']?></a>
                    </h4>
                    <p><a title="<?php echo $row_new['name']?>" href="/<?php echo $row_new['subject']?>.html" target="_blank" class="t_shop_n"><?php echo $row_new['date_added']?></a></p>
                    <span class="price_prod"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
                </div>
                 <?php } ?>  
                
                <div class="clear"> </div>
         </div>
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
        
    </div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->