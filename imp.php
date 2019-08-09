<?php
		//include "../sesion.php";
		include "config.php";
		//include "info.php"; 
		/*include "libs/class/maestro.class.php";
		include "libs/class/usuario.class.php";
		include "libs/class/prestamo.class.php";*/
		include "libs/class/maestro.class.php";

		require('libs/pdf_generador/fpdf.php');

//OBTENER FECHA + ID USUSARIO

	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	//$usu=$_SESSION['usu_ide'];
// ABRIR ARCHIVO POLICIAS
/*		
$rows = Maestro::getMaestro(13,0);	
foreach ($rows as $row) {
	$nya=$row['APELLIDO'].', '.$row['NOMBRE'];
	$dni=$row['DNI'];
	$fec_nac=$row['FECHA_NAC'];
	$edad=$row['EDAD'];
	$dom=$row['DOMICILIO'];
	$dto=$row['DEPARTAMENTO'];
	$tel= $row['TELEFONO'];
}*/
/*
$fecha='2019-04-11';
$rows = Maestro::getMaestro(14,$fecha);
foreach ($rows as $row) {
	$nya=$row['APELLIDOS'].', '.$row['NOMBRES'];
	
class PDF extends FPDF
{
function Header()	{
$borde=0;
$this->SetFont('Courier','',10);
$this->SetXY(70,10);
$this->Multicell(180,8,'SOLICITUD DE INGRESO',0,'C');
 // Line break
 $this->Ln(20);}
}
$border=0;
// Instanciation of inherited class
$pdf = new PDF('L', 'mm', 'A4');
//$pdf = new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
//Establecer fuente de documento
$pdf->SetFont('Courier','',11);
//cuerpo de documento
//resolucion
$pdf->SetFont('Courier','B',11); // B - Bold , U - Underline
$pdf->SetXY(5,25);
$pdf->Multicell(0,5,'AFILIADO',0,'l',0,0);
$pdf->SetFont('Courier','',11);
$pdf->SetXY(5,42);
$pdf->Multicell(0,5,$nya,0,'l',0,0);
$pdf->Output();
//$pdf->AddPage();
}*/
$con=1;
while ($con<=10){
class PDF extends FPDF
{
function Header()	{
$borde=0;
$this->SetFont('Courier','',10);
$this->SetXY(70,10);
$this->Multicell(180,8,'SOLICITUD DE INGRESO',0,'C');
 // Line break
 $this->Ln(20);}
}
$border=0;
// Instanciation of inherited class
$pdf = new PDF('L', 'mm', 'A4');
//$pdf = new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
//Establecer fuente de documento
$pdf->SetFont('Courier','',11);
//cuerpo de documento
//resolucion
$pdf->SetFont('Courier','B',11); // B - Bold , U - Underline
$pdf->SetXY(5,25);
$pdf->Multicell(0,5,'AFILIADO',0,'l',0,0);
/*$pdf->SetFont('Courier','',11);
$pdf->SetXY(5,42);
$pdf->Multicell(0,5,$nya,0,'l',0,0);*/


$pdf->AddPage();	
$pdf->Output();
$con=$con+1;
}

?>
