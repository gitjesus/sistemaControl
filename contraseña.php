<?php
session_start();
include("conexion.php");

if($accion=="Enviar"){
		$SQL = "SELECT * FROM usuarios WHERE usuario='$usuario'";
		$Resultado = mysql_query($SQL);
		$Fila = mysql_fetch_array($Resultado);	
$correo = $_POST["correo"]; 
$contrasena = $_POST["contraseña"]; 		
$usuario = $usuario;
$contrasena = $Fila[contrasena];		
$sendTo = $correo; 
$subject = $contrasena; 
$headers .= ""; 
$message = "\nUsuario: " . $usuario . "\ncontraseña: " . $contrasena; 
mail($sendTo, $subject, $message, $headers);
			echo "<script>";
			echo "alert('Su contraseña a sido mandada al Correo');";
			echo "</script>";
			echo "<script>";
			echo "location.href = 'inicio.php';";
			echo "</script>";
}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inicio</title>
<style type="text/css">
<!--
body {
	background-image: url(../Copia de fondo.jpg);
	background-image: url(Azul.JPG);
}
.Estilo10 {font-size: 36px; color: #0000FF; }
.Estilo11 {color: #0000FF}
.Estilo12 {color: #0000FF; font-weight: bold; }
.Estilo29 {
	color: #000000;
	font-weight: bold;
	font-size: 36px;
}
.Estilo13 {
	font-size: 18px;
	color: #000000;
}
.Estilo30 {
	font-size: 18px;
	color: #000099;
	font-weight: bold;
}
.Estilo31 {color: #000000}
.Estilo32 {color: #000000; font-weight: bold; }
.Estilo33 {font-size: 36px; color: #000000;}
.Estilo1 {font-size: 24px;
	font-weight: bold;
	color: #000000;
}
.Estilo2 {font-family: Georgia, "Times New Roman", Times, serif}
-->
</style></head>

<body>
<table width="901" height="259" border="0" align="center">
  <tr>
    <td colspan="5"><div align="center">
      <p align="center" class="Estilo1"><span class="Estilo2">INSTITUTO </span></p>
      <p align="center" class="Estilo1"><span class="Estilo2">&quot;FRANCISCO XAVIER ALEGRE&quot; </span> <img src="images/Captura de pantalla 2011-02-17 a las 18.43.27.png" width="98" height="78" border="0" align="absmiddle" usemap="#Map" /></p>
      </div></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" class="Estilo12"><div align="center" class="Estilo13">Recuperaci&oacute;n de contrase&ntilde;a </div></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td width="85"><span class="Estilo11"></span></td>
    <td width="280"><span class="Estilo11"></span></td>
    <td width="222"><span class="Estilo11"></span></td>
    <td width="143"><div align="center"><a href="Login.php" target="_top">Regresar</a></div></td>
    <td width="149">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo12"><span class="Estilo31">Usuario :</span></span></td>
    <td colspan="2"><strong>
      <input type="text" size="20" name="usuario" id="usuario" value="<?php echo $usuario; ?>"/>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo32">Correo :</span></td>
    <td colspan="2"><span class="Estilo11"><strong>
      <input type="text" size="50" name="correo" id="correo" value="<?php echo $correo; ?>"/>
    </strong></span></td>
    <td><span class="Estilo11"></span></td>
    <td><span class="Estilo11"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><span class="Estilo10">
      <input type="button" name="Enviar" value="Enviar" onclick="Enviar()" />
    </span></td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>
<form name="frm" id="frm" action="contrasena.php" method="post">
	<input type="hidden" name="usuario" id="usuario" />
	<input type="hidden" name="correo" id="correo" />	
	<input type="hidden" name="accion" id="accion" />
</form>
<script>
function Enviar(){
	if(document.getElementById("correo").value==""){
		alert('Por Favor.\nLlena Todos los Campos');
	}else{
		if(confirm('Revice que su información sea la correcta')){
			document.getElementById("frm").correo.value = document.getElementById("correo").value;
			document.getElementById("frm").usuario.value = document.getElementById("usuario").value;			
	        document.getElementById("frm").accion.value = "Enviar";
	        document.getElementById("frm").submit();		
		}
	}
}
</script>
</body>
</html>

