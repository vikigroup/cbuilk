<?php $auto=getRecord("tbl_module","idshop=".$idshop);?>
<div class="block_ct">                    

    <div class="main_adv">
        
        <h1 class="title_adv">
            <?php echo  $auto['title'];?>
        </h1><!-- End .title_adv -->
        
        <div>
            <?php echo  $auto['content'];?>
        </div>
    </div><!-- End .main_adv -->

</div><!-- End .block_ct -->