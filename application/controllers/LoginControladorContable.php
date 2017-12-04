<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginControladorContable extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Login_Model_Contable');
      $this->load->helper('url');
      $this->load->helper('form');
          $this->load->library('recaptcha');
   }
   
   public function iniciar_sesion() {
      $data = array();
      $algo['message'] ='';
      $this->load->view('loginContable', $algo);
   }

   public function iniciar_sesion_post() {
      if ($this->input->post()) {
         $nombre = $this->input->post('nombre');
         $contrasena = $this->input->post('contrasena');
          $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);

         $this->load->model('Login_Model_Contable');

         $usuario = $this->Login_Model_Contable->usuario_por_nombre_contrasena($nombre, $contrasena);
           if(!$response)
          {
             $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Todos Los Campos Son Requeridos </div>';
            $this->load->view('loginContable',$algo);
          } 
         if ($usuario && $response['success']) {
            $usuario_data = array(
               'id' => $usuario->id_usuario,
               'nombre' => $usuario->nombre_usuario,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            //redirect('usuarios/logueado');
            $this->load->view('header/headerContable');
            $this->load->view('contable/view_contable');
            $this->load->view('footer/footer');
         } else {
            $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> El usuario o contraseña son incorrectos </div>';
            $this->load->view('loginContable',$algo);
            //redirect('loginContable');
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
         $this->load->view('header/headerContable');
         $this->load->view('contable/view_contable', $data);
         $this->load->view('footer/footer');
      }else{
         redirect('');
      }
   }

   public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
       $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> ha cerrado sesion correctamente </div>';
      $this->session->set_userdata($usuario_data);
      $this->load->view('loginContable',$algo);
   }
}

?>
