<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    
    var $table = 'USUARIOS';
    var $column_order = array('IDUSUARIO', 'USUARIO', 'CONTRASENA', 'NOMBRES', 'APELLIDOS', 'DIRECCION', 'CARGO');
    var $column_search = array('IDUSUARIO', 'USUARIO', 'CONTRASENA', 'NOMBRES', 'APELLIDOS', 'DIRECCION', 'CARGO');
    var $order = array('IDUSUARIO' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login($datos){ 
        $this->db->select('USUARIOS.IDUSUARIO,USUARIOS.IDUSUARIO,USUARIOS.NOMBRES,USUARIOS.APELLIDOS,USUARIOS.CARGO'); 
        $this->db->from($this->table);
        $this->db->where('USUARIOS.USUARIO', $datos['USUARIO']);
        $this->db->where('USUARIOS.CONTRASENA', $datos['CONTRASENA']);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}
?>