<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recaudo_auditoria extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model("Recaudo_auditoria_model");
      	$this->load->helper('url');
      	$this->load->helper('form');


	}

function index(){
	
  	$resultado = $this->Recaudo_auditoria_model->all_auditoria();
	$data = array("consulta" => $resultado);
  	$this->load->view("view_recaudo_auditoria",$data);


}


}

?>