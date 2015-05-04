<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="block_pd">
    <div class="prod_main">
        <h1 class="title_pdm">
            <span> <?php echo  $auto['title_module'];?></span>
        </h1><!-- End .title_pdm -->
        <div class="main_pdm">
            <div>
            	<?php echo  $auto['content_module'];?>
            </div>
            <div class="clear"></div>
        </div><!-- End .main_pdm -->
    </div><!-- End .prod_main -->
</div><!-- End .block_pd -->