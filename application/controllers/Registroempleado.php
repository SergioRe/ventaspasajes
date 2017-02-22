<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registroempleado extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model','usuarios');
        $this->load->model(array('Usuarios_model'=>'usuarios','Menu_model'=>'menu','Bus_model'=>'bus',
            'Chofer_model'=>'chofer','Ventapasaje_model'=>'ventapasaje','Pasajero_model'=>'pasajero'));
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
            $data['listachofer'] = $this->chofer->listaChofer();
            $this->load->view('registroempleado/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function json(){
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $case = $this->url_elements[3];
        $flag = '';
        switch ($case):
            case 'dataempleado':
                $data = $this->usuarios->listarUsuarios();
                break;
            case 'editarempleado':
                $data = $this->usuarios->editarUsuario($_POST['IDUSUARIO']);
                $flag = '1';
                break;
            case 'add':
                $data = $this->usuarios->insertUsuario($_POST);
                break;
            case 'update':
                $data = $this->usuarios->updateUsuario($_POST);
                break;
            case 'deleteusuario':
                $existe = $this->ventapasaje->verificarExistenciaUsuarios($_POST['IDUSUARIO']);
                if($existe == 'Existe'){
                    $data = 'ExisteUsuario';
                }else{
                    $data = $this->usuarios->deleteUsuario($_POST);
                }
                break;
        endswitch;
        if($flag == '1'){
            echo json_encode($data);
        }else{
            echo json_encode(array("data" => $data));
        }
    }
}
    