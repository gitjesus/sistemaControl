<?php
include("connect.php");
$nombre=$_GET["nombre"];
$apellidop=$_GET["apellidop"];
$apellidom=$_GET["apellidom"];
$consulta="select nombre, apellidoP, apellidoM from tabla_registro where nombre='$nombre' and apellidoP='$apellidop' and apellidoM='$apellidom';";
echo "$consulta";
$resultado=mysql_query($consulta);

echo "<table>";
if($resultado)
{
	if(mysql_num_rows($resultado)>0)
	{
		while($fila=mysql_fetch_array($resultado))
		{
			echo "<tr><td>$fila[0]</td><td>$fila[1]</td><td>$fila[2]</td><td></td><td></td></tr>";
		}
	}
	else
	{
		echo "No se encontro al contacto solicitado";
	}
}
else
{
	echo "No se encontro al contacto solicitado";
}
echo "</table>";
?>
