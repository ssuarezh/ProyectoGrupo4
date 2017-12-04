<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recaudo_auditoria_model extends CI_Model {

public function __construct(){
    parent:: __construct();
   
    
 	$this->load->database();
}

public function all_auditoria(){

	$this->db->select("*");
	$this->db->from("auditoria");


	$consulta = $this->db->get();
   	//$resultado = $consulta->row();
    return $consulta;
}

}
?>