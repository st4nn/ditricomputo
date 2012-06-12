<?php
   include("TraerDatosFactura.php"); 

$Productos = TraerProductos(11);
	$Articulos = $Productos->Articulo;
	$Cantidades = $Productos->Cantidad;
	$Precios = $Productos->PrecioUnitario;

	for($i=0;$i<sizeof($Articulos);$i++)
	{
		echo "Articulo: " . $Articulos[$i] . "</br>";
		echo "Cantidad: " . $Cantidades[$i] . "</br>";
		echo "Precio: " . $Precios[$i] . "</br>";
	echo "</br>";
	}

?>
