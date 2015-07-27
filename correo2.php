<?php

include("conexion.php");

$correo=$_GET["correo"];

$usuario=$_SESSION["usuario"];
	$consulta="select * from usuarios where correo='$correo' and usuario='$usuario'";
	$resultado=mysql_query($consulta);
	$num=mysql_num_rows($resultado);
	if($num>0)
	{
		echo "Este correo ya esta asignado al usuario";
	}
	else
	{
		$consulta="UPDATE usuarios set correo='$correo' where usuario='$usuario'";
		$resultado=mysql_query($consulta);
		$num=mysql_affected_rows($conexion);
		if($num>0)
		{
			echo "Correo cambiado";
		}
		else
		{
			echo "No se pudo cambiar el correo";
		}
	}	
?>

