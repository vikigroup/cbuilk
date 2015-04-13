<article>
    <h2 class="t-mn-dm">
       Tin tức mới nhất
    </h2><!-- End .t-mn-dm -->
    
    <?php 
    if($i_mobile==1){
	?>
    <div class="m-AppOr">
        
        <div class="ul-Pnb6">
			<?php 
            $news=get_records("tbl_item","status=0 and cate=1 and idshop!=0 ","id DESC","0,27"," ");
            $dem = mysql_num_rows($news); 
            ?>
            <div class="slide">
                <ul>
					<?php 
                    $i=1;
                    $dem1=1;
                    while($row_news=mysql_fetch_assoc($news)){
                    ?>
                    <li>
                        <a href="<?php echo $linkrootshop;?>/<?php echo $row_news['subject'];?>.html" target="_blank" title="<?php echo $row_news['name'];?>"><?php echo $row_news['name'];?></a>
                    </li>
                    <?php 
						if($dem1==$dem ) {echo " </ul></div>"; break;}
						if($i==8) { 
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
                $('.ul-Pnb6').bxSlider({
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
    <?php }else {?>
    <div class="m-AppOr2">
        <ul class="ul-rv-res">
           <?php 
            $news=get_records("tbl_item","status=0 and cate=1 and idshop!=0","id DESC","8"," ");
            while($row_news=mysql_fetch_assoc($news)){ 
            ?>
            <li>
                <a href="<?php echo $linkrootshop;?>/<?php echo $row_news['subject'];?>.html" target="_blank" title="<?php echo $row_news['name'];?>"><?php echo $row_news['name'];?></a>
            </li>
            <?php }?>
            
        </ul>
        <div class="clear"></div>
    </div><!-- Responsive .m-AppOr2 -->
    <?php }?>
</article>