<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginControladorContable extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Login_Model_Contable');
      $this->load->helper('url');
      $this->load->helper('form');
   }
   
   public function iniciar_sesion() {
      $data = array();
      $this->load->view('loginContable', $data);
   }

   public function iniciar_sesion_post() {
      if ($this->input->post()) {
         $nombre = $this->input->post('nombre');
         $contrasena = $this->input->post('contrasena');
         $this->load->model('Login_Model_Contable');
         $usuario = $this->Login_Model_Contable->usuario_por_nombre_contrasena($nombre, $contrasena);
         if ($usuario) {
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
            $this->load->view('loginContable');
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
      $this->session->set_userdata($usuario_data);
      //redirect('');
      //$this->load->view('loginContable');
   }
}

?>
