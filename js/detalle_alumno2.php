<?php
$id=$_GET["alumno"];
$consulta="select * from alumno where id_alumno= $id ";
$conexion=mysql_connect("127.0.0.1","root","");
mysql_select_db("instituto_prueba",$conexion);
$resultado=mysql_query($consulta);
while($fila=mysql_fetch_array($resultado))
{
	echo "<table>";
	echo "<tr>";
	echo "<td> nombre: </td><td> $fila[1]  $fila[2]  $fila[3] </td>";
	echo "</tr><tr>";
	echo "<td> grado: </td><td>  $fila[6] </td>";
	echo "</tr><tr>";
	echo "<td> periodo: </td><td> $fila[7] </td>";
	echo "</tr>";
	echo "</table>";
	
}
?>
	<table>
	<tr>
	<td colspan=2>Realizar pago</td>
	</tr>
	<tr>
	<td>fecha: </td><td><input type="text" id="fecha"></td>
	</tr>
	<tr>
	<td>concepto:</td><td><select></select></td>
	</tr>
	<tr>
	<td>Monto: </td><td><input type="text" readonly</td>
	</tr>
	<tr>
	<td>pago: </td><td><input type="text"></td>
	</tr>
	<tr>
	<td colspan=2 align="center"><input type="button" value="agregar"></td>
	</tr>
	</table>
<table>
<tr>	
<td>Estado de pagos</td>
</tr>
<tr>
<td>concepto</td>

<?php
if(date("m")<8)
{
	$periodo=date("Y");
	$periodo--;
	$periodo.="-";
	$periodo.="08";
	
}
else
{
	$periodo=date("Y");
	$periodo.="-";
	$periodo.="08";	

}
	$consulta="select apellido_paterno,apellido_materno,nombre,pagado,adeudo,tipo_pago,tipo_pago.monto,concepto from pago,alumno_pago,tipo_pago,alumno,abono where pago.id_pago=alumno_pago.id_pago and alumno_pago.id_alumno=alumno.id_alumno and pago.tipo_pago=tipo_pago.id_tipo_pago and alumno.id_alumno= $id and pago.id_pago=abono.id_pago and abono.fecha >= $periodo and abono.fecha<=now() ;";
	$resultado=mysql_query($consulta);
	$num;
	$num=mysql_num_rows($resultado);
	if($num!=0)
	{
		while($fila=mysql_fetch_array($resultado))
		{
			echo "<td> $fila[7] </td>";	
		}
	}
?>
<td>adeuda</td>
</tr>
<tr>
<td>pago</td>
<?php
$deuda=0;
$resultado=mysql_query($consulta);
	if($num!=0)
	{
		while($fila=mysql_fetch_array($resultado))
		{
		
			if($fila[3]<$fila[6])
			{
				echo "<td bgcolor=red> $fila[3] </td>";
			}
			else
			{
				echo "<td> $fila[3] </td>";
			}
			$deuda+=$fila[4];	
		}
	}
	echo " <td> $deuda </td>";

?>
</tr>
</table>
	
	