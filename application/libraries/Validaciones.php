<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validaciones{

public function __construct(){
}

    function validarNumero($n)
    {
        try{
             if(is_numeric($n)){
                return true;
             }
             else{
               return false;
             }
        }
        catch (Exception $a){
            return false;
        }
    }

    function validarFecha()
    {

    }

    function validarNombres()
    {

    }

    function validarCodigoDeBarras()
    {

    }

}



?>