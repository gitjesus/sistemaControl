<?php
include("conexion.php");
$sentencia="select count(1)  as conteo from reporte_usuario where status=1 and (curdate()-fecha)>5";
$resultado=mysql_query($sentencia);
$num=mysql_num_rows($resultado);
$objeto=mysql_fetch_object($resultado);
?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/allowChars.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </head>
  <body>
  	<br>
  	<?php
  		if($num>0)
	{
	?>
		<div class="alert alert-danger">
  <strong>Alerta!</strong> Hay un total de <?php echo $objeto->conteo ?> reporte(s) sin movimientos por mas de 5 dias
</div>
	<?php	
	}
  	?>
  </body>
  </html>  