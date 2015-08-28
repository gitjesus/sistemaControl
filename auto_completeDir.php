<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
$term=$_GET["term"];
$arr=array();
$sentencia=" select folio as id, concat(colonia,' ',calle,' ',no) as value, concat(colonia,' ',calle,' ',no) as label  from reporte_usuario where concat(calle,' ',colonia,' ',no) like '%$term%'";

$arr=$base->consultar($sentencia);

echo json_encode($arr);
?>
