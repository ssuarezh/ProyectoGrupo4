<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tareaautomatica_model extends CI_Model {

function __construct(){
    parent:: __construct();
    $this->load->database();
}

function crearEncabezado($id,$nombreArchivo)
{
    $valores = array(
        'id_entidad'=>(int) $id,
        'nombre_archivo'=> $nombreArchivo
    );

    $this->db->insert('encabezado_archivo', $valores);
    return $this->db->insert_id();
}

function consultarSiguienteId($nombreTabla)
{
    $query=$this->db->query("select siguienteid(".$nombreTabla.")  as 'secSiguiente'");
    return $query->row()->secSiguiente;
}


//esta funcion deba retornar el tipo que es 1 o 2
function identificarTipoEntidad($v3)
{
  $query=$this->db->query("SELECT id_tipo_entidad,id FROM entidad WHERE codigo =". $v3);
  return $query;
}

 function cargarDetalleEfecty($datos)
 {

     $this->db->insert('detalle_archivo_efecty', $datos);
}

 function cargarDetalleEntidadFinanciera($datos)
 {
     $this->db->insert('detalle_archivo_entidad_f', $datos);
 }

// function cargarEncabezadoEnLaBase($idEntidad,$nombreArchivo,$numFilas)
// {
//     $numero=1;
//     $this->db->insert('encabezado_archivo',array('id'=>$numero,'Id_entidadPago'=>$numero,'Nombre_Archivo'=>$nombreArchivo,
//                         'NumeroDeFilas_Archivo'=>$numFilas, 'FechaHora_Archivo'=>'sysdate()'));
// }


}

?>