<?php
session_start();

	if(isset($_SESSION["usuario"]))
	{
		echo "<script>window.location='menu.php';</script>";
	}
	else
	{
		echo "<script>window.location='inicio.php';</script>";
	}
?>
