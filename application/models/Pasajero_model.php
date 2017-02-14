<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasajero_model extends CI_Model{
    var $table = 'pasajero';
    var $column_order = array('IDPasajero','Nombres','Apellidos','Direccion','Dni','Telefono','Email','NRODOC','APEMAT','APEPAT','FECNAC','USUARIO','CONTRASENA');
    var $column_search = array('IDPasajero','Nombres','Apellidos','Direccion','Dni','Telefono','Email','NRODOC','APEMAT','APEPAT','FECNAC','USUARIO','CONTRASENA');
    var $order = array('IDPasajero' => 'desc');

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listaPasajero(){ 
        $this->db->select('p.*');
        $this->db->from('pasajero as p');
        $this->db->order_by('p.IDPasajero DESC');
        $query = $this->db->get();
        $data = $query->result_array(); 
        return $data;
    }
    
    public function editarPasajero($IDPasajero){
        $this->db->select('p.*');
        $this->db->from('pasajero as p');
        $this->db->where('p.IDPasajero', $IDPasajero);
        $query = $this->db->get();
        $data = $query->result_array();
        $data[0]['CONTRASENA'] = $this->desencriptar($data[0]['CONTRASENA']);
        return $data;
    }
    
    public function insertPasajero($data){
        try {
            unset($data['IDPasajero']);
            $data['CONTRASENA'] = $this->encriptar($data['CONTRASENA']);
            $this->db->insert($this->table,$data);
            return 'Si';
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }
    
    public function updatePasajero($data){
        try {
            $this->db->where('IDPasajero', $data['IDPasajero']);
            unset($data['IDPasajero']);
            $data['CONTRASENA'] = $this->encriptar($data['CONTRASENA']);
            echo '<pre>';print_r($data);exit;
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
         $key='';
         $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;
    }
}