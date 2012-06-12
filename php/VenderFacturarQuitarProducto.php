<?php
   include("conectar.php"); 
	$NoFactura = $_POST['NoFactura'];
	$IdLlegada = $_POST['IdLlegada'];
   $link=Conectarse(); 
   
	$Consulta = "DELETE FROM Facturas 
				WHERE Id_Llegada = '$IdLlegada' AND Id_Factura = '$NoFactura';";

	$result = mysql_query($Consulta, $link);
	mysql_close($link); 
?>
