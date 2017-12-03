<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginAfiliado extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Login_Afiliado');
      $this->load->helper('url');
      $this->load->helper('form');
   }

   public function iniciar_sesion() {
      $data = array();
      $this->load->view('afiliado/loginAfiliado', $data);
   }

   public function iniciar_sesion_post() {
      if ($this->input->post()) {
         $cedula = $this->input->post('cedula');
         $contrasena = $this->input->post('contrasena');
         $this->load->model('Login_Afiliado');
         $usuario = $this->Login_Afiliado->usuario_por_nombre_contrasena($cedula, $contrasena);
         if ($usuario) {
            $usuario_data = array(
               'id' => $usuario->id_afiliado,
               'cedula' => $usuario->cedula,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            //redirect('usuarios/logueado');
            $this->load->view('afiliado/inicio');
            $this->encontrar($cedula);
         } else {
            $this->load->view('afiliado/loginAfiliado');
            //redirect('afiliado/loginAfiliado');
         }
      } else {
         $this->iniciar_sesion();
      }
   }

       public function encontrar($cedula)
    {
        
       $this->load->model('usuarios_model');

        $usuario = $this->usuarios_model->buscar($cedula);
        if(!is_null($usuario))
        {
             $consulta="Nombre del afiliado: ".$usuario->nombre."\nCupo:  ".$usuario->cupo_credito."\nValor de creditos: ".$usuario->val_credito. "\nSaldo Actual: ".$usuario->saldo;
            $this->ragnar($consulta);
        }
        else
        {
              $this->load->view('afiliado/no_encontrado');
        }
                
    }

     public function ragnar($consulta)
    {
        require 'phpqrcode/qrlib.php';
        $dir = 'codigo/';
        if(!file_exists($dir))
            mkdir($dir);
        $filename=$dir.'test.png';
        $tamanio=10;
        $level='M';
        $framesize=3;
        QRcode::png($consulta, $filename, $level, $tamanio, $framesize);   
    }
    
   public function logueado() {
      if($this->session->userdata('logueado')){
         $data = array();
         $data['cedula'] = $this->session->userdata('cedula');
         //$this->load->view('usuarios/logueado', $data);
   
         $this->load->view('afiliado/inicio', $data);
         
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
      $this->load->view('afiliado/loginAfiliado');
   }
}

?>
