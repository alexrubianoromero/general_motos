<?php 

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/clientes/model/ClienteModel.php');  
require_once($raiz.'/vehiculos/model/CarroModel.php');  
//  die('desde controlador'.$raiz);
class creacionOrdenVista
{
    protected $clienteModel; 
    protected $carroModel; 


    public function __construct()
    {
      $this->clienteModel = new ClienteModel(); 
      $this->carroModel = new CarroModel(); 
    
    }

    public function formuPedirPlacaNueva()
    {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      </head>
      <body>
        <div class="container" style="padding:2px;">
            <div class="row">
                <h3>CREACION DE ORDENES</h3>
            </div>
            <a href="../orden/index.php" class="btn btn-secondary">MENU ORDENES</a>
            <a href="../menu_principal.php"class="btn btn-secondary">MENU PRINCIPAL</a>
            <div class="row mt-3">

                <div class="col-lg-5 row">
                    <div class="col-lg-4">
                        <input placeholder="Placa" type="text"  id="placaABuscarEnBAseDatos" class="form-control" onkeyup="busquePlacasQueConicidan();">
                    </div>
                    <div class="col-lg-8"  id="divInfoPlaca">
                        <button class="btn btn-primary" onclick="muestreFormuNuevaPlaca();">NUEVA PLACA</button>
                    </div>
                    <div class="row mt-3" id="div_resultadosPlaca_new" style="padding:5px;"></div>
                </div>

                <div class="col-lg-5 row"  id="divDelMedio">
                    <!-- <label for="">El otro lado </label> -->
                    <div class="col-lg-12" id="div_info_propietario"></div>
                </div>

                <div class="col-lg-2 row" id="divUltimaParte" >
                    Div Final 
                </div>

            </div>
            <?php  $this->modalNuevoCliente();   ?>
            <?php  $this->modalHistorialMotos();   ?>

        </div>
       <script src="../orden/js/crearOrden.js"></script>         
      </body>
      </html>
      <?
    }





    public function modalNuevoCliente()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoCliente">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="colocarNuevoClienteEnSelect();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoPropietarioOrden();" >Grabar Propietario</button> -->
                  
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function modalHistorialMotos()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalHistorialMotos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyHistorialMotos">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="colocarNuevoClienteEnSelect();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoPropietarioOrden();" >Grabar Propietario</button> -->
                  
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function muestreInfoPlaca($datosPlaca)
    {
        echo  'la info de la placa es ';
        ?>
        <div >
            <label>Marca:</label>


        </div>
        <?php



    }

    public function muestreInfoPlacasQueCoinciden($placasCoicidencias)
    {
        echo '<table class="table table-striped">'; 
        echo '<tr>'; 
        echo '<td>PLACA</td>';
        echo '<td>LINEA</td>';
        echo '<td>PROPIETARIO</td>';
        echo '<td>IDENTIDAD</td>';
        echo '<td>CREAR</td>';
        echo '</tr>';
        foreach($placasCoicidencias as $placa)
        {
        //        echo '<pre>'; 
        // print_r($placa); 
        // echo '</pre>';
        // die(); 
        // echo '<br>'.$placa['placa'];
            $variablePlaca = $placa['placa'];
            $infoCliente = $this->clienteModel->traerClienteId($placa['propietario']); 
            echo '<tr>';
            echo '<td><button 
                        class=" btn btn-info btn-sm"
                        onclick="traerResumenInfoPlaca('.$placa['idcarro'].'); "
                        >'.$placa['placa'].'</button></td>';  
            echo '<td><button  
                        class=" btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalHistorialMotos"
                        onclick="traerHistorialMotosPlaca('.$placa['idcarro'].'); "
                        >'.$placa['tipo'].'</button ></td>';  
            echo '<td>'.$infoCliente['nombre'].'</td>';  
            echo '<td>'.$infoCliente['identi'].'</td>';  
            echo '<td><a class="btn btn-primary btn-sm" href="../orden/orden_captura_honda.php?placa123='.$placa['placa'].'"  >CrearOrden</a></td>';  
            echo '</tr>';     
        }
        echo '</table>';
    }
    
    public function formuNuevaPlaca()
    {
        ?>
            <h3>Nueva Placa</h3>
        <div class="row mt-2" >


                <!-- <div class="col-lg-2">
                    <label for="">Buscar:</label>
                </div> -->
                <div class="col-lg-6">
                    <input 
                        placeholder = "Buscar Nombre Cliente" 
                        class="form-control" 
                        type="text" 
                        id="inputBuscarPropietario"  
                        onkeyup ="buscarPropietarioDesdeOrden();" 
                    >
                </div>
                <div class="col-lg-6">
                    <button 
                        class="btn btn-primary btn-block" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNuevoCliente"
                        onclick ="llamarFormuNuevoProp();"
                    >Nuevo Propietario</button>
                </div>
                <div class="col-lg-4 mt-2">
                    <label for="">Propietario:</label>
                </div>
                <?php     
                    $propietarios = $this->clienteModel->traerClientes(); 
                ?>
                <div class="col-lg-8 mt-2">
                    <select id="idPropietario" class="form-control"  onclick = "escogioPropietario();">
                        <option value="-1">Seleccione...</option>    
                        <?php  $this->colocarPropietarios($propietarios)  ?> 
                    </select>
                </div>

                <?php  $this->formuDatosMoto();  ?>
            

        </div>

        <?php
    } 
    public function formuDatosMoto()
    {
      ?>
            
           <div class="row mt-3" style="padding:5px;">
                    Datos Moto:
                    <div class="row mt-2" id="divAdvertenciaPlaca" style="color:red;font-size:25px;"></div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <label for="">Placa:</label>
                            <input 
                                class="form-control" 
                                type ="text" 
                                id="txtPlaca"
                                onkeyup="revisarSiExistePlaca()"; 
                                >
                        </div>
                        <div class="col-lg-3">
                            <label for="">Marca:</label>
                            <input class="form-control" type ="text" id="txtMarca">
                        </div>
                        <div class="col-lg-3">
                            <label for="">Linea:</label>
                            <input class="form-control" type ="text" id="txtLinea">
                        </div>
                        <div class="col-lg-3">
                            <label for="">Modelo:</label>
                            <input class="form-control" type ="text" id="txtModelo">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <label for="">Chasis:</label>
                            <input class="form-control" type ="text" id="txtChasis">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Motor:</label>
                            <input class="form-control" type ="text" id="txtMotor">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <label for="">Soat:</label>
                            <input class="form-control" type ="date" id="txtSoat">
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="">Tecnomecanica:</label>
                            <input class="form-control" type ="date" id="txtTecnomecanica">
                        </div>
                    </div>
                    <div class="row mt-2">
                    <button class="btn btn-primary"  onclick="realizarGrabacionMoto();">GRABAR MOTO</button>
                    </div>

            </div>
      <?php
    }
    public function verInfoDatosMoto($idCarro)
    {
        $infoMoto = $this->carroModel->traerCarroId($idCarro); 
      ?>
           <div class="row mt-3" style="padding:5px;">
                    <h2>Datos Moto:</h2>
                    <div class="row mt-1">
                        <div class="col-lg-3">
                            <label for="">Placa:</label>
                            <?php echo $infoMoto['placa']?>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Marca:</label>
                            <?php echo $infoMoto['marca']?>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Linea:</label>
                            <?php echo $infoMoto['tipo']?>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Modelo:</label>
                            <?php echo $infoMoto['modelo']?>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <label for="">Chasis:</label>
                            <?php echo $infoMoto['chasis']?>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Motor:</label>
                            <?php echo $infoMoto['motor']?>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <label for="">Soat:</label>
                            <?php echo $infoMoto['vencisoat']?>
                        </div>
                        
                        <div class="col-lg-6">
                            <label for="">Tecnomecanica:</label>
                            <?php echo $infoMoto['revision']?>
                        </div>
                    </div>
                    <div class="row mt-1">
                    <!-- <button class="btn btn-primary"  onclick="realizarGrabacionMoto();">GRABAR MOTO</button> -->
                    </div>

            </div>
      <?php
    }
    public function colocarPropietarios($propietarios)
    {
        echo '<option value="-1">Seleccione...</option>'; 
        foreach($propietarios as $propietario)
        {
            echo '<option value="'.$propietario['idcliente'].'">'.$propietario['nombre'].'-'.$propietario['identi'] .'</option>';  
        }
       
    }

    public function llamarFormuNuevoProp()
    {
        ?>
            <div class="row">
            <div class="row mt-2" id="divAdvertenciaIdenti" style="color:red;font-size:25px;"></div>
                <div class=" row form-group mt-3">
                    <label class="col-lg-4"for="">Identidad</label>
                    <div class="col-lg-8">
                        <input 
                            class="form-control" 
                            type="text" 
                            id="txtIdenti"
                            onkeyup="verificarSiexisteIdentidad();"
                            >
                    </div>
                </div>
                <div class=" row form-group mt-3">
                    <label class="col-lg-4"for="">Nombre</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="txtNombre">
                    </div>
                </div>
                <div class=" row form-group mt-3">
                    <label class="col-lg-4"for="">Direccion</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="txtDireccion">
                    </div>
                </div>
                <div class=" row form-group mt-3">
                    <label class="col-lg-4"for="">Telefono</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="txtTelefono">
                    </div>
                </div>
                <div class=" row form-group mt-3">
                    <label class="col-lg-4"for="">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="txtEmail">
                    </div>
                </div>
                <div class=" row form-group mt-3">
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoPropietarioOrden();" >Grabar Propietario</button>
                </div>


            </div>
        <?php
    }

    public function mensajeClienteGrabado($idClienteGrabado)
    {
        ?>
        <div class="row">
            <h2>Cliente Grabado</h2>
            <input type="hidden" id="idClienteGrabado"  value="<?php echo $idClienteGrabado ?>">
            <div >
              <?php  $this->infoPropietario($idClienteGrabado,1)  ?>
            </div>
        </div>
        <?php
    }

    public function infoPropietario($idPropietario,$soloInfo=0)
    {
        $infoCliente = $this->clienteModel->traerClienteId($idPropietario); 
        ?>
    
         <div class="row">
            <h3>Info Propietario</h3>
                <div class=" row form-group mt-1">
                    <label class="col-lg-4"for="">Identidad</label>
                    <div class="col-lg-8">
                        <?php  echo $infoCliente['identi'] ?>
                    </div>
                </div>
                <div class=" row form-group mt-1">
                    <label class="col-lg-4"for="">Nombre</label>
                    <div class="col-lg-8">
                    <?php  echo $infoCliente['nombre'] ?>
                    </div>
                </div>
                <div class=" row form-group mt-1">
                    <label class="col-lg-4"for="">Direccion</label>
                    <div class="col-lg-8">
                    <?php  echo $infoCliente['direccion'] ?>
                    </div>
                </div>
                <div class=" row form-group mt-1">
                    <label class="col-lg-4"for="">Telefono</label>
                    <div class="col-lg-8">
                    <?php  echo $infoCliente['telefono'] ?>
                    </div>
                </div>
                <div class=" row form-group mt-1">
                    <label class="col-lg-4"for="">Email</label>
                    <div class="col-lg-8">
                    <?php  echo $infoCliente['email'] ?>
                    </div>
                </div>
                <?php
                    if($soloInfo == 0)
                    {
                ?>
                <div class=" row form-group mt-1">
                    <button  
                        type="button" 
                        class="btn btn-primary"  
                        id="btnModificarPropietario"  
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNuevoCliente"
                        onclick="formuModificarPropietarioOrden(<?php  echo $infoCliente['idcliente']  ?>);" 
                    >Modificar</button>
                </div>
               <?php } ?>

            </div>

  

        <?php
    }
    
    public function formuModificarPropietarioOrden($idCliente)
    {
        
        $infoCliente = $this->clienteModel->traerClienteId($idCliente); 
        // echo '<pre>'; 
        // print_r($infoCliente); 
        // echo '</pre>';
        // die();

        ?>
        <div class="row">
            <div class=" row form-group mt-3">
                <label class="col-lg-4"for="">Identidad</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="txtIdentiMod" value=" <?php  echo $infoCliente['identi'] ?>">
                </div>
            </div>
            <div class=" row form-group mt-3">
                <label class="col-lg-4"for="">Nombre</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="txtNombreMod" value=" <?php  echo $infoCliente['nombre'] ?>">
                </div>
            </div>
            <div class=" row form-group mt-3">
                <label class="col-lg-4"for="">Direccion</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="txtDireccionMod" value=" <?php  echo $infoCliente['direccion'] ?>">
                </div>
            </div>
            <div class=" row form-group mt-3">
                <label class="col-lg-4"for="">Telefono</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="txtTelefonoMod" value=" <?php  echo $infoCliente['telefono'] ?>">
                </div>
            </div>
            <div class=" row form-group mt-3">
                <label class="col-lg-4"for="">Email</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" id="txtEmailMod" value=" <?php  echo $infoCliente['email'] ?>">
                </div>
            </div>
            <div class=" row form-group mt-3">
                <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="actualizarPropietarioOrden(<?php  echo $infoCliente['idcliente']  ?>);" >Actualizar Propietario</button>
            </div>


        </div>
    <?php
    }

    public function resumenCreacionMoto($idMoto)
    {
        echo '<h2>Resumen Moto</h2>';

        $infoMoto = $this->carroModel->traerCarroId($idMoto); 
        // $infoCliente = $this->clienteModel->traerClienteId($infoMoto['propietario']); 
        $this->infoPropietario($infoMoto['propietario'],1);

        $this->verInfoDatosMoto($idMoto);
      
        echo ' <div class="row" style="padding:20px;">';
        echo '<a class="btn btn-primary btn-block" href="../orden/orden_captura_honda.php?placa123='.$infoMoto['placa'].'">Crear Orden</a>';
        echo '</div>';
    
        

    }

    public function traerResumenInfoPlaca($idCarro)
    {
        $infoCarro = $this->carroModel-> traerCarroId($idCarro);
        $infoCliente = $this->clienteModel->traerClienteId($infoCarro['propietario']); 
        ?>
             <div class="row" style="padding:5px;">

                 Info Placa:
                 <div >
                     <label>Placa:</label>
                     <?php echo $infoCarro['placa'];    ?>
                    </div> 
                    <div>
                        <label>Marca:</label>
                        <?php echo $infoCarro['marca'];    ?>
                    </div> 
                    <div>
                        <label>Tipo:</label>
                        <?php echo $infoCarro['tipo'];    ?>
                    </div> 
                    <div>
                        <label>Modelo:</label>
                        <?php echo $infoCarro['modelo'];    ?>
                    </div> 
                    <div>
                        <label>Propietario Actual:</label>
                        <?php echo $infoCliente['nombre'].'-'.$infoCliente['identi'];    ?>
                        
                    </div> 
                    <div class="mt-3">
                        <label>Nuevo Propietario :</label>
                        
                        <input 
                        placeholder = "Buscar Nombre Nuevo Propietario" 
                        class="form-control" 
                        type="text" 
                        id="inputBuscarPropietario"  
                        onkeyup ="buscarPropietarioDesdePlaca();" 
                        >
                        
                    </div> 
                    <div class="mt-3">
                        <select class="form-control"  id="idNuevoPropietario">
                            <option value="-1">Seleccione...</option>
                            <?php  
                       $propietarios = $this->clienteModel->traerClientes(); 
                       $this->colocarPropietarios($propietarios)  ?> 
                </select>
            </div>
            <div class="mt-3">
                <button  class="btn btn-primary btn-block"  onclick="actualizarPropietarioOrdenNuevo(<?php echo $idCarro  ?>); ">Actualizar Propietario </button>
            </div>
            
        </div>
            
            <?php
    }

    public function traerHistorialInfoPlaca($ordenes,$placa)
    {
        echo '<table class="table table-striped">'; 
        echo '<tr><h3>HISTORIAL Placa: '.$placa.'</h3></tr>';
        echo '<tr>'; 
        echo '<td>FECHA</td>';
        echo '<td>ORDEN</td>';
        echo '<td>OBSERVACIONES</td>';
       
        echo '</tr>';
        foreach($ordenes as $orden)
        {
            echo '<tr>';
            echo '<td>'.$orden['fecha'].'</td>';  
            echo '<td>'.$orden['orden'].'</td>';  
            echo '<td>'.$orden['observaciones'].'</td>';  
            echo '</tr>';     
        }
        echo '</table>';
    }
}
