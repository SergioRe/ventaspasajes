<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_model extends CI_Model{
    var $table = 'control';
    var $column_order = array('IdControl','columna','valor');
    var $column_search = array('IdControl','columna','valor');
    var $order = array('IdControl' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function obtenerValor($columna){
        $this->db->select('c.*');
        $this->db->from('control as c');
        $this->db->where('c.columna', $columna);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function updateControl($IdControl,$valor){
        try {
            $this->db->where('IdControl', $IdControl);
            $data = array('valor' => $valor);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}