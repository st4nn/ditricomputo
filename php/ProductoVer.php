<?php
   include("conectar.php"); 
   $link=Conectarse(); 
   
	$Parametro = $_POST['Parametro'];
	if ($Parametro)
	{	
		$Consulta = "SELECT Codigo, Nombre, Descripcion, Costo, PrecioVenta, Iva FROM Productos WHERE Codigo LIKE '" . $Parametro . 					"' OR Nombre LIKE '" . $Parametro . "';";
	}
	else {$Consulta = "SELECT Codigo, Nombre, Descripcion, Costo, PrecioVenta, Iva FROM Productos;";}
   
	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
		$tabla = "<TABLE BORDER=0 CELLSPACING=4 CELLPADDING=5><TR><TH width='10%'>Codigo</TH><TH>Nombre</TH><TH width='5%'>Costo</TH><TH width='5%'>Precio de Venta</TH><TH width='5%'>Iva</TH><TH></TH><TH></TH></TR>";	
		do 
		{ 
			if ($row['Iva'] == "true")
			{$checked = "checked";}
			else{$checked = "";}
			$tabla = $tabla . "<TR>" .
				"<td><input id='txtInventarioTablaCodigo' name='" . $row['Codigo'] . "' class='txtTabla' type='text' value='" . $row['Codigo'] . "'/></td>" .
				"<td><input id='txtInventarioTablaNombre' name='" . $row['Codigo'] . "' class='txtTabla' type='text' value='" . $row['Nombre'] . "' /></td>" .
				"<td><input id='txtInventarioTablaCosto' name='" . $row['Codigo'] . "' class='txtTabla' type='number' value='" . $row['Costo'] . "' /></td>" .
				"<td><input id='txtInventarioTablaPrecioVenta' name='" . $row['Codigo'] . "' class='txtTabla' type='number' value='" . $row['PrecioVenta'] . "' /></td>" .
				"<td><input id='txtInventarioTablaIva' name='" . $row['Codigo'] . "' class='txtTabla' type='checkbox' $checked /></td>" .
				"<td><button id='btnInventarioEditar' name='" . $row['Codigo']  . "'>√</button></td>" .			
				"<td><button id='btnInventarioEliminar'  name='" . $row['Codigo']  . "'>✗</button></td>" .
			"</TR>";
		} while($row = mysql_fetch_array($result));

		echo $tabla . "</TABLE>";
?>
