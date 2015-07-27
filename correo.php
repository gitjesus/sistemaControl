<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">



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
  // $("#jQueryAccordion1_id").accordion(jQueryAccordion1Opts);
   $("#boton").click(
   function()
   {
   		
		var d=$("#formulario").serialize();
				$.ajax({type: "GET",url: "correo2.php",data: d,
   				success: function(msg)
				{
     				$("#mensajes").html(msg);
					$("input[type='password']").val("");
   				}
 				}).error(function()
				{
					$("#mensajes").html("Fallo");
				});
   });
});
</script>
</head>
<div id="jQueryAccordion1_id" style="position:absolute; width:467px; height:281px; left: 2px; top: 1px;">
  <h3 style="display:block"><center>Cambiar Correo</center></h3>
<div>
<div id="wb_ChangePassword1" style="margin:0;padding:0;position:absolute;left:68px;top:43px;width:326px;height:150px;text-align:right;z-index:0;">
<form id="formulario">
<table cellspacing="4" cellpadding="0" style="background-color:#F7F9FC;border-color:#DFE9F5;border-width:1px;border-style:solid;color:#387AC8;font-family:Arial;font-size:13px;width:326px;height:150px;">
<tr>
   <td height="39" colspan="2" align="center" style="height:20px;background-color:#DFE9F5;color:#387AC8;">Cambiar Correo</td>
</tr>
<tr>
   <td height="33" align="right" style="height:20px">Correo:</td>
   <td align="left"><input name="correo" type="text" id="pass"  maxlength="50"></td>
</tr>

<tr>
   <td height="38" colspan="2" id="mensajes"></td>
</tr>
<tr>
   <td>&nbsp;</td><td align="left" valign="bottom"><input type="button" value="Cambiar correo" id="boton" style="color:#387AC8;background-color:#FFFFFF;border-color:#DFE9F5;border-width:1px;border-style:solid;font-family:Arial;font-size:13px;width:150px;height:20px;"></td>
</tr>
</table>
</form>
</div>
</div>
</div> 
</html>