<?php
session_start();
//echo 'id_empresa '.$_SESSION['id_empresa'];
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
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
 where o.id_empresa = '".$_SESSION['id_empresa']."' 
 and o.tipo_orden < '2' and o.anulado = '0'  
and estado = '0'
 order by o.id desc ";
//echo '<br>'.$sql_muestre_ordenes;
//inner join $tabla3 cli on (cli.idcliente = c.propietario)
//cli.nombre
$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);




?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
	
<?php
include('../colocar_links2.php');


/*
echo '<div id="div_menu_arriba">';
//echo'<input type="text" id="filtrar_nombre" name = "filtrar_nombre" placeholder="DIGITE NOMBRE Y ENTER">';

echo '<table border= "1">';
echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
*/
echo '<br>';

echo '<div id="div_mostrar_ordenes">';
echo '<table border= "1">';
	echo '<tr>';
	echo '<td><h3>No Orden<h3></td><td><h3>Estado</h3></td><td><h3>Linea</h3></td><td><h3>Fecha</h3></td><td><h3>Placa</h3></td>';
	echo '<td><h3>Propietario</h3></td>';
	echo '<td><h3>Tecnico</h3></td>';
	
    echo '<td><h3>modificar_honda</h3></td>';
	

		 
	if($_SESSION['id_empresa'] == '40' )
	
	     {echo '<td><h3>Vista Impresion</h3></td>'; }
	
	echo '<tr>';
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				
				$sql_traer_propietario = "select nombre from $tabla3 where idcliente =  '".$ordenes['8']."' ";
				$consulta_nombre_propietario = mysql_query($sql_traer_propietario,$conexion);
				$arreglo_nombre_prop = mysql_fetch_assoc($consulta_nombre_propietario);
				$nombre_estado = busque_estado($tabla26,$ordenes[6],$_SESSION['id_empresa'],$conexion);
				$sql_traer_tipo  = "select tipo from $tabla4 where placa='".$ordenes['2']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
				$consulta_tipo = mysql_query($sql_traer_tipo,$conexion);
				$linea_tipo = mysql_fetch_assoc($consulta_tipo);
				$linea_tipo = $linea_tipo['tipo'];
				//////////////////////////////////
				$nombre_mecanico = buscar_mecanico($tabla21,$ordenes['7'],$id_empresa,$conexion);
				/////////////////////////////////
				//aqui se definiran los colores a usar
				
				if($ordenes[6] == 0){ echo '<tr class="fila_blanca">'; }
				if($ordenes[6] == 1){ echo '<tr class="fila_amarilla">'; }
				if($ordenes[6] == 2){ echo '<tr class="fila_verde">'; }
				
				echo '<td><h3>'.$ordenes['4'].'</h3></td><td><h3>'.$nombre_estado.'</h3></td><td><h3>'.$linea_tipo.'</h3></td><td><h3>'.$ordenes['1'].'</h3></td><td><h3>'.$ordenes['2'].'</h3></td>';
				echo '<td><h3>'.$arreglo_nombre_prop['nombre'].'</h3></td>';
				echo '<td><h3>'.$nombre_mecanico.'</h3></td>';
				
				 echo  '<td><h3>';
				echo '<a href="orden_modificar_honda.php?idorden='.$ordenes['0'].'">Modificar</a>';
				echo '</h3></td>';
				
		
		
				if($_SESSION['id_empresa'] == '40' )
				{						
					echo  '<td><h3>';
					echo '<a href="orden_imprimir_honda_cero.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a>';
					echo '</h3></td>'; 
				}
				echo '<tr>';
			}
echo '<table border= "1">';
echo '</div>';
echo '</div>';
//////////////
function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
	
/////////////
function buscar_mecanico($tabla21,$id_mecanico,$id_empresa,$conexion)
{
 $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$id_mecanico."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
					return $nombre_mecanico;
}//fin de la funcion


/////////////

?>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            
			
</script>				

