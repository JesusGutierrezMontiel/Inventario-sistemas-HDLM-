<?php 
session_start();
require("conexion.php");
require('fpdf/fpdf.php');
$fecha = strftime( "%Y-%m-%d %H-%M-%S", time() );
$insertar = "insert into log_prestamo_det (id_prestamodet,fecha,cantidad, id_producto, id_usuariorecibe, id_usuarioprestamo,id_estatus) 
select null,fh_prestamo,cantidad, id_producto, id_usuario,NULL,1   
from detalle_temporal_pres";
$insertar2 = $conexion-> query ("INSERT INTO `log_prestamo_cab`(`id_prestamocab`, `fh_prestamo`, `fh_entrega`, `costo_completo`, `id_cliente`, `id_salon`, `id_estatus`) 
SELECT `id_detalle_temp`,`fh_prestamo`,null,`cantidad`,`id_cliente`,`id_salon`,1 
FROM detalle_temporal_pres")or die( mysqli_error($conexion));
$con = $conexion -> query ("Select p.descripcionproducto, p.precio, d.cantidad from cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto) ORDER By d.id_detalle_temp") or die( mysqli_error($conexion));
$nombre = $conexion -> query ("Select id_usuario from detalle_temporal_pres") or die( mysqli_error($conexion));
$Salon = $conexion -> query ("Select id_salon from detalle_temporal_pres") or die( mysqli_error($conexion)); 
$insercion = mysqli_query($conexion, $insertar2);
if (mysqli_query($conexion, $insertar)) {
	class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	$this->Cell(60,10,'Hacienda D Los Morales',0,1,'C');
	$this->Cell(80);
    $this->Cell(60,10,'Solicitud de prestamo',0,1,'C');
    // Salto de línea
    $this->Ln(20);
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','I',8);
$pdf->Ln(10); 
$pdf->SetXY($pdf->GetX(),$pdf->GetY()); 
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255, 255, 255);  
$pdf->SetFillColor(0, 0, 0);
$pdf->Cell(190,10,utf8_decode('Datos del prestamo'),0,1,'C',true);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);  
$pdf->Cell(40,10,utf8_decode('Nombre del cliente:'),0,0,'C');
$query = "Select DISTINCT c.nombre, c.apellidoP, c.apellidoM from cat_cliente c join detalle_temporal_pres d ON (c.`id_cliente` = d.`id_cliente`) where d.`id_cliente`=c.`id_cliente`"; 
if($resul = $conexion->query($query))
while ($raw = $resul->fetch_assoc()) {
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,10,utf8_decode($raw['nombre']." ".$raw['apellidoP']." ".$raw['apellidoM']),0,0,'C');
	}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,utf8_decode('Prestador:'),0,0,'C');
$query = "Select DISTINCT id_usuario from detalle_temporal_pres"; 
if($resul = $conexion->query($query))
while ($rew = $resul->fetch_assoc()) {
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,10,utf8_decode($rew['id_usuario']),0,1,'L');
	}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,utf8_decode('Salon:'),0,0,'C');
$query = "Select DISTINCT s.descripcion from cat_salon s join detalle_temporal_pres d ON (s.`id_salon` = d.`id_salon`) where d.`id_salon`=s.`id_salon`"; 
if($resul = $conexion->query($query))
while ($row = $resul->fetch_assoc()) {
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,10,utf8_decode($row['descripcion']),0,0,'C');
	}
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);  
$pdf->Cell(40,10,utf8_decode('Fecha:'),0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,10,utf8_decode($fecha),0,1,'L');
$pdf->Ln(5); 
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255, 255, 255);  
$pdf->SetFillColor(0, 0, 0);
$pdf->Cell(190,10,utf8_decode('Datos de los productos'),0,1,'C',true);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0); 
$pdf->Cell(47,10,utf8_decode('Clave:'),0,0,'C');
$pdf->Cell(48,10,utf8_decode('Descripción:'),0,0,'C');
$pdf->Cell(48,10,utf8_decode('Cantidad:'),0,0,'C');
$pdf->Cell(47,10,utf8_decode('Precio:'),0,1,'C');
$query = $conexion -> query ("Select p.serie, p.descripcionproducto, p.precio, d.cantidad from cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto) ORDER By d.id_detalle_temp")
                             or die( mysqli_error($conexion));
while ($valores = mysqli_fetch_array($query)) {
$pdf->SetFont('Arial','',8);
$pdf->Cell(47,10,utf8_decode($valores['serie']),0,0,'C');
$pdf->Cell(48,10,utf8_decode($valores['descripcionproducto']),0,0,'C');
$pdf->Cell(48,10,utf8_decode($valores['cantidad']),0,0,'C');
$pdf->Cell(47,10,utf8_decode($valores['precio']),0,1,'C');	
}
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0); 
$pdf->Cell(143,10,utf8_decode('Total:'),0,0,'R');
$consulta = $conexion -> query ("SELECT p.precio FROM cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto)")or die( mysqli_error($conexion));
$total = 0; // total declarado antes del bucle
while($row = mysqli_fetch_array($consulta))
{
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0); 
$total = $total + $row['precio']; // Sumar variable $total + resultado de la consulta
 }
$pdf->Cell(47,10,utf8_decode($total),0,1,'C');	
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(20); 
$pdf->Cell(95,10,utf8_decode(''),0,0,'C');
$pdf->Cell(95,10,utf8_decode(''),0,1,'C');
$pdf->Cell(95,10,utf8_decode('Firma del prestador'),0,0,'C');
$pdf->Cell(95,10,utf8_decode('Firma del solicitante'),0,1,'C');
$pdf->Output();
	    $c = $conexion -> query ("DELETE FROM `detalle_temporal_pres` WHERE `id_detalle_temp` > 0");
		header('Location: '.'../src/prestamo.php');
}else {
     echo "Error: " . $insertar . "<br>" . mysqli_error($conexion);
}
mysqli_close($conexion);
?>