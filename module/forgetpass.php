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
				
		if ($rowtin['id'] == ""){
				$coloi=true;
			    echo "<script language='javascript'>alert('Email này sai hoặc chưa tồn tại trong hệ thống, vui lòng kiểm tra lại..!');</script>";
			}
		else{ // cập nhật pass
			
			if($rowtin['id']==""){
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
				echo '<script type="text/javascript"> window.location = "'.$linkrootshop.'"; </script>';
			
			}
		}
	}
	if (isset($_POST['quayra'])==true) {
	
		echo '<script type="text/javascript"> window.location = "'.$linkrootshop.'"; </script>';
	}

?>
<div class="form_dn">
    
    <ul>
        <li style="text-align: center;">
            <img src="<?php echo $linkrootshop;?>/imgs/layout/LoginRed.png" alt=""/>
        </li>
        <li>
            <div class="main_f_dn">
                <h1 class="title_f_tt">Quên mật khẩu</h1>
                <form id="form1" name="form1" method="post" action="#">
                <div class="main_f_tt">
                
                    <div class="module_ftt">
                        <div class="l_f_tt">
                            Email
                        </div>
                        <div class="r_f_tt">
                            <input class="ipt_f_tt" type="text" name="email" id="email" value="<?php echo $email; ?>" />
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
                            <input name="btn_doipass" id="btn_doipass" class="btn_qmk" type="submit" value="&nbsp;"/>
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