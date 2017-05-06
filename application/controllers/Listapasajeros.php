<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listapasajeros extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Pasajero_model','pasajero');
        $this->load->model(array('Itinerario_model'=>'itinerario','Usuarios_model'=>'usuarios','Menu_model'=>'menu',
            'Bus_model'=>'bus','Chofer_model'=>'chofer','Control_model'=>'control'));
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
            $this->load->view('listapasajeros/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function json(){
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $case = $this->url_elements[3];
        $flag = '';
        switch ($case):
            case 'datapasajero':
                $data = $this->pasajero->listaPasajero();
                break;
            case 'editarpasajero':
                $data = $this->pasajero->editarPasajero($_POST['IDPasajero']);
                $flag = '1';
                break;
            case 'add':
                $data = $this->pasajero->insertPasajero($_POST);
                break;
            case 'update':
                $data = $this->pasajero->updatePasajero($_POST);
                break;
            case 'deletepasajero':
                $existe = $this->pasajero->verificarExistenciaVenta($_POST['IdPasajero']);
                if($existe == 'Existe'){
                    $data = 'ExistePasajero';
                }else{
                    $data = $this->pasajero->deletePasajero($_POST);
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
?>

