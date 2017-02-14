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
        $datos['CONTRASENA'] = $this->encriptar($datos['CONTRASENA']);
        $this->db->select('u.IDUSUARIO,u.IDUSUARIO,u.NOMBRES,u.APELLIDOS,u.CARGO'); 
        $this->db->from('usuarios as u');
        $this->db->where('u.USUARIO', $datos['USUARIO']);
        $this->db->where('u.CONTRASENA', $datos['CONTRASENA']);
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    function encriptar($cadena){
        $key='';
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}