<?php 
	include("conexion.php");
	$params=(object)$_POST;
	$update="update
	 reporte_usuario set status=$params->status, fecha_ejecucion='$params->fechaEjecucion', realizo='$params->realizo', observacion='$params->observacion', jcuadrilla='$params->jcuadrilla'
	 where folio=$params->folio";
	mysql_query($update); 
	$row=mysql_affected_rows($conexion);
	if($row>0)  
		echo "ok";
	else {
		echo "error";
	}	 
	 
?>