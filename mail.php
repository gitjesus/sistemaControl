<?php
include("funciones.php");
include("class.phpmailer.php");
include("class.smtp.php");
$usuario=$_POST["user"];
$consulta="select correo,contrasena from usuarios where usuario='$usuario' and correo is not null";
$resultado=mysql_query($consulta);
$num=mysql_num_rows($resultado);
if($num>0)
{
	$fila=mysql_fetch_array($resultado);
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "mail.ifxa.mx";
	$mail->Port = 465;
	$mail->Username = "admin@ifxa.mx";
	$mail->Password = "instituto";
	$mail->From = "admin@ifxa.mx";
	$mail->FromName = "Servicios Tecnologicos sanchez velasco";
	$mail->Subject = "Recuperación de contraseña";
	$mail->AltBody = "Recuperación de contraseña";
	$mail->MsgHTML("Su contraseña es... <br><b>$fila[1]</b>.");

	$mail->AddAddress("$fila[0]", "$usuario");
	$mail->IsHTML(true);
     
	if(!$mail->Send()) 
	{
		echo "Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Mensaje enviado correctamente";
	}
}
else
{
	echo "No hay una cuenta de correo asociada al usuario";
}
?>