<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itinerario_model extends CI_Model{
    var $table = 'ITINERARIO';
    var $column_order = array('IDITINERARIO','FECHA_ITINERARIO','IDBUS','IDCHOFER','ORIGEN','DESTINO','FECHA_VIAJE','IDTIPO_SERVICIO','PRECIO','ASIENTO','HORA');
    var $column_search = array('IDITINERARIO','FECHA_ITINERARIO','IDBUS','IDCHOFER','ORIGEN','DESTINO','FECHA_VIAJE','IDTIPO_SERVICIO','PRECIO','ASIENTO','HORA');
    var $order = array('IDITINERARIO' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaviaje(){ 
        $this->db->select("ITINERARIO.IDITINERARIO,B.IdBus,CONCAT(ITINERARIO.ORIGEN, ' - ',ITINERARIO.DESTINO) AS NOMVIAJE,  ITINERARIO.ORIGEN, ITINERARIO.DESTINO,B.NomBus,B.Placa,C.Chofer,ITINERARIO.HORA,ITINERARIO.HORAFIN");
        $this->db->from($this->table);
        $this->db->join('CHOFER AS C','C.IdChofer = ITINERARIO.IDCHOFER');
        $this->db->join('BUS AS B','B.IdBus = ITINERARIO.IDBUS');
        $this->db->order_by('ITINERARIO.IDITINERARIO DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarViaje($IDITINERARIO){
        $this->db->select("ITINERARIO.IDITINERARIO,B.IdBus,CONCAT(ITINERARIO.ORIGEN, ' - ',ITINERARIO.DESTINO) AS NOMVIAJE,  ITINERARIO.ORIGEN, ITINERARIO.DESTINO,B.NomBus,B.Placa,C.Chofer,ITINERARIO.HORA,ITINERARIO.HORAFIN");
        $this->db->from($this->table);
        $this->db->join('CHOFER AS C','C.IdChofer = ITINERARIO.IDCHOFER');
        $this->db->join('BUS AS B','B.IdBus = ITINERARIO.IDBUS');
        $this->db->where('ITINERARIO.IDITINERARIO', $IDITINERARIO);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function insertViaje($data){
        try {
            unset($data['IDITINERARIO']);
            unset($data['NOMVIAJE']);
            $this->db->insert($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function updateViaje($data){
        try {
            $this->db->where('IDITINERARIO', $data['IDITINERARIO']);
            unset($data['IDITINERARIO']);
            unset($data['NOMVIAJE']);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}