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
	 /*if ($cap == NULL){$coloi=true; $coloi_hien_cap= "Bạn chưa nhập mã bảo mật kế bên";}*/
	 if ($username == NULL) {$coloi = true; $error_username1 = "Bạn chưa nhập tên đăng nhập!";}
	 if ($_POST['password'] == NULL) {$coloi = true; $error_password1 = "Bạn chưa nhập password!";}
	 if ($_POST['password'] != NULL){
	 	if (check_table('tbl_users',"password='".$password."'",'id') == true){ $coloi = true; $error_password1 = "Mật khẩu bạn nhập không đúng!";}
	 }
	/* if ($cap!=NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="Bạn đã nhập sai mã bảo mật.";}
	}*/	 
	 if($coloi == FALSE) {
		 $sql = sprintf("SELECT * FROM tbl_users WHERE username='%s'", $username);
		 $user = mysql_query($sql);	
		 $row_user = mysql_fetch_assoc($user);
		 if(mysql_num_rows($user) <= 0)$error_username1 = "Tên đăng nhập của bạn không đúng với bạn đăng ký!";
		 else if(check_table('tbl_users',"username='".$username."' AND password='".$password."'",'id')==true)
		 	{$coloi = true; $error_username1 = "Tài khoản và mật khẩu không đúng với bạn đăng ký";}
		 else if($row_user['idgroup'] == 1 || $row_user['idgroup'] == 0)$error_quyen = "Bạn không có quyền vào phần quản trị này.";
		 else if($row_user['status'] == 0) $error_khoa = "Tài khoản của bạn đã bị khóa, vui lòng liên hệ Admin để biết thêm chi tiết.";
         else{
             $sql = sprintf("SELECT * FROM tbl_users WHERE username='%s' AND password ='%s'",$username, $password);
             $user = mysql_query($sql);

             if(mysql_num_rows($user) == 1){
                 $row_user = mysql_fetch_assoc($user);
                 $_SESSION['kt_login_id'] = $row_user['id'];
                 $_SESSION['kt_login_username'] = $row_user['username'];
                 $_SESSION['kt_login_level'] = $row_user['idgroup'];
                 date_default_timezone_set('Asia/Ho_Chi_Minh');
                 // chinh_table('tbl_users',$row_user['id'],'xem=xem+1',' ',' ');
                 // chinh_table('tbl_users',$row_user['id'],'ngayvaocuoi='."'".$ngay."'",' ',' ');
                 if (isset($_POST['rememberme']) == true){
                     setcookie("un", $_POST['username'], time() + 60*60*24*7 );
                     setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
                 }else{
                     setcookie("un", $_POST['username'], time()-1);
                     setcookie("pw", $_POST['password'], time()-1);
                 }

                 if (strlen($_SESSION['back']) > 0){
                     $back = $_SESSION['back'];
                     unset($_SESSION['back']);
                     header("location:$back");
                 }else{
                     //header("location:$linkroot/manage.html");
                     $_SESSION['kt_login_username'] = $row_user['username'];
                 }
             }else{header("location:$linkroot"."");}
         }//else
	 }//if ($coloi==FALSE)
}// if isset
?>

<style type="text/css">
<!--
.img_cap {
	height: 25px;
}
.dangnhap {
	width:250px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: bold;
	color: #006E65;
	float: right;
	padding-left: 20px;
	padding-top: 10px;
	background-color: #EFEFEF;
}
.dangnhap a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-weight: bold;
	color: #006E65;
	text-decoration: none;
	margin-left: 15px;
}
.text {
	width: 200px;
}
.dangnhap a:hover {
	text-decoration: underline;
}
.error {
	font-style: italic;
	color: #C00;
	font-weight: normal;
	font-size: 12px;
}
#baoerror {
	font-size: 12px;
	font-style: italic;
	color: #F00;
	clear: both;
	float: none;
	font-weight: normal;
}
-->
</style>

<div style="float:left; margin-bottom:4px;">
  <div class="dangnhap" align="center">
	<?php if($_SESSION['kt_login_username'] == true){ ?>
        Chào, <span style="text-transform:uppercase; color:#606">
        <?php echo get_field('tbl_users','id',$_SESSION['kt_login_id'],'username'); ?>
        </span>
        <br/><br/>
        <a title="Đổi mật khẩu" href="admin.php?p=login_doipass">Mật khẩu</a>
        <a title="Đổi thông tin" href="admin.php?p=login_doithongtin">Thông tin</a>
        <br/>
        <a title="Thoát đăng nhập" style="color:#F00" href="admin.php?act=logout">Thoát đăng nhập</a>
        <br/><br/>
        <span>Tỷ giá USD/VND: <?php echo number_format(get_currency("USD", "VND", 1), 2); ?></span><br/>
        <span>(theo Google Finance)</span>
    <?php }else{ ?>
    <form id="form1" name="form1" method="post" action="">
        Tên Đăng Nhập:<br/>
        <input name="username" type="text" class="text" id="username" title="Nhập tên đăng nhập của bạn" value="<?php echo $_COOKIE['un']; ?>"/><br/>
        <span class="coloi_hien"><?php echo $error_username1;?></span><br/>
        Mật Khẩu:<br/>
        <input name="password" type="password" class="text" id="password" title="Nhập mật khẩu của bạn" value="<?php echo $_COOKIE['pw']; ?>"/><br/>
        <span class="coloi_hien"><?php echo $error_password1;?></span><br/>
        <span class="coloi_hien"><?php echo $coloi_hien_cap; ?></span><br/>
        <input title="Click để chấp nhận đăng nhập" type="submit" name="btn_dangnhap" class="nut_table" value="Đăng nhập"/> &nbsp;&nbsp;
        <input title="Check vào để ghi nhớ mật khẩu" type="checkbox" name="nho" id="nho"/>&nbsp;&nbsp;Ghi nhớ<br/>
    </form>
    <?php } ?>
    <div id="baoerror"><?php echo $error_khoa; ?></div>
    <div id="baoerror"><?php echo $_SESSION['error']; unset ($_SESSION['error']); ?></div>
    <div id="baoerror"><?php echo $error_quyen; ?></div>
  </div>
</div>

