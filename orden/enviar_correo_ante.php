<?php
include('../valotablapc.php');
echo '<pre>';

print_r($_REQUEST);

echo '</pre>';

$sql_traer_correo = "select cli.email from $tabla3 cli
inner join $tabla4 c on (c.propietario = cli.idcliente)
where c.placa = '".$_REQUEST['placa']."'
    ";
echo '<br>'.$sql_traer_correo;
$con_email = mysql_query($sql_traer_correo,$conexion);

$arr_email = mysql_fetch_assoc($con_email);

$email = $arr_email['email']; 


echo 'email<br>'.$email;
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
//los que yo tenia$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: General Motos <alexrubianoromero@gmail.com>\r\n"; 
//$headers .= 'From: Birthday Reminder <birthday@example.com>';
//$headers .= "Cc:Alex <alexrubianoromero@hotmail.com>\r\n";
//$headers .= "Cc:arsolution <gerentegeneral@arsolutiontechnology.com>\r\n";
  ////////////////////////////////$headers .= "Cc: Motorcycle Room <motorcycleroom@gmail.com>\r\n";
//$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 

//echo '<br>email'.$_REQUEST['email'];
//mail ("ventas@molecait.com,$email",$asunto,$mensaje,$cabeceras);
mail($email,"BIENVENIDA",$body,$headers); 

?>
