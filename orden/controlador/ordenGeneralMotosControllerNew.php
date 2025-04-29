<?php 

$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/orden/vista/creacionOrdenVista.php'); 
require_once($raiz.'/orden/vista/ordenesVistaGeneralMotosView.php'); 
require_once($raiz.'/vehiculos/model/CarroModel.php');  
require_once($raiz.'/clientes/model/ClienteModel.php');  
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');  
require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');  


class ordenGeneralMotosControllerNew
{
    protected $vista;
    protected $carroModel; 
    protected $clienteModel; 
    protected $ordenModel; 
    protected $codigoModel; 


    public function __construct()
    {
        session_start();
        //    echo '<pre>'; 
        //      print_r($_SESSION); 
        //      echo '</pre>';
        //     die('desde controlador '); 
        $this->vista = new ordenesVistaGeneralMotosView();
        $this->carroModel = new CarroModel();
        $this->clienteModel = new ClienteModel(); 
        $this->ordenModel = new OrdenesModelo(); 
        $this->codigoModel = new CodigosInventarioModelo(); 
        

        if(!isset($_REQUEST['opcion']) || $_REQUEST['opcion']=='')
        {
            // echo 'no se envio opcion';
            //aqui debe enviar el formu para pedir la placa 
            // $this->pedirPlacaNueva();
            // echo 'desde controllador ...';
            $ordenes = $this->ordenModel->traerOrdenesEnProceso();
            $this->vista->vistaPrincipalConsultaOrdenes($ordenes); 
        }

        
        if($_REQUEST['opcion']=='mostrarFormuModificarOrden')
        {
            $this->vista->mostrarFormuModificarOrden($_REQUEST['idOrden']); 
            // $this->vista->mostrarFormuAnteriorModificarOrden($_REQUEST['idOrden']); 
        }

        if($_REQUEST['opcion']=='revisarbuscarCodigoNew')
        {

            // echo 'buenasssss desde controlador nuevo '; 
            //buscar el codigo y traer la info  
            
            // $this->vista->mostrarFormuModificarOrden($_REQUEST['idOrden']); 
            // $this->vista->mostrarFormuAnteriorModificarOrden($_REQUEST['idOrden']); 
            $this->revisarbuscarCodigoNew($_REQUEST);
        }
        
    }
    
    public function revisarbuscarCodigoNew($request)
    {

        // echo 'buenas desde metodo'; 
        $infoCodigo =  $this->codigoModel->traerInfoCodeConCode($request['codigo']);  
            //   echo '<pre>'; 
            //  print_r($infoCodigo); 
            //  echo '</pre>';
            // die('desde controlador '); 
            echo json_encode($infoCodigo);
    }
}




?>