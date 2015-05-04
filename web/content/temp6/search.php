<?php
	
	if(isset($_GET['keyword'])) {$tukhoa=$_GET['keyword'];if($tukhoa=="tat-ca") $tukhoa="";$_SESSION['kh_tukhoa']=$tukhoa;}
	
	if(isset($_GET['theloai'])) {$theloai=$_GET['theloai'];$_SESSION['kh_theloai']=$theloai;}
	
	if(isset($_GET['loai'])) {$loai=$_GET['loai'];$_SESSION['kh_loai']=$loai;}
	
	if(isset($_GET['price1'])) {$price1=$_GET['price1'];$_SESSION['kh_price1']=$price1;}

	
	if(isset($_GET['price2'])) {$price2=$_GET['price2'];$_SESSION['kh_price2']=$price2;}
	
	if($price1 !="gia-1") $price.=" AND price >".$price1;
	if($price2 !="gia-2") $price.=" AND price <".$price2; 
		
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
	

	$sqlcount="SELECT count(*)
		FROM tbl_item
		WHERE (name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' )
			AND idshop='{$idshop}'
			AND status=0 "; 
	$rs = mysql_query($sqlcount);
	$rows_rs = mysql_fetch_row($rs);
	$totalRows = $rows_rs[0];

	$sqltin="SELECT * 
		FROM  tbl_item
		WHERE (name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' )
			AND idshop='{$idshop}'
			AND status=0 
		ORDER BY id DESC ";  
	$sqltin = sprintf("%s LIMIT %d,%d", $sqltin , $startRow , $pageSize);// lay gioi han phan trang
	$rstin=mysql_query($sqltin) or die(mysql_error());
  
?>
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
            while($row_new=mysql_fetch_assoc($rstin)){
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
				 if($tukhoa=="") $tukhoa="tat-ca";
				 echo pagesLinks_new_full_2013($totalRows, $pageSize , " ",$tukhoa,"page-tim-kiem");
				 ?> 
            </div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .main_frame_main_text -->
    
</div><!-- End .content_w -->