<?php  
 
if (isset($_POST['btn_dangnhap_in'])==true){
	$username= $_POST['username'];
	$password= md5(md5(md5($_POST['password'])));// md5()
	
	if (get_magic_quotes_gpc()== false) 
	 {
		$username=trim(mysql_real_escape_string($username));
		$password=trim(mysql_real_escape_string($password));
	 }
	 $coloi=false;
	 if ($username == NULL) {$coloi=true; $error_username_in = "Bạn chưa nhập tên đăng nhập";}
	 elseif ($_POST['password'] == NULL) {$coloi=true; $error_password_in = "Bạn chưa nhập password";}
	 
	 if ($coloi==FALSE) {
		 
		 $sql = sprintf("SELECT * FROM tbl_customer WHERE username='%s'", $username);
		 $user = mysql_query($sql);	
		 $row_user=mysql_fetch_assoc($user);
		 if (check_table('tbl_customer',"username='".$username."' AND password='".$password."'",'id')==true)
			{ $coloi=true;  $error_login="Tài khoản hoặc mật khẩu không đúng, vui lòng đăng nhập lại";}
		 elseif($row_user['active']==0)
		 	{ $error_login="Bạn chưa kích hoạt tài khoản, vui lòng kích hoạt mới đăng nhập tiếp";}
		 elseif($row_user['status']==0)
		 	{ location($linkrootshop.'dang-nhap.html');$error_login="Tài khoản của bạn đã bị khóa, vui lòng liên hệ Admin để biết thêm chi tiếp";}
		 
			   else {	//check neu dung chay
					$sql = sprintf("SELECT * FROM tbl_customer WHERE username='%s' AND password ='%s'",$username, $password);
					$user = mysql_query($sql);	
					if (mysql_num_rows($user)==1) {//Thành công	
					  $row_user = mysql_fetch_assoc($user);
					  $_SESSION['kh_login_id'] = $row_user['id'];
					  $_SESSION['kh_login_username'] = $row_user['username'];
				/*	  chinh_table('tbl_customer',$row_user['id'],'xem=xem+1',' ',' ');*/
					  
					  	//luu usernam va pass words
							if (isset($_POST['nho'])== true){
								setcookie("un", $_POST['username'], time() + 60*60*24*7 );
								setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
							} else 
							{
								setcookie("un", $_POST['username'], time()-1);
								setcookie("pw", $_POST['password'], time()-1);
							}
							
							if(isset($_SESSION['kh_login_username'])){  
								$row_user  = getRecord('tbl_customer', "username='".$_SESSION['kh_login_username']."'");
							 
								if($row_user['mobile']=="" || $row_user['address']=="") {
									header("location: ".$linkrootshop."/quan-ly.html");
								}
							}
																
									
							if(isset($_SESSION['back_raovat'])) echo '<script>window.location="'.$_SESSION['back_raovat'].'"</script>';
							if(isset($_SESSION['back_bds'])) echo '<script>window.location="'.$_SESSION['back_bds'].'"</script>';
							
							if(check_table('tbl_shop',"iduser='".$row_user['id']."'",'id')==false){
								$shop=getRecord('tbl_shop', "iduser='".$row_user['id']."'");
								echo '<script>window.location="http://'.$shop['subject'].'.'.$sub.'/quantri.html"</script>';
							}
							else echo '<script>window.location="'.$linkrootshop.'/dang-ky-gian-hang.html'.'"</script>';
							
							echo '<script>window.location="'.$linkrootshop.''.'"</script>';
				
					}else{ //Thất bại
						header("location: $linkrootshop");
				  	}	
			}//else
	 }//if ($coloi==FALSE)
}// if isset
	if (isset($_POST['quayra'])==true) {

		header("location: $linkrootshop");
	}
?>
<div class="form_dn">
   <script type="text/javascript">  
 
	$(document).ready(function() {				

		$("form[name=form1]").bind('submit',function(){
 
 
			var username=$("#username").val();
			var password=$("#password").val(); 
			
			if(username=="") {
				alert("Bạn chưa nhập tài khoản");
				return false;
			}
			if(password=="") {
				alert("Bạn chưa nhập mật khẩu");
				return false;
			} 
			 
		    
		});
		
		 
		 
	});				
</script>          
     <div style="padding:5px;   color:#F00; padding-bottom:10px;">
     	<center>
        	<?php if($_SERVER['HTTP_REFERER']=="http://shop.jbs.vn/dang-ky.html" && $_SESSION['register_re']==1)echo "Bạn vừa đăng ký thành công tài khoản ";?>
        </center>
     </div>
    <ul>
        <li>
            <center>
                <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.jpg" alt=""/>
            </center>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt"> Đăng nhập </h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Tên đăng nhập
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="text" id="username" name="username" value="<?php  echo $_COOKIE['un'];?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Mật khẩu
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="password" id="password" name="password" value="<?php  echo $_COOKIE['pw'];?>" />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <input type="checkbox"  name="nho" />
                            <span style="padding-left:5px;">Nhớ mật khẩu</span> | <a href="<?php echo $linkrootshop?>/quen-mat-khau.html" title="">Quên mật khẩu</a>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="module_ftt" style="color:#F00; text-align:center;">
                    	<?php echo $error_login;?>
                    </div>
                    
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input name="btn_dangnhap_in" class="btn_dn" type="submit" value="&nbsp;"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    
                    <div class="info_f_tt">
                        Đăng nhập bây giờ để quá trình mua hàng diễn ra nhanh chóng. Bạn cũng có thể xem chi tiết lịch sử giao dịch & tình trạng đơn hàng trong tài khoản của bạn.
                    </div><!-- End .info_f_tt -->
                    
                </div><!-- End .main_f_tt -->
                </form>
            </div><!-- End .main_f_dn -->
        </li>
    </ul>
    
    <div class="clear"></div>

</div>