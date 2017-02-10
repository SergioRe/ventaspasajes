<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignarpermisos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model','usuarios');
        $this->load->model(array('Perfiles_model'=>'perfiles','Bus_model'=>'bus','Usuarios_model'=>'usuarios','Menu_model'=>'menu','Itinerario_model'=>'itinerario','Chofer_model'=>'chofer'));
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
            $data['perfiles'] = $this->perfiles->listaPerfiles();
            $this->load->view('asignarpermisos/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function json(){
        $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
        $case = $this->url_elements[3];
        $flag = '';
        switch ($case):
            case 'save':
                $data = $this->menu->updateMenuPorUsuario($_POST['data']);
                break;
        endswitch;
        if($flag == '1'){
            echo json_encode($data);
        }else{
            echo json_encode(array("data" => $data));
        }
    }
    
    public function usuariosporperfil(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $data['usuariosporperfiles'] = $this->perfiles->listaUsuariosPorPerfil($_POST['cboperfil']);
            $this->load->view('asignarpermisos/usuariosporperfil',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function listamenuporusuario(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $data['listamenuporusuario'] = $this->menu->menuPorUsuario1($_POST['IDUSUARIO']);
            $data['IDUSUARIO']= $_POST['IDUSUARIO'];
            $this->load->view('asignarpermisos/listamenuporusuario',$data);
        }else{
            redirect('/inicio/index');
        }
    }
}
    