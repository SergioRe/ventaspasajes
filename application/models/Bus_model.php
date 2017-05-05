<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_model extends CI_Model{
    var $table = 'bus';
    var $column_order = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $column_search = array('IdBus','Placa','Motor','Año_Fabricacion','N_Asiento','Tipo_Bus','NomBus','IdChofer');
    var $order = array('IdBus' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaBus(){ 
        $this->db->select('b.IdBus,b.Placa,b.N_Asiento,b.NomBus,chofer.Chofer,chofer.IdChofer');
        $this->db->from('bus as b');
        $this->db->join('chofer','chofer.IdChofer = b.IdChofer');
        $this->db->order_by('b.IdBus DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarBus($IdBus){
        $this->db->select('b.IdBus,b.Placa,b.N_Asiento,b.NomBus,chofer.Chofer,chofer.IdChofer');
        $this->db->from('bus as b');
        $this->db->join('chofer','chofer.IdChofer = b.IdChofer');
        $this->db->where('b.IdBus', $IdBus);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function buscarChofer($idChofer){
        $this->db->select('b.*');
        $this->db->from('bus as b');
        $this->db->where('b.IdChofer', $idChofer);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return count($data)>0?'Existe':'NoExiste';
    }
    
    public function insertBus($data){
        try {
            unset($data['IdBus']);
            $data['N_Asiento'] = '40';
            $respuesta = $this->buscarChofer($data['IdChofer']);
            if($respuesta == 'Existe'){
                return 'Existe';
            }
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
    
    public function deleteBus($data){
        try {
            $this->db->where('IdBus', $data['IdBus']);
            $this->db->delete($this->table); 
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function verificarExistenciaChoferBus($IdChofer){
        $this->db->select('b.*');
        $this->db->from('bus as b');
        $this->db->where('b.IdChofer', $IdChofer);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return (count($data)>0?'Existe':'NoExiste');
    }
}