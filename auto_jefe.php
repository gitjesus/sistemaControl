<?php
include("conexion.php");
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,jcuadrilla as label,jcuadrilla  as value from reporte_usuario where jcuadrilla like '%$term%'";

$result=mysql_query($sentencia);
while( $fila=mysql_fetch_array($result) )
{
	$arr[]=$fila;
	
}

echo json_encode($arr);
?>