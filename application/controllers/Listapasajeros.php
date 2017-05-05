<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listapasajeros extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('pasajero_model','pasajero');
        $this->load->model(array('Itinerario_model'=>'itinerario','Usuarios_model'=>'usuarios','Menu_model'=>'menu','Bus_model'=>'bus','Chofer_model'=>'chofer'));
    } 

    public function index(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['IDUSUARIO'] = $session_data['IDUSUARIO'];
            $data['NOMBRES'] = $session_data['NOMBRES'];
            $data['APELLIDOS'] = $session_data['APELLIDOS'];
            $data['CARGO'] = $session_data['CARGO'];
            $data['NOMCOMP'] = $session_data['NOMBRES'].' '.$session_data['APELLIDOS'];
            $data['MENU'] = $this->menu->menuPorUsuario($session_data['IDUSUARIO']);
            $data['listapasajero'] = $this->pasajero->listaPasajero();
            $this->load->view('registrobus/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
}
?>

