<script>
$(document).ready(function(){
	$("ul.menu_child li:last-child a").css("border-bottom","0");
	
	$(function(){
		
		function tick3(){
			$('#ticker_03 li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker_03')).css('opacity', 1); });
		}
		setInterval(function(){ tick3 () }, 2000);
		
	});
	
});
</script>
<div class="block_ct">                    

    <div class="main_adv">
        
        <h1 class="title_adv">
            <?php echo module_keyword($mang11,$mang22,"box_good_products_left");?>
        </h1><!-- End .title_adv -->
        
        <div class="sp_mau_gh">
            <ul id="ticker_03">
			<?php
            $new=get_records("tbl_item","status=0 AND idshop='{$idshop}' and cate=0","view DESC","0,3"," ");
            while($row_new=mysql_fetch_assoc($new)){
            ?>
            
                <li>
                	<table class="sp_xn_style" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td>
                                <a href="<?php echo $row_new['subject']?>.html" title="">
                                	<img src="<?php echo $linkroot ;?>/<?php echo $row_new['image']?>" alt=""/>
                                </a>              
                            </td>
                        </tr>
                    </table>      
                    <h2 class="title_prod_news" align="center">
                       <a href="<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?></a>
                    </h2>
                    <h4 align="center" class="price_prod_mau_gh" title="<?php echo $row_new['price'];?>"><?php  if(preg_match ("/^([0-9]+)$/", $row_new['price'])) echo number_format($row_new['price'],0)."  VNĐ";else echo $row_new['price']; ?></h4>
                </li>
         <?php } ?>              
               
            </ul>
        </div>
    </div><!-- End .main_adv -->

</div><!-- End .block_ct -->