<div class="menu_mau_gh">
    
    <ul class="nav_menu_mau_gh">
    
        <li <?php if($frame=="" || $frame=="home") echo 'class="curren"';?> >
        	<a href="" title="Trang chủ"><?php echo module_keyword($mang11,$mang22,"home");?></a>    
        </li>
        <li><span class="line_menu"></span></li>
        
        <li <?php if($frame=="sanpham") echo 'class="curren"';?>><a href="#" title="Sản phẩm"><?php echo module_keyword($mang11,$mang22,"products");?></a>
        	<ul class="menu_child">
         		<?php
				$cate=get_records("tbl_item_category","status=0 and cate=0 AND parent=2 AND idshop='".$idshop."'"," "," "," ");
				while($row_cate=mysql_fetch_assoc($cate)){
				?>	 
                <li>
                	<a href="/<?php echo $row_cate['subject']?>.html" title="<?php echo $row_cate['name'];?>"><?php echo $row_cate['name'];?></a>
                	<?php 
					$cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
					$sl=mysql_num_rows($cate1);
					if($sl>0 && 1>2){
					?>
                    <ul class="menu_2_child">
						<?php
                        while($row_cate1=mysql_fetch_assoc($cate1)){
                        ?>
                        <li><a href="/<?php echo $row_cate1['subject']?>.html" title=""><?php echo $row_cate1['name'];?></a></li>
                        <?php } ?>
                    </ul><!-- End .menu_2_child -->
                    <?php }?>
                </li>
       			<?php } ?>	
            </ul>
        
        </li>
        <li ><span class="line_menu"></span></li>
        
        <?php
        $news=get_records("tbl_item_category","status=0 and cate=1 AND idshop='{$idshop}' "," "," "," ");
        while($row_news=mysql_fetch_assoc($news)){
        ?>
        <li <?php if($frame=="sanpham") echo 'class="curren"';?> >
        	<a href="<?php echo $row_news['subject'];?>/" title=""><?php echo $row_news['name'];?></a>  
        </li>
        <li><span class="line_menu"></span></li>
        <?php }?>
        
        
        <li <?php if($frame=="contact") echo 'class="curren"';?> ><a href="lien-he.html" title=""><?php echo module_keyword($mang11,$mang22,"contact");?></a></li>
    </ul>
    
    <div class="clear"></div>
</div><!-- End .menu_mau_gh -->