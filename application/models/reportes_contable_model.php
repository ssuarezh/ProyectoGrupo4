<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tareaautomatica_model extends CI_Model {

function __construct(){
    parent:: __construct();
    $this->load->database();
}

function generarReporteEfecty()
{

}


// function generarReporteBanco()
// {
//     SELECT entidad.Codigo, entidad.NombreEntidad, SUM(detalle_pago.Valor_Consignado),encabezado_archivo.id, encabezado_archivo.Nombre_Archivo, encabezado_archivo.CantidadRegistros_Archivo, COUNT(detalle_pago.id) 
//     FROM entidad, detalle_pago,encabezado_archivo
//     WHERE detalle_pago.Id_Entidad = entidad.Id AND encabezado_archivo.id = detalle_pago.id_Encabezado;    
// }

function generarReporteEfectyEsp()
{

}

//codigo y nombre de la entidad
function obtenerEntidades
{


}
?>