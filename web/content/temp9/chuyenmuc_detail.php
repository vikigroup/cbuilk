<?php
	$tenchuyenmuc=$_GET['tenchuyenmuc'];
    $sql="select * FROM tbl_news WHERE subject='".$tenchuyenmuc."' and status=0";
	$rs=mysql_query($sql);
	$dem=mysql_num_rows($rs);
	$rowtin=mysql_fetch_assoc($rs);
	if($dem<= 0) echo  '<script>window.location="'.$linkroot.'/404-page-not-found.html" </script>';
?>
<div class="frame_product_mau_gh">
<h2 class="title_f_p_m_gh">
Chi tiết tin
</h2><!-- End .title_f_p_m_gh -->
<div class="main_f_p_m_gh">
<h1 style="padding:10px; font-size:18px;"><?php echo  $rowtin['name'] ?></h1>
<div class="news_mau_gh">
	<div class="canh_css_frame">
		<table>
			<tr>
				<td>
					<div>
							<?php echo $rowtin['detail']; ?>
						 <?php 
							//echo $chuoi= str_replace('../../uploads', "http://numbala.vn/uploads", $rowtin['noidung']);

							
						?>
					</div>
					<div style="clear:both; float:none;"></div>
				</td>
			</tr>
		</table>   
	</div>
</div><!-- End .news_mau_gh -->

</div><!-- End .main_f_p_m_gh -->
<div class="footer_f_p_m_gh">

</div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->


<div class="frame_product_mau_gh">
			<h2 class="title_f_p_m_gh">
				Tin khác
			</h2><!-- End .title_f_p_m_gh -->
			<?php
			$parent=$rowtin['parent'];
			$id1=$rowtin['id']-5;
			$id2=$rowtin['id']+5;
			$new=get_records("tbl_news","status=0 AND parent='{$parent}' AND idshop='{$idshop}' AND id > '{$id1}' AND id < '{$id2}' ","id DESC","0,10"," ");
			
			?>
			<div class="main_f_p_m_gh">
				<?php
				while($row_new=mysql_fetch_assoc($new)){
				?>
				<div class="news_mau_gh">
                			
					<div class="nd_news" style="overflow:hidden; padding-left:10px;">
						<h2>-:- <a href="thong-tin-chuyen-muc/<?php echo $row_new['subject']?>.html" title=""><?php echo $row_new['name']?> </a></h2>
					</div>
					<div class="clear"></div>
				
				</div><!-- End .news_mau_gh -->
				<?php  } ?>
				
			</div><!-- End .main_f_p_m_gh -->
			<div class="footer_f_p_m_gh">
			</div><!-- End .footer_f_p_m_gh -->
</div><!-- End .frame_product_mau_gh -->


