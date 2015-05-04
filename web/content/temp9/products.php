<?php
	if(isset($_GET['danhmuc'])) {
		$danhmuc=$_GET['danhmuc'];
		$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
		$loai=get_field('tbl_item_category','subject',$danhmuc,'cate');
		if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found" </script>';
	}
	else $parent1=2;
	
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
        
        <div class="prod_mau_gh">
            <ul>
			<?php
            while($row_new=mysql_fetch_assoc($product)){
            ?>                
            <li>
                	<div class="frame_img_dm">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
                                    <img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                                       
                    <h2 class="title_prod_news">
                      <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>" onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();"><?php echo $row_new['name']?></a>
                    </h2>
                    <h4 class="price_prod_mau_gh" title="<?php echo $row_new['name'];?>"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></h4>
                </li>
           <?php } ?>   
                <div class="clear"></div>
            </ul>
        </div><!-- End .prod_mau_gh -->
        
    </div><!-- End .main_f_p_m_gh -->
    <div class="footer_f_p_m_gh">
        
    </div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->

<div class="PageNum">                                
    <?php  
    if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
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