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
        /*$this->db->select("i.*,b.*,CONCAT(i.ORIGEN, ' - ',i.DESTINO) AS NOMVIAJE,c.*");
        $this->db->from('itinerario as i');
        $this->db->join('chofer as c','c.IdChofer = i.IDCHOFER');
        $this->db->join('bus as b','b.IdBus = i.IDBUS');
        $this->db->order_by('CAST(i.FECHA_VIAJE AS DATE)');*/
        $sql = "select i.*,b.*,CONCAT(i.ORIGEN, ' - ',i.DESTINO) AS NOMVIAJE,c.* from itinerario as i "
                . "inner join chofer as c on c.IdChofer = i.IDCHOFER "
                . "inner join bus as b on b.IdBus = i.IDBUS "
                . "order by CAST(i.FECHA_VIAJE AS DATE)";
        $query = $this->db->query($sql);
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
    
    public function asientosOcupados($IDITINERARIO){
        $this->db->select("d.Asiento");
        $this->db->from('detalle_venta_pasaje as d');
        $this->db->where('d.IDITINERARIO', $IDITINERARIO);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function insertViaje($data){
        try {
            date_default_timezone_set('America/Lima');
            unset($data['IDITINERARIO']);
            unset($data['NOMVIAJE']);
            $data['ASIENTO'] = '40';
            $data['IDTIPO_SERVICIO'] = '1';
            $fecha = explode('-', $data['FECHA_VIAJE']);
            $fechaFormatoBD = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
            $data['FECHA_VIAJE'] = $fechaFormatoBD;
            $this->db->insert($this->table,$data);
            $dias= 9;
            for($i=1;$i<=$dias;$i++){
                $fecha = date_create($data['FECHA_VIAJE']);
                date_add($fecha, date_interval_create_from_date_string('1 days'));
                $data['FECHA_VIAJE'] = date_format($fecha, 'Y-m-d');
                $this->db->insert($this->table,$data);
            }
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

    public function verificarExistenciaBus($IDBUS){
        $this->db->select("i.*");
        $this->db->from('itinerario as i');
        $this->db->where('i.IDBUS', $IDBUS);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return (count($data)>0?'Existe':'NoExiste');
    }
    
    public function verificarExistenciaChofer($IDCHOFER){
        $this->db->select("i.*");
        $this->db->from('itinerario as i');
        $this->db->where('i.IDCHOFER', $IDCHOFER);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return (count($data)>0?'Existe':'NoExiste');
    }
    
    public function deleteViaje($data){
        try {
            $this->db->where('IDITINERARIO', $data['IDITINERARIO']);
            $this->db->delete($this->table); 
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}