<?php
	if(isset($_GET['tukhoa'])){$tukhoa = $_GET['tukhoa']; if($tukhoa == "tat-ca") $tukhoa = ""; $_SESSION['kh_tukhoa'] = $tukhoa;}
    $tukhoa = str_replace(".", "", $tukhoa);
	if(isset($_GET['loai'])){if($_GET['loai'] == "tat-ca") $parent1 = 2; else $parent1 = get_field('tbl_shop_category','subject',$_GET['loai'],'id'); settype($parent1,"int"); $_SESSION['kh_theloai'] = $parent1;}

    $parent = $parent1.",".parentString($parent1);

	if($parent1 == 2) $str_tim = "";
	else $str_tim = "AND parent1 in ({$parent})";

    $link = $_SERVER['REQUEST_URI'];
    $myLink = explode("?", $link);
    $myPage = explode("=", $myLink[1]);
    $pageNum = $myPage[1];

	$pageSize = 20;
	$totalRows = 0;

    $sapxep = "top DESC, sort, date_added DESC";
	
	settype($pageSize, "int");
	settype($pageNum, "int");
	settype($totalRows, "int");

	if ($pageNum <= 0) $pageNum = 1;
	$startRow = ($pageNum-1) * $pageSize;

    $totalRows = countRecord("tbl_item","status=0 AND set_time <= '$ngay' $str_tim  AND (name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%' or title LIKE '%$tukhoa%')");
	$product = get_records("tbl_item","status=0 AND set_time <= '$ngay' $str_tim AND (name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%' or title LIKE '%$tukhoa%' or keyword LIKE '%$tukhoa%') order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
?>

<input type="hidden" id="hiddenSearchPageNum" value="<?php echo $pageNum; ?>">
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop; ?>">Trang chủ</a></li>
        <li><a>Tìm kiếm</a></li>
        <li style="float: right; margin-right: 35px;"><a>Hiện có <strong><?php echo $totalRows; ?></strong> kết quả </a></li>
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
                       $cate1 = get_records("tbl_shop_category","status=0 AND parent='2'","name COLLATE utf8_unicode_ci"," "," ");
                        while($row_cate1 = mysql_fetch_assoc($cate1)){?>
                            <li><a href="<?php echo $linkrootshop; ?>/<?php echo $row_cate1['subject']; ?>.html" title=""><?php echo $row_cate1['name']; ?></a></li>
                    <?php }?>
                </ul>
                <div class="clear"></div>
            </div><!-- End .m-cate -->
        </div><!-- End .catelog -->
    </div><!-- End .sidebar -->

    <div class="content">
        <?php if($totalRows != 0){ ?>
        <section class="filter-Prod">
            <h4 class="t-Pnb">
                <div class="clear"></div>
                <div class="f-sty-P">
                    <ul>
                        <li><a class="f-sty-P1" href="javascript:void(0);" onclick="$('.s-Pnb').hide(); $('.n-Pnb').css('text-align', 'center'); $('label').width('100%');"></a></li>
                        <li><a class="f-sty-P2" href="javascript:void(0);" onclick="$('.s-Pnb').show(); $('.n-Pnb').css('text-align', 'left'); $('label').width('inherit');"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div><!-- End .f-sty-P -->
            </h4>
            <input type="hidden" id="hiddenSearchProd" value="1">
            <script type="text/javascript" src="<?php echo $linkrootshop; ?>/scripts/jquery_cookie.js"></script>
            <script type="text/javascript" src="<?php echo $linkrootshop; ?>/scripts/script_prod.js"></script>
        </section><!-- End .filter-Prod -->
        
        <section class="Prod-cate">
            <ul>
				<?php 
                while($row_new = mysql_fetch_assoc($product)){
			    $shop = getRecord('tbl_shop', "id='".$row_new['idshop']."'"); ?>
                <li class="li-Pc1 hvr-glow">
                    <div class="i-Pnb">
                        <a <?php if($row_new['target'] == 1){echo "target='_blank'";} ?> href="<?php if($row_new['other_link'] != ''){echo $row_new['other_link'];}else{echo $linkrootshop.'/'.$row_new['subject'].'.html';} ?>" title="<?php echo $row_new['title']; ?>">
                            <img src="<?php echo $linkroot; ?>/<?=$row_new['image']?>" alt="<?php echo $row_new['title']; ?>"/>
                        </a>
                    </div><!-- End .i-Pnb -->
                    <div class="prod_row1">
                        <a <?php if($row_new['target'] == 1){echo "target='_blank'";} ?> class="n-Pnb<?php if($row_new['style'] == 1 || $row_new['style'] == 3){echo ' n-search';} ?>" href="<?php if($row_new['other_link'] != ''){echo $row_new['other_link'];}else{echo $linkrootshop.'/'.$row_new['subject'].'.html';} ?>"><b><?php echo $row_new['name']; ?></b></a>
                        <span class="s-Pnb s-DetailShort"><?php echo $row_new['detail_short']; ?></span>
                        <div class="clear"></div>
                    </div><!-- End .prod_row1 -->
                    <div class="prod_row2">
                        Lượt xem
                        <br/>
                        <p><span class="spanViews"><?php echo $row_new['view']; ?></span></p>
                    </div><!-- End .prod_row2 -->
                    <div class="prod_row3">
                        Ngày đăng 
                        <br/>
                        <p><span class="spanViews"><?php echo date("d-m-Y", strtotime($row_new['date_added'])); ?></span></p>
                    </div><!-- End .prod_row3 -->
                    <?php if($row_new['style'] == 0 || $row_new['style'] == 2 || $row_new['style'] == 4){ ?>
                    <span class="price-Pnb">
                         <?php
                         if($row_new['pricekm'] > 0){
                             if($row_new['currency'] == 0){
                                 echo number_format($row_new['pricekm'],0)."đ";
                             }else{
                                 echo "$".number_format($row_new['pricekm'],0);
                             }
                             echo " / ".ucfirst($row_new['unit']);
                         }else if($row_new['price'] > 0){
                             if($row_new['currency'] == 0){
                                 echo number_format($row_new['price'],0)."đ";
                             }else{
                                 echo "$".number_format($row_new['price'],0);
                             }
                             echo " / ".ucfirst($row_new['unit']);
                         }else{
                             echo "Giá: Liên hệ";
                         } ?>
                    </span>
                    <?php } ?>
                    <div class="clear"></div>
                </li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </section><!-- End .Prod-cate -->
        
        <div class="frame_phantrang">
            <div class="PageNum" id="divSearchPag">
                <?php
                    echo pagesLinks_new_full_2013($totalRows, $pageSize , "","","tim-kiem/".$_GET['loai']."/".str_replace(" ", "-", $_GET['tukhoa']));
                ?>
            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->
        <?php }else{ ?>
            <div class="divUpdating">
                <p>Hệ thống không tìm thấy dữ liệu bạn yêu cầu.</p>
            </div>
        <?php } ?>
    </div><!-- End .content -->
    <div class="clear"></div>
</section><!-- End .f-ct -->	
