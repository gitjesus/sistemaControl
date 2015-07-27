<?php
include("conexion.php");
$params=(object)$_POST;
$sentencia="update reporte_usuario set eliminado=0 where folio=$params->folio";
mysql_query($sentencia);
$num=mysql_affected_rows();
if($num>0)
	echo "ok";
else
	echo "error";
?>