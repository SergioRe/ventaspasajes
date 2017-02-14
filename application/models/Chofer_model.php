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
        $this->db->select('c.IdChofer,c.Chofer');
        $this->db->from('chofer as c');
        $this->db->order_by('c.IdChofer ASC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}