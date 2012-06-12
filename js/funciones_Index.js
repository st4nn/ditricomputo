$(document).on("ready", arranque);
function arranque()
{
	$("#Login").load("login.html");	
	$("#Usuario").live("submit", formulario_Submit);
}
function formulario_Submit(evento)
{
	evento.preventDefault();  	
	$.post("php/ValidarUsuario.php",  
		{
			Usuario: $("#txtUsuario").val(), 
			Clave: $("#txtClave").val()
		}, 
		function(data)
		{	
alert(data);
			if (data.Rol == "Acceso Denegado")
			{
				$("#txtClave").val("");
				$("#EstadoLogin").text(data.Rol).delay(1600).fadeOut(1200);
			}
			else
			{
				localStorage.setItem("Usuario", data);			
				window.location.replace("Coordinador.html");
			}
		}, 
		"json");		
}
