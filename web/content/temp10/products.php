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
<div class="center_ct">
    
    <div class="frame_ndct">
        
        <h1 class="title_pdm">
            <span> <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?> </span>
        </h1><!-- End .title_pdm -->
        
        <div class="main_ndcc">
        
            <div class="main_pdm">
                <ul>
                <?php
				while($row_new=mysql_fetch_assoc($product)){
				?> 
                    <li>
                        <div class="space_img_pdm">
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo $row_new['subject']?>.html" title=""onmouseover="AJAXShowToolTip('show-tip/<?php echo $row_new['id'];?>'); return false;" onmouseout="AJAXHideTooltip();">
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
                <?php } ?>     
                    
                </ul>
                <div class="clear"></div>
            </div><!-- End .main_pdm -->
            
            <div class="frame_phantrang">
                <center>
                    <div class="PageNum">
                          <?php  
								if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
								else echo pagesLinks_new_full($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
							?>
                    </div>
                </center>
            </div>
        
        </div><!-- End .main_ndcc -->
    
    </div><!-- End .frame_ndct -->
    
    <div class="clear2"></div>
    
</div>
<?php }elseif($loai==1){?>
<div class="center_ct">

    <div class="frame_ndct">
        
        <h1 class="title_pdm">
            <span> <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?></span>
        </h1><!-- End .title_pdm -->                        
        
        <div class="main_ndcc">
                
                <div class="news_frame">
                    <ul>
                      <?php
							if($totalRows>0) {
				
								while($rowtin=mysql_fetch_assoc($product)){
						?>
                        <li>
                            <div class="over_imgs">
                                <span>
                                    <table>
                                        <tr>
                                            <td>
												<?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                                                <a href="/<?php echo $rowtin['subject']?>.html" title="">
                                                	<img src="<?php echo $host_link_full_vip;?>/<?php echo $linkhinh;?>" alt=""/>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </span>
                            </div>
                            <div class="over_text">
                                <h4>
                                   <a href="/<?php echo $rowtin['subject']?>.html" title=""><?php  echo $rowtin['name']?></a>
                                </h4>
                                <p>
                                     <?php echo catchuoi_tuybien($rowtin['detail_short'],15)?>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <?php }
							}else {?>
							<div style="text-align:center; padding:10px 0;">Dữ liệu đang cập nhật</div>
						  <?php } ?>
                       
                    </ul>
                </div><!-- End .news_frame -->
        
                <div class="frame_phantrang">
                    <center>
                        <div class="PageNum">
                            <?php  
							if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
							else echo pagesLinks_new_full($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
							?>
                        </div>
                    </center>
                </div>
        
            </div><!-- End .main_ndcc -->    
    
    </div><!-- End .frame_ndct -->
    
    <div class="clear2"></div>
    
</div>
<?php }?>

