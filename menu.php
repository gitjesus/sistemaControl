<?php
session_start();
$user=$_SESSION["usuario"];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>caev</title>
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(
	function()
	{
		var nivel="";
		$("ul li a#nivel").each(
		function()
		{
			$(this).click(
		function()
		{
			nivel=$(this).attr("name");
			var etiqueta="Actividad: "+nivel;
			$("#etiqueta").html(etiqueta);
			$("iframe").attr('src','');
		});
		});
		
		$(".btn-group button").click(
			function()
			{
				if($(this).attr('name')!=undefined)
				$("iframe").attr('src',$(this).attr('name')+".php");
			}
		);
		$("ul li a:not('#nivel')").click(
		function()
		{
			if($(this).attr('name')!=undefined)
				$("iframe").attr('src',$(this).attr('name')+".php");
			
			
		});
		$('div#menu').hide();
		$('div#menu').show('slow');
	});
    </script>
    <style type="text/css">
* { margin:0;
    padding:0;
}
body { background-color: white }
div#menu {
	margin-top: 5px;
	margin-right: auto;
	margin-bottom: 5px;
	margin-left: auto;
	height: 60px;
	width: auto;
}

h1 {
	font-size: 18px;
}
    .Estilo1 {
	font-size: 24px;
	font-weight: bold;
	color: #000000;
}
    .Estilo2 {
	font-family: Georgia, "Times New Roman", Times, serif;
	background-color: #010000;
}
#contenido{
	height: 100%;
}

    </style>
   
</head>
<body>
<p align="center" ></span><img src="banner.png" alt="banner" width="1000" height="200"></p>

  <center><div class="btn-group">

    
      <button type="button" class="btn btn-success" name="alerts">Notificaciones</button>
      <button type="button" class="btn btn-success" name="tabla">Reporte de Usuarios</button>
      <button type="button" class="btn btn-success" name="lista2"><span class='glyphicon glyphicon-list-alt'></span>&nbsp;Lista de Reportes</button>
      <button type="button" class="btn btn-success" name="listaseguimiento">Seguimiento de Reportes</button>
    <div class="btn-group">
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
      &nbsp;<?php echo $_SESSION["usuario"]?> <span class="caret"></span></button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">Cambiar Contraseña</a></li>
        <li><a href="cerrarsesion.php">Salir</a></li>
      </ul>
    </div>
  </div>
  </center>
  
<iframe width="100%" height="100%" frameborder="0" name="contenido" src="alerts.php"></iframe>
</div>
</body>
</html>