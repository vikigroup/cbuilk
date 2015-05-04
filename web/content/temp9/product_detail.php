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
			if(isset($_GET['tensanpham'])) {
				$danhmuc=$_GET['tensanpham'];
				$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
				$loai=get_field('tbl_item_category','subject',$danhmuc,'cate');
				if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found" </script>';
			}
			else $parent1=2;
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
		

		$(".btn_prod_details").click(function(){;
		alert(" Thêm vào giỏ hàng thành công");; 
		var a;
		a=$(this).attr("value");
		var idtin=$("#idtin"+a).val();;
		var sl=$("#qty"+a).val();;
		var pri=$("#price"+a).val();;
		$(".box_shop_2").load("<?php echo $host_link_full;?>/content/temp<?php echo $url;?>/add_ajax.php?idtin="+idtin+"&sl="+sl,function() {
			window.location.reload();	
			});;
		});;
	});				
</script>

<style type="text/css">
	img.abcdefffff{
		max-height: 130px;
		max-width: 150px;
	}
	.frame_img_dm_111{
		float:left;		
		border: 1px solid #E8E8E8;
		padding: 5px;
		width:150px; height:130px;
	}
	.frame_img_dm_111 table{width:100%; height:100%;}
	.frame_img_dm_111 table td{vertical-align:middle; text-align:center;}
	.canh_css_frame{overflow:hidden;}
</style>
<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
        <?php echo $rowtin['name'];?>
    </h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
    
        <div style="padding:10px 10px 0 10px;">
            
				<?php
                    $dem=1;
                    //$rowtin=mysql_fetch_assoc($rstin);
                ?>
                <div class="slider_prod_details">
                
                    <div class="main_slider_pd">
                
                        <center>
                            <div id="feature_list">
                            
                                
                                 <?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                                <ul id="output">
                                    <li style="display: list-item;">
                                        <img alt="" src="<?php echo $linkroot ;?>/<?php echo $linkhinh?>">
                                    </li>
                                </ul>
                             
                                
                                <div class="clear"></div>
                    
                            </div><!-- End #feature_list -->
                        </center>

                    </div><!-- End .main_slider_pd -->
                
                    <div class="f_prod_slidebar">
                
                <div class="gbsp">
                    <span>Giá bán sản phẩm:</span>
                    <h1>
						<?php
                        if($rowtin['pricekm']==""){
                        ?>
                        <?php  if(preg_match ("/^([0-9]+)$/", $rowtin['price'])) echo number_format($rowtin['price'],0)."  VNĐ";else echo $rowtin['price']; if($rowtin['price']=="") echo "Giá: Liên hệ";?>
                        <?php }else {?>
                         <?php  if(preg_match ("/^([0-9]+)$/", $rowtin['pricekm'])) echo number_format($rowtin['pricekm'],0)."  VNĐ";else echo $rowtin['pricekm']; ?>
                         <?php }?>
                    </h1>
                </div><!-- End .gbsp -->
                
                <div class="slsp">
                
                
                        <span>Số lượng mua</span>
                        <input type="hidden" value="66" id="idtin<?=$dem;?>" name="idtin<?=$dem;?>">                       
                        <input type="text" value="1" class="ipt_prod_details" id="qty<?=$dem;?>" name="qty<?=$dem;?>">
                        
                        <input type="image" value=" "  valuee="<?=$dem;?>" id="addcart<?=$dem;?>" name="addcart<?=$dem;?>" class="btn_prod_details">
                        
                        
                       <!--  <input class="input_check_1" name="idtin<?=$dem;?>" id="idtin<?=$dem;?>" type="hidden" value="<?=$rowtin['id'];?>" />                            
                                        <input name="qty<?=$dem;?>" type="text" id="qty<?=$dem;?>" style="width:70px; height:24px;border:1px solid #ccc; float:left;" value="1"  >
                                    
                                        <input name="addcart<?=$dem;?>" type="image" id="addcart<?=$dem;?>" src="skin/<?php echo $template;?>/imgs/layout/carti.jpg"  style="float:left;" width="35" height="26" class="adtocart" value="<?=$dem;?>" > -->
                        <div class="clear"></div>
                    
                
                
                </div><!-- End .slsp -->
                
                <div class="info_prod_details">
                
                    <ul>
                        <li>
                            <h4 class="l_ipd">Ngày đăng sản phẩm</h4>
                            <span class="r_ipd"><?php echo $rowtin['date_added'];?></span>
                            <div class="clear"></div>
                        </li>
                         <li>
                            <h4 class="l_ipd">Số lần xem sản phẩm</h4>
                            <span class="r_ipd"><?php echo $rowtin['view'];?></span>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <h4 class="l_ipd">Chia sẻ</h4>
                            <span class="r_ipd">
                            
                                <!-- Lockerz Share BEGIN -->
                                <div class="a2a_kit a2a_default_style">
                                <a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
                                <span class="a2a_divider"></span>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                </div>
                                <script src="skin/temp<?php echo $url;?>/scripts/page.js" type="text/javascript"></script>
                                <!-- Lockerz Share END -->
                            
                            </span>
                            <div class="clear"></div>
                        </li>
                    </ul>	
                
                </div><!-- End .info_prod_details -->
                
                <div class="clear"> <br> </div>
                
                <div class="block_prod_details">
                    
                    <div class="info_gh">                        
                        <div style="padding-top:10px;">
                            <h4>Thông tin chi tiết</h4>
                            <ul class="f_iod">
                                <li>
                                
                                    <span class="s1_iod">Địa chỉ</span>
                                    
                                    <span class="s2_iod"><?php echo $row_title_lap['address'];?></span>
                                    
                                    <div class="clear"></div>
                                
                                </li>
                                <li>
                                
                                    <span class="s1_iod">Điện thoại</span>
                                    
                                    <span class="s2_iod"><?php echo $row_title_lap['telephone'];?></span>
                                    
                                    <div class="clear"></div>
                                
                                </li>
                                <li>
                                
                                    <span class="s1_iod">Email</span>
                                    
                                    <span class="s2_iod"><?php echo $row_title_lap['email'];?></span>
                                    
                                    <div class="clear"></div>
                                
                                </li>
                                
                            </ul><!-- End .f_iod -->
                        </div>
                                                
                    </div><!-- End .info_gh -->
                    
                </div><!-- End .block_prod_details -->
                
                </div>	
                
                </div>
                
                <div class="clear"> </div>
                
                <div class="title_ct_prod_details">Thông tin chi tiết sản phẩm</div>
                
				<!--<div class="box_detail_top">
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
                                <?php
                                if($rowtin['pricekm']!=""){
                                ?>
                                <span class="price_sp_old_h"><?php  if(preg_match ("/^([0-9]+)$/", $rowtin['price'])) echo number_format($rowtin['price'],0)."  VNĐ";else echo $rowtin['price']; ?></span>&nbsp;
                                <span style="margin:0 10px;font-size:16px;">|</span>
                                <span class="price_sp_h"><?php  if(preg_match ("/^([0-9]+)$/", $rowtin['pricekm'])) echo number_format($rowtin['pricekm'],0)."  VNĐ";else echo $rowtin['pricekm']; ?></span>&nbsp;
                                </span>
                                <?php }else {?>
                                <span class="price_sp_h"><?php  if(preg_match ("/^([0-9]+)$/", $rowtin['price'])) echo number_format($rowtin['price'],0)."  VNĐ";else echo $rowtin['pricekm']; ?></span>&nbsp;
                                </span>
                                <?php }?>
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
            	</div> -->
                        
				<div class="clear"></div>
                        
                <div style="padding-top:10px; min-height:500px;">
                                     
                    <div class="canh_css_frame">
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <?php 
                                        echo  $rowtin['detail'];
										$parent=$rowtin['parent'];
                                        ?>                                        
                                    </div>
                                    <div style="clear:both; float:none;"></div>
                                </td>
                            </tr>
                        </table>
                    </div> 
                </div>

			</div><!-- End .news_mau_gh -->
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
    
</div><!-- End .frame_product_mau_gh -->



<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
		Sản phẩm khác
	</h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
        
        <div class="product_t_t">
        		<?php
				$sl=get_field("tbl_module","idshop",$row_shop['id'],"sl1");
				if($sl=="") $sl=8;
                $new=get_records("tbl_item","status=0 AND idshop='{$idshop}' and parent=".$parent,"id DESC","0,".$sl," ");
				$dem=1;
                while($row_new=mysql_fetch_assoc($new)){
                ?>
                <div class="m_upsp">
                    <div class="space_img_sp">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" >
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
         </div><!-- End .prod_mau_gh -->
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->

<?php }elseif($rowtin['cate']){?>
<div class="frame_product_mau_gh">
<h2 class="title_f_p_m_gh">
Chi tiết tin
</h2><!-- End .title_f_p_m_gh -->
<div class="main_f_p_m_gh">
<h1 style="padding:10px; font-size:18px;"><?php echo  $rowtin['name'] ?></h1>
<div class="news_mau_gh">
	<div class="canh_css_frame">
		<table>
			<tr>
				<td>
					<div>
							<?php echo $rowtin['detail']; ?>
						 <?php 
							//echo $chuoi= str_replace('../../uploads', "http://numbala.vn/uploads", $rowtin['noidung']);

							
						?>
					</div>
					<div style="clear:both; float:none;"></div>
				</td>
			</tr>
		</table>   
	</div>
</div><!-- End .news_mau_gh -->

</div><!-- End .main_f_p_m_gh -->
<div class="footer_f_p_m_gh">

</div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->


<div class="frame_product_mau_gh">
			<h2 class="title_f_p_m_gh">
				Tin khác
			</h2><!-- End .title_f_p_m_gh -->
			<?php
			$parent=$rowtin['parent'];
			$id1=$rowtin['id']-5;
			$id2=$rowtin['id']+5;
			$new=get_records("tbl_item","status=0 AND cate=1 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
			
			?>
			<div class="main_f_p_m_gh">
				<?php
				while($row_new=mysql_fetch_assoc($new)){
				?>
				<div class="news_mau_gh">
                			
					<div class="nd_news" style="overflow:hidden; padding-left:10px;">
						<h2>-:- <a href="/<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?> </a></h2>
					</div>
					<div class="clear"></div>
				
				</div><!-- End .news_mau_gh -->
				<?php  } ?>
				
			</div><!-- End .main_f_p_m_gh -->
			<div class="footer_f_p_m_gh">
			</div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->


<?php } 

	}else{

	$parent=getParent("tbl_item_category",$parent1);
	$parent=str_replace(",,", ",", $parent);
	
	if($parent1==2) $str_parent="";
	else $str_parent="AND parent in ({$parent})";
	
	$sl=get_field("tbl_module","idshop",$row_shop['id'],"sl2");
	if($sl=="") $sl=16;
	
	$pageSize = $sl;
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
	
    //echo "status=0 AND parent in ({$parent}) AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize; 
    $totalRows = countRecord("tbl_item","status=0 $str_parent AND idshop=".$idshop); 
	//echo "status=0 AND parent='{$parent}' AND ishop=".$idshop." limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 $str_parent AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize," "," "," ");
		
   if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($product);
			echo '<script>window.location="'.$linkroot.'/'.$rowtin['subject'].'.html" </script>';
	}
?>



<?php if($loai==0){?>
<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
          <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?>
	</h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
        
        <div class="product_t_t">
        		<?php
				while($row_new=mysql_fetch_assoc($product)){
				?>
                <div class="m_upsp">
                    <div class="space_img_sp">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" >
                        	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                        </a>
                    </div><!-- End .space_img_sp -->
                    <h4 class="name_prod">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>"  ><?php echo $row_new['name']?></a>
                    </h4>
                    <p><a title="<?php echo $row_new['name']?>" href="/<?php echo $row_new['subject']?>.html" target="_blank" class="t_shop_n"><?php echo $row_new['date_added']?></a></p>
                    <span class="price_prod"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Call"; ?></span>
                </div>
                 <?php } ?>  
                
                <div class="clear"> </div>
         </div><!-- End .prod_mau_gh -->
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
        
    </div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->

<div class="PageNum">                                
	<?php  
    if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['tensanpham']);}
    else echo pagesLinks_new_full_2013($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
    ?>
</div>

<?php }elseif($loai==1){?>
<div class="frame_product_mau_gh">
    
        <h2 class="title_f_p_m_gh">
            <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?>
        </h2><!-- End .title_fnd -->
        
       <div class="main_f_p_m_gh">
        
        <?php
            if($totalRows>0) {

                while($rowtin=mysql_fetch_assoc($product)){
        ?>
        <div class="news_mau_gh">
        
        	<div class="frame_img_dm" style="float:left;">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                        	<?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                            <a href="/<?php echo $rowtin['subject']?>.html" title="">
                                <img src="<?php echo $host_link_full_vip;?>/<?php echo $linkhinh;?>" alt=""/>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="nd_news" style="overflow:hidden; padding-left:10px;">
                <h2><a href="/<?php echo $rowtin['subject']?>.html" title=""><?php  echo $rowtin['name']?></a></h2>
                <p>
                    <?php echo catchuoi_tuybien($rowtin['detail_short'],15)?>
                </p>
                <p align="right"><a class="readmore_info" href="/<?php echo $rowtin['subject']?>.html" title="">Xem tiếp</a></p>
            </div>
            <div class="clear"></div>
            
        </div><!-- End .news_mau_gh -->
        
        <?php }
            }else {?>
            <div style="text-align:center; padding:10px 0;">Dữ liệu đang cập nhật</div>
          <?php } ?>
        
        <center>
            <div class="PageNum" style="padding-top:20px;">
				 <?php  
					if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
					else echo pagesLinks_new_full_2013($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
				?>
            </div>
        </center>        
        
    </div><!-- End .main_fnd -->
    
     <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
        
       
</div>

<?php }?>

<?php }?>