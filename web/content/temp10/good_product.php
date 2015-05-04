<div class="block_pd">
    <div class="prod_main">
        <h1 class="title_pdm">
            <span>SẢN PHẨM xem nhiều</span>
        </h1><!-- End .title_pdm -->
        <div class="main_pdm">
            <ul> 
			<?php
            $new=get_records("tbl_item","status=0 and cate=0 AND idshop='{$idshop}' ","view DESC"," "," ");
            while($row_new=mysql_fetch_assoc($new)){
            ?>
                <li>
                        <div class="space_img_pdm">
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo $row_new['subject']?>.html" title="" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
                                            <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div><!-- End .space_img_pdm -->
                        <div class="info_pdm">
                            <p><a href="<?php echo $row_new['subject']?>.html" title="" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_new['name']?></a></p>
                            <span>Giá: <?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?></span>
                        </div><!-- End .info_pdm -->
                    </li>
              <?php }?>       
            </ul>
            <div class="clear"></div>
        </div><!-- End .main_pdm -->
    </div><!-- End .prod_main -->
</div><!-- End .block_pd -->