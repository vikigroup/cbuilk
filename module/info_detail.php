<?php 
$tensanpham=$_GET['tenthongtin'];
$row_sanpham   = getRecord('viki_tin', "subject='".$tensanpham."'");
if($row_sanpham['id']=="")  header("Location: ".$linkrootshop."/404-page-not-found.html");
?>
 
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a title="<?php echo $row_sanpham['name'];?>"><?php echo  $row_sanpham['name'];?> </a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->

<section class="f-cont">
    <div class="l-fcont">
        <h1 class="t-lfcont"  >
            <?php echo  $row_sanpham['name'];?>   
        </h1><!-- End .t-lfcont -->
        <div class="f-ndct">
           <?php echo $row_sanpham['detail'];?>
            <div class="clear"></div>
        </div><!-- End .f-ndct -->
    </div><!-- End .l-fcont -->
    
    <div class="r-fcont">
        <div class="block_prod_details">
            <div class="f_prod_other">
                <h1 class="title_prod_other">
                     <?php if($row_sanpham['cate']==0) echo "Sản phẩm";else echo "Dịch vụ"?> của chúng tôi
                </h1><!-- End .title_prod_other -->
                
                <div class="main_prod_other">
                    <ul>
                    <?php 
					$shop_product=get_records("tbl_item","status=0 and style=0","date_added DESC","0,10"," ");
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
                                <p><?php  if($row_shop_product['pricekm'] > 0){echo number_format($row_shop_product['pricekm'],0)."  VNĐ";}else if($row_shop_product['price'] > 0){echo number_format($row_shop_product['price'],0)."  VNĐ";}else{echo "Giá: Liên hệ";} ?></p>
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
            </div><!-- End .f_prod_other -->
        </div><!-- End .block_prod_details -->
    </div><!-- End .r-fcont -->
    <div class="clear"></div>
</section><!-- End .f-cont -->

  