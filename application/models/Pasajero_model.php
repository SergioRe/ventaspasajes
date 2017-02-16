<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasajero_model extends CI_Model{
    var $table = 'pasajero';
    var $column_order = array('IDPasajero','Nombres','Apellidos','Direccion','DNI','Telefono','Email','APEMAT','APEPAT','FECNAC');
    var $column_search = array('IDPasajero','Nombres','Apellidos','Direccion','DNI','Telefono','Email','APEMAT','APEPAT','FECNAC');
    var $order = array('IDPasajero' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaPasajero(){ 
        $this->db->select('p.*');
        $this->db->from('pasajero as p');
        $this->db->order_by('p.IDPasajero DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarPasajero($IDPasajero){
        $this->db->select('p.*');
        $this->db->from('pasajero as p');
        $this->db->where('p.IDPasajero', $IDPasajero);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    public function insertPasajero($data){
        try {
            unset($data['IDPasajero']);
            $this->db->insert($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function updatePasajero($data){
        try {
            $this->db->where('IDPasajero', $data['IDPasajero']);
            unset($data['IDPasajero']);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}