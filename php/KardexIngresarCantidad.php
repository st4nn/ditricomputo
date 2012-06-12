<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
   $Id_Producto = $_POST['Id_Producto'];
   $Cantidad_I = $_POST['Cantidad_Ingresada'];   
   $Cantidad = $_POST['Cantidad_Nueva'];
   $CostoActual = $_POST['CostoActual'];
   $Costo = $_POST['Costo'];
   $Precio = $_POST['Precio'];
   
   mysql_query("UPDATE kardex SET Cantidad = '$Cantidad' WHERE Id_Producto = '$Id_Producto';",$link); 
   mysql_query("UPDATE Productos SET Costo = '$Costo', PrecioVenta = '$Precio' WHERE Id = '$Id_Producto';",$link); 
   mysql_query("INSERT INTO Movimientos(Id_Producto, Valor_Ingresado, Costo, Fecha) VALUES('" . 
				$Id_Producto .  "', '"  .
				$Cantidad_I .  "', '"  .
				$Costo .  "', '"  .
				date('Y-m-d')  .  
				"');",$link); 		
   echo $Id;
?>
