<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
	$Codigo = $_POST['Codigo'];
	$Nombre = $_POST['Nombre'];
	$Costo = $_POST['Costo'];
	$PrecioVenta = $_POST['PrecioVenta'];
	$Iva = $_POST['Iva'];
	
	$Consulta = "UPDATE Productos SET 
		Nombre = '$Nombre', 
		Costo = '$Costo', 
		PrecioVenta = '$PrecioVenta',
		Iva = '$Iva' 
			WHERE Codigo = '$Codigo';";
   
	mysql_query($Consulta, $link);
?>
