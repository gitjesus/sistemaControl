<?php 
	session_start();
	include 'Classes/base.php';
	$base=new base();
	$params=(object)$_POST;
	$update="update
	 reporte_usuario set status=$params->status, fecha_ejecucion='$params->fechaEjecucion', realizo='$params->realizo', observacion='$params->observacion', jcuadrilla='$params->jcuadrilla'
	 where folio=$params->folio";
	
	if($base->ejecutar($update))  
		echo "ok";
	else {
		echo "error";
	}	 
	 
?>