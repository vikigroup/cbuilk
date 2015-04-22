<?php
if(isset($_GET['danhmuc'])) {
    $danhmuc=$_GET['danhmuc'];
    $parent1=get_field('tbl_shop_category','subject',$danhmuc,'id');
    /*		if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found" </script>';*/
}
$parent=getParent("tbl_shop_category",$parent1);

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


$totalRows = countRecord("tbl_item","status=0 AND type=0 AND parent1 in ({$parent})");
//echo "status=0 AND type=0 AND parent1 in ({$parent}) order by $xapxep limit ".$startRow.",".$pageSize;
$product=get_records("tbl_item","status=0 AND type=0 AND parent1 in ({$parent}) order by $xapxep limit ".$startRow.",".$pageSize," "," "," ");

/*	if($totalRows==1) {
			$rowtin=mysql_fetch_assoc($product);
			echo '<script>window.location="'.$linkrootshop.'thong-tin/'.$rowtin['subject'].'.html" </script>';
	}*/

?>
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo $danhmuc;?>/"><?php echo get_field('tbl_shop_category','subject',$danhmuc,'name');?></a></li>
        <li><a href="#">Hiện có <strong><?php echo $totalRows;?></strong> sản phẩm</a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->

<section class="f-ct">

    <div class="sidebar">

        <div class="catelog">
            <h2 class="t-mn-dm">
                <?php
                echo get_field('tbl_shop_category','subject',$danhmuc,'name');
                if(countRecord("tbl_shop_category","parent='".$parent1."'")>0)   get_field('tbl_shop_category','subject',$tensanpham,'parent');
                else   get_field('tbl_shop_category','id',get_field('tbl_shop_category','subject',$tensanpham,'parent'),'name');
                ?>
            </h2>
            <div class="m-cate">
                <ul>
                    <?php
                    if(countRecord("tbl_shop_category","parent='".$parent1."'")>0)  $cate1=get_records("tbl_shop_category","status=0 AND parent='".$parent1."'"," "," "," ");
                    else  $cate1=get_records("tbl_shop_category","status=0 AND parent='".get_field('tbl_shop_category','subject',$danhmuc,'parent')."'"," "," "," ");
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

        <section class="Prod-nb">

            <h4 class="t-Pnb">
                Sản phẩm khuyến mãi
            </h4><!-- End .t-Pnb -->

            <article class="m-Pnb">

                <ul class="ul-Pnb">
                    <?php
                    $new=get_records("tbl_item","status=0 AND type=0 AND parent1 in ({$parent}) "," ","0,9"," ");
                    while($row_new=mysql_fetch_assoc($new)){
                        $shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
                        ?>
                        <li>
                            <div class="i-Pnb">
                                <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="">
                                    <img src="<?php echo $linkrootshop?>/imagecache/image.php/<?=$row_new['image']?>?width=176&amp;height=140&amp;cropratio=1:1&amp;image=<?php echo $linkroot?>/<?=$row_new['image']?>" alt=""/>
                                </a>
                            </div><!-- End .i-Pnb -->
                            <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                            <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['subject'];?></a>
                            <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
                        </li>
                    <?php }?>

                </ul>

                <div class="clear"></div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.ul-Pnb').bxSlider({
                            slideWidth: 185,
                            minSlides: 4,
                            maxSlides: 4,
                            slideMargin: 10,
                            controls: false,
                            infiniteLoop: false
                        });
                    });
                </script>

            </article><!-- End .m-Pnb -->

            <article class="m-Pnb2">
                <ul>
                    <?php
                    $new=get_records("tbl_item","status=0 AND type=0 AND parent1 in ({$parent}) "," ","0,9"," ");
                    while($row_new=mysql_fetch_assoc($new)){
                        $shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
                        ?>
                        <li>
                            <div class="i-Pnb">
                                <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="">
                                    <img src="<?php echo $linkrootshop?>/imagecache/image.php/<?=$row_new['image']?>?width=176&amp;height=140&amp;cropratio=1:1&amp;image=<?php echo $linkroot?>/<?=$row_new['image']?>" alt=""/>
                                </a>
                            </div><!-- End .i-Pnb -->
                            <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                            <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['subject'];?></a>
                            <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
                        </li>
                    <?php }?>

                </ul>
                <div class="clear"></div>
            </article><!-- Responsive m-Pnb2 -->

        </section><!-- End .Prod-nb -->

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
                                <img src="<?php echo $linkrootshop?>/imagecache/image.php/<?=$row_new['image']?>?width=176&amp;height=140&amp;cropratio=1:1&amp;image=<?php echo $linkroot?>/<?=$row_new['image']?>" alt=""/>
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
                if(isset($_REQUEST['danhmuc'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "http://shop.jbs.vn","p","page-danh-muc/".$_GET['danhmuc']);}
                else echo pagesLinks_new_full_2013($totalRows, $pageSize , "http://shop.jbs.vn","p","page-danh-muc/".$_GET['danhmuc']."/".$_GET['danhmuc']);
                ?>
            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->

    </div><!-- End .content -->

    <div class="clear"></div>
</section><!-- End .f-ct -->	
    
