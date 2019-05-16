<?php

require('fpdf.php');
require ("facturasyrecibos.php");

 //$datos = $resul;

         //echo json_encode($datos[1]);die;
//require '../auxiliar.php';

$con = mysqli_connect('127.0.0.1', 'root', 'segymant', 'db693261871');
$con->query("SET NAMES 'utf8'");

//$anio = date('y');

 $resul = $_POST["accion"];
 $datos = json_decode($resul, true);  

 $idparte = $datos[count($datos)-1];
 $arranio = $datos[6];
 $anio = substr($arranio, 2, 2);
 $dni = $datos[0];
 $nombre = $datos[1];
 $apellidos = $datos[2];
 $direccion = $datos[3];
 $localidad = $datos[4];
 $numero = $datos[5];
 $fecha = $datos[6];
 $siniestro = $datos[count($datos)-2];
 $importe = $datos[10];
 $importe = str_replace('.', '', $importe); 
 $importe = str_replace(',', '.', $importe); 
 $hoysimple = date("Y-m-d");
 $anioHoy = date("Y");


if (isset($_GET['crear'])) {
 
  $cerrojo = $_GET['crear'];

  if ($cerrojo == 'si') {
    
$consulnumfactura = mysqli_query($con, "SELECT MAX(numfactura) FROM `facturas` where YEAR(fecha) = $anioHoy");
//$consulautoid = mysqli_query($con, "SELECT MAX(id) FROM `autoincrementFactura`");
//$filaautoid = mysqli_fetch_row($consulautoid);

$filasnumfactura = mysqli_fetch_row($consulnumfactura);

$numero = $filasnumfactura[0];
$numero = (int)($numero + 1);
//$n = $filaautoid[0];
//$eln = (int)($n+1);

//CREAR EL NUEVO NUMERO DE FACTURA

// los cambios son este mas el numero en el pdf y el numero en guardar pdf en gestion
// SEGUIMOS INCREMENTANDO EL NUMERO PERO EN EL PDF EMPEZAMOS DE CERO CADA AÑO.
//mysqli_query($con, "INSERT INTO `autoincrementFactura`(`id`, `numfactura`) VALUES ($eln, $numero)");

// FIN DE CRAR EL NUEVO NUMERO DE FACTURA


mysqli_query($con, "INSERT INTO `facturas`(`numfactura`, `dni`, `nombre`, `apellidos`, `direccion`, `cp`, `localidad`, `fecha`, `serie`,`idparte`,`siniestro`,`importe`,`estado`) VALUES ($numero,'$dni','$nombre','$apellidos','$direccion', '$cp','$localidad','$fecha','C','$idparte','$siniestro','$importe','pendiente')");

$numdatos = count($datos);


for ($j=12; $j < $numdatos -2; $j++) {


$des = $datos[$j];
$pre = $datos[++$j];

 mysqli_query($con, "INSERT INTO `lineafacturas`(`id`,`numF`, `descripcion`, `importe`,`nota`) VALUES (default, $numero,'$des','$pre','')");


 }

 $nota = $datos[11];
mysqli_query($con, "INSERT INTO `lineafacturas`(`id`,`numF`, `descripcion`, `importe`, `nota`) VALUES (default, $numero,'','','$nota')");




}
}else
{



mysqli_query($con, "DELETE FROM `lineafacturas` WHERE `numF` = $numero;");


$numdatos = count($datos);


for ($j=12; $j < $numdatos -2; $j++) {


$des = $datos[$j];
$pre = $datos[++$j];

 mysqli_query($con, "INSERT INTO `lineafacturas`(`id`,`numF`, `descripcion`, `importe`,`nota`) VALUES (default, $numero,'$des','$pre','')");


 }

 $nota = $datos[11];
mysqli_query($con, "INSERT INTO `lineafacturas`(`id`,`numF`, `descripcion`, `importe`, `nota`) VALUES (default, $numero,'','','$nota')");


}



class PDF extends FPDF
{
  
// Cabecera de página
function Header()
{
   
       

}


// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(0);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}
}


// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',8);


  // Logo
     $pdf->Image('logo.jpg',5,5,60,40);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    //$pdf->Image('logo_pb.png',10,8,33);
    // Movernos a la derecha
    $pdf->Cell(100);
    // Título
    //Cell(ancho, Alto, texto, borde, salto de linea, alineacion de texto)
    $pdf->Cell(30,10, 'Datos Cliente',0,0,'C');
    // Salto de línea
    $pdf->Ln(30);

     $pdf->SetFont('Arial','I',10);

     
 $pdf->SetXY(115, 20);
 //$pdf->Cell(100,10,utf8_decode($datos[0]),0,0);
 $pdf->Cell(100,10,utf8_decode($datos[0]),0,0);
 $pdf->SetXY(115, 25);
 $pdf->Cell(100,10,utf8_decode($datos[1]),0,0);
 $pdf->SetXY(115, 30);
 $pdf->Cell(100,10,utf8_decode($datos[2]),0,0);
 $pdf->SetXY(115, 35);
 $pdf->Cell(100,10,utf8_decode($datos[3]),0,0);
 $pdf->SetXY(115, 40);
 $pdf->Cell(100,10,utf8_decode($datos[4]),0,0);



 //datos factura 

 $pdf->SetXY(110, 50);
  $pdf->SetFont('Arial','B',15);
 $pdf->Cell(30,10, 'Datos Factura',0,0, 'C');

 
 


  $pdf->SetFont('Arial','I',10);

  $pdf->SetXY(115, 60);
 $pdf->Cell(100,10,"Numero Factura : ".$numero ,0,0);

 $pdf->SetXY(115, 65);
 $pdf->Cell(100,10, 'Serie   :  C',0,0);

//$fecha = new DateTime($datos[6]);

//$fecha -> format('d-m-Y');

 $pdf->SetXY(115, 70);
 $pdf->Cell(100,10,"Fecha  : ".$fecha ,0,0);

 $pdf->SetXY(50, 70);
 
 $pdf->SetFont('Arial','B',35);

 $pdf->Cell(30,10, 'FACTURA',0,0, 'C');


 //DESCRIPCION

  $pdf->SetXY(20, 85);
 
 $pdf->SetFont('Arial','B', 10);

 $pdf->Cell(30,10, 'Descripcion',0,0, 'C');

 $pdf->SetXY(165, 85);
 
 $pdf->SetFont('Arial','B', 10);

 $pdf->Cell(30,10, 'Importe',0,0, 'C');

 //primera linea divisora 
/*L : izquierda
T : superior
R : derecha
B : inferior*/
$pdf->Line(15, 95, 200, 95);

$pdf->SetXY(5, 100);
//HAY QUE HACER UN ADGORITMO PARA RECORRER TODAS LAS DESCRIPCIONES



$num = count($datos);

$pdf->SetFont('Arial','I', 10);


 $pdf->MultiCell(180,5, utf8_decode("    "." ".$datos[11]), 0, 'L');

for ($i=12; $i < $num -2; $i++) { 
  


 
 $pdf->SetFont('Arial','I', 10);


 $pdf->MultiCell(160,5, utf8_decode("»  "." ".$datos[$i]), 0, 'L');


 $eldetalle .= $datos[$i];

 $pdf->MultiCell(185,5, "  ".$datos[++$i], 0, 'R');

 //array_push($detalles, $datos[$i]);

 //$eldetalle = implode(',', $detalles);


 //array_push($detalles, $datos[$i]);

 //$eldetalle = implode(',', $detalles);

  

 }

 $iva = $datos[8];

 $iva = substr($iva, 2);

 $iva = $iva.'%';

$pdf->MultiCell(170,10, "_____________________________________________________________________________________", 0, 'L');

//$pdf->Line(15, 230, 200, 230);
$pdf->SetFont('Arial','B', 10);
$pdf->MultiCell(170,10, "      Base Imponible            "."                     I.V.A    "."                        Importe I.V.A        "."                             Total", 0, 'L');

$pdf->SetFont('Arial','I',10);

$pdf->MultiCell(170,10, "             $datos[7]     "."                                    $iva         "."                           $datos[9]                    "."              $datos[10]", 0, 'L');
$pdf->MultiCell(170,10, "_____________________________________________________________________________________", 0, 'L');

$pdf->SetFont('Arial','B', 10);

$pdf->MultiCell(170,10, "TOTAL  FACTURA ..............................".".......................................................................                      $datos[10]", 0, 'L');




$numero = (int)$numero;

mysqli_query($con, "UPDATE `facturas` SET `dni`='$dni',`nombre`='$nombre',`apellidos`='$apellidos',`direccion`='$direccion',`localidad`='$localidad',`fecha`='$fecha', `importe`='$importe' WHERE  numfactura = $numero ");
//$pdf->Output('factura.pdf', 'F');
 


for ($k=12; $k < $num -2; $k++) {


$desdos = $datos[$k];
$predos = $datos[++$k];

 mysqli_query($con, "UPDATE `lineafacturas` SET `descripcion`='$desdos',`importe`='$predos' WHERE  id = $idpresupuesto AND numF = $numero");

$idpresupuesto = $idpresupuesto + 1;
 

 }
 /** nuevas lineas **/
 /*else
{
  
   

  $consultadenumerodefilas = mysqli_query($con, "SELECT * FROM `lineafacturas` WHERE numF = 96");
  $resulnumerodefilas = mysqli_num_rows($consultadenumerodefilas);
  echo var_dump($resulnumerodefilas);  die;

  if ($datos > $resulnumerodefilas) {

    for ($k= $resulnumerodefilas; $k < $contadordefilas; $k++) {


$des = $datos[$j];
$pre = $datos[++$j];

 mysqli_query($con, "INSERT INTO `lineafacturas`(`id`,`numF`, `descripcion`, `importe`,`nota`) VALUES (default, $numero,'$des','$pre','')");


 }
    
  }




}*/
/** fin de nuevas lineas **/


 $nota = $datos[11];

mysqli_query($con, "UPDATE `lineafacturas` SET `nota`='$nota' WHERE  id = $idpresupuesto AND numF = $numero");
 

  //        if (!is_dir($carpetaDestino)) {
  //mkdir("../../gesdoc/GESTDOC/.$siniestro");
//}
   //$carpetaDestino = "../../gesdoc/GESTDOC/".$siniestro;
$carpetaDestino = "./".$siniestro;
 
 if(file_exists($carpetaDestino) || @mkdir($carpetaDestino, 0777, true))
            
{
             $pdf->Output($carpetaDestino."/".$anio."-".$numero.'Cfactura.pdf', 'F');
            //  $pdf->Output($numero.'Cfactura.pdf', 'F');

         }

  
echo json_encode($numero);

exit;







?>

