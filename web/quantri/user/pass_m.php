<?php
	
	$username = $_SESSION['kh_login_username'];
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
		$passmin=6;
		$md5_pass_old1=md5(md5(md5($pass_old1)));
		$matkhaulay=get_field('tbl_customer','id',$id,'password');
		$md5_matkhaulay=md5(md5(md5($matkhaulay)));
		if ($pass_old1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu củ..!');</script>";}
		elseif ($pass_new1 == NULL){$coloi=true; echo "<script language='javascript'>alert('Bạn chưa nhập mật khẩu mới..!');</script>";}
		elseif (strlen($pass_new1)<$passmin ){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu mới phải lớn hơn ".$passmin." ký tự..!');</script>";}
		elseif ($pass_new1!=$pass_new2){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu mới bạn nhập 2 lần không giống nhau..!');</script>";}
		elseif ($md5_matkhaulay!=$md5_matkhaulay){$coloi=true; echo "<script language='javascript'>alert('Mật khẩu củ bạn nhập không đúng..!');</script>";;}
		else{ // cập nhật pass
			$sql=sprintf("update tbl_customer set password='%s' 
						where id='%d'", md5(md5(md5($pass_new1))), $id);
			mysql_query($sql) or die(mysql_error());
			echo "<script language='javascript'>alert('Chúc mừng bạn đã thay đổi mật khẩu thành công..!');</script>";
				echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/"; </script>';
		}
	}
	if (isset($_POST['quayra'])==true) {
	
		echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/"; </script>';
	}

?>

  <div class="frm_tbl">
    
        <form action="" method="post" enctype="multipart/form-data" name=formdk id=formdk> 
        <input type="hidden" name="act" value="pass_m">
                <table>
                
                    <tr>
                        <th><span class="line_form1">Mật khẩu cũ</span><span class="star_color">*</span></th>
                        <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="password" name="pass_old1" value="<?php echo $pass_old1; ?>"/>
                                <div class="coloi_hien"><?php echo $coloi_hien_pass_old1 ?></div>
                            </div>
                        </td>
                    </tr>                                
                     <tr>
                        <th><span class="line_form1">Mật khẩu mới </span></th>
                        <td>
                            <div class="pdd1">
                                <input class="ipt_txt1" type="password" name="pass_new1" value="<?php echo $pass_new1; ?>"/>
                                <div class="coloi_hien"><?php echo $coloi_hien_pass_new1 ?></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="line_form1">Nhập lại nật khẩu mới </span></th>
                        <td>
                            <div class="pdd1">
                              <input class="ipt_txt1" type="password" name="pass_new2" value="<?php echo $pass_new2; ?>"/>
                                <div class="coloi_hien"><?php echo $coloi_hien_pass_new2 ?></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <div class="pdd1">
                                <input  class="sub_txt1" id="btn_doipass" name="btn_doipass" type="submit" value="Chấp nhận"/>
                                &nbsp;
                                <input class="sub_txt1" type="submit" value="Quay lại"/>
                            </div>
                        </td>
                    </tr>
                                                 
                </table>
                </form>
        
</div>