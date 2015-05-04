<?php
$host_link='http://'.$_SERVER['HTTP_HOST'];
$array = explode(".", str_replace("http://", "", $host_link));
$demi=count($array);
$host_link_full=$host_link;

$shop=$_GET['shop'];

if($array[1]==$subname) {
$row_shop=getRecord("tbl_shop","subject='".$array[0]."'");

}elseif($array[1]!=$subname){
//echo $array[0];
$row_shop=getRecord("tbl_shop","domain='".$array[0].".".$array[1]."'");
}
$css=$row_shop['css'];
$idshop=$row_shop['id'];
$url=get_field("tbl_template","id",$row_shop['idtemplate'],"url");

if($idshop=="") {echo  '<script>window.location="'.$root.'" </script>';} // go sai ten gian hang



	
?>