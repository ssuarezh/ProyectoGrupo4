<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contable_auditoria_model extends CI_Model {

public function __construct(){
    parent:: __construct();
   
    $this->db_p = $this->load->database('postgres',TRUE);
 
}

public function all_auditoria(){
	$this->db_p->select("*");
	$this->db_p->from("auditoria");
	

	$consulta = $this->db_p->get();
   	//$resultado = $consulta->row();
    return $consulta;
}

}
?>