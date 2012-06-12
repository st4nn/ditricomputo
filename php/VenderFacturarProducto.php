<?php
   include("conectar.php"); 
	$Id_Cliente = $_POST['Id_Cliente'];
	$NoFactura = $_POST['NoFactura'];
	$Articulo = $_POST['Articulo'];
	$Cantidad = $_POST['Cantidad'];
	$PrecioUnitario = $_POST['PrecioUnitario'];
	$IdLlegada = $_POST['IdLlegada'];
   $link=Conectarse(); 
   
	$Consulta = 	"INSERT INTO Facturas(Id_Factura, Id_Cliente, Articulo, Cantidad, PrecioUnitario, Id_Llegada)
				VALUES(
				'$NoFactura',
				'$Id_Cliente',
				'$Articulo',
				'$Cantidad',
				'$PrecioUnitario',
				'$IdLlegada'
				);";

	$result = mysql_query($Consulta, $link);
	mysql_close($link); 
?>
