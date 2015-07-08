<?php
$tensanpham=$_GET['tensanpham'];
$row_sanpham   = getRecord('tbl_item', "subject='".$tensanpham."'");
$row_category  = getRecord('tbl_shop_category', "subject='".$tensanpham."'");
$brand_style = explode(",", $row_sanpham['brand_style']);
$brand_background = $brand_style[0];
$brand_color = $brand_style[1];

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

if($row_sanpham['idshop'] == 0){
    $row_support   = getRecord('tbl_support', "idshop=0");
    $row_config   = getRecord('tbl_config', "id='2'");
}

if($ghinho==1){ // prodetail

?>
<input id="customerID" value="<?php echo $idKH=$_SESSION['kh_login_id']; ?>" type="hidden"/>
<input name="id" id="id" value="<?php echo $row_sanpham['id'];?>" type="hidden"/>
<input name="name_shop" id="name_shop" value="<?php echo $shop['subject'];?>" type="hidden"/>
<input id="hiddenProductPrice" type="hidden" value="<?php echo $row_sanpham['price']; ?>">
<input id="hiddenShopID" type="hidden" value="<?php echo $row_sanpham['idshop']; ?>">

<script type="text/javascript" >
	$(document).ready(function() {
		$(".btn_prod_details").click(function(){
			var sl=$("#qty").val();
			var nameshop=$("#name_shop").val();
			var id=$("#id").val();	
			$(location).attr('href', 'http://'+nameshop+'.<?php echo $sub;?>?act=add_item&id='+id+'&sl='+sl);
		});
	});
</script>
<section class="breacrum">
    <ul>
        <?php
        if($row_sanpham['style']==1){$news=getRecord('tbl_shop_category', "id=211");?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo $news['subject'];?>.html"><?php echo $news['name'];?></a></li>
        <?php $row_parent = getRecord('tbl_shop_category', "id=".$row_sanpham['parent1']); ?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo get_field('tbl_shop_category','id',$row_parent['parent'],'subject');?>.html"><?php echo get_field('tbl_shop_category','id',$row_parent['parent'],'name');?></a></li>
        <?php } ?>
        <?php
		$cha=get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'parent');
        if($cha==2){
		?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'subject');?>.html"  title="<?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'title');?>"><?php echo get_field('tbl_shop_category','id',get_field('tbl_shop_category','id',$row_sanpham['parent1'],'parent'),'name');?></a></li>
        <?php }?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'subject');?>.html" title="<?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'title');?>"><?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'name');?></a></li>
        <li><a title="<?php echo $row_sanpham['title'];?>"><?php echo $row_sanpham['name'];?> </a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->

<section class="f-cont">
    
    <div class="l-fcont">
        
        <h1 class="t-lfcont"  >
            <?php echo $row_sanpham['name'];?>   
        </h1><!-- End .t-lfcont -->

        <p><?php echo $row_sanpham['detail_short'];?></p>

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
        
        <?php if($row_sanpham['style']==0 || $row_sanpham['style']==4 || $row_sanpham['style']==2){?>
        <h4 class="t-ttct">
            Thông tin chi tiết
        </h4><!-- End .t-ttct -->
        <?php }else{?>
        <h4 class="t-ttct" style="padding-top:0px;">
            Nội dung chi tiết
        </h4><!-- End .t-ttct -->
        <?php }?>

        <div class="f-ndct">
        
           <?php echo $row_sanpham['detail'];?> 
        
            <div class="clear"></div>
        </div><!-- End .f-ndct -->
        
        <div class="face-cmm">
            <div class="fb-comments" data-href="<?php echo $linkrootshop;?>/<?php echo $row_sanpham['subject'];?>.html" data-numposts="5" data-width="inherit" data-colorscheme="light"></div>
        </div><!-- End .face-cmm -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '1460618637571000',
                    xfbml      : true,
                    version    : 'v2.3'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </div><!-- End .l-fcont -->
    
    <div class="r-fcont">
        <?php $shop=getRecord('tbl_shop', "id='".$row_sanpham['idshop']."'");?>
        <?php if($row_sanpham['style'] != 1 && $row_sanpham['style'] != 3){ ?>
        <div class="gbsp">
            <span> <?php if($row_sanpham['style']==0 || $row_sanpham['style']==4){echo "Giá bán sản phẩm:";}else if($row_sanpham['style']==2){echo "Giá dịch vụ:";} ?></span>
            <h1><?php if($row_sanpham['pricekm'] > 0){echo number_format($row_sanpham['pricekm'],0)."  VNĐ";}else if($row_sanpham['price'] > 0){echo number_format($row_sanpham['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></h1>
        </div><!-- End .gbsp -->
        <?php } ?>

        <?php if($row_sanpham['style']==0 || $row_sanpham['style']==4 || $row_sanpham['style']==2){?>
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
                    <span>Số lượng mua</span>
                    <input id="qtyPopup" type="number" min="1" value="1" onchange="setMoney();"/>
                </div>
                <div class="popup-checkout">
                    <div class="popup-form">
                        <div class="input-group">
                            <p><input type="text" id="txtNamePopup" placeholder="Tên người mua"></p>
                            <p><input type="text" id="txtPhonePopup" placeholder="Điện thoại (bắt buộc)"></p>
                            <p><input type="text" id="txtAddressPopup" placeholder="Địa chỉ"></p>
                            <p><input type="email" id="emailPopup" placeholder="Email (bắt buộc)"></p>
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
        <?php } ?>

        <div class="clear"></div>

        <div class="info_prod_details">
        
            <ul>
                <li>
                    <h4 class="l_ipd">Ngày đăng </h4>
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
                    
                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_google_plus"></a>
                            <a class="a2a_button_pinterest"></a>
                        </div>
                        <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->

                    </span>
                    <div class="clear"></div>
                </li>
            </ul>	
        
        </div><!-- End .info_prod_details -->

        <div class="block_prod_details">
            
            <div class="info_gh">
                <?php if($row_sanpham['style'] != 1){ ?>
                <div>
                    <div class="i_p_prod_details">
                        <?php if($row_sanpham['idshop'] == 0){ ?>
                        <a href="http://<?php echo $root;?>" title="<?php echo $row_sanpham['title'];?>">
                            <img src="<?php echo $root;?>/imgs/layout/logo.png" alt="<?php echo $row_sanpham['title'];?>"/>
                        </a>
                        <?php } else{ ?>
                        <a href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>" title="<?php echo $shop['title'];?>">
                            <img src="<?php echo $linkroot?>/<?php echo $shop['logo'];?>" alt="<?php echo $shop['title'];?>"/>
                        </a>
                        <?php } ?>
                    </div>
                    <?php if($row_sanpham['idshop'] == 0){ ?>
                    <div id="divBrand" class="i_gh_details" <?php if($brand_background != ''){echo "style='background-color: ".$brand_background."'";} ?>>
                        <h3>
                            <a href="<?php echo $row_sanpham['brand_link']; ?>" title="<?php echo $row_sanpham['brand_name']; ?>" id="aBrand" <?php if($brand_color != ''){echo "style='color: ".$brand_color."'";} ?>><?php echo $row_sanpham['brand_name']; ?></a>
                            <?php if($_SESSION['kt_login_level'] == 3){ ?>
                            <a href="#fadeandscale" class="initialism fadeandscale_open btn-edit button-transparent pure-button" title="Nhấn để chỉnh sửa"><i class="fa fa-pencil"></i></a>

                                <!-- Fade & scale -->
                                <div id="fadeandscale" class="well">
                                    <h4>Chỉnh sửa thương hiệu</h4>
                                    <form class="pure-form pure-form-aligned" id="popBrandForm">
                                        <fieldset>
                                            <div class="pure-control-group">
                                                <label for="popBrandName">Tên thương hiệu</label>
                                                <input id="popBrandName" type="text" value="<?php echo $row_sanpham['brand_name']; ?>" required>
                                            </div>
                                            <div class="pure-control-group">
                                                <label for="popBrandLink">Đường dẫn</label>
                                                <input id="popBrandLink" type="text" value="<?php echo $row_sanpham['brand_link']; ?>" required onchange="addhttp(this.id, this.value)">
                                            </div>
                                            <div class="pure-control-group">
                                                <label for="popBrandBG">Màu nền</label>
                                                <input type="text" id="popBrandBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popColorBG').val($('#popBrandBG').val());"/>
                                                <input type="color" id="popColorBG" value="<?php if($brand_background != ''){echo $brand_background;}else{echo "#000000";} ?>" onchange="$('#popBrandBG').val(this.value);">
                                            </div>
                                            <div class="pure-control-group">
                                                <label for="popBrandFC">Màu chữ</label>
                                                <input type="text" id="popBrandFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popColorFC').val($('#popBrandFC').val());"/>
                                                <input type="color" id="popColorFC" value="<?php if($brand_color != ''){echo $brand_color;}else{echo "#ffffff";} ?>" onchange="$('#popBrandFC').val(this.value);">                                            </div>
                                        </fieldset>
                                        <button type="submit" class="button-success pure-button" id="popBrandSubmit">Hoàn tất</button>
                                        <button class="fadeandscale_close button-error pure-button" id="popBrandClose">Đóng</button>
                                    </form>
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        $('#fadeandscale').popup({
                                            pagecontainer: '.container',
                                            transition: 'all 0.3s'
                                        });
                                    });
                                </script>
                            <?php } ?>
                        </h3>
                    </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
                <?php } ?>

                <?php if($row_sanpham['style'] != 1 && $row_sanpham['style'] != 3){?>
                <div style="padding-top:10px;">
                    <h4>Thông tin chi tiết</h4>
                    <ul class="f_iod">
                        <li>
                            <span class="s1_iod">Địa chỉ</span>
                            <span class="s2_iod"><?php if($row_sanpham['idshop'] == 0){ echo $row_config['dckh'];} else{echo $shop['address'];}?></span>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <span class="s1_iod">Điện thoại</span>
                            <span class="s2_iod"><?php if($row_sanpham['idshop'] == 0){ echo $row_config['dtkh'];} else{echo $shop['telephone'];}?></span>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <span class="s1_iod">Hotline</span>
                            <span class="s2_iod s2_hotline"><?php if($row_sanpham['idshop'] == 0){ echo $row_config['hotlinekh'];} else{echo $shop['hotline'];}?></span>
                            <div class="clear"></div>
                        </li>
                        <li>
                            <span class="s1_iod">Email</span>
                            <span class="s2_iod"><?php if($row_sanpham['idshop'] == 0){ echo $row_config['emailkh'];} else{echo $shop['email'];}?></span>
                            <div class="clear"></div>
                        </li>
                    </ul><!-- End .f_iod -->
                </div>
                <?php } ?>
            </div><!-- End .info_gh -->
            
        </div><!-- End .block_prod_details -->

        <div class="block_prod_details">
            <div class="f_prod_other">
                <h1 class="title_prod_other">
                     <?php if($row_sanpham['style'] == 1){echo "Tin xem nhiều nhất";} else if($row_sanpham['style'] == 0 || $row_sanpham['style'] == 4) echo "Sản phẩm xem nhiều nhất";else if($row_sanpham['style']==2) echo "Dịch vụ xem nhiều nhất";else echo "Video xem nhiều nhất";?>
                </h1><!-- End .title_prod_other -->
                <div class="main_prod_other">
                    <ul>
                    <?php 
					$shop_product=get_records("tbl_item","status=0 AND style='".$row_sanpham['style']."' AND idshop=".$row_sanpham['idshop'],"view DESC","0,10"," ");
					while($row_shop_product=mysql_fetch_assoc($shop_product)){
					?>
                        <li>
                            <span class="s1_po">
                                <div>
                                    <span>
                                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['title'];?>">
                                            <img src="<?php echo $linkroot?>/<?php echo $row_shop_product['image'];?>" alt="<?php echo $row_shop_product['title'];?>"/>
                                        </a>
                                    </span>
                                </div>
                            </span>
                            <span class="s2_po">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['title'];?>"><?php echo $row_shop_product['name'];?></a>
                                </h4>
                                <?php 
								if($row_sanpham['style']==0){
								?>
                                <p><?php if($row_shop_product['pricekm'] > 0){echo number_format($row_shop_product['pricekm'],0)."  VNĐ";}else if($row_shop_product['price'] > 0){echo number_format($row_shop_product['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></p>
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
                    <?php if($row_sanpham['style'] == 1){$news = getRecord('tbl_shop_category', "id=211"); ?>
                        <a class="rm_prod_other" href="<?php echo $root ;?>/<?php echo $news['subject']; ?>.html" title="<?php echo $news['title']; ?>">Xem thêm tin tức</a>
                    <?php } else if($row_sanpham['style'] == 2){$rent=getRecord('tbl_shop_category', "id=209"); ?>
                        <a class="rm_prod_other" href="<?php echo $root ;?>/<?php echo $rent['subject']; ?>.html" title="<?php echo $rent['title']; ?>">Xem thêm dịch vụ</a>
                    <?php } else if($row_sanpham['style'] == 0){$allProducts = getRecord('tbl_shop_category', "id=457"); ?>
                        <a class="rm_prod_other" href="<?php echo $root ;?>/<?php echo $allProducts['subject']; ?>.html" title="<?php echo $allProducts['title']; ?>">Xem thêm sản phẩm</a>
                    <?php } else if($row_sanpham['style'] == 4){$old=getRecord('tbl_shop_category', "id=210"); ?>
                        <a class="rm_prod_other" href="<?php echo $root ;?>/<?php echo $old['subject']; ?>.html" title="<?php echo $old['title']; ?>">Xem thêm sản phẩm</a>
                    <?php } else if($row_sanpham['style'] == 3){$video=getRecord('tbl_shop_category', "id=390"); ?>
                    <a class="rm_prod_other" href="<?php echo $root ;?>/<?php echo $video['subject']; ?>.html" title="<?php echo $video['title']; ?>">Xem thêm video</a>
                    <?php } ?>
                </div>
                
            </div><!-- End .f_prod_other -->
        </div><!-- End .block_prod_details -->
        
        <div class="block_prod_details">
            <div class="f_prod_other">
                <h1 class="title_prod_other">
                    <?php if($row_sanpham['style'] == 1){echo "Tin tức liên quan";} else if($row_sanpham['style'] == 0 || $row_sanpham['style'] == 4){echo "Sản phẩm liên quan";}else if($row_sanpham['style'] == 2){echo "Dịch vụ liên quan";} else{echo "Video liên quan";}?>
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
                                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['title'];?>">
                                            <img src="<?php echo $linkroot?>/<?php echo $row_shop_product['image'];?>" alt="<?php echo $row_shop_product['title'];?>"/>
                                        </a>
                                    </span>
                                </div>
                            </span>
                            <span class="s2_po">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['title'];?>"><?php echo $row_shop_product['name'];?></a>
                                </h4>
                                <span>
                                    <a href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>" target="_blank" title="<?php echo $shop['title'];?>"> <?php echo $shop['name'];?></a>
                                </span>
                                 <?php if($row_sanpham['style']==0){?>
                                 <p><?php if($row_shop_product['pricekm'] > 0){echo number_format($row_shop_product['pricekm'],0)."  VNĐ";}else if($row_shop_product['price'] > 0){echo number_format($row_shop_product['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></p>
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

$link = $_SERVER['REQUEST_URI'];
$myLink = explode("?", $link);
$myData = explode("&", $myLink[1]);
$myFilter = explode("=", $myData[0]);
$filter = $myFilter[1];
$hot = 0;
$sapxep="id DESC";
if($filter == 1){$sapxep = "id DESC"; $hot = 0;}
if($filter == 2){$sapxep = "date_added DESC"; $hot = 1;}
if($filter == 3){$sapxep = "view DESC"; $hot = 0;}
if($filter == 4){$sapxep = "price DESC"; $hot = 0;}
if($filter == 5){$sapxep = "price ASC"; $hot = 0;}

settype($pageSize,"int");
settype($pageNum,"int");
settype($totalRows,"int");
settype($dem,"int");

$myPage = explode("=", $myData[1]);
$pageNum = $myPage[1];
if ($pageNum<=0) $pageNum=1;
$startRow = ($pageNum-1) * $pageSize;
//echo "status=0 AND parent='{$parent}' limit ".$startRow.",".$pageSize;
$style = 0;
if($row_category['id'] == 457){
    $dataAP = get_records('tbl_shop_category', "cate=0", " ", " ", " ");
    $parent = "";
    while($row_dataAP = mysql_fetch_assoc($dataAP)){
        $parent .= $row_dataAP['id'].",";
    }
    $parent = substr($parent, 0, -1);
    $totalRows = countRecord("tbl_item","status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent}))");
    $product = get_records("tbl_item", "status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent})) order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
    if($hot == 1){$product=get_records("tbl_item", "status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent})) AND hot=1  order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");}
}
else if($row_category['id'] == 211){
    $parent = substr($parent, 0, -5);
    $style = 1;
    $totalRows = countRecord("tbl_item","status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent}))");
    $product = get_records("tbl_item", "status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent})) order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
    if($hot == 1){$product=get_records("tbl_item", "status=0 AND type=0 AND style = ".$style." AND (parent1 in ({$parent}) OR parent in ({$parent})) AND hot=1  order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");}
}
else{
    $totalRows = countRecord("tbl_item","status=0 AND type=0 AND parent in ({$parent})");
    $product = get_records("tbl_item", "status=0 AND type=0 AND parent in ({$parent}) order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
    if($hot == 1){$product = get_records("tbl_item", "status=0 AND type=0 AND parent in ({$parent}) AND hot=1  order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");}
    if($totalRows == 0){
        $totalRows = countRecord("tbl_item","status=0 AND type=0 AND parent1 in ({$parent})");
        $product = get_records("tbl_item", "status=0 AND type=0 AND parent1 in ({$parent}) order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");
        if($hot == 1){$product = get_records("tbl_item", "status=0 AND type=0 AND parent1 in ({$parent}) AND hot=1  order by $sapxep limit ".$startRow.",".$pageSize," "," "," ");}
    }
}
?>
<input id="hiddenProductPageFilter" value="<?php if($filter == ''){echo 1;}else{echo $filter;}; ?>" type="hidden"/>
<input id="hiddenProductPageNum" value="<?php if($pageNum == ''){echo 1;}else{echo $pageNum;}; ?>" type="hidden"/>
<section class="breacrum">
    <ul>
        <?php
        if($row_category['cate']==1 && $row_category['id'] != 211){$news_item=getRecord('tbl_shop_category', "id=211");?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo $news_item['subject'];?>.html"><?php echo $news_item['name'];?></a></li>
        <?php } ?>
        <?php
        if($row_category['cate']==3 && $row_category['id'] != 390){$video_item=getRecord('tbl_shop_category', "id=390");?>
            <li><a href="<?php echo $linkrootshop;?>/<?php echo $video_item['subject'];?>.html"><?php echo $video_item['name'];?></a></li>
        <?php } ?>
        <?php
        $row_bc = getRecord('tbl_shop_category', "id=".$parent);
        if($row_bc != ''){
        ?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo get_field('tbl_shop_category','id',$row_bc['parent'],'subject');?>.html"><?php echo get_field('tbl_shop_category','id',$row_bc['parent'],'name');?></a></li>
        <?php } ?>
        <li><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham;?>.html"><?php echo get_field('tbl_shop_category','subject',$tensanpham,'name');?></a></li>
        <li style="float: right; margin-right: 35px;">
            <a>Hiện có <strong><?php echo $totalRows;?></strong>
                <?php if($row_category['cate'] == 0 || $row_category['cate'] == 4){echo " sản phẩm";}
                    else if($row_category['cate'] == 1){echo " tin";}
                    else if($row_category['cate'] == 2){echo " dịch vụ";}
                    else if($row_category['cate'] == 3){echo " video";}
                ?>
            </a>
        </li>
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
					if(countRecord("tbl_shop_category","parent='".$parent1."'")>0)  $cate1=get_records("tbl_shop_category","status=0 AND parent='".$parent1."'","name COLLATE utf8_unicode_ci"," "," ");
					else  $cate1=get_records("tbl_shop_category","status=0 AND cate NOT IN (1,2,3,4) AND id != 457 AND parent='".get_field('tbl_shop_category','subject',$danhmuc,'parent')."'"," "," "," ");
					while($row_cate1=mysql_fetch_assoc($cate1)){
					?>
						<li><a href="<?php echo $linkrootshop?>/<?php echo $row_cate1['subject'];?>.html" title="<?php echo $row_cate1['title']?>"><?php echo $row_cate1['name']?></a></li>
					<?php }?> 
                </ul>
                <div class="clear"></div>
            </div><!-- End .m-cate -->
        </div><!-- End .catelog -->
    </div><!-- End .sidebar -->

    <?php if($totalRows != 0){ ?>
    <div class="content">
        <?php if($row_category['id'] != 211 && $row_category['id'] != 390){ ?>
        <section class="Prod-nb">
            <h4 class="t-Pnb">
                <?php if($row_category['cate'] == 0 || $row_category['cate'] == 4){echo "Sản phẩm khuyến mãi";}
                else if($row_category['cate'] == 2){echo "Dịch vụ khuyến mãi";}
                ?>
            </h4><!-- End .t-Pnb -->
            
            <article class="m-Pnb">
                <ul class="ul-Pnb">
					<?php
                    $totalNews = countRecord("tbl_item","status=0 AND type=0 AND pricekm != 0 AND parent1 in ({$parent})");
                    $new=get_records("tbl_item","status=0 AND type=0 AND pricekm != 0 AND parent1 in ({$parent}) "," ","0,9"," ");
                    if($totalNews == 0){if($row_category['cate'] == 0 || $row_category['cate'] == 4){echo "Hiện không có sản phẩm khuyến mãi trong danh mục này";}
                    else if($row_category['cate'] == 2){echo "Hiện không có dịch vụ khuyến mãi trong danh mục này";}}else{
					while($row_new=mysql_fetch_assoc($new)){
				    $shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
                    ?>
                    <li>
                        <div class="i-Pnb">
                            <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['title'];?>">
                                <img src="<?php echo $linkroot?>/<?=$row_new['image']?>" alt="<?php echo $row_new['title'];?>"/>
                            </a>
                        </div><!-- End .i-Pnb -->
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['subject'];?></a>
                        <span class="price-Pnb"><?php echo number_format($row_new['pricekm'],0)."  VNĐ"; ?></span>
                    </li>
                    <?php } } ?>
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
                            <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['title'];?>">
                                <img src="<?php echo $linkroot?>/<?=$row_new['image']?>" alt="<?php echo $row_new['title'];?>"/>
                            </a>
                        </div><!-- End .i-Pnb -->
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['subject'];?></a>
                        <span class="price-Pnb"><?php  if($row_new['pricekm'] > 0){echo number_format($row_new['pricekm'],0)."  VNĐ";}else if($row_new['price'] > 0){echo number_format($row_new['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></span>
                    </li>
                   <?php }?>
                   
                </ul>
                <div class="clear"></div>
            </article><!-- Responsive m-Pnb2 -->
        
        </section><!-- End .Prod-nb -->
        <?php } ?>

        <section class="filter-Prod">
            <h4 class="t-Pnb">
                <ul class="ul-fP">
                    <li class="act"><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham ?>.html?filter1=1&page=<?php echo $pageNum ?>">Mới nhất</a></li>
                    <li>|</li>
                    <li class="act"><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham ?>.html?filter1=2&page=<?php echo $pageNum ?>">Nổi bật</a></li>
                    <li>|</li>
                    <li class="act"><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham ?>.html?filter1=3&page=<?php echo $pageNum ?>">Xem nhiều</a></li>
                    <li>|</li>
                    <?php if($row_category['id'] != 211 && $row_category['cate'] != 1){ ?>
                    <li class="act"><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham ?>.html?filter1=4&page=<?php echo $pageNum ?>">Giá cao</a></li>
                    <li>|</li>
                    <li class="act"><a href="<?php echo $linkrootshop;?>/<?php echo $tensanpham ?>.html?filter1=5&page=<?php echo $pageNum ?>">Giá thấp</a></li>
                    <li>|</li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
                <div class="f-sty-P">
                    <ul>
                        <li><a class="f-sty-P1" href="javascript:void(0)" onclick="$('.s-Pnb').hide(); $('.n-Pnb').css('text-align', 'center'); $('label').width('100%');"></a></li>
                        <li><a class="f-sty-P2" href="javascript:void(0)" onclick="$('.s-Pnb').show(); $('.n-Pnb').css('text-align', 'left'); $('label').width('inherit');"></a></li>
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
			    $shop=getRecord('tbl_shop', "id=".$row_new['idshop']);
                ?>
                <li class="li-Pc1">
                    <div class="i-Pnb">
                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['title'];?>">
                        	<img src="<?php echo $linkroot?>/<?=$row_new['image']?>" alt="<?php echo $row_new['title'];?>"/>
                        </a>
                    </div><!-- End .i-Pnb -->
                    <div class="prod_row1">
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><b><?php echo $row_new['name'];?></b></a>
                        <span class="s-Pnb">Từ khóa: <i><?php echo $row_new['keyword'];?></i></span>
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
                    <?php if($row_category['cate'] != 1 && $row_category['cate'] != 3){ ?>
                    <span class="price-Pnb"><?php  if($row_new['pricekm'] > 0){echo number_format($row_new['pricekm'],0)."  VNĐ";}else if($row_new['price'] > 0){echo number_format($row_new['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></span>
                    <?php } ?>
                    <div class="clear"></div>
                </li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </section><!-- End .Prod-cate -->
        
        <div class="frame_phantrang">
            <div class="PageNum" id="divProductPag">
                <?php
                if(isset($_REQUEST['tensanpham'])){ echo pagesLinks_new_full_2013($totalRows, $pageSize , "", "?page=","".$_GET['tensanpham'].".html");}
                else echo pagesLinks_new_full_2013($totalRows, $pageSize , "","p","page-danh-muc/".$_GET['tensanpham']."/");
                ?>
            </div>
            <div class="clear"></div>
        </div><!-- End .frame_phantrang -->
        
    </div><!-- End .content -->
    <?php } ?>
    <div class="clear"></div>
</section><!-- End .f-ct -->
<?php }?>
