<?php
	if(isset($_SESSION['kt_login_username']) == false){
        header("location: ../../../../index.php");
	}else {
        $username = $_SESSION['kt_login_username'];
        if (isset($_POST['btn-doipass']) == true) {
            $pass_old1 = $_POST['pass_old1'];
            $pass_new1 = $_POST['pass_new1'];
            $pass_new2 = $_POST['pass_new2'];
            $username = $_SESSION['kt_login_username'];
            $id = $_SESSION['kt_login_id'];
            settype($id, "int");

            $pass_old1 = trim(strip_tags($pass_old1));
            $pass_new1 = trim(strip_tags($pass_new1));
            $pass_new2 = trim(strip_tags($pass_new2));

            if (get_magic_quotes_gpc() == false) {
                $pass_old1 = mysql_real_escape_string($pass_old1);
                $pass_new1 = mysql_real_escape_string($pass_new1);
                $pass_new2 = mysql_real_escape_string($pass_new2);
            }
            // kiểm tra dữ liệu nhập
            $coloi = false;
            $passmin = 6;
            $md5_pass_old1 = md5(md5(md5($pass_old1)));
            $matkhaulay = get_field('tbl_users','id',$id,'password');
            if($pass_old1 == NULL) {
                $coloi = true;
                $error = "<br/>Bạn chưa nhập mật khẩu cũ!";
            }else if($pass_new1 == NULL) {
                $coloi = true;
                $error = "<br/>Bạn chưa nhập mật khẩu mới!";
            }else if(strlen($pass_new1) < $passmin) {
                $coloi = true;
                $error = "<br />Mật khẩu mới phải lớn hơn hoặc bằng $passmin ký tự!";
            }else if($pass_new1 != $pass_new2) {
                $coloi = true;
                $error = "<br/>Mật khẩu xác nhận không đúng!";
            }else if($matkhaulay != $md5_pass_old1) {
                $coloi = true;
                $error = "<br/>Mật khẩu cũ không đúng!";
            }else{ // cập nhật pass
                $sql = sprintf("update tbl_users set password='%s' where id='%d'", md5(md5(md5($pass_new1))), $id);
                mysql_query($sql) or die(mysql_error());
                echo "<script language='javascript'>alert('Chúc mừng bạn đã thay đổi mật khẩu thành công!');</script>";
                location('admin.php');
            }
        }
    }
?>

<form action="" method="post" name="formdoipass" id="formdoipass">
    <table align="center" border="0">
        <tr>
            <td colspan="5" align="center" valign="top" class="table_chu_tieude_them">ĐỔI MẬT KHẨU</td>
        </tr>
        <tr>
            <td colspan="4" align="center" class="chuhd">Các ô có dấu sao (<span class="sao">*</span>) là những thông tin bắt buộc. Xin vui lòng không được để trống.</td>
        </tr>
        <tr>
            <th align="right" valign="top" class="ten">&nbsp;</th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung">&nbsp;</td>
        </tr>
        <tr>
            <th align="right" class="table_chu"><span class="sao">*</span>Tài khoản: </th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung">
                <span style="color:#C00; text-transform:uppercase; font-size:16px;">
                    <strong><?php echo $username; ?></strong>
                </span>
            </td>
        </tr>
        <tr>
            <th align="right" class="table_chu"><span class="sao">*</span>Mật khẩu cũ: </th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung">
                <input name="pass_old1" type="password" class="table_khungnho" required id="pass_old1" title="Nhập mật khẩu cũ của bạn" value="<?php echo $pass_old1; ?>">
            </td>
        </tr>
        <tr>
            <th align="right" class="table_chu"><span class="sao">*</span>Mật khẩu mới: </th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung">
                <input name="pass_new1" type="password" class="table_khungnho" required id="pass_new1" title="Nhập mật khẩu mới (>=6 ký tự)" value="<?php echo $pass_new1; ?>"/>
            </td>
        </tr>
        <tr>
            <th align="right" class="table_chu"><span class="sao">*</span>Xác nhận mật khẩu: </th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung">
                <input name="pass_new2" type="password" class="table_khungnho" required id="pass_new2" title="Xác nhận mật khẩu" value="<?php echo $pass_new2; ?>"/>
            </td>
        </tr>
        <tr>
            <th align="right" class="table_chu">&nbsp;</th>
            <td align="left" class="table_khung">&nbsp;</td>
            <td align="left" class="table_khung"><span class="coloi_hien"><?php echo $error; ?></span></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><br />
                <input type="submit" name="btn-doipass" class="nut_table" value="Cập nhật" title="Cập nhật"/>
                &nbsp;&nbsp;
                <input type="button" name="quayra" class="nut_table" value="Đóng" title="Đóng" onclick="window.history.back();"/><br/>
            </td>
        </tr>
    </table>
</form>

