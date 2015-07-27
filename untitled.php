<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head profile="http://gmpg.org/xfn/11"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title> 
<?php
include("conexion.php"); 
?> 
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css"/>
<link rel="stylesheet" type="text/css" href="css/demos.css"/>
<link rel="stylesheet" type="text/css" href="ui.selectmenu.css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.js">
</script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js">
</script>
<script type="text/javascript" src="js/ui.selectmenu.js">
</script>
<script type="text/javascript">
$(document).ready(
	function()
	{
	$("#tabla").load("listaBecados.php");
	$( "#secciones" ).accordion({
			collapsible: true
		});
		var alumno;
		$( "#alumno" ).autocomplete({
			source: "search.php",
			minLength: 2,
			select: function( event, ui ) {
				alumno=ui.item.id;
			}
		});
		$("#Porcentaje").selectmenu({width: 200,style: "dropdown"});
		$("#Aplicar").button();
		$.fx.speeds._default = 500;
	    $("#dialogo").dialog(
	{
		autoOpen: false,
		show: "blind",
		hide: "explode",
		modal: true
	}
	);
		$("#Aplicar").click(
		function()
		{
		if($("#nombre").val()==""&&$("#apellidop").val()==""&&$("#apellidom").val()=="" && $("#Porcentaje").val()=="seleccionar")
				{
					
			$("#dialogo").html("Introduzca al menos un criterio");
			$("#dialogo").dialog("open");
		
				}
				else
				{
					if($("#Porcentaje").val()=="")
					{
						alert("Seleccion un porcentaje ");
					}
					else
					{
						var d="porcentaje="+$("#Porcentaje").val()+"&alumno="+alumno;
						$.ajax({type: "GET",url: "becaAlumno.php",data: d,
   			success: function(msg){
     			alert(msg);
				$("#tabla").load("listaBecados.php");
   			}
 			}).error(function(){
				alert("No se aplico beca");	
				});
					
					}						
				}				
			}
		);
				
	}
);

</script>


<title>Becas</title>
<style type="text/css">
<!--
.Estilo2 {
	font-size: 18px;
	color: #0033FF;
	font-weight: bold;
}
.Estilo34 {font-size: 24px; color: #0033FF; font-weight: bold; }
.Estilo35 {font-size: 18px; color: #000033; font-weight: bold; }
.Estilo36 {color: #0033CC}
-->
</style></head>
<body>
<style type="text/css">
<!--
body {
	background-image: url(Azul.JPG);
}
.Estilo1 {
	font-size: 24px;
	font-weight: bold;
	font-style: italic;
	color: #000066;
}
.Estilo2 {
	color: #000066;
	font-style: italic;
	font-weight: bold;
	font-size: 18px;
}
-->
</style>
<div id="secciones">
<h3><a href="#" class="Estilo34">Becas</a></h3>
  <div>
  <tr>
  <td>&nbsp;</td>
  
  </form>
  <table style="position:absolute; left:18px; top:100px; width:475px; height:34px; z-index:1; border:2px #C0C0C0 solid;" cellpadding="0" cellspacing="1" id="Table1">
    <tr>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:94px;height:26px;"><div align="center">Grado</div></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:100px;height:26px;"><form action="" method="post" id="form1">
          <label>
          <select name="grado" id="grado">
          </select>
          </label>
      </form></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:118px;height:26px;"><div align="center">Concepto</div></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;height:26px;"><form action="" method="post" id="form2">
          <label>
          <select name="concepto" id="concepto">
          </select>
          </label>
      </form></td>
    </tr>
  </table>
  <tr>
    <p>&nbsp;</p>
</div> 
  <h3><a href="#" class="Estilo34">Lista de Alumnos Becados</a></h3>
<div align="letf" id="tabla">

</div>
<div>
  <tr>
    <td>&nbsp;</td>
    </form>
  </tr>
  <table style="position:absolute; left:19px; top:204px; width:475px; height:34px; z-index:1; border:2px #C0C0C0 solid;" cellpadding="0" cellspacing="1" id="Table3">
    <tr>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:94px;height:26px;"><div align="center">Semestre</div></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:100px;height:26px;"><form action="" method="post" id="form5">
          <label>
          <select name="grado3" id="grado3">
          </select>
          </label>
      </form></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;width:118px;height:26px;"><div align="center">Concepto</div></td>
      <td align="left" valign="top" style="border:1px #C0C0C0 solid;height:26px;"><form action="" method="post" id="form6">
          <label>
          <select name="concepto3" id="concepto3">
          </select>
          </label>
      </form></td>
    </tr>
  </table>
  <tr>
    <p>&nbsp;</p>
  </tr>
</div>
</html>