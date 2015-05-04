<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
        <?php echo  $auto['title'];?>
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
         <div  style="padding:5px;">
           <?php echo  $auto['content'];?>
        </div>
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->