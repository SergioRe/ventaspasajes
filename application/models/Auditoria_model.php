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
        $sql = $sentenciasql;
	$query = $this->db->query($sql);
        $data = $query->result_array(); 
        echo '<pre>';print_r($data);exit;
        return $data;
    }
}