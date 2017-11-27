<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_Model_S extends CI_Model 
{
	function __construct()
	{
		 parent::__construct();
		 $this->load->database();
	}	 


function obtenerEntidades () 
{
    $query = $this->db->get("entidad");
     if ($query -> num_rows() > 0) 
   {
         return $query->result(); ;
   }else
   {
      return false;  
   } 
}


function obtenerDatosReporte ($datos)
{
    $id_entidad=$datos['id_entidad'];
    $fecha_inicial=$datos['finicial'];
    $fecha_final = $datos['ffinal']; 

   $query =  $this->db->query(
    "SELECT NombreEntidad, Nombre_TipoEntidad, FechaRecaudo 
     FROM detalle_pago,entidad,tipo_entidad 
     WHERE entidad.Id = detalle_pago.Id_Entidad and entidad.Id_TipoEntidad = tipo_entidad.Id and entidad.id = ".$this->db->escape($id_entidad)." and detalle_pago.FechaRecaudo BETWEEN ".$this->db->escape($fecha_inicial)." and ".$this->db->escape($fecha_final));
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