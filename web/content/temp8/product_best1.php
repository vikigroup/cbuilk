<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
        <?php echo module_keyword($mang11,$mang22,"product_best");?>
	</h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
        
        <div class="prod_mau_gh">
            <ul>
			<?php
            $sl=get_field("tbl_module","idshop",$row_shop['id'],"sl1");
            if($sl=="") $sl=8;
            $new=get_records("tbl_item","status=0 AND idshop='{$idshop}' AND hot=1  and cate=0","id DESC"," "," ");
            $dem=1;
            while($row_new=mysql_fetch_assoc($new)){
            ?>                
            <li>
                	<div class="frame_img_dm">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
                                    <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                                       
                    <h2 class="title_prod_news">
                      <a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_new['name']?></a>
                    </h2>
                    <h4 class="price_prod_mau_gh" title="<?php echo $row_new['name'];?>"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?></h4>
                </li>
           <?php } ?>   
                <div class="clear"></div>
            </ul>
        </div><!-- End .prod_mau_gh -->
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
       
    </div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->