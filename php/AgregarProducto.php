<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
   $Codigo = $_POST['Codigo'];
   $Nombre = $_POST['Nombre'];
   $Descripcion = $_POST['Descripcion'];
   $Costo = $_POST['Costo'];
   $PrecioVenta = $_POST['PrecioVenta'];
   $Iva = $_POST['Iva'];
   mysql_query("INSERT INTO Productos(Codigo, Nombre, Descripcion, Costo, PrecioVenta, Iva) VALUES('" . 
   $Codigo .  "', '"  .
   $Nombre .   "', '"  .
   $Descripcion .   "', '" . 
   $Costo .   "', '" . 
   $PrecioVenta .   "', '" . 
   $Iva .  
		"');",$link); 
   $Id = mysql_insert_id(); 
	if ($Id == 0)
	{	
		$result = mysql_query("SELECT Id FROM Productos WHERE Nombre = '$Nombre' OR Codigo = '$Codigo';",$link); 
		$row = mysql_fetch_array($result);
		if ($row)
		{$Id = "El Producto ya Existe";}
		else
		{$Id = "Hay un error en los datos Ingresados";}
	}else
	{
		   mysql_query("INSERT INTO kardex(Id_Producto, Fecha) VALUES('" . 
				$Id .  "', '"  .
				date('Y-m-d')  .  
				"');",$link); 		
		$Id = "Se creó el Producto con Id: " . $Id;
	}
   echo $Id;
?>

