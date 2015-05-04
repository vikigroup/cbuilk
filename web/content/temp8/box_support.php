<div class="frame_mau_gh">
    <h2 class="title_f_m_gh">
        Hỗ trợ trực tuyến
    </h2><!-- End .title_f_m_gh -->
    <div class="main_f_m_gh">
                            
        <div class="httt_mau_gh">
            <ul>
				<?php
                $cate=get_records("tbl_support","status=1 AND idshop='{$idshop}' "," "," "," ");
                while($row_hotro=mysql_fetch_assoc($cate)){
                ?>
                <li>
                    <a href='ymsgr:sendIM?<?php echo $row_hotro['nickyahoo'] ?>' title="<?php echo $row_hotro['nickyahoo'] ?>">
                        <img src='http://opi.yahoo.com/online?u=<?php echo $row_hotro['nickyahoo'] ?>&m=g&t=2&l=vi' alt ='' />
                    </a>
                    <div class="text_yahoo"><?php echo $row_hotro['name'] ?></div>
                    <?php if($row_hotro['nickskype']!="") {?>
                    <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
                    <a href="skype:<?php echo $row_hotro['nickskype'] ?>?call"><img src="http://mystatus.skype.com/bigclassic/<?php echo $row_hotro['nickskype'] ?>" style="border: none;" width="132" height="35" alt="My status" /></a>
                    <div class="text_yahoo"> </div>
                    <?php }?>
                </li>
                <?php }?>
                
              
            </ul>
        </div><!-- End .httt_mau_gh -->
        
    </div><!-- End .main_f_m_gh -->
</div><!-- End .frame_mau_gh -->