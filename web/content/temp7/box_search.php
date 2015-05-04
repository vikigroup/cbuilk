<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="dmmn">

    <h5 class="title_dmmn">
        <?php echo  $auto['title'];?>
        <div class="arrown_bottom2"></div>
    </h5><!-- End .title_dmmn -->

    <div class="main_dmmn">
        
		<div id="boxauto">
        	<?php echo  $auto['content'];?>
        </div>
        
    </div><!-- End .main_dmmn -->

</div><!-- End .dmmn -->