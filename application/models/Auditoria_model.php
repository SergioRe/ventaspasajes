<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria_model extends CI_Model{
    var $table = 'auditoria';
    var $column_order = array('CodAuditoria', 'FechaAuditoria', 'HoraAuditoria', 'CodUsuario', 'NombreUsuario', 'Detalle');
    var $column_search = array('CodAuditoria', 'FechaAuditoria', 'HoraAuditoria', 'CodUsuario', 'NombreUsuario', 'Detalle');
    var $order = array('CodAuditoria' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function consulta($sentenciasql){
        define("cServidor", "localhost");
        define("cUsuario", "root");
        define("cPass","");
        define("cBd","ventas_pasaje_transportes");
        $link = mysqli_connect(cServidor, cUsuario, cPass, cBd);
        $link->query($sentenciasql);
        if($sentenciasql[0] == 's' || $sentenciasql[0] == 'S'){
            $row_cnt = mysqli_field_count($link);
            $consulta1= mysqli_query($link,$sentenciasql);
            if($consulta1->num_rows == 0){
                $sql1 = 'vacio';
            }else{
                $sql1 = mysqli_fetch_array($consulta1);
            }
            $info_campo = $consulta1->fetch_fields();
            $miArray1=[];
            foreach ($info_campo as $valor) {
                $miArray1[] = array($valor->name);
            }
            return array('flag'=>'select','consulta'=>$sql1,'numfila'=>$row_cnt,'nomcampos'=>$miArray1);
        }else{
            return array('flag'=>'NoSelect','mensaje'=>"Columnas afectadas: ".$link->affected_rows);
        }
    }
}