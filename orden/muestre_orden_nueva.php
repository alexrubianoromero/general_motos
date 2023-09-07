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
//include('../funciones.php');

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
 and o.tipo_orden < '2' and o.anulado = '0'  order by o.id desc ";
//echo '<br>'.$sql_muestre_ordenes;
//inner join $tabla3 cli on (cli.idcliente = c.propietario)
//cli.nombre
//$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);




?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES NUEVA</h2>
		</header>
	
<?php
include('../colocar_links2.php');
echo 'PROPIETARIO<br><input class="fila_llenar" tye = "text" id="busqueda_nombre" placeholder="NOMBRE A BUSCAR" size="25%">';
echo '<input size="40px"type="text" name = "nombre_propietario"  id= "nombre_propietario">';	
echo '<input size="30px"type="hidden" name = "propietario"  id= "propietario">';	
echo '<button id="consultar_ordenes_nombre">CONSULTAR</button>'; 
echo '<div id="div_propietario">';
echo '</div>'; 

echo '<br>';
echo '<div id="div_prueba"></div>';

echo '<div id="div_mostrar_ordenes">';
include('muestre_orden_solo_nombre.php');
echo '</div>';
echo '</div>';
//////////////


/////////////

?>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            $(document).ready(function(){
            	/////////////////////
					 $("#busqueda_nombre").keyup(function(e){
					     	var data =  'nombre=' + $("#busqueda_nombre").val();
							$("#div_propietario").css("display","block")
							//$("#mostrar_select").css("display","block")
							$.post('consultar_nombre.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_propietario").html(a);
													//alert(data);
							});	
	 
   						});
					//////////////////////////	
					////////////////////////
					$("#propietario123").change(function(){ 
					var valor=$("#propietario123").val();
					//alert('valor propietario'+valor);	
					var texto=$("#propietario123 option:selected").text();
					$("#propietario").val(valor);
					//$("#nombre_propietario").val(texto);
					$("#div_propietario").css("display","none")
						var data =  'idcliente=' + $("#propietario").val();
						$.post('muestre_orden_solo_nombre.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_prueba").html(a);
													//alert(data);
							});	

					});
					//////////////////////////////
					/////////////////////////
					$("#consultar_ordenes_nombre").click(function(){
							$("#div_propietario").css("display","none")
							var data =  'idcliente=' + $("#propietario").val();
							$.post('muestre_orden_solo_nombre.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_mostrar_ordenes").html(a);
								//alert(data);
							});	
						 });
					////////////////////////


					//////////////////////////////
			


			});			  
</script>				

