<?php  
if (isset($_POST['btn_dangky'])==true)//isset kiem tra submit
	{
		
		$tendk = $_POST['tendk'];
		$matkhau = $_POST['matkhau'];
		$golaimatkhau = $_POST['golaimatkhau'];
		$hoten = $_POST['hoten'];
		$email = $_POST['email'];
		$dienthoai = $_POST['dienthoai'];
		$cap = $_POST['cap'];
		
		
		$tendk = trim(strip_tags($tendk));
		$matkhau = trim(strip_tags($matkhau));
		$golaimatkhau = trim(strip_tags($golaimatkhau));
		$hoten = trim(strip_tags($hoten));
		$email = trim(strip_tags($email));
		$dienthoai = trim(strip_tags($dienthoai));

		
		if (get_magic_quotes_gpc()==false) 
			{
				$tendk = mysql_real_escape_string($tendk);
				$matkhau = mysql_real_escape_string($matkhau);
				$golaimatkhau = mysql_real_escape_string($golaimatkhau);
				$hoten = mysql_real_escape_string($hoten);
				$email = mysql_real_escape_string($email);
				$dienthoai = mysql_real_escape_string($dienthoai);
			}
		
		$coloi=false;		
		if ($tendk == NULL){$coloi=true; $coloi_hien_tendk = "Bạn chưa nhập tên đăng nhập (>=4 ký tự)";} 
		if ($matkhau == NULL){$coloi=true; $coloi_hien_matkhau = "Bạn chưa nhập mật khẩu (>=6 ký tự)";}
		if ($golaimatkhau == NULL){$coloi=true; $coloi_hien_golaimatkhau = "Bạn chưa nhập lại mật khẩu";}
		if ($hoten == NULL){$coloi=true; $coloi_hien_hoten = "Bạn chưa nhập họ tên";}
		if ($email == NULL){$coloi=true; $coloi_hien_email= "Bạn chưa nhập email";}
/*		if ($dienthoai == NULL){$coloi=true; $coloi_hien_dienthoai= "<br />Bạn chưa nhập số điện thoại";}*/
		if ($cap == NULL){$coloi=true; $coloi_hien_cap= "Bạn chưa nhập ký tự giống trong hình ";} 

		
		if($tendk!=NULL){
			if (strlen($tendk)<4){$coloi=true; $coloi_hien_tendk = "Tên đăng nhập (>=4 ký tự)";}
		}

/*		if($dienthoai!=NULL){
			if (!is_numeric($dienthoai)){$coloi=true; $coloi_hien_dienthoai = "Số điện thoại phải là số";}
		}*/
		
		if($matkhau!=NULL){
			if (strlen($matkhau)<6 ){$coloi=true; $coloi_hien_matkhau = "Mật khẩu (>=6 ký tự)";}
		}
		if($golaimatkhau!=NULL){	
			if ($matkhau != $golaimatkhau ){$coloi=true; $coloi_hien_golaimatkhau = "Mật khẩu lần 2 không giống lần 1";} 
		}
		
/*		if($email!=NULL){
			if (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_email= "Bạn nhập email không đúng kiểu ( email@yahoo.com )";	
			}
		}*/
		
		if($tendk!=NULL){	
			if (check_table('tbl_customer','username='."'".$tendk."'",'id')==false) {$coloi=true; $coloi_hien_tendk = "Tên đăng nhập này đã có người dùng";}
			echo "<script language='javascript'>alert('".$coloi_hien_tendk."');</script>";
		}
		
	
		
		if($email!=NULL){
			if (check_table('tbl_customer','email='."'".$email."'",'id')==false) {$coloi=true; $coloi_hien_email = "Địa chỉ mail này đã có người dùng";} 
			echo "<script language='javascript'>alert('".$coloi_hien_email."');</script>";
		}
		
		
		
/*		if($dienthoai!=NULL){
			if (check_table('tbl_customer','mobile='."'".$dienthoai."'",'id')==false) {$coloi=true; $coloi_hien_dienthoai = "Số điện thoại này đã có người dùng";}
		}*/
	
		/*if ($cap!=NULL){
			if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="Bạn nhập sai mã số trong hình rồi";}
		}*/

		if ($loi!="") {$coloi=true; $error_hien_filechon = $loi;}

		if ($coloi==FALSE) 
		{  
			
			$password=md5(md5(md5($matkhau)));
			$randomkey=chuoingaunhien(50);
			$khoa=1;
			$kichhoatx=1;
			$vale1='username,password,name,mobile,email,date_added,last_modified,active,status,randomkey';
			$vale2="'".$tendk."','".$password."','".$hoten."','".$dienthoai."','".$email."','".$ngay."','"
			.$ngay."','".$kichhoatx."','".$khoa."','".$randomkey."'";
			insert_table('tbl_customer',$vale1,$vale2,$hinh);

			header("location: $linkrootshop/dang-ky-thanh-cong.html");
			/*echo thongbao($linkrootshop."/dang-nhap.html",$thongbao='Chúc mừng bạn đã đăng ký tài khoản thành công..! Vui lòng kích hoạt tài khoản trực tiếp trên trang web trước khi đăng nhập..!')	;*/
			
		}
}

	$username = $_SESSION['kh_login_username'];
	if (isset($_POST['quayra'])==true) {

		header("location: $linkrootshop");
	}

?>
<div class="form_dn">
  <script>
$(document).ready(function() {	
	$("#tendk").keyup(function(){  
	   var val=this.value;
	   var strlen=val.length;
	   if(strlen>=4) $("#error").load("<?php echo $linkrootshop;?>/module/username.php?user="+val); 
	});
	
	$("form[id=form1]").bind('submit',function(){
		var tendk=$("#tendk").val();
		var password=$("#password").val();  
		var golaimatkhau=$("#golaimatkhau").val(); 
		var hoten=$("#hoten").val();
		var email=$("#email").val();
		var cap=$("#cap").val();
		if(tendk=="") {
			alert("Bạn chưa nhập tên đăng ký");
			return false;
		}
		if(password=="") {
			alert("Bạn phải nhập mật khẩu");
			return false;
		}
		if(golaimatkhau=="") {
			alert("Bạn phải nhập xác nhận mật khẩu");
			return false;
		}
		if(hoten=="") {
			alert("Bạn phải nhập tên");
			return false;
		} 
		if(email=="") {
			alert("Bạn phải nhập email");
			return false;
		} 
		if(cap=="") {
			alert("Bạn chưa nhập mã bảo mật");
			return false;
		}
	})
	
});
	
	

</script>
  
    <ul>
        <li>
            <center>
                <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.jpg" alt=""/>
            </center>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt"> Đăng ký thành công </h1>
              
                <div class="main_f_tt">
                
                    <div style="padding:5px;">
                    	Bạn vừa đăng ký thành công. Nhấp vào <a href="http://shop.jbs.vn/dang-nhap.html">đây</a> để đăng nhập 
                    </div>
                
                </div><!-- End .main_f_tt -->
                
            </div><!-- End .main_f_dn -->
        </li>
    </ul>
    
    <div class="clear"></div>

</div>