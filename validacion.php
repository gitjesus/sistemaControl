<?php
include 'Classes/base.php';
$base=new base();
$user=$_POST["user"];
$pass=$_POST["pass"];
$consulta="select usuario,contrasena from usuarios where usuario='$user' and contrasena='$pass'";
$arr=$base->consultar($consulta);

	if(count($arr)>0)
	{
		session_start();
		$_SESSION["usuario"]=$user;	
		echo "identificado";
	}
	else
	{
		echo "no identificado";
	}

?>
