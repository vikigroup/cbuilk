<div class="block_pd">
    <div class="prod_main">
        <h1 class="title_pdm">
            <span>SẢN PHẨM mới</span>
        </h1><!-- End .title_pdm -->
        <div class="main_pdm">
            <ul>
			<?php
            $sl=get_field("tbl_module","idshop",$row_shop['id'],"sl1");
            if($sl=="") $sl=8;
            $new=get_records("tbl_item","status=0 and cate=0 AND idshop='{$idshop}' ","id DESC","0,".$sl," ");
            $dem=1;
            while($row_new=mysql_fetch_assoc($new)){
            ?>
                <li>
                    <div class="space_img_pdm">
                        <table>
                            <tr>
                                <td>
                                     <a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
                                            <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                        </a>
                                </td>
                            </tr>
                        </table>
                    </div><!-- End .space_img_pdm -->
                    <div class="info_pdm">
                        <p><a href="<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a></p>
                        <span>Giá: <?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?></span>
                    </div><!-- End .info_pdm -->
                </li>
              <?php $dem++;}?>  
                 
            </ul>
            <div class="clear"></div>
        </div><!-- End .main_pdm -->
    </div><!-- End .prod_main -->
</div><!-- End .block_pd -->