<?php
include("conexion.php");
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id, concat(colonia,' ',calle,' ',no) as value, concat(colonia,' ',calle,' ',no) as label  from reporte_usuario where concat(calle,' ',colonia,' ',no) like '%$term%'";

$result=mysql_query($sentencia);
while( $fila=mysql_fetch_array($result) )
{
	$arr[]=$fila;
	
}

echo json_encode($arr);
?>
