<?php
session_start();
$raiz = dirname(dirname(__FILE__)); 

include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
// die($raiz); 
$ordenModelo = new OrdenesModelo(); 
$ordenes = $ordenModelo->traerOrdenesEnProceso(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
    <?php mostrarOrdenes($ordenes);   ?>
</body>
</html>


<?php

function mostrarOrdenes($ordenes)
{
    ?>
    <button class="btn btn-menu">Prueba</button>
    <table class="table table-striped">
            <thead>

                <tr>
                    <td>No Orden</td>
                    <td>Estado</td>
                    <td>Linea</td>
                    <td>Fecha</td>
                    <td>Propietario</td>
                    <td>Tecnico</td>
                    <td>Modificar</td>
                    <td>Impresion</td>
                    <td>Pdf</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($ordenes as $orden)
                    {
                        echo '<tr>'; 
                        echo '<td>'.$orden['orden'].'</td>';
                        echo '<td>'.$orden['estado'].'</td>';
                        echo '<td>'.$orden['tipo'].'</td>';
                        echo '<td>'.$orden['fecha'].'</td>';
                        echo '<td>'.$orden['placa'].'</td>';
                        echo '<td></td>';
                        echo '<td>'.$orden['mecanico'].'</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        // echo '<td><button class ="btn btn-primary" onclick ="agregarMemoriaRam('.$request['idHardware'].','.$memoria['id'].','.$request['numeroRam'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>

    <?php
}


?>