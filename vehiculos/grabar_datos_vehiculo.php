<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/



include('../valotablapc.php');

//verificar que la placa no exista
$sql_verificar_placa = "select * from $tabla4 where placa ='".$_REQUEST['placa']."'";
$consulta_placa = mysql_query($sql_verificar_placa,$conexion);
$filas_placa = mysql_num_rows($consulta_placa);

if($filas_placa <1) //osea si no existe
{
$sql_grabar_carro = "insert into $tabla4  
(placa,marca,tipo,modelo,color,id_empresa,vencisoat,revision,propietario,chasis,motor) 
values (
'".$_POST['placa']."',
'".$_POST['marca']."',
'".$_POST['tipo']."',
'".$_POST['modelo']."',
'".$_POST['color']."',
'".$_SESSION['id_empresa']."',
'".$_POST['vencisoat']."',
'".$_POST['revision']."',
'".$_POST['propietario']."',
'".$_POST['chasis']."',
'".$_POST['motor']."'
)";
//echo '<br>'.$sql_grabar_carro.'<br>';
//exit();
$consulta_grabar_carros = mysql_query($sql_grabar_carro,$conexion);
echo '<H2>GRABACION EXITOSA</H2>';
}//fin de si  se puede grabar
else
{
  //ASIGNE EL ID DE LA EMPRESA A LA QUE EXISTE
	$actualize_id_empresa = "update $tabla4 set id_empresa = '".$_SESSION['id_empresa']."' where placa = '".$_REQUEST['placa']."'  ";
  	$consulta_actualizar = mysql_query($actualize_id_empresa,$conexion);
  echo  '<h2>ESTA PLACA YA EXISTE NO ES POSIBLE GRABARLA NUEVAMENTE </h2>';
}



?>