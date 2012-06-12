<?php 
   include('fpdf.php');
   include('TraerDatosFactura.php');
	
function IdFactura()
{
	$obj =  $_GET["IdFactura"];
	return $obj;
}

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
		$Cliente = DatosCliente(IdFactura());
		// Logo
		$this->Image('../Diseno/Imagenes/logo.png',0,0,30);
		// Arial bold 15
		$this->SetFont('Arial','B',11);
		$this->Cell(20);
		$this->Cell(0,10,'DISTRICOMPUTO DIGITAL',0,0,'L',0);
		$this->Cell(0,10,'Factura No: ' . $Cliente->Id_Factura ,0,1,'R',0);
		$this->SetXY(120, 10);
		$this->Cell(0,7,'Fecha: ' . date('d/m/Y'),0,1,'R',0);
		$this->SetFont('Arial','',8);
		$this->SetXY(30, 10);
		$this->Cell(20,0,'NIT. 55194440-1',0,0,'L',0);
		$this->SetX(30);
		$this->Cell(20,7,'Tel: 867-7958 Cel: 320-4681856 -- 310-6990041',0,1,'L','0');
		$this->SetXY(25, 18);
		$this->Cell(120,7,"Cliente: $Cliente->Nombre",0,0,'L','0');
		$this->Cell(40,7,"Nit/CC: $Cliente->Documento",0,1,'L','0');
		$this->SetXY(25, 22);
		$this->Cell(120,8,"Direccion: $Cliente->Direccion",0,0,'L','0');
		$this->Cell(40,8,"Telefono: $Cliente->Telefono",0,1,'L','0');
		$this->Rect(25,19,185,10);
		// Salto de línea
		//$this->Ln(20);
	}

	// Pie de página
	function Footer()
	{
		$this->SetY(-20);
		$this->SetFont('Arial','I',9);
		$this->Cell(0,8,'Algo de Texto Aquí',0,0,'L','0');
	}
	
}
// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm', array(215,140));
$pdf->SetMargins(5, 0, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetXY(5, 35);
$pdf->SetFont('Arial','B',10);
$y1 = $pdf->GetY();
$pdf->Cell(120,8,'Articulo',0,0,'L','0');
$pdf->Cell(25,8,'Cantidad',0,0,'L','0');
$pdf->Cell(35,8,'Precio Unitario',0,0,'L','0');
$pdf->Cell(40,8,'Subtotal',0,1,'L','0');
$pdf->SetFont('Arial','',9);

$Productos = TraerProductos(IdFactura());
	$Articulos = $Productos->Articulo;
	$Cantidades = $Productos->Cantidad;
	$Precios = $Productos->PrecioUnitario;
	$Total =0;
	
	for($i=0;$i<sizeof($Articulos);$i++)
	{
		$pdf->Line(5,$pdf->GetY(), 210, $pdf->GetY());
		$Total += $Precios[$i] * $Cantidades[$i];
		$pdf->Cell(120,7,$Articulos[$i],0,0,'L','0');
		$pdf->Cell(25,7,number_format($Cantidades[$i], 0, '', '.'),0,0,'L','0');
		$pdf->Cell(35,7,number_format($Precios[$i], 0, '', '.'),0,0,'L','0');
		$pdf->Cell(40,7,number_format($Precios[$i] * $Cantidades[$i], 0, '', '.'),0,1,'L','0');
	}
	$y2 = $pdf->GetY();
	$pdf->Line(125, $y1, 125, $y2);
	$pdf->Line(150, $y1, 150, $y2);
	$pdf->Line(183, $y1, 183, $y2);
	
	$pdf->SetY(109);
	$pdf->SetFont('Arial','BI',11);
	$pdf->Cell(0,10,"Total: $" . number_format($Total, 0, '', '.'),0,0,'R');
	
$NombreDocumento = "Factura";
$pdf->Output($NombreDocumento , 'I');
?>
