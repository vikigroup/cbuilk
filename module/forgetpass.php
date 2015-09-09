<?php
if(isset($_SESSION['kh_login_username'])){
    header("Location: ".$root);
}
?>
<div class="form_dn">
    <ul>
        <li style="text-align: center;">
            <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Quên mật khẩu</h1>
                <div class="main_f_tt">
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Email
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="email" name="email" id="txtFPEmail" placeholder="bob@example.com"/>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input name="btn_doipass" id="btn_doipass" class="btn_qmk" type="button" value="&nbsp;"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                </div><!-- End .main_f_tt -->
            </div><!-- End .main_f_dn -->
        </li>
    </ul>
    <div class="clear"></div>
</div>