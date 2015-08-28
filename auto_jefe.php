<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,jcuadrilla as label,jcuadrilla  as value from reporte_usuario where jcuadrilla like '%$term%'";

$arr=$base->consultar($sentencia);

echo json_encode($arr);
?>