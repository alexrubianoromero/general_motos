<?php
/*
echo 'valores de enviar correo<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
/*
$headers = "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
*/

$sql_traer_correo = "select cli.email from $tabla3 cli
inner join $tabla4 c on (c.propietario = cli.idcliente)
where c.placa = '".$_REQUEST['placa']."'
    ";
//echo '<br>'.$sql_traer_correo;
$con_email = mysql_query($sql_traer_correo,$conexion);

$arr_email = mysql_fetch_assoc($con_email);

$email = $arr_email['email']; 

//echo 'email<br>'.$email;
//echo 'cuerpo<br>'.$body;
//$cabeceras  = 'MIME-Version: 1.0' . "\r\n";  
//$cabeceras .= 'Content-type: text/html;  charset=iso-8859-1' . "\r\n";
$headers .= "From: 	GENERAL MOTOS <cmrb60@hotmail.com>\r\n"; 
///////////////////////////////$cabeceras .= 'From: Alex Rubiano <alexrubianoromero@gmail.com>' . "\r\n";
//$cabeceras .= 'From: Formulario de Contacto Moleca IT <ventas@molecait.com>' . "\r\n";
//$cabeceras .= 'From: Formulario de Contacto Moleca IT <alexrubianoromero@gmail.com>' . "\r\n";
//$cabeceras .= 'From: Alex Rubiano <motorcycleroom@gmail.com>' . "\r\n";
//$cabeceras .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
mail($email,"MODIFICACION",$body,$headers); 

?>
