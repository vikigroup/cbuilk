

    <div class="title_frame_main_text">
        <?php echo module_keyword($mang11,$mang22,"product_home");?>
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
                    
        <ul class="psp_ul psp_ul3">
        <?php
        $new=get_records("tbl_item","status=0 AND cate=0 AND idshop='{$idshop}' "," "," "," ");
        $dem=1;
        while($row_new=mysql_fetch_assoc($new)){
        ?>
            <li>
                <div class="frame_b_img">
                
                    <div class="img_khung">
                        <table>
                            <tr>
                                <td>
                                    <a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
                                    	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div><!-- End .img_khung -->
                    
                    <p>
                         <a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_new['name']?></a>
                    </p>
                    
                    <span>
                        <?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?>
                    </span>
                    
                    <a class="readmode_w" href="<?php echo $row_new['subject']?>.html" title=""></a>
                    
                </div><!-- End .frame_b_img -->
            </li>
            <?php $dem++;}?>  
           
        </ul><!-- End #psp_ul3 -->
        
        <div class="clear"></div>
        <br />
        
        
        
    </div><!-- End .main_frame_main_text -->
    
