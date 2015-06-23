<?php   
if (isset($_POST['btn_dangnhap'])==true){
	$username= $_POST['username'];
	$password= md5(md5(md5($_POST['password'])));// md5()
	
		
	//kiem tra php co them / sau " va ' chua
	if (get_magic_quotes_gpc()== false) 
	 {
		$username=trim(mysql_real_escape_string($username));
		$password=trim(mysql_real_escape_string($password));
	 }
	 $coloi=false;
	 if ($username == NULL) {$coloi=true; $error_username1 = "<br />Bạn chưa nhập tên đăng nhập";}
	 if ($_POST['password'] == NULL) {$coloi=true; $error_password1 = "<br />Bạn chưa nhập password";}
	 
	 //kiem tra admin
	 $row_admin=getRecord("tbl_users","username='".$username."' AND password='".$password."' and idgroup=3");
	 
	 if($row_admin['id']!=""){
		 	$s=getRecord("tbl_customer","id='".$row_shop['iduser']."'");
			$_SESSION['kh_login_id'] =$s['id'];
			$_SESSION['kh_login_username'] = $s['username'];
			echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/index.php"; </script>'; 
		 
	 }else{
	 
	 
		 //thanh vien dang nhap
		 if ($_POST['password'] !=NULL){
			if (check_table('tbl_customer',"password='".$password."'",'id')==true){ $coloi=true; $error_password1 = "<br />Mật khẩu bạn nhập không đúng";} 
		 }
		 
		//check username
		 if ($coloi==FALSE) {
			 
			 $sql = sprintf("SELECT * FROM tbl_customer WHERE username='%s'", $username);
			 $user = mysql_query($sql);	
			 $row_user=mysql_fetch_assoc($user);
			 if(mysql_num_rows($user)<=0) $error_username1="<br />Tên đăng nhập của bạn không đúng với bạn đăng ký.";
			 else
			if (check_table('tbl_customer',"username='".$username."' AND password='".$password."'",'id')==true){ $coloi=true; $error_username1 = "<br />Tài khoản và mật khẩu không đúng với bạn đăng ký";}
			 elseif($row_user['status']==0)$error_khoa="<br />Tài khoản của bạn đã bị khóa, vui lòng liên hệ Admin để biết thêm chi tiết.";
			 
				   else {	//check neu dung chay 
				   //echo "as das";
							$user = mysql_query($sql);	
							if (mysql_num_rows($user)==1) {//Thành công	
							  $row_user = mysql_fetch_assoc($user);
							  $_SESSION['cu_login_id'] = $row_user['id'];
							  $_SESSION['cu_login_username'] = $row_user['username'];
							  //chinh_table('tbl_customer',$row_user['id'],'xem=xem+1',' ',' ');
						 
								$_SESSION['kh_login_id'] =$row_user['id'];
								$_SESSION['kh_login_username'] = $row_user['username'];
							  
							  //luu usernam va pass words
							if (isset($_POST['nho'])== true){
								setcookie("un", $_POST['username'], time() + 60*60*24*7 );
								setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
							} else {
								setcookie("un", $_POST['username'], time()-1);
								setcookie("pw", $_POST['password'], time()-1);
							}
	
							 echo '<script type="text/javascript"> window.location = "'.$host_link_full.'/quantri/index.php"; </script>'; 
					
						} else { //Thất bại
							echo '<script type="text/javascript"> window.location = "'.$host_link_full.'quantri/index.php"; </script>';
						//$error="Mat Khau Khong Dung";
						}	
				}//else
		 }//if ($coloi==FALSE)
		 
		 //ket thuc thanh vien dang nhap
	 }
	 
	 
}// if isset
?>
<div id="login_num">    

    <table>
        <tr>
            <td>
            
                <div class="main_login_num">
                
                    <form id="form1" name="form1" method="post" action="<?php $host_link_full?>/quantri/index.php" enctype="multipart/form-data">
                        
                        	<div>
                            	<label class="name_log">Tên đăng nhập</label>
                                <input class="ipt_log" id="username" name="username" type="text" value="<?php  echo $_COOKIE['un'];?>"/>
                                <div class="pad_style"></div>
                            </div>
                            <div>
                            	<label class="name_log">Mật khẩu</label>
                                <input class="ipt_log" name="password" type="password" id="password" title="Nhập mật khẩu của bạn" value="<?php  echo $_COOKIE['pw'];?>" />
                                <div class="pad_style"></div>
                            </div>
                            <div>
                            	<div class="pad_style"></div>
                            	<label style="float:left; display:block; height:26px; line-height:26px;">
                                	<input style="padding-top:5px;" type="checkbox"  name="nho" id="nho" />
                                    Remember Me &nbsp;&nbsp; <a href="index.php?act=forgetpass"> Quên mật khẩu </a>
                                </label>
                                <div style="float:right;">
                                	<input id="btn_dangnhap" name="btn_dangnhap" class="btn_sub_log" type="submit" value="Đăng nhập"/>
                                </div>
                                <div class="clear"></div>
                            </div>                        	
                        </form>
                
                </div><!-- End .main_login_num -->
                
				<?php if($coloi==true){?>
                <div class="f_error">
                    <img width="60" style="float:left;" src="imgs/layout/Error.png" alt=""/>
                    <div style="padding-left:23px;">
                        <?php echo $error_username1;?>
                        <?php echo $error_password1;?>
                        <?php echo $error_khoa;?>
                    </div>
                    <div class="clear"></div>
                </div><!-- End .f_error -->
                <?php } ?>
            
            </td>
        </tr>
    </table>

</div>