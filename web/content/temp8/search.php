<?php
	
	if(isset($_GET['keyword'])) {$tukhoa=$_GET['keyword'];if($tukhoa=="tat-ca") $tukhoa="";$_SESSION['kh_tukhoa']=$tukhoa;}
	
	if(isset($_GET['theloai'])) {$theloai=$_GET['theloai'];$_SESSION['kh_theloai']=$theloai;}
	
	if(isset($_GET['loai'])) {$loai=$_GET['loai'];$_SESSION['kh_loai']=$loai;}
	
	if(isset($_GET['price1'])) {$price1=$_GET['price1'];$_SESSION['kh_price1']=$price1;}

	
	if(isset($_GET['price2'])) {$price2=$_GET['price2'];$_SESSION['kh_price2']=$price2;}
	
	if($price1 !="gia-1") $price.=" AND price >".$price1;
	if($price2 !="gia-2") $price.=" AND price <".$price2; 
		
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
	$product=mysql_query($sqltin) or die(mysql_error());
  
?>

<div class="frame_product_mau_gh">
    <h2 class="title_f_p_m_gh">
          Tìm kiếm
	</h2><!-- End .title_f_p_m_gh -->
    <div class="main_f_p_m_gh">
        
        <div class="product_t_t">
        		<?php
				while($row_new=mysql_fetch_assoc($product)){
				?>
                <div class="m_upsp">
                    <div class="space_img_sp">
                        <a href="/<?php echo $row_new['subject']?>.html" title="<?php echo $row_new['name']?>"  >
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

<div class="PageNum">                                
		<?php 
        if($tukhoa=="") $tukhoa="tat-ca";
        echo pagesLinks_new_full($totalRows, $pageSize , " ",$tukhoa,"page-tim-kiem");
        ?> 
</div>
