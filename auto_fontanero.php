<?php
include("conexion.php");
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,realizo as label,realizo  as value from reporte_usuario where realizo like '%$term%'";

$result=mysql_query($sentencia);
while( $fila=mysql_fetch_array($result) )
{
	$arr[]=$fila;
	
}

echo json_encode($arr);
?>