<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrochofer extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model','usuarios');
        $this->load->model(array('Usuarios_model'=>'usuarios','Menu_model'=>'menu','Bus_model'=>'bus','Chofer_model'=>'chofer'));
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
            $this->load->view('registrochofer/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function json(){
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $case = $this->url_elements[3];
        $flag = '';
        switch ($case):
            case 'datachofer':
                $data = $this->chofer->listaChofer();
                break;
            case 'editarchofer':
                $data = $this->chofer->editarChofer($_POST['IdChofer']);
                $flag = '1';
                break;
            case 'add':
                $data = $this->chofer->insertChofer($_POST);
                break;
            case 'update':
                $data = $this->chofer->updateChofer($_POST);
                break;
        endswitch;
        if($flag == '1'){
            echo json_encode($data);
        }else{
            echo json_encode(array("data" => $data));
        }
    }
}
    