<?php
include("connect.php");
$Nombre=$_POST["nombre"];
$apellidop=$_POST["apellidoP"];
$apellidom=$_POST["apellidoM"];
$sexo=$_POST["sexo"];
$fecha=$_POST["fechaNac"];
$telefono=$_POST["telPar"];
$celular=$_POST["telCel"];
$mail=$_POST["eMail"];
$consulta="INSERT INTO tabla_registro (nombre,apellidoP, apellidoM, sexo, fechaNac, telParticular, telCelular, eMail) VALUES ('$Nombre', '$apellidop', '$apellidom', '$sexo', '$fecha', '$telefono', '$celular', '$mail');";
mysql_query($consulta);
if(mysql_affected_rows()>0)
{
	echo "El contacto ha sido Registrado";	
}
else
{
	echo "no se pudo agregar el contacto";
}

//mysql_query("INSERT into);
?>

