<?php
   include("conectar.php"); 
         
   $link=Conectarse(); 
   
		$Consulta = "SELECT max(Id_Factura) as 'Id_Factura' FROM Facturas";

	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
	$Consulta = $row['Id_Factura'] + 1;	 
	echo $Consulta;
	mysql_free_result($result); 
	mysql_close($link); 
?>
