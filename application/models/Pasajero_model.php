<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasajero_model extends CI_Model{
    var $table = 'PASAJERO';
    var $column_order = array('IDPasajero','Nombres','Apellidos','Direccion','Dni','Telefono','Email','NRODOC','APEMAT','APEPAT','FECNAC','USUARIO','CONTRASENA');
    var $column_search = array('IDPasajero','Nombres','Apellidos','Direccion','Dni','Telefono','Email','NRODOC','APEMAT','APEPAT','FECNAC','USUARIO','CONTRASENA');
    var $order = array('IDPasajero' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaPasajero(){ 
        $this->db->select('PASAJERO.*');
        $this->db->from($this->table);
        $this->db->order_by('PASAJERO.IDPasajero DESC');
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