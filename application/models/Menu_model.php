<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{

    var $table = 'menu';
    var $column_order = array('MENID', 'USUCOD', 'MENNOM', 'MENURL', 'MENPERMISO', 'IDUSUARIO','MENICONO');
    var $column_search = array('MENID', 'USUCOD', 'MENNOM', 'MENURL', 'MENPERMISO', 'IDUSUARIO','MENICONO');
    var $order = array('MENID' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function menuPorUsuario($idusuario){ 
        $this->db->select('m.*'); 
        $this->db->from('menu as m');
        $this->db->where('m.IDUSUARIO', $idusuario);
        $this->db->where('m.MENPERMISO', 'S');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function menuPorUsuario1($idusuario){ 
        $this->db->select('m.*'); 
        $this->db->from('menu as m');
        $this->db->where('m.IDUSUARIO', $idusuario);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function updateMenuPorUsuario($data){
        try {
            $cadena1 = substr ($data, 0, -1);
            $datasi = explode(',', $cadena1);
            foreach ($datasi as $valor):
                $update = explode('-', $valor);
                $this->db->where('MENID', $update[0]);
                $datapermiso = array('MENPERMISO'=>(($update[1]=='true')?'S':'N'));
                $this->db->update($this->table,$datapermiso);
            endforeach;
            return 'Si';
        }catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage();
        }
    }
}