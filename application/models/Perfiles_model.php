<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_model extends CI_Model{
    var $table = 'perfiles';
    var $column_order = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $column_search = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $order = array('IdBus' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaPerfiles(){ 
        $this->db->select('p.*');
        $this->db->from('perfiles as p');
        $this->db->order_by('p.TIPCOD ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function listaUsuariosPorPerfil($TIPCOD){
        $this->db->select('u.*');
        $this->db->from('usuarios as u');
        $this->db->where('u.TIPCOD', $TIPCOD);
        $this->db->order_by('u.IDUSUARIO ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}