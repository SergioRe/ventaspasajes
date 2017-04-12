<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventapasaje_model extends CI_Model{
    var $table = 'venta_pasaje';
    var $column_order = array('IdVenta', 'Serie', 'Comprobante', 'idPasajero', 'idUsuario', 'Fechaventa', 'Valor_Bruto', 'Valor_Igv', 'Valor_Total', 'IDITINERARIO');
    var $column_search = array('IdVenta', 'Serie', 'Comprobante', 'idPasajero', 'idUsuario', 'Fechaventa', 'Valor_Bruto', 'Valor_Igv', 'Valor_Total', 'IDITINERARIO');
    var $order = array('IdVenta' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function insertVentaPasaje($data){
        try {
            $dataVentaPasaje = array('Serie'=>'001','Comprobante'=>'Documento Factura',
                'idPasajero'=>$data['idPasajero'],'idUsuario'=>$data['idUsuario'],'Fechaventa'=>$data['Fechaventa'],
                'Valor_Bruto'=>'50.00','Valor_Igv'=>'9.00','Valor_Total'=>'59.00','IDITINERARIO'=>$data['IDITINERARIO']);
            $dataDettalleVenta = array('ORIGEN'=>$data['ORIGEN'],'HORAFIN'=>$data['HORAFIN'],'destino'=>$data['destino'],'fecha_viaje'=>$data['fecha_viaje'],
                'hora'=>$data['hora'],'idtipo_servicio'=>'1','nombre'=>'Pasaje','precio'=>'50.00','cantidad'=>'1','IDITINERARIO'=>$data['IDITINERARIO']);
            $dataVentaPasaje['IdVenta'] = $data['IdVenta'];
            $dataDettalleVenta['IdVenta'] = $data['IdVenta'];
            $this->db->insert('venta_pasaje',$dataVentaPasaje);
            foreach ($data['aregloAsientos'] as $valor):
                $dataDettalleVenta['Asiento'] = $valor;
                $this->db->insert('detalle_venta_pasaje',$dataDettalleVenta);
                $data['IdVenta'] = $data['IdVenta'] + 1;
            endforeach;
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function listaVenta(){
        $this->db->select('v.*,u.*,p.*');
        $this->db->from('venta_pasaje as v');
        $this->db->join('usuarios as u','u.IDUSUARIO = v.idUsuario ');
        $this->db->join('pasajero as p','p.idPasajero = v.idPasajero');
        $this->db->order_by('v.IdVenta DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function verificarExistenciaViaje($IDITINERARIO){
        $this->db->select('v.*');
        $this->db->from('venta_pasaje as v');
        $this->db->where('v.IDITINERARIO', $IDITINERARIO);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return (count($data)>0?'Existe':'NoExiste');
    }
    
    public function verificarExistenciaUsuarios($IDUSUARIO){
        $this->db->select('v.*');
        $this->db->from('venta_pasaje as v');
        $this->db->where('v.idUsuario', $IDUSUARIO);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return (count($data)>0?'Existe':'NoExiste');
    }
}