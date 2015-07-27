<?php
	session_start();
	$_SESSION['datos']=$_POST['datos'];
	echo "ok";
?>