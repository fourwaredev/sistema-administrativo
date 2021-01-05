<?php
require('lib/fpdf/fpdf.php');

include 'model/conexion.php';

$conexion = conexion();

session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: login");
}


/* fecha actual */

date_default_timezone_set('America/Mexico_City');
$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');


/* id del usuario */

$idusuario = $_SESSION['idusuario'];

/* seleccionar datos de las tablas usuarios y personal  */

$sql = "SELECT u.idusuario, a.nombre, a.correo, u.usuario FROM usuarios AS u INNER JOIN personal AS a ON u.idnombre = a.idnombre WHERE u.idusuario='$idusuario'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

/* obtener usuario y correo */

$usuario = $row['nombre'];
$correo = $row['correo'];

/* seleccionar datos de las tablas cotizacion y usuarios */

$cotizacion = "SELECT u.idusuario, m.idclave, m.descripcion, m.cantidad, m.unidades, m.precio, m.importe FROM usuarios AS u INNER JOIN cotizacion AS m ON u.idusuario = m.idpersonal WHERE u.idusuario = '$idusuario'";
$resultadocotizacion = $conexion->query($cotizacion);

/* obtener el total de la suma de las tablas  */

$consultaTotal = "SELECT idpersonal, SUM(importe) AS TotalPrecios FROM cotizacion WHERE idpersonal = '$idusuario'";
$resultadoTotal=$conexion->query($consultaTotal);
$fila=$resultadoTotal->fetch_assoc();

$total=$fila['TotalPrecios'];

class PDF extends FPDF
{
    // Cabecera de página
    public function Header()
    {
        $this->Image('images/logo-pdf.png', 10, 6, -400);
        $this->SetFont('Arial', 'B', 20);
        $this->SetXY(-88, 10);
        $this->Cell(20, 10, utf8_decode('Formato de Cotización'), 0, 1, 'L');

        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(44, 145, 109);
        $this->SetXY(-88, 17);
        $this->Cell(20, 10, utf8_decode('La Estrella del Centro SA de CV'), 0, 1, 'L');

        $this->SetFont('Arial', '', 9.5);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(-88, 22.5);
        $this->Cell(20, 10, utf8_decode('Av. Homero 109, Chapultepec Morales, Polanco V Secc,'), 0, 1, 'L');

        $this->SetFont('Arial', '', 9.5);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(-88, 27.5);
        $this->Cell(20, 10, utf8_decode('Miguel Hidalgo, 11560, Ciudad de México'), 0, 1, 'L');
        

        

        /* $this->SetFont('Arial','',10);
        $this->SetTextColor(0,0,0);
        $this->SetXY(-88,27.5);
        $this->Cell(20,10,utf8_decode('Telefóno: 55 5555 5555'),0,1,'L'); */
        
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(-88, 32.5);
        $this->Cell(20, 10, utf8_decode('www.estrelladelcentro.com.mx'), 0, 1, 'L');

        $this->SetLineWidth(1);
        $this->SetDrawColor(44, 145, 109);
        $this->Line(10, 43, 200, 43);
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetLineWidth(2);
$pdf->SetDrawColor(44, 145, 109);
$pdf->Line(10, 50, 10, 80);

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(15, 50);
$pdf->Cell(29, 10, utf8_decode('Fecha: '), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(30, 50);
$pdf->Cell(29, 10, utf8_decode($fecha), 0, 1, 'L'); /* $fecha  */

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(15, 56);
$pdf->Cell(29, 10, utf8_decode('Autorizado por: '), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(45, 56);
$pdf->Cell(29, 10, utf8_decode($usuario), 0, 1, 'L'); /* $usuario */

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(15, 62);
$pdf->Cell(29, 10, utf8_decode('Correo: '), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(30, 62);
$pdf->Cell(29, 10, utf8_decode($correo), 0, 1, 'L'); /* $correo */

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(15, 68);
$pdf->Cell(29, 10, utf8_decode('A la atención de: '), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(47, 68);
$pdf->Cell(29, 10, utf8_decode('La Estrella del Centro SA de CV'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetXY(10, 88);
$pdf->SetFillColor(33, 37, 41);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, utf8_decode('#'), 0, 0, 'C', 1);
$pdf->Cell(80, 10, utf8_decode('Descripción'), 0, 0, 'L', 1);
$pdf->Cell(40, 10, utf8_decode('Cantidad'), 0, 0, 'L', 1);
$pdf->Cell(30, 10, utf8_decode('Precio'), 0, 0, 'L', 1);
$pdf->Cell(30, 10, utf8_decode('Importe'), 0, 1, 'L', 1);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(245, 245, 245);
$pdf->SetTextColor(0, 0, 0);

$i = 1;
while ($regcotizacion = $resultadocotizacion->fetch_array(MYSQLI_BOTH)) {
    $pdf->Cell(10, 10, utf8_decode($i), 0, 0, 'C', 1);
    $pdf->Cell(80, 10, utf8_decode($regcotizacion['descripcion']), 0, 0, 'L', 1);
    $pdf->Cell(40, 10, utf8_decode($regcotizacion['cantidad'] . ' ' . $regcotizacion['unidades']), 0, 0, 'L', 1);
    $pdf->Cell(30, 10, utf8_decode('$' .$regcotizacion['precio']), 0, 0, 'L', 1);
    $pdf->Cell(30, 10, utf8_decode('$' .$regcotizacion['importe']), 0, 1, 'L', 1);
    $i++;
}

/* $pdf->Cell(190, 10, utf8_decode(''), 0, 1, 'L', 1);
$pdf->Cell(190, 10, utf8_decode(''), 0, 1, 'L', 1);
$pdf->Cell(190, 10, utf8_decode(''), 0, 1, 'L', 1);
$pdf->Cell(190, 10, utf8_decode(''), 0, 1, 'L', 1); */


$pdf->Ln(2);

$pdf->SetFont('Arial', '', 18);
$pdf->SetTextColor(44, 145, 109);
$pdf->SetX(-74);
$pdf->Cell(30, 10, utf8_decode('TOTAL: '), 0, 0, 'L', 0);

$pdf->SetFont('Arial', '', 18);
$pdf->Cell(30, 10, utf8_decode('$' . $total), 0, 0, 'L', 0); /* -> $total */

$pdf->Output('I', 'cotizacion.pdf');
?>


