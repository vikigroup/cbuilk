<?php
	if(isset($_GET['danhmuc'])) {
		$danhmuc=$_GET['danhmuc'];
		$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
		$cate=get_field('tbl_item_category','subject',$danhmuc,'cate');
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
	
   //echo "status=0 AND cate='".$cate."' AND parent in ({$parent}) AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize; 
    $totalRows = countRecord("tbl_item","status=0 AND cate='".$cate."' $str_parent AND idshop=".$idshop); 
	//echo "status=0 AND parent='{$parent}' AND ishop=".$idshop." limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 AND cate='".$cate."' $str_parent AND idshop=".$idshop." order by id DESC limit ".$startRow.",".$pageSize," "," "," ");
		
	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($product);
			echo '<script>window.location="'.$linkroot.'/'.$rowtin['subject'].'.html" </script>';
	}

?>
<div class="content">

    <h1 class="title_cnt">
        <?php if($parent1==2) echo "Xem tất cả";else echo get_field('tbl_item_category','subject',$danhmuc,'name');?>
    </h1><!-- End .title_cnt -->
    
    <div class="main_cnt">
        <ul>
			<?php
            while($row_new=mysql_fetch_assoc($product)){
            ?>
            <li>
                <div class="space_img">
                    <a href="/<?php echo $row_new['subject']?>.html" title="">
                    	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                    </a>
                </div><!-- End .space_img -->
                <div class="space_text">
                    <h4>
                        <a href="/<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </h4>
                    <p>
                        <?php echo strip_tags(catchuoi_tuybien($row_new['detail_short'],15));?> 
                    </p>
                </div><!-- End .space_text -->
                <div class="clear"></div>
            </li>
           <?php }?> 
            
        </ul>
        <div class="clear"></div>
    </div><!-- End .main_cnt -->
    
    <div class="phantrang_new">
        <center>
            <div class="PageNum">                                
                <?php  
                if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['danhmuc']);}
                else echo pagesLinks_new_full($totalRows, $pageSize , "" ,"p","page-xem-tat-ca");
            ?>
            </div>
        </center>
    </div>
    
</div><!-- End .content -->