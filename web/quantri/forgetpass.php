<?php

	include "mail_gmail/class.phpmailer.php"; 
	include "mail_gmail/class.smtp.php"; 
	
	if (isset($_POST['btn_doipass'])==true) {
		
		$email = $_POST['email'];

		$email = trim(strip_tags($email));

	
		if (get_magic_quotes_gpc()==false) 
				{
					$email = mysql_real_escape_string($email);
				}
		// kiểm tra dữ liệu nhập
		$coloi=false;	
		
		$rowtin=getRecord("tbl_customer", "email='".$email."'");
		$rowshopt=getRecord("tbl_shop", "id='".$idshop."'");
		
		
		if ($rowtin['id'] == ""){
				$coloi=true;
			    echo "<script language='javascript'>alert('Email này sai hoặc chưa tồn tại trong hệ thống, vui lòng kiểm tra lại..!');</script>";
			}
		else{ // cập nhật pass
			
			if($rowshopt['iduser']!=$rowtin['id']){
				echo "<script language='javascript'>alert('Email này không phải cửa bạn hoặc chưa tồn tại trong hệ thống, vui lòng kiểm tra lại..!');</script>";
				echo '<script type="text/javascript"> window.location = ""; </script>';
			}else{
			
				$rowmail=getRecord("tbl_config", "id=1");
				
				$noidung_Body_full=$noidung_AltBody
				.'<strong>website : </strong>'.$row_shop['name'].'<br />'
				.'<strong>Từ : </strong>'.$host_link_full.'<br />';
			
				$ng_ten=$row_shop['name'];;
				$ng_email=$rowmail['cauhinh_mail_ten'];
				$ch_email=$rowmail['cauhinh_mail_ten'];
				$ch_pass =$rowmail['cauhinh_mail_mk'];
			
				$nn_ten="Thành viên";
				$nn_email=$email;
				
				$tieude="Phục hồi mật khẩu - vui lòng không trả lời vào mail này";
				$noidung=$noidung_AltBody;
				
				
				
				/*********************************/
				
				if($email!=""){	
					$randomkey=chuoingaunhien(50);;
					$arrField = array(
						"idshop"              => "'".$idshop."'",
						"email"               => "'".$email."'",
						"dateadd"             => "'".$ngay."'",
						"randomkey"           => "'".$randomkey."'"
					); 
					insert("tbl_pass_randomkey",$arrField);
				
			
					$noidung_AltBody.="
					Có người vừa yêu cầu phục hồi mật khẩu, nếu không phải là bạn vui lòng quả qua và nếu đúng vui lòng làm theo hướng dẫn để phục hồi 
					<br> Nhấp vào link này để tiến hành xác nhận phục hồi mật khẩu <a href='".$host_link_full."/quantri/index.php?act=getpass&randomkey=".$randomkey."'> click here </a>";
					$noidung=$noidung_AltBody;
					
					$kq=@guimail($ng_ten,$ng_email,$ch_email,$ch_pass,$nn_ten,$nn_email,$tieude,$noidung);
				
				}
					
				echo "<script language='javascript'>alert('Bạn vừa yêu cầu khẩu thành công, xin vui lòng kiểm tra mail để phục hồi lại mật khẩu..!');</script>";
				echo '<script type="text/javascript"> window.location = ""; </script>';
			
			}
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
                
                    <form id="form1" name="form1" method="post" action="index.php?act=forgetpass" enctype="multipart/form-data">
                        <input type="hidden" name="act" value="forgetpass">
                        	<div>
                            	<label class="name_log">Email</label>
                                <input name="email" type="text" class="ipt_log" id="email" value="<?php echo $email; ?>"/>
                                <div class="pad_style"></div>
                            </div>
                            <div>
                            	<div class="pad_style"></div>
                                <div style="float:right;">
                                	<input id="btn_doipass" name="btn_doipass" class="btn_sub_log" type="submit" value=" Lấy lại mật khẩu"/>
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
                    </div>
                    <div class="clear"></div>
                </div><!-- End .f_error -->
                <?php } ?>
            
            </td>
        </tr>
    </table>

</div>