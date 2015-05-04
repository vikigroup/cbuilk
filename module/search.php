<?php
	if(isset($_GET['tukhoa'])) {$tukhoa=$_GET['tukhoa'];if($tukhoa=="tat-ca") $tukhoa="";$_SESSION['kh_tukhoa']=$tukhoa;}
 
 	$tukhoa = str_replace(".", "", $tukhoa);
	if(isset($_GET['loai'])) { if($_GET['loai']=="tat-ca") $parent1=2;else $parent1=$_GET['loai'];settype($parent1,"int");$_SESSION['kh_theloai']=$parent1;}
	 
	$parent=getParent("tbl_shop_category",$parent1);
	
	if($parent1==2) $str_tim="";
	else $str_tim="AND parent1 in ({$parent})";
	
	$pageSize = 20;
	$pageNum = 1;
	$totalRows = 0;
	$xeptheo='id';
	$dem=1;
	
	$kkk="1";
	if(isset($_SESSION['filter1'])) {
		$xapxep=$_SESSION['filter1'];
		if($xapxep==" id DESC") $kkk="1";
		elseif($xapxep==" price ASC") $kkk="2";
		elseif($xapxep==" price DESC") $kkk="3";
	}
	else $xapxep="id DESC";
	
	settype($pageSize,"int");
	settype($pageNum,"int");
	settype($totalRows,"int");
	settype($dem,"int");
	
	
	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1;
	$startRow = ($pageNum-1) * $pageSize;
	

    $totalRows = countRecord("tbl_item","status=0  AND cate=0 $str_tim  AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' )"); 
	 //echo "status=0 AND type=0 AND cate=0 $str_tim  AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' ) order by $xapxep limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 AND cate=0 $str_tim AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' ) order by $xapxep limit ".$startRow.",".$pageSize," "," "," ");
		
/*	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($product);
			echo '<script>window.location="'.$linkrootshop.'thong-tin/'.$rowtin['subject'].'.html" </script>';
	}*/

?>
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a  > Tìm kiếm</a></li>
        <li><a href="#">Hiện có <strong><?php echo $totalRows;?></strong> sản phẩm</a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->
            
<section class="f-ct">

    <div class="sidebar">
        
        <div class="catelog">
            <h2 class="t-mn-dm">
			 Danh mục
            </h2>
            <div class="m-cate">
                <ul>
                    <?php
				   $cate1=get_records("tbl_shop_category","status=0 AND parent='2'"," "," "," ");
					 
					while($row_cate1=mysql_fetch_assoc($cate1)){
					?>
						<li><a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html" title=""><?php echo $row_cate1['name']?></a></li>
					<?php }?> 
                </ul>
                <div class="clear"></div>
            </div><!-- End .m-cate -->
        </div><!-- End .catelog -->
        
    </div><!-- End .sidebar -->
    
    <div class="content">
               
        <section class="filter-Prod">
            <h4 class="t-Pnb">
                <ul class="ul-fP">
                    <li <?php if($kkk==1) echo 'class="act"';?>><a href="<?php echo $linkrootshop;?>module/process.php?filter1=1">Mới nhất</a></li>
                    <li>|</li>
                    <li <?php if($kkk==1) echo 'class="act"';?>><a href="<?php echo $linkrootshop;?>module/process.php?filter1=2">Giá thấp nhất</a></li>
                    <li>|</li>
                    <li <?php if($kkk==1) echo 'class="act"';?>><a href="<?php echo $linkrootshop;?>module/process.php?filter1=3">Giá cao nhất</a></li>
                </ul>
                <div class="clear"></div>
                <div class="f-sty-P">
                    <ul>
                        <li><a class="f-sty-P1 atc" href="javascript:void(0)"></a></li>
                        <li><a class="f-sty-P2" href="javascript:void(0)"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div><!-- End .f-sty-P -->
            </h4>
            <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/jquery_cookie.js" > </script>
            <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/script_prod.js "> </script>
        </section><!-- End .filter-Prod -->
        
        <section class="Prod-cate">
        
            <ul>
				<?php 
                while($row_new=mysql_fetch_assoc($product)){
			    $shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
                ?>
                <li class="li-Pc1">
                    <div class="i-Pnb">
                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="">
                        	<img src="<?php echo $linkroot?>/<?=$row_new['image']?>" alt=""/>
                        </a>
                    </div><!-- End .i-Pnb -->
                    <div class="prod_row1">
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['subject'];?></a>
                    </div><!-- End .prod_row1 -->
                    <div class="prod_row2">
                        Lượt xem
                        <br>
                        <?php echo $row_new['view'];?>
                    </div><!-- End .prod_row2 -->
                    <div class="prod_row3">
                        Ngày đăng 
                        <br>
                        <?php echo $row_new['date_added'];?>
                    </div><!-- End .prod_row3 -->
                    <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
                    <div class="clear"></div>
                </li>
                <?php }?>
                
            </ul>
            
            <div class="clear"></div>
            
        </section><!-- End .Prod-cate -->
        
        <div class="frame_phantrang">
            <div class="PageNum">
					<?php  
                        echo pagesLinks_new_full_2013($totalRows, $pageSize , $linkroot,"p","page-tu-khoa-tim/".$_GET['tukhoa']."/".$_GET['loai']);
                        ?>

            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .content -->
    
    <div class="clear"></div>
</section><!-- End .f-ct -->	
    
 