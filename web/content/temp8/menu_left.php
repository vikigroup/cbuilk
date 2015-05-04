<style type="text/css">
	.ul_dmsp_mau_gh li{border-bottom:1px dotted #eee; padding:0 10px; position:relative; z-index:99;}
	.ul_dmsp_mau_gh li:last-child{border-bottom:0;}
	.ul_dmsp_mau_gh li a{
		color:#666;
		padding:7px 0 7px 12px;
		display:block;
		font-size:12px;
		background:url(http://numbala.vn/n/imgs/arrown_new.gif) no-repeat left;
	}
	.ul_dmsp_mau_gh li:hover a{color:#000; font-weight:bold;}
	.ul_dmsp_mau_gh li:hover ul.men_child_dmsp{display:block;}
	.ul_dmsp_mau_gh li ul.men_child_dmsp{
		display:none;
		position:absolute;
		z-index:-998;
		width:200px;
		background:#fff;
		border:1px solid #eee;
		top:-1px; right:-202px;
	}
	.ul_dmsp_mau_gh li ul.men_child_dmsp li a{color:#666; font-weight:normal;}
	.ul_dmsp_mau_gh li ul.men_child_dmsp li a:hover{color:#000; font-weight:bold;}
</style>
<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
        <?php echo module_keyword($mang11,$mang22,"menu_left");?>
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
    
        <div class="dmsp_mau_gh">
        
        	<ul class="ul_dmsp_mau_gh">
			
			   <?php
                $cate=get_records("tbl_item_category","status=0 AND idshop='{$idshop}' AND cate=0 AND  parent=2"," "," "," ");
                while($row_cate=mysql_fetch_assoc($cate)){
                ?>
            	<li><a href="/<?php echo $row_cate['subject']?>.html" title=""><?php echo $row_cate['name'];?></a>
					<?php 
                    $cate1=get_records("tbl_item_category","status=0 AND parent='".$row_cate['id']."' AND idshop='".$idshop."'"," "," "," ");
                    $sl=mysql_num_rows($cate1);
                    if($sl>0){
                    ?>
                	<ul class="men_child_dmsp">
						<?php
                        while($row_cate1=mysql_fetch_assoc($cate1)){
                        ?>
                    	<li><a href="/<?php echo $row_cate1['subject']?>.html" title="<?php echo $rowloai['ten']?>">-:- <?php echo $row_cate1['name'];?></a></li>
						<?php } ?>
                    </ul>
                 <?php } ?>
                </li>
			<?php } ?>
            </ul>
            
        </div><!-- End .dmsp_mau_gh -->
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->