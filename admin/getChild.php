<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");

	$id=$_GET['id']; 
	settype($id,"int");
	$table=$_GET['table']; 
	
	if ($id<=0) die ("-1");
	if ($table=="") die ("-1");

?>
<option value="-1"> Chọn danh mục con </option> 
<?php
	$sql="SELECT * FROM $table WHERE parent='{$id}' ORDER BY name COLLATE utf8_unicode_ci";
	$con=mysql_query($sql) or die(mysql_error());
	while ($row_con=mysql_fetch_assoc($con)){
?>
<option value="<?php echo $row_con['id'];?>"> <?php echo $row_con['name'];?></option>
<?php }?>