<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
   $Nombre = $_POST['Nombre'];
   $Documento = $_POST['Documento'];
   $Direccion = $_POST['Direccion'];
   $Telefono = $_POST['Telefono'];
   
   $Cadena = "INSERT INTO Clientes(Nombre, Documento, Direccion, Telefono) VALUES('" . 
   $Nombre .   "', '"  .
   $Documento .   "', '" . 
   $Direccion .   "', '" . 
   $Telefono .   
		"');";
   mysql_query($Cadena,$link); 
   $Id = mysql_insert_id(); 
	if ($Id == 0)
	{	
		$result = mysql_query("SELECT Id_Cliente FROM Clientes WHERE Nombre = '$Nombre' OR Documento = '$Documento';",$link); 
		$row = mysql_fetch_array($result);
		if ($row)
		{$Id = $row['Id_Cliente'];}
		else
		{$Id = "Hay un error en los datos Ingresados";}
	}
   echo $Id;
?>
