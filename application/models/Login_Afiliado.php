<?php
//Modelo login contable
class Login_Afiliado extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->db_p = $this->load->database('postgres',TRUE);
   }
   public function usuario_por_nombre_contrasena($cedula, $contrasena){
      $this->db_p->select('id_afiliado, cedula');
      $this->db_p->from('afiliado');
      $this->db_p->where('cedula', $cedula);
      $this->db_p->where('contrasena', $contrasena);
      $consulta = $this->db_p->get();
      $resultado = $consulta->row();
      return $resultado;
   }
}
