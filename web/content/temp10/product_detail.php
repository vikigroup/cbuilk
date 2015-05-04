<?php
	$tensanpham=$_GET['tensanpham'];
	$sqlupdate="update tbl_item SET view=view+1 where subject='".$tensanpham."' and idshop='".$idshop."'";
  	mysql_query($sqlupdate);
			
	$rowtin=getRecord("tbl_item", "subject='".$tensanpham."' and status=0 and idshop='".$idshop."'");

    if($rowtin['id']=="") echo  '<script>window.location="'.'/404-page-not-found.html" </script>';
?>


<?php
if($rowtin['cate']==0){
?>
<script type="text/javascript">  
	$(document).ready(function() {										
		

		$(".adtocart").click(function(){;
		alert(" Thêm vào giỏ hàng thành công");; 
		var a;
		a=$(this).attr("value");
		var idtin=$("#idtin"+a).val();;
		var sl=$("#qty"+a).val();;
		var pri=$("#price"+a).val();;
		$(".box_shop_2").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin,function() {
			//window.location.reload();	
			});;
		});;
	});				
</script>

<div class="center_ct">

    <div class="frame_ndct">
        
        <h1 class="title_pdm">
            <span>Chi tiết sản phẩm</span>
        </h1><!-- End .title_pdm -->
        
        <div class="main_ndcc">
                
            <div class="news_frame">
            	
                <div class="box_detail_top">
                <div class="over_imgs_h">
                    <table>
                        <tbody>
                            <tr>
                                <td>
										<?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                                        <a href="<?php echo $linkroot ;?>/<?php echo $linkhinh?>" class="jqzoom" rel='gal1'  title="<?php  echo $rowtin['ten']?>" >
                                        <img class="abcdefffff" src="<?php echo $linkroot ;?>/<?php echo $linkhinh?>" alt=""/> 
                                        </a>
                                </td>
                            </tr>
                        </tbody>
					</table>
                </div>
                <div class="over_text_h">
                    <h2 class="detail_title_h"><?php echo $rowtin['name'];?></h2>
                    
                    <div style="margin:10px 0;border-bottom:1px solid #EEEEEE;padding:5px 0">
	      				<div class="col_1detail_h">
	        				Giá bán
	      				</div>
                        <div style="font-size: 11px;line-height: 16px;margin-bottom:10px;">
		          			<span class="price_sp_old_h">195.000</span>&nbsp;
							<b style="color: #969696;text-decoration: underline;font-size:13px;">d</b>
                            <span style="margin:0 10px;font-size:16px;">|</span>
		          			<span class="price_sp_h">295.000</span>&nbsp;
                            <b style="color: #AC0404;font-size: 14px;font-weight: bold;text-decoration: underline;">d</b>
							</span>
		        		</div>
                        
                        <table width="130px" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td valign="top">
                                    <input class="input_check_1" name="idtin<?=$dem;?>" id="idtin<?=$dem;?>" type="hidden" value="<?=$rowtin['id'];?>" />                            
                                    <input name="qty<?=$dem;?>" type="text" id="qty<?=$dem;?>" style="width:70px; height:24px;border:1px solid #ccc; float:left;" value="1"  >
                        		</td>
                        		<td valign="middle">
                                    <input name="addcart<?=$dem;?>" type="image" id="addcart<?=$dem;?>" src="skin/<?php echo $template;?>/imgs/layout/carti.jpg"  style="float:left;" width="35" height="26" class="adtocart" value="<?=$dem;?>" >
                                    <div class="clear"></div>
                        		</td>
                        	</tr>
                    	</table>
	    			</div>
                    
                    <p style="padding-bottom:8px;">
						
						<?php echo $rowtin['detail_short'];?>
					</p>
                </div>
                <div class="clear"></div>
            	</div>
    
                <br class="clear"> 
                
                <div>
                    <div class="title_ct_prod_details">Thông tin chi tiết sản phẩm</div>
                    <div>
						<?php 
                        echo  $rowtin['detail'];
                        $parent=$rowtin['parent'];
                        ?>  
                    </div>
                    
                </div>
                
            </div><!-- End .news_frame -->
                
        </div><!-- End .main_ndcc -->
            
        
        <div class="news_other">
            
            <h4>Sản phẩm khác</h4>
        
            <div class="main_pdm">
            
                <ul>
                <?php
				$sl=get_field("tbl_module","idshop",$row_shop['id'],"sl1");
				if($sl=="") $sl=8;
                $new=get_records("tbl_item","status=0 and cate=0 AND idshop='{$idshop}' and parent=".$parent,"id DESC","0,".$sl," ");
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
                            <p><a href="<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_new['name']?></a></p>
                            <span>Giá:<?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?></span>
                        </div><!-- End .info_pdm -->
                    </li>
                <?php } ?>     
                    
                </ul>
                <div class="clear"></div>
            </div><!-- End .main_pdm -->
            
        </div><!-- End .news_other -->
    
    </div><!-- End .frame_ndct -->

	<div class="clear2"></div>

</div>
<?php }if($rowtin['cate']){?>
<div class="center_ct">

    <div class="frame_ndct">
        
        <h1 class="title_pdm">
            <span><?php echo $rowtin['name']?></span>
        </h1><!-- End .title_pdm -->
        
        <div class="main_ndcc">
            
        	<?php echo $rowtin['detail']?>   
           
        </div><!-- End .main_ndcc -->
        
        <div class="news_other">
            <h4>Các tin khác</h4>
            <ul class="ul_news_other">
            <?php
			$parent=$rowtin['parent'];
			$id1=$rowtin['id']-5;
			$id2=$rowtin['id']+5;
			$new=get_records("tbl_item","status=0 AND cate=1 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
			
			?>
			<?php
            while($row_new=mysql_fetch_assoc($new)){
            ?>
                <li>
                    <a href="/<?php echo $row_new['subject']?>.html" title=""> -:- <?php echo $row_new['name']?> </a>
                </li>
             <?php  } ?>  
               
            </ul>
        </div>
            

    
    </div><!-- End .frame_ndct -->
    
    <div class="clear2"></div>
    
</div>
<?php }?>