<?php


$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');



class CarroModel extends Conexion
{
       
    public function __construct()
    {
    }

    public function traerCarroId($id)
    {
        $sql = "select * from carros where idcarro = '".$id."'    "; 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arr = mysql_fetch_assoc($consulta);  
        return $arr;
    }
    public function verificarCarroPlaca($placa)
    {
        $sql = "select * from carros where placa = '".$placa."'    "; 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $filas= mysql_num_rows($consulta); 
        $arr = mysql_fetch_assoc($consulta);  
        $respu['filas'] = $filas; 
        $respu['datos'] = $arr; 
        return $respu;
    }

    public function busquePlacaNueva123($placa)
    {
        $sql = "select * from carros where placa = '".$placa."'    "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $filas = mysql_num_rows($consulta); 
        $arreGloInfo = mysql_fetch_assoc($consulta); 
        // echo '<pre>'; 
        // print_r($arreGloInfo); 
        // echo '</pre>';
        // die('filas '.$filas);
        $respu['filas'] = $filas; 
        $respu['datos'] = $arreGloInfo;
        return $respu; 
    }
    public function busquePlacasQueConicidan($placa)
    {
        $sql = "select * from carros where placa like '%".$placa."%'  limit 100  "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arregloCoicidencias = $this->get_table_assoc($consulta);
        // echo '<pre>'; 
        // print_r($arregloCoicidencias); 
        // echo '</pre>';
        // die(); 
        return $arregloCoicidencias;
    }
    public function busquePlacasQueConicidanIdCarro($idcarro)
    {
        $sql = "select * from carros where idcarro = '".$idcarro."'  limit 100  "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arregloCoicidencias = $this->get_table_assoc($consulta);
        // echo '<pre>'; 
        // print_r($arregloCoicidencias); 
        // echo '</pre>';
        // die(); 
        return $arregloCoicidencias;
    }
    
    public function realizarGrabacionMoto($request)
    {
        $sql="insert into carros (placa,marca,tipo,modelo,chasis,motor,vencisoat,revision,id_empresa,propietario)  
        values (
            '".$request['placa']."'
            ,'".$request['marca']."'
            ,'".$request['linea']."'
            ,'".$request['modelo']."'
            ,'".$request['chasis']."'
            ,'".$request['motor']."'
            ,'".$request['soat']."'
            ,'".$request['tecno']."'
            ,'40'
            ,'".$request['idCliente']."'
            )";
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $maxId = $this->traerUltimoId();
        return $maxId; 
        // die($sql);    
    }

    public function traerUltimoId()
    {
        $sql = "select max(idcarro) as maxId  from carros";
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrMax = mysql_fetch_assoc($consulta); 
        $maxId = $arrMax['maxId'];
        return $maxId;
    }


    public function actualizarPropietarioMoto($idCarro, $idCliente)
    {
        $sql ="update carros set propietario = '".$idCliente."'    where idcarro = '".$idCarro."'  "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
    }
}



?>