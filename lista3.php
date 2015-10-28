<?php
session_start();
include 'Classes/base.php';
$base=new base();
$where="";
$params=(object)$_GET;

switch(@$params->filtrado)
{
	case 'u':
			$where=" where concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre)='$params->filtro' ";
		break;
	case 'd':
			$where=" where concat(colonia,' ',calle,' ',no)='$params->filtro'";
		break;
	case 'f':
			$where=" where folio=$params->filtro ";
		break;
	case 's':
			$where=" where servicio=$params->servicio";
		break;			
}
/*
if($usuario!="")
	$where=" where concat(apellidoPaterno,' ',apellidoMaterno,' ',nombre)='$usuario' ";

if($folio!="" && $usuario=="")
	$where=" where folio=$folio ";

if($dir!="")
{
	$where=" where concat(colonia,' ',calle,' ',no)='$dir'";	
}

if($servicio!=0&& ($folio==""&&$usuario==""&&$dir==""))
{
	$where=" where servicio=$servicio";
}
 *
 */
$sentencia="
	select 
		folio,
		nombre,
		apellidoPaterno,
		apellidoMaterno,
		colonia,
		no,
		tu.nom_servicio  servicio,
		tf.nom_fuga  as fuga,
		tr.nom_reconexion as reconexion,
		calle,
		prioridad,
		fecha
		
		 from reporte_usuario ru 
		 	left join
		 	tipo_servicio tu
		 		on tu.id_servicio=ru.servicio
		 	left join 
		 	tipo_fuga tf
		 		on 	tf.id_fuga=ru.fuga
		 	left join
		 	tipo_reconexion tr
		 		on tr.id_reconexion=ru.reconexion	
		 ".($where!=""?" $where and eliminado=1 ":' where eliminado=1')."
		 
		 order by fecha
		 ";
$servicios="select id_servicio,Nom_Servicio from tipo_servicio ";
$arr_s=$base->consultar($servicios);
$arr=$base->consultar($sentencia);

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
				
				
			$("input[name='busqueda_folio']").allowChars({
				letras: false,
				numeros: true,
				espacios: false
				
			});
	
				
			$("#filtroDir").allowChars({
				letras: true,
				numeros: true,
				espacios: true
				
			});
		
			$("#btn_buscar").click(function()
			{
				$("form")[0].submit();
			});
			
			
		
			$("#textFiltro").autocomplete(
			{
				source: 'auto_complete.php',
				minLength:2,
				select: function( event, ui )
				{
					$("#textFiltro").val(ui.item.value);
					
				}
			});
			
			$(".filtro").click(function(e)
			{
				e.preventDefault();
				$("#textFiltro").val("");
				$("#trServicio").css('display','none');
				$("#trFiltro").css('display','');
				$(".btn-group button").each(
					function(i,e)
				{
					$(e).removeClass("active");
				}
				);
				
				$(this).addClass("active");
				
				if($(this).attr("id")=='usuario')
				{
					$("#textFiltro").autocomplete('option','disabled',false);
					$("#textFiltro").autocomplete('option','source','auto_complete.php');
					$("#filtrado").val('u');
				}
				else if($(this).attr('id')=='dir')
				{	
					$("#textFiltro").autocomplete('option','disabled',false);
					$("#textFiltro").autocomplete('option','source','auto_completeDir.php');
					$("#filtrado").val('d');
				}
				else if($(this).attr('id')=='folio')
				{	
					$("#textFiltro").autocomplete('option','disabled',true);
					$("#filtrado").val('f');
				}	
				else if($(this).attr('id')=='servicio')
				{	
					$("#trFiltro").css('display','none');
					$("#trServicio").css('display','block');
					$("#textFiltro").autocomplete('option','disabled',true);
					$("#filtrado").val('s');
				}
			});
			
			$(".btn-eliminar").click(
				function()
				{
					var boton=$(this);
					var folio=$(this).attr('folio');
					var resp=window.confirm("Realmente desea eliminar el reporte con folio "+folio);
					
					if(!resp)
					{
						return false;
					}
					$.ajax(
					{
						url: 'eliminarServicio.php',
						data: {folio: folio},
						type: 'post',
						success: function(response)
						{
							if(response=="ok")
							{
								$(boton).parents("tr:first").remove();	
							}
							else
							{
								alert("error");
							}	
						}
					}
					);
				}
			);
			
			$(".btn-editar").click(
				function(e)
				{
					var boton=$(this);
					var folio=$(this).attr('folio');
					window.location='actualizarReporte.php?folio='+folio;
				}
			);
			
			$("#btn-exportar").click(
			function()
			{
				var folios=new Array();
				$(".detFolio").each(
					function(i,e)
					{
						var folio=$(e).attr('folio');
						folios.push(folio);
					}
				);				
				$.ajax(
					{
						url:'jsonXLS.php',
						data: { datos : folios },
						type: 'post',
						success: function(response)
						{
							if(response=='ok')
								window.open('generaXLS.php');
						}
					}
				);
			});
			
			$("#tabla").accordion();
			

			
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
			width: 30%;
		}
		
		#trServicio
		{
			display: none;
		}
	</style>
	</head>
	<body>
		<br>

			<form action="">
				<input type="hidden" name="filtrado" id="filtrado" value="u"/>
<table id="filtros" class="text-center">
	<tr>
		<td>
		<div class="btn-group">
				  <button type="button" class="btn btn-md btn-info filtro active" id="usuario">Usuario</button>
				  <button type="button" class="btn btn-md btn-info filtro" id="dir">Direcci&oacute;n</button>
				  <button type="button" class="btn btn-md btn-info filtro" id="folio">Folio</button>
				  <button type="button" class="btn btn-md btn-info filtro" id="servicio">Servicio</button>
		</div>
		</td>
	</tr>
	<tr id="trFiltro">
		<td>
			<br>
			<input type="text" id="textFiltro" name="filtro">
			
		</td>
	</tr>
	<tr id="trServicio" class="text-center">
		<td>
			<br>
			<select name="servicio">
				<option value="0">TODOS</option>
			<?php
				foreach($arr_s as $servicio)
				{
					echo "<option value=$servicio->id_servicio>$servicio->Nom_Servicio</option>";
				}
			?>
			</select>
		</td>
	</tr>
	<?php 
	/*	
		<td>Usuario&nbsp;</td><td><input type="text" name="filtro" id="txtfiltro"/></td>
	</tr>
	<tr>
		<td>Direcci&oacute;n</td><td><input type="text" name="filtroDir" id="filtroDir"/></td>
	</tr>
	<tr>
		<td>Folio&nbsp;</td><td> <input type="text" size="6" name="busqueda_folio" id="busqueda_folio"/>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<select name="servicio">
				<option value="0">TODOS</option>
			<?php
				while($servicio=mysql_fetch_object($result))
				{
					echo "<option value=$servicio->id_servicio>$servicio->Nom_Servicio</option>";
				}
			?>
			</select>
		</td>
	</tr>
	 * 
	 */
	 ?>

	<tr>
		<td>&nbsp;</td>
	</tr>	
	<tr class="text-center">
		<td colspan="2"><button class='btn btn-primary' id="btn_buscar"><span class="glyphicon glyphicon-search"></span>&nbsp;FILTRAR</button></td>
	</tr>	
</table>
</form>
	
<div align="center" id="tabla">
<h3><a href="#">LISTA DE REPORTES</a></h3>
<div>
		<table class="table table-bordered table-striped" id="tabla_lista">
			<thead>
				<tr>
					<th>FOLIO</th><th>USUARIO</th><th>DIRECCI&Oacute;N</th><th>SERVICIO</th><th>FECHA</th><th>STATUS</th><th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				
					<?php
				foreach($arr as $objeto)
				{
					$objeto->servicio=utf8_encode($objeto->servicio);//error de acentos
					//print_r($objeto);
					echo 	"
					<tr class='".($objeto->prioridad?'danger':'')."'>				
					<td><a href='detalleServicio2.php?folio=$objeto->folio' class='detFolio' folio='$objeto->folio'>#$objeto->folio</a></td><td>$objeto->nombre $objeto->apellidoPaterno $objeto->apellidoMaterno</td><td >$objeto->colonia $objeto->calle $objeto->no </td><td>$objeto->servicio  
					
					".
					( $objeto->fuga!=""?" DE $objeto->fuga":'').( $objeto->reconexion!=""?" POR  $objeto->reconexion":'')
					."
					</td><td>$objeto->fecha</td><td>PENDIENTE</td>
					
					</tr>";
				}
					?>
			
			</tbody>
            <tfoot>
            <tr>
            	<td colspan="7" class="text-center"><button class="btn btn-md btn-info" id="btn-exportar">Exportar <span class="glyphicon glyphicon-share-alt"></span></button></td>
            </tr>
            </tfoot>
		</table>
		
</div>
</div>		
	</body>
</html>