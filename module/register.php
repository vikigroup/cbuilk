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

        if(get_field("tbl_customer","username",$tendk,"id")!="") {$coloi=true; $loi = "Tên đăng nhập này đã được đăng ký!<br/>";}
        else if(get_field("tbl_customer","email",$email,"id")!="") {$coloi=true; $loi .= "Email này đã được đăng ký!<br/>";}

        if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $loi .= "Mã bảo mật chưa đúng!";}

		if ($loi!="") {$coloi=true; $error_login = $loi;}

		if ($coloi==FALSE) 
		{  
			
			$password=md5(md5(md5($matkhau)));
			$randomkey=chuoingaunhien(50);
			$khoa=1;
			$kichhoatx=0;
			$vale1='username,password,name,mobile,email,date_added,last_modified,active,status,randomkey';
			$vale2="'".$tendk."','".$password."','".$hoten."','".$dienthoai."','".$email."','".$ngay."','"
			.$ngay."','".$kichhoatx."','".$khoa."','".$randomkey."'";
			insert_table('tbl_customer',$vale1,$vale2,$hinh);

			$_SESSION['register_re']="1";

            echo("<script>
                window.onload = function(){
                    $('#divConfirm').html('<img src=".'../imgs/load.gif'."><p>Đang xử lý, xin vui lòng chờ...</p>');
                    lightbox_open('lightConfirm', 'fadeConfirm');
                    var dataString = 'email=".$email."&hoten=".$hoten."&tendk=".$tendk."&matkhau=".$matkhau."&key=".$randomkey."';
                    $.ajax({
                        type: 'POST',
                        url: 'lib/phpmailer/external/register_member.php',
                        data: dataString,
                        success: function(x){
                            $('#divConfirm').html('<menu><li class=".'success'.">Nhập thông tin</li><li class=".'success'.">Hệ thống kiểm tra</li><li class=".'error'.">Xác thực</li></menu>');
                            $('#divConfirm').append('<p>Đường dẫn kích hoạt tài khoản của bạn đã được gửi qua <b>".$email."</b>, vui lòng kiểm tra và làm theo hướng dẫn.</p>');
                            $('#divConfirm').append('<p>Nhấn <a class=".'aResendActiveLink'." onclick = ".'resendActiveLink("'.$email.'");'.">vào đây</a> để hệ thống gửi lại đường dẫn kích hoạt nếu bạn chưa nhận được. Hãy chắc chắn rằng bạn đã kiểm tra tất cả bao gồm hộp thư đến, thư rác, thùng rác, v.v.</p>');
                            $('.pCloseConfirm').show();
                        }
                    });
                }
            </script>");
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
	   if(strlen>=2) $("#error").load("<?php echo $linkrootshop;?>/module/username.php?user="+val);
	});

    $('#btn_dangky').click(function(){
		var tendk = $("#tendk").val();
		var password = $("#password").val();
		var golaimatkhau = $("#golaimatkhau").val();
		var hoten = $("#hoten").val();
		var email = $("#email").val();
		var cap = $("#cap").val();
        var check = 0;
		if(tendk.length < 2) {
            check = 1;
            alert("Tên đăng nhập phải >= 2 ký tự!");
		}
		else if(password.length < 3) {
            check = 1;
            alert("Mật khẩu phải >= 3 ký tự!");
		}
		else if(golaimatkhau != password) {
            check = 1;
            alert("Mật khẩu nhập lại chưa khớp!");
		}
		else if(hoten=="") {
            check = 1;
            alert("Bạn chưa nhập họ và tên!");
		}
		else if(email=="") {
            check = 1;
            alert("Bạn chưa nhập email!");
		}
        else if(isValidEmailAddress(email) == false){
            check = 1;
            alert("Email không đúng định dạng!")
        }
		else if(cap=="") {
            check = 1;
            alert("Bạn chưa nhập mã bảo mật!");
		}

        if(check == 0){
            $('#form1').submit();
        }
        else{
            return false;
        }
	});

    function isValidEmailAddress(emailAddress) {
        var regex = /\S+@\S+\.\S+/;
        return regex.test(emailAddress);
    }
});
</script>
    <ul>
        <li style="text-align: center;">
            <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt"> Đăng ký</h1>
                <form id="form1" name="form1" method="post">
                <div class="main_f_tt">
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Tên đăng nhập
                        </div>
                        <div class="r_f_tt" >
                            <div style="position:relative;">
                            	<input required class="ipt_f_tt" type="text" id="tendk" name="tendk" value="<?php echo $tendk; ?>" />
                            	<span id="error" style="position:absolute; top:7px; right:41px;" >  </span>
                            	<span class="star_style">* (Tối thiểu 2 ký tự)</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                             Mật khẩu
                        </div>
                        <div class="r_f_tt">
                            <input required class="ipt_f_tt" type="password" name="matkhau" id="password"/>
                            <span class="star_style">* (Tối thiểu 3 ký tự)</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                             Nhập lại mật khẩu
                        </div>
                        <div class="r_f_tt">
                            <input required class="ipt_f_tt" type="password" name="golaimatkhau" id="golaimatkhau"/>
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                             Họ và tên
                        </div>
                        <div class="r_f_tt">
                            <input required class="ipt_f_tt" type="text" name="hoten" id="hoten"  value="<?php echo $hoten; ?>"  />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                             Email
                        </div>
                        <div class="r_f_tt">
                            <input required class="ipt_f_tt" type="text" name="email" id="email"  value="<?php echo $email; ?>"  />
                            <span class="star_style">*</span>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                               Nhập mã xác nhận
                        </div>
                        <div class="r_f_tt">
                            <input style="width:200px; " required id="cap"  name="cap" value="<?php echo $cap; ?>" class="ipt_f_tt" type="text"/>
                            <div class="img_capcha" style="width:80px; padding-left:0px;">
                                <img  class="img_cap" align="absmiddle" src="<?php echo $linkrootshop;?>/scripts/capcha/dongian.php" alt=""><span class="star_style">*</span>
                        </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt">
                        <div class="l_f_tt">
                           &nbsp;
                        </div>
                        <div class="r_f_tt">
                            <div style="padding-bottom:15px;">
                            <input id="btn_dangky" name="btn_dangky" class="btn_dk" type="submit" value="&nbsp;"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div><!-- End .module_ftt -->
                    <div class="module_ftt"style="text-align:center; color:#F00; padding:5px;">
                        <?php echo $error_login;?>
                    </div>
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
