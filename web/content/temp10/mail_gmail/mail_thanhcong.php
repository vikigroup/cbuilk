<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thực hiện thành công</title>
<style type="text/css">
<!--
#login_thanhcong {
	border: 1px solid #CCC;
	width: 600px;
	margin-right: auto;
	margin-left: auto;
	height: 160px;
}
#login_thanhcong a {
	text-decoration: none;
	color: #00F;
}
#login_thanhcong a:hover {
	text-decoration: none;
	color: #C00;
}
.chu_thanhcong {
	font-size: 18px;
	font-weight: bold;
	background-color: #71E926;
	color: #000;
	padding-top: 5px;
	padding-bottom: 5px;
}
#sogiay {
	color: #00F;
	font-size: 36px;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<script>
s=2; 
setTimeout("document.location='<?php echo $host_link_full_gh ;?>/gianhang/<?php echo$_GET['tengianhang']?>'",s*1000); 
setInterval("document.getElementById('sogiay').innerHTML=s--;",1000);
</script> 
 
<center>
<div id="login_thanhcong">
<div class="chu_thanhcong">Bạn đã gửi mail thành công..!Cám ơn bạn đã đóng góp ý kiến.</div>
<p><a title="Bấm vào quay lại trang chủ ngay" href="<?php echo $host_link_full_gh ;?>/gianhang/<?php echo$_GET['tengianhang']?>">Link quay lại trang chủ ngay</a>.</p>
Sẽ quay lại trang chủ sau.<br />
<span id=sogiay></span>
</div>
</center>

</body>
</html>
