<?php
include("conexion.php");
?>
<form id="formulario">
<table width="723" border="0" >
  <tr>
    <td width="153"><div align="center" class="Estilo2">
      <h3 class="Estilo2">Semestre</h3>
    </div></td>
    <td width="449"><h3 align="center" class="Estilo2">Alumno</h3></td>
    <td width="107" class="Estilo2">Porcentaje</td>
  </tr>
 
<?php
$consulta="SELECT semestre, apellidopt, apellidomt, nombres, porcentaje, id_alumno  from alumnoprepa, beca where alumnoprepa.id_beca is not null and alumnoprepa.id_beca=beca.id_beca";
$resultado=mysql_query($consulta);

 if($resultado)
  {
  	$i=0;	
			
		  while($fila=mysql_fetch_array($resultado))
		  {
		echo "<tr>";  
	    echo "<td align='center'>$fila[0]</td>";
		echo "<td align='half'>$fila[1] $fila[2] $fila[3] </td>";
		echo"<td align='last'>$fila[4]</td>";
		echo "<td><a id='eliminar' name='$fila[5]' href='#'>Eliminar</a></td>";
  		echo "</tr>";
		  }
?>

  <?php
  function acentos($Cadena){
 $Cadena = str_replace('á','&aacute;',$Cadena);
 $Cadena = str_replace('é','&eacute;',$Cadena);
 $Cadena = str_replace('í','&iacute;',$Cadena);
 $Cadena = str_replace('ó','&oacute;',$Cadena);
 $Cadena = str_replace('ú','&uacute;',$Cadena);
 $Cadena = str_replace('Á','&Aacute;',$Cadena);
 $Cadena = str_replace('É','&Eacute;',$Cadena);
 $Cadena = str_replace('Í','&Iacute;',$Cadena);
 $Cadena = str_replace('Ó','&Oacute;',$Cadena);
 $Cadena = str_replace('Ú','&Uacute;',$Cadena);
 $Cadena = str_replace('ñ','&ntilde;',$Cadena);
 $Cadena = str_replace('Ñ','&Ntilde;',$Cadena);
 $Cadena = str_replace('ä','&auml;',$Cadena);
 $Cadena = str_replace('ë','&euml;',$Cadena);
 $Cadena = str_replace('ï','&iuml;',$Cadena);
 $Cadena = str_replace('ö','&ouml;',$Cadena);
 $Cadena = str_replace('ü','&uuml;',$Cadena);
 $Cadena = str_replace('Ä','&Auml;',$Cadena);
 $Cadena = str_replace('Ë','&Euml;',$Cadena);
 $Cadena = str_replace('Ï','&Iuml;',$Cadena);
 $Cadena = str_replace('Ö','&Ouml;',$Cadena);
 $Cadena = str_replace('Ü','&Uuml;',$Cadena);
 $Cadena = str_replace('²','&sup2;',$Cadena);
 $Cadena = str_replace('ñ','&ntilde;',$Cadena);
 $Cadena = str_replace('Ñ','&Ntilde;',$Cadena);
 return $Cadena;
}

  $resultado=mysql_query($consulta);
  if($resultado)
  {
  	$i=0;
  	while($fila=mysql_fetch_array($resultado))
	{

		$nombre=acentos($fila[3]);
		
		$apellidom=acentos($fila[2]);
		
		$apellidop=acentos($fila[1]);
		
		if($i%2==0)
		{
			echo "<tr class='renglon'>";
		}
		else
		{
			echo "<tr>";
			echo "</tr>";
		$i++;
		}
    	
	}
  }
  else
  {
	echo"<td></td>";
	echo"<td></td>";
  }
 }
  ?>
   
  
</table>
</form>