<?php
require("../../config.php");
require("../../common_start.php");
include("../../lib/func.lib.php");

$session_id=2;
$path = "../images/gianhang/item_t/";

$valid_formats = array("jpg", "png", "gif","JPG");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
  $name = $_FILES['photoimg']['name'];
  $size = $_FILES['photoimg']['size'];
  if(strlen($name))
         {
	list($txt, $ext) = explode(".", $name);
	if(in_array($ext,$valid_formats))
		{
		if($size<(1024*1024))
			{
			$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
			
			$tmp = $_FILES['photoimg']['tmp_name'];
			if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
					
				$fields_arr = array(
				"cate"           => "'1000'",
				"idshop"         => "'".$_SESSION['idshop']."'",
				"image"          => "'"."images/gianhang/item_t/".$actual_image_name."'",
				);
				
				insert("tbl_ad",$fields_arr);
									
				echo "<img src='../images/gianhang/item_t/".$actual_image_name."'  class='preview'>";
							
				$_SESSION["image"]=$actual_image_name;						
					
				}
			else
			echo "failed";
		}
	else
	echo "Image file size max 250k";					
          }
else
echo "Invalid file format..";	 
}
				
else
echo "Please select image..!";
				
exit;
}
?>