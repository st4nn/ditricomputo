$(document).on("ready", arranque);
function arranque()
{
	$("#btnAgregar").live("click", btnAgregar_Click);	
	$("#btnInventarioEditar").live("click", btnInventarioEditar_Click);
	$("#btnInventarioEliminar").live("click", btnInventarioEliminar_Click);
	$("#btnVer").live("click", btnVer_Click);
	$("#InventarioAgregar").live("submit", InventarioIngresar_Submit);
	$("#InventarioVer").live("submit", InventarioVer_Submit);
}
function btnAgregar_Click()
{
	$("#InventarioAgregar").slideDown();
	$("#InventarioVer").slideUp();
}
function btnInventarioEditar_Click(evento)
{
	evento.preventDefault();
	var fila = document.getElementsByName($(this).attr("name"));
	$.post("php/ProductoActualizar.php",  
	{ 
		Codigo: fila[0].value,
		Nombre: fila[1].value,
		Costo: fila[2].value,
		PrecioVenta: fila[3].value,
		Iva: fila[4].checked
	}, function()
	{
		InventarioVer_Submit(evento);
	}
	);
}
function btnInventarioEliminar_Click(evento)
{
	evento.preventDefault();
	var fila = document.getElementsByName($(this).attr("name"));
	$.post("php/ProductoBorrar.php",  
	{ 
		Codigo: fila[0].value,
		Nombre: fila[1].value
	}, function()
	{
		InventarioVer_Submit(evento);
	}
	);
}
function btnVer_Click()
{
	$("#InventarioVer").slideDown();
	$("#InventarioAgregar").slideUp();
}
function InventarioIngresar_Submit(evento)
{
	evento.preventDefault();
	var conIva = $("#chkInventarioIva").is(':checked');
	alert(conIva);
	$.post("php/AgregarProducto.php",  
	{ 
		Codigo: $("#txtInventarioCodigo").val(), 
		Nombre: $("#txtInventarioNombre").val(), 
		Descripcion: $("#txtInventarioDescripcion").val(), 
		Costo: $("#txtInventarioCosto").val(), 
		PrecioVenta: $("#txtInventarioPrecioVenta").val(),
		Iva: conIva
	}, function(data)
	{
		if (data)
		{
			$("#InventarioEstadoAgregar").text(data).fadeIn(200).delay(1200).fadeOut(800);
			alert(data);
		}else
		{		
			alert("No Se creó el Producto");			
		}
	}
	);
}
function InventarioVer_Submit(evento)
{
	evento.preventDefault();
	$.post("php/ProductoVer.php",  
	{ 
		Parametro: $("#txtInventarioParametro").val()
	}, function(data)
	{
		if (data)
		{
			$("#InventarioVerProductos").html(data);
		}
	}
	);
}
