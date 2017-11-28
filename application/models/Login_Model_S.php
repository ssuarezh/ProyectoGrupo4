<?php 
/*defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model_S extends CI_Model 
{
	function __construct(){
		 parent::__construct();
         $this->load->database();
         //$this->conPos = $this->load->database('postgresql',TRUE);
    }	 
  function validarInicioDeSesion ($datos){
    $username=$datos['usuario'];
    $pass=$datos['clave'];
    $query =  $this->db->query("SELECT UserName,Contrasena FROM usuario
    WHERE UserName= '$username' AND Contrasena='$pass'");
    if ($query -> num_rows() > 0) {
      	 return $query;
    }else{
     	return false;  
    } 
  }
}*/


//SANTIAGO 
class Login_Model_S extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }
   public function usuario_por_nombre_contrasena($nombre, $contrasena){
      $this->db->select('id, UserName');
      $this->db->from('usuario');
      $this->db->where('UserName', $nombre);
      $this->db->where('Contrasena', $contrasena);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }
}

?>