<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
	$params=(object)$_POST;
	$params->fuga='null';
$params->reconexion='null';

switch($params->servicio)
{
	case 2:
		$params->fuga=$params->tipofuga;
		break;
	case 5:
		$params->reconexion=$params->tipoconexion;
		break;	
}
	$sentencia="
	update reporte_usuario 
		set nombre='$params->nombre',apellidoPaterno='$params->apellidop',apellidoMaterno	='$params->apellidom',
		servicio='$params->servicio', 
		fecha  =   '$params->fecha',
   colonia     =   '$params->colonia',
   calle       =       '$params->calle'  ,
   no          =      $params->no ,
   entrecalles  =     '$params->entrecalles'  ,
   cuenta       =      $params->cuenta ,
   prioridad    =      $params->prioridad ,
   referencia   =      '$params->referencia' ,
   telefono     =     $params->telefono  ,
   fuga         =  $params->fuga     ,
   reconexion   =     $params->reconexion
   where 
   folio=$params->folio   
		";
	
	if($base->ejecutar($sentencia))
	{
		echo "Datos Actualizados";
	}
	else {
		echo "Error al Actualizar";
	}
		
?>