<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    


class Afiliados extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model');
    }

        public function index()
    {

        $this->load->helper('url');
        $this->load->view('afiliado/inicio');
    }


    public function find_get($cod_cliente)
    {


        if (!$cod_cliente) {
            $this->response(null, 400);
        }

        $usuario = $this->usuarios_model->get($cod_cliente);
        $consulta="No hay nada";
        if (!is_null($usuario)) {
        $this->load->helper('url');
        $this->load->view('/afiliados/headers');
           // $consulta = "El codigo de la factura es:".$usuario->cod_cliente." el valor fue de : ".$usuario->val_factura." el nombre del cliente es ".$usuario->nom_cliente;
             // $consulta = "La cedula del cliente es:".$usuario->cedula." el telefono es  : ".$usuario->telefono_afiliado." el nombre del afiliado es ".$usuario->nombre_afiliado;
            $consulta ="Nombre del afiliado: ".$usuario->nombre_afiliado."\nMonto Inicial ".$usuario->montoaprobado_credito."\nSaldo Actual ".$usuario->saldo;
            $this->ragnar($consulta);
          //  $this->response(array('response' => $usuario), 200);
        } else {
          //  $this->response(array('error' => 'Usuario no encontrado...'), 404);
            $this->load->helper('url');
            $this->load->view('afiliados/no_encontrado');
            $consulta="Usuario no encontrado...";
        }
                
    }

    public function ragnar($consulta)
    {
        require 'phpqrcode/qrlib.php';
        $dir = 'almacenamiento/';
        if(!file_exists($dir))
            mkdir($dir);
        $filename=$dir.'test.png';
        $tamanio=10;
        $level='M';
        $framesize=3;
        QRcode::png($consulta, $filename, $level, $tamanio, $framesize);   
    }


}