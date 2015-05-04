<?php
$new1=get_records("tbl_item","status=0 and hot=1 and cate=1 AND idshop='{$idshop}' and hot=1","id DESC","0,1"," ");
$row_new1=mysql_fetch_assoc($new1);
?>
<div class="intro_f">

    <h5 class="title_intro">
        <?php echo $row_new1['name'];?>
        <div class="arrown_bottom"></div>
    </h5><!-- End .title_intro -->
    
    <div class="main_intro">
        
        <?php 
		 $a= strip_tags($row_new1['detail'],'<p><u><b><i><strong><h2><a><h1><h3><h4><h5><ul><li><ol>');
		 echo catchuoi_tuybien($a,150);
		?> 
        
        <a class="read_more_intro" href="/<?php echo $row_new1['subject']?>.html" title="">XEM TIẾP</a>
        
    </div><!-- End .main_intro -->
    
</div><!-- End .intro_f -->