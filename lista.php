<?php include("conexion.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
<link rel="stylesheet" type="text/css" href="ui.selectmenu.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/ui.selectmenu.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/allowChars.js"></script>
<script type="text/javascript">
$(document).ready(
	
	function()
	{
		$("#seleccionarusuario").selectmenu({width: 220,style:'dropdown'});
	     $("#seleccionardireccion").selectmenu({width: 220,style:'dropdown'});
	var eliminar;
	$( "#confirmacion" ).dialog({
			resizable: true,
			autoOpen: false,
			height:180,
			modal: true,
			buttons: {
				"aceptar": function() {
			$("#resultado").html("");	
			$.ajax({
   			type: "GET",
   			url: "eliminarsecun.php?id="+eliminar,
   			success: function(msg){
				$(this).dialog("close");
				$("#resultado").html("");
     			$("#dialogo").html(msg);
			$("#dialogo").dialog("open");
			
   			}
 			}).error(function(){
				$("#dialogo").html("No se pudo eliminar el alumno");
				$("#dialogo").dialog("open");	
				});
			
					$( this ).dialog( "close" );
				},
				"cancelar": function() {
					$(this).dialog("close");
				}
			}
		});

	$("#eliminar").live('click',
	function()
	{
		eliminar=$(this).attr("name");
		$("#confirmacion").dialog("open");	
	});


		$("#diplomado").selectmenu({
				width: 500,
				style:'dropdown'});
		$("#dialogo").dialog(
	{
		autoOpen: false,
		show: "blind",
		hide: "explode",
		modal: true
	}
	);
		$("#boton").button();
		$("#resultado").load("alumnos.php?");
		$("#boton").click(
		function()
		{
			if($("#grado").val()!="seleccionar")
			{
				$("#resultado").slideToggle("slow",function(){$("#resultado").load("alumnos.php?diplomado="+$("#diplomado").val(),function(){$("#resultado").slideToggle("slow");});});
				
				
				
				
			}
			else
			{
				$("#dialogo").html("llene todos los campos");
				$("#dialogo").dialog("open");
			}
		}
		);
		
	}
	);
</script>
<title>Listado de reportes</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	color: #0000FF;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>

<body  bgcolor="#3C7EAE">
<table width="416" border="0">
  <tr>
    <td width="65"><h2><strong class="ui-state-active">Busqueda</strong></h2></td>
    <td width="125"><select name="diplomado" id="diplomado" >
      <option value="0"><< SERVICIO >></option>
       <?php
            $consultaDiplomados=mysql_query("SELECT clave,nombrediplomado FROM diplomado;");
			while($fila=mysql_fetch_array($consultaDiplomados)){
				$clave=$fila['clave'];
				$nombrediplomado=$fila['nombrediplomado'];
				if($_REQUEST["diplomado"]==$clave){
			?>
            <option selected="selected" value="<?php echo $clave ?>"><< SERVICIO >></option>
            <?php
			}else{
			?>
            <option  value="<?php echo $clave ?>"><?php echo $nombrediplomado ?></option>
            <?php
			}
			}
			?>
      </select>
    </td>
    <td width="68"><form id="form1" name="form1" method="post" action="">
      <select name="seleccionarusuario" id="seleccionarusuario">
        <option selected="selected" value="2"><< USUARIO >></option>
      </select>
    </form></td>
    <td width="68"><form id="form2" name="form2" method="post" action="">
      <select name="seleccionardireccion" id="seleccionardireccion">
       <option selected="selected" value="<?php echo $clave ?>"><< DIRECCION >></option>
      </select>
    </form></td>
    <td width="68"><input name="button" type="button" id="boton" value="Filtrar" /></td>
  </tr>
</table>
<table width="841" border="0" >
  <tr class="ui-state-default">
    <td width="79" height="65"><div align="center" class="Estilo2">
      <h2 class="Estilo2">Folio</h2>
    </div></td>
    <td width="102"><strong><center><h2>Servicio</h2></center></strong></td>
    <td width="210"><strong><center><h2>Usuario</h2></center></strong></td>
    <td width="134" class="Estilo2"><center><h2><strong>Direccion</h2></center></strong></td>
    <td width="95" class="Estilo2"><center><h2><strong>Cuenta</h2></center></strong></td>
    <td width="195" class="Estilo2"><center><h2><strong>Prioridad</h2></center></strong></td>
  </tr>
 
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
$consulta="SELECT grado, apellido_paterno, apellido_materno, nombre, porcentaje,id_alumno  from alumno, beca where alumno.id_beca is not null and alumno.id_beca=beca.id_beca";
$resultado=mysql_query($consulta);
  if($resultado)
  {
  	$i=0;	
		  while($fila=mysql_fetch_array($resultado))
		{
		  $nombre=utf8_encode($fila[1]." ".$fila[2]." ".$fila[3]);
		  if($i%2==0)
		     {
			echo "<tr class='renglon'>";
		     }
		else
		      {
			echo "<tr>";
		      } 
	    echo "<td align='center'>$fila[0]</td>";
		echo "<td align='half'> $nombre </td>";
		echo"<td align='last'>$fila[4]</td>";
		echo "<td><a id='eliminar' name='$fila[5]' href='#'>Eliminar</a></td>";
  		echo "</tr>";
		  	$i++;
	   }
  }
else
  {
	echo"<td></td>";
	echo"<td></td>";
  } 
?>
</table>
<div id="resultado">
</div>
<div id="dialogo" title="mensaje">
</div>
<div id="confirmacion" title="Desea Eliminar">
</div>
</body>
</html>
