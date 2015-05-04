
<section class="breacrum">
    <ul>
        <li><a href="<?php echo $linkrootshop;?>">Trang chủ</a></li>
        <li><a href="<?php echo $linkrootshop;?><?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'subject');?>.html"><?php echo get_field('tbl_shop_category','id',$row_sanpham['parent1'],'name');?></a></li>
    </ul>
    <div class="clear"></div>
</section><!-- End .breacrum -->

<section class="f-cont">
    
    <div class="l-fcont">
        
        <h1 class="t-lfcont">
             Không tìm thấy kết quả yêu cầu
        </h1><!-- End .t-lfcont -->
        
        <div class="f-ndct">
        
            <div style="padding:10px; text-align:center">
                Không tìm thấy kết quả yêu cầu
                <br />
                <script>
                s=5;
                setTimeout("document.location='<?php echo $linkrootshop;?>'",s*1000); 
                setInterval("document.getElementById('sogiay').innerHTML=s--;",1000);
                </script> 
                <a href="<?php echo $linkrootshop;?>"> Link quay lại trang chủ ngay</a><br />
                Sẽ quay lại trang chủ sau.<br />
                <span id=sogiay></span>
                <br />
            
            </div>
        
            <div class="clear"></div>
        </div><!-- End .f-ndct -->
        
        <!-- End .face-cmm -->
        
    </div><!-- End .l-fcont -->
    
    <div class="r-fcont">        
        <div class="block_prod_details">
        
            <div class="f_prod_other">
                
                <h1 class="title_prod_other">
                     Sản phầm mới
                </h1><!-- End .title_prod_other -->
                
                <div class="main_prod_other">
                    <ul>
                    <?php 
					$shop_product=get_records("tbl_item","status=0 AND cate='0'","id DESC","0,10"," ");
					while($row_shop_product=mysql_fetch_assoc($shop_product)){
					?>
                        <li>
                            <span class="s1_po">
                                <div>
                                    <span>
                                        <a href="<?php echo $linkrootshop;?><?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>">
                                            <img src="<?php echo $linkroot?>/web/<?php echo $row_shop_product['image'];?>" alt=""/>
                                        </a>
                                    </span>
                                </div>
                            </span>
                            <span class="s2_po">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?><?php echo $row_shop_product['subject'];?>.html" title="<?php echo $row_shop_product['name'];?>"><?php echo $row_shop_product['name'];?></a>
                                </h4>
                                <p><?php  if(preg_match ("/^([0-9]+)$/", $row_shop_product['price'])) echo number_format($row_shop_product['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></p>
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

