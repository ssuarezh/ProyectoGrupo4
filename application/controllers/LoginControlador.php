<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
 public function validaciondatos()
 {
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

}
?>

