<?php
$raiz= $_SERVER['DOCUMENT_ROOT'];
date_default_timezone_set('America/Bogota');
require_once($raiz.'/fpdf/fpdf.php');
$ruta = dirname(dirname(dirname(__FILE__)));
require_once($ruta .'/orden/modelo/OrdenesModelo.class.php');
require_once($ruta .'/inventario_codigos/modelo/CodigosInventarioModelo.php');
$orden = new OrdenesModelo();
$infoCode = new CodigosInventarioModelo();
// $_REQUEST['idorden'] = '23008';
$datoOrden = $orden->traerDatosOrdenIdNew($_REQUEST['idorden']);
$datosCarro = $orden->traerDatosCarroConPlaca($datoOrden['placa']);
$datosCliente = $orden->traerDatosPropietarioConPlaca($datosCarro['propietario']); 
$nombreTecnico = $orden->traerTecnicoOrdenIdOrden('23008'); 
$datosEmpresa = $orden->traerInfoEmpresa(); 
$datosItems = $orden->traerItemsAsociadosOrdenPorIdOrden($_REQUEST['idorden']); 
$sumas = $orden->suma_manos_obra($_REQUEST['idorden']);
$valoriva = $orden-> traerIva();
// $totalOrden =   $orden->sumeItemsIdOrden($_REQUEST['idorden']); 


// echo '<br>suma manos de obra '.$suma_mano_obra;
// $sql = "select * from ordenes where id = '".$_REQUEST['idorden']."'    ";
// $consulta = mysql_query($sql,$conexion);
// $ArrOrden = mysql_fetch_assoc($consulta); 
// echo '<pre>'; 
// print_r($datoOrden); 
// echo '</pre>'; 
// die();

$pdf=new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',10);

// $pdf->Cell(190,5,'BBBBBBBBBBBBBBBB',1,1,'C');
$pdf->Cell(45,5,'GENERAL MOTOS LTDA',0,0,'C');
$pdf->Image('../../imagenes/honda_orden/hondayhero.jpg',60,6,50);
$pdf->Cell(60);
$pdf->Cell(40,5,'ORDEN DE ENTRADA',0,0,'C');
$pdf->Cell(2);
$pdf->Cell(32,5,'OT_'.$datoOrden['orden'],0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(45,5,'NIT: 830099461-9',0,1,'C');


$pdf->SetY(21);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(55,5,'CLIENTE',1,0,'C');
$pdf->Cell(35,5,'IDENTIFICACION',1,0,'C');
$pdf->Cell(90,5,'DIRECCION',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,5,$datosCliente['nombre'],1,0,'');
$pdf->Cell(35,5,$datosCliente['identi'],1,0,'R');
$pdf->Cell(90,5,$datosCliente['direccion'],1,1,'');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(55,5,'TELEFONO',1,0,'C');
$pdf->Cell(35,5,'EMAIL',1,0,'C');
$pdf->Cell(90,5,'TECNICO',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,5,$datosCliente['telefono'],1,0,'');
$pdf->Cell(35,5,$datosCliente['email'],1,0,'');
$pdf->Cell(90,5,$nombreTecnico,1,1,'');

$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(55,5,'FECHA INGRESO',1,0,'C');
$pdf->Cell(35,5,'FECHA PROMETIDA',1,0,'C');
$pdf->Cell(90,5,'SALIDA',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(55,5,$datoOrden['fecha'],1,0,'');
$pdf->Cell(35,5,$datoOrden['fecha_entrega'],1,0,'');
$pdf->Cell(90,5,'',1,1,'');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(36,5,'MARCA',1,0,'C');
$pdf->Cell(36,5,'LINEA',1,0,'C');
$pdf->Cell(36,5,'COLOR',1,0,'C');
$pdf->Cell(36,5,'PLACA',1,0,'C');
$pdf->Cell(36,5,'KILOMETRAJE',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(36,5,$datosCarro['marca'],1,0,'C');
$pdf->Cell(36,5,$datosCarro['tipo'],1,0,'C');
$pdf->Cell(36,5,$datosCarro['color'],1,0,'C');
$pdf->Cell(36,5,$datosCarro['placa'],1,0,'C');
$pdf->Cell(36,5,number_format($datoOrden['kilometraje'],0,",","."),1,1,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'OBSERVACIONES',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,5,trim($datoOrden['observaciones']),1,1,'');
$pdf->SetFont('Arial','',4);
$pdf->MultiCell(180,5,$datosEmpresa['condiciones_orden'],1,1,'');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,5,'PARTES Y RESPUESTOS',1,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,'REFERENCIA',1,0,'C');
$pdf->Cell(70,5,'DESCRIPCION',1,0,'C');
$pdf->Cell(20,5,'CANTIDAD',1,0,'C');
$pdf->Cell(20,5,'VALOR UN',1,0,'C');
$pdf->Cell(20,5,'TOTAL',1,1,'C');

$suma = 0;
$filas = count($datosItems); 
$pdf->SetFont('Arial','',8);
foreach ($datosItems as $datosItem)    
{
    $vrUnit =   $datosItem['valor_unitario'];
    $vrTotal = $datosItem['total_item'];
    $datosCodigo = $infoCode->verifiqueCodigoSiExiste($datosItem['codigo']);    
	// $pdf->Cell(5);
	// $pdf->Cell(50,4,$datosCodigo['data']['codigo'],1,0,'C');
	$pdf->Cell(50,4,$datosItem['codigo'],1,0,'C');
	$pdf->Cell(70,4,$datosItem['descripcion'],1,0,'L');
	$pdf->Cell(20,4,number_format($vrUnit, 0, ',', '.'),1,0,'R');
	$pdf->Cell(20,4,$datosItem['cantidad'],1,0,'C');
	$pdf->Cell(20,4,number_format($vrTotal, 0, ',', '.'),1,1,'R');
    $suma = $suma + $vrTotal;
}
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,5,'',1,0,'C');
$pdf->Cell(70,5,'Subtotal(no incluye iva mano de obra)',1,0,'L');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(20,5,number_format($suma, 0, ',', '.'),1,1,'R');

$subtotalmenosabono = $suma-$datoOrden['abono'];

$pdf->Cell(50,5,'',1,0,'C');
$pdf->Cell(70,5,'Subtotal menos abono',1,0,'L');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(20,5,number_format($subtotalmenosabono, 0, ',', '.'),1,1,'R');


$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,'',1,0,'C');
$pdf->Cell(36,5,'COTIZACION',1,0,'C');
$pdf->Cell(36,5,'ABONO',1,0,'C');
$pdf->Cell(36,5,'FECHA',1,0,'C');
$pdf->Cell(32,5,'SALDO',1,1,'C');


$valor_iva_mano = ($sumas['sumamanos'] * $valoriva)/100;

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'VR.MANO DE OBRA',1,0,'L');
$pdf->Cell(36,5,number_format($sumas['sumamanos'], 0, ',', '.'),1,0,'R');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(32,5,'',1,1,'C');

$pdf->Cell(40,5,'VR.MANO DE OBRA 19%',1,0,'L');
$pdf->Cell(36,5,number_format($valor_iva_mano, 0, ',', '.'),1,0,'R');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(32,5,'',1,1,'C');

$pdf->Cell(40,5,'VALOR REPUESTOS',1,0,'L');
$pdf->Cell(36,5,number_format($sumas['sumarepuestos'], 0, ',', '.'),1,0,'R');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->Cell(32,5,'',1,1,'C');

$subtotal = $subtotalmenosabono+$valor_iva_mano;
$saldo = $subtotal - $datoOrden['abono'];
$pdf->Cell(40,5,'TOTAL ',1,0,'L');
$pdf->Cell(36,5,number_format($subtotal, 0, ',', '.'),1,0,'R');
$pdf->Cell(36,5,number_format($datoOrden['abono'], 0, ',', '.'),1,0,'C');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(32,5,number_format($saldo, 0, ',', '.'),1,1,'R');





$pdf->Output();

?>