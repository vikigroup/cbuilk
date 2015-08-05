<section class="Prod-nb">
     
    <h4 class="t-Pnb">
        Sản phẩm mới
    </h4><!-- End .t-Pnb -->
    <?php 
    if($i_mobile==1){
	?>
    <article class="m-Pnb">
    
        
        <div class="ul-Pnb2">
			<?php 
            $new=get_records("tbl_item","status=0 AND cate=0 AND type=0 ","id DESC","0,30"," ");
			$dem = mysql_num_rows($new); 
            ?>
            <div class="slide">
                <ul>
					<?php 
                    $i=1;
                    $dem1=1;
                    while($row_new=mysql_fetch_assoc($new)){
                    $shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
                    ?>
                    <li>
                        <div class="i-Pnb">
                            <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['name'];?>">
                               
                               <?php if( $row_new['image']=="") $hinh=$linkrootshop."/imgs/layout/RegistrationOnline.png";else $hinh=$linkrootshop."/imagecache/image.php/".$row_new['image']."?width=176&amp;height=140&amp;cropratio=1:1&amp;image=".$linkroot."/".$row_new['image'];?>
                                <img src="<?php echo $hinh;?>" alt="<?php echo $row_new['name'];?>"/> 
                            </a>
                        </div><!-- End .i-Pnb -->
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['name'];?></a>
                        <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
                     </li>
                    <?php 
						if($dem1==$dem && $i!=15) {echo " </ul></div>"; break;}
						if($i==15) { 
							 $i=1;
							if($dem1<$dem) echo '</ul></div><div class="slide"> <ul>';
							$i=1;
						}
						else {$i++;}
					$dem1++;
						
						
					}
					?>
               	</ul></div>
            
            
        </div><!-- End .ul-Pnb2 -->
        
        <div class="clear"></div>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.ul-Pnb2').bxSlider({
                    slideWidth: 980,
                    minSlides: 1,
                    maxSlides: 1,
                    slideMargin: 10,
                    controls: false,
                    infiniteLoop: false
                });
            });
        </script>
    
    </article><!-- End .m-Pnb -->
    <?php }else {?>
    <article class="m-Pnb2">
        <ul>
		<?php
        $dem = countRecord("tbl_item","status=0 AND cate=0 AND type=0 order by id DESC limit 0,8"); 
        $new=get_records("tbl_item","status=0 AND cate=0 AND type=0 ","id DESC ","0,8"," ");
		while($row_new=mysql_fetch_assoc($new)){
		$shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
        ?>
            <li>
                <div class="i-Pnb">
                            <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['name'];?>">
                                <img src="<?php echo $linkroot?>/web/<?php echo $row_new['image'];?>" alt="<?php echo $row_new['name'];?>"/>
                            </a>
                        </div><!-- End .i-Pnb -->
                        <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                        <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['name'];?></a>
                        <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
            </li>
          <?php }?>
            
        </ul>
        <div class="clear"></div>
    </article><!-- Responsive m-Pnb2 -->
    <?php }?>
</section><!-- End .Prod-nb -->

<script>
    $(document).ready(function(){
        $('.bx-wrapper').css('max-width', '1200px');
        $('.bx-wrapper').css('margin', '0 auto 27px');
        $('.m-Pnb .bx-wrapper .bx-viewport').css('width', '983px');
        $('.slide').css('margin-right', '25px');
    });
</script>