<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,realizo as label,realizo  as value from reporte_usuario where realizo like '%$term%'";

$arr=$base->consultar($sentencia);

echo json_encode($arr);
?>