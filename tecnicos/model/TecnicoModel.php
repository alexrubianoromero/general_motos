<?php


$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');



class TecnicoModel extends Conexion
{
       
    public function __construct()
    {
        session_start();
    }

    public function traerTecnicoId($id)
    {
        $sql="select * from tecnicos where idcliente =   '".$id."'    "; 
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql()); 
        $arrCliente = mysql_fetch_assoc($consulta);
        return $arrCliente;  
    }

}

?>