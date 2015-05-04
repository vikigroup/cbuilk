<script>
	$(document).ready(function(){
		 $("#lienket").change(function(){ 
			var chuoi=$(this).val();//val(1) gan vao gia tri 1 dung trong form
			//window.location.target="_blank";
			//window.location.href = chuoi;
			
			var w = window.open('about:blank', '_blank');
			w.location.href = chuoi;
	
		});
	});	
</script>
<?php 

?>
<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
         <?php echo module_keyword($mang11,$mang22,"box_link");?>
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
         <div class="box_link_t">
        	<select id="lienket" name="lienket">
                <option selected="selected" value="1">--Chọn liên kết--</option>
                <?php
                $new=get_records("tbl_other","status=1 and cate=1 AND idshop='{$idshop}'","id DESC","0,5"," ");
                while($row_loai=mysql_fetch_assoc($new)){ 
                ?>
                <option value="<?php echo $row_loai['subject'];?>"><?php echo $row_loai['name'];?></option>
                <?php }?>
            </select>
        </div>
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->