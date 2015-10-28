<?php 
	session_start();
	include 'Classes/base.php';
	$base=new base();
	
	$sentencia_folio="select max(folio) as folio from reporte_usuario";
	$arr=$base->consultar($sentencia_folio);
	$objeto=$arr[0];
	$folio=$objeto->folio;
	$folio++;
	$sentencia_servicio="select id_servicio,nom_servicio from tipo_servicio";
	$sentencia_fuga="select id_fuga,nom_fuga from tipo_fuga";
	$sentencia_reconexion="select id_reconexion,nom_reconexion from tipo_reconexion";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head profile="http://gmpg.org/xfn/11"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title> 
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.10.custom.css">
<link rel="stylesheet" type="text/css" href="ui.selectmenu.css">
<style>
.cuadro
	{
		height: 600px;
		width: 500px;
		background-color:#00FF99;
	}
	#tabla2{
    height: 450px;
}


</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="js/ui.selectmenu.js"></script>
<script type="text/javascript" src="js/i18n/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="js/allowChars.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#servicio").selectmenu({width: 220,style:'dropdown'});
	$("#tipofuga").selectmenu({width: 220,style:'dropdown'});
	$("#tipoconexion").selectmenu({width: 220,style:'dropdown'});
	$("#oculta").css('visibility','hidden');
	$("#oculta").css('display','none');
	$("#oculto2").css('visibility','hidden');
	$("#prioridad").selectmenu({width: 150,style:'dropdown'});
	$("#tabla").accordion();
	$("#enviar").button();
	
	$("#servicio").change(
		function()
		{
			if($(this).val()==2)
			{
				$("#oculto2").css('display','none');
				$("#oculta").css('visibility','');
				$("#oculta").css('display','');
				$("#oculto2").css('visibility','hidden');
			}
			else if ($(this).val()==5)
			{
				$("#oculta").css('display','none');
				$("#oculto2").css('display','');
				$("#oculto2").css('visibility','');
			}
			else
			{
				$("#oculta").css('visibility','hidden');
				$("#oculto2").css('visibility','hidden');
			}
		});
		
		
	$("#tipofuga").change(
		function()
		{ 
		      if($("#servicio").val()=="")
				{
					$.ajax({type: "GET",
   			url: "tabla.php?",
   			async:false,success: function(msg){$("").val(msg)}});	
				}
				else if($("#servicio").val()=="SERVICIO DE AGUA")
				{
					$.ajax({url: 'tabla.php?id='+"&servicio="+$("#tipofuga").val(),async:false,success: function(msg){$("").val(msg)}});			
				}
				else
				{
					$.ajax({url: 'Tabla.php?',async:false,success: function(msg){$("").val(msg)}});			
				}
		});
		
			
				
	$("input[name='telefono']").allowChars({
		letras: false,
		numeros: true,
		espacios: false
	});
	
	$("input[name='no']").allowChars({
		letras: true,
		numeros: true,
		espacios: false
		
	});
	
	$("input[name='cuenta']").allowChars({
		letras: false,
		numeros: true,
		espacios: false
	});
	$("input[name='nombre']").keydown(
	function(e)
	{
		if((e.which>=65&&e.which<=90)||e.which==32||e.which==8||e.which==192||e.which==9)
		{

		}
		else
		{
			e.preventDefault();

		}
	});
	$("input[name='apellidop']").keydown(
	function(e)
	{
		if((e.which>=65&&e.which<=90)||e.which==32||e.which==8||e.which==192||e.which==9)
		{

		}
		else
		{
			e.preventDefault();

		}
	});
	$("input[name='apellidom']").keydown(
	function(e)
	{
		if((e.which>=65&&e.which<=90)||e.which==32||e.which==8||e.which==192||e.which==9)
		{

		}
		else
		{
			e.preventDefault();

		}
	});
	
	$.fx.speeds._default = 500;
	$("#dialogo").dialog(
	{
		autoOpen: false,
		show: "blind",
		hide: "explode",
		modal: true
	}
	);
	$( "#fecha" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			maxDate: +0,
			showAnim: "blind"
					
  
		});
	
	$("#enviar").click(function(e)
	{
		e.preventDefault();
		if(vacios())
		{
		
				$("#dialogo").html("<center>FALTAN LLENAR DATOS</center><center><br>VERIFIQUE</br></center>");
				$("#dialogo").dialog("open");	
		}
		else
		{
			var campos=$("#formulario").serialize();
			$("input[type='text']").val("");		
			$.ajax({
   			type: "POST",
   			url: "guardarreporte.php",
   			data: campos,
   			success: function(msg){
     			$("#dialogo").html(msg);
			$("#dialogo").dialog("open");
   			}
 			}).error(function(){
				$("#dialogo").html("no se pudo guardar el reporte");
				$("#dialogo").dialog("open");	
				});
		}
		
	});
	$("input[type='text']").each(
	function()
	{
		$(this).focus(function(){
		$(this).removeClass("ui-state-error ui-corner-all");
							});
	}
	);
	function vacios()
	{
		var vacios=false;
		$("input[type='text']").each(
		function()
		{
			if($(this).val()=="")
			{
				$(this).addClass("ui-state-error ui-corner-all");
				vacios=true;
			}	
		}
		);
		if( $("#servicio").val()=="0")
		{
			vacios=true;
		}
		return vacios;
	}
	
	$("#referencia").blur(
	function()
	{
		if($("#servicio").val()==2)
		{
			$.ajax(
				{
					url: 'reporteDuplicado.php',
					type: 'post',
					dataType:'json',
					data: {
						colonia: $("#colonia").val(),
						calle: $("#calle").val(),
						referencia: $("#referencia").val(),
						entrecalles: $("#entrecalles").val()
					},
					success:
					function(response)
					{
						var cadena="Folios Similares: <br> <pre>";
						
						for(var i=0;i<response.folios;i++)
						{
							cadena+='Folio: '+response[i].folio+" Nombre: "+response[i].nombre+" "+response[i].apellidoPaterno+" "+response[i].apellidoMaterno+"<br>";
							cadena+="Direccion: "+response[i].colonia+" "+response[i].calle+"<br>";
							cadena+="Entre calles : "+response[i].entrecalles+"<br>";
							cadena+="Referencia : "+response[i].referencia;
						}
						cadena+='</pre>';
						$("#tdDuplicados").html(cadena);
					}
				}
			);
			
			
			
			
		}
					
	});
});
</script>
<script>
function show5(){
 if (!document.layers&&!document.all&&!document.getElementById)
 return
 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()
 var dn="AM" 
 if (hours>12){
 dn="PM"
 hours=hours-12
 }
 if (hours==0)
 hours=12
 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds 
//change font size here to your desire
myclock="<font size='5' face='Arial' ><b><font size='4' >Hora:</font></br>"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
{
$("#hora").html(myclock);

}
setTimeout("show5()",1000)
 }
show5();
</script>
</head>
<body>
<br>
<center>
<div align="center" id="tabla">
<h3><a href="#">REPORTE DE USUARIO</a></h3>
<div id="tabla2">

  <form id="formulario" name="f">
  <table width="639">
    <tr>
      <td width="106" height="28" align="center"><?php echo $folio?><input type="hidden" name="folio" value="<?=$folio?>"></td>
      <td width="199" align="center"><input type="text" name="nombre"  size="20"/></td>
      <td width="163"  align="center"><input type="text" name="apellidop" /></td>
      <td width="151"  align="center"><input type="text" name="apellidom" size="20" /></td>
      </tr>
    <tr>
      <td align="center"><strong>No. Reporte</strong></td>
      <td align="center"><strong>Nombre(s)</strong></td>
      <td align="center"><strong>Apellido paterno</strong></td>
      <td align="center"><strong>Apellido materno</strong></td>
      </tr>
    <tr>
    	<td align="left"><strong>Fecha: <input type="text" size="10" id="fecha" name="fecha" readonly ></strong></td>
    	
      <td><strong>Tipo de Servicio:</strong></td>
      <td height="38" align="left"><select name="servicio" id="servicio">
    <?php
		$arr=$base->consultar($sentencia_servicio);
		foreach($arr as $objeto)
		{
			echo " <option value='$objeto->id_servicio'>".($objeto->nom_servicio)."</option> ";
		}
		?>
      </select></td>
      <td align="left" id="oculta"><label>
        <select name="tipofuga" id="tipofuga">
          <?php
          	$arr=$base->consultar($sentencia_fuga);
			foreach($arr as $objeto)
			{
				echo " <option value='$objeto->id_fuga'>".utf8_encode($objeto->nom_fuga)."</option> "; 
			}
          ?>
        <td aling="left" id="oculto2"><lab></label>
        	<select name="tipoconexion" id="tipoconexion">
        		<?php
        		$arr=$base->consultar($sentencia_reconexion);
				foreach($arr as $objeto)
				{
					echo "<option value='$objeto->id_reconexion'>".utf8_encode($objeto->nom_reconexion)."</option>";	
				}
        		?>
        	</select>
        	
        </td>
      </label></td>
      
      </tr>
    <tr>
      <td height="35"><strong>DIRECCION:</strong></td>
      <td height="35"><strong>Colonia:
        </strong>        <input type="text" name="colonia" id="colonia" /></td>
      <td  height="30"><strong>calle:</strong>        <input type="text" name="calle"  size="20" id="calle" /></td>
      <td height="35"><strong>No.</strong> <input type="text" name="no" id="no" size="5" /></td>
      </tr>
    <tr>
      <td><strong>Entre que Calles:</strong></td>
      <td height="30" align="left">
        <input type="text" name="entrecalles" id="entrecalles"  size="20"/>
    </td>
      <td align="center"><strong>Cuenta:
          <input type="text" name="cuenta" id="cuenta" maxlength="5" size="10" />
      </strong></td>
      <td align="left"><strong>Prioridad:</strong>
        <select name="prioridad" id="prioridad">
          <option value=0>Ordinario</option>
          <option value=1>Urgente</option>
        </select></td>
    </tr>
    <tr>
      <td><strong>Referencia:</strong></td>
      <td height="30" align="left"><input type="text" name="referencia" id="referencia" size="20" /></td>
      <td align="letf"><strong>Telefono</strong>:        <input type="text" name="telefono" id="telefono" size="10" /></td>
      <td align="left" id="hora"><strong>Hora: <input name="hora" id="hora" type="hidden" /></strong></td>
      </tr>
    <tr>
    	<td colspan="4" class="text-center" id="tdDuplicados"></td>
    </tr>  
	<tr>
	  <td height="41" colspan="4"><center><input type="button" name="enviar" id="enviar" value="Guardar" /></center></td>
	  </tr>
  </table>
  </form>
 
</div>
</div>
</center>
<div id="dialogo" title="mensaje">

</div>
</body>
</html>