<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginControlador extends CI_Controller {
   public function __construct() {
      parent::__construct();
       $this->load->helper('url');
      $this->load->helper('form');
      $this->load->model('Login_Model_S');
      $this->load->library('recaptcha');
   }
   
   public function iniciar_sesion() {
    $data = array();
      $algo['message'] ='';
      $this->load->view('login1', $algo);
   }

   public function iniciar_sesion_post()
    {
      if ($this->input->post()) 
      {
        $nombre = $this->input->post('nombre');
        $contrasena = $this->input->post('contrasena');
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);

         $this->load->model('Login_Model_S');

         $usuario = $this->Login_Model_S->usuario_por_nombre_contrasena($nombre, $contrasena);
          if(!$response)
          {
             $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Todos Los Campos Son Requeridos </div>';
            $this->load->view('login1',$algo);
          } 
         if ($usuario && $response['success']) 
         {
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
             $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> El usuario o contraseña son incorrectos </div>';
            $this->load->view('login1',$algo);
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
       $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Sesion Cerrada Correctamente</div>';
       $this->load->view('login1',$algo);
   }
}

?>

