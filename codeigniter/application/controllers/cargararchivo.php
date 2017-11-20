<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargararchivo extends CI_Controller {

    function __construct(){
        parent:: __construct();
        $this->load->model('tareaautomatica_model');
        $this->load->helper('form');
    }

    function cargarArchivo()
    {
        $this->load->view('cargararchivo_vista');
    }

    //FALTA HACER METODO QUE BORRE LOS ARCHIVOS GENERADOS EN TEMPORAL
    function cargarDatos()
    {
        set_time_limit(10800);
        $rutaArchivo='../codeigniter/temporal';
        $config=[
            'allowed_types' =>"csv",
            'upload_path'=>$rutaArchivo
        ];

        $this->load->library('upload', $config);

        if($this->upload->do_upload('archivo'))
        {
            $datos_archivo= array("datos" =>$this->upload->data());
            $nombre_archivo = $datos_archivo['datos']['file_name'];
            $rutaArchivo = $rutaArchivo."/".$nombre_archivo;
            $this->leerArchivoGenerico($rutaArchivo,$nombre_archivo);
        }
        else{
            echo $this->upload->display_errors();
        }
     }

     function leerArchivoGenerico($rutaArchivo, $nombreArchivo)
     {
        $archivoL= file($rutaArchivo);
        
        $numFilas=-1;
        $saltoLinea=0;
        $tipoEntidad;
        $id;
        $idEncabezado;

        foreach($archivoL as $fila)
        {
            if($saltoLinea > 0){
            $arreglo = explode(";",$fila);
            $v0=trim($arreglo[0]);
            $v1=trim($arreglo[1]);
            $v2=trim($arreglo[2]);
            $v3=trim($arreglo[3]);
            $v4=trim($arreglo[4]);
            $v5=trim($arreglo[5]);
            $v6=trim($arreglo[6]);
            $v7=trim($arreglo[7]);
           
                if($saltoLinea < 2)
                {
                     $query=$this->tareaautomatica_model->identificarTipoEntidad($v3);
                     $tipoEntidad = $query->row()->id_tipo_entidad;
                     $id= $query->row()->id;
                     $idEncabezado = $this->tareaautomatica_model->crearEncabezado($id,$nombreArchivo);
                 }
            
            //falta validacion de si no existe el codigo de banco o numero de oficina en la base
            if($tipoEntidad == 1)
            {
                $datos = array(
                    'id_encabezado'=>(int) $idEncabezado,
                    'cedula' =>(int) $v0,
                    'valor_consignacion' =>(int) $v5,
                    'numero_referencia' =>(int) $v6,
                    'fecha_recaudo' => $v4,
                    'codigo_barras' =>(int) $v7
                );

                $this->tareaautomatica_model->cargarDetalleEntidadFinanciera($datos);
            }
            else if($tipoEntidad == 2)
            {
                $datos = array(
                    'id_encabezado'=>(int) $idEncabezado,
                    'cedula' =>(int) $v0,
                    'valor_pagado' =>(int) $v4,
                    'numero_credito' =>(int) $v5,
                    'fecha_recaudo' => $v6,
                    'valor_comision' =>(int) $v7
                );
                $this->tareaautomatica_model->cargarDetalleEfecty($datos);
            }
        }
            $numFilas ++;
            $saltoLinea ++;
        }
     }

     function iniciarTarea()
     {
        set_time_limit(10800);
         
         $directorio="../archivos";
         
         if(($recurso=opendir($directorio)) != false)
         {
             while(($nombreArchivo = readdir($recurso)))
             {
                 $rutaArchivo="$directorio/$nombreArchivo";
                
                 if(is_file($rutaArchivo))
                 {
                    $this->leerArchivoGenerico($rutaArchivo, $nombreArchivo);
                 }
             }
         }    
     }
     
   function probarEnvioCorreo()
   {
    $this->load->library('email');
    $this->email->from('','Administrador');
	$this->email->to('');
	$this->email->subject('Probando correo');
	$this->email->message('Funciona bien.. Funciona bien');
	if($this->email->send())
	{
		echo "ENVIO EXITOSO";
	}
	else
	{
		echo "ENVIO FALLIDO";
	}
   }

}

?>