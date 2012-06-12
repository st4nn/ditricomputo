<?php
   include("conectar.php"); 
	$Id_Cliente = $_POST['Id_Cliente'];
	$NoFactura = $_POST['NoFactura'];
   $link=Conectarse(); 
   
	$Consulta = "UPDATE Facturas SET
				Id_Cliente = '$Id_Cliente'
				WHERE Id_Factura = '$NoFactura';";

	$result = mysql_query($Consulta, $link);
	mysql_close($link); 
?>
