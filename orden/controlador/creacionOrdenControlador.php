<?php 

$raiz = dirname(dirname(dirname(__file__)));
//  die('desde controlador'.$raiz);
require_once($raiz.'/orden/vista/creacionOrdenVista.php');  
require_once($raiz.'/vehiculos/model/CarroModel.php');  
require_once($raiz.'/clientes/model/ClienteModel.php');  
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');  

class creacionOrdenControlador
{
    protected $vista;
    protected $carroModel; 
    protected $clienteModel; 
    protected $ordenModel; 

    public function __construct()
    {
        session_start();
        //    echo '<pre>'; 
        //      print_r($_SESSION); 
        //      echo '</pre>';
        //     die('desde controlador '); 
        $this->vista = new creacionOrdenVista();
        $this->carroModel = new CarroModel();
        $this->clienteModel = new ClienteModel(); 
        $this->ordenModel = new OrdenesModelo(); 

        if(!isset($_REQUEST['opcion']) || $_REQUEST['opcion']=='')
        {
            // echo 'no se envio opcion';
            //aqui debe enviar el formu para pedir la placa 
            $this->pedirPlacaNueva();

        }

        if($_REQUEST['opcion']=='busquePlacaNueva123')
        {
            //  echo '<pre>'; 
            //  print_r($_REQUEST); 
            //  echo '</pre>';
            // die('desde controlador '); 
            $this->busquePlacaNueva123($_REQUEST); 
        }
        if($_REQUEST['opcion']=='busquePlacasQueConicidan')
        {
            //  echo '<pre>'; 
            //  print_r($_REQUEST); 
            //  echo '</pre>';
            // die('desde controlador '); 
            $this->busquePlacasQueConicidan($_REQUEST); 
        }
        if($_REQUEST['opcion']=='busquePlacasQueConicidanIdCarro')
        {
            //  echo '<pre>'; 
            //  print_r($_REQUEST); 
            //  echo '</pre>';
            // die('desde controlador '); 
            $this->busquePlacasQueConicidanIdCarro($_REQUEST); 
        }

        
        if($_REQUEST['opcion']=='muestreFormuNuevaPlaca')
        {
            $this->vista->formuNuevaPlaca($_REQUEST); 
        }
        if($_REQUEST['opcion']=='buscarPropietarioDesdeOrden')
        {
            $this->buscarPropietarioDesdeOrden($_REQUEST); 
        }
        
        if($_REQUEST['opcion']=='llamarFormuNuevoProp')
        {
            $this->vista->llamarFormuNuevoProp($_REQUEST); 
        }
        
        if($_REQUEST['opcion']=='grabarNuevoPropietarioOrden')
        {
            $this->grabarNuevoPropietarioOrden($_REQUEST); 
        }
        if($_REQUEST['opcion']=='colocarNuevoClienteEnSelect')
        {
            $this->colocarNuevoClienteEnSelect($_REQUEST); 
        }
        if($_REQUEST['opcion']=='escogioPropietario')
        {
            $this->vista->infoPropietario($_REQUEST['idPropietario']); 
        }
        if($_REQUEST['opcion']=='mostrarPropietarioActualizado')
        {
            $this->vista->infoPropietario($_REQUEST); 
        }
        if($_REQUEST['opcion']=='traerResumenInfoPlaca')
        {
            $this->vista->traerResumenInfoPlaca($_REQUEST['idCarro']); 
        }
        if($_REQUEST['opcion']=='traerHistorialInfoPlaca')
        {
            $this->traerHistorialInfoPlaca($_REQUEST); 
        }
        
        if($_REQUEST['opcion']=='formuModificarPropietarioOrden')
        {
            // echo '<pre>'; 
            // print_r($_REQUEST); 
            // echo '</pre>';
            // die();
            $this->vista->formuModificarPropietarioOrden($_REQUEST['idCliente']); 
        }
        if($_REQUEST['opcion']=='actualizarPropietarioOrden')
        {
            $this->actualizarPropietarioOrden($_REQUEST); 
            echo 'Cliente Actualizado'; 
        }
        if($_REQUEST['opcion']=='realizarGrabacionMoto')
        {
            $this->realizarGrabacionMoto($_REQUEST); 
        }
        if($_REQUEST['opcion']=='revisarSiExistePlaca')
        {
            $this->revisarSiExistePlaca($_REQUEST); 
        }
        if($_REQUEST['opcion']=='verificarSiexisteIdentidad')
        {
            $this->verificarSiexisteIdentidad($_REQUEST); 
        }
        
        if($_REQUEST['opcion']=='actualizarPropietarioOrdenNuevo')
        {
            $this->actualizarPropietarioOrdenNuevo($_REQUEST); 
        }
        if($_REQUEST['opcion']=='traerHistorialMotosPlaca')
        {
            $this->traerHistorialMotosPlaca($_REQUEST); 
        }
        
    }



    public function traerHistorialMotosPlaca($request)
    {
        $infoCarro = $this->carroModel->traerCarroId($request['idCarro']); 
        $ordenesPlaca =  $this->ordenModel->traerOrdenesConPlaca($infoCarro['placa']); 
        $this->vista->traerHistorialInfoPlaca($ordenesPlaca,$infoCarro['placa']); 
        
    }
    public function traerHistorialInfoPlaca($request)
    {
        $infoCarro = $this->carroModel->traerCarroId($request['idCarro']); 
        $ordenesPlaca =  $this->ordenModel->traerOrdenesConPlaca($infoCarro['placa']); 
        $this->vista->traerHistorialInfoPlaca($ordenesPlaca,$infoCarro['placa']); 
        
    }
    public function actualizarPropietarioOrdenNuevo($request)
    {
        //     echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        $this->carroModel->actualizarPropietarioMoto($request['idCarro'],$request['idCliente']); 
        // $this->vista->traerResumenInfoPlaca($_REQUEST['idCarro']); 
        
    }
    public function verificarSiexisteIdentidad($request)
    {
        $consuIdenti = $this->clienteModel->verificarClienteIdenti($request['identi']); 
        //     echo '<pre>'; 
        // print_r($consuPlaca); 
        // echo '</pre>';
        // die();
        if($consuIdenti['filas']>0)
        {
            echo 'Esta Identidad ya Existe';
        }
        else{
            echo '';
        }
        // $this->vista->resumenCreacionMoto($maxIdMoto);
    }

    public function revisarSiExistePlaca($request)
    {
        $consuPlaca = $this->carroModel->verificarCarroPlaca($request['placa']); 
        //     echo '<pre>'; 
        // print_r($consuPlaca); 
        // echo '</pre>';
        // die();
        if($consuPlaca['filas']>0)
        {
            echo 'Esta placa ya Existe';
        }
        else{
            echo '';
        }
        // $this->vista->resumenCreacionMoto($maxIdMoto);
    }
    public function realizarGrabacionMoto($request)
    {
        //     echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        //verificar que la placa no este ya grabada
        $verificarPlaca = $this->carroModel->verificarCarroPlaca($request['placa']);
        if($verificarPlaca['filas']==0)
        {
            $maxIdMoto = $this->carroModel->realizarGrabacionMoto($request); 
            $this->vista->resumenCreacionMoto($maxIdMoto);
        }else{
            echo 'Esta placa no se puede registrar dos veces';
        }

    }
    public function actualizarPropietarioOrden($request)
    {
        //     echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        $this->clienteModel->actualizarClienteId($request); 
        // $this->vista->colocarPropietarios($propietario);

    }
    public function colocarNuevoClienteEnSelect($request)
    {
        // echo 'UltimoId '.$ultimoId;
        $propietario= $this->clienteModel->traerClientesFiltroId($request['idCliente']); 
            // echo '<pre>'; 
        // print_r($propietario); 
        // echo '</pre>';
        $this->vista->colocarPropietarios($propietario);

    }
    public function colocarNuevoClienteEnSelectNew($request)
    {
        // echo 'UltimoId '.$ultimoId;
        $propietario= $this->clienteModel->traerClientesFiltroId($request['idCliente']); 
            // echo '<pre>'; 
        // print_r($propietario); 
        // echo '</pre>';
        $this->vista->colocarPropietarios($propietario);

    }

    public function grabarNuevoPropietarioOrden($request)
    {
        $ultimoId = $this->clienteModel->grabarCLienteNuevoOrden($request); 
        // echo 'UltimoId '.$ultimoId;
        // $propietariosFiltro = $this->clienteModel->traerClienteId($ultimoId); 
        $this->vista->mensajeClienteGrabado($ultimoId);

    }

    public function buscarPropietarioDesdeOrden($request)
    {
        $propietariosFiltro = $this->clienteModel->traerClientesFiltro($request['nombre']); 
        $this->vista->colocarPropietarios($propietariosFiltro);
    }


    public function pedirPlacaNueva()
    {
        $this->vista->formuPedirPlacaNueva();
    }
    
    public function busquePlacaNueva123($request)
    {
        $infoCarro = $this->carroModel->busquePlacaNueva123($request['placa']);
        // echo '<pre>'; 
        // print_r($infoCarro); 
        // echo '</pre>';
        if($infoCarro['filas']>0)
        {
            //muestre info placa 
            $this->vista->muestreInfoPlaca($request['datos']);
        }else{
            echo 'Esta placa No existe en el sistema'; 
        }

    }
    public function busquePlacasQueConicidan($request)
    {
        $placasCoicidencias = $this->carroModel->busquePlacasQueConicidan($request['placa']);
        // echo '<pre>'; 
        // print_r($placasCoicidencias); 
        // echo '</pre>';
        // die(); 
            //muestre info placa 
            $this->vista->muestreInfoPlacasQueCoinciden($placasCoicidencias);
    }

    public function busquePlacasQueConicidanIdCarro($request)
    {
        $placasCoicidencias = $this->carroModel->busquePlacasQueConicidanIdCarro($request['idCarro']);
        // echo '<pre>'; 
        // print_r($placasCoicidencias); 
        // echo '</pre>';
        // die(); 
            //muestre info placa 
            $this->vista->muestreInfoPlacasQueCoinciden($placasCoicidencias);
    }




}