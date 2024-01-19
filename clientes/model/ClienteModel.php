<?php


$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');



class ClienteModel extends Conexion
{
       
    public function __construct()
    {
        session_start();
    }

    public function traerClienteId($id)
    {
        $sql="select * from cliente0 where idcliente =   '".$id."'    "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrCliente = mysql_fetch_assoc($consulta);
        return $arrCliente;  
    }
    public function verificarClienteIdenti($identi)
    {
        $sql="select * from cliente0 where identi =   '".$identi."'    "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $filas= mysql_num_rows($consulta); 
        $arrCliente = mysql_fetch_assoc($consulta);
        $respu['filas'] = $filas; 
        $respu['datos'] = $arrCliente; 
        return $respu;  
    }
    
    public function traerClientes()
    {
        $sql = "select idcliente,nombre,identi from cliente0 where id_empresa = '".$_SESSION['id_empresa']."'  order by nombre ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrClientes = $this->get_table_assoc($consulta);
        return $arrClientes; 
    }
    public function traerClientesFiltro($nombre)
    {
        $sql = "select idcliente,nombre,identi from 
        cliente0 
        where id_empresa = '".$_SESSION['id_empresa']."'  
        and nombre like '%".$nombre."%'
        order by nombre ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrClientes = $this->get_table_assoc($consulta);
        return $arrClientes; 
    }
    public function traerClientesFiltroId($id)
    {
        $sql = "select idcliente,nombre,identi from 
        cliente0 
        where id_empresa = '".$_SESSION['id_empresa']."'  
        and idcliente = '".$id."'
        order by nombre ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrClientes = $this->get_table_assoc($consulta);
        return $arrClientes; 
    }
    
    public function grabarCLienteNuevoOrden($request)
    {
        $sql = "insert into cliente0 (identi,nombre,direccion,telefono,email,id_empresa,identi2) 
        values('".$request['identi']."','".$request['nombre']."','".$request['direccion']."'
        ,'".$request['telefono']."','".$request['email']."','40','".$request['identi']."')
        "; 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $ultimoId = $this->traerUltimoIdCliente();
        return $ultimoId;
    }
    
    
    public function traerUltimoIdCliente()
    {
        $sql ="select max(idcliente) as maxId   from cliente0  ";
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrId = mysql_fetch_assoc($consulta);
        return $arrId['maxId'];
    }
    
    public function actualizarClienteId($request)
    {
        $sql = "update cliente0 
        set  
        identi = '".$request['identi']."'
        ,nombre = '".$request['nombre']."'
        ,direccion = '".$request['direccion']."' 
        ,telefono = '".$request['telefono']."' 
        ,email = '".$request['email']."' 
        where 
        idcliente = '".$request['idCliente']."'
        "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
    }
    
}