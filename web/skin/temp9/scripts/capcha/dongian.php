<?php    // File: capcha.php
header("Content-Type: image/jpeg");
header("Pragma: No-cache");
header("Cache-Control:No-cache, Must-revalidate"); 

$sokytu=5;  $width = 60; 	$height = 30; 

$img = ImageCreate($width, $height); 
$nen = ImageColorAllocate($img, 0, 51, 0); // tạo các màu cần dùng
$mauchu = ImageColorAllocate($img, 255, 255, 255); 
$vien = ImageColorAllocate($img, 127, 127, 127); 

$str= md5(rand(0,9999)); 
$str = strtoupper(substr($str, 10, $sokytu)); 
session_start(); $_SESSION['captcha_code'] = $str; 

ImageFill($img, 0, 0, $nen); //tô nền 

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

ImageString($img, 5, 8, 8, $str, $mauchu);  //vẽ chuỗi số
ImageJPEG($img); //xuất hình ra browser
ImageDestroy($img); 
?>