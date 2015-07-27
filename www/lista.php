<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Baskerville Old Face, Footlight MT Light, Maiandra GD;
	font-size: large;
	color: #990099;
}
body {
	background-image: url(imagenes/antarctique_5.jpg);
	background-repeat: repeat;
}
#Layer1 {
	position:absolute;
	left:50px;
	top:10px;
	width:668px;
	height:46px;
	z-index:1;
}
body,td,th {
	font-family: Baskerville Old Face, Footlight MT Light, Maiandra GD;
	font-size: large;
	color: #ECE9D8;}
.Estilo3 {
	color: #3366CC;
	font-weight: bold;
}
.Estilo4 {font-size: xx-large; color: #330099; font-weight: bold; font-family: "Baskerville Old Face", "Footlight MT Light", "Maiandra GD"; }
h1,h2,h3,h4,h5,h6 {
	font-family: Baskerville Old Face, Footlight MT Light, Maiandra GD;
}
.Estilo5 {color: #3366FF}
.Estilo6 {color: #3366FF; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(
function()
{	

	$("#buscar").click(
	function()
	{
		var d=$("#formulario").serialize();
		alert(d);
		$("input[type='text']").val("");		
		$("#resultado").slideToggle("slow",function(){$("#resultado").load("buscar.php?"+d,function(){$("#resultado").slideToggle("slow");});});
	});
});

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form name="formulario" id="formulario" action="">
<table width="824" border="1">
  <tr>
    <td width="76">Nombre:</td>
    <td width="78"><input type="text" name="nombre" id="nombre"></td>
    <td width="133">Apellido Paterno </td>
    <td width="129"><input type="text" name="apellidop" id="apellidop"></td>
    <td width="139">Apellido Materno </td>
    <td width="73"><input type="text" name="apellidom" id="apellidom"></td>
    <td width="8"><input type="button" value="Buscar" id="buscar"></td>
  </tr>
</table>
</form>
<div id="resultado">
</div>
</body>
</html>
