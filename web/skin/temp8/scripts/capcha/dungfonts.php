<?php //file capcha_image.php
header('Content-type: image/png');
header("Pragma: No-cache");
header("Cache-Control:No-cache, Must-revalidate"); 

$sokytu=5;  $width = 160;  $height = 55; 
$fontsize=25; $x=10; $y=45;  //toạ độ chữ
$do_nghieng=5;$font = 'Vbutlong.ttf';//'arial.ttf';
$str= md5(rand(0,9999));  //chữ ngẫu nhiên 
$str = strtoupper(substr($str, 10, $sokytu)); 

session_start();  $_SESSION['captcha_code'] = $str; 

$img = imagecreatetruecolor($width, $height); //tạo hình
$nen = imagecolorallocate($img, 0, 153, 255); //tạo màu cần dùng
$maubong = imagecolorallocate($img, 204, 204, 102);
$mauchu= imagecolorallocate($img, 255, 255, 255);
$vien = ImageColorAllocate($img, 127, 127, 127);

imagefilledrectangle($img, 0, 0, $width-1, $height-1, $nen);

//ve duong thang

for ($i=0; $i<=$height; $i+=10)ImageLine($img, 0, $i, $width, $i, $vien); 
for ($i=0; $i<=$width; $i+=10) ImageLine($img, $i, 0, $i, $height, $vien);



//ve cham ngau nhien

$i=0;  $p=imagecolorallocate($img, 240, 43, 245); 
while ($i++<=400){ 
	$a=rand(0,$width); $b= rand(0,$height);
	//imagesetpixel($img, $a,$b,$p); 
	imageellipse($img,$a,$b,3,3,$p); 
}




imagettftext($img, $fontsize,$do_nghieng, $x+2, $y+2, $maubong,$font,$str);
imagettftext($img, $fontsize, $do_nghieng, $x, $y, $mauchu, $font, $str);
imagepng($img);
imagedestroy($img);
?>

