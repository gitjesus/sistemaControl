<?php
session_start();
include 'Classes/base.php';
$base=new base();
$params=(object)$_POST;
$font="";
if( isset($params->nombreFontanero)){
	switch($params->filtrado)
	{
		case 'f':
			$font=" and realizo='$params->nombreFontanero' ";
		break;
		case 'j':
			$font=" and jcuadrilla='$params->nombreFontanero' ";
		break;	
			
		default:
			$font='';
			break;	
	}
}
	
$query="
	select ru.*,
	(select nom_servicio from tipo_servicio where id_servicio=ru.servicio )  as nom_servicio, 
	(select nom_fuga from tipo_fuga where id_fuga=ru.fuga) as fuga,
	(select nom_reconexion from tipo_reconexion where id_reconexion=ru.reconexion) as reconexion
	
	from reporte_usuario ru
	
	where eliminado=1 
	$font
	";

$arr=$base->consultar($query);


?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/allowChars.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	<script>
		$(function()
		{	
			$("#tabla").accordion();
			
			
			$("#nombreFontanero").autocomplete(
			{
				source: 'auto_fontanero.php',
				minLength:2,
				select: function( event, ui )
				{
					$("#nombreFontanero").val(ui.item.value);
					$("form")[0].submit();
				}
			});
			

			$(".filtro").click(function(e)
			{
				e.preventDefault();
				$("#nombreFontanero").val("");
				$(".btn-group button").each(
					function(i,e)
				{
					$(e).removeClass("active");
				}
				);
				
				$(this).addClass("active");
				
				if($(this).text()=='Fontanero')
				{
					$("#nombreFontanero").autocomplete('option','source','auto_fontanero.php');
					$("#filtrado").val('f');
				}
				else if($(this).text()=='Jefe Cuadrilla')
				{
					$("#filtrado").val('j');
					$("#nombreFontanero").autocomplete('option','source','auto_jefe.php');
				}	
			});
			
			$("#btn-exportar").click(function() {
                var titulos=new Array();
				var filas=new Array();

				$("#tabla_lista thead tr th").each(function(index, element) {
						titulos.push($(element).text());
                });
				
				$("#tabla_lista tbody tr").each(function(index, element) {
					var fila=new Array();
					$(element).find("td").each(function(i,e)
					{
							fila.push($(e).text());
					});
					filas.push(fila);
					
                });
				var excel={
					"desde": 'Seguimiento de Reportes',
					"titulo": titulos,
					"filas": filas
				};
				
				$.ajax(
				{
					url: "jsonXLS.php",
					data: {'datos': excel},
					type: 'POST',				
					success: function(response)
					{
						if(response=="ok")
							window.open('generaXLS.php');
					}
				});
            });
			
		});
	</script>
	<style>
		#tabla_lista tr.danger
		{
			background-color: red;
		}
		
		#filtros
		{
			margin: auto;
			width: 25%;
		}
	</style>
	</head>
	<body>
		<br>


	
<div align="center" id="tabla">	
<h3><a href="#">SEGUIMIENTO DE REPORTES</a></h3>
<div>
	<form method="post">
		<input type="hidden" name="filtrado" id="filtrado" value="f"/>
	<table>
		<tr>
			<th>Filtrar&nbsp;</th>
			<td>
				 <div class="btn-group">
				  <button type="button" class="btn btn-sm btn-info filtro active">Fontanero</button>
				  <button type="button" class="btn btn-sm btn-info filtro">Jefe Cuadrilla</button>
				</div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<th>Nombre&nbsp;</th><td class="text-center">&nbsp;<input type="text" name="nombreFontanero" id="nombreFontanero" ></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	</form>
		<table class="table table-bordered table-striped" id="tabla_lista">
			<thead>
				<tr>
					<th>FOLIO</th>
				  <th>SERVICIO</th>
					<th>FECHA REPORTE</th>
				  <th>STATUS</th>
				  <th>REALIZO</th>
				  <th>J.CUADRILLA</th>
				  <th>OBSERVACIONES</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($arr as $servicio)
					{
						switch (intval($servicio->status))
					{
case 1:
	
		$servicio->status='PENDIENTE';
	break;
case 2:
		$servicio->status='EN PROCESO';
	break;
case 3:
		$servicio->status='FINALIZADO';
	break;
default:
	$servicio->status='NO ESPECIFICADO';						
					}
						echo "<tr>
							<td class='text-center'><a href='detalleServicio.php?folio=$servicio->folio' class='folio'>$servicio->folio</a></td>
							<td>$servicio->nom_servicio</td>
							<td>$servicio->fecha</td>
							<td>$servicio->status</td>
							<td>$servicio->realizo</td>
							<td>$servicio->jcuadrilla</td>
							<td>$servicio->observacion</td>
						</tr>";
					}
				?>
			
			</tbody>
            <thead>
            <tr>
            	<td colspan="7" class="text-center"><button class="btn btn-md btn-info" id="btn-exportar">Exportar <span class="glyphicon glyphicon-share-alt"></span></button></td>           
            </tr>
            </thead>
		</table>
		
</div>
</div>		
	</body>
</html>