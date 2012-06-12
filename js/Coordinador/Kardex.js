$(document).on("ready", arranque);
function arranque()
{
	$("#btnKardexEditar").live("click", btnKardexEditar_Click);
	$("#KardexIngresarCantidad").live("submit", KardexIngresarCantidad_Submit);
	$("#KardexListar").live("submit", KardexListar_Submit);
	$("#btnKardexIngresarCantidadReset").live("click", KardexListar_Reset);
	$("#txtKardexIngresarCantidadCosto").live("blur", txtKardexIngresarCantidadCosto_Change)
	
	$("#txtKardexParametro").autocomplete({
		    source: "php/KardexTraerCodigos.php"
	});

}
function btnKardexEditar_Click()
{
	var index = parseInt($(this).attr("name")) + 1;
	var fila = document.getElementById("TablaKardex").rows[0].innerHTML;	
	fila = 	"<TABLE BORDER=0 CELLSPACING=4 CELLPADDING=5 id='TablaKardexCantidad'>" +
				"<TR>" + fila + "</TR>" + 
				"<TR>" + document.getElementById("TablaKardex").rows[index].innerHTML + "</TR>" +
			"</TABLE>";
	$("#artKardexListar").html(fila);
	$("#KardexIngresarCantidad").slideDown();
	$("#txtKardexIngresarCantidadCosto").val(parseFloat(document.getElementById("tdTablaKardexCosto").innerHTML.replace(".", "")));
	$("#txtKardexIngresarCantidadPrecio").val(parseFloat(document.getElementById("tdTablaKardexPrecio").innerHTML.replace(".", "")));
	$("#cboParametro").val("Codigo");
	$("#txtKardexParametro").val(document.getElementById("btnKardexEditar").value);
}
function KardexListar_Submit(evento)
{
	evento.preventDefault();
	$.post("php/KardexTraerProductos.php",  
		{
			Parametro: $("#cboParametro").val(), 
			Valor: $("#txtKardexParametro").val(),
			Orden: $("#cboOrden").val()
		}, 
		function(data)
		{	
			if (data)
			{
				$("#artKardexListar").html(data);
			}
	});	
}
function KardexListar_Reset()
{
	$("#KardexIngresarCantidad").slideUp();
}

function KardexIngresarCantidad_Submit(evento)
{
	evento.preventDefault();
	var Cantidad_ = document.getElementById("tdTablaKardexCantidad").innerHTML;
	Cantidad = parseInt(Cantidad_) + parseInt($("#txtKardexIngresarCantidad").val());
	var Id = document.getElementById("btnKardexEditar");
	$.post("php/KardexIngresarCantidad.php",  
	{
		Id_Producto: Id.value, 
		Cantidad_Ingresada: $("#txtKardexIngresarCantidad").val(),
		Cantidad_Nueva: Cantidad,
		CostoActual: document.getElementById("tdTablaKardexCosto").innerHTML,
		Costo: $("#txtKardexIngresarCantidadCosto").val(),
		Precio: $("#txtKardexIngresarCantidadPrecio").val()
	});
	$("#KardexEstadoCantidad").text("Se Ingresaron " + $("#txtKardexIngresarCantidad").val()).fadeIn(100).delay(1600).fadeOut(1200);
	KardexListar_Submit(evento);
}
function txtKardexIngresarCantidadCosto_Change()
{
		//var PorcentajeGanancia = (parseFloat(document.getElementById("tdTablaKardexPrecio").innerHTML)/(parseFloat(document.getElementById("tdTablaKardexCosto").innerHTML)))/100;
		var Precio = parseFloat(document.getElementById("tdTablaKardexPrecio").innerHTML);
		var Costo = parseFloat(document.getElementById("tdTablaKardexCosto").innerHTML);
		var PorcentajeGanancia =  ((Precio * 100)/Costo)/100;
		Precio = parseFloat($("#txtKardexIngresarCantidadCosto").val()) * PorcentajeGanancia;
		$("#txtKardexIngresarCantidadPrecio").val(Precio);
}

