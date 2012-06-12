<?php
   include("conectar.php"); 

   $link=Conectarse(); 

	$Parametro = $_POST['Parametro'];
	$Valor = $_POST['Valor'];
	$Orden = $_POST['Orden'];
	$Condicion;
	if ($Parametro == "Codigo" OR $Parametro == "Nombre" )
	{
			$Condicion = "$Parametro LIKE '%" . $Valor . "%'";
			$Parametro = "p.$Parametro";
	}
	if ($Parametro == "Cantidad" OR $Parametro == "Costo" OR $Parametro == "PrecioVenta")
	{	
		if ($Parametro == "Cantidad")
		{	
			$Parametro = "k.$Parametro";
		}
		else 
		{	
			$Parametro = "p.$Parametro";
		}
		if (is_numeric($Valor))
		{
			$Condicion = "$Parametro = '" . $Valor . "'";
		} else
		{
			$Condicion = "$Parametro $Valor";
		}
	}
	
	if (!$Valor)	
	{
		$Condicion = "1=1";
	}

		$Consulta = "SELECT 
			p.Id as 'Id', 
			p.Codigo As 'Codigo' ,
			p.Nombre As 'Nombre',
			p.Costo as 'Costo',
			p.PrecioVenta as 'Precio de Venta',
			k.Cantidad as 'Cantidad'
			FROM `kardex` as k, Productos as p
			WHERE p.Id = k.Id_Producto AND $Condicion 
			ORDER BY $Parametro $Orden;";
			
	$result = mysql_query($Consulta, $link);
	if ($result)
	{
$row = mysql_fetch_array($result);

	$tabla = "<TABLE BORDER=0 CELLSPACING=4 CELLPADDING=5 id='TablaKardex'>
		<TR>
			<TH width='10%'>Codigo</TH>
			<TH>Nombre</TH>
			<TH width='5%'>Costo</TH>
			<TH width='5%'>Precio</TH>
			<TH width='5%'>Cantidad</TH>
			<TH width='2%'></TH>
		</TR>";	
	$index = 0;
		do 
		{ 
		$tabla = $tabla . 
		"<TR>" .
			"<td>" . $row['Codigo'] . "</td>" .
			"<td>" . $row['Nombre'] . "</td>" .
			"<td id ='tdTablaKardexCosto'>" . number_format($row['Costo'], 0, '', '.') . "</td>" .
			"<td id ='tdTablaKardexPrecio'>" . number_format($row['Precio de Venta'], 0, '', '.') . "</td>" .
			"<td id ='tdTablaKardexCantidad'>" . $row['Cantidad'] . "</td>" .
			"<td><button id='btnKardexEditar' name='$index' value=" . $row['Id'] . ">√</button></td>" .			
		"</TR>";
		$index++;
		} while($row = mysql_fetch_array($result));

		echo $tabla . "</TABLE>";
		//echo $Consulta;
	mysql_free_result($result); 
	mysql_close($link); 
	}
?>
