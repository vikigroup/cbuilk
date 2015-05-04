<?php
	if(isset($_GET['danhmuc'])) {
		$danhmuc=$_GET['danhmuc'];
		$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
		if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found" </script>';
		$cate=get_field('tbl_item_category','subject',$danhmuc,'cate');
	}
	else $parent1=2;
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
    $totalRows = countRecord("tbl_item","status=0 $str_parent AND idshop=".$idshop); 
	//echo "status=0 AND parent='{$parent}' AND ishop=".$idshop." limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 $str_parent AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize," "," "," ");
		
/*	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($product);
			echo '<script>window.location="'.$linkrootshop.''.$rowtin['subject'].'.html" </script>';
	}*/

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
                    if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
                    else echo pagesLinks_new_full($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
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
                if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
                else echo pagesLinks_new_full($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
                ?>
            </div>
        </center>        
        
    </div><!-- End .main_fnd -->
    
     <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
        
       
</div>
<?php }?>