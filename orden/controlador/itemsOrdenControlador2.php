<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/orden/vista/itemsOrdenVista.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');

class itemsOrdenControlador2
{
    protected $modelItem;
    protected $vista;
    protected $modelOrden;
    public function __construct()
    {
        
        $this->modelItem = new itemsOrdenModelo();
        $this->vista = new itemsOrdenVista();
        $this->modelOrden = new OrdenesModelo(); 
        // echo 'buenas llego a items';
        if($_REQUEST['opcion']=='verItemsOrden')
        {   
            $this->verItemsOrden($_REQUEST);
        }
    }
        public function verItemsOrden($request)
    {
        //  die('llego a la funcion verItemsOrden');
        $datosOrden = $this->modelOrden->traerOrdenId($request['id']); 
        $items = $this->modelItem->traerItemsOrdenId($request['id']);
        $this->vista->mostrarItemsOrdenConMecanico($items,$datosOrden); 
    }

}


?>


