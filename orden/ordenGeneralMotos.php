<?php
date_default_timezone_set('America/Bogota');
$raiz = dirname(dirname(__file__));
//  die($raiz);
require_once($raiz.'/orden/controlador/ordenGeneralMotosControllerNew.php');  
$ordenGeneralMotosController = new ordenGeneralMotosControllerNew();

?>