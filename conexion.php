<?php
	//error_reporting(5);
	session_start();
	if(isset($_SESSION["usuario"]))
	{
	
	}
	else
	{
		echo "<script>window.location='inicio.php';</script>";
	}
	setlocale(LC_MONETARY, 'en_US');
	$conexion=mysql_connect("localhost","root","") or die("No se pudo conectar a la base de datos");
	mysql_select_db("BD_ControlSistema",$conexion);
?>
