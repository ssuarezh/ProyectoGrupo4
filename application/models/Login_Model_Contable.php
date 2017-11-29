<?php
//Modelo login contable
class Login_Model_Contable extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->db_p = $this->load->database('postgres',TRUE);
   }
   public function usuario_por_nombre_contrasena($nombre, $contrasena){
      $this->db_p->select('id_usuario, nombre_usuario');
      $this->db_p->from('usuario');
      $this->db_p->where('nombre_usuario', $nombre);
      $this->db_p->where('clave_usuario', $contrasena);
      $consulta = $this->db_p->get();
      $resultado = $consulta->row();
      return $resultado;
   }
}
