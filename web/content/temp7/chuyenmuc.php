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
	

    $totalRows = countRecord("tbl_news","status=0 AND parent='{$parent}'"); 
	
	$row=get_records("tbl_news","status=0 AND parent='{$parent}' limit ".$startRow.",".$pageSize," "," "," ");
		
	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($row);
			echo '<script>window.location="'."thong-tin-chuyen-muc/".$rowtin['subject'].'.html" </script>';
	}

?>
<div class="content">
    <div class="frame_nd">
    
        <h1 class="title_fnd">
            Tin tức
        </h1><!-- End .title_fnd -->
        
        <div class="main_fnd">
        
            <div class="news_frame">
            <ul>
            <?php
            if($totalRows>0) {
                $i=1;
                while($rowtin=mysql_fetch_assoc($row)){ 
            ?>
                <li>
                    <div class="over_imgs">
                        <span>
                            <table>
                                <tr>
                                    <td>
                                    <?php if($rowtin['image']=="") $linkhinh="imgs/noimage.png";else $linkhinh=$rowtin['image'];  ?>
                                        <a href="thong-tin-chuyen-muc/<?php echo $rowtin['subject']?>.html"><img  src="<?php echo $linkroot ;?>/<?php echo $linkhinh;?>"  /></a>
                                    </td>
                                </tr>
                            </table>
                        </span>
                    </div>
                    <div class="over_text">
                        <h4>
                            <a href="thong-tin-chuyen-muc/<?php echo $rowtin['subject']?>.html" title=""> <?php echo $rowtin['name']?> </a>
                        </h4>
                        <p>
                           <?php echo catchuoi_tuybien($rowtin['detail_short'],15)?> 
                        </p>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php
                    }
                }else{
                ?>
                <li> Dữ liệu đang cập nhật </li>
                <?php }?>  
                
            </ul>
        </div><!-- End .news_frame -->
        
            <div class="clear2"></div>
        
        </div><!-- End .main_fnd -->
        
        
        <div class="phantrang_new">
            <div class="PageNum">
                 <?php echo pagesLinks_new_full($totalRows, $pageSize , "",$_GET['chuyenmuc']."/p","page-chuyen-muc");?>
            </div>
        </div><!--  End .phantrang_new -->
    
    </div>
</div>