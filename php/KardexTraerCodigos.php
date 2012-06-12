<?php
   include("conectar.php"); 
   $Parametro = $_GET['term'];
      
   $link=Conectarse(); 
   
		$Consulta = "SELECT Codigo, Nombre FROM Productos WHERE Codigo LIKE '%$Parametro%' OR Nombre LIKE '%$Parametro%';";

	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
	$jsondata = array();
	$i = 0;
		do 
		{
			array_push($jsondata, $row["Codigo"]);	 
			array_push($jsondata, $row["Nombre"]);	 
		} while($row = mysql_fetch_array($result));

	echo json_encode($jsondata);
	mysql_free_result($result); 
	mysql_close($link); 
?>
