<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Form extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

     public function index()
        {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cedula', 'Cédula', 'required|numeric|min_length[5]|max_length[10]');
     
                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('afiliado/no_encontrado');
                }
                else
                {
                        $cedula = $this->input->post('cedula');
                        $this->encontrar($cedula);
                }
        }

    public function encontrar($cedula)
    {
        
       $this->load->model('usuarios_model');

        $usuario = $this->usuarios_model->buscar($cedula);
        if(!is_null($usuario))
        {
            $this->load->helper('url');
             $this->load->view('afiliado/headers');
           // $consulta ="Nombre del afiliado: ".$usuario->nombre_afiliado."\nMonto Inicial ".$usuario->montoaprobado_credito."\nSaldo Actual ".$usuario->saldo;
             $consulta="Nombre del afiliado: ".$usuario->nombre."\nMonto Inicial:  ".$usuario->cupo_credito."\nSaldo Actual ".$usuario->saldo;
            $this->ragnar($consulta);
        }
        else
        {
              $this->load->view('afiliado/no_encontrado');
        }
                
    }
      public function ragnar($consulta)
    {
        require 'phpqrcode/qrlib.php';
        $dir = 'codigo/';
        if(!file_exists($dir))
            mkdir($dir);
        $filename=$dir.'test.png';
        $tamanio=10;
        $level='M';
        $framesize=3;
        QRcode::png($consulta, $filename, $level, $tamanio, $framesize);   
    }


}