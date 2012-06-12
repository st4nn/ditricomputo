<?php
   include("conectar.php"); 
   $Parametro = $_GET['term'];
      
   $link=Conectarse(); 
   
		$Consulta = "SELECT Id, Codigo, Nombre, PrecioVenta FROM Productos WHERE Codigo LIKE '%$Parametro%' OR Nombre LIKE '%$Parametro%';";

	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
	$jsondata = array();
	$i = 0;
	
	class Obj 
	{
	   //propiedades de los elementos
	   var $value;
	   var $label;
	   var $Precio;
	   var $Codigo;
 	   //constructor que recibe los datos para inicializar los elementos
	   function __construct($label, $value, $Precio, $Codigo)
	   {
	      $this->label = $label;
	      $this->value = $value;
	      $this->Precio = $Precio;
	      $this->Codigo = $Codigo;
	   }
	}
	   
		do 
		{
			array_push($jsondata, new Obj(utf8_encode($row["Nombre"]), $row["Nombre"], $row["PrecioVenta"], $row["Codigo"]));	 
		} while($row = mysql_fetch_array($result));

	echo json_encode($jsondata);
	mysql_free_result($result); 
	mysql_close($link); 
?>
