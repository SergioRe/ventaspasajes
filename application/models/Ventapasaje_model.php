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
            $dataDettalleVenta = array('destino'=>$data['destino'],'fecha_viaje'=>$data['fecha_viaje'],
                'hora'=>$data['hora'],'idtipo_servicio'=>'1','nombre'=>'Pasaje','precio'=>'50.00','cantidad'=>'1','IDITINERARIO'=>$data['IDITINERARIO']);

            foreach ($data['aregloAsientos'] as $valor):
                $dataVentaPasaje['IdVenta'] = $data['IdVenta'];
                $dataDettalleVenta['IdVenta'] = $data['IdVenta'];
                $this->db->insert('venta_pasaje',$dataVentaPasaje);
                $dataDettalleVenta['Asiento'] = $valor;
                $this->db->insert('detalle_venta_pasaje',$dataDettalleVenta);
                $data['IdVenta'] = $data['IdVenta'] + 1;
            endforeach;
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}