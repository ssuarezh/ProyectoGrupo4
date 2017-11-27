<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargararchivo extends CI_Controller {

    function __construct(){
        parent:: __construct();
        $this->load->model('tareaautomatica_model');
        $this->load->helper('form');
        $this->load->library('util');
    }

        function index() {
         $this->load->view('header/header');
        $this->load->view('vistaArchivo');
      $this->load->view('footer/footer');

      }

    //FALTA HACER METODO QUE BORRE LOS ARCHIVOS GENERADOS EN TEMPORAL
    function cargarDatos()
    {
        set_time_limit(10800);

     
        $rutaArchivo='./temporal';
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
        $idEncabezado;
        $idEntidad;
        $totalRecaudo=0;

        $fechaIni = $this->util->calcularFecha();

        foreach($archivoL as $fila)
        {
            if($saltoLinea > 0){
            $arreglo = explode(";",$fila);
            $v0=(int)trim($arreglo[0]);
            $v1=trim($arreglo[1]);
            $v2=trim($arreglo[2]);
            $v3=trim($arreglo[3]);
            $v4=trim($arreglo[4]);
            $v5=trim($arreglo[5]);
            $v6=trim($arreglo[6]);
            $v7=trim($arreglo[7]);
           
            // agregar a if($saltoLinea < 2): si no se ha encontrado el tipo de entidad
                if($saltoLinea < 2)
                {
                    $query=$this->tareaautomatica_model->identificarTipoEntidad($v3);
                    $tipoEntidad= $query->row()->Id_TipoEntidad;
                    $idEntidad= $query->row()->Id;
                    $idEncabezado = $this->tareaautomatica_model->crearEncabezado($nombreArchivo,$fechaIni);
                 }
            
            if($this->comprobarAfiliado($v0,$v1,$v2))
            {

            //falta validacion de si no existe el codigo de banco o numero de oficina en la base
            if($tipoEntidad == 1)
            {
                $datos1 = array(
                    'FechaRecaudo' => $v4,
                    'id_Encabezado' => (int)$idEncabezado,
                    'Valor_Consignado' =>(int)$v5,
                    'Cedula' =>$v0 ,
                    'Id_Entidad' =>(int)$idEntidad
                );
                $idDetalle = $this->tareaautomatica_model->cargarDetalleGeneral($datos1);
    
                $datos2 = array(
                    'NumeroDeReferencia' =>(int)$v6,
                    'CodigoDeBarras' =>$v7,
                    'id_DetallePago' =>(int)$idDetalle
                );

                $this->tareaautomatica_model->cargarDetalleEntidadFinanciera($datos2);
                $totalRecaudo = $totalRecaudo + (int)$v5;
                
            }
            else if($tipoEntidad == 2)
            {   
            $datos1 = array(
                'FechaRecaudo' => $v6,
                'id_Encabezado' => (int)$idEncabezado,
                'Valor_Consignado' =>(int)$v4,
                'Cedula' =>$v0 ,
                'Id_Entidad' =>(int)$idEntidad
            );
            $idDetalle = $this->tareaautomatica_model->cargarDetalleGeneral($datos1);

            $datos2 = array(
                'ValorComision' =>(int)$v7,
                'id_DetallePago' =>(int)$idDetalle
            );
            $this->tareaautomatica_model->cargarDetalleEfecty($datos2);
            $totalRecaudo = $totalRecaudo + (int)$v4;
            }
        }
        }
            $numFilas ++;
            $saltoLinea ++;
        }
        $fechaFin = $this->util->calcularFecha();
        $this->tareaautomatica_model->modificarEncabezado($numFilas,$totalRecaudo, $fechaFin,$idEncabezado);

     }



     //falta validacion si los datos tienen tipo de dato mal: tebdria que retornar false
     function comprobarAfiliado($cedula,$nombre,$apellido)
     {
        $comprueba =$this->tareaautomatica_model->comprobarAfiliado($cedula);
        echo "numero de filas: ".$comprueba->num_rows();
        if($comprueba->num_rows()>0)
        {
            echo "comprobar: $cedula";
           return true;
        }
        else{
            $this->tareaautomatica_model->crearAfiliado($cedula,$nombre,$apellido);
            echo "insertar afiliado: $cedula";
            return true;
        }
     }


     

    //  function iniciarTarea()
    //  {
    //     set_time_limit(10800);
         
    //      $directorio="../archivos";
         
    //      if(($recurso=opendir($directorio)) != false)
    //      {
    //          while(($nombreArchivo = readdir($recurso)))
    //          {
    //              $rutaArchivo="$directorio/$nombreArchivo";
                
    //              if(is_file($rutaArchivo))
    //              {
    //                 $this->leerArchivoGenerico($rutaArchivo, $nombreArchivo);
    //              }
    //          }
    //      }    
    //  }
     
//    function probarEnvioCorreo()
//    {
//     $this->load->library('email');
//     $this->email->from('','Administrador');
// 	$this->email->to('');
// 	$this->email->subject('Probando correo');
// 	$this->email->message('Funciona bien.. Funciona bien');
// 	if($this->email->send())
// 	{
// 		echo "ENVIO EXITOSO";
// 	}
// 	else
// 	{
// 		echo "ENVIO FALLIDO";
// 	}
//    }

}

?>