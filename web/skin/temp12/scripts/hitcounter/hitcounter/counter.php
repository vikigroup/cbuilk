<?php
require_once("../../../cons/cons.php");

$digit_dir = "./";
$min_width = 9;
$lifetime = 30;
$host="localhost";
$root_hinh='number_black';//number_color

$kq=mysql_query("select * from counter");
$row=mysql_fetch_assoc($kq);
$count=$row["counter"];
if(!Isset($_COOKIE['counter'])){  //chỉ tăng biến count nếu chưa có hoặc cookie quá hạn
  	$count++;
	mysql_query("update counter set counter=counter+1");	
  setcookie("counter","dummy");
}


//Lưu , lấy count từ file
/*
$file = "counter.txt";
$fp = fopen($file, "r") or die("Failed to open counter-file");
$size = filesize($file);
$count = fread($fp, $size);
fclose($fp);
if(!Isset($_COOKIE['counter'])){  //chỉ tăng biến count nếu chưa có hoặc cookie quá hạn
  	$fp = fopen($file, "w");
	$count++;
	fwrite($fp, $count);
	fclose($fp);
  setcookie("counter","dummy",time()+60*60*24*$lifetime);
}
*/


//Hiện counter image
$len = strlen(strval($count));
if($len > $min_width) $width = $len;
else $width = $min_width;

if(!file_exists("$digit_dir/$root_hinh/0.png")) die("Không tìm thấy file hình");

$d0 = ImageCreateFrompng("$digit_dir/$root_hinh/0.png");
$dx = ImageSX($d0);
$dy = ImageSY($d0);

$img = ImageCreateTrueColor($width*$dx, $dy);
ImageDestroy($d0);

$xoff = $width*$dx;
while($xoff > 0) {
  $digit = $count % 10;
  $count = $count / 10;
  $temp = ImageCreateFrompng("$digit_dir/$root_hinh/$digit.png");
  $xoff = $xoff - $dx;
  ImageCopyResized($img, $temp, $xoff, 0, 0, 0, $dx, $dy, $dx, $dy);
  ImageDestroy($temp);
	}

Header("Content-type: image/png");
Imagepng($img);
ImageDestroy($img);
?>
