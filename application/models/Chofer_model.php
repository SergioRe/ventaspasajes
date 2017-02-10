<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chofer_model extends CI_Model{
    var $table = 'CHOFER';
    var $column_order = array('IdChofer','Chofer','Direccion','N_Brevete');
    var $column_search = array('IdChofer','Chofer','Direccion','N_Brevete');
    var $order = array('IdChofer' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaChofer(){ 
        $this->db->select('CHOFER.IdChofer,CHOFER.Chofer');
        $this->db->from($this->table);
        $this->db->order_by('CHOFER.IdChofer ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}