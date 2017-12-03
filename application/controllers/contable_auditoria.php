<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contable_auditoria extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model("Contable_auditoria_model");
      	$this->load->helper('url');
      	$this->load->helper('form');


	}

function index(){
	
  	$resultado = $this->Contable_auditoria_model->all_auditoria();
	$data = array("consulta" => $resultado);
  	$this->load->view("contable/view_contable_auditoria",$data);


}


}

?>