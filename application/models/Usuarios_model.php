<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    
    var $table = 'usuarios';
    var $column_order = array('IDUSUARIO', 'USUARIO', 'CONTRASENA', 'NOMBRES', 'APELLIDOS', 'DIRECCION', 'CARGO');
    var $column_search = array('IDUSUARIO', 'USUARIO', 'CONTRASENA', 'NOMBRES', 'APELLIDOS', 'DIRECCION', 'CARGO');
    var $order = array('IDUSUARIO' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login($datos){ 
        $this->db->select('u.IDUSUARIO,u.IDUSUARIO,u.NOMBRES,u.APELLIDOS,u.CARGO'); 
        $this->db->from('usuarios as u');
        $this->db->where('u.USUARIO', $datos['USUARIO']);
        $this->db->where('u.CONTRASENA', $datos['CONTRASENA']);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
}
?>