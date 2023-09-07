<?php
include('../valotablapc.php');



$sql_traer_duplicados ="select placa , count(*) as numero  from $tabla4
group by placa
HAVING count(*) > 1";
//echo '<br>'.$sql_traer_duplicados;
$consulta_duplicados = mysql_query($sql_traer_duplicados,$conexion);
include('../colocar_links2.php');

echo '<br>SE CORRIGIERON LOS SIGUIENTES PLACAS DUPLICADAS<BR><BR>';
echo '<table border ="1">';
echo '<tr>';
echo '<td>PLACA</td>';
echo '<td>NUMERO</td>';
echo '</tr>';
while($duplicados = mysql_fetch_assoc($consulta_duplicados))
{
	$sql_id_mas_alto = "select max(idcarro) as maximo from $tabla4 where placa = '".$duplicados['placa']."' ";
	$consulta_maximo = mysql_query($sql_id_mas_alto,$conexion);
	$arreglo_maximo = mysql_fetch_assoc($consulta_maximo);
    /////////////////
	 $actulizaridempresa = "update $tabla4 set id_empresa = '40' where idcarro = '".$arreglo_maximo['maximo']."' ";
     $consulta_actulizarid = mysql_query($actulizaridempresa,$conexion);
	//////////////////
	$sql_quitar_elresto = "delete from $tabla4  where placa = '".$duplicados['placa']."'  and idcarro < '".$arreglo_maximo['maximo']."' ";
 	$consulta_quitarelresto = mysql_query($sql_quitar_elresto,$conexion);

 	//echo '<br>'.$sql_quitar_elresto;
 	echo '<tr>';
	echo '<td>'.$duplicados['placa'].'</td>';
	echo '<td>'.$duplicados['numero'].'</td>';
	//echo '<td>'.$arreglo_maximo['maximo'].'</td>';
	echo '</tr>';	

}//fin de while 
echo '</table>';
?>