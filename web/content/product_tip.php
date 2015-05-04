<?php
	require("../../config.php");
	require("../../common_start.php");
	include("../../lib/func.lib.php");
	require("../domain.php");
;; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
	.title_tls{color:#333; padding:7px 0;}
	.price_tls{color:#C00; padding-top:7px;}
	.tomtat_tls{padding:4px 0 7px 0;}
	.main_img_tls{text-align:center;}
	.main_img_tls img{max-width:250px; max-height:250px;}
	.clear{clear:both; float:none;}
</style>
</head>

<body>

<?php 
	$idsp=$_GET['idsp'];
	$sql="SELECT *
			FROM tbl_item
			WHERE id='{$idsp}'";
	$tin_ajax=mysql_query($sql) or die(mysql_error());
	$row_tin_ajax=mysql_fetch_assoc($tin_ajax);
?>


<div class="frame_tooltip">
	
    <h3 class="title_tls"><?php echo $row_tin_ajax['name'] ?></h3>
    
    <div class="main_img_tls">
    	<?php if($row_tin_ajax['image']==true){?>
        <img src="<?php echo $row_tin_ajax['image'] ?>" alt=""/> 
        <?php }?> 
    </div><!-- End .main_img_tls -->
    
    <div class="main_tls">       
    
    	<?php if($row_tin_ajax['price']!=""){?>
    	<div class="price_tls">
        	Giá: <?php  if(preg_match ("/^([0-9]+)$/", $rowtin['price'])) echo number_format($rowtin['price'],0)."  VNĐ";else echo $row_tin_ajax['price']; ?>
        </div> 
        <?php } ?>
        
        <div class="tomtat_tls">
        	<?php echo $row_tin_ajax['detail_short'] ?>
        </div>
        
    </div><!-- End .main_tls -->
    
</div><!-- End .frame_tooltip -->

</body>
</html>