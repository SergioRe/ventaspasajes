<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

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
            $this->load->view('reportes/index',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function listabuses(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $this->load->view('reportes/listabuses',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function reporteventas(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $this->load->view('reportes/reporteventas',$data);
        }else{
            redirect('/inicio/index');
        }
    }
    
    public function reporteventasporfecha(){
        $this->load->helper('url');
        $data = array();
        if($this->session->userdata('logged_in')){
            $data['FECHAINI'] = $_POST['FECHAINI'];
            $data['FECHAFIN'] = $_POST['FECHAFIN'];
            $this->load->view('reportes/reporteventasporfecha',$data);
        }else{
            redirect('/inicio/index');
        }
    }
}
    