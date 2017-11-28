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
        
        $numFilas=0;
        $saltoLinea=0;
        $tipoEntidad="";
        $idEncabezado="";
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
            $v3=(int)trim($arreglo[3]);
            $v4=trim($arreglo[4]);
            $v5=trim($arreglo[5]);
            $v6=trim($arreglo[6]);
            $v7=trim($arreglo[7]);              

            //aqui falta verificar los tipos de datos
            
            $qIdEntiTipo= $this->buscarCodigoEntidad($v3);
            if($this->verificarCodigoEntidad($qIdEntiTipo,$v3))
            {
                if($idEncabezado=="" && $tipoEntidad==""){
                $idEncabezado = (int)$this->tareaautomatica_model->crearEncabezado($nombreArchivo,$fechaIni);
                $tipoEntidad= $qIdEntiTipo->row()->Id_TipoEntidad;
                }
              if($tipoEntidad == $qIdEntiTipo->row()->Id_TipoEntidad){
            if($this->comprobarAfiliado($v0,$v1,$v2)){
                
            if($tipoEntidad == 1)
            {
                $datos1 = array(
                    'FechaRecaudo' => $v4,
                    'id_Encabezado' => $idEncabezado,
                    'Valor_Consignado' =>(int)$v5,
                    'Cedula' =>$v0 ,
                    'Id_Entidad' =>$qIdEntiTipo->row()->Id
                );
                
                $idDetalle = $this->tareaautomatica_model->cargarDetalleGeneral($datos1);
    
                $datos2 = array(
                    'NumeroDeReferencia' =>(int)$v6,
                    'CodigoDeBarras' =>$v7,
                    'id_DetallePago' =>(int)$idDetalle
                );

                $this->tareaautomatica_model->cargarDetalleEntidadFinanciera($datos2);
                $totalRecaudo = $totalRecaudo + (int)$v5;
                $numFilas ++;
            }
            else if($tipoEntidad == 2)
            {   
            $datos1 = array(
                'FechaRecaudo' => $v6,
                'id_Encabezado' => $idEncabezado,
                'Valor_Consignado' =>(int)$v4,
                'Cedula' =>$v0 ,
                'Id_Entidad' =>$qIdEntiTipo->row()->Id
            );

            $idDetalle = $this->tareaautomatica_model->cargarDetalleGeneral($datos1);

            $datos2 = array(
                'ValorComision' =>(int)$v7,
                'id_DetallePago' =>(int)$idDetalle
            );
            $this->tareaautomatica_model->cargarDetalleEfecty($datos2);
            $totalRecaudo = $totalRecaudo + (int)$v4;
            $numFilas ++;
            }
        }
    }
    }
        }
           
            $saltoLinea ++;
        }
        $fechaFin = $this->util->calcularFecha();
        $this->tareaautomatica_model->modificarEncabezado($numFilas,$totalRecaudo, $fechaFin,$idEncabezado);

     }






     //falta validacion si los datos tienen tipo de dato mal: tebdria que retornar false
     function comprobarAfiliado($cedula,$nombre,$apellido)
     {
        $comprueba =$this->tareaautomatica_model->comprobarAfiliado($cedula);
      //  echo "numero de filas: ".$comprueba->num_rows();
        if($comprueba->num_rows()>0)
        {
          //  echo "comprobar: $cedula";
           return true;
        }
        else{
            $this->tareaautomatica_model->crearAfiliado($cedula,$nombre,$apellido);
          //  echo "insertar afiliado: $cedula";
            return true;
        }
     }


    

     function buscarCodigoEntidad($v3)
     {
        return $this->tareaautomatica_model->verificarCodigoEntidad1($v3);
     }


     function verificarCodigoEntidad($qIdEntiTipo,$borrarLuego)
     {
       
        echo "numero de filas: ".$qIdEntiTipo->num_rows();
        if($qIdEntiTipo->num_rows()>0)
        {
            echo "comprobar: $borrarLuego;";
           return true;
        }
        else{
            //llenar reporte de que la entidad no existe
            echo "no existe entidad: $borrarLuego";
            return false;
        }
     }

     

     function iniciarTarea()
     {
        set_time_limit(10800);
         
         $directorio="C:/ejecutar/archivos";
         
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

        //no esta funcionando
    // function sendMail(){
        
    //     $config = Array(
    //       'protocol' => 'SMTP', //siempre mayusculas
    //       'smtp_host' => 'smtp.gmail.com',
    //       'smtp_port' => 587,
    //       'smtp_crypto'=> 'TLS', //siempre mayusculas
    //       'smtp_user' => 'ejemplo7654@gmail.com', 
    //       'smtp_pass' => '1357khfs', 
    //       'mailtype' => 'html',
    //       'charset' => 'iso-8859-1',
    //       'wordwrap' => TRUE
    //     );
         
    //       $this->load->library('email', $config);
    //       $this->email->set_newline("\r\n");
    //       $this->email->from('ejemplo7654@gmail.com'); // remitente
    //       $this->email->to('ejemplo7654@gmail.com'); // destino
    //       $this->email->subject('CORREO ENVIADO MEDIANTE PHP-CODEIGNITER.');
    //       $this->email->message('ESTE ES UN MENSAJE DE PRUEBA');
         
    //       if($this->email->send()){
    //       echo 'CORREO ENVIADO';
    //      }
    //      else{
    //          echo ("NO SE PUDO ENVIAR.");
    //          show_error($this->email->print_debugger());
    //     }
        
    //     }





     
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