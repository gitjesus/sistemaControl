<?php
include("conexion.php");
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre) as label,concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre)  as value from reporte_usuario where concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre) like '%$term%'";

$result=mysql_query($sentencia);
while( $fila=mysql_fetch_array($result) )
{
	$arr[]=$fila;
	
}

echo json_encode($arr);
?>
