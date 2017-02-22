<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrobus extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model','usuarios');
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
            $data['listachofer'] = $this->chofer->listaChofer();
            $this->load->view('registrobus/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function json(){
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $case = $this->url_elements[3];
        $flag = '';
        switch ($case):
            case 'databus':
                $data = $this->bus->listaBus();
                break;
            case 'editarbus':
                $data = $this->bus->editarBus($_POST['IdBus']);
                $flag = '1';
                break;
            case 'add':
                $data = $this->bus->insertBus($_POST);
                break;
            case 'update':
                $data = $this->bus->updateBus($_POST);
                break;
            case 'deletebus':
                $existe = $this->itinerario->verificarExistenciaBus($_POST['IdBus']);
                if($existe == 'Existe'){
                    $data = 'ExisteBus';
                }else{
                    $data = $this->bus->deleteBus($_POST);
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
    