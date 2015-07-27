<style type="text/css">
input[type=text]
{
	width: 200px;
}
select
{
	width: 200px;
	text-align: center;
}
table th
{
	width: 150px;
}
table#listav
{
	margin-top: 10px;
}
div#cliente
{
	display: none;
}
table#listav #ppv input[type=text]
{

	width:50px;
	text-align: center;
}
#efectivo
{
	width:50px;
	text-align: center;
}
</style>
<script>
$(document).ready(
function(){
	$( "#fecha" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			maxDate: +0,
			showAnim: "blind"
		});

	$("#tv").change(
	function()
	{
		$("#cliente").slideToggle();
	});
	var obj=new Array();
	var total=0;
	var cli;
	$("#cbv").keypress(
	function(e)
	{
		var pos=0;
		var agregado=false;
		if(e.which==13)
		{
			if(obj.length!=0)
			{
				for(var i=0;i<obj.length;i++)
				{
					if($("#cbv").val()==obj[i].codigo)
					{
						agregado=true;
						pos=i;
					}
				}
				if(agregado)
				{
					var cant=parseFloat($("#"+$("#cbv").val()).find("#cant").val());
					cant++;
					$("#"+$("#cbv").val()).find("#cant").val(cant);
					var pc=parseFloat($("#"+$("#cbv").val()).children("#preciov").html());
					$("#"+$("#cbv").val()).children("#subt").html((cant*pc));
					for(var i=0;i<obj[pos].promo.length;i++)
					{
						if(cant==obj[pos].promo[i].cant)
						{
							$("#"+$("#cbv").val()).children("#subt").html(obj[pos].promo[i].precio);
						}	
					}
					total=0;
					$("td#subt").each(
					function()
					{
						total+=parseFloat($(this).html());
					});
					$("#total").html(total);
				}
				else
				{
					$.getJSON("producto.php?producto="+$("#cbv").val(), function(json) 
						{
							if(json.codigo!="")
							{
							obj.push(json);
							$("#listav tbody#ppv").prepend("<tr id=\""+json.codigo+"\"><td>"+json.nombre+"</td><td><input type=\"text\" size=\"3\" value=\"1\" id=\"cant\"></td><td id=\"preciov\">"+json.precio_venta+"</td><td id=\"subt\">"+(json.precio_venta*1)+"</td><td>"+json.stock+"</td><td><input type=\"button\" value=\"quitar\" id=\"quitarp\"/></td></tr>");
							}
						}).complete(function(){
					total=0;
					$("td#subt").each(
					function()
					{
						
						total+=parseFloat($(this).html());
					});$("#total").html(total);});
					
				}
				
			}
			else
			{
				$.getJSON("producto.php?producto="+$("#cbv").val(), function(json) 
						{
							if(json.codigo!="")
							{
							obj.push(json);
							$("#listav tbody#ppv").prepend("<tr id=\""+json.codigo+"\"><td>"+json.nombre+"</td><td><input type=\"text\" size=\"3\" value=\"1\" id=\"cant\"></td><td id=\"preciov\">"+json.precio_venta+"</td><td id=\"subt\">"+(json.precio_venta*1)+"</td><td>"+json.stock+"</td><td><input type=\"button\" value=\"quitar\" id=\"quitarp\"/></td></tr>");
							}
						}).complete(function(){
					total=0;
					$("td#subt").each(
					function()
					{
						
						total+=parseFloat($(this).html());
					});$("#total").html(total);});
					
			}
				e.preventDefault();
				$(this).val("");
		}
	});
	$("#quitarp").die();
	$("#quitarp").live("click",
	function()
	{
		for(var i=0;i<obj.length;i++)
		{
			if(obj[i].codigo==$(this).parents("tr").attr("id"))
			{
				obj.splice(i,1);
			}
		}
		$(this).parents("tr").remove();
		total=0;
			$("td#subt").each(
			function()
			{
						
				total+=parseFloat($(this).html());
			});
			$("#total").html(total);
			$("#cambio").html("");
			$("#efectivo").val("");
		
	});
	$("input#cant").die();
	$("input#cant").live("keyup",
	function(e)
	{
		if(!isNaN($(this).val())&&$(this).val()!="")
		{
			var pc=parseFloat($(this).parents("tr").children("#preciov").html());
			var aux=parseFloat(parseInt(($(this).val()*pc)));
			var aux2=($(this).val()*pc)-aux;
			if(aux2!=0&&aux2!=0.50)
			{
				 if(aux2>0.25&&aux2<0.50)
				{
					aux+=0.50;	
				}
				else if(aux2>0.50&&aux2<0.75)
				{
					aux+=0.50;		
				}
				else if(aux2>=0.75)
				{
					aux++;
				}
			}
			else
			{
				aux+=aux2;
			}
			$(this).parents("tr").children("#subt").html(aux);
			for(var i=0;i<obj.length;i++)
			{
				if($(this).parents("tr").attr("id")==obj[i].codigo)
				{
					agregado=true;
					pos=i;
				}
			}
			for(var i=0;i<obj[pos].promo.length;i++)
			{
				if($(this).val()==obj[pos].promo[i].cant)
				{
					$(this).parents("tr").children("#subt").html(obj[pos].promo[i].precio);
				}	
			}
			total=0;
			$("td#subt").each(
			function()
			{
						
				total+=parseFloat($(this).html());
			});
			$("#total").html(total);
			
		}
		else
		{
			$(this).val("");
			$(this).parents("tr").children("#subt").html("");
		}
	});
	$("#efectivo").keyup(function()
	{
		if(isNaN($(this).val()))
		{
			$(this).val("");
		}
		var total=parseFloat($("#total").html());
		var efectivo=parseFloat($(this).val());
		if(isNaN(efectivo-total))
		{
			$("#cambio").html("");
		}
		else
		{
		$("#cambio").html((efectivo-total));
		}
		
	});
	$("#cobrar").click(
	function()
	{
		var productos=0;
		var datos="";
		$("#listav tbody#ppv tr").each(
		function()
		{
			productos++;
			if(productos==1)
			{
				datos+="idp"+productos+"="+$(this).attr("id")+"&cant"+productos+"="+$(this).find("#cant").val();
			}
			else
			{
				datos+="&idp"+productos+"="+$(this).attr("id")+"&cant"+productos+"="+$(this).find("#cant").val();
			}
				
		});
		if(datos!=""&&$("#efectivo").val()!=""&&!isNaN($("#efectivo").val())&&parseFloat($("#cambio").html())>=0)
		{
			datos+="&monto="+$("#total").html()+"&productos="+productos+"&cliente="+cli+"&tipo="+$("#tv").val()+"&fecha="+$("#fecha").val();
			$.ajax({
   			type: "GET",
   			url: "registroVenta.php",
   			data: datos,
   			success: function(msg){
				var t="productos="+productos;
				var n=1;
				$("#ppv tr").each(
				function()
				{
					t+="&p"+n+"="+$(this).children("td:first-child").html()+"&c"+n+"="+$(this).find("#cant").val()+"&s"+n+"="+$(this).find("#subt").html();
				n++;
				});
				t+="&t="+$("#total").html()+"&e="+$("#efectivo").val()+"&c="+$("#cambio").html()+"&v="+msg;
				if(confirm("imprimir ticket"))
				{
					var v=window.open("ticket.php?"+t);
				}
				$("tbody#ppv tr").remove();
				obj.splice(0,obj.length);
				$("#tv").val("contado");
				$("#cliente").slideUp("slow");
				$("#total").html("");
				$("#efectivo").val("");
				$("#cambio").html("");
				alert("venta agregada");
				v.close();
   			}
 			}).error(function(){
				alert("Se sucito un error inesperado");
					
				});
		}
	});
	$("#cb").autocomplete({
			source: "searchCliente.php",
			minLength: 2,
			select: function( event, ui ) 
			{
				cli=ui.item.id;
			}
		});
	$("#prodb").autocomplete({
			source: "searchProducto.php",
			minLength: 2,
			select: function( event, ui ) 
			{
				var agregado=false;
				for(var i=0;i<obj.length;i++)
				{
					if(ui.item.id==obj[i].codigo)
					{
						agregado=true;
						pos=i;
					}
				}
				if(agregado)
				{
					var cant=parseFloat($("#"+ui.item.id).find("#cant").val());
					cant++;
					$("#"+ui.item.id).find("#cant").val(cant);
					var pc=parseFloat($("#"+ui.item.id).children("#preciov").html());
					$("#"+ui.item.id).children("#subt").html((cant*pc));
					for(var i=0;i<obj[pos].promo.length;i++)
					{
						if(cant==obj[pos].promo[i].cant)
						{
							$("#"+ui.item.id).children("#subt").html(obj[pos].promo[i].precio);
						}	
					}
					total=0;
					$("td#subt").each(
					function()
					{
						total+=parseFloat($(this).html());
					});
					$("#total").html(total);
					$("#prodb").val("");
				}
				else
				{
					$.getJSON("producto.php?producto="+ui.item.id, function(json) 
						{
							if(json.codigo!="")
							{
							obj.push(json);
							$("#listav tbody#ppv").prepend("<tr id=\""+json.codigo+"\"><td>"+json.nombre+"</td><td><input type=\"text\" size=\"3\" value=\"1\" id=\"cant\"></td><td id=\"preciov\">"+json.precio_venta+"</td><td id=\"subt\">"+(json.precio_venta*1)+"</td><td>"+json.stock+"</td><td><input type=\"button\" value=\"quitar\" id=\"quitarp\"/></td></tr>");
							}
						}).complete(function(){
					total=0;
					$("td#subt").each(
					function()
					{
						
						total+=parseFloat($(this).html());
					});$("#total").html(total); $("#prodb").val("");});
					
				}
			
			}
		});
		$("#cancelar").click(
		function()
		{
			$("tbody#ppv tr").remove();
				obj.splice(0,obj.length);
				$("#total").html("");
				$("#efectivo").val("");
				$("#cambio").html("");
		});
	
});
</script>
<div>

<form>

<table>


<tr>
<td>Tipo de Venta</td>
<td>
<select name="tipo" id="tv">
<option value="contado" selected="selected">Contado</option>
<option value="credito">Cr&eacute;dito</option>
</select>
</td>

</tr>
<tr>
<td>fecha</td><td><input type="text" size="10" name="fecha" id="fecha"/></td>
</tr>
<tr>

<td>Codigo de barras: </td>
<td><input type="text"  id="cbv"/></td>

</tr>
<tr>
<td>Nombre producto: </td>
<td><input type="text"  id="prodb"/></td>
</tr>
</table>

<div id="cliente">

<table>

<tr>

<td>Nombre del cliente:</td><td><input type="text" id="cb" /></td>

</tr>

</table>

</div>
<table id="listav">

<tr>
<th colspan="5">LISTA DE PRODUCTOS</th>
</tr>

<tr>

<th>Descripci&oacute;n</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th>Existencia</th>
</tr>
<tbody id="ppv">
</tbody>
<tr>
<th>TOTAL</th><td id="total"></td>
</tr>
<tr>
<th>EFECTIVO</th><td><input type="text" size="10"id="efectivo"/></td>
</tr>
<tr>
<th>CAMBIO</th><td id="cambio"></td>
</tr>
<tr>
<td colspan="4"><input type="button" value="Cobrar" id="cobrar"/><input type="button" value="cancelar" id="cancelar"/></td>
</tr>
</table>

</form>

</div>
