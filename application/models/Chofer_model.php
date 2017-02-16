<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chofer_model extends CI_Model{
    var $table = 'chofer';
    var $column_order = array('IdChofer','Chofer','Direccion','N_Brevete');
    var $column_search = array('IdChofer','Chofer','Direccion','N_Brevete');
    var $order = array('IdChofer' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaChofer(){ 
        $this->db->select('c.*');
        $this->db->from('chofer as c');
        $this->db->order_by('c.IdChofer DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarChofer($IdChofer){
        $this->db->select('c.*');
        $this->db->from('chofer as c');
        $this->db->where('c.IdChofer', $IdChofer);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function insertChofer($data){
        try {
            unset($data['IdChofer']);
            $this->db->insert($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function updateChofer($data){
        try {
            $this->db->where('IdChofer', $data['IdChofer']);
            unset($data['IdChofer']);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}