<?php

	include "mail_gmail/class.phpmailer.php"; 
	include "mail_gmail/class.smtp.php"; 

	if (isset($_POST['btn_doipass'])==true) {
		
		    $random=$_POST['randomkey'];
 
		    $rowtin=getRecord("tbl_pass_randomkey", "randomkey='".$random."' and idshop='".$idshop."' and status=0");
		 
			if($rowtin['id']=="") {
				echo "<script language='javascript'>alert('Yêu cầu hết hạn hoặc không có thực..!');</script>";
				echo '<script type="text/javascript"> window.location = ""; </script>';
			}else {
				
			$today= date("Y-m-d");;	
			if($today!=$rowtin['dateadd'])	 {
				$arrField = array(
					"status"            => "1"
				); 
				update("tbl_pass_randomkey",$arrField,"randomkey='".$random."' and idshop='".$idshop."' ");
				
				echo "<script language='javascript'>alert('Yêu cầu hết hạn, vui lòng làm lại bước yêu cầu lại mật khẩu..!');</script>";
				echo '<script type="text/javascript"> window.location = ""; </script>';
			}
				
			$rowmail=getRecord("tbl_config", "id=1");
			
			$noidung_Body_full=$noidung_AltBody
			.'<strong>website : </strong>'.$row_shop['name'].'<br />'
			.'<strong>Từ : </strong>'.$host_link_full.'<br />';
		
			
			$ng_ten=$row_shop['name'];
			$ng_email=$rowmail['cauhinh_mail_ten'];
			
			$ch_email=$rowmail['cauhinh_mail_ten'];
			$ch_pass =$rowmail['cauhinh_mail_mk'];

			$nn_ten="Thành viên";
			$nn_email=$rowtin['email'];
			
			$tieude="Phục hồi mật khẩu - thông tin tài khoản";
			$noidung=$noidung_AltBody;
			
			
			
			/*********************************/
				
			$pass=chuoingaunhien(6);;
			$password=md5(md5(md5($pass)));
			$arrField = array(
				"password"            => "'".$password."'",
				"last_modified 	"     => "'".$ngay."'"
			); 
			update("tbl_customer",$arrField,"email='".$rowtin['email']."'");
			
			$arrField = array(
				"status"            => "1"
			); 
			update("tbl_pass_randomkey",$arrField,"randomkey='".$random."' ");
			 
			$noidung_AltBody.="
			Chúc mừng bạn đã khôi phục mật khẩu thành công! <br>
			Hãy dử dụng password mới để đăng nhập vào website để thay đổi lại mật khẩu theo ý muốn.
			<br> Mật khẩu để bạn đăng nhập là:".$pass
			." <br>".$row_shop['name']." - ".$host_link_full."<br>"
			;
			$noidung=$noidung_AltBody;
			
			$kq=@guimail($ng_ten,$ng_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
				
			echo "<script language='javascript'>alert('Bạn vừa yêu cầu khẩu thành công, xin vui lòng kiểm tra mail để phục hồi lại mật khẩu..!');</script>";
		    echo '<script type="text/javascript"> window.location = "'.$linkrootshop.'"; </script>';
			
			}

	}
	if (isset($_POST['quayra'])==true) {
	
		echo '<script type="text/javascript"> window.location = "'.$linkrootshop.'"; </script>';
	}

?>
<div class="form_dn">
    
    <ul>
        <li>
            <center>
                <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
            </center>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Lấy lại mật khẩu</h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                
                    <div class="module_ftt">
                         
                        <div class="r_f_tt">
                            <input  id="randomkey" name="randomkey"  type="hidden"value="<?php echo $_GET['randomkey'];?>" />
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
                            <input name="btn_doipass" id="btn_doipass" class="btn_dn" type="submit" value="&nbsp;"/>
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