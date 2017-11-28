<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnvioEmail extends CI_Controller{

	function __construct(){
		parent::__construct();

	}

function sendMail(){

$config = Array(
  'protocol' => 'SMTP', //siempre mayusculas
  'smtp_host' => 'smtp.gmail.com',
  'smtp_port' => 587,
  'smtp_crypto'=> 'TLS', //siempre mayusculas
  'smtp_user' => 'ingsoftwaregrupo2@gmail.com', 
  'smtp_pass' => '', //password
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);
 
  $this->load->library('email', $config);
  $this->email->set_newline("\r\n");
  $this->email->from('ingsoftwaregrupo2@gmail.com'); // remitente
  $this->email->to('ingsoftwaregrupo2@gmail.com'); // destino
  $this->email->subject('CORREO ENVIADO MEDIANTE PHP-CODEIGNITER.');
  $this->email->message('ESTE ES UN MENSAJE DE PRUEBA');
 
  if($this->email->send()){
  echo 'CORREO ENVIADO';
 }
 else{
 	echo ("NO SE PUDO ENVIAR.");
 	show_error($this->email->print_debugger());
}

}


}

?>
