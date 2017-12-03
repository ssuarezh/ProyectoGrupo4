<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db_post=$this->load->database('postgres',TRUE);
    }

    public function buscar($cedula)
    {
        //    $query = $this->db->select('*')->from('cliente')->where('cod_cliente', $cod_cliente)->get();
          //      return $query->row_array();

         //$query = $this->db->query("Select * from cliente,fact where fact.cod_cliente=cliente.cod_cliente and CLIENTE.cod_cliente=".$cod_cliente);
       // $query = $this->db->query("Select nombre_afiliado,montoaprobado_credito,sum(saldovigente_credito) as saldo
    //FROM afiliado,movimiento,credito where afiliado.cedula=credito.cedula_afiliado and credito.id=movimiento.id_credito 
    //and afiliado.cedula=".$cedula." GROUP BY nombre_afiliado,montoaprobado_credito");
        $query= $this->db_post->query("SELECT nombre, cupo_credito, sum(valor_credito) as val_credito, sum(saldo_vigente) as saldo
            FROM afiliado,credito 
            WHERE AFILIADO.cedula=CREDITO.cedula_afiliado AND cedula= ".$cedula." GROUP BY nombre,cupo_credito");
        return $query->row();
    }

}

