<article>
    <h2 class="t-mn-dm">
        Gian hàng mới nhất
    </h2><!-- End .t-mn-dm -->
    
    <div class="m-AppOr">
        
        <div class="ul-Pnb4">
			<?php 
            $shop_new=get_records("tbl_shop","status=0","id DESC","0,27"," ");
            $dem = mysql_num_rows($shop_new); 
            ?>
            <div class="slide">
                <ul>
					<?php 
                    $i=1;
                    $dem1=1;
                    while($row_shop_new=mysql_fetch_assoc($shop_new)){
                    ?>
                    <li>
                        <a href="http://<?php echo $row_shop_new['subject'];?>.<?php echo $sub;?>" target="_blank">
                            <?php if( $row_shop_new['logo']=="") $hinh=$linkrootshop."/imgs/layout/RegistrationOnline.jpg";else $hinh=$linkroot."/".$row_shop_new['logo'];?>
                            <img  width="80" height="80"  src="<?php echo $hinh;?>" alt="<?php echo $row_shop_new['name'];?>"/>
                        </a>
                    </li>
                    <?php 
						if($dem1==$dem) {echo " </ul></div>"; break;}
						if($i==9) { 
							if($dem1<$dem) echo '</ul></div><div class="slide"> <ul>';
							$i=1;
						}
						else {$i++;}
					$dem1++;						
					}
					?>  
            
        </div><!-- End .ul-Pnb2 -->
        
        <div class="clear"></div>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.ul-Pnb4').bxSlider({
                    slideWidth: 291,
                    minSlides: 1,
                    maxSlides: 1,
                    slideMargin: 10,
                    controls: false,
                    infiniteLoop: false,
                    adaptiveHeight: true
                });
            });
        </script>
        
    </div><!-- End .m-AppOr -->
    
    <div class="m-AppOr2">
        <ul class="ul-m-AppOr2">
			<?php 
            $shop_new=get_records("tbl_shop","status=0","id DESC","0,9"," ");
            $dem = mysql_num_rows($shop_new); 
			while($row_shop_new=mysql_fetch_assoc($shop_new)){
            ?>
            <li>
                <a href="http://<?php echo $row_shop_new['subject'];?>.<?php echo $sub;?>" target="_blank">
					<?php if( $row_shop_new['logo']=="") $hinh=$linkrootshop."/imgs/layout/RegistrationOnline.jpg";else $hinh=$linkroot."/web/".$row_shop_new['logo'];?>
                    <img width="80" height="80" src="<?php echo $hinh;?>" alt="<?php echo $row_shop_new['name'];?>"/>
                </a>
            </li>
            <?php }?>
        </ul>
        <div class="clear"></div>
    </div><!-- Responsive .m-AppOr2 -->
    
</article>