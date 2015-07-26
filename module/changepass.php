<?php
$username = $_SESSION['kh_login_username'];
if($username == ''){
    header("Location: ".$root."/dang-nhap.html");
}

if(strpos(get_field("tbl_customer","username",$_SESSION['kh_login_username'],"image"), 'http') >= 0){
    header("Location: ".$root);
}

if (isset($_POST['btn_doipass'])==true) {

$pass_old1 = $_POST['pass_old1'];
$pass_new1 = $_POST['pass_new1'];
$pass_new2 = $_POST['pass_new2'];
$username = $_SESSION['kh_login_username'];
$id= $_SESSION['kh_login_id'];
settype($id, "int");

$pass_old1 = trim(strip_tags($pass_old1));
$pass_new1 = trim(strip_tags($pass_new1));
$pass_new2 = trim(strip_tags($pass_new2));

if (get_magic_quotes_gpc()==false)
        {
            $pass_old1 = mysql_real_escape_string($pass_old1);
            $pass_new1 = mysql_real_escape_string($pass_new1);
            $pass_new2 = mysql_real_escape_string($pass_new2);
        }
// kiểm tra dữ liệu nhập
$coloi=false;
$passmin=3;
$md5_pass_old1=md5(md5(md5($pass_old1)));
$matkhaulay=get_field('tbl_customer','id',$id,'password');
$md5_matkhaulay=md5(md5(md5($matkhaulay)));
if ($pass_old1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu cũ!');</script>";}
elseif ($pass_new1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu mới!');</script>";}
elseif (strlen($pass_new1)<$passmin ){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu mới phải lớn hơn ".$passmin." ký tự!');</script>";}
elseif ($pass_new1!=$pass_new2){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu nhập lại không khớp!');</script>";}
elseif ($md5_matkhaulay!=$md5_matkhaulay){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu cũ không đúng!');</script>";;}
else{ // cập nhật pass
    $sql=sprintf("update tbl_customer set password='%s'
                where id='%d'", md5(md5(md5($pass_new1))), $id);
    mysql_query($sql) or die(mysql_error());
    echo "<script language='javascript'>
                $('#divConfirm').append('<p>Đổi mật khẩu thành công!</p>');
                $('#divConfirm').append('<p>Hệ thống đang chuyển về trang chủ. Nếu hệ thống không tự chuyển, xin vui lòng bấm vào liên kết bên dưới.</p>');
                $('.pCloseConfirm').html('Trở về trang chủ');
                $('.pCloseConfirm').attr('onclick','window.location.href=".$root."');
                $('.pCloseConfirm').show();
                window.setTimeout(function () {
                location.href = ".$root.";
                }, 10000)
        </script>";

    if(isset($_SESSION['back_bds'])) echo '<script>window.location="'.$_SESSION['back_bds'].'"</script>';
    if(isset($_SESSION['back_raovat'])) echo '<script>window.location="'.$_SESSION['back_raovat'].'"</script>';

    location($linkrootshop);
}
}
if (isset($_POST['quayra'])==true) {

    header("location: $linkrootshop");
}

?>
<div class="form_dn">
    <ul>
        <li style="text-align: center;">
            <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Đổi mật khẩu</h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Mật khẩu cũ
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="password" name="pass_old1" value="<?php echo $pass_old1; ?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Mật khẩu mới
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="password" name="pass_new1" value="<?php echo $pass_new1; ?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Nhập lại mật khẩu mới
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="password" name="pass_new2" value="<?php echo $pass_new2; ?>" />
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
                            <input style="background:url('<?php echo $linkrootshop ;?>/imgs/layout/ok.png') no-repeat scroll 0 0 rgba(0, 0, 0, 0);" name="btn_doipass" class="btn_dn" type="submit" value="&nbsp;"/>
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