<?php
   include("conectar.php"); 
	$Id_Cliente = $_POST['Id_Cliente'];
	$NoFactura = $_POST['NoFactura'];
	$Articulo = $_POST['Articulo'];
	$Cantidad = $_POST['Cantidad'];
	$PrecioUnitario = $_POST['PrecioUnitario'];
	$IdLlegada = $_POST['IdLlegada'];
   $link=Conectarse(); 
   
	$Consulta = "UPDATE Facturas SET
				Id_Cliente = '$Id_Cliente',
				Articulo = '$Articulo',
				Cantidad = '$Cantidad',
				PrecioUnitario = '$PrecioUnitario' 
				WHERE Id_Llegada = '$IdLlegada' AND Id_Factura = '$NoFactura';";

	$result = mysql_query($Consulta, $link);
	mysql_close($link); 
?>
