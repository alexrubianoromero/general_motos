<?PHP

session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/


include('../valotablapc.php');

$sql_grabar_item = "insert into $item_orden_cotizaciones (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado,repman)

values ('".$_POST['id_cotizacion']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',

'".$_POST['totalpan']."','".$_POST['valor_unit']."','".$_REQUEST['id_empresa']."','0','".$_POST['repman']."')";

//echo '<br>'.$sql_grabar_item;

$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);


include('mostrar_items.php');

mostrar_items($_REQUEST['id_cotizacion']);

?>
