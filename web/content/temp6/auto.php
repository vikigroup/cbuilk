<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>

    <div class="title_frame_main_text">
        <?php echo  $auto['title_module'];?> 
    </div><!-- End .title_frame_main_text -->
    
    <div class="main_frame_main_text">
                    
         <div>
           <?php echo  $auto['content_module'];?>
        </div>
        
        <div class="clear"></div>
        <br />

    </div><!-- End .main_frame_main_text -->
    
