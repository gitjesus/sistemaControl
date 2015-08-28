<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
	$params=(object)$_POST;
	$condiciones="";
	if($params->colonia!="")
		$condiciones.=" colonia like '%$params->colonia%'";
	
	
	if($params->calle!="")
	{
		if($condiciones!='')
			$condiciones.=' or ';	
		$condiciones.=" calle like '%$params->calle%'";
	}
		
	
	if($params->referencia!="")
	{
		if($condiciones!='')
			$condiciones.=' or ';
		$condiciones.=" referencia like '%$params->referencia%'";
	}
		
	
	if($params->entrecalles!="")
	{
		if($condiciones!='')
			$condiciones.=' or ';
		$condiciones.=" entrecalles like '%$params->entrecalles%'";	
	}
		
	
	$sentencia="
	select * from reporte_usuario where servicio=2 and (
	
	$condiciones
	
	
	)";
	
	@$arr=$base->consultar($sentencia);
	
	$arr['folios']=count($arr);
	
	echo json_encode($arr);
	
?>