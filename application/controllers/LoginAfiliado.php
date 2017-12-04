<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginAfiliado extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Login_Afiliado');
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('recaptcha');
   }

   public function iniciar_sesion() {
      $data = array();
       $algo['message'] ='';
      $this->load->view('afiliado/loginAfiliado', $algo);
   }

   public function iniciar_sesion_post() {
      
  
      if ($this->input->post()) {
         $cedula = $this->input->post('cedula');
         
         $contrasena = $this->input->post('contrasena');
         $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);
         $this->load->model('Login_Afiliado');
         $usuario = $this->Login_Afiliado->usuario_por_nombre_contrasena($cedula, $contrasena);
          if(!$response)
          {
             $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Todos Los Campos Son Requeridos </div>';
            $this->load->view('login_Afiliado',$algo);
          } 
         if ($usuario && $response['success']) {
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
              $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> El usuario o contraseña son incorrectos  </div>';
            $this->load->view('afiliado/loginAfiliado',$algo);
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
        $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Sesion Cerrada Correctamente </div>';
      $this->load->view('afiliado/loginAfiliado',$algo);
   }
}

?>
