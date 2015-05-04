<?php

	$tensanpham=$_GET['tensanpham'];
		
	$rowtin=getRecord("tbl_item", "subject='".$tensanpham."' and status=0 and idshop='".$idshop."'");
	$ghinho=1;
	
    if($rowtin['id']!="") {
		
		/*echo  '<script>window.location="'.'/404-page-not-found.html" </script>';*/
		
		$sqlupdate="update tbl_item SET view=view+1 where subject='".$tensanpham."' and idshop='".$idshop."'";
		mysql_query($sqlupdate);
		$ghinho=1;
	
	}else{
		if(isset($_GET['tensanpham'])) {
		$danhmuc=$_GET['tensanpham'];
		$parent1=get_field('tbl_item_category','subject',$danhmuc,'id');
		$cate=get_field('tbl_item_category','subject',$danhmuc,'cate');
		
		if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found.html" </script>';
		}
 
		$parent=getParent("tbl_item_category",$parent1);
		$parent=str_replace(",,", ",", $parent);
		
		$ghinho=2;
		
	}
	
	
?>
<?php
if($ghinho==1){
?>
<div class="content">
    <div class="frame_nd">
    
        <h1 class="title_fnd">
          <?php echo  $rowtin['name'] ?>
        </h1><!-- End .title_fnd -->
        
        <div class="main_fnd">
        
            <table>
                <tr>
                    <td>                                
                        
                       <!-- <p>
                            <b>
                                <?php echo  $rowtin['detail_short'] ?>
                            </b>
                        </p>-->
                        
                        <div>
            
                            <?php echo  $rowtin['detail'] ?>
                            
                        </div>
            
                    </td>                            
                </tr>                            
            </table>
        
            <div class="clear2"></div>
        
        </div><!-- End .main_fnd -->
        
        
        <div class="main_frame_text">
            <div class="title_mft">&bull; Các tin khác</div>
            <div class="main_news_other">                    
                
                <ul>
                        <?php
                        $parent=$rowtin['parent'];
                        $id1=$rowtin['id']-5;
                        $id2=$rowtin['id']+5;
                        $new=get_records("tbl_item","status=0 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
                        while($row_new=mysql_fetch_assoc($new)){
                        ?>
                        <li>
                             <a href="<?php echo $row_new['subject']?>.html" title="">-:- <?php echo $row_new['name']?> </a>
                        </li>
                        <?php }?> 
                    </ul>
                                
            </div><!-- End .main_news_other -->
        
        </div><!-- End .main_frame_text -->
    
    </div>
</div>

<?php
}else{
?>
<?php
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
                if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['tensanpham']);}
            ?>
            </div>
        </center>
    </div>
    
</div><!-- End .content -->


<?php }?>