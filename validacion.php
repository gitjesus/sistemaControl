<?php
$conexion=mysql_connect("localhost","root","") or die("No se pudo conectar a la base de datos");
	mysql_select_db("BD_ControlSistema",$conexion);
$user=$_POST["user"];
$pass=$_POST["pass"];
$consulta="select usuario,contrasena from usuarios where usuario='$user' and contrasena='$pass'";
$resultado=mysql_query($consulta);
if($resultado)
{
	$num=mysql_num_rows($resultado);
	if($num>0)
	{
		session_start();
		$_SESSION["usuario"]=$user;	
		echo "identificado";
	}
	else
	{
		echo "no identificado";
	}
}
?>
