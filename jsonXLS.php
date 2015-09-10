<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
	$datos=(object)$_POST['datos'];
	foreach($datos->reportes as $id){
 		$query="
	select ru.*,
	(select nom_servicio from tipo_servicio where id_servicio=ru.servicio )  as nom_servicio, 
	(select nom_fuga from tipo_fuga where id_fuga=ru.fuga) as fuga,
	(select nom_reconexion from tipo_reconexion where id_reconexion=ru.reconexion) as reconexion
	
	from reporte_usuario ru where folio=$params->folio";
$arr=$base->consultar($query);
$servicio=$arr[0];
	}
	$_SESSION['datos']=$_POST['datos'];
	echo "ok";
?>