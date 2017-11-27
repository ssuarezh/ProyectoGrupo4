<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tareaautomatica_model extends CI_Model {

function __construct(){
    parent:: __construct();
    $this->load->database();
}

function crearEncabezado($nombreArchivo,$fechaInicio)
{
    $valores = array(
        'Nombre_Archivo'=> $nombreArchivo,
        'FechaInicioCarga_Archivo'=>$fechaInicio
    );

    $this->db->insert('encabezado_archivo', $valores);
    return $this->db->insert_id();
}

function modificarEncabezado($canRegistros,$totalRecaudo, $fechaFin, $IdEncabezado)
{
    $sql= "UPDATE encabezado_archivo set CantidadRegistros_Archivo=?,TotalRecaudado_Archivo=?,FechaFinCarga_Archivo=? WHERE id =?";
    $this->db->query($sql, array($canRegistros, $totalRecaudo, $fechaFin,$IdEncabezado));
    
}

function consultarSiguienteId($nombreTabla)
{
    $query=$this->db->query("select siguienteid(".$nombreTabla.")  as 'secSiguiente'");
    return $query->row()->secSiguiente;
}


//esta funcion deba retornar el tipo que es 1 o 2
function identificarTipoEntidad($v3)
{
  $query=$this->db->query("SELECT Id_TipoEntidad,Id FROM entidad WHERE codigo =". $v3);
  return $query;
}

function cargarDetalleGeneral($datos)
{
    $this->db->insert('detalle_pago', $datos);
    return $this->db->insert_id();
}

 function cargarDetalleEfecty($datos)
 {

     $this->db->insert('detalle_efecty', $datos);
}

 function cargarDetalleEntidadFinanciera($datos)
 {
     $this->db->insert('detalle_entidad_bancaria', $datos);
 }

function comprobarAfiliado($cedula)
{
    $query=$this->db->query("SELECT Cedula from Afiliado where Cedula=". $cedula); 
    return $query;
}

 function crearAfiliado($cedula,$nombre,$apellido)
 {
    $sql= "INSERT INTO afiliado(Cedula,Nombre,Apellido) VALUES (?,?,?)";
    $this->db->query($sql, array($cedula, $nombre, $apellido));
   
 }

// function cargarEncabezadoEnLaBase($idEntidad,$nombreArchivo,$numFilas)
// {
//     $numero=1;
//     $this->db->insert('encabezado_archivo',array('id'=>$numero,'Id_entidadPago'=>$numero,'Nombre_Archivo'=>$nombreArchivo,
//                         'NumeroDeFilas_Archivo'=>$numFilas, 'FechaHora_Archivo'=>'sysdate()'));
// }


}

?>