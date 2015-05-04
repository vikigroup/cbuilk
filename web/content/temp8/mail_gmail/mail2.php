<?php
	include "class.phpmailer.php"; 
	include "class.smtp.php"; 
	

	$sql = "SELECT emailkh
			FROM version 
			WHERE idversion=1";
	$mail_kh = mysql_query($sql) or die (mysql_error());
	$row_mail_kh=mysql_fetch_assoc($mail_kh);
	
	$nguoinhan_to=$row_mail_kh['emailkh'];
	$noidung_AltBody='<strong>Mail này gửi từ  Website '.$ten_web_site.' Khách hàng đặt câu hỏi</strong>'.'<br /><br />';
	
if($lang==1){
		$lienhe_xem='ĐÓNG GÓP Ý KIẾN';
		$luuy_xem='Quý khách hàng vui lòng điền đầy đủ thông tin để chúng tôi tiện trả lời thư..Trân trọng..!<br />
            Những ô có dấu sao ( <span class="sao">*</span> ) là bắt buộc phải nhập.';
		$name_x='Tên của bạn : ';
		$phone_x='Điện thoại : ';
		$mail_x='Địa chỉ mail : ';
		$td_x='Tiêu đề thư : ';
		$nd_x='Nội dung thư : ';
		$code_x='Mã số an toàn : ';
		$gui_x='Gửi đi';
		$thoat_x='Quay ra';
}else{
		$lienhe_xem='COMMENTS';
		$luuy_xem='Custommer please complete us information to respond to a message means .. .. Best regards!<br />Fields marked with an asterisk ( <span class="sao">*</span> ) is mandatory.';
		
		$name_x='Your name : ';
		$phone_x='Phone : ';
		$mail_x='E-mail Address : ';
		$td_x='Message Title : ';
		$nd_x='Message content : ';
		$code_x='Security code : ';
		$gui_x='Sent';
		$thoat_x='Exit';
}

?>
<style>
	.coloi_hien{
	color:#C00;
	font-style:italic;
	font-size: 12px;
}
	.table_chinh{ padding:10px}
	.table_chu_tieude{
	font-size:18px;
	font-weight:bold
}
	.table_khungnho{
	width:400px;
	border: 1px solid #CCC;
}
#noidung {
	border: 1px solid #CCC;
}
	.sao{ color:#C00; font-size:18px}
	.nut-table{
	background-color:#38B724;
	color:#FFF;
	width:100px;
	padding:3px;
	border:1px solid #CCC;
	margin-top: 5px;
	margin-bottom: 5px;
	font-weight: bold;
	}



	.table_chu{
	font-weight:normal;
	font-size: 14px;
}
</style>
 <?php 
if (isset($_POST['them'])==true)//isset kiem tra submit
	{

	
		$tennguoigui_name = $_POST['tennguoigui_name'];
		$nguoigui_from = $_POST['nguoigui_from'];
		$tieude_Subject = $_POST['tieude_Subject'];
		$noidung_Body = $_POST['noidung_Body'];
		$dienthoai = $_POST['dienthoai'];
		$cap = $_POST['cap'];
		

		$tennguoigui_name = trim(strip_tags($tennguoigui_name));
		$nguoigui_from = trim(strip_tags($nguoigui_from));
		$tieude_Subject = trim(strip_tags($tieude_Subject));
		$noidung_Body = trim(strip_tags($noidung_Body));
		$dienthoai = trim(strip_tags($dienthoai));
		
		if (get_magic_quotes_gpc()==false) 
			{
				$tennguoigui_name = mysql_real_escape_string($tennguoigui_name);
				$nguoigui_from = mysql_real_escape_string($nguoigui_from);
				$tieude_Subject = mysql_real_escape_string($tieude_Subject);
				$noidung_Body = mysql_real_escape_string($noidung_Body);
				$dienthoai = mysql_real_escape_string($dienthoai);
			}
		
		$coloi=false;	
		if($lang==1){
		if ($tennguoigui_name == NULL){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Bạn chưa nhập tên của bạn";}
		if ($nguoigui_from == NULL){$coloi=true; $coloi_hien_nguoigui_from = "<br />Bạn chưa nhập địa chỉ email của bạn";}
		if ($tieude_Subject == NULL){$coloi=true; $coloi_hien_tieude_Subject = "<br />Bạn chưa nhập tiêu đề thư";}
		if ($dienthoai == NULL){$coloi=true; $coloi_hien_dienthoai= "<br />Bạn chưa nhập số điện thoại";}
		if ($noidung_Body == NULL){$coloi=true; $coloi_hien_noidung_Body = "<br />Bạn chưa nhập nội dung";}
		if ($cap == NULL){$coloi=true; $coloi_hien_cap= "<br />Bạn chưa nhập ký tự giống trong hình ";}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)<3 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Tên phải nhiều hơn 3 ký tự";}
		}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)>50 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />Tên phải ít hơn 50 ký tự";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)<5 ){$coloi=true; $coloi_hien_dienthoai = "<br />Điện thoại phải nhiều hơn 5 ký tự";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)>20 ){$coloi=true; $coloi_hien_dienthoai = "<br />Điện thoại phải ít hơn 20 ký tự";}
		}		
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)<5 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Tiêu đề thư phải nhiều hơn 5 ký tự";}
		}
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)>200 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Tiêu đề thư phải ít hơn 200 ký tự";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)<5 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Nội dung thư phải nhiều hơn 5 ký tự";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)>1000 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Nội dung thư  phải ít hơn 1000 ký tự";}
		}		
		
		if($nguoigui_from!=NULL){
			if (filter_var($nguoigui_from,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_nguoigui_from= "<br />Bạn nhập email không đúng kiểu ( ten@yahoo.com )";	
			}
		}
		
		if ($cap!=NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="<i>Bạn nhập sai mã số trong hình rồi</i>";}
		}
		
		}else {
			
		if ($tennguoigui_name == NULL){$coloi=true; $coloi_hien_tennguoigui_name = "<br />You are not enter your name";}
		if ($nguoigui_from == NULL){$coloi=true; $coloi_hien_nguoigui_from = "<br />You may enter your email address";}
		if ($tieude_Subject == NULL){$coloi=true; $coloi_hien_tieude_Subject = "<br />You have not entered the message header";}
		if ($dienthoai == NULL){$coloi=true; $coloi_hien_dienthoai= "<br />You may enter a phone number";}
		if ($noidung_Body == NULL){$coloi=true; $coloi_hien_noidung_Body = "<br />You may enter text";}
		if ($cap == NULL){$coloi=true; $coloi_hien_cap= "<br />You may enter the same characters in the picture ";}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)<3 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />The name must be more than 3 characters";}
		}
		
		if($tennguoigui_name!=NULL){
			if (strlen($tennguoigui_name)>50 ){$coloi=true; $coloi_hien_tennguoigui_name = "<br />The name must be less than 50 characters";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)<5 ){$coloi=true; $coloi_hien_dienthoai = "<br />Phone must be more than 5 characters";}
		}
		
		if($dienthoai!=NULL){
			if (strlen($dienthoai)>20 ){$coloi=true; $coloi_hien_dienthoai = "<br />The phone must be less than 20 characters";}
		}		
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)<5 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Message subject to more than 5 characters";}
		}
		
		if($tieude_Subject!=NULL){
			if (strlen($tieude_Subject)>200 ){$coloi=true; $coloi_hien_tieude_Subject= "<br />Message headers must be less than 200 characters";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)<5 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Content of messages to more than 5 characters";}
		}
		
		if($noidung_Body!=NULL){
			if (strlen($noidung_Body)>1000 ){$coloi=true; $coloi_hien_noidung_Body= "<br />Content of messages must be less than 1000 characters";}
		}		
		
		if($nguoigui_from!=NULL){
			if (filter_var($nguoigui_from,FILTER_VALIDATE_EMAIL)==FALSE){$coloi=true; $coloi_hien_nguoigui_from= "<br />Enter your email wrong type (ten@yahoo.com)";	
			}
		}
		
		if ($cap!=NULL){
		if ($_SESSION['captcha_code'] != $cap) {$coloi=true; $coloi_hien_cap="<i>You enter the wrong code in the image and then</i>";}
		}			
			
		}
		
		
		if($coloi==FALSE)
		{
		
		   $sql = "SELECT * from email";
				$guimail = mysql_query($sql) or die (mysql_error());
				$row_guimail=mysql_fetch_assoc($guimail);
		
			$noidung_Body_full=$noidung_AltBody
			.'<strong>Người gửi : </strong>'.$tennguoigui_name.'<br />'
			.'<strong>Email : </strong>'.$nguoigui_from.'<br />'
			.'<strong>Điện thoại : </strong>'.$dienthoai.'<br /><br />'
			.'<strong>Nội dung : </strong>'.$noidung_Body.'<br />';
			
			$mail = new PHPMailer();
			$mail->IsSMTP(); // set mailer to use SMTP
			$mail->Host = "smtp.gmail.com"; // specify main and backup server
			$mail->Port = 465; // set the port to use
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->SMTPSecure = 'ssl';
			$mail->Username =  $row_guimail['username']; // your SMTP username or your gmail username
			$mail->Password =  $row_guimail['pass']; // your SMTP password or your gmail password
			$from = $nguoigui_from; // Reply to this email
			$to=$emailto; // Recipients email ID
			$name=$tennguoigui_name; // Recipient's name
			$mail->From = $from;
			$mail->FromName = $tennguoigui_name; // Name to indicate where the email came from when the recepient received
			$mail->AddAddress($to,$name);
			$mail->AddReplyTo($from,$tennguoigui_name);
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = $tieude_Subject;
			$mail->Body = $noidung_Body_full;
			//"<b>Mail nay duoc goi bang phpmailer class. - <a href='http://bloghoctap.com'>bloghoctap.com</a></b>"; 
			$mail->AltBody = $noidung_AltBody; //Text Body
			//$mail->SMTPDebug = 2;
			if(!$mail->Send())
				{
					$coloi_hien_tonquat="<h1>Gửi mail không thành công..!: " . $mail->ErrorInfo;
				}
				else
					{
						header("location: librarys/incs/mail_gmail/mail_thanhcong.php");
					};
				}
	}
?>
<?php
	if (isset($_POST['quayra'])==true) {

		header("location: index.php");
	}

?>
<form action="" method="post" enctype="multipart/form-data" name=formdk id=formdk>  
  <table border="0" class="table_chinh">
          <tr>
            <td colspan="3" align="center" valign="top">&nbsp;</td>
          </tr>
           <tr>
            <td colspan="3" align="center" valign="top" class="table_chu_tieude">
            
            <?php echo $lienhe_xem; ?>
            
            </td>
          </tr>
          <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top" class="chuhd">
             <?php echo $luuy_xem; ?>
            
            </td>
          </tr>
          <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="top">
            <span class="coloi_hien"><?php echo $coloi_hien_tonquat ?></span>
            </td>
          </tr>
                  
           <tr class="table_chan">
            	<td align="right" valign="top" class="table_chu"><span class="sao">*</span><?php echo $name_x; ?> </td>
           	 <td align="left" valign="top" class="table_khung">&nbsp;</td>
            	<td align="left" valign="top" class="table_khung">
                	<input name="tennguoigui_name" type="text" class="table_khungnho" id="tennguoigui_name" title="<?php echo $name_x; ?>" size="70" value="<?php echo $tennguoigui_name ?>" />
                    <br /><span class="coloi_hien"><?php echo $coloi_hien_tennguoigui_name ?></span>
           		</td>
          </tr>
  <tr class="table_chan">
             <td align="right" valign="top" class="table_chu"><span class="sao">*</span><?php echo $phone_x; ?></td>
             <td align="left" valign="top" class="table_khung">&nbsp;</td>
             <td align="left" valign="top" class="table_khung">
  <input name="dienthoai" type="text" class="table_khungnho" id="dienthoai" title="<?php echo $phone_x; ?>" size="70" value="<?php echo $dienthoai ?>" />
                    <br /><span class="coloi_hien"><?php echo $coloi_hien_dienthoai ?></span>           
             </td>
    </tr>          
          <tr class="table_chan">
            	<td align="right" valign="top" class="table_chu"><span class="sao">*</span><?php echo $mail_x; ?></td>
           	<td align="left" valign="top" class="table_khung">&nbsp;</td>
            	<td align="left" valign="top" class="table_khung">
                	<input name="nguoigui_from" type="text" class="table_khungnho" id="nguoigui_from" title="<?php echo $mail_x; ?>" size="70" value="<?php echo $nguoigui_from ?>" />
                    <br /><span class="coloi_hien"><?php echo $coloi_hien_nguoigui_from ?></span>
           		</td>
          </tr>
          
          <tr class="table_chan">
            	<td align="right" valign="top" class="table_chu"><span class="sao">*</span><?php echo $td_x; ?></td>
           	<td align="left" valign="top" class="table_khung">&nbsp;</td>
            	<td align="left" valign="top" class="table_khung">
                	<input name="tieude_Subject" type="text" class="table_khungnho" id="tieude_Subject" title="<?php echo $td_x; ?>" size="70" value="<?php echo $tieude_Subject ?>" />
                    <br /><span class="coloi_hien"><?php echo $coloi_hien_tieude_Subject ?></span>
           		</td>
          </tr>
          
         
          
          <tr class="table_chan">
            	<td align="right" valign="top" class="table_chu"><span class="sao">*</span><?php echo $nd_x; ?></td>
           	<td align="left" valign="top" class="table_khung">&nbsp;</td>
            	<td align="left" valign="top" class="table_khung"><textarea name="noidung_Body" cols="70" rows="10" class="table_khungnho" id="noidung_Body" title="<?php echo $nd_x; ?>"><?php echo $noidung_Body ;?></textarea>
                    <br />	<span class="coloi_hien"><?php echo $coloi_hien_noidung_Body?> </span>
                </td>
          </tr>
 <tr class="table_le">
            	<td align="right" valign="top" class="table_chu_login"><span class="sao">*</span><?php echo $code_x ; ?></td>
            	<td align="left" valign="top" class="table_khung_td">&nbsp;</td>
                <td align="left" valign="top" class="table_khung_td">
   <input name="cap" type="text" class="table_khungnho_login" id="cap" title="<?php echo $code_x; ?>" value="<?php echo $cap; ?>" /> 
                 <div class="coloi_hien"> <?php echo $coloi_hien_cap ?> </div>  
                 <img src="scripts/capcha/dongian.php" width="80" class="img-cap" />  
                </td>
          </tr>          
          <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="middle">&nbsp;</td>
    </tr>
           <tr>
             <td colspan="3" align="center" valign="top">
             <input type="submit" name="them" class="nut-table" value="<?php echo $gui_x; ?>" title="<?php echo $gui_x; ?>" />&nbsp;&nbsp;
             <input type="submit" name="quayra" class="nut-table" value="<?php echo $thoat_x; ?>" title="<?php echo $thoat_x; ?>" />
             </td>
           </tr>
           <tr>
             <td colspan="3" align="center" valign="top">&nbsp;</td>
           </tr>
  </table>
</form> 