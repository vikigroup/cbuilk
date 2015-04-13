<?php
if (phpversion()< "4.1.0") {
	$_GET = $HTTP_GET_VARS;
	$_POST = $HTTP_POST_VARS;
	$_SERVER = $HTTP_SERVER_VARS;
}

function mo ($g, $l) {
	return $g - ($l * floor ($g/$l));
}

function powmod ($base, $exp, $modulus){
	$accum = 1;
	$i = 0;
	$basepow2 = $base;
	while (($exp >> $i)>0) {
		if ((($exp >> $i) & 1) == 1) {
			$accum = mo(($accum * $basepow2) , $modulus);
		}
		$basepow2 = mo(($basepow2 * $basepow2) , $modulus);
		$i++;
	}
	return $accum;
}

function PKI_Decrypt ($c, $d, $n) {
	$decryptarray = split(" ", $c);
	for ($u=0; $u<count ($decryptarray); $u++) {
		if ($decryptarray[$u] == "") {
			array_splice($decryptarray, $u, 1);
		}
	}
	$deencrypt = '';
	for ($u=0; $u< count($decryptarray); $u++) {
		$resultmod = powmod($decryptarray[$u], $d, $n);
		$deencrypt.= substr ($resultmod,1,strlen($resultmod)-2);
	}
	$resultd = '';
	for ($u=0; $u<strlen($deencrypt); $u+=2) {
		$resultd .= chr(substr ($deencrypt, $u, 2) + 30);
	}
	return $resultd;
}
$randE = isset($_GET['RD']) ? $_GET['RD'] : "";
$rand = PKI_Decrypt ($randE, 51519937, 82393793);
$image = imagecreate(60, 25);
$bgColor = imagecolorallocate ($image, 255, 255, 255); 
$textColor = imagecolorallocate ($image, 0, 0, 240); 
imagestring ($image, 5, 5, 5, $rand, $textColor); 
header("Expires: Mon, 26 Jul 2008 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 
header('Content-type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
?>
