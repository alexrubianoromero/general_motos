<?php
session_start();
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');

// echo '<pre>'; print_r($_REQUEST);echo '</pre>';
// die (); 

$sql_muestre_ordenes = "select o.id as No_Orden,
o.fecha,
o.placa,
o.id,
o.orden,
o.kilometraje,
o.estado,
o.mecanico,c.propietario
 from $tabla14  o 
inner join $tabla4 c on (c.placa = o.placa)
 where 1=1  
 and o.id = ".$_REQUEST['idOrden'];
//echo '<br>'.$sql_muestre_ordenes;
//inner join $tabla3 cli on (cli.idcliente = c.propietario)
//cli.nombre
$ordenes = mysql_query($sql_muestre_ordenes,$conexion);
$datosOrden = mysql_fetch_assoc($ordenes);
// echo '<pre>'; print_r($datosOrden);echo '</pre>';

function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Esta seguro de eliminar esta orden ?</h1>
    <?php
    echo '<table class="table  table-bordered border-primary">';
	echo '<tr>';
	echo '<td><h3>No Orden<h3></td>';
	echo '<td><h3>Estado</h3></td>';
	echo '<td><h3>Linea</h3></td>';
	echo '<td><h3>Fecha</h3></td>';
	echo '<td><h3>Placa</h3></td>';


    echo '</tr>';

     echo '<tr>';     
                $nombre_estado = busque_estado($tabla26,$datosOrden['estado'],$_SESSION['id_empresa'],$conexion);      
                $sql = "select * from carros where placa = '".$datosOrden['placa']."'";
                $consultaCarro = mysql_query($sql,$conexion);
                $datosCarro= mysql_fetch_assoc($consultaCarro);
                // echo '<pre>'; print_r($datosCarro);echo '</pre>'; die();
                echo '<td><h3>'.$datosOrden['orden'].'</h3></td>';
                echo '<td><h3>'.$nombre_estado.'</h3></td>';
                echo '<td><h3>'.$datosCarro['tipo'].'</h3></td>';
                echo '<td><h3>'.$datosOrden['fecha'].'</h3></td>';
                echo '<td><h3>'.$datosOrden['placa'].'</h3></td>';
      
     echo '</tr>';     
     
   echo '</table>';  
   
    ?>
    <div class="text-center d-grid">
        <button class="btn btn-primary btn-lg " onclick="realizarEliminacion(<?php   echo $_REQUEST['idOrden']; ?>)">Eliminar</button>
    </div>
</body>
</html>
