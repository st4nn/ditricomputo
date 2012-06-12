<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
	$Codigo = $_POST['Codigo'];
	$Nombre = $_POST['Nombre'];
	
	$Consulta = "DELETE FROM Productos WHERE Codigo = '$Codigo' AND Nombre ='$Nombre';";
   
	mysql_query($Consulta, $link);
?>
