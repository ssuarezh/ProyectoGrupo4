<?php
class Usuario_model extends CI_Model { 
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