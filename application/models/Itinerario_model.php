<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itinerario_model extends CI_Model{
    var $table = 'itinerario';
    var $column_order = array('IDITINERARIO','FECHA_ITINERARIO','IDBUS','IDCHOFER','ORIGEN','DESTINO','FECHA_VIAJE','IDTIPO_SERVICIO','PRECIO','ASIENTO','HORA');
    var $column_search = array('IDITINERARIO','FECHA_ITINERARIO','IDBUS','IDCHOFER','ORIGEN','DESTINO','FECHA_VIAJE','IDTIPO_SERVICIO','PRECIO','ASIENTO','HORA');
    var $order = array('IDITINERARIO' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaviaje(){ 
        $this->db->select("i.*,b.*,CONCAT(i.ORIGEN, ' - ',i.DESTINO) AS NOMVIAJE,c.*");
        $this->db->from('itinerario as i');
        $this->db->join('chofer as c','c.IdChofer = i.IDCHOFER');
        $this->db->join('bus as b','b.IdBus = i.IDBUS');
        $this->db->order_by('i.IDITINERARIO DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarViaje($IDITINERARIO){
        $this->db->select("i.*,b.*,CONCAT(i.ORIGEN, ' - ',i.DESTINO) AS NOMVIAJE,c.*");
        $this->db->from('itinerario as i');
        $this->db->join('chofer AS c','c.IdChofer = i.IDCHOFER');
        $this->db->join('bus AS b','b.IdBus = i.IDBUS');
        $this->db->where('i.IDITINERARIO', $IDITINERARIO);
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