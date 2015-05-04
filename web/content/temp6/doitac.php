<div class="frame_product_mau_gh">
	<div class="title_frame_main_text">
       <?php echo module_keyword($mang11,$mang22,"doitac");?>
    </div><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
         <div class="main_sptb" style="text-align:center; margin-top:5px;">
            <script type="text/javascript">
                $(function(){
                    $('#slide_sptb').bxSlider({
                        displaySlideQty: 4,
						auto:true,
                        moveSlideQty: 1
                    });
                });
            </script>
            <ul id="slide_sptb">
            <?php
            $gt=get_records("tbl_ad","status=0 AND cate=3 AND idshop='{$idshop}'"," "," "," ");
            while($row_ad=mysql_fetch_assoc($gt)){
            ?>
                <li>
                    <div class="space_sptb">
                        <span>
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo $row_ad['link'] ?>" title="<?php echo $row_ad['name'] ?>" target="_blank">
                                        <img src="<?php echo $linkroot ;?>/<?php echo $row_ad['image'] ?>"  title="<?php echo $row_ad['tomtat'] ?>" />
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </span>
                    </div><!-- End .space_sptb -->
                    <h4>
                            <a href="<?php echo $row_ad['link'] ?>" title="<?php echo $row_ad['name'] ?>"><?php echo $row_ad['name'] ?></a>
                    </h4>
                </li>
             <?php }?>   
               
            </ul>
            <div class="clear"></div>
        </div>
        
    </div><!-- End .main_f_m_gh -->
	<div class="footer_f_p_m_gh"></div>
</div>