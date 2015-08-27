<?php
$errMsg = '';
if (isset($_POST['btn_dangnhap']) == true){
	$username = $_POST['username'];
	$password = md5(md5(md5($_POST['password'])));
	$cap = $_POST['cap'];
	
	if (get_magic_quotes_gpc() == false)
	 {
		$username = trim(mysql_real_escape_string($username));
		$password = trim(mysql_real_escape_string($password));
	 }

	 $coloi = false;

	 if ($cap == NULL){$coloi = true; $coloi_hien_cap = "Bạn chưa nhập mã bảo mật!";}
	 if ($username == NULL) {$coloi = true; $error_username1 = "Bạn chưa nhập tên đăng nhập!";}
	 if ($_POST['password'] == NULL) {$coloi = true; $error_password1 = "Bạn chưa nhập mật khẩu!";}
	 if ($_POST['password'] != NULL){
	 	if (check_table('tbl_users',"password='".$password."'",'id') == true){ $coloi = true; $error_password1 = "Mật khẩu không đúng!";}
	 }

	 if ($cap != NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi = true; $coloi_hien_cap = "Mã bảo mật không đúng.";}
     }

	 if($coloi == FALSE) {
		 $sql = sprintf("SELECT * FROM tbl_users WHERE username='%s'", $username);
		 $user = mysql_query($sql);
		 $row_user = mysql_fetch_assoc($user);
		 if(mysql_num_rows($user) <= 0)$error_username1 = "Tên đăng nhập không đúng!";
		 else if(check_table('tbl_users',"username='".$username."' AND password='".$password."'",'id') == true)
		 	{$coloi = true; $error_username1 = "Tài khoản và mật khẩu không đúng!";}
//		 else if($row_user['idgroup'] == 1 || $row_user['idgroup'] == 0) $error_quyen = "Bạn không có quyền vào phần quản trị này.";
		 else if($row_user['status'] == 0) $error_khoa = "Tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên để biết thêm chi tiết.";
         else{
             $sql = sprintf("SELECT * FROM tbl_users WHERE username='%s' AND password ='%s'",$username, $password);
             $user = mysql_query($sql);

             if(mysql_num_rows($user) == 1){
                 $row_user = mysql_fetch_assoc($user);
                 $_SESSION['kt_login_id'] = $row_user['id'];
                 $_SESSION['kt_login_username'] = $row_user['username'];
                 $_SESSION['kt_login_level'] = $row_user['idgroup'];
                 date_default_timezone_set('Asia/Ho_Chi_Minh');

                 mysql_query("UPDATE tbl_users SET view = view + 1, last_modified = '".$ngay."' WHERE id = '".$row_user['id']."'");

                 if(isset($_POST['rememberme']) == true){
                     setcookie("un", $_POST['username'], time() + 60*60*24*7 );
                     setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
                     $visitorTimeout = 60*60*24*7;
                 }else{
                     setcookie("un", $_POST['username'], time()-1);
                     setcookie("pw", $_POST['password'], time()-1);
                 }

                 if(strlen($_SESSION['back']) > 0){
                     $back = $_SESSION['back'];
                     unset($_SESSION['back']);
                     header("location:$back");
                 }else{
                     $_SESSION['kt_login_username'] = $row_user['username'];
                 }
             }else{header("location:$linkroot"."");}
         }//else
	 }//if ($coloi==FALSE)
}// if isset
?>

<div style="float:left; margin-bottom:4px;">
    <div class="dangnhap" align="center">
        <?php if($_SESSION['kt_login_username'] == true){ ?>
            <p>Chào, <span style="text-transform:uppercase; color:#606"><?php echo get_field('tbl_users','id',$_SESSION['kt_login_id'],'username'); ?></span></p>

            <p class="pLogin">
                <a title="Đổi mật khẩu" href="admin.php?act=login_doipass">Đổi mật khẩu</a>
                <a title="Chỉnh sửa thông tin" href="admin.php?act=login_doithongtin">Chỉnh sửa thông tin</a>
            </p>

            <p class="pLogin"><a title="Thoát" style="color:#F00" href="admin.php?act=logout">Thoát</a></p>

            <span>Tỷ giá USD/VND: <?php echo number_format(get_currency("USD", "VND", 1), 2); ?></span><br/>
            <span>(theo Google Finance)</span>
        <?php }else{ ?>
            <form id="form1" name="form1" method="post" action="">
                <p>Tên Đăng Nhập:</p>
                <p><input name="username" type="text" class="text" id="username" title="Nhập tên đăng nhập của bạn" value="<?php echo $_COOKIE['un']; ?>"/></p>
                <?php if($error_username1 != ''){ ?>
                    <p class="coloi_hien"><?php echo $error_username1; ?></p>
                <?php } ?>

                <p>Mật Khẩu:</p>
                <p><input name="password" type="password" class="text" id="password" title="Nhập mật khẩu của bạn" value="<?php echo $_COOKIE['pw']; ?>"/></p>
                <?php if($error_password1 != ''){ ?>
                    <p class="coloi_hien"><?php echo $error_password1; ?></p>
                <?php } ?>

                <p>Mã bảo mật:</p>
                <p>
                    <input name="cap" type="text" class="text_qm" id="cap" title="Nhập mã số bảo mật" value="<?php echo $cap; ?>"/>
                    <img src="../lib/capcha/dongian.php" align="absmiddle" class="img_cap"/>
                </p>
                <?php if($coloi_hien_cap != ''){ ?>
                    <p class="coloi_hien"><?php echo $coloi_hien_cap; ?></p>
                <?php } ?>

                <input title="Nhấn để bắt đầu quản trị hệ thống" type="submit" name="btn_dangnhap" class="nut_table" value="Đăng nhập"/>&nbsp;&nbsp;
                <input title="Nhấn để ghi nhớ thông tin đăng nhập" type="checkbox" name="nho" id="nho"/>&nbsp;&nbsp;Ghi nhớ<br/>
            </form>
        <?php } ?>

        <div id="baoerror"><?php echo $error_khoa; ?></div>
        <div id="baoerror"><?php echo $_SESSION['error']; unset ($_SESSION['error']); ?></div>
        <div id="baoerror"><?php echo $error_quyen; ?></div>
    </div>
</div>
