<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");
	
	//get info of shop
	include("domain.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo $host_link_full ; ?>"  />
<?php include("content/title.php");?>
<?php
	$tm = $url;
	$template = "temp".$tm;
?>
<?php include("content/".$template."/header.php");?>

</head>
<?php
	$kt=0; 
	if($row_shop['background']!="") {?>
 	<script type="text/javascript">
   		$("body").removeClass("class_body");
	</script>
<?php $kt=1;} ?>
<?php
	switch($row_shop['bg_position']){
		case 0 : $position="repeat-x";break;
		case 1 : $position="repeat-y";break;
		case 2 : $position="repeat";break;
		case 3 : $position="fixed";break;
		case 4 : $position="no-repeat";break;
	}
?>
<body class="class_body" <?php if($kt && $baotri==0) {?>style="background:#111 url(<?php echo $host_link_full."/".$row_shop['background'];?>) <?php echo $position;?> top center;" <?php } ?>  >

	<?php include("content/".$template."/content.php");?>
    
</body>
</html>
<?php require("../common_end.php");?>