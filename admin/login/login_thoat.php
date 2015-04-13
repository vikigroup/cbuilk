<?php 
	session_start();
	unset($_SESSION['kt_login_id']);
	unset($_SESSION['kt_login_username']);
	unset($_SESSION['kt_login_level']);
	header("location: ../../../admin.php");
?>
