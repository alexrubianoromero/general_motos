<?php
session_start();
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');

// echo 'eliminando...';

// echo '<pre>'; print_r($_REQUEST);echo '</pre>';
// die (); 
$sql = "delete from ordenes where  id = '".$_REQUEST['idOrden']."' ";
$consulta = mysql_query($sql,$conexion);

include('./muestre_orden_proceso.php');

?>