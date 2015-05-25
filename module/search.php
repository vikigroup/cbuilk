<?php
	if(isset($_GET['tukhoa'])) {$tukhoa=$_GET['tukhoa'];if($tukhoa=="tat-ca") $tukhoa="";$_SESSION['kh_tukhoa']=$tukhoa;}
    $tukhoa = str_replace(".", "", $tukhoa);
	if(isset($_GET['loai'])) { if($_GET['loai']=="tat-ca") $parent1=2;else $parent1=$_GET['loai'];settype($parent1,"int");$_SESSION['kh_theloai']=$parent1;}
	 
	$parent=getParent("tbl_shop_category",$parent1);
	
	if($parent1==2) $str_tim="";
	else $str_tim="AND parent1 in ({$parent})";

    $link = $_SERVER['REQUEST_URI'];
    $myLink = explode("?", $link);
    $myPage = explode("=", $myLink[1]);
    $pageNum = $myPage[1];

	$pageSize = 20;
	$totalRows = 0;
	$xeptheo='id';
	$dem=1;
	
    $sapxep="date_added DESC";
	
	settype($pageSize,"int");
	settype($pageNum,"int");
	settype($totalRows,"int");
	settype($dem,"int");

	if ($pageNum<=0) $pageNum=1;
	$startRow = ($pageNum-1) * $pageSize;

    $totalRows = countRecord("tbl_item","status=0  AND cate=0 $str_tim  AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' )"); 
	 //echo "status=0 AND type=0 AND cate=0 $str_tim  AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' ) order by $sapxep limit ".$startRow.",".$pageSize;
	$product=get_records("tbl_item","status=0 AND cate=0 $str_tim AND (  name LIKE '%$tukhoa%' or detail_short LIKE '%$tukhoa%' or detail LIKE '%$tukhoa%'  or title LIKE '%$tukhoa%' or keyword LIKE '%$tukhoa%') order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
?>

<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a> Tìm kiếm</a></li>
        <li><a href="#">Hiện có <strong><?php echo $totalRows;?></strong> kết quả </a></li>
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
				   $cate1=get_records("tbl_shop_category","status=0 AND parent='2'","name COLLATE utf8_unicode_ci"," "," ");
					 
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
                <div class="clear"></div>
                <div class="f-sty-P">
                    <ul>
                        <li><a class="f-sty-P1" href="javascript:void(0)" onclick="$('label').width('100%');"></a></li>
                        <li><a class="f-sty-P2" href="javascript:void(0)" onclick="$('label').width('inherit');"></a></li>
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
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><b><?php echo $row_new['name'];?></b></a>
                        <?php if($row_new['idshop'] != 0){ ?>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><label><i class="icon-shopping-cart"></i><?php echo $shop['subject'];?></label></a>
                        <?php } else{ ?>
                        <a class="s-Pnb" href="http://<?php echo $linkrootshop ;?>"><label><i class="icon-shopping-cart"></i><?php echo $subname ;?></label></a>
                        <?php } ?>
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
                    <?php if($row_new['style'] == 0){ ?>
                    <span class="price-Pnb"><?php  if($row_new['pricekm'] > 0){echo number_format($row_new['pricekm'],0)."  VNĐ";}else if($row_new['price'] > 0){echo number_format($row_new['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></span>
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
                        echo pagesLinks_new_full_2013($totalRows, $pageSize , "","","tu-khoa-tim/".$_GET['loai']."/".str_replace(" ", "-", $_GET['tukhoa']));
                        ?>

            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .content -->
    
    <div class="clear"></div>
</section><!-- End .f-ct -->	

<script>
    $(function(){
        $('.f-sty-P1').trigger('click');
        var length = $('#divSearchPag a').length;
        var link = $('#divSearchPag a').attr('href');
        var myArr = link.split("/");
        var page = myArr[5].substr(0,1);
        var pageNum = "<?php echo $pageNum ?>";
        var linkAfter = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=";
        for(var i = 0; i < length - 1; i++){
            $('#divSearchPag a:nth-child('+(i+1)+')').attr('href', linkAfter+(i+1));
        }

        $('#divSearchPag').find('span').remove();
        var firstPage = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=1";
        var previous =  myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(parseInt(pageNum)-1);
        var next = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(parseInt(pageNum)+1);
        var lastPage = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(length-1);
        if(pageNum == length - 1){
            next = lastPage;
        }
        if(pageNum-1 == 0){
            previous = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=1";
        }

        $('#divSearchPag').prepend("<a href="+firstPage+">1</a>");
        $('#divSearchPag').prepend("<a href="+previous+">&lsaquo;</a>");
        $('#divSearchPag').prepend("<a href="+firstPage+">&#171;</a>");

        $('#divSearchPag a:nth-child('+(length+2)+')').attr('href', next);
        $('#divSearchPag a:nth-child('+(length+3)+')').attr('href', lastPage);
    });
</script>
