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
    
    public function listarUsuarios(){ 
        $this->db->select('u.*');
        $this->db->from('usuarios as u');
        $this->db->order_by('u.IDUSUARIO DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }

    public function editarUsuario($IDUSUARIO){
        $this->db->select('u.*');
        $this->db->from('usuarios as u');
        $this->db->where('u.IDUSUARIO', $IDUSUARIO);
        $query = $this->db->get();
        $data = $query->result_array();
        $data[0]['CONTRASENA'] = $this->desencriptar($data[0]['CONTRASENA']);
        return $data;
    }

    public function insertUsuario($data){
        try {
            unset($data['IDUSUARIO']);
            $data['CONTRASENA'] = $this->encriptar($data['CONTRASENA']);
            $data['TIPCOD'] = '';
            switch ($data['CARGO']):
                case '1':
                    $data['CARGO'] = 'Administrador de Sistemas';
                    $data['TIPCOD']= '1';
                    break;
                case '2':
                    $data['CARGO'] = 'Vendedor';
                    $data['TIPCOD'] = '2';
                    break;
            endswitch;
            $this->db->insert($this->table,$data);
            $sql = "INSERT INTO `menu`(`TIPCOD`, `MENNOM`, `MENURL`, `MENPERMISO`, `IDUSUARIO`, `MENICONO`) 
                    SELECT ".$data['TIPCOD']." AS TIPCOD,MENNOM,MENURL,'N', (select DISTINCT(u.IDUSUARIO) as IDUSUARIO
                    from usuarios u
                    left join menu m on m.IDUSUARIO = u.IDUSUARIO
                    where (case WHEN (u.IDUSUARIO =  m.IDUSUARIO) THEN '1' else '0' END) = 0) AS IDUSUARIO,MENICONO 
                    FROM MENU 
                    WHERE IDUSUARIO='1'";
            $this->db->query($sql);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }

    public function updateUsuario($data){
        try {
            $data['CONTRASENA'] = $this->encriptar($data['CONTRASENA']);
            $data['TIPCOD'] = '';
            switch ($data['CARGO']):
                case '1':
                    $data['CARGO'] = 'Administrador de Sistemas';
                    $data['TIPCOD']= '1';
                    break;
                case '2':
                    $data['CARGO'] = 'Vendedor';
                    $data['TIPCOD'] = '2';
                    break;
                case '3':
                    $data['CARGO'] = 'Supervisor';
                    $data['TIPCOD'] = '3';
                    break;
            endswitch;
            $this->db->where('IDUSUARIO', $data['IDUSUARIO']);
            unset($data['IDUSUARIO']);
            $this->db->update($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }

    function encriptar($cadena){
        $key='';
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }

    function desencriptar($cadena){
        $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;  //Devuelve el string desencriptado
    }
    
    public function deleteUsuario($data){
        try {
            $this->db->where('IDUSUARIO', $data['IDUSUARIO']);
            $this->db->delete($this->table); 
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
}