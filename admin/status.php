<?php
	require("../config.php");
	require("../common_start.php");
	include("../lib/func.lib.php");

	$id = $_GET['id'];
    settype($id, "int");

	$table = $_GET['table'];
	
	if ($id <= 0) die ("-1");
	if ($table == "") die ("-1");
	
	$sql = "SELECT status FROM $table WHERE id='{$id}'";
	$rs = mysql_query($sql) or die(mysql_error());
	$row_rs = mysql_fetch_row($rs);
	$anhien = $row_rs[0];

	if ($anhien == 1) $anhien = 0; 	else $anhien = 1;

    if($table == "tbl_shop_category"){
        $myArr = array(209, 210, 211, 390, 458, 500);
        if(in_array($id, $myArr)){
            if ($id == 210) {
                $idSystem = 2;
            }
            if ($id == 209) {
                $idSystem = 3;
            }
            if ($id == 211) {
                $idSystem = 4;
            }
            if ($id == 390) {
                $idSystem = 5;
            }
            if ($id == 500) {
                $idSystem = 6;
            }
            if ($id == 458) {
                $idSystem = 24;
            }
            $query = "update tbl_system set module_display='" . !$anhien . "' where id='" . $idSystem . "'";
            mysql_query($query, $conn);
        }
    }

    if($table == "viki_tin"){
        $query = "update tbl_system set module_display='" . !$anhien . "' where id='" . ($id+12) . "'";
        mysql_query($query, $conn);
    }

	$sql = "UPDATE $table SET status = '{$anhien}' WHERE id = '{$id}'";
	mysql_query($sql) or die(mysql_error());
	echo "images/anhien_{$anhien}.png";	
?>