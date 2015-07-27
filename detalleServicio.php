<?php
include("conexion.php");
$params=(object)$_GET;
$query="
	select ru.*,
	(select nom_servicio from tipo_servicio where id_servicio=ru.servicio )  as nom_servicio, 
	(select nom_fuga from tipo_fuga where id_fuga=ru.fuga) as fuga,
	(select nom_reconexion from tipo_reconexion where id_reconexion=ru.reconexion) as reconexion
	
	from reporte_usuario ru where folio=$params->folio";
$result=mysql_query($query);
$servicio=mysql_fetch_object($result);

$sentencia="select * from tipo_status";
$resultado=mysql_query($sentencia);

?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/allowChars.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/i18n/jquery.ui.datepicker-es.js"></script>    
    <script>
    	$(function()
    	{
    		$("#tabla").accordion();
    		
    		$("#btnAgregaSeguimiento").click(function()
	    	{
	    				$("#dialog-form").dialog("open");
	    	
	    	});
	    	
	    	$("#btnGuardarSeg").click(function(e)
	    	{
	    		e.preventDefault();//para que no se recargue la pagina el click del button dispara el submit del form 
	    		$.ajax(
	    			{
	    				url: 'guardarSeguimiento.php',
	    				data: $("#frmSeg").serialize(),
	    				type: 'post',
	    				success: function(response)
	    				{
	    					if(response=="ok")
	    					{
	    						window.location=window.location;
	    						
	    					}
	    					else
	    					{
	    						$("#dialog").dialog("close");
	    						$("#dialog-form").html("Error");
	    						$("#dialog").dialog("open");	    						
	    					}

	    				}
	    			}
	    		);
	    		frmSeg	
	    	});
	    	
	    	$( "#dialog-form" ).dialog({
			      autoOpen: false,
			      height: 'auto',
			      width: 'auto',
			      modal: true			      
			});
			
			$("#txtFechaEjec").datepicker(
			{
				changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			maxDate: +0,
			showAnim: "blind"
					
			}
			);
    	});
    </script>
    <style>
    #dvAgregaUsuario
    {
    	display: none;
    }
    
    #dialog-form
    {
    	z-index: 999;
    }
    </style>
	</head>	
	<body>
		<br>
	<div align="center" id="tabla">
	<h3><a href="#">SERVICIO </a></h3>
	<div>	
		<table class="table table-bordered text-center">
			<tr>
				<th>FOLIO</th><td><?php echo $servicio->folio?></td><th>USUARIO REPORTA</th><td><?php echo $servicio->nombre.' '.$servicio->apellidoPaterno.' '.$servicio->apellidoMaterno  ?></td>
				<th>FECHA DE REPORTE</th>
				<td><?php echo $servicio->fecha.' '.$servicio->hora?></td>
			</tr>
			<tr>
				<th>DIRECCI&Oacute;N</th><td><?php echo $servicio->colonia.' '.$servicio->calle.' '.$servicio->no ?></td><th>ENTRE LAS CALLES</th><td><?php echo $servicio->entrecalles?></td>
				<th><strong>FECHA DE EJECUCIÓN</strong></th>
				<td><?php echo $servicio->fecha_ejecucion?></td>		
			</tr>
			<tr>
				<th>CUENTA</th><td><?php echo $servicio->cuenta?></td><th>REFERENCIA</th><td><?php echo $servicio->referencia?>
				<th><strong>REALIZÓ</strong></th>
				<td><?php echo $servicio->realizo?></td>
			</tr>
			<tr>
				<th>SERVICIO</th><td><?php echo $servicio->nom_servicio.($servicio->fuga!=""?" DE {$servicio->fuga}":'').($servicio->reconexion!=""?" DE {$servicio->reconexion}":'') ?></td><th>PRIORIDAD</th><td><?php echo ($servicio->prioridad)?'URGENTE':'ORDINARIO'?></td>
                
				<th>J.DE CUADRILLA</th>
				<td><?php echo $servicio->jcuadrilla?></td>
                <tr><th>STATUS</th>
				<td><?php switch ($servicio->status)
					{
case 1:
	break;
		echo 'PENDIENTE';
case 2:
		echo 'EN PROCESO';
	break;
case 3:
		echo 'FINALIZADO';
	break;
						
					}?></td>
                <th>OBSERVACIONES</th>
				
				<td colspan="3"><?php echo $servicio->observacion?></td>
</tr>
			</tr>
			<tr>
				<td colspan="6" class="text-center">&nbsp;<input type="button" value="Agregar Seguimiento" id="btnAgregaSeguimiento" class="btn btn-success" /></td>
			</tr>
		</table>
	</div>
	</div>
	<div id="dvAgregaUsuario">
		<table class="table table-bordered">
			<tr>
				<th>NOMBRE</th><td><input type="text"></td><th>APELLIDO PATERNO</th><td><input type="text" ></td><th>APELLIDO MATERNO</th><td><input type="text" ></td>
			</tr>
			<tr>
				<th>DIRECCI&Oacute;N</th><td colspan="2"><input type="text" /></td><th>ENTRE</th><td><input type="text" /></td>
			</tr>
		</table>
		
	</div>
	<div id="dialog-form" title="ACTUALIZAR SEGUIMIENTO">
		<form id="frmSeg">
			<input type="hidden" value="<?php echo $servicio->folio?>" name="folio">
			<table class="table">
			<tbody>
				
				<tr>
					<td>Realiz&oacute;:</td><td><input type="text" name="realizo" value="<?php echo $servicio->realizo?>" /></td>
				</tr>
				<tr>
					<td>Fecha de Ejecuci&oacute;n:</td><td><input type="text" id="txtFechaEjec" name="fechaEjecucion"  value="<?php echo $servicio->fecha_ejecucion?>"/></td>
				</tr>
                <tr>
					<td>Jefe de Cuadrilla:</td><td><input type="text" name="jcuadrilla" value="<?php echo $servicio->jcuadrilla?>" /></td>
				</tr>
				<tr>
					<td>Estatus:</td><td>
						<select name="status">
							<?php
								while($status=mysql_fetch_object($resultado))
								{
									$selected="";
									if($servicio->status==$status->id_status){
										
										$selected='selected';
									}
									echo "<option value='$status->id_status' $selected>$status->tipo_status</option>";
								}
									
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>OBSERVACIONES</td><td><textarea name="observacion" cols="30" rows="5"><?php 
							echo $servicio->observacion
						?></textarea></td>
				</tr>
				
					<td colspan="2" class="text-center"><button class="btn-success btn" id="btnGuardarSeg">Guardar</button></td>
				</tr>
			</tbody>
			</table>
		</form>
	</div>	
	</body>
</html>