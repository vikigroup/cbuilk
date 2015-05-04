
<?php 
$new=get_records("tbl_other","status=0 AND cate=2 AND idshop='{$idshop}'","id DESC","0,5"," ");
?>
<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
        <?php echo module_keyword($mang11,$mang22,"box_download");?>
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
         <div class="box_link_t">
                <ul>
                <?php
                while($row_new=mysql_fetch_assoc($new)){
                ?>
                <li>
                &nbsp; &nbsp; <a href="<?php echo $linkroot ;?>/<?php echo $row_new['image_large']?>" title=""> <?php echo catchuoi_tuybien($row_new['name'],5);?>  </a>
                </li>
                <?php } ?>
                </ul>
        </div>
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->