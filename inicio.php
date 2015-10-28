<?php
include 'Classes/base.php';
$base=new base();
$arr=$base->consultar("select usuario from usuarios");
?>
<html>
<head>
<title>logueo-usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	    <style type="text/css">
<!--
.Estilo1 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo5 {font-size: 30px}
body { background-image:url(http://192.168.0.2:8080/sistemaControl/fondo.png)
}
.Estilo24 {color: #0000FF}
.Estilo25 {
	font-size: 36px;
	font-style: italic;
	font-weight: bold;
	color: #000000;
}
.Estilo29 {color: #0000FF; font-weight: bold; font-size: 36px; }
.Estilo35 {color: #000000}
.Estilo36 {font-weight: bold; font-size: 18px; color: #000000; }
.Estilo37 {font-size: 18px; color: #000000; }
a {
	font-size: 18px;
}
a:active {
	color: #000099;
}
a:link {
	color: #FCFCFF;
}
a:visited {
	color: #FCFCFF;
}
a:hover {
	color: #FFFFFF;
}
.Estilo38 {font-size: 24px;
	font-weight: bold;
	color: #000000;
}
tr.spaceUnder > td
{
  padding-bottom: 2em;
}
.Estilo2 {font-family: Georgia, "Times New Roman", Times, serif}
-->
        </style>
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

<link rel="stylesheet" type="text/css" href="ui.selectmenu.css" />
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
		$.ajax({
   			type: "POST",
   			url: "dump/dump_db.php",
			username: "st-svflor",
			password: "st-svflor"
			});
		$.fx.speeds._default = 500;
		$("#dialogo").dialog(
		{
			autoOpen: false,
			show: "blind",
			hide: "explode",
			modal: true
		}
		);
		$("#seleccion").selectmenu({width: 250,style:'dropdown'});
		$("#boton").button();
		$("#pass").focus(function(){
		$("#pass").removeClass("ui-state-error ui-corner-all");
							});
		$("#boton").click(
		function()
		{
			if($("#pass").val()!="")
			{
				var campos=$("#formulario").serialize();
			$("input[type='text']").val("");		
			$.ajax({
   			type: "POST",
   			url: "validacion.php",
   			data: campos,
   			success: function(msg){
     			if(msg=="identificado")
				{
					$("#dialogo").html("Usuario Aceptado");
				$("#dialogo").dialog("open");
					window.location="menu.php";
				}
				else
				{
					$("#dialogo").html("Usuario o contrase�a incorrecta");
				$("#dialogo").dialog("open");
				}
   			}
 			}).error(function(){
				$("#dialogo").html("servicio no disponible");
				$("#dialogo").dialog("open");	
				});
			}
			else
			{
				$("#pass").addClass("ui-state-error ui-corner-all");
				$("#dialogo").html("Escriba la contrase�a");
				$("#dialogo").dialog("open");
			}
		});
		$("#click").click(
		function()
		{
			var campos="user="+$("#seleccion").val();
			$("input[type='text']").val("");		
			$.ajax({
   			type: "POST",
   			url: "mail.php",
   			data: campos,
   			success: function(msg){
     			$("#dialogo").html(msg);
				$("#dialogo").dialog("open");
   			}
 			}).error(function(){
				$("#dialogo").html("servicio no disponible");
				$("#dialogo").dialog("open");	
				});
		});
	});
</script>
</head>
<body>
<table width="872" height="450" border="0" align="center">
<form name="form1" id="formulario" method="post" action="">
      <tr>
        <td height="170" colspan="3"><p align="left"class="Estilo38"><span class="Estilo2"></p><p align="right"><img src="gobiernover.png" alt="logo" width="250" height="100" align="left"><img src="CAEV.png" alt="CAEV" width="200" height="100"></p></td>
      </tr>
      <tr>
        <td colspan="2"><p align="center"><span><img src="bienvenida.png" alt="bienbenida" width="550" height="200" align="center"></span></p> </td>
      </tr>
      <tr>
      	<tr>
      		<td>&nbsp;</td>
      	</tr>
      	<td colspan="2"  class="text-center">
      		<table style="margin: auto;">
			<tr class="spaceUnder">
        <td ><span class="Estilo36">Usuario</span><span class="Estilo37"> : </span></td>
        <td >
          <label>
          <select name="user" size="1"  id="seleccion">
        	<?php
			foreach($arr as $value)
			{
				echo"<option value='$value->usuario'>$value->usuario</option>";
			}
			?>
          </select>
          </label>
               </td>
  </tr>
      <tr>
        <td ><span class="Estilo36">Contrase&ntilde;a</span><span class="Estilo37"> : </span></td>
<td><span class="Estilo1">
              <input name="pass" type="password" id="pass" size="20" />
        </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
          
      <tr>
        <td colspan="2"><div align="center">
          <input  type='button' id="boton" class="btn-success"  value='Entrar'/>
        </div></td>
       </tr>
       <tr>
          
           
          
       
      </tr>
      </table>
      </span>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><div align="right"></div></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      </form>
</table>
<div id="dialogo" title="mensaje">

</div>
</body>
</html>									
