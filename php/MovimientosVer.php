<?php
	
   include("conectar.php"); 

   $link=Conectarse(); 

	$Parametro = $_POST['Parametro'];
	$Valor = $_POST['Valor'];
	$Fecha = $_POST['Fecha'];
	$FechaHasta = $_POST['FechaHasta'];
	$Orden = $_POST['Orden'];
	$Condicion;
	if ($Parametro == "Codigo" OR $Parametro == "Nombre" )
	{
			$Condicion = "$Parametro LIKE '%" . $Valor . "%'";
			$Parametro = "p.$Parametro";
	}
	if ($Parametro == "Fecha")
	{	
		$Condicion = "m.Fecha BETWEEN '$Fecha' AND '$FechaHasta'";
	}
	
	if (!$Valor)	
	{
		$Condicion = "1=1";
	}

		$Consulta = "SELECT 
			p.Id as 'Id', 
			p.Codigo As 'Codigo' ,
			p.Nombre As 'Nombre',
			p.Costo as 'Costo Actual',
			p.PrecioVenta as 'Precio de Venta',
			m.Valor_Ingresado as 'Cantidad',
			m.Costo as 'Costo Llegada',
			m.Fecha as 'Fecha'
			FROM `Movimientos` as m, Productos as p
			WHERE p.Id = m.Id_Producto AND $Condicion 
			ORDER BY m.Fecha $Orden;";
			
	$result = mysql_query($Consulta, $link);
	if ($result)
	{
$row = mysql_fetch_array($result);

	$tabla = "<TABLE BORDER=0 CELLSPACING=4 CELLPADDING=5 id='TablaKardex'>
		<TR>
			<TH width='10%'>Codigo</TH>
			<TH>Nombre</TH>
			<TH width='5%'>Costo Actual</TH>
			<TH width='5%'>Precio Venta</TH>
			<TH width='5%'>Cantidad Ingresada</TH>
			<TH width='5%'>Costo Ingreso</TH>
			<TH width='5%'>Fecha</TH>
		</TR>";	
	$index = 0;
		do 
		{ 
		$tabla = $tabla . 
		"<TR>" .
			"<td>" . $row['Codigo'] . "</td>" .
			"<td>" . $row['Nombre'] . "</td>" .
			"<td id ='tdTablaMovimientosCosto'>" . number_format($row['Costo Actual'], 0, '', '.') . "</td>" .
			"<td id ='tdTablaMovimientosPrecio'>" . number_format($row['Precio de Venta'], 0, '', '.') . "</td>" .
			"<td id ='tdTablaMovimientosCantidad'>" . $row['Cantidad'] . "</td>" .
			"<td id ='tdTablaMovimientosCosto'>" . number_format($row['Costo Llegada'], 0, '', '.') . "</td>" .
			"<td>" . $row['Fecha'] . "</td>" .
		"</TR>";
		$index++;
		} while($row = mysql_fetch_array($result));

		echo $tabla . "</TABLE>";
		//echo $Consulta;
	mysql_free_result($result); 
	mysql_close($link); 
	}
?>
