var IndexProducto = 0;
$(document).on("ready", arranque);
function arranque()
{
	$("#btnVenderGuardarFactura").live("click", btnVenderGuardarFactura_Click);
	$("#btnVenderEliminarProducto").live("click", QuitarProducto);
	$("#frmAgregarProductos").live("submit", frmAgregarProductos_Submit);
	$("#frmCliente").live("reset", frmCliente_Reset);
	$("#frmCliente").live("submit", frmCliente_Submit);
	$("#txtVenderClienteNombre").live("change", txtVenderClienteNombre_Change);
	$("#txtVenderTablaArticulo").live("change", CalcularSubtotal);
	$("#txtVenderTablaCantidad").live("change", CalcularSubtotal);
	$("#txtVenderTablaPrecio").live("change", CalcularSubtotal);
	
	
	$.post("php/VenderTraerNumeroFactura.php",
		function(data)
		{	
			if (data)
			{
				$("#NoFactura span").text(data);
			}
		}
	);	
	
	$("#txtVenderNombreProducto").autocomplete({
		    source: "php/VenderTraerProductos.php",
			select: function(event, ui) 
					{
						AgregarProducto(ui.item.value, ui.item.Precio);	
					}
	});	
	
	$("#txtVenderClienteNombre").autocomplete({
		    source: "php/VenderTraerClientes.php",
			select: function(event, ui) 
					{
						$("#VenderCodigoCliente span").text(ui.item.Id);
						$("#txtVenderClienteNombre").val(ui.item.Nombre);
						$("#txtVenderClienteDocumento").val(ui.item.Documento);
						$("#txtVenderClienteTelefono").val(ui.item.Telefono);
						$("#txtVenderClienteDireccion").val(ui.item.Direccion);
						ActualizarClienteFactura();
					},
			search: function(event, ui) {$("#VenderCodigoCliente span").text('Cliente no Registrado');}
	});	
}
function ActualizarClienteFactura()
{
	if (parseInt($("#VenderCodigoCliente span").text()))
	{
		$.post("php/VenderFacturarActualizarCliente.php",  
		{
			Id_Cliente: parseInt($("#VenderCodigoCliente span").text()),
			NoFactura:  parseInt($("#NoFactura span").text())
		});
	}
}
function AgregarProducto(Articulo, PrecioUnitario)
{
	var tds = "<tr id='" + IndexProducto + "'>";
		  tds += "<td><input class='txtTabla' id='txtVenderTablaArticulo' name='" + IndexProducto + "' type='text' value ='" + Articulo + "'/></td>";
		  tds += "<td><input class='txtTabla' id='txtVenderTablaCantidad' name='" + IndexProducto + "' type='number' value ='" + 1 + "'/></td>";
		  tds += "<td><input class='txtTabla' id='txtVenderTablaPrecio' name='" + IndexProducto + "' type='number' value ='" + PrecioUnitario + "'/></td>";
		  tds += "<td id='txtVenderTablaSubtotal' name='" + IndexProducto + "'>" + PrecioUnitario + "</td>";
		  tds += "<td><input id='btnVenderEliminarProducto' src='Diseno/Imagenes/delete.png' type='image' /></td>";
		tds += '</tr>';		
	$("#TablaVenderProductos").append(tds);
		var IdCliente = 0;
		if (parseInt($("#VenderCodigoCliente span").text()))
		{IdCliente = parseInt($("#VenderCodigoCliente span").text());}

		$.post("php/VenderFacturarProducto.php",  
		{
			Id_Cliente: IdCliente, 
			NoFactura: $("#NoFactura span").text(),
			Articulo: Articulo,
			Cantidad: 1,
			PrecioUnitario: PrecioUnitario,
			IdLlegada: IndexProducto
		});
	IndexProducto++;
	CalcularTotal();
}
function btnVenderGuardarFactura_Click()
{	
	var data = $("#NoFactura span").text();
	window.open('php/Factura.php?IdFactura=' + data);
}
function CalcularSubtotal()
{
	var obj = $(this).parent("td").parent("tr");
	var strObj = $(obj).attr("id");
	Fila = document.getElementsByName(strObj);
	$(Fila[3]).text(parseFloat($(Fila[1]).val()) * parseFloat($(Fila[2]).val()));
	var IdCliente = 0;
		if (parseInt($("#VenderCodigoCliente span").text()))
		{IdCliente = parseInt($("#VenderCodigoCliente span").text());}
		
	$.post("php/VenderFacturarActualizarProducto.php",  
		{
			Id_Cliente: IdCliente, 
			NoFactura: $("#NoFactura span").text(),
			Articulo: $(Fila[0]).val(),
			Cantidad: $(Fila[1]).val(),
			PrecioUnitario: $(Fila[2]).val(),
			IdLlegada: strObj
		});
	CalcularTotal();
}
function CalcularTotal()
{
	var obj = document.getElementById("TablaVenderProductos");
	var Total = 0;
	$.each(obj.rows, function(key, value) 
	{ 
		if (parseFloat(value.cells[3].innerHTML))
		{
			Total += parseFloat(value.cells[3].innerHTML);
		}
	}
	);
	$("#VenderTotal span").text(Total);
}
function frmAgregarProductos_Submit(evento)
{
	evento.preventDefault();
	AgregarProducto('', '0');
}
function frmCliente_Reset()
{
	$("#VenderCodigoCliente span").text('Cliente no Registrado');			
}
function frmCliente_Submit(evento)
{
	evento.preventDefault();
	if ($("#VenderCodigoCliente span").text() == 'Cliente no Registrado')
	{
		$.post("php/AgregarCliente.php",  
		{
			Nombre: $("#txtVenderClienteNombre").val(),
			Documento: $("#txtVenderClienteDocumento").val(),
			Direccion: $("#txtVenderClienteDireccion").val(),
			Telefono: $("#txtVenderClienteTelefono").val()
		}, function(data)
		{
			$("#VenderCodigoCliente span").text(data);
		}
		);
		ActualizarClienteFactura();
	}
}
function ObtenerTotal()
{
	var Articulos = document.getElementsByName("txtVenderTablaArticulo");
	var Cantidades = document.getElementsByName("txtVenderTablaCantidad");
	var PreciosUnitarios = document.getElementsByName("txtVenderTablaPrecio");	
	var Subtotales = document.getElementsByName("txtVenderTablaSubtotal");	
}
function QuitarProducto()
{
	var Index = $(this).parent("td").parent("tr").attr("id");
	$(this).parent("td").parent("tr").remove();
	
	$.post("php/VenderFacturarQuitarProducto.php",  
		{
			NoFactura: $("#NoFactura span").text(),
			IdLlegada: Index
		});	
	CalcularTotal();
}
function txtVenderClienteNombre_Change()
{
	$("#VenderCodigoCliente span").text('Cliente no Registrado');		
}
