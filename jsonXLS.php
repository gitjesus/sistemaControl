<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
	$datos=(object)$_POST;
	$ids="(";
	foreach($datos->datos as $id){
		$ids.="$id,";	
	}
	$ids.="0)";
 		$query="
	select 
	ru.folio,
	concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) as nombre,
	concat(colonia,' ',calle,' ',no) as direccion,
	fecha,
	referencia,
	cuenta,
	(select nom_servicio from tipo_servicio where id_servicio=ru.servicio )  as nom_servicio, 
	concat ((select nom_fuga from tipo_fuga where id_fuga=ru.fuga),(select nom_reconexion from tipo_reconexion where id_reconexion=ru.reconexion)) as detalle,
	observacion,
	realizo,
	jcuadrilla,
	fecha_ejecucion
	from reporte_usuario ru where folio in $ids";
	$_SESSION['datos']['filas']=$base->consultar($query);

	
	$_SESSION['datos']['titulo']=array('folio','nombre','direccion','fecha','referencia','cuenta','servicio','detalle','observacion','realizo','jefe cuadrilla','fecha ejecucion');
	
	echo "ok";
?>