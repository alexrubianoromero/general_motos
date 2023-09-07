<?php

session_start();

/*

echo '<pre>';

print_r($_POST);

echo '</pre>';

echo '---------------------------------------------------------------------------';
*/

/*
echo 'valores que llegan a actualizar orden <pre>';

print_r($_REQUEST);

echo '</pre>';
*/


//exit();





/*

'".$_POST['orden_numero']."',

'".$_POST['placa']."',

'".$_POST['clave']."',

'".$_POST['fecha']."',

'".$_POST['descripcion']."',

'".$_POST['radio']."',

'".$_POST['antena']."',

'".$_POST['repuesto']."',

'".$_POST['herramienta']."',

'".$_POST['otros']."'

*/

if ($_POST['cambiar_mecanico']== 'undefined'){$_POST['cambiar_mecanico'] = 0;}

if ($_POST['enviar_correo']== 'undefined'){$_POST['enviar_correo'] = 0;}

if($_POST['cambiar_mecanico'] == 1)

{$_POST['mecanico'] = $_POST['mecanico_nuevo'];}

$estado_a_grabar  = $_POST['estado'];

if($ultimo_estado <> '...')

		{

				if($_POST['estado']<>$_POST['ultimo_estado'])

				  {

					 echo 'los dos estados son diferentes';

					 $estado_a_grabar  = $_POST['ultimo_estado'];

					 

					 //

				  }

				 else

				 {   $estado_a_grabar  = $_POST['estado'];

				  

				 } 

  

		}// fin de if($ultimo_estado <> '...')

//echo '<br>valor de cambiar_mecanico'.$_POST['cambiar_mecanico'];



include('../valotablapc.php');
//actaulizar datos cliente

$sql_act_cliente = "update $tabla3 set 
identi ='".$_REQUEST['identificacion']."'
,nombre ='".$_REQUEST['nombre']."'
,telefono ='".$_REQUEST['telefono']."'
,email ='".$_REQUEST['email']."'
,direccion ='".$_REQUEST['direccion']."'
where  idcliente = '".$_REQUEST['idcliente']."'
 ";

$con_act_cliente = mysql_query($sql_act_cliente ,$conexion);


//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 

$sql_actualizar_orden = "update  $tabla14  set 

observaciones = '".$_POST['descripcion']."',

iva = '".$_POST['iva']."'

,kilometraje = '".$_POST['kilometraje']."'

,mecanico = '".$_POST['mecanico']."'

,kilometraje_cambio = '".$_POST['kilometraje_cambio']."'

,abono = '".$_POST['abono']."'

,estado = '".$estado_a_grabar."'

where id = '".$_POST['id_orden']."'

";



//echo '<br>'.$sql_actualizar_orden;

//exit();



$consulta_grabar = mysql_query($sql_actualizar_orden,$conexion); 



actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$id_orden,$conexion);



echo "<br><br><h2>ORDEN  ACTUALIZADA</h2>";

include('../colocar_links2.php');



//<a href="#">#</a>

//tabla24 nombres_items_carros

//tabla25 relacion_orden_inventario

function actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion)

{

  // echo '<br>pasoooooooooooooooooooooooooooo11111<br>';

   $sql_nombres_inventario = "select * from $tabla24 where id_empresa = '".$id_empresa."' order by id_nombre_inventario";

   //echo '<br>'.$sql_nombres_inventario.'<br>';

   $consulta_nombres_inventario = mysql_query($sql_nombres_inventario,$conexion);

   while ($nombres_items = mysql_fetch_assoc($consulta_nombres_inventario))

   		{

			//echo 'pasooooooo2222222222222222222222';

			//echo '<br>1 '.$nombres_items['id_nombre_inventario'];

			$id_de_nombre = $nombres_items['id_nombre_inventario'];

			//echo '<br>idnombre'.$id_de_nombre;

			$cantidad = 'cantidad_'.$id_de_nombre;

			//echo '<br>cantidad123 '.$cantidad;

			

			$consulta_actualizar_valor_cantidad ="update $tabla25  set   

					valor = '".$_REQUEST[$id_de_nombre]."',

					cantidad = '".$_REQUEST[$cantidad]."'

					where id_nombre_inventario = '".$id_de_nombre."'   

					and id_orden = '".$_REQUEST['id_orden']."' 

					and id_empresa = '".$_SESSION['id_empresa']."' ";

			//echo '<br>consulta_actualizar'.$consulta_actualizar_valor_cantidad.'<br>';

			$consulta_actulizar_valores = mysql_query($consulta_actualizar_valor_cantidad,$conexion);		

		}// fin del while 

   

   



}// fin de la funcion de actualizar_inventario_estado_vehiculo 


////////////////////////////////////////////
$sql_traer_iva = "select iva from $tabla17 ";
$con_iva = mysql_query($sql_traer_iva,$conexion);
$arr_iva = mysql_fetch_assoc($con_iva);
////////////////////////////////////////////
$sql_items= "select * from $tabla15 where no_factura =   '".$_REQUEST['id_orden']."'  ";

//echo '<br>'.$sql_items;
$consulta_items = mysql_query($sql_items);
$texto_items ='';
$suma_items = '0';
while($items = mysql_fetch_assoc($consulta_items))
{	
 $texto_items = $texto_items.'*'.$items['descripcion'];
if($items['codigo']=='man' || $items['codigo']=='MAN' ){
	$iva_item = ($items['total_item'] * $arr_iva['iva'])/100;
    $valor = $items['total_item'] + $iva_item;
}//fin de is es codigo de nomina man
else{
   $valor = $items['total_item'];
}//fin de else de si es de man
 $suma_items += $valor;
 //echo '<br>'.$items['descripcion'];
}


////////////////////////////////////////////////

$nombre_estado = busque_estado123($tabla26,$_REQUEST['estado'],$_SESSION['id_empresa'],$conexion);

if($_POST['enviar_correo'] > 0)
{
$body='GENERAL MOTOS  Te informa!!!
	   
	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden: '.$_REQUEST['orden_numero'].'
	   
	   Se encuentra en estado: '.$nombre_estado.'
	   
	   Items Orden
	 '.$texto_items.'

        Valor : '.number_format($suma_items, 0, ',', '.').'
   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!

	GENERAL MOTOS 
	Telefonos con whatsapp 
	Harrison Mosquera 311 849 62 94
	Carlos Redondo    310 698 27 97
	E-mail:  cmrb60@hotmail.com
	Direccion: Carrera 73d No 25 Bogota
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
	include('enviar_correo_cotiza.php');  
	
} //fin de if($_POST['enviar_correo'] == 1)

echo '<h2><a href="orden_imprimir_honda_cero.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA IMPRESION ORDEN</a></h2>';






function busque_estado123($tabla26,$id_estado,$id_empresa,$conexion)

	{

	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";

	  $consulta_estados = mysql_query($sql_estados,$conexion);

	  $resultado = mysql_fetch_assoc($consulta_estados);

	  $nombre_estado = $resultado['descripcion_estado'];

	  return $nombre_estado;

	}

?>