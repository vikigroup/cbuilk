<?php
	include "class.phpmailer.php"; 
	include "class.smtp.php"; 
	
	$guimail=lap_table('version','id=5',' ',' ',' ');
	$row_guimail=mysql_fetch_assoc($guimail);
	
	$mail=lap_table('gh_gianhang',"id='".$idgh."'",' ',' ',' ');
	$row_mail=mysql_fetch_assoc($mail);
	
	reset($_SESSION['daySoluong']);
	reset($_SESSION['dayMaSP']);
	reset($_SESSION['dayDongia']);	
	reset($_SESSION['dayidsp']);		
	reset($_SESSION['dayurlsp']);	
	reset($_SESSION['dayloaisp']);
	
	$chuoi="";
	while( key($_SESSION['daySoluong'])!= null)
	{
		$idSP=key($_SESSION['daySoluong']);
		$id=$_SESSION['dayidsp'][$idSP];
		$masp=$_SESSION['dayMaSP'][$idSP];
		$soluong=$_SESSION['daySoluong'][$idSP];
		$_SESSION['tongsoluong']=$tongsoluong;
		$dongia=$_SESSION['dayDongia'][$idSP];
		$tien=$dongia*$soluong;
		$tongtien+=$tien; 
		$dayid.=$id.",";
		$chuoi.="idSP:'{$id}' - Tên: '{$masp}' - Giá: '{$dongia}' ";
		next($_SESSION['daySoluong']);
		next($_SESSION['dayDongia']);
		next($_SESSION['dayMaSP']);	
	}
	
	$noidung_AltBody='
	Chào bạn! <br>
	Email này là do khách hàng đã đặt hàng thành thành công trên gian hàng của bạn  hệ thống <a href="www.numbala.vn"> www.numbala.vn</a> - tại địa chỉ gian hàng  <a href="http://numbala.vn/gianhang/'.$row_mail['tenmien'].'">http://numbala.vn/gianhang/'.$row_mail['tenmien']." </a> <br />
	
	Đơn đặt hàng: <br>
	<hr>
	Khách hàng: '{$name}' <br>
	Thời điểm đặt hàng: '{$ngay}' <br>
	Địa chỉ: '{$dc}' <br>
	Điện thoại: '{$dt}' <br>
	Tổng số : ".$_SESSION['price']." VND <br>
	'{$chuoi}'
	"
	.'<br><br> <hr>
			Numbala mong bạn thực hiện giao dịch thành công, chúc công việc kinh doanh của bạn ngày càng thuận lợi." vào trong Email. <br>';
	
	
	
	

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
	
		background-color:#E04F0C;
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

	$noidung_Body_full=$noidung_AltBody.
	
	
	$tieude_Subject="Email do khách hàng liên hệ từ gian hàng Numbala";
	
	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->Host = "smtp.gmail.com"; // specify main and backup server
	$mail->Port = 465; // set the port to use
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->SMTPSecure = 'ssl';
	$mail->Username = $row_guimail['cauhinh_mail_ten']; // your SMTP username or your gmail username
	$mail->Password = $row_guimail['cauhinh_mail_mk']; // your SMTP password or your gmail password
	$from = $yahoo; // Reply to this email
	$to=$row_mail['email']; // Recipients email ID
	$name=$name; // Recipient's name
	$mail->From = $from;
	$mail->FromName = $name; // Name to indicate where the email came from when the recepient received
	$mail->AddAddress($to,$name);
	$mail->AddReplyTo($from,$row_mail['tengh']);
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
?>

