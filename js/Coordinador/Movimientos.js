$(document).on("ready", arranque);
function arranque()
{
	$("#cboMovimientosParametro").on("change", cboMovimientosParametro_Change);
	$("#txtFecha").on("change", txtFecha_Change);
	$("#txtFechaH").on("change", txtFecha_Change);
	$("#MovimientosListar").on("submit", MovimientosListar_Submit);

	$("#txtFecha").datepicker();
	$("#txtFechaH").datepicker();
}
function cboMovimientosParametro_Change()
{
		if ($("#cboMovimientosParametro").val() == "Fecha")
		{
				$("#txtFecha").css("display", "inline");
				$("#txtFechaH").css("display", "inline");
				$("#txtMovimientosParametro").css("display", "none");
		}
		else
		{
			$("#txtFecha").css("display", "none");
			$("#txtFechaH").css("display", "none");
			$("#txtMovimientosParametro").css("display", "inline");
		}
}
function MovimientosListar_Submit(evento)
{
	evento.preventDefault();
	$.post("php/MovimientosVer.php",  
		{
			Parametro: $("#cboMovimientosParametro").val(), 
			Valor: $("#txtMovimientosParametro").val(),
			Fecha: $("#txtFecha").val(),
			FechaHasta: $("#txtFechaH").val(),
			Orden: $("#cboOrden").val()
		}, 
		function(data)
		{	
			if (data)
			{
				$("#artMovimientosListar").html(data);
			}
	});		
}
function txtFecha_Change()
{
		var FechaFormato = $(this).val().split('/');
		$(this).val(FechaFormato[2] + "-" + FechaFormato[0] + "-" + FechaFormato[1]);
}
