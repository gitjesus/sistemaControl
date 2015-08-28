<?php
	session_start();
	include 'Classes/base.php';
	$base=new base();
//$objeto=(object)$_POST;
// asi objeto ya tiene $objeto->nombre y todos los nombres que vienen en post :P
$nombre=strtoupper($_POST["nombre"]);
$nombre=utf8_decode($nombre);
$apellidop=strtoupper($_POST["apellidop"]);
$apellidop=utf8_decode($apellidop);
$apellidom=strtoupper($_POST["apellidom"]);
$apellidom=utf8_decode($apellidom);
$servicio=$_POST["servicio"];
$fecha=$_POST["fecha"];
$colonia=strtoupper($_POST["colonia"]);
$calle=strtoupper($_POST["calle"]);
$no=$_POST["no"];
$entrecalles=strtoupper($_POST["entrecalles"]);
$cuenta=$_POST["cuenta"];
$prioridad=$_POST["prioridad"];
$referencia=$_POST["referencia"];
$telefono=strtoupper($_POST["telefono"]);
$fuga='null';
$reconexion='null';
$folio=$_POST["folio"];

switch($servicio)
{
	case 2:
		$fuga=$_POST['tipofuga'];
		break;
	case 5:
		$reconexion=$_POST['tipoconexion'];
		break;	
}


$sentencia="
insert into reporte_usuario(folio,nombre,apellidoPaterno,apellidoMaterno,servicio,fecha,colonia,calle,no,entrecalles,cuenta,prioridad,referencia,telefono,fuga,reconexion,hora) 
values ($folio,'$nombre','$apellidop','$apellidom','$servicio','$fecha','$colonia','$calle',$no,'$entrecalles','$cuenta',$prioridad,'$referencia',$telefono,$fuga,$reconexion,now())";


if($base->ejecutar($sentencia))
{
	echo "Reporte Registrado";
}
else
{
	echo "Reporte no Registrado";
}
mysql_close(); 
?>
