<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div>

    <h1 class="title_cnt">
        <?php echo  $auto['title'];?>
    </h1><!-- End .title_cnt -->
    
    <div class="main_cnt">
       
       <div>
        	<?php echo  $auto['content'];?>
        </div> 
        
        <div class="clear"></div>
    </div><!-- End .main_cnt -->
    
 </div>
