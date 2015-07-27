<?php
include("conexion.php");
$consulta="select usuario from usuarios where id_usuario='".$_SESSION["usuario"]."'";
	mysql_query($consulta);
	session_unset();
	session_destroy();
	echo "
		<script>
			location.href = 'inicio.php';
		</script>
		";
?>
</body>
</html>
