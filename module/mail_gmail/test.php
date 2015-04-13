<?php 
	include "class.phpmailer.php"; 
	include "class.smtp.php"; 
	
	$diachimai_Username='khuattieutrieuvan@gmail.com';
	$matkhau_Password='0903885839';
	$nguoigui_from='khuattieutrieuvan@gmail.com';
	$tennguoigui_name='Trieu Van';
	
	$nguoinhan_to='khuattieutrieuvan@gmail.com';
	$tieude_Subject='test mail';
	$noidung_Body='Chao cu';
	$noidung_AltBody='ket thuc';
	

	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->Host = "smtp.gmail.com"; // specify main and backup server
	$mail->Port = 465; // set the port to use
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->SMTPSecure = 'ssl';
	$mail->Username = $diachimai_Username; // your SMTP username or your gmail username
	$mail->Password = $matkhau_Password; // your SMTP password or your gmail password
	$from = $nguoigui_from; // Reply to this email
	$to=$nguoinhan_to; // Recipients email ID
	$name=$tennguoigui_name; // Recipient's name
	$mail->From = $from;
	$mail->FromName = $tennguoigui_name; // Name to indicate where the email came from when the recepient received
	$mail->AddAddress($to,$name);
	$mail->AddReplyTo($from,$tennguoigui_name);
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = $tieude_Subject;
	$mail->Body = $noidung_Body;
	//"<b>Mail nay duoc goi bang phpmailer class. - <a href='http://bloghoctap.com'>bloghoctap.com</a></b>"; 
	$mail->AltBody = $noidung_AltBody; //Text Body
	//$mail->SMTPDebug = 2;
	if(!$mail->Send())
		{
			echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
		}
		else
			{
				echo "<h1>Send mail thanh cong</h1>";
			}

?>
