<section class="News-nb">

    <article>            	
        <h2 class="t-mn-dm">
            Dịch vụ mới nhất
        </h2><!-- End .t-mn-dm -->
        
        <div class="m-News-nb">
        
            <div class="ul-Pnb3">
            <?php
			$new=get_records("tbl_item","status=0 and type=1 and image <> ''","id DESC","0,18"," ");
			$dem = mysql_num_rows($new); 
            ?>
                <div class="slide">
                    <ul>
                    <?php 
                    $i=1;
                    $dem1=1;
                    while($row_service_new=mysql_fetch_assoc($new)){
                    ?>
                        <li>
                            <div class="l-News">
                                <a href="<?php echo $linkrootshop;?>/<?php echo $row_service_new['subject'];?>.html">
                                    <img src="<?php echo $linkroot?>/<?php echo $row_service_new['image']?>" alt="">
                                </a>
                            </div><!-- End .l-News -->
                            <div class="r-News">
                                <h4 style="height:18px; overflow:hidden;">
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_service_new['subject'];?>.html"><?php echo $row_service_new['name']?> </a>
                                </h4>
                                <span>
                                   <?php echo catchuoi_tuybien(strip_tags($row_service_new['detail_short']),15);?>
                                </span>
                            </div><!-- End .r-News -->
                            <div class="clear"></div>
                        </li>
                <?php   
				
						if($dem1==$dem && $i!=9) echo " </ul></div>";
						if($i==9) { 
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
                    $('.ul-Pnb3').bxSlider({
                        slideWidth: 958,
                        minSlides: 1,
                        maxSlides: 1,
                        slideMargin: 10,
                        controls: false,
                        infiniteLoop: false,
                        adaptiveHeight: true
                    });
                });
            </script>
        
        </div><!-- End .m-News-nb -->
        
        <div class="m-News-nb2">
            <ul>
             <?php
			$new=get_records("tbl_item","status=0 and type=1","id DESC","0,4"," ");
			$dem = mysql_num_rows($new); 
			while($row_service_new=mysql_fetch_assoc($new)){
            ?>
                <li>
                            <div class="l-News">
                                <a href="<?php echo $linkrootshop;?>/<?php echo $row_service_new['subject'];?>.html">
                                    <img src="<?php echo $linkroot?>/<?php echo $row_service_new['image']?>" alt="">
                                </a>
                            </div><!-- End .l-News -->
                            <div class="r-News">
                                <h4>
                                    <a href="<?php echo $linkrootshop;?>/<?php echo $row_service_new['subject'];?>.html"><?php echo $row_service_new['name']?> </a>
                                </h4>
                                <span>
                                   <?php echo catchuoi_tuybien(strip_tags($row_service_new['detail_short']),15);?>
                                </span>
                            </div><!-- End .r-News -->
                            <div class="clear"></div>
                        </li>
              <?php }?> 
            </ul>
            <div class="clear"></div>
        </div><!-- Responsive m-News-nb -->
        
    </article>
    
</section><!-- End .News-nb -->

<script>
    $(document).ready(function(){
        $('.bx-wrapper').css('max-width', '1200px');
        $('.bx-wrapper').css('margin', '0 auto 27px');
        $('.bx-viewport').css('width', '985px');
        $('.ul-Pnb3 .slide').css('margin-right', '20px');
    });
</script>