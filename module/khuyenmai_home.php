<section class="Prod-nb" style="clear: both">
    
    <h4 class="t-Pnb">
        Sản phẩm khuyến mãi
    </h4><!-- End .t-Pnb -->
    <?php
    if($i_mobile==1){
	?>
    <article class="m-Pnb">
    
        <ul class="ul-Pnb">
        <?php
		$dem = countRecord("tbl_item","status=0 AND cate=0 AND type=0 AND pricekm <> '' order by id DESC limit 0,8"); 
        $new=get_records("tbl_item","status=0 AND cate=0 AND type=0 AND pricekm <> ''","id DESC","0,8"," ");
		//echo $row_new['idshop'];
		while($row_new=mysql_fetch_assoc($new)){
		$shop=getRecord('tbl_shop', "id='".$row_new['idshop']."'");
        ?>
            <li>
                <div class="i-Pnb">
                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html" title="<?php echo $row_new['name'];?>">
                    	<img src="<?php echo $linkrootshop?>/imagecache/image.php/<?=$row_new['image']?>?width=176&amp;height=140&amp;cropratio=1:1&amp;image=<?php echo $linkroot?>/<?=$row_new['image']?>" alt="<?php echo $row_new['name'];?>" alt="<?php echo $row_new['name'];?>"/>
                    </a>
                </div><!-- End .i-Pnb -->
                <a class="n-Pnb" href="<?php echo $linkrootshop;?>/<?php echo $row_new['subject'];?>.html"><?php echo $row_new['name'];?></a>
                <a class="s-Pnb" href="http://<?php echo $shop['subject'];?>.<?php echo $sub;?>"><?php echo $shop['name'];?></a>
                <span class="price-Pnb"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo "Giá: Liên hệ"; ?></span>
            </li>
          <?php }?>  
            
        </ul>
        
        <div class="clear"></div>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.ul-Pnb').bxSlider({
                    slideWidth: 188,
                    minSlides: 5,
                    maxSlides: 5,
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
		$dem = countRecord("tbl_item","status=0 AND cate=0 AND type=0 AND pricekm <> '' order by id DESC limit 0,4"); 
        $new=get_records("tbl_item","status=0 AND cate=0 AND type=0 AND pricekm <> ''","id DESC","0,4"," ");
		//echo $row_new['idshop'];
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