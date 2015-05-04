<?php
	$tensanpham=$_GET['tensanpham'];
	
			
	$rowtin=getRecord("tbl_item", "subject='".$tensanpham."' and status=0 and idshop='".$idshop."'");

    $ghinho=1;
	if($rowtin['id']>0) {
		$ghinho=1;
		$sqlupdate="update tbl_item SET view=view+1 where subject='".$tensanpham."' and idshop='".$idshop."'";
		mysql_query($sqlupdate);
	}else{
		if(isset($_GET['tensanpham'])) {
			$danhmuc=$_GET['tensanpham'];
			$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
			if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found" </script>';
			$cate=get_field('tbl_item_category','subject',$danhmuc,'cate');
			$ghinho=2;
		}
		else echo  '<script>window.location="'.'/404-page-not-found.html" </script>';
	}   
?>
<?php
if($ghinho==1){
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
		$(".main_card").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin,function() {
				
			});;
		});;
	});				
</script>
<div class="content_w">

    <div class="title_frame_main_text">
        chi tiết sản phẩm
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
    
        <div class="frame_details_nd_info">
        
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
            
            <h4 style="padding:10px 0;">Mô tả chi tiết:</h4>
            
            <table>
                <tr>
                    <td>                    	
                        
                        <div>
            
            				<?php  echo $rowtin['detail']?> 
                
            			</div>
                            
                    </td>
                </tr>
            </table>
        
            <div class="clear2"></div>               
        </div><!-- End .frame_details_nd_info -->         
        
        <div class="tools_share_num">
            <!--<img src="imgs/layout/img_demo/share_bg.jpg" alt=""/>-->
        </div>
        
        <div class="main_frame_text">
            <div class="title_mft">&bull; Sản phẩm khác</div>
                
            <ul class="psp_ul psp_ul3">
            <?php
			$parent=$rowtin['parent'];
			$id1=$rowtin['id']-5;
			$id2=$rowtin['id']+5;
			$new=get_records("tbl_item","status=0 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
			while($row_new=mysql_fetch_assoc($new)){
			?>
                <li>
                    <div class="frame_b_img">
                    
                        <div class="img_khung">
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo $row_new['subject']?>.html" title="">
                                        <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div><!-- End .img_khung -->
                        
                        <p>
                            <a href="<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                        </p>
                        
                        <span>
                             <?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo $row_new['price']; ?>
                        </span>
                        
                        <a class="readmode_w" href="<?php echo $row_new['subject']?>.html" title=""></a>
                        
                    </div><!-- End .frame_b_img -->
                </li>
             <?php }?>      
                
            </ul><!-- End #psp_ul3 -->
                     
        </div><!-- End .main_news_other -->
        
    </div><!-- End .main_frame_main_text -->
    
</div>
<?php
}else{
?>
<div class="content_w">

    <div class="title_frame_main_text">
        Chi tiết tin
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
    
        <div class="frame_details_nd_info">
            
            <table>
                <tr>
                    <td>
                    
                        <h1 class="text_title_news"> <?php echo  $rowtin['name'] ?> </h1>
                        <p>
                            <b>
                                <?php echo $rowtin['detail_short']; ?> 
                            </b>
                        </p>    
                        
                        <div>
            				
            				<?php echo $rowtin['detail']; ?>  
            
        				</div>                                
                    
                    </td>
                </tr>
            </table>
        
            <div class="clear2"></div>               
        </div><!-- End .frame_details_nd_info -->         
        
        <div class="tools_share_num">
           <!-- <img src="imgs/layout/img_demo/share_bg.jpg" alt=""/>-->
        </div>
        
        <div class="main_frame_text">
            <div class="title_mft">&bull; Các tin khác</div>
            <div class="main_news_other">                    
                
                <ul>
                    <?php
					$parent=$rowtin['parent'];
					$id1=$rowtin['id']-5;
					$id2=$rowtin['id']+5;
					$new=get_records("tbl_news","status=0 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
					while($row_new=mysql_fetch_assoc($new)){
					?>
					<li>
						 <a href="<?php echo $row_new['subject']?>.html" title="">-:- <?php echo $row_new['name']?> </a>
					</li>
					<?php }?> 
                </ul>
                
            </div>                                                
        </div><!-- End .main_news_other -->
        
    </div><!-- End .main_frame_text -->
        
    </div>
<?php 
		}//het detail
	}else{
	$parent=getParent("tbl_item_category",$parent1);
	$parent=str_replace(",,", ",", $parent);
	
	if($parent1==2) $str_parent="";
	else $str_parent="AND parent in ({$parent})";
	
	$pageSize = 16;
	$pageNum = 1;
	$totalRows = 0;
	$xeptheo='id';
	$dem=1;
	
	settype($pageSize,"int");
	settype($pageNum,"int");
	settype($totalRows,"int");
	settype($dem,"int");
	
	
	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1;
	$startRow = ($pageNum-1) * $pageSize;
	
	// echo "status=0 AND parent in ({$parent}) AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize; 
	$totalRows = countRecord("tbl_item","status=0 $str_parent AND idshop='".$idshop."'"); 
	//echo "status=0 AND parent='{$parent}' AND ishop=".$idshop." limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 $str_parent AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize," "," "," ");
?>
<?php if($cate==0){?>
<script type="text/javascript">  
	$(document).ready(function() {										
		$(".click_card").click(function(){;
		alert(" Thêm vào giỏ hàng thành công");; 
		var a;
		a=$(this).attr("value");
		var idtin=$("#idtin"+a).val();;
		var sl=$("#qty"+a).val();;
		var pri=$("#price"+a).val();;
		$(".card").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin,function() {
				
			});;
		});;
	});				
</script>
<div class="content_w">

    <div class="title_frame_main_text">
       <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?>
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
                    
        <ul class="psp_ul psp_ul3">
			<?php
            while($row_new=mysql_fetch_assoc($product)){
            ?>
            <li>
                <div class="frame_b_img">
                
                    <div class="img_khung">
                        <table>
                            <tr>
                                <td>
                                     <a href="<?php echo $row_new['subject']?>.html" title="">
                                        <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div><!-- End .img_khung -->
                    
                    <p>
                        <a href="<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </p>
                    
                    <span>
                        <?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo $row_new['price']; ?>
                    </span>
                    
                    <a class="readmode_w" href="<?php echo $row_new['subject']?>.html" title=""></a>
                    
                </div><!-- End .frame_b_img -->
            </li>
           <?php }?>   
            
        </ul><!-- End #psp_ul3 -->
        
        <div class="clear"></div>
        <br />
        
        <div class="frame_phantrang">
            <div class="PageNum">
					<?php  
                    if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['tensanpham']);} 
                    ?>
            </div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .main_frame_main_text -->
    
</div><!-- End .content_w -->
<?php }elseif($cate==1){?>
<div class="frame_product_mau_gh">
    
        <h2 class="title_f_p_m_gh">
            <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?>
        </h2><!-- End .title_fnd -->
        
       <div class="main_f_p_m_gh">
        
        <?php
            if($totalRows>0) {

                while($rowtin=mysql_fetch_assoc($product)){
        ?>
        <div class="news_frame">
            <ul>
                <li>
                    <div class="over_imgs">
                        <span>
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                                        <a href="<?php echo $rowtin['subject']?>.html" title="">
                                            <img src="<?php echo $host_link_full_vip;?>/<?php echo $linkhinh;?>" alt=""/>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </span>
                    </div>
                    <div class="over_text">
                        <h4>
                            <a href="<?php echo $rowtin['subject']?>.html" title=""><?php  echo $rowtin['name']?></a>
                        </h4>
                        <p>
                            <?php echo catchuoi_tuybien($rowtin['detail_short'],15)?>
                        </p>
                    </div>
                    <div class="clear"></div>
                </li>
                
                
            </ul>
        </div>
        
        <?php }
            }else {?>
            <div style="text-align:center; padding:10px 0;">Dữ liệu đang cập nhật</div>
          <?php } ?>
        
        <center>
            <div class="PageNum" style="padding-top:20px;">
				<?php  
                if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['tensanpham']);} 
                ?>
            </div>
        </center>        
        
    </div><!-- End .main_fnd -->
    
     <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
        
       
</div>
<?php }?>

<?php }?>