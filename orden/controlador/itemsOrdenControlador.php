<?php
// $raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
// require_once($raiz.'/orden/vista/itemsOrdenVista.php');

class itemsOrdenControlador
{
    // protected $modelItem;
    // protected $vista;

    public function __contruct()
    {
        // $this->modelItem = new itemsOrdenModelo();
        // $this->vista = new itemsOrdenVista();

        if($_REQUEST['opcion']=='verItemsOrden')
        {   
            die('llego aca  a controlador de items orden ');
            $this->verItemsOrden($_REQUEST);
        }
    }

    // public function verItemsOrden($request)
    // {
    //     die('llego al controlador');
    //     $items = $this->modelItem->traerItemsOrdenId($request['id']);
    //     $this->vista->mostrarItemsOrden($items); 
    // }
}

?>