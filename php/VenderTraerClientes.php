<?php
   include("conectar.php"); 
   $Parametro = $_GET['term'];
      
   $link=Conectarse(); 
   
		$Consulta = "SELECT Id_Cliente, Nombre, Documento, Direccion, Telefono FROM Clientes WHERE Documento LIKE '%$Parametro%' OR Nombre LIKE '%$Parametro%';";

	$result = mysql_query($Consulta, $link);
	$row = mysql_fetch_array($result);
	$jsondata = array();
	$i = 0;
	
	class Obj 
	{
	   //propiedades de los elementos
	   var $value;
	   var $Id;
	   var $Nombre;
	   var $Documento;
	   var $Direccion;
	   var $Telefono;
 	   //constructor que recibe los datos para inicializar los elementos
	   function __construct($value, $Id, $Nombre, $Documento, $Direccion, $Telefono)
	   {
	      $this->value = $value;
	      $this->Id = $Id;
	      $this->Nombre = $Nombre;
	      $this->Documento = $Documento;
	      $this->Direccion = $Direccion;
	      $this->Telefono = $Telefono;
	   }
	}
		do 
		{
			array_push($jsondata, new Obj(utf8_encode($row["Nombre"]), $row["Id_Cliente"], $row["Nombre"], $row["Documento"], $row["Direccion"], $row["Telefono"]));	 
		} while($row = mysql_fetch_array($result));

	echo json_encode($jsondata);
	mysql_free_result($result); 
	mysql_close($link); 
?>
