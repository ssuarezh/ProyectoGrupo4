<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model_S extends CI_Model 
{
	function __construct()
	{
		 parent::__construct();
		 $this->load->database();
	}	 

function validarInicioDeSesion ($datos)
{
    $username=$datos['usuario'];
    $pass=$datos['clave'];

   $query =  $this->db->query("SELECT UserName,Contrasena FROM usuario
    	  WHERE UserName= '$username' AND Contrasena='$pass'");
   if ($query -> num_rows() > 0) 
   {
    	   return $query;
   }else
   {
   	  return false;  
   } 

}

}

 ?>