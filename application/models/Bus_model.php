<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_model extends CI_Model{
    var $table = 'BUS';
    var $column_order = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $column_search = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $order = array('IdBus' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaBus(){ 
        $this->db->select('BUS.IdBus,BUS.Placa,BUS.N_Asiento,BUS.NomBus,CHOFER.Chofer,CHOFER.IdChofer');
        $this->db->from($this->table);
        $this->db->join('CHOFER','CHOFER.IdChofer = BUS.IdChofer');
        $this->db->order_by('BUS.IdBus DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarBus($IdBus){
        $this->db->select('BUS.IdBus,BUS.Placa,BUS.N_Asiento,BUS.NomBus,CHOFER.Chofer,CHOFER.IdChofer');
        $this->db->from($this->table);
        $this->db->join('CHOFER','CHOFER.IdChofer = BUS.IdChofer');
        $this->db->where('BUS.IdBus', $IdBus);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function insertBus($data){
        try {
            unset($data['IdBus']);
            $this->db->insert($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function updateBus($data){
        try {
            $this->db->where('IdBus', $data['IdBus']);
            unset($data['IdBus']);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}