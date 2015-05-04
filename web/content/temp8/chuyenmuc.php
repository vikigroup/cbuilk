<?php
	if(isset($_GET['chuyenmuc'])) {
		$chuyenmuc=$_GET['chuyenmuc'];
		$parent=get_field('tbl_news_category','subject',$chuyenmuc,'id');
		if($parent=="")  echo  '<script>window.location="'.'404-page-not-found.html" </script>';
	}
	
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
	
	echo "status=0 AND parent='{$parent}'";
    $totalRows = countRecord("tbl_news","status=0 AND parent='{$parent}'"); 
	
	$row=get_records("tbl_news","status=0 AND parent='{$parent}' limit ".$startRow.",".$pageSize," "," "," ");
		
	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($row);
			echo '<script>window.location="'."thong-tin-chuyen-muc/".$rowtin['subject'].'.html" </script>';
	}

?>
<div class="frame_product_mau_gh">
    
        <h2 class="title_f_p_m_gh">
            Tin tức
        </h2><!-- End .title_fnd -->
        
       <div class="main_f_p_m_gh">
        
        <?php
            if($totalRows>0) {

                while($rowtin=mysql_fetch_assoc($row)){
        ?>
        <div class="news_mau_gh">
        
        	<div class="frame_img_dm" style="float:left;">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                        	<?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                            <a href="thong-tin-chuyen-muc/<?php echo $rowtin['subject']?>.html" title="">
                                <img src="<?php echo $host_link_full_vip;?>/<?php echo $linkhinh;?>" alt=""/>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="nd_news" style="overflow:hidden; padding-left:10px;">
                <h2><a href="thong-tin-chuyen-muc/<?php echo $rowtin['subject']?>.html" title=""><?php  echo $rowtin['name']?></a></h2>
                <p>
                    <?php echo catchuoi_tuybien($rowtin['detail_short'],15)?>
                </p>
                <p align="right"><a class="readmore_info" href="thong-tin-chuyen-muc/<?php echo $rowtin['subject']?>.html" title="">Xem tiếp</a></p>
            </div>
            <div class="clear"></div>
            
        </div><!-- End .news_mau_gh -->
        
        <?php }
            }else {?>
            <div style="text-align:center; padding:10px 0;">Dữ liệu đang cập nhật</div>
          <?php } ?>
        
        <center>
            <div class="PageNum" style="padding-top:20px;">
				<?php echo pagesLinks_new_full($totalRows, $pageSize , "",$_GET['chuyenmuc']."/p","page-chuyen-muc");?>
            </div>
        </center>        
        
    </div><!-- End .main_fnd -->
    
     <div class="footer_f_p_m_gh">
   
    </div><!-- End .footer_f_p_m_gh -->
        
       
</div>