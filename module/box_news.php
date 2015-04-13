<article>
    <h2 class="t-mn-dm">
        Tin tức mới nhất
    </h2><!-- End .t-mn-dm -->
    <div class="m-AppOr">
        
        <div class="ul-Pnb5">
			<?php 
            $news=get_records("tbl_item","status=1 and cate=1","id DESC","0,9"," ");
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
                        <div class="l-News">
                            <a href="http://batdongsan.jbs.vn/<?php echo $row_news['subject'];?>.html" title="" target="_blank" >
								<?php if( $row_news['image']=="") $hinh="http://batdongsan.jbs.vn/imgs/noimage.png";else $hinh=$linkrootshop."/imagecache/image2.php/".$row_news['image']."?width=176&amp;height=140&amp;cropratio=1:1&amp;image="."http://batdongsan.jbs.vn"."/".$row_news['image'];?>
                                <img src="<?php echo $hinh;?>" alt="<?php echo $row_news['name'];?>"/>
                            </a>
                        </div><!-- End .l-News -->
                        <div class="r-News">
                            <h4>
                                <a href="http://batdongsan.jbs.vn/<?php echo $row_news['subject'];?>.html" title="" target="_blank"><?php echo $row_news['name'];?></a>
                            </h4>
                            <span>
                                 <?php echo catchuoi_tuybien(strip_tags($row_news['detail_short']),15);?>
                            </span>
                        </div><!-- End .r-News -->
                        <div class="clear"></div>
                    </li>
				<?php 
                    if($dem1==$dem ) {echo " </ul></div>"; break;}
                    if($i==3) { 
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
                $('.ul-Pnb5').bxSlider({
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
    
    <div class="m-News-nb2">
        <ul>
			<?php 
		     $news=get_records("tbl_item","status=1 and cate=0","id DESC","0,9"," ");
            $i=1;
            $dem1=1;
            while($row_news=mysql_fetch_assoc($news)){
            ?>
            <li>
                <div class="l-News">
                    <a href="http://batdongsan.jbs.vn/<?php echo $row_news['subject'];?>.html" title="" target="_blank" >
                        <?php if( $row_news['image']=="") $hinh="http://batdongsan.jbs.vn/imgs/noimage.png";else $hinh=$linkrootshop."/imagecache/image2.php/".$row_news['image']."?width=176&amp;height=140&amp;cropratio=1:1&amp;image="."http://batdongsan.jbs.vn"."/".$row_news['image'];?>
                        <img src="<?php echo $hinh;?>" alt="<?php echo $row_news['name'];?>"/>
                        </a>
                </div><!-- End .l-News -->
                <div class="r-News">
                    <h4>
                        <a href="http://batdongsan.jbs.vn/<?php echo $row_news['subject'];?>.html" title="" target="_blank" ><?php echo $row_news['name'];?> </a>
                    </h4>
                    <span>
                        <?php echo catchuoi_tuybien(strip_tags($row_news['detail_short']),15);?>
                    </span>
                </div><!-- End .r-News -->
                <div class="clear"></div>
            </li>
            <?php }?>
        </ul>
        <div class="clear"></div>
    </div><!-- Responsive m-News-nb -->
    
</article>