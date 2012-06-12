$(document).on("ready", arranque);
function arranque()
{
	if (localStorage.Usuario)
	{
		var Usuario = localStorage.Usuario;
		$("#btnCerrarSesion").on("click", btnCerrarSesion_Click);
		$("#btnInventario").on("click", btnInventario_Click);
		$("#btnKardex").on("click", btnKardex_Click);
		$("#btnMovimientos").on("click", btnMovimientos_Click);
		$("#btnVender").on("click", btnVender_Click);
	}
	else
	{	
		btnCerrarSesion_Click();
	}
}

function btnCerrarSesion_Click()
{
	delete localStorage.Usuario;
	window.location.replace("index.html");
}
function btnInventario_Click()
{
		OcultarSection();
		$("#Inventario").slideDown();
}
function btnKardex_Click()
{
		OcultarSection();
		$("#Kardex").slideDown();
}
function btnMovimientos_Click()
{
		OcultarSection();
		$("#Movimientos").slideDown();
}
function btnVender_Click()
{
		OcultarSection();
		$("#Vender").slideDown();
}
function OcultarSection()
{
		$("#Inventario").slideUp();
		$("#Kardex").slideUp();
		$("#Movimientos").slideUp();
		$("#Vender").slideUp();
}
