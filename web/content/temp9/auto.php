<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="frame_product_mau_gh">
	<h2 class="title_f_p_m_gh">
		<?php echo  $auto['title'];?>
	</h2><!-- End .title_f_p_m_gh -->
	<div class="main_f_p_m_gh">
		
        <div style="padding:5px;">
            <?php echo  $auto['content'];?>
        </div>	

		
	</div> 
	<div class="footer_f_p_m_gh"></div>
</div> 