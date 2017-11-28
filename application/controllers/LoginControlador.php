<?php

/*defined('BASEPATH') OR exit('No direct script access allowed');

class LoginControlador extends CI_Controller {
  function __construct(){
  	parent::__construct();
  	$this->load->model('Login_Model_S');
	  $this->load->helper('url');
	  $this->load->helper('form');
  }

	function index() {
		//$this->load->library('recaptcha');
		$data['message'] = '';
		$this->load->view('login1', $data);
 }

 public function validaciondatos(){
 	$username = $this->input->post('usuario');
   	 $password = $this->input->post('clave');

   	 $datos = array 
   	 (
   	 	'usuario' => $username,
        'clave' => $password
   	 );
   	 $resultado = $this->Login_Model_S->validarInicioDeSesion($datos);
     $data['message'] = '<div class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px; "> Datos No Validos </div>';
    if ($resultado) 
    { 
      $this->load->view('header/header');
    	$this->load->view('vistaArchivo');
      $this->load->view('footer/footer');
    }
    else
    {
    	$this->load->view('login1',$data);
    } 
 }
}*/






if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginControlador extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Login_Model_S');
      $this->load->helper('url');
      $this->load->helper('form');
   }
   
   public function iniciar_sesion() {
      $data = array();
      $this->load->view('login1', $data);
   }

   public function iniciar_sesion_post() {
      if ($this->input->post()) {
         $nombre = $this->input->post('nombre');
         $contrasena = $this->input->post('contrasena');
         $this->load->model('Login_Model_S');
         $usuario = $this->Login_Model_S->usuario_por_nombre_contrasena($nombre, $contrasena);
         if ($usuario) {
            $usuario_data = array(
               'id' => $usuario->id,
               'nombre' => $usuario->UserName,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            //redirect('usuarios/logueado');
            $this->load->view('header/header');
            $this->load->view('vistaArchivo');
            $this->load->view('footer/footer');
         } else {
            redirect('');
         }
      } else {
         $this->iniciar_sesion();
      }
   }

   public function logueado() {
      if($this->session->userdata('logueado')){
         $data = array();
         $data['nombre'] = $this->session->userdata('nombre');
         //$this->load->view('usuarios/logueado', $data);
         $this->load->view('header/header');
         $this->load->view('vistaArchivo', $data);
         $this->load->view('footer/footer');
      }else{
         redirect('');
      }
   }

   public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
      $this->session->set_userdata($usuario_data);
      redirect('');
   }
}


?>

