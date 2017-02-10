<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_model extends CI_Model{
    var $table = 'PERFILES';
    var $column_order = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $column_search = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $order = array('IdBus' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaPerfiles(){ 
        $this->db->select('PERFILES.*');
        $this->db->from($this->table);
        $this->db->order_by('PERFILES.TIPCOD ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function listaUsuariosPorPerfil($TIPCOD){
        $this->db->select('USUARIOS.*');
        $this->db->from('USUARIOS');
        $this->db->where('USUARIOS.TIPCOD', $TIPCOD);
        $this->db->order_by('USUARIOS.IDUSUARIO ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}