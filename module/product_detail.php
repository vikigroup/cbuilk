<?php
$tensanpham=$_GET['tensanpham'];
$row_sanpham   = getRecord('tbl_item', "subject='".$tensanpham."'");

if($row_sanpham['id']!="")   {
	$sql = "update tbl_item set view=view+1 where id='".$row_sanpham['id']."'";
	mysql_query($sql);
	$idshop=$row_sanpham['idshop'];
	$ghinho=1;
}else{
	if(isset($_GET['tensanpham'])) {
		$danhmuc=$_GET['tensanpham'];
		$parent1=get_field('tbl_shop_category','subject',$danhmuc,'id');
		if($parent1=="")  echo  '<script>window.location="'.'404-page-not-found.html" </script>';
	}
	$parent=getParent("tbl_shop_category",$parent1);
	$ghinho=2;
}

if($ghinho==1){ // prodetail

?>
<script type="text/javascript" >
	$(document).ready(function() {
		$(".btn_prod_details").click(function(){;
			var sl=$("#qty").val();
			var nameshop=$("#name_shop").val();
			var id=$("#id").val();	
			$(location).attr('href', 'http://'+nameshop+'.<?php echo $sub;?>?act=add_item&id='+id+'&sl='+sl);

		});
	});
</script>
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <?php
		$cha=get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'parent');
        if($cha==2){
		?>
        <li><a href="<?php echo $linkrootshop;?><?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'subject');?>.html"  title="<?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'name');?>"><?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'name');?></a></li>
        <?php }?>
        <li><a href="<?php echo $linkrootshop;?><?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'subject');?>.html" title="<?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'name');?>"><?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'name');?></a></li>
        <li><a title="<?php echo $row_sanpham['name'];?>"><?php echo $row_sanpham['name'];?> </a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->

<section class="f-cont">
    
    <div class="l-fcont">
        
        <h1 class="t-lfcont"  >
            <?php echo $row_sanpham['name'];?>   
        </h1><!-- End .t-lfcont -->
        <?php if($row_sanpham['type']==0){?> 
        <div class="sli-lfcont">
            
            <div class="sli-fcon-1">
                <ul class="ul-sli-fcon-1">
                	
					<?php
                    $hinh=get_records("tbl_ad","idshop='{$idshop}' AND name='' AND iditem=".$row_sanpham['id'],"id DESC","0,10"," ");
					$demm=mysql_num_rows($hinh);
					if($demm>0){
                    while($row_hinh=mysql_fetch_assoc($hinh)){
                    ?>
                    <li><img src="<?php echo $linkroot;?>/<?php echo $row_hinh['image'];?>" /></li>
                    <?php }} else { ?>
                    <li><img src="<?php echo $linkroot;?>/<?php echo $row_sanpham['image'];?>" alt=""/> </li> 
                    <?php }?> 
                </ul>
            </div>
            
            <div id="sli-fcon-2">
				<?php
                $hinh=get_records("tbl_ad","idshop='{$idshop}' AND name='' AND iditem=".$row_sanpham['id'],"id DESC","0,10"," ");
				$i=0;
                while($row_hinh=mysql_fetch_assoc($hinh)){
                ?>
                <a data-slide-index="<?php echo $i;?>" href=""><img src="<?php echo $linkroot;?>/<?php echo $row_hinh['image'];?>" /></a>
               	<?php $i++;}?>
               
            </div>
            
            <div class="clear"></div>
            
            <script type="text/javascript">
                $('.ul-sli-fcon-1').bxSlider({
                    pagerCustom: '#sli-fcon-2',
                    infiniteLoop: false,
                    controls: false,
                    mode: 'fade',
                    adaptiveHeight: true
                });
            </script>
            
        </div><!-- End .sli-lfcont -->
        
        <?php }?>
        
        
        <?php if($row_sanpham['type']==0){?> 
        <h4 class="t-ttct">
            Thông tin chi tiết sản phẩm
        </h4><!-- End .t-ttct -->
        <?php }else{?>
        <h4 class="t-ttct" style="padding-top:0px;">
        
        </h4><!-- End .t-ttct -->
        <?php }?>
        
        <div class="f-ndct">
        
           <?php echo $row_sanpham['detail'];?> 
        
            <div class="clear"></div>
        </div><!-- End .f-ndct -->
        
        <div class="face-cmm">
    
            
        
        </div><!-- End .face-cmm -->
        
    </div><!-- End .l-fcont -->
    
    <div class="r-fcont">
        <?php $shop=getRecord('tbl_shop', "id='".$row_sanpham['idshop']."'");?>
        <?php 
		if($row_sanpham['type']==0){
		?>
        <div class="gbsp">
            <span>Giá bán sản phẩm:</span>
            <h1><?php  if(preg_match ("/^([0-9]+)$/", $row_sanpham['price'])) echo number_format($row_sanpham['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></h1>
        </div><!-- End .gbsp -->
        
        <div class="slsp">
        
          
            
                <span>Số lượng mua</span> 
                <input name="id" id="id" value="<?php echo $row_sanpham['id'];?>" type="hidden" />
                <input id="qty" name="qty" class="ipt_prod_details" type="text" value="1"/>
                <input name="name_shop" id="name_shop" value="<?php echo $shop['subject'];?>" type="hidden" />
                <input class="btn_prod_details" type="submit" value="&#10009; THÊM VÀO GIỎ HÀNG"/>

                <div class="clear"></div>
            
             
        
        </div><!-- End .slsp -->
        <?php }?>

        <div id="closed"></div>
        <a href="#popup" class="popup-link" onclick="$('.popup-container').show();">ĐẶT MUA</a>
        <div class="popup-wrapper" id="popup">
            <div class="popup-container"><!-- Popup Contents, just modify with your own -->
                <div class="popup-image">
                    <?php
                    $demm=mysql_num_rows($hinh);
                    if($demm>0){
                        while($row_hinh=mysql_fetch_assoc($hinh)){
                            ?>
                            <img src="<?php echo $linkroot;?>/<?php echo $row_hinh['image'];?>" />
                        <?php }} else { ?>
                        <img src="<?php echo $linkroot;?>/<?php echo $row_sanpham['image'];?>" alt=""/>
                    <?php }?>
                    <h1><?php echo $row_sanpham['name'];?></h1>
                    <h1 class="popup-price"><?php  if(preg_match ("/^([0-9]+)$/", $row_sanpham['price'])) echo number_format($row_sanpham['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></h1>
                </div>
                <div class="popup-checkout">
                    <div class="popup-form">
                        <div class="input-group">
                            <p><input type="text" id="txtNamePopup" placeholder="Tên người nhận"></p>
                            <p><input type="text" id="txtPhonePopup" placeholder="Điện thoại (bắc buộc)"></p>
                            <p><input type="text" id="txtAddressPopup" placeholder="Địa chỉ"></p>
                            <p><input type="email" id="emailPopup" placeholder="Email (bắc buộc)"></p>
                            <p><input type="button" value="XÁC NHẬN" id="btnConfirmPopup"></p>
                        </div>
                    </div>
                </div>
                <div class="popup-footer">
                    <input checked="checked" class="checked" id="popupAccept" type="checkbox" value="true">
                    Tôi đồng ý với <a href="#" target="_blank" style="color: #4a90e2">Chính sách và quy định đặt hàng trực tuyến</a>
                </div>
                <!-- Popup Content is untill here--><a class="popup-close" href="#closed" onclick="$('.popup-container').hide();">X</a>
            </div>
        </div>

        <div class="clear"></div>

        <div class="info_prod_details">
        
            <ul>
                <!--<li>
                    <h4 class="l_ipd">Tình trạng sản phẩm</h4>
                    <span class="r_ipd">Đã duyệt</span>
                    <div class="clear"></div>
                </li>-->
                <li>
                    <h4 class="l_ipd">Ngày đăng <?php if($row_sanpham['type']==0) echo "sản phẩm";else echo "Dịch vụ";?></h4>
                    <span class="r_ipd"><?php echo $row_sanpham['date_added'];?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <h4 class="l_ipd">Số lần xem</h4>
                    <span class="r_ipd"><?php echo $row_sanpham['view'];?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <h4 class="l_ipd">Chia sẻ</h4>
                    <span class="r_ipd">
                    
                        <!-- Lockerz Share BEGIN -->
                        <div class="a2a_kit a2a_default_style">
                        <a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
                        <span class="a2a_divider"></span>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                        </div>
                        <script type="text/javascript" src="<?php echo $linkrootshop?>/scripts/page.js"></script>
                        <!-- Lockerz Share END -->
                    
                    </span>
                    <div class="clear"></div>
                </li>
            </ul>	
        
        </div><!-- End .info_prod_details -->

        <div class="block_prod_details">
            
            <div class="info_gh">
            
                <div>
                    <div class="i_p_prod_details">
                        <a href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>" title="">
                            <img src="<?php echo $linkroot?>/<?php echo $shop['logo'];?>" alt=""/>
                        </a>
                    </div>
                    <div class="i_gh_details">
                        <h3>
                            <a href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>" title=""><?php echo $shop['name'];?></a>
                        </h3>
                        <p>Ngày mở shop: <?php echo $shop['date_added'];?></p>
                        <!--<span>Chủ shop: Lê Thu Thúy</span>-->
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div style="padding-top:10px;">
                    <h4>Thông tin chi tiết</h4>
                    <ul class="f_iod">
                        <li>
                        
                            <span class="s1_iod">Địa chỉ</span>
                            
                            <span class="s2_iod"><?php echo $shop['address'];?></span>
                            
                            <div class="clear"></div>
                        
                        </li>
                        <li>
                        
                            <span class="s1_iod">Điện thoại</span>
                            
                            <span class="s2_iod"><?php echo $shop['mobile'];?></span>
                            
                            <div class="clear"></div>
                        
                        </li>
                        <li>
                        
                            <span class="s1_iod">Email</span>
                            
                            <span class="s2_iod"><?php echo $shop['email'];?></span>
                            
                            <div class="clear"></div>
                        
                        </li>
                        <li>
                        
                            <span class="s1_iod">Hỗ trợ</span>
                            
                            <span class="s2_iod">
                                <img src='http://opi.yahoo.com/online?u=<?php echo $shop['yahoo'];?>&m=g&t=5&l=vi' alt ='' />
                                <a href='ymsgr:sendIM?<?php echo $shop['yahoo'];?>'><?php echo $shop['yahoo'];?></a>
                            </span>
                            
                            <div class="clear"></div>
                        
                        </li>
                    </ul><!-- End .f_iod -->
                </div>
            
            </div><!-- End .info_gh -->
            
        </div><!-- End .block_prod_details -->
        
        <div class="block_prod_details">
        
            <div class="f_prod_other">
                
                <h1 class="title_prod_other">
                     <?php if($row_sanpham['cate']==0) echo "sản phẩm";else echo "Dịch vụ"?> của chúng tôi
                </h1><!-- End .title_prod_other -->
                
                <div class="main_prod_other">
                    <ul>
                    <?php 
					$shop_product=get_records("tbl_item","status=0 AND cate='".$row_sanpham['cate']."' AND idshop=".$row_sanpham['idshop'],"id DESC","0,5"," ");
					while($row_shop_product=mysql_fetch_assoc($shop_product)){
					?>
                        <li>
                            <span class="s1_po">
                                <div>
                                    <span>
                                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>">
                                            <img src="<?php echo $linkroot?>/<?php echo $row_shop_product['image'];?>" alt=""/>
                                        </a>
                                    </span>
                                </div>
                            </span>
                            <span class="s2_po">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>"><?php echo $row_shop_product['name'];?></a>
                                </h4>
                                <?php 
								if($row_sanpham['type']==0){
								?>
                                <p><?php  if(preg_match ("/^([0-9]+)$/", $row_shop_product['price'])) echo number_format($row_shop_product['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></p>
                                <?php }else {?>
                                <p style="font-size:12px; color:#000; margin-top:2px;">Số lần xem:<?php echo $row_shop_product['view'];?> </p>
                                <p style="font-size:12px; color:#000;">Ngày đăng:<?php echo date("d-m-Y", strtotime($row_shop_product['date_added']))?></p>
                                <?php if($shop['mobile']!=""){?>
                                <p style="font-size:12px; color:#000;">Hồ trợ: <?php echo $shop['mobile'];?> </p>
                                <?php }?>
                                <?php }?>
                            </span>
                            <div class="clear"></div>
                        </li>
                      <?php }?>   
                        
                    </ul>
                </div><!-- End .main_prod_other -->
                
                <div style="text-align:right;">
                    <a class="rm_prod_other" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"  target="_blank" title="<?php echo $shop['name']?>">Xem thêm sản phẩm</a>
                </div>
                
            </div><!-- End .f_prod_other -->
        
        </div><!-- End .block_prod_details -->
        
        <div class="block_prod_details">
        
            <div class="f_prod_other">
                
                <h1 class="title_prod_other">
                    <?php if($row_sanpham['type']==0) echo "sản phẩm";else echo "Dịch vụ"?> cùng loại
                </h1><!-- End .title_prod_other -->
                
                <div class="main_prod_other">
                    <ul>
                    <?php 
					$shop_product=get_records("tbl_item","status=0 AND type='".$row_sanpham['type']."' AND parent=".$row_sanpham['parent'],"id DESC","0,5"," ");
					while($row_shop_product=mysql_fetch_assoc($shop_product)){
					$shop_other=getRecord('tbl_shop', "id='".$row_shop_product['idshop']."'");
					?>
                        <li>
                            <span class="s1_po">
                                <div>
                                    <span>
                                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>">
                                            <img src="<?php echo $linkroot?>/<?php echo $row_shop_product['image'];?>" alt=""/>
                                        </a>
                                    </span>
                                </div>
                            </span>
                            <span class="s2_po">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>"><?php echo $row_shop_product['name'];?></a>
                                </h4>
                                <span>
                                    <a href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>" target="_blank" title="<?php echo $shop['name'];?>"> <?php echo $shop['name'];?></a>
                                </span>
                                 <?php if($row_sanpham['type']==0){?>
                                <p><?php  if(preg_match ("/^([0-9]+)$/", $row_shop_product['price'])) echo number_format($row_shop_product['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></p>
                                <?php }?>
                            </span>
                            <div class="clear"></div>
                        </li>
                       <?php }?>  
                    </ul>
                </div><!-- End .main_prod_other -->
                
              
                
            </div><!-- End .f_prod_other -->
        
        </div><!-- End .block_prod_details -->
        
    </div><!-- End .r-fcont -->
    
    <div class="clear"></div>                
</section><!-- End .f-cont -->

 


<?php }else {?>
<?php
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
//echo "status=0 AND parent='{$parent}' limit ".$startRow.",".$pageSize;
$product=get_records("tbl_item","status=0 AND type=0 AND parent1 in ({$parent}) order by $xapxep limit ".$startRow.",".$pageSize," "," "," ");
?>
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a href="<?php echo $linkrootshop;?><?php echo $tensanpham;?>.html"><?php echo get_field('tbl_shop_category','subject',$tensanpham,'name');?></a></li>
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
                    if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "http://shop.jbs.vn","p","page-danh-muc/".$_GET['tensanpham']);}
                    else echo pagesLinks_new_full_2013($totalRows, $pageSize , "http://shop.jbs.vn","p","page-danh-muc/".$_GET['tensanpham']."/");
                    ?>

            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .content -->
    
    <div class="clear"></div>
</section><!-- End .f-ct -->

<?php }?>

<script>
    $('#btnConfirmPopup').click(function(){
        var name = $('#txtNamePopup').val();
        var phone = $('#txtPhonePopup').val();
        var address = $('#txtAddressPopup').val();
        var email = $('#emailPopup').val();
        if(phone == '' || email == ''){
            alert("Điện thoại và email là các thông tin bắc buộc. Xin vui lòng không được để trống...");
        }
        else if($('#popupAccept').is(':checked') == false){
            alert("Bạn chưa đồng ý với chính sách của chúng tôi...");
        }
        else{
            var dataString = "name="+name+"&phone="+phone+"&address="+address+"&email="+email;
            alert(dataString);
        }
    });
</script>