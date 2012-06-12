<?php 
   include("conectar.php"); 
$User = $_POST['Usuario'];
$Clave = md5($_POST['Clave']);

class Datos_Usuario
{
 public $Id;
 public $Usuario; 
 public $Nombre;
 public $Apellido;
 public $Rol;
}
	$Datos_Usuario = new Datos_Usuario();
	$link=Conectarse(); 
	$result=mysql_query("SELECT Id, Nombre, Apellido, Rol FROM usuarios WHERE Usuario = '$User' AND Clave = '$Clave';", $link); 

$row = mysql_fetch_array($result);

if ($row)
{
	$Datos_Usuario->Id = $row["Id"];
	$Datos_Usuario->Usuario = $User;
	$Datos_Usuario->Nombre = $row["Nombre"];
	$Datos_Usuario->Apellido = $row["Apellido"];
	$Datos_Usuario->Rol = $row["Rol"];
}else
{
	$Datos_Usuario->Id = '';
	$Datos_Usuario->Rol = "Acceso Denegado";
}
	echo json_encode($Datos_Usuario);
  mysql_free_result($result); 
  mysql_close($link); 
?> 
