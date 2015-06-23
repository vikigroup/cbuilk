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
			update("tbl_pass_randomkey",$arrField,"randomkey='".$random."' and idshop='".$idshop."' ");
			 
			$noidung_AltBody.="
			Chúc mừng bạn đã khôi phục mật khẩu thành công! <br>
			Hãy dử dụng password mới để đăng nhập vào website để thay đổi lại mật khẩu theo ý muốn.
			<br> Mật khẩu để bạn đăng nhập là:".$pass
			." <br>".$row_shop['name']." - ".$host_link_full."<br>"
			;
			$noidung=$noidung_AltBody;
			
			$kq=@guimail($ng_ten,$ng_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
				
			echo "<script language='javascript'>alert('Bạn vừa yêu cầu khẩu thành công, xin vui lòng kiểm tra mail để phục hồi lại mật khẩu..!');</script>";
		    echo '<script type="text/javascript"> window.location = ""; </script>';
			
			}

	}
	if (isset($_POST['quayra'])==true) {
	
		echo '<script type="text/javascript"> window.location = ""; </script>';
	}

?>
<div id="login_num">    

    <table>
        <tr>
            <td>
            
                <div class="main_login_num">
                
                    <form id="form1" name="form1" method="post" action="index.php?act=getpass" enctype="multipart/form-data">
                        <input type="hidden" name="act" value="getpass">
                        	<div>
                                Bạn vừa xác nhận yêu cầu reset mật khẩ, chọn đồng ý để xác nhận!
                                <input id="randomkey" name="randomkey"  type="hidden" value="<?php echo $_GET['randomkey'];?>"/>
                                <div class="pad_style"></div>
                            </div>
                            <div>
                            	<div class="pad_style"></div>
                                <div style="float:right;">
                                	<input id="btn_doipass" name="btn_doipass" class="btn_sub_log" type="submit" value=" Đồng ý cấp lại mật khẩu"/>
                                </div>
                                <div class="clear"></div>
                            </div>                        	
                        </form>
                
                </div><!-- End .main_login_num -->
                
            
            </td>
        </tr>
    </table>

</div>