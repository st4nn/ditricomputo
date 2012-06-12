<?php 
	include("conectar.php"); 
	
function DatosCliente($IdFactura)
{   
	$link=Conectarse(); 
	class Cliente
	{
		public $Id;
		public $Id_Factura;
		public $Nombre;
		public $Documento;
		public $Telefono;
		public $Direccion;
	}

	$Consulta = "SELECT * FROM Facturas WHERE Id_Factura = '$IdFactura';";
	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
	
	$Consulta = "SELECT Nombre AS 'Nombre', 
						Documento AS 'Documento', 
						Direccion AS 'Direccion', 
						Telefono AS 'Telefono' 
				FROM Clientes WHERE Id_Cliente = '" . $row['Id_Cliente'] . "';";

	$resultCliente = mysql_query($Consulta, $link);
	$rowCliente = mysql_fetch_array($resultCliente);
	
	$Cliente = new Cliente();
		$Cliente->Nombre = $rowCliente['Nombre'];
		$Cliente->Documento = $rowCliente['Documento'];
		$Cliente->Direccion = $rowCliente['Direccion'];
		$Cliente->Telefono = $rowCliente['Telefono'];
		
		$Cliente->Id_Factura = $IdFactura;
return $Cliente;
//$Cliente = new Cliente($row['Id_Cliente'], $rowCliente['Nombre'], $rowCliente['Documento'], $rowCliente['Direccion'], $rowCliente['Telefono']);
}
function TraerProductos($IdFactura)
{
	$link=Conectarse(); 	
	$Consulta = "SELECT Articulo, Cantidad, PrecioUnitario FROM Facturas WHERE Id_Factura = '$IdFactura';";
	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
		class Producto
	{
		public $Articulo;
		public $Cantidad;
		public $PrecioUnitario;
	}
	$Productos = new Producto();
	$Index = 0;
	do 
	{ 
		$Productos->Articulo[$Index] = $row['Articulo'];
		$Productos->Cantidad[$Index] = $row['Cantidad'];
		$Productos->PrecioUnitario[$Index] = $row['PrecioUnitario'];
		$Index++;
	} while($row = mysql_fetch_array($result));
	return $Productos;
}
?>
