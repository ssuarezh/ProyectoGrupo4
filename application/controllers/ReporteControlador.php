<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReporteControlador extends CI_Controller {
  function __construct(){
  	parent::__construct();
  	$this->load->model('Reporte_Model_S');
	  $this->load->helper('url');
	  $this->load->helper('form');
    $this->load->library('export_excel');
  }

	function index() 
  {
		//$this->load->library('recaptcha');
		$algo['message'] = '';
    $resultado1 = $this->Reporte_Model_S->obtenerEntidades();
    $algo['entidades'] = $resultado1;
    $this->load->view('header/header');
		$this->load->view('reporte', $algo);
    $this->load->view('footer/footer');

 }




 public function generarReporte()
 {

 	   $id_entidad = $this->input->post('id_entidad');
   	 $fecha_inicial= $this->input->post('finicial');
     $fecha_final = $this->input->post('ffinal');
   	 $datos = array 
   	 (
   	 	'id_entidad' => $id_entidad,
        'finicial' => $fecha_inicial,
        'ffinal' => $fecha_final
   	 );
   if ((($fecha_inicial != null || $fecha_inicial !='') && ($fecha_final != null || $fecha_final != '')) &&  $fecha_inicial < $fecha_final ) 
   {

   	 $resultado = $this->Reporte_Model_S->obtenerDatosReporte($datos);
     //$data['message'] = '<div class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px; "> No hay datos </div>';
        if ($resultado) 
        { 
          $resultado1 = $this->Reporte_Model_S->obtenerEntidades();
          $algo['entidades'] = $resultado1;
       
          //$this->load->view('header/header');
        	//$this->load->view('reporte', $algo);
          //$this->load->view('footer/footer');     

          $this->export_excel->to_excel($resultado, 'Archivo_Excel');
        }
        else
        {
          $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> No se encontraron datos en esas fechas</div>';   
          $resultado1 = $this->Reporte_Model_S->obtenerEntidades();
          $algo['entidades'] = $resultado1;
          $this->load->view('header/header');
          $this->load->view('reporte', $algo );
          $this->load->view('footer/footer');
        } 
  }
  elseif($fecha_inicial == '' || $fecha_final == '' )
  {
       $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;"> Formato de fecha no válido </div>'; 
         $resultado1 = $this->Reporte_Model_S->obtenerEntidades();
          $algo['entidades'] = $resultado1;
       $this->load->view('header/header');
          $this->load->view('reporte', $algo );
          $this->load->view('footer/footer');   
  }
  elseif($fecha_inicial >= $fecha_final)
  {
    $algo['message'] = '<div style="color:#FF0000" class="height:10%; width:20%; padding-bottom:100px; margin-bottom: 50px;">La fecha inicial es mayor o igual a la final </div>'; 
            $resultado1 = $this->Reporte_Model_S->obtenerEntidades();
          $algo['entidades'] = $resultado1;
          $this->load->view('header/header');
          $this->load->view('reporte', $algo );
          $this->load->view('footer/footer');
  } 


 }
}
?>