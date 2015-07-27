<?php
include("conexion.php");
$pass=$_GET["pass"];
$nuevapass=$_GET["nuevapass"];

$usuario=$_SESSION["usuario"];
$consulta="select * from usuarios where usuario='$usuario' and contrasena='$pass'";
$resultado=mysql_query($consulta);
$num=mysql_num_rows($resultado);
if($num>0)
{
	$consulta="UPDATE usuarios set contrasena='$nuevapass' where usuario='$usuario'";
	$resultado=mysql_query($consulta);
	$num=mysql_affected_rows($conexion);
	if($num>0)
	{
		echo "Contrase&ntilde;a cambiada";
	}
	else
	{
		echo "No se pudo cambiar la contrase&ntilde;a";
	}
}
else
{
	echo "Contrase&ntilde;a invalida";
}
?>
