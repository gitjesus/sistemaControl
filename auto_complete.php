<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id,concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre) as label,concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre)  as value from reporte_usuario where concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre) like '%$term%'";

$arr=$base->consultar($sentencia);

echo json_encode($arr);
?>
