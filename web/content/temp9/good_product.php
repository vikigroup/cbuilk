<style>
	.sp_xn_style{width:100%;}
	.sp_xn_style td{width:100%; height:100%; vertical-align:middle; text-align:center;}
	.sp_xn_style td img{max-width:188px; max-height:165px;}
</style>
<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
        Sản phẩm xem nhiều
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
        <div class="sp_mau_gh">
            <ul id="ticker_03">
			<?php
            $new=get_records("tbl_item","status=0 AND cate=0 AND idshop='{$idshop}' "," ","0,4"," ");
            while($row_new=mysql_fetch_assoc($new)){
            ?>
            
                <li>
                	<table class="sp_xn_style" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td>
                                <a href="/<?php echo $row_new['subject']?>.html" title="">
                                	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                </a>              
                            </td>
                        </tr>
                    </table>      
                    <h2 class="title_prod_news" align="center">
                       <a href="/<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </h2>
                    <h4 align="center" class="price_prod_mau_gh" title="<?php echo $row_new['price'];?>"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo $row_new['price']; ?></h4>
                </li>
         <?php } ?>              
               
            </ul>
        </div><!-- End .sp_mau_gh -->
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->