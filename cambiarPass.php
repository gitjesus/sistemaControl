<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">


</style>
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
<link rel="stylesheet" type="text/css" href="ui.selectmenu.css">
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/ui.selectmenu.js"></script>
<style type="text/css">
.ui-accordion .ui-accordion-header
{
   font-family: Arial;
   font-size: 13px;
   height: 36px;
   font-weight: normal;
   font-style: normal;
}
.ui-accordion .ui-accordion-header a
{
   padding: 10px 10px 10px 30px;
}
.ui-accordion .ui-accordion-header .ui-icon
{
   left: 10px;
}
.ui-accordion .ui-accordion-content
{
   padding: 0 0 0 0;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryAccordion1Opts =
   {
      event: 'click',
      animated: 'slide',
      header: 'h3',
      fillSpace: 'true'
   };
   $("#jQueryAccordion1_id").accordion(jQueryAccordion1Opts);
   $("#boton").click(
   function()
   {
   		$("#mensajes").html("");
		if($("#nuevapass").val()!=$("#cnuevapass").val())
		{
			$("#mensajes").html("Las contraseñas no son iguales.");
		}
		else
		{
			if($("#pass").val()==$("#nuevapass").val())
			{
				$("#mensajes").html("Todos los campos son iguales");
			}
			else
			{
				var d=$("#formulario").serialize();
				$.ajax({type: "GET",url: "cambiarPass2.php",data: d,
   				success: function(msg)
				{
     				$("#mensajes").html(msg);
					$("input[type='password']").val("");
   				}
 				}).error(function()
				{
					$("#mensajes").html("Fallo");
				});
			}
		}
		
   });
});
</script>
</head>
<body>
<div id="jQueryAccordion1" style="position:absolute; left:143px; top:69px; width:467px; height:281px; z-index:1">
<div id="jQueryAccordion1_id" style="position:absolute; width:467px; height:281px; left: 2px; top: 1px;">
<h3 style="display:block"><a href="#">Cambiar Contraseña</a></h3>
<div>
<div id="wb_ChangePassword1" style="margin:0;padding:0;position:absolute;left:68px;top:43px;width:326px;height:150px;text-align:right;z-index:0;">
<form name="changepasswordform" method="post" " id="formulario">
<table cellspacing="4" cellpadding="0" style="background-color:#F7F9FC;border-color:#DFE9F5;border-width:1px;border-style:solid;color:#387AC8;font-family:Arial;font-size:13px;width:326px;height:150px;">
<tr>
   <td colspan="2" align="center" style="height:20px;background-color:#DFE9F5;color:#387AC8;">Cambiar Contraseña</td>
</tr>
<tr>
   <td align="right" style="height:20px">Contraseña:</td>
   <td align="left"><input name="pass" type="password" id="pass" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#DFE9F5;border-width:1px;border-style:solid;color:#387AC8;font-family:Arial;font-size:13px;"></td>
</tr>
<tr>
   <td align="right" style="height:20px">Nueva contraseña:</td>
   <td align="left"><input name="nuevapass" type="password" id="nuevapass" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#DFE9F5;border-width:1px;border-style:solid;color:#387AC8;font-family:Arial;font-size:13px;"></td>
</tr>
<tr>
   <td align="right" style="height:20px">Confirmar nueva contraseña</td>
   <td align="left"><input name="cnuevapass" type="password" id="cnuevapass" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#DFE9F5;border-width:1px;border-style:solid;color:#387AC8;font-family:Arial;font-size:13px;"></td>
</tr>
<tr>
   <td colspan="2" id="mensajes"></td>
</tr>
<tr>
   <td>&nbsp;</td><td align="left" valign="bottom"><input type="button" value="Cambiar contraseña" id="boton" style="color:#387AC8;background-color:#FFFFFF;border-color:#DFE9F5;border-width:1px;border-style:solid;font-family:Arial;font-size:13px;width:150px;height:20px;"></td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
