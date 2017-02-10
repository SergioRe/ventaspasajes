<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model','usuarios');
    } 

    public function index(){
        $data = array();
        $data['mensaje'] = '';
        if(!empty($_POST)){
            $datos = $this->usuarios->login($_POST);
            $resultado = ((count($datos)>0)?'S':'N');
            $data['alerta'] = 'Si';
            if($resultado == 'S'){
                $data['alerta'] = 'No'; 
                $data['login'] = 'Si';
                $sess_array = array('IDUSUARIO' => $datos[0]['IDUSUARIO'],
                    'NOMBRES' => $datos[0]['NOMBRES'],
                    'APELLIDOS' => $datos[0]['APELLIDOS'],
                    'CARGO' => $datos[0]['CARGO']);
                $this->session->set_userdata('logged_in', $sess_array);
                redirect('/principal/index');
            }else{
                $data['mensaje'] = '<div class="alert alert-danger"><strong>El usuario o contraseña incorrecto.</strong></div>';
                $this->load->view('index',$data);
            }
        }else{
            $this->load->view('index',$data);
        }
    }

    public function cerrarsession(){
        $this->load->helper('url');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('/inicio/index');
    }
}
    