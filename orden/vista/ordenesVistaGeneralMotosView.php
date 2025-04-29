<?php 

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vehiculos/model/CarroModel.php');  
require_once($raiz.'/clientes/model/ClienteModel.php');  
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');  
require_once($raiz.'/tecnicos/model/TecnicoModel.php');  
require_once($raiz.'/vista/vista.php');  


class ordenesVistaGeneralMotosView extends vista
{
    protected $carroModel; 
    protected $clienteModel; 
    protected $ordenModel; 
    protected $tecnicoModel; 

    public function __construct()
    {
        $this->carroModel = new CarroModel();
        $this->clienteModel = new ClienteModel(); 
        $this->ordenModel = new OrdenesModelo(); 
        $this->tecnicoModel = new TecnicoModel(); 
    }
    public function vistaPrincipalConsultaOrdenes($ordenes)
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
        <body class="container">
            <div class="row mt-3">
                <div>
                    <h3>CONSULTA DE ORDENES EN PROCESO</h3>
                    <a href="../orden/index.php" class="btn btn-secondary">MENU ORDENES</a>
            <a href="../menu_principal.php"class="btn btn-secondary">MENU PRINCIPAL</a>
                </div>
                <div class="mt-3 col-lg-12" id="div_resultados_ordenes_proceso" style="font-size:17px;">
                    <?php $this->mostrarOrdenes($ordenes)   ?>
                </div>
            </div>
            <?php $this->modalModificarOrden(); ?>
        </body>
        </html>
        <script>
                    
            function mostrarFormuModificarOrden(idOrden)
            {
                // alert(idOrden);
                const http=new XMLHttpRequest();
                const url = '../orden/ordenGeneralMotos.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                    document.getElementById("modalBodyModificarOrden").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion='+ 'mostrarFormuModificarOrden'
                +'&idOrden='+ idOrden 
                );
            }

            function revisarbuscarCodigoNew()
            {
                var codigo = document.getElementById("codigopan").value;
                if (event.which  == 13)
                {
                    // alert('digito enter');
                    
                    // alert('codigo '+ codigo);
                    const http=new XMLHttpRequest();
                    const url = 'ordenGeneralMotos.php';
                    http.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status ==200){
                            var resp = JSON.parse(this.responseText);
                            // alert(resp.descripcion)
                            document.getElementById("descripan").value = resp.descripcion; ;
                            document.getElementById("valor_unit").value = resp.valor_unit; ;
                            document.getElementById("exispan").value = resp.cantidad; ;
                        }
                    };
                    
                    http.open("POST",url);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send("opcion=revisarbuscarCodigoNew"
                    + "&codigo="+codigo
                    );

                }
            }

            function multiplicarCantidadXValorUnit()
            {
                var valor_unit = document.getElementById("valor_unit").value;
                var cantipan = document.getElementById("cantipan").value;
                var resul = valor_unit*cantipan; 
                var cantipan = document.getElementById("totalpan").value= resul;
            }
            
            function agregarItemOrdenNew()
            {
                alert('Agregar item '); 
            }
        </script>
        <script src ="../../js/jquery-2.1.1.js"></script>
        <script src ="../js/orden.js"></script>
        <!-- <script src ="../js/ordenNueva.js"></script> -->
        <?php
    }

    public function modalModificarOrden()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalModificarOrden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ModificarOrden.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyModificarOrden" >
                    
                </div>
                <div class="modal-footer">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="hardwareMenu();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="realizarCargaArchivo();" >SubirArchivo++</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function mostrarOrdenes($ordenes)
    {
        ?>
         <!-- <button class="btn btn-menu">Prueba</button> -->
    <table class="table  table-hover table-bordered">
            <thead>

                <tr class="table-dark">
                    <td>No Orden</td>
                    <td>Estado</td>
                    <td>Linea</td>
                    <td>Fecha</td>
                    <td>placa</td>
                    <td>Propietario</td>
                    <td>Tecnico</td>
                    <td>Modificar</td>
                    <td>Impresion</td>
                    <td>Pdf</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($ordenes as $orden)
                    {
                        // die(); 
                        $infoCarro = $this->carroModel->verificarCarroPlaca($orden['placa']);
                        $inforCliente = $this->clienteModel->traerClienteId($infoCarro['datos']['propietario']);  
                        $infoTecnico = $this->tecnicoModel->traerTecnicoId($orden['mecanico']);    
                        // echo '<pre>'; 
                        // print_r($inforCliente); 
                        // echo '</pre>';
                        echo '<tr>'; 
                        echo '<td>'.$orden['orden'].'</td>';
                        echo '<td>'.$orden['estado'].'</td>';
                        echo '<td>'.$orden['tipo'].'</td>';
                        echo '<td>'.$orden['fecha'].'</td>';
                        echo '<td>'.$orden['placa'].'</td>';
                        echo '<td>'.$inforCliente['nombre'].'</td>';
                        echo '<td>'.$infoTecnico['nombre'].'</td>';
                        echo '<td>
                                <button type="button" 
                                class="btn btn-primary " 
                                onclick="mostrarFormuModificarOrden('.$orden['id'].')"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalModificarOrden"
                                >
                                <?php

                                ?>
                            Modificar
                        </button></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        // echo '<td><button class ="btn btn-primary" onclick ="agregarMemoriaRam('.$request['idHardware'].','.$memoria['id'].','.$request['numeroRam'].');">Agregar</button></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
          </table>



        <?php
    }

    public function mostrarFormuModificarOrden($idOrden)
    {
        // echo 'llego a modificar idOrden '.$idOrden; 
        $infoOrden =  $this->ordenModel->traerDatosOrdenIdNew($idOrden); 
        $infoCarro = $this->carroModel->verificarCarroPlaca($infoOrden['placa']);
        $infoCliente = $this->clienteModel->traerClienteId($infoCarro['datos']['propietario']);  
        $infoTecnico = $this->tecnicoModel->traerTecnicoId($infoOrden['mecanico']); 
        ?>
        <style>
            .linea{
                border: 1px solid black;
            }
        </style>
        
        <div class="row" style="padding:5px;">
            <div class="row col-lg-5 mt-1"  id="div_datos_cliente">
              
                <table class="table table-striped" width="90%">
                    <tr class="table-dark">
                        <td colspan="2">Datos Cliente</td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td><?php   echo $infoCliente['nombre'];   ?></td>
                    </tr>
                    <tr>
                        <td>Cedula:</td>
                        <td><?php   echo $infoCliente['identi'];   ?></td>
                    </tr>
                    <tr>
                        <td>Telefono:</td>
                        <td><?php   echo $infoCliente['telefono'];   ?></td>
                    </tr>
                    <tr>
                        <td>Direccion:</td>
                        <td><?php   echo $infoCliente['direcion'];   ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php   echo $infoCliente['email'];   ?></td>
                    </tr>
                    <tr>
                        <td>Operario Actual</td>
                        <td>
                        <select>
                            <option id ="idTecnico"value="-1">Seleccione...</option>
                            <?php
                            $tecnicos = $this->tecnicoModel->traerTecnicos();
                            // $this->printR($tecnicos);
                              $this->colocarSelectCampoConOpcionSeleccionadaTecnicos($tecnicos,$infoOrden['mecanico']);
                            ?>
                        </select> 
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row col-lg-1 mt-1 "  id="div_medio">
            </div>

            <div class="row col-lg-5 mt-1 "  id="div_info_moto">
                <table class="table table-striped">
                        <tr class="table-dark">
                            <td colspan="2">Datos Moto</td>
                        </tr>
                        <tr>
                            <td>Marca:</td>
                            <td><?php   echo $infoCarro['datos']['marca'];    ?></td>
                        </tr>
                        <tr>
                            <td>Linea:</td>
                            <td><?php  echo $infoCarro['datos']['tipo'];  ?></td>
                        </tr>
                        <tr>
                            <td>Modelo:</td>
                            <td><?php   echo $infoCarro['datos']['modelo'];  ?></td>
                        </tr>
                        <tr>
                            <td>Color:</td>
                            <td><?php   echo $infoCarro['datos']['color'];    ?></td>
                        </tr>
                        <tr>
                            <td>Kilometraje:</td>
                            <td><?php   echo $infoOrden['kilometraje'];    ?></td>
                        </tr>
                    </table>
            </div>
        </div>
        <div class="row mt-3">
            <div align ="center" style="background-color:black;color:white;">TRABAJO A REALIZAR</div>
            <textarea class="form-control" name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $infoOrden['observaciones']?></textarea>
        </div>    
        <div class="row mt-3">
            <div align ="center" style="background-color:black;color:white;">PARTES Y REPUESTOS</div>
            <div class="col-lg-6" overflow: hidden;>

                <table class="table table-striped">
                    <tr>
                        <td>CODIGO</td>
                        <td>DESCRIPCION</td>
                        <td>VR UNIT</td>
                        <td>EXIST</td>
                        <td>CANT</td>
                        <td>TOTAL</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input onkeyup="revisarbuscarCodigoNew();" type="text"  name="codigopan" id = "codigopan" size="5" ></td>
                        <!-- <td><input onclick="mostrarAlgoDePrueba();" type="text"  name="codigopan" id = "codigopan" size="5" ></td> -->
                        <td><input type="text" name="descripan" id = "descripan"  size = "30"  /></td>
                        <td><input type="text" name="valor_unit" id = "valor_unit"  size = "10"  /></td>
                        <td><input name="exispan" type="text" id = "exispan"   size = "10" /></td>
                        <td><input onkeyup="multiplicarCantidadXValorUnit();" name="cantipan" type="text" id = "cantipan"  size = "10"  /></td>
                        <td><input name="totalpan" type="text" id = "totalpan"    size = "10"  /></td>
                        <td><button onclick ="agregarItemOrdenNew(); " class="btn btn-primary">AGREGAR</button></td>
                    </tr>
                </table>
            </div>
        </div>    
        <?php
    }
    
    public function mostrarFormuAnteriorModificarOrden($idOrden)
    {
        $_REQUEST['idorden']= $idOrden;
        include('orden_modificar_honda.php'); 
    }
}