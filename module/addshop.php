<?php  
if(isset($_SESSION['kh_login_id'])){
    $id = get_field('tbl_shop','iduser',$_SESSION['kh_login_id'],'id');
    if($id != "") {
        echo '<script>alert("Bạn đã thực hiện việc đăng ký gian hàng cho tài khoản này...");</script>';
        echo '<script>window.location="'.$linkrootshop.'";</script>';
    }

    if (isset($_POST['btn_addshop']) == true){
            $tenshop = $_POST['tenshop'];
            $tenmien = $_POST['tenmien'];
            $intro = $_POST['intro'];
            $ddCat = $_POST['ddCat'];
            $idtemplate = $_POST['idtemplate'];
            $cap = $_POST['cap'];
            $thoathuan = $_POST['thoathuan'];

            $tenshop = trim(strip_tags($tenshop));
            $tenmien = trim(strip_tags($tenmien));
            $intro   = trim(strip_tags($intro));
            $ddCat   = trim(strip_tags($ddCat));

            if (get_magic_quotes_gpc() == false){
                $tenshop = mysql_real_escape_string($tenshop);
                $tenmien = mysql_real_escape_string($tenmien);
                $intro = mysql_real_escape_string($intro);
                $ddCat = mysql_real_escape_string($ddCat);
                $idtemplate = mysql_real_escape_string($idtemplate);
            }

            $coloi = false;

            if($_SESSION['captcha_code'] != $cap){
                $coloi = true; $loi = "Mã bảo mật chưa đúng!";}

            if($loi != ""){
                $coloi = true;
                $error_login = $loi;
            }

            if($coloi == FALSE){
                $iduser = $_SESSION['kh_login_id'];
                $randomkey = chuoingaunhien(50);
                $khoa = 1;
                $vale1 = 'iduser, intro, parent, idtemplate, name, subject, date_added, last_modified, status';
                $vale2 = "'".$iduser."', '".($intro - 1)."', '".$ddCat."', '".$idtemplate."', '".$tenshop."', '".$tenmien."', '".$ngay."', '".$ngay."', 0";
                insert_table('tbl_shop',$vale1,$vale2,$hinh);

                $sql = sprintf("SELECT * FROM tbl_customer WHERE id = '%s'", $iduser);
                $user = mysql_query($sql);
                $row_user = mysql_fetch_assoc($user);

                $_SESSION['kh_login_id'] = $row_user['id'];
                $_SESSION['kh_login_username'] = $row_user['username'];

                echo("<script>if(confirm('Xin chúc mừng bạn đã mở gian hàng thành công! Vào trang quản trị ngay?')){
                    window.location.href = 'http://".$tenmien.".".$sub."/quantri.html';
                    }else{
                    window.location.href = '".$linkrootshop."';
                    };</script>");
            }
    }
?>

<div class="form_dn">
    <ul>
        <li id="gif_slide_frame" style="text-align: center;">
            <img src="<?php echo $linkrootshop; ?>/imgs/layout/add-shop.png" alt="Đăng ký gian hàng"/>
        </li>
        <li>
            <div class="main_f_dn">
                <input type="hidden" id="hiddenAddShop" value="<?php echo $linkrootshop; ?>">
                <h1 class="title_f_tt">Đăng ký mở gian hàng </h1>
                <form id="frmAddShop" name="frmAddShop" method="post">
                <div class="main_f_tt">
                    <div class="module_ftt">
                        <div class="l_f_tt">Tên gian hàng</div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" required type="text" name="tenshop" id="tenshop" value="<?php echo $tenshop; ?>"/>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Tên miền</div>
                        <div class="r_f_tt" style="position:relative;">
                            <input class="ipt_f_tt" name="tenmien" id="tenmien" required type="text" placeholder="ten-mien-gian-hang" style="width:142px; text-align:left;" value="<?php echo $tenmien; ?>"/>
                            <input name="txtSub" class="ipt_f_tt" type="text" value=".<?php echo $sub; ?>" disabled="disabled" style="width:70px;"/>
                            <span class="star_style">*</span>
                            <div id="baoloi" style="font-style: italic; width: 30px; position: absolute; top: 0; right: 41px;"></div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Thuộc lĩnh vực</div>
                        <div class="r_f_tt">
                            <select name="ddCat" id="ddCat" class="ipt_f_tt">
                                <option value="-1">Chọn danh mục</option>
                                <?php
                                $gt = get_records("tbl_shop_category","parent=457 AND status=0","name COLLATE utf8_unicode_ci"," "," ");
                                while($row = mysql_fetch_assoc($gt)){ ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $ddCat){echo 'selected';} ?>>&cir; <?php echo $row['name']; ?></option>
                                    <?php
                                    $gtSub = get_records("tbl_shop_category","parent=".$row['id'],"name COLLATE utf8_unicode_ci"," "," ");
                                    while($rowSub = mysql_fetch_assoc($gtSub)){ ?>
                                        <option value="<?php echo $rowSub['id']; ?>" <?php if($rowSub['id'] == $ddCat){echo 'selected';} ?>>&nbsp;&nbsp;&nbsp;|-> <?php echo $rowSub['name']; ?></option>
                                        <?php
                                        $gtSubSub = get_records("tbl_shop_category","parent=".$rowSub['id'],"name COLLATE utf8_unicode_ci"," "," ");
                                        while($rowSubSub = mysql_fetch_assoc($gtSubSub)){ ?>
                                            <option value="<?php echo $rowSubSub['id']; ?>" <?php if($rowSubSub['id'] == $ddCat){echo 'selected';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-> <?php echo $rowSubSub['name']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Loại gian hàng</div>
                        <div class="r_f_tt">
                             <select name="intro" id="intro" class="ipt_f_tt" onchange="getTemplate(this.value);">
                                 <option value="0">Chọn thể loại</option>
                                 <option value="1" <?php if($intro == 1){echo 'selected';} ?>>&cir; Kinh doanh sản phẩm</option>
                                 <option value="2" <?php if($intro == 2){echo 'selected';} ?>>&cir; Giới thiệu công ty</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Giao diện gian hàng</div>
                        <div class="r_f_tt">
                            <input type="hidden" id="hiddenShopTemplate" value="<?php echo $idtemplate; ?>">
                            <select name="idtemplate" id="idtemplate" class="ipt_f_tt">
                                <option value="-1">Chọn giao diện</option>
                            </select>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">Nhập mã xác nhận</div>
                        <div class="r_f_tt">
                            <input style="width: 200px;" name="cap" id="cap" required value="<?php echo $cap; ?>" class="ipt_f_tt" type="text"/>
                            <div class="img_capcha" style="width: 80px; padding-left: 0;">
                                <img class="img_cap" align="absmiddle" src="<?php echo $linkrootshop; ?>/scripts/capcha/dongian.php" alt="Mã xác nhận đăng ký gian hàng">
                                <span class="star_style">*</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="r_f_tt">
                            <input id="thoathuan" name="thoathuan" type="checkbox" value="<?php echo $thoathuan; ?>" <?php if($thoathuan == 1){echo 'checked';} ?> onchange="if($(this).is(':checked')){this.value = 1;} else{this.value = 0;}"/>
                            <span style="padding-left: 5px;">Tôi đồng ý với thỏa thuận sử dụng của <?php echo $sub; ?></span>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt"style="text-align: center; color: #F00; padding: 5px;">
                        <?php echo $error_login; ?>
                    </div>
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom: 15px;">
                                <button name="btn_addshop" id="btn_addshop" class="btn_dk" type="submit">ĐĂNG KÝ</button>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                </div><!-- End .main_f_tt -->
                </form>
            </div><!-- End .main_f_dn -->
        </li>
    </ul>
    <div class="clear"></div>
</div>
<?php }else {
	header("Location: ".$linkrootshop."/dang-nhap.html");
}
?>
