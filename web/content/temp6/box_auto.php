<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="qc_tai">
	<div class="title_cate_w">
       <?php echo  $auto['title'];?>  
    </div><!-- End .title_cate_w -->
    <div>
    	  <div>
           <?php echo  $auto['content'];?>
        </div>
    </div>
</div>